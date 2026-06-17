<?php
require __DIR__ . '/includes/auth.php';
admin_boot();
admin_send_security_headers();

if (admin_is_logged_in()) { header('Location: ' . admin_home_url()); exit; }

$error = '';
$step  = (!empty($_SESSION['pending_2fa']) && !empty($_SESSION['pending_user'])) ? '2fa' : 'login';

// Pull in the brand reCAPTCHA helpers (loader + field), if configured.
$recaptchaFile = SITE_ROOT . '/includes/recaptcha.php';
if (is_file($recaptchaFile)) require_once $recaptchaFile;
$hasCaptcha = !empty($GLOBALS['RECAPTCHA']['site_key']) && !admin_is_loopback();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postStep = $_POST['step'] ?? 'login';

    if (!admin_verify_csrf()) {
        $error = 'Your session expired. Please try again.';
    } elseif ($postStep === '2fa' && $step === '2fa') {
        $user = admin_find_user($_SESSION['pending_user']);
        $tkey = admin_throttle_key('2fa', $_SESSION['pending_user']);
        $wait = admin_throttle_locked($tkey);
        if ($wait > 0) {
            $error = 'Too many attempts. Try again in ' . ceil($wait / 60) . ' min.';
        } elseif ($user && admin_verify_second_factor($user, (string)($_POST['code'] ?? ''))) {
            admin_throttle_clear($tkey);
            admin_login_user($user);
            header('Location: ' . admin_home_url());
            exit;
        } else {
            admin_throttle_hit($tkey);
            $error = 'That code is not valid. Try your authenticator app or a backup code.';
        }
    } elseif ($postStep === 'login') {
        $username = trim((string)($_POST['username'] ?? ''));
        $password = (string)($_POST['password'] ?? '');
        $tkey = admin_throttle_key('pw', $username);
        $wait = admin_throttle_locked($tkey);
        if ($wait > 0) {
            $error = 'Too many attempts. Try again in ' . ceil($wait / 60) . ' min.';
        } elseif (!admin_recaptcha_verify((string)($_POST['g-recaptcha-token'] ?? ''))) {
            $error = 'Could not verify you are human. Please try again.';
        } else {
            $user = admin_find_user($username);
            if ($user && password_verify($password, $user['password'] ?? '')) {
                admin_throttle_clear($tkey);
                if (!empty($user['totp_enabled']) && !empty($user['totp_secret'])) {
                    $_SESSION['pending_2fa'] = true;
                    $_SESSION['pending_user'] = $user['username'];
                    $step = '2fa';
                } else {
                    admin_login_user($user);
                    header('Location: ' . admin_home_url());
                    exit;
                }
            } else {
                admin_throttle_hit($tkey);
                $error = 'Incorrect username or password.';
            }
        }
    }
}
$brandName = defined('BRAND_NAME') ? BRAND_NAME : 'EU Publishing House';
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title>Sign in — <?= htmlspecialchars($brandName) ?> Admin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="assets/admin.css">
</head>
<body>
<div class="adm-login-wrap">
  <div class="adm-login-card">
    <div class="adm-login-brand">
      <span class="adm-brand-fallback"><?= htmlspecialchars($brandName) ?></span>
    </div>

    <?php if ($error): ?>
      <div class="adm-alert err"><i class="fa-solid fa-circle-exclamation"></i><span><?= htmlspecialchars($error) ?></span></div>
    <?php endif; ?>

    <?php if ($step === '2fa'): ?>
      <h1>Two-step verification</h1>
      <p class="adm-sub">Enter the 6-digit code from your authenticator app, or a backup code.</p>
      <form method="post" autocomplete="one-time-code">
        <?= admin_csrf_field() ?>
        <input type="hidden" name="step" value="2fa">
        <div class="adm-field">
          <label class="adm-label">Authentication code</label>
          <input class="adm-input" name="code" inputmode="numeric" autocomplete="one-time-code" autofocus placeholder="123456 or backup code">
        </div>
        <button class="adm-btn adm-btn-cta" type="submit">Verify <i class="fa-solid fa-arrow-right"></i></button>
        <p style="margin-top:1rem;text-align:center"><a href="logout.php?t=<?= urlencode(admin_csrf_token()) ?>" style="font-size:.85rem">Cancel</a></p>
      </form>
    <?php else: ?>
      <h1>Welcome back</h1>
      <p class="adm-sub">Sign in to manage your content.</p>
      <form method="post" id="loginForm">
        <?= admin_csrf_field() ?>
        <input type="hidden" name="step" value="login">
        <div class="adm-field">
          <label class="adm-label">Username</label>
          <input class="adm-input" name="username" autocomplete="username" autofocus required>
        </div>
        <div class="adm-field">
          <label class="adm-label">Password</label>
          <input class="adm-input" type="password" name="password" autocomplete="current-password" required>
        </div>
        <?php if (function_exists('recaptcha_field')) recaptcha_field('admin_login'); ?>
        <button class="adm-btn adm-btn-cta" type="submit">Sign in <i class="fa-solid fa-arrow-right"></i></button>
      </form>
      <?php if ($hasCaptcha && function_exists('recaptcha_loader')) recaptcha_loader(); ?>
      <script>
      /* Fetch a fresh reCAPTCHA v3 token and inject it before the form posts.
         Mirrors the public site's form handler (assets/js/main.js). Safe no-op
         when no captcha is configured / on localhost (recaptchaGetToken absent). */
      (function () {
        var form = document.getElementById('loginForm');
        if (!form) return;
        form.addEventListener('submit', function (e) {
          var tokenField = form.querySelector('[data-recaptcha-token]');
          if (!tokenField || typeof window.recaptchaGetToken !== 'function') return; // submit normally
          e.preventDefault();
          var btn = form.querySelector('button[type="submit"]');
          if (btn) { btn.disabled = true; btn.style.opacity = '.7'; }
          var action = tokenField.dataset.recaptchaAction || 'admin_login';
          var send = function (token) { tokenField.value = token || ''; form.submit(); };
          window.recaptchaGetToken(action).then(send).catch(function () { send(''); });
        });
      })();
      </script>
    <?php endif; ?>
  </div>
</div>
</body>
</html>
