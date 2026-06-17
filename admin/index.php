<?php
/** Entry point: logged-in -> first accessible module; else -> login. */
require __DIR__ . '/includes/auth.php';
admin_boot();
admin_send_security_headers();
header('Location: ' . (admin_is_logged_in() ? admin_home_url() : 'login.php'));
exit;
