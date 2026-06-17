<?php
require __DIR__ . '/includes/auth.php';
admin_boot();
// CSRF-protect logout: a valid session token must accompany the request so a
// cross-site GET (e.g. <img src=".../logout.php">) cannot force-log-out the admin.
$t = $_GET['t'] ?? ($_POST['csrf'] ?? '');
if (admin_is_logged_in() && !hash_equals($_SESSION['csrf'] ?? '', (string)$t)) {
    header('Location: ' . admin_home_url());
    exit;
}
admin_logout();
header('Location: login.php');
exit;
