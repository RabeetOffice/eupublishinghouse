<?php
require __DIR__ . '/includes/auth.php';
admin_require_module('settings');
require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/layout.php';

define('SITE_CONFIG', SITE_ROOT . '/includes/config.php');

/** Replace a define('NAME', '...') value in config source. Empty allowed (gotcha #10). */
function settings_set_define(string $src, string $name, string $val): string {
    $pattern = "/define\(\s*'" . preg_quote($name, '/') . "'\s*,\s*'(?:[^'\\\\]|\\\\.)*'\s*\)/";
    $replace = "define('" . $name . "', '" . admin_php_sq($val) . "')";
    $out = preg_replace($pattern, $replace, $src, 1, $count);
    return $count ? $out : $src;
}
/** Replace the $LEAD['recipients'] array literal. */
function settings_set_recipients(string $src, array $emails): string {
    $list = array_values(array_filter(array_map('trim', $emails), static fn($e) => $e !== '' && filter_var($e, FILTER_VALIDATE_EMAIL)));
    $lines = array_map(static fn($e) => "        '" . admin_php_sq($e) . "'", $list);
    $block = "'recipients' => [\n" . implode(",\n", $lines) . "\n    ]";
    $pattern = "/'recipients'\s*=>\s*\[[^\]]*\]/s";
    $out = preg_replace($pattern, $block, $src, 1, $count);
    return $count ? $out : $src;
}

$CONTACT_FIELDS = ['PHONE_NUMBER' => 'Phone (display)', 'PHONE_NUMBER_RAW' => 'Phone (raw, tel:)', 'EMAIL_ADDRESS' => 'Email', 'ADDRESS' => 'Address'];
$SOCIAL_FIELDS  = ['SOCIAL_FACEBOOK' => 'Facebook', 'SOCIAL_INSTAGRAM' => 'Instagram', 'SOCIAL_LINKEDIN' => 'LinkedIn', 'SOCIAL_TWITTER' => 'X / Twitter', 'SOCIAL_YOUTUBE' => 'YouTube', 'SOCIAL_PINTEREST' => 'Pinterest'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!admin_verify_csrf()) { admin_flash('err', 'Session expired. Try again.'); header('Location: settings.php'); exit; }
    $src = (string)file_get_contents(SITE_CONFIG);
    foreach (array_merge(array_keys($CONTACT_FIELDS), array_keys($SOCIAL_FIELDS)) as $name) {
        if (array_key_exists($name, $_POST)) $src = settings_set_define($src, $name, (string)$_POST[$name]);
    }
    $recips = preg_split('/[\r\n,]+/', (string)($_POST['recipients'] ?? '')) ?: [];
    $src = settings_set_recipients($src, $recips);

    [$ok, $msg] = admin_php_lint($src);
    if (!$ok) { admin_flash('err', 'Config failed PHP lint — not saved. ' . $msg); header('Location: settings.php'); exit; }
    if (admin_replace_site_file(SITE_CONFIG, $src)) admin_flash('ok', 'Settings saved.');
    else admin_flash('err', 'Could not write config.');
    header('Location: settings.php');
    exit;
}

$lead = $GLOBALS['LEAD'] ?? ['recipients' => []];
admin_layout_head('Settings');
?>
<div class="adm-page-head"><div><span class="adm-eyebrow">Configuration</span><h1>Settings</h1><p>Safe site settings — contact details, social links and where leads are emailed. Saved straight into <span class="adm-mono">config.php</span> (backed up + lint-checked first).</p></div></div>

<form method="post">
  <?= admin_csrf_field() ?>
  <div class="adm-grid cols-2">
    <div class="adm-card">
      <div class="adm-card-head"><h2>Contact</h2></div>
      <?php foreach ($CONTACT_FIELDS as $name => $label): ?>
        <div class="adm-field"><label class="adm-label"><?= htmlspecialchars($label) ?></label><input class="adm-input" name="<?= $name ?>" value="<?= htmlspecialchars(defined($name) ? constant($name) : '') ?>"></div>
      <?php endforeach; ?>
    </div>
    <div class="adm-card">
      <div class="adm-card-head"><h2>Social links</h2></div>
      <?php foreach ($SOCIAL_FIELDS as $name => $label): ?>
        <div class="adm-field"><label class="adm-label"><?= htmlspecialchars($label) ?></label><input class="adm-input" name="<?= $name ?>" value="<?= htmlspecialchars(defined($name) ? constant($name) : '') ?>" placeholder="https://…"></div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="adm-card adm-mt">
    <div class="adm-card-head"><h2>Lead notifications</h2></div>
    <div class="adm-field" style="margin-bottom:0"><label class="adm-label">Recipient emails <span class="adm-hint">one per line — form submissions are emailed here</span></label>
      <textarea class="adm-textarea" name="recipients" rows="3"><?= htmlspecialchars(implode("\n", $lead['recipients'] ?? [])) ?></textarea></div>
  </div>

  <div class="adm-mt"><button class="adm-btn adm-btn-cta" type="submit"><i class="fa-regular fa-floppy-disk"></i> Save settings</button></div>
</form>
<?php
admin_layout_foot();
