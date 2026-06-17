<?php
require __DIR__ . '/includes/auth.php';
admin_require_login();
require_once __DIR__ . '/includes/layout.php';

$user = admin_current_user();
$username = $user['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!admin_verify_csrf()) { admin_flash('err', 'Session expired.'); header('Location: account.php'); exit; }
    $action = $_POST['action'] ?? '';

    if ($action === 'change_password') {
        $cur = (string)($_POST['current'] ?? '');
        $new = (string)($_POST['new'] ?? '');
        $conf = (string)($_POST['confirm'] ?? '');
        if (!password_verify($cur, $user['password'] ?? '')) admin_flash('err', 'Current password is incorrect.');
        elseif (strlen($new) < 8) admin_flash('err', 'New password must be at least 8 characters.');
        elseif ($new !== $conf) admin_flash('err', 'New passwords do not match.');
        else { $user['password'] = password_hash($new, PASSWORD_BCRYPT); admin_upsert_user($user); admin_flash('ok', 'Password updated.'); }
        header('Location: account.php'); exit;
    }

    if ($action === 'twofa_begin') {
        $_SESSION['twofa_setup_secret'] = totp_generate_secret();
        header('Location: account.php#twofa'); exit;
    }
    if ($action === 'twofa_cancel') { unset($_SESSION['twofa_setup_secret']); header('Location: account.php#twofa'); exit; }

    if ($action === 'twofa_enable') {
        $secret = $_SESSION['twofa_setup_secret'] ?? '';
        $code = (string)($_POST['code'] ?? '');
        if ($secret === '') { admin_flash('err', 'Start 2FA setup again.'); }
        elseif (!totp_verify($secret, $code, 1)) { admin_flash('err', 'That code did not match. Check your authenticator and try again.'); header('Location: account.php#twofa'); exit; }
        else {
            $plain = admin_generate_backup_codes(8);
            $user['totp_enabled'] = true;
            $user['totp_secret'] = $secret;
            $user['backup_codes'] = admin_hash_backup_codes($plain);
            admin_upsert_user($user);
            unset($_SESSION['twofa_setup_secret']);
            $_SESSION['show_backup_codes'] = $plain;
            admin_flash('ok', 'Two-factor authentication is on. Save your backup codes below.');
        }
        header('Location: account.php#twofa'); exit;
    }

    if ($action === 'twofa_disable') {
        $code = (string)($_POST['code'] ?? '');
        if (!admin_verify_second_factor($user, $code)) { admin_flash('err', 'Enter a valid 2FA code to disable it.'); }
        else { $user['totp_enabled'] = false; $user['totp_secret'] = null; $user['backup_codes'] = []; admin_upsert_user($user); admin_flash('ok', '2FA disabled.'); }
        header('Location: account.php#twofa'); exit;
    }

    if ($action === 'backup_regen') {
        $code = (string)($_POST['code'] ?? '');
        if (!admin_verify_second_factor($user, $code)) { admin_flash('err', 'Enter a valid 2FA code to regenerate backup codes.'); }
        else { $plain = admin_generate_backup_codes(8); $user['backup_codes'] = admin_hash_backup_codes($plain); admin_upsert_user($user); $_SESSION['show_backup_codes'] = $plain; admin_flash('ok', 'New backup codes generated.'); }
        header('Location: account.php#twofa'); exit;
    }
}

$setupSecret = $_SESSION['twofa_setup_secret'] ?? '';
$showCodes = $_SESSION['show_backup_codes'] ?? null;
unset($_SESSION['show_backup_codes']);
$otpUri = $setupSecret ? totp_provisioning_uri($setupSecret, $username . '@' . parse_url(BRAND_SITE_URL, PHP_URL_HOST), ADMIN_ISSUER) : '';

admin_layout_head('My Account');
?>
<div class="adm-page-head"><div><span class="adm-eyebrow">Account</span><h1>My <span class="serif-italic">account</span></h1><p>Signed in as <strong><?= htmlspecialchars($user['name'] ?? $username) ?></strong> (<span class="adm-mono"><?= htmlspecialchars($username) ?></span>).</p></div></div>

