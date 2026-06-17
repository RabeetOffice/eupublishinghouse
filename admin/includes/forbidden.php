<?php
/** 403 page — links back to the user's own accessible home. */
require_once __DIR__ . '/auth.php';
admin_boot();
admin_send_security_headers();
$home = admin_is_logged_in() ? admin_home_url() : 'login.php';
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title>Access denied — EU Publishing House Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="assets/admin.css">
</head>
<body>
<div class="adm-login-wrap">
  <div class="adm-login-card" style="text-align:center">
    <div style="font-size:2.4rem;color:var(--adm-gold)"><i class="fa-solid fa-lock"></i></div>
    <h1>Access denied</h1>
    <p class="adm-sub">You don&rsquo;t have permission to view this section. If you think this is a mistake, ask a super admin to adjust your role.</p>
    <a class="adm-btn adm-btn-cta" href="<?= htmlspecialchars($home, ENT_QUOTES) ?>">Back to your dashboard <i class="fa-solid fa-arrow-right"></i></a>
  </div>
</div>
</body>
</html>
