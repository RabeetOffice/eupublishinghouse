<?php
/**
 * EU Publishing House — Admin authentication, RBAC, CSRF, throttle, 2FA.
 *
 * Every admin page does, at the very top:
 *     require __DIR__ . '/includes/auth.php';   // (or ../includes from a subdir)
 *     admin_require_module('posts');             // or admin_require_admin() / admin_require_login()
 */

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/totp.php';

define('ADMIN_USERS_FILE',    ADMIN_DATA . '/users.json');
define('ADMIN_ROLES_FILE',    ADMIN_DATA . '/roles.json');
define('ADMIN_THROTTLE_FILE',  ADMIN_DATA . '/login-attempts.json');
define('ADMIN_SESSION_NAME',  'EUPHADM');
define('ADMIN_ISSUER',        'EU Publishing House Admin');

/* ===========================================================================
   MODULE REGISTRY — every section is a "module". Nav + RBAC are driven by this.
   (Only the modules this brand actually has. No video testimonials module.)
=========================================================================== */
function admin_modules(): array {
    return [
        'dashboard'    => ['label' => 'Dashboard',    'icon' => 'fa-gauge-high', 'url' => 'dashboard.php'],
        'posts'        => ['label' => 'Blog Posts',   'icon' => 'fa-feather',    'url' => 'posts.php'],
        'submissions'  => ['label' => 'Submissions',  'icon' => 'fa-inbox',      'url' => 'submissions.php'],
        'portfolio'    => ['label' => 'Portfolio',    'icon' => 'fa-book-open',  'url' => 'portfolio.php'],
        'testimonials' => ['label' => 'Testimonials', 'icon' => 'fa-quote-right','url' => 'testimonials.php'],
        'authors'      => ['label' => 'Authors',      'icon' => 'fa-user-pen',   'url' => 'authors.php'],
        'settings'     => ['label' => 'Settings',     'icon' => 'fa-sliders',    'url' => 'settings.php'],
    ];
}
function admin_module_keys(): array { return array_keys(admin_modules()); }

/* ===========================================================================
   BOOT — dirs, first-run seeds, session, security headers
=========================================================================== */
function admin_boot(): void {
    static $done = false;
    if ($done) return;
    $done = true;
    admin_ensure_dirs();
    admin_bootstrap_seeds();
    admin_session_start();
}

function admin_session_start(): void {
    if (session_status() === PHP_SESSION_ACTIVE) return;
    $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (($_SERVER['SERVER_PORT'] ?? '') == 443);
    session_name(ADMIN_SESSION_NAME);
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'httponly' => true,
        'samesite' => 'Lax',
        'secure'   => $https,
    ]);
    @session_start();
}

function admin_send_security_headers(): void {
    if (headers_sent()) return;
    header('X-Robots-Tag: noindex, nofollow', true);
    header('X-Frame-Options: DENY', true);
    header('X-Content-Type-Options: nosniff', true);
    header('Referrer-Policy: no-referrer', true);
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0', true);
}

/** Seed roles.json + users.json on first run. Plaintext creds are written ONCE
    to data/INITIAL-LOGIN.txt (web-blocked) for the owner to read, then delete. */
function admin_bootstrap_seeds(): void {
    if (!is_file(ADMIN_ROLES_FILE)) {
        admin_json_write(ADMIN_ROLES_FILE, ['roles' => [
            ['name' => 'super-admin', 'label' => 'Super Admin', 'modules' => ['*'], 'locked' => true],
            ['name' => 'editor',      'label' => 'Blog Editor',  'modules' => ['posts']],
        ]]);
    }
    if (!is_file(ADMIN_USERS_FILE)) {
        $adminPw  = admin_random_password();
        $editorPw = admin_random_password();
        $now = date('c');
        admin_json_write(ADMIN_USERS_FILE, ['users' => [
            admin_new_user_record('admin',  'Administrator', $adminPw,  'super-admin', $now),
            admin_new_user_record('editor', 'Blog Editor',   $editorPw, 'editor',      $now),
        ]]);
        $txt = "EU Publishing House — Admin initial login\n"
            . "Generated: {$now}\n"
            . str_repeat('-', 48) . "\n"
            . "Super Admin:  username = admin    password = {$adminPw}\n"
            . "Blog Editor:  username = editor   password = {$editorPw}\n"
            . str_repeat('-', 48) . "\n"
            . "Log in at /admin/ , change these passwords (My Account), then\n"
            . "DELETE this file. It lives in admin/data/ which is web-blocked.\n";
        @file_put_contents(ADMIN_DATA . '/INITIAL-LOGIN.txt', $txt);
    }
}

function admin_random_password(int $words = 0): string {
    // 16-char strong random password.
    $alpha = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz23456789!@#%?';
    $out = '';
    for ($i = 0; $i < 16; $i++) { $out .= $alpha[random_int(0, strlen($alpha) - 1)]; }
    return $out;
}

