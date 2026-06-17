<?php
/**
 * Admin chrome: sidebar shell + topbar. Nav is built from the CURRENT user's
 * accessible modules (RBAC), but access is always enforced server-side too.
 *
 * Usage:
 *   admin_layout_head('Blog Posts');   // after a require_module guard
 *   ... page content ...
 *   admin_layout_foot();               // optional 2nd arg: extra inline JS
 */
require_once __DIR__ . '/auth.php';

function admin_active_key(): string {
    $base = basename($_SERVER['SCRIPT_NAME'] ?? $_SERVER['PHP_SELF'] ?? '');
    return $base;
}

function admin_layout_head(string $pageTitle = 'Admin', array $opts = []): void {
    admin_send_security_headers();
    $user = admin_current_user();
    $active = admin_active_key();
    $mods = admin_modules();
    $userMods = admin_user_modules($user);
    $logo = function_exists('asset') ? asset('images/logo.webp') : '';
    $name = $user['name'] ?? ($user['username'] ?? 'User');
    $roleName = $user['role'] ?? '';
    $roleLabel = '';
    foreach (admin_get_roles() as $r) { if (($r['name'] ?? '') === $roleName) { $roleLabel = $r['label'] ?? $roleName; break; } }
    $initials = strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $name) ?: 'U', 0, 1));
    $brandName = defined('BRAND_NAME') ? BRAND_NAME : 'EU Publishing House';
    $siteHome = function_exists('link_to') ? link_to('index.php') : '/';
    ?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title><?= htmlspecialchars($pageTitle) ?> — <?= htmlspecialchars($brandName) ?> Admin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="assets/admin.css">
<?php if (!empty($opts['head'])) echo $opts['head']; ?>
</head>
<body>
<div class="adm-shell" id="admShell">
  <div class="adm-nav-backdrop" data-nav-close></div>
  <aside class="adm-sidebar">
    <div class="adm-brand">
      <?php if ($logo): ?><img src="<?= htmlspecialchars($logo) ?>" alt="<?= htmlspecialchars($brandName) ?>" onerror="this.style.display='none';this.nextElementSibling.style.display='block'"><?php endif; ?>
      <span class="adm-brand-fallback" <?= $logo ? 'style="display:none"' : '' ?>><?= htmlspecialchars($brandName) ?><small>Admin</small></span>
    </div>
    <nav class="adm-nav">
      <div class="adm-nav-label">Manage</div>
      <?php foreach ($mods as $key => $m): if (!in_array($key, $userMods, true)) continue; ?>
        <a href="<?= htmlspecialchars($m['url']) ?>" class="<?= $active === $m['url'] ? 'is-active' : '' ?>">
          <i class="fa-solid <?= htmlspecialchars($m['icon']) ?>"></i><span><?= htmlspecialchars($m['label']) ?></span>
        </a>
      <?php endforeach; ?>
      <?php if (admin_is_admin()): ?>
        <div class="adm-nav-label">Administration</div>
        <a href="users.php" class="<?= $active === 'users.php' ? 'is-active' : '' ?>"><i class="fa-solid fa-users-gear"></i><span>Roles &amp; Users</span></a>
      <?php endif; ?>
      <div class="adm-nav-label">Account</div>
      <a href="account.php" class="<?= $active === 'account.php' ? 'is-active' : '' ?>"><i class="fa-solid fa-id-badge"></i><span>My Account</span></a>
    </nav>
    <a class="adm-viewsite" href="<?= htmlspecialchars($siteHome) ?>" target="_blank" rel="noopener"><i class="fa-solid fa-up-right-from-square"></i> View website</a>
    <div class="adm-user">
      <span class="adm-avatar"><?= htmlspecialchars($initials) ?></span>
      <div class="adm-user-meta">
        <strong><?= htmlspecialchars($name) ?></strong>
        <span><?= htmlspecialchars($roleLabel) ?></span>
      </div>
      <a class="adm-logout" href="logout.php?t=<?= urlencode(admin_csrf_token()) ?>" title="Log out"><i class="fa-solid fa-right-from-bracket"></i></a>
    </div>
  </aside>

  <div class="adm-main">
    <div class="adm-topbar">
      <button class="adm-burger" data-nav-toggle aria-label="Open menu"><i class="fa-solid fa-bars"></i></button>
      <strong style="font-family:var(--adm-serif);font-style:italic;color:var(--adm-accent)"><?= htmlspecialchars($pageTitle) ?></strong>
      <a class="adm-btn adm-btn-icon adm-btn-ghost" href="logout.php?t=<?= urlencode(admin_csrf_token()) ?>" title="Log out"><i class="fa-solid fa-right-from-bracket"></i></a>
    </div>
    <main class="adm-content">
<?php
    $__f = function_exists('admin_take_flash') ? admin_take_flash() : null;
    if ($__f) {
        $cls = $__f['type'] === 'err' ? 'err' : ($__f['type'] === 'warn' ? 'warn' : 'ok');
        $ico = $__f['type'] === 'err' ? 'circle-exclamation' : ($__f['type'] === 'warn' ? 'triangle-exclamation' : 'circle-check');
        echo '<div class="adm-alert ' . $cls . '"><i class="fa-solid fa-' . $ico . '"></i><span>' . htmlspecialchars($__f['msg']) . '</span></div>';
    }
}

function admin_layout_foot(string $inlineJs = ''): void {
    ?>
    </main>
  </div>
</div>
<div class="adm-toasts" id="admToasts"></div>
<script>window.ADM_CSRF = <?= json_encode(admin_csrf_token()) ?>;</script>
<script src="assets/admin.js"></script>
<?php if ($inlineJs !== ''): ?><script><?= $inlineJs ?></script><?php endif; ?>
</body>
</html>
<?php
}