<div class="adm-grid cols-2">
  <div class="adm-card">
    <div class="adm-card-head"><h2>Change password</h2></div>
    <form method="post">
      <?= admin_csrf_field() ?><input type="hidden" name="action" value="change_password">
      <div class="adm-field"><label class="adm-label">Current password</label><input class="adm-input" type="password" name="current" autocomplete="current-password" required></div>
      <div class="adm-field"><label class="adm-label">New password</label><input class="adm-input" type="password" name="new" autocomplete="new-password" required></div>
      <div class="adm-field"><label class="adm-label">Confirm new password</label><input class="adm-input" type="password" name="confirm" autocomplete="new-password" required></div>
      <button class="adm-btn adm-btn-cta" type="submit">Update password</button>
    </form>
  </div>

  <div class="adm-card" id="twofa">
    <div class="adm-card-head"><h2>Two-factor authentication</h2><?= !empty($user['totp_enabled']) ? '<span class="adm-chip green">Enabled</span>' : '<span class="adm-chip grey">Off</span>' ?></div>

    <?php if ($showCodes): ?>
      <div class="adm-alert warn"><i class="fa-solid fa-key"></i><span>Save these backup codes somewhere safe. Each works once. They are shown only this time.</span></div>
      <div class="adm-backup-codes"><?php foreach ($showCodes as $c): ?><div><?= htmlspecialchars($c) ?></div><?php endforeach; ?></div>
    <?php endif; ?>

    <?php if (empty($user['totp_enabled'])): ?>
      <?php if ($setupSecret): ?>
        <p class="adm-muted">Scan this with Google Authenticator, Authy or 1Password — then enter the 6-digit code to confirm.</p>
        <div class="adm-2fa-qr"><div id="qr"></div></div>
        <p style="text-align:center">Manual key: <span class="adm-mono"><?= htmlspecialchars(totp_format_secret($setupSecret)) ?></span></p>
        <form method="post" class="adm-flex" style="gap:.5rem">
          <?= admin_csrf_field() ?><input type="hidden" name="action" value="twofa_enable">
          <input class="adm-input" name="code" inputmode="numeric" placeholder="123456" style="max-width:140px" autofocus>
          <button class="adm-btn adm-btn-cta" type="submit">Verify &amp; enable</button>
        </form>
        <form method="post" style="margin-top:.5rem"><?= admin_csrf_field() ?><input type="hidden" name="action" value="twofa_cancel"><button class="adm-btn adm-btn-ghost adm-btn-sm" type="submit">Cancel</button></form>
      <?php else: ?>
        <p class="adm-muted">Add a second layer of security with an authenticator app.</p>
        <form method="post"><?= admin_csrf_field() ?><input type="hidden" name="action" value="twofa_begin"><button class="adm-btn adm-btn-cta" type="submit"><i class="fa-solid fa-shield-halved"></i> Enable 2FA</button></form>
      <?php endif; ?>
    <?php else: ?>
      <p class="adm-muted">Your account is protected by an authenticator app.</p>
      <form method="post" class="adm-mb"><?= admin_csrf_field() ?><input type="hidden" name="action" value="backup_regen">
        <div class="adm-flex" style="gap:.5rem"><input class="adm-input" name="code" placeholder="2FA code" style="max-width:140px"><button class="adm-btn adm-btn-ghost" type="submit">Regenerate backup codes</button></div>
      </form>
      <form method="post"><?= admin_csrf_field() ?><input type="hidden" name="action" value="twofa_disable">
        <div class="adm-flex" style="gap:.5rem"><input class="adm-input" name="code" placeholder="2FA code" style="max-width:140px"><button class="adm-btn adm-btn-danger" type="submit">Disable 2FA</button></div>
      </form>
    <?php endif; ?>
  </div>
</div>

<?php
$inline = '';
if ($otpUri !== '') {
    $inline = 'window.ADM_OTP=' . json_encode($otpUri) . ';';
}
admin_layout_foot($inline);
?>
<?php if ($otpUri !== ''): ?>
<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
<script>
(function(){ var el=document.getElementById('qr'); if(el&&window.QRCode&&window.ADM_OTP){ new QRCode(el,{text:window.ADM_OTP,width:188,height:188,correctLevel:QRCode.CorrectLevel.M}); } })();
</script>
<?php endif; ?>