function admin_new_user_record(string $username, string $name, string $plainPw, string $role, ?string $created = null): array {
    return [
        'username'     => $username,
        'name'         => $name,
        'password'     => password_hash($plainPw, PASSWORD_BCRYPT),
        'role'         => $role,
        'totp_enabled' => false,
        'totp_secret'  => null,
        'backup_codes' => [],
        'created'      => $created ?? date('c'),
    ];
}

/* ===========================================================================
   USERS + ROLES storage
=========================================================================== */
function admin_get_users(): array {
    $d = admin_json_read(ADMIN_USERS_FILE, ['users' => []]);
    return $d['users'] ?? [];
}
function admin_save_users(array $users): bool {
    return admin_json_write(ADMIN_USERS_FILE, ['users' => array_values($users)]);
}
function admin_find_user(string $username): ?array {
    foreach (admin_get_users() as $u) {
        if (strcasecmp($u['username'] ?? '', $username) === 0) return $u;
    }
    return null;
}
function admin_upsert_user(array $user): bool {
    $users = admin_get_users();
    $found = false;
    foreach ($users as $i => $u) {
        if (strcasecmp($u['username'] ?? '', $user['username']) === 0) { $users[$i] = $user; $found = true; break; }
    }
    if (!$found) $users[] = $user;
    return admin_save_users($users);
}

function admin_get_roles(): array {
    $d = admin_json_read(ADMIN_ROLES_FILE, ['roles' => []]);
    return $d['roles'] ?? [];
}
function admin_save_roles(array $roles): bool {
    return admin_json_write(ADMIN_ROLES_FILE, ['roles' => array_values($roles)]);
}
function admin_role(string $name): ?array {
    foreach (admin_get_roles() as $r) { if (($r['name'] ?? '') === $name) return $r; }
    return null;
}

/** Resolve a user's accessible module keys. Missing role => ZERO modules (fail-closed). */
function admin_user_modules(?array $user): array {
    if (!$user) return [];
    $role = admin_role($user['role'] ?? '');
    if (!$role) return [];
    $mods = $role['modules'] ?? [];
    if (in_array('*', $mods, true)) return admin_module_keys();
    return array_values(array_intersect($mods, admin_module_keys()));
}

function admin_role_is_super(?array $role): bool {
    return $role && in_array('*', $role['modules'] ?? [], true);
}

/* ===========================================================================
   CURRENT USER / LOGIN STATE
=========================================================================== */
function admin_current_user(): ?array {
    admin_boot();
    if (empty($_SESSION['admin_user'])) return null;
    // Re-read from store so role/permission changes apply immediately.
    $u = admin_find_user($_SESSION['admin_user']);
    return $u ?: null;
}
function admin_is_logged_in(): bool { return admin_current_user() !== null; }

function admin_is_admin(): bool {
    $u = admin_current_user();
    if (!$u) return false;
    return admin_role_is_super(admin_role($u['role'] ?? ''));
}
function admin_can(string $module): bool {
    return in_array($module, admin_user_modules(admin_current_user()), true);
}

function admin_login_user(array $user): void {
    admin_boot();
    session_regenerate_id(true);
    $_SESSION['admin_user'] = $user['username'];
    $_SESSION['admin_login_at'] = time();
    unset($_SESSION['pending_2fa'], $_SESSION['pending_user']);
}
function admin_logout(): void {
    admin_boot();
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
    }
    @session_destroy();
}

/** First accessible module URL — never land a user on a 403. */
function admin_home_url(): string {
    $mods = admin_user_modules(admin_current_user());
    $registry = admin_modules();
    foreach ($mods as $m) { if (isset($registry[$m])) return $registry[$m]['url']; }
    return 'account.php';
}

/* ===========================================================================
   GUARDS
=========================================================================== */
function admin_require_login(): void {
    admin_boot();
    admin_send_security_headers();
    if (!admin_is_logged_in()) {
        header('Location: login.php');
        exit;
    }
}
function admin_require_module(string $module): void {
    admin_require_login();
    if (!admin_can($module)) admin_forbidden();
}
function admin_require_admin(): void {
    admin_require_login();
    if (!admin_is_admin()) admin_forbidden();
}
function admin_forbidden(): void {
    http_response_code(403);
    require ADMIN_DIR . '/includes/forbidden.php';
    exit;
}

/* ===========================================================================
   CSRF
=========================================================================== */
function admin_csrf_token(): string {
    admin_boot();
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = admin_token(32);
    return $_SESSION['csrf'];
}
function admin_csrf_field(): string {
    return '<input type="hidden" name="csrf" value="' . htmlspecialchars(admin_csrf_token(), ENT_QUOTES, 'UTF-8') . '">';
}
function admin_verify_csrf(): bool {
    admin_boot();
    $sent = $_POST['csrf'] ?? ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
    $have = $_SESSION['csrf'] ?? '';
    return $have !== '' && is_string($sent) && hash_equals($have, $sent);
}
/** Enforce CSRF on a state-changing request; 419 + exit on mismatch. */
function admin_require_csrf(): void {
    if (!admin_verify_csrf()) {
        http_response_code(419);
        header('Content-Type: application/json');
        echo json_encode(['ok' => false, 'error' => 'Session expired. Please reload and try again.']);
        exit;
    }
}

/* ===========================================================================
   LOGIN THROTTLE — 5 fails per (IP+key) => 15-min lockout
=========================================================================== */
function admin_client_ip(): string {
    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
}
function admin_is_loopback(): bool {
    return in_array(admin_client_ip(), ['127.0.0.1', '::1', '::ffff:127.0.0.1'], true);
}
function admin_throttle_key(string $scope, string $user): string {
    return $scope . '|' . admin_client_ip() . '|' . strtolower($user);
}
/** @return int  Seconds remaining in lockout, or 0 if not locked. */
function admin_throttle_locked(string $key): int {
    $data = admin_json_read(ADMIN_THROTTLE_FILE, []);
    $rec = $data[$key] ?? null;
    if (!$rec) return 0;
    $until = (int)($rec['until'] ?? 0);
    return $until > time() ? $until - time() : 0;
}
function admin_throttle_hit(string $key, int $max = 5, int $lock = 900): void {
    $data = admin_json_read(ADMIN_THROTTLE_FILE, []);
    $now = time();
    $rec = $data[$key] ?? ['count' => 0, 'first' => $now, 'until' => 0];
    // Reset the window ONLY after a real lockout has expired — never reset on
    // age before a lockout fires, or a paced attacker would never get locked.
    if (($rec['until'] ?? 0) !== 0 && ($rec['until'] ?? 0) < $now) {
        $rec = ['count' => 0, 'first' => $now, 'until' => 0];
    }
    $rec['count'] = (int)($rec['count'] ?? 0) + 1;
    if ($rec['count'] >= $max) { $rec['until'] = $now + $lock; }
    $data[$key] = $rec;
    admin_json_write(ADMIN_THROTTLE_FILE, $data);
}
function admin_throttle_clear(string $key): void {
    $data = admin_json_read(ADMIN_THROTTLE_FILE, []);
    if (isset($data[$key])) { unset($data[$key]); admin_json_write(ADMIN_THROTTLE_FILE, $data); }
}

/* ===========================================================================
   reCAPTCHA — reuse the brand helpers. Skip ONLY for real loopback requests
   (REMOTE_ADDR), never the spoofable Host header.
=========================================================================== */
function admin_recaptcha_verify(string $token): bool {
    if (admin_is_loopback()) return true;            // local dev: site key is domain-locked
    $file = SITE_ROOT . '/includes/recaptcha.php';
    if (!is_file($file)) return true;
    require_once $file;
    if (empty($GLOBALS['RECAPTCHA']['site_key'])) return true;
    if (!function_exists('recaptcha_verify')) return true;
    $res = recaptcha_verify($token, 'admin_login');
    return !empty($res['success']);
}

/* ===========================================================================
   2FA helpers (TOTP + single-use backup codes)
=========================================================================== */
function admin_generate_backup_codes(int $n = 8): array {
    $codes = [];
    for ($i = 0; $i < $n; $i++) {
        $raw = strtolower(bin2hex(random_bytes(4)));      // 8 hex chars
        $codes[] = substr($raw, 0, 4) . '-' . substr($raw, 4, 4);
    }
    return $codes;
}
function admin_hash_backup_codes(array $plain): array {
    return array_map(static function ($c) {
        return ['hash' => password_hash($c, PASSWORD_BCRYPT), 'used' => false];
    }, $plain);
}
/** Try to consume a backup code for $user; returns true and persists on success. */
function admin_consume_backup_code(string $username, string $code): bool {
    $code = strtolower(trim($code));
    $users = admin_get_users();
    foreach ($users as $i => $u) {
        if (strcasecmp($u['username'] ?? '', $username) !== 0) continue;
        foreach (($u['backup_codes'] ?? []) as $j => $bc) {
            if (!empty($bc['used'])) continue;
            if (password_verify($code, $bc['hash'] ?? '')) {
                $users[$i]['backup_codes'][$j]['used'] = true;
                admin_save_users($users);
                return true;
            }
        }
        return false;
    }
    return false;
}
/** Verify a login-time second factor: TOTP code OR an unused backup code. */
function admin_verify_second_factor(array $user, string $code): bool {
    $secret = $user['totp_secret'] ?? '';
    if ($secret !== '' && totp_verify($secret, $code, 1)) return true;
    return admin_consume_backup_code($user['username'], $code);
}

/* ===========================================================================
   Flash messages (one-shot, shown on the next page render)
=========================================================================== */
function admin_flash(string $type, string $msg): void {
    admin_boot();
    $_SESSION['flash'] = ['type' => $type, 'msg' => $msg];
}
function admin_take_flash(): ?array {
    admin_boot();
    $f = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return is_array($f) ? $f : null;
}
