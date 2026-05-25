<?php
/* =================================================================
   FORM SUBMISSION HANDLER — EU Publishing House
   Receives POST from manuscript-popup.php, contact-form.php,
   quote-card.php and any other form that includes recaptcha_field().
   On success → redirects to thank-you.php; on failure → back to the
   source page with ?form_status=<code>.
================================================================= */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/recaptcha.php';
require_once __DIR__ . '/includes/smtp-mailer.php';

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    header('Location: index.php');
    exit;
}

/* ---------------------------------------------------------------------------
 *  Helpers
 * ------------------------------------------------------------------------- */

function field_value(string $key): string {
    $v = $_POST[$key] ?? '';
    if (is_array($v)) return implode(', ', array_map('trim', $v));
    return trim((string) $v);
}

function client_ip(): string {
    foreach (['HTTP_CF_CONNECTING_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'] as $k) {
        if (empty($_SERVER[$k])) continue;
        $v = trim((string) $_SERVER[$k]);
        if ($k === 'HTTP_X_FORWARDED_FOR') $v = trim(explode(',', $v)[0]);
        return $v;
    }
    return '';
}

/** Match the reCAPTCHA action label to the form type so the server-side
 *  verification rejects token re-use across forms. */
function expected_recaptcha_action(string $formType): string {
    return [
        'popup'        => 'popup_quote',
        'manuscript'   => 'manuscript_submission',
        'contact'      => 'contact_form',
        'quote_card'   => 'quote_card',
        'newsletter'   => 'newsletter_signup',
    ][$formType] ?? 'submit';
}

/* ---------------------------------------------------------------------------
 *  Manuscript upload — hardened validator
 *
 *  Defence layers (in order, fail-fast):
 *    1. PHP upload error code check
 *    2. Size cap (20 MB) + is_uploaded_file() (mitigates path injection)
 *    3. Filename hygiene — null byte, path traversal, control chars, double-ext
 *    4. Extension whitelist
 *    5. MIME-type detection via finfo
 *    6. Magic-byte signature check
 *    7. Embedded-script scan for plain-text files (rtf/txt)
 *    8. Optional ClamAV virus scan
 * ------------------------------------------------------------------------- */

function manuscript_extension_whitelist(): array {
    return ['doc','docx','ppt','pptx','pdf','pages','odt','txt','rtf'];
}

function manuscript_blocked_extensions(): array {
    return ['php','phtml','phar','php3','php4','php5','php7','php8','pht',
            'html','htm','xhtml','svg','jsp','jspx','asp','aspx','cer',
            'sh','bash','bat','cmd','com','exe','dll','msi','jar','war','ear',
            'js','vbs','wsf','wsh','hta','reg','scr','cpl','ps1','psm1','pl',
            'py','rb','cgi','swf','ttf','otf','eot','htaccess'];
}

function manuscript_check_magic_bytes(string $path, string $ext): bool {
    $h = @file_get_contents($path, false, null, 0, 16);
    if ($h === false || $h === '') return false;

    switch ($ext) {
        case 'pdf':
            return strncmp($h, '%PDF-', 5) === 0;

        case 'docx': case 'pptx': case 'odt': case 'pages':
            return strncmp($h, "PK\x03\x04", 4) === 0
                || strncmp($h, "PK\x05\x06", 4) === 0
                || strncmp($h, "PK\x07\x08", 4) === 0;

        case 'doc': case 'ppt':
            return strncmp($h, "\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1", 8) === 0;

        case 'rtf':
            return strncmp($h, '{\\rtf', 5) === 0;

        case 'txt':
            $sample = (string) @file_get_contents($path, false, null, 0, 4096);
            return strpos($sample, "\0") === false;
    }
    return false;
}

function manuscript_mime_allowed(string $detected, string $ext): bool {
    $allowed = [
        'pdf'   => ['application/pdf', 'application/x-pdf'],
        'doc'   => ['application/msword',
                    'application/vnd.ms-office',
                    'application/x-ole-storage',
                    'application/CDFV2',
                    'application/x-cfb'],
        'docx'  => ['application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'application/zip',
                    'application/x-zip',
                    'application/octet-stream'],
        'ppt'   => ['application/vnd.ms-powerpoint',
                    'application/vnd.ms-office',
                    'application/x-ole-storage',
                    'application/CDFV2',
                    'application/x-cfb'],
        'pptx'  => ['application/vnd.openxmlformats-officedocument.presentationml.presentation',
                    'application/zip',
                    'application/x-zip',
                    'application/octet-stream'],
        'odt'   => ['application/vnd.oasis.opendocument.text',
                    'application/zip',
                    'application/x-zip'],
        'pages' => ['application/zip', 'application/x-zip', 'application/octet-stream'],
        'txt'   => ['text/plain', 'text/x-c', 'text/x-c++', 'text/x-shellscript', 'inode/x-empty'],
        'rtf'   => ['text/rtf', 'application/rtf', 'text/plain'],
    ];
    if ($detected === '' || empty($allowed[$ext])) return true;
    return in_array(strtolower($detected), $allowed[$ext], true);
}

function manuscript_clamav_scan(string $path): string {
    if (!function_exists('shell_exec')) return 'unscanned';
    static $cached = null;
    if ($cached === null) {
        $cached = [];
        $finder = stripos(PHP_OS, 'WIN') === 0 ? 'where' : 'command -v';
        foreach (['clamdscan', 'clamscan'] as $bin) {
            $found = @shell_exec($finder . ' ' . escapeshellarg($bin) . ' 2>' . (stripos(PHP_OS,'WIN')===0 ? 'NUL' : '/dev/null'));
            if ($found !== null && trim((string) $found) !== '') {
                $cached[] = $bin;
            }
        }
    }
    if (empty($cached)) return 'unscanned';

    foreach ($cached as $bin) {
        $cmd = $bin . ' --no-summary --stdout ' . escapeshellarg($path) . ' 2>&1';
        $out = (string) @shell_exec($cmd);
        if ($out === '') continue;
        if (stripos($out, 'FOUND') !== false)        return 'infected';
        if (stripos($out, 'Infected files: 0') !== false) return 'clean';
        if (stripos($out, ': OK') !== false)         return 'clean';
    }
    return 'unscanned';
}

function handle_manuscript_upload(string $field = 'manuscript_file'): array {
    if (!isset($_FILES[$field])) return ['ok' => false, 'reason' => 'no-file'];
    $f = $_FILES[$field];

    $err = (int) ($f['error'] ?? UPLOAD_ERR_NO_FILE);
    if ($err === UPLOAD_ERR_NO_FILE) return ['ok' => false, 'reason' => 'no-file'];
    if ($err === UPLOAD_ERR_INI_SIZE || $err === UPLOAD_ERR_FORM_SIZE) {
        return ['ok' => false, 'reason' => 'too-large'];
    }
    if ($err !== UPLOAD_ERR_OK) {
        return ['ok' => false, 'reason' => 'upload-error-' . $err];
    }

    $maxBytes = 20 * 1024 * 1024;
    $size = (int) ($f['size'] ?? 0);
    if ($size <= 0 || $size > $maxBytes) {
        return ['ok' => false, 'reason' => 'bad-size'];
    }
    $tmp = (string) ($f['tmp_name'] ?? '');
    if (!is_uploaded_file($tmp)) {
        return ['ok' => false, 'reason' => 'not-uploaded'];
    }

    $raw = (string) ($f['name'] ?? '');
    if ($raw === '' || strlen($raw) > 255) {
        return ['ok' => false, 'reason' => 'bad-filename'];
    }
    if (strpos($raw, "\0") !== false) {
        return ['ok' => false, 'reason' => 'null-byte'];
    }
    if (preg_match('#[/\\\\:]#', $raw)) {
        return ['ok' => false, 'reason' => 'bad-filename'];
    }
    $clean = preg_replace('/[\x00-\x1F\x7F]/', '', $raw);
    $clean = basename($clean);
    $blocked = manuscript_blocked_extensions();
    $parts   = explode('.', strtolower($clean));
    array_shift($parts);
    foreach ($parts as $p) {
        if (in_array($p, $blocked, true)) {
            return ['ok' => false, 'reason' => 'forbidden-extension'];
        }
    }

    $ext = strtolower(pathinfo($clean, PATHINFO_EXTENSION));
    if (!in_array($ext, manuscript_extension_whitelist(), true)) {
        return ['ok' => false, 'reason' => 'bad-extension'];
    }

    $detected = '';
    if (function_exists('finfo_open')) {
        $fi = finfo_open(FILEINFO_MIME_TYPE);
        if ($fi) {
            $detected = (string) finfo_file($fi, $tmp);
            finfo_close($fi);
        }
    }
    if (!manuscript_mime_allowed($detected, $ext)) {
        error_log('[upload] MIME mismatch — ext=' . $ext . ' detected=' . $detected);
        return ['ok' => false, 'reason' => 'mime-mismatch'];
    }

    if (!manuscript_check_magic_bytes($tmp, $ext)) {
        error_log('[upload] magic-bytes failed for ext=' . $ext);
        return ['ok' => false, 'reason' => 'bad-signature'];
    }

    if (in_array($ext, ['txt', 'rtf'], true)) {
        $head = (string) @file_get_contents($tmp, false, null, 0, 8192);
        if (preg_match('/<\?php\b|<\?=|<script\b|eval\s*\(|base64_decode\s*\(|system\s*\(|shell_exec\s*\(|passthru\s*\(|`[^`]+`/i', $head)) {
            error_log('[upload] suspicious-content detected in ' . $ext);
            return ['ok' => false, 'reason' => 'suspicious-content'];
        }
    }

    $scan = manuscript_clamav_scan($tmp);
    if ($scan === 'infected') {
        return ['ok' => false, 'reason' => 'virus-detected'];
    }

    $stem = pathinfo($clean, PATHINFO_FILENAME);
    $safeStem = preg_replace('/[^A-Za-z0-9._\- ]+/', '_', $stem);
    $safeStem = trim(preg_replace('/\s+/', ' ', $safeStem));
    $safeStem = substr($safeStem, 0, 60);
    if ($safeStem === '') $safeStem = 'manuscript';
    $finalName = $safeStem . '.' . $ext;

    return [
        'ok'      => true,
        'path'    => $tmp,
        'name'    => $finalName,
        'size'    => $size,
        'mime'    => $detected ?: 'unknown',
        'scanned' => $scan,
    ];
}

function redirect_back(string $status): void {
    if ($status === 'success') {
        header('Location: thank-you.php');
        exit;
    }
    $target = field_value('source_page')
        ?: ($_SERVER['HTTP_REFERER'] ?? 'index.php');
    $target = trim($target) ?: 'index.php';
    $sep = str_contains($target, '?') ? '&' : '?';
    header('Location: ' . $target . $sep . 'form_status=' . rawurlencode($status));
    exit;
}

function log_lead_to_db(array $lead): void {
    global $DB;
    if (empty($DB['host']) || empty($DB['name'])) return;
    try {
        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s',
            $DB['host'], $DB['name'], $DB['charset'] ?? 'utf8mb4');
        $pdo = new PDO($dsn, $DB['user'] ?? '', $DB['pass'] ?? '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
        $pdo->exec(
            "CREATE TABLE IF NOT EXISTS leads (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                form_type VARCHAR(100) NULL,
                name VARCHAR(255) NULL,
                email VARCHAR(255) NULL,
                phone VARCHAR(100) NULL,
                country VARCHAR(120) NULL,
                book_title VARCHAR(255) NULL,
                genre VARCHAR(120) NULL,
                service VARCHAR(255) NULL,
                source VARCHAR(255) NULL,
                message TEXT NULL,
                manuscript_file VARCHAR(255) NULL,
                page_url TEXT NULL,
                ip_address VARCHAR(100) NULL,
                user_agent TEXT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
        );
        $stmt = $pdo->prepare(
            'INSERT INTO leads (form_type, name, email, phone, country, book_title, genre, service, source, message, manuscript_file, page_url, ip_address, user_agent)
             VALUES (:form_type,:name,:email,:phone,:country,:book_title,:genre,:service,:source,:message,:manuscript_file,:page_url,:ip_address,:user_agent)'
        );
        $stmt->execute([
            'form_type'       => $lead['form_type'],
            'name'            => $lead['name'],
            'email'           => $lead['email'],
            'phone'           => $lead['phone'],
            'country'         => $lead['country'] ?? '',
            'book_title'      => $lead['book_title'] ?? '',
            'genre'           => $lead['genre'] ?? '',
            'service'         => $lead['service'] ?? '',
            'source'          => $lead['source'] ?? '',
            'message'         => $lead['message'] ?? '',
            'manuscript_file' => $lead['manuscript_file'] ?? '',
            'page_url'        => $lead['page_url'] ?? '',
            'ip_address'      => $lead['ip_address'] ?? '',
            'user_agent'      => $lead['user_agent'] ?? '',
        ]);
    } catch (Throwable $e) {
        error_log('[lead-db] ' . $e->getMessage());
    }
}

/* ---------------------------------------------------------------------------
 *  Email — branded HTML template using EU Publishing House design tokens
 * ------------------------------------------------------------------------- */

function lead_form_label(string $formType): string {
    return [
        'popup'        => 'Manuscript Popup',
        'manuscript'   => 'Manuscript Submission',
        'contact'      => 'Contact Page',
        'quote_card'   => 'Quote Card',
        'newsletter'   => 'Newsletter Signup',
        'footer'       => 'Footer Form',
    ][$formType] ?? ucwords(str_replace('_', ' ', $formType ?: 'Website'));
}

function lead_field_labels(): array {
    return [
        'name'             => 'Full Name',
        'email'            => 'Email',
        'phone'            => 'Phone',
        'country'          => 'Country',
        'book_title'       => 'Book Title',
        'genre'            => 'Genre',
        'service'          => 'Service Interested In',
        'source'           => 'How They Heard About Us',
        'message'          => 'Message',
        'manuscript_file'  => 'Manuscript Attached',
    ];
}

function lead_visible_rows(array $lead): array {
    $rows = [];
    foreach (lead_field_labels() as $k => $label) {
        $v = trim((string)($lead[$k] ?? ''));
        if ($v === '') continue;
        $rows[] = ['label' => $label, 'value' => $v, 'key' => $k];
    }
    return $rows;
}

function build_lead_text(array $lead): string {
    $lines = [
        'New lead from ' . BRAND_NAME,
        'Source: ' . lead_form_label($lead['form_type']),
        'Received: ' . date('j F Y, H:i') . ' (Europe/Dublin)',
        str_repeat('=', 60),
        '',
    ];
    foreach (lead_visible_rows($lead) as $row) {
        $lines[] = $row['label'] . ': ' . $row['value'];
    }
    $lines[] = '';
    $lines[] = str_repeat('-', 60);
    if (!empty($lead['page_url']))   $lines[] = 'Submitted from: ' . $lead['page_url'];
    if (!empty($lead['ip_address'])) $lines[] = 'IP: ' . $lead['ip_address'];
    return implode("\r\n", $lines);
}

function build_lead_html(array $lead): string {
    /* Palette borrowed from EU Publishing House brand tokens */
    $brandName   = e(BRAND_NAME);
    $brandSite   = e(rtrim(BRAND_SITE_URL, '/'));
    $primary     = BRAND_PRIMARY;        // forest green #1B5340
    $primary2    = BRAND_PRIMARY_2;      // darker  #0F3E2E
    $leaf        = BRAND_LEAF;           // accent #6CB04C
    $gold        = BRAND_GOLD;           // gold accent
    $bodyBg      = BRAND_IVORY;          // ivory background
    $cardBg      = '#ffffff';
    $textDark    = BRAND_TEXT;
    $textMuted   = BRAND_MUTED;
    $hairline    = '#ece8de';

    $sourceLabel = e(lead_form_label($lead['form_type']));
    $receivedAt  = e(date('j F Y, H:i')) . ' <span style="color:' . $textMuted . ';">(Europe/Dublin)</span>';
    $name        = e($lead['name'] ?: 'A new visitor');
    $emailAddr   = e($lead['email']);
    $emailLink   = $emailAddr !== '' ? 'mailto:' . $emailAddr : '';

    $rowsHtml = '';
    foreach (lead_visible_rows($lead) as $row) {
        $label = e($row['label']);
        $val   = e($row['value']);
        if ($row['key'] === 'email') {
            $val = '<a href="mailto:' . $val . '" style="color:' . $primary . ';text-decoration:none;font-weight:600;">' . $val . '</a>';
        } elseif ($row['key'] === 'phone') {
            $tel = preg_replace('/[^0-9+]/', '', $row['value']);
            $val = '<a href="tel:' . e($tel) . '" style="color:' . $primary . ';text-decoration:none;font-weight:600;">' . $val . '</a>';
        } elseif ($row['key'] === 'message') {
            $val = nl2br($val);
        }
        $rowsHtml .= '<tr>'
            . '<td style="padding:14px 18px;border-bottom:1px solid ' . $hairline . ';font-size:12px;color:' . $textMuted . ';font-weight:700;text-transform:uppercase;letter-spacing:.6px;width:180px;vertical-align:top;">' . $label . '</td>'
            . '<td style="padding:14px 18px;border-bottom:1px solid ' . $hairline . ';font-size:15px;color:' . $textDark . ';line-height:1.55;vertical-align:top;">' . $val . '</td>'
            . '</tr>';
    }
    if ($rowsHtml === '') {
        $rowsHtml = '<tr><td style="padding:18px;color:' . $textMuted . ';font-size:14px;">No fields were submitted.</td></tr>';
    }

    $metaRows = [];
    if (!empty($lead['page_url'])) {
        $url = e($lead['page_url']);
        $metaRows[] = 'Page: <a href="' . $url . '" style="color:' . $primary . ';">' . $url . '</a>';
    }
    if (!empty($lead['ip_address'])) {
        $metaRows[] = 'IP: ' . e($lead['ip_address']);
    }
    if (!empty($lead['user_agent'])) {
        $metaRows[] = 'UA: ' . e(substr($lead['user_agent'], 0, 120));
    }
    $metaHtml = $metaRows
        ? '<p style="margin:0;font-size:12px;color:' . $textMuted . ';line-height:1.7;">' . implode(' &nbsp;&middot;&nbsp; ', $metaRows) . '</p>'
        : '';

    $replyCta = '';
    if ($emailLink !== '') {
        $replyCta = '<table role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin:24px auto 0;">'
            . '<tr><td style="border-radius:999px;background:' . $primary . ';background-image:linear-gradient(135deg,' . $primary . ',' . $primary2 . ');">'
            . '<a href="' . e($emailLink) . '" style="display:inline-block;padding:13px 30px;color:#fff;text-decoration:none;font-size:14px;font-weight:700;letter-spacing:.4px;">'
            . 'Reply to ' . e($lead['name'] ?: 'Lead')
            . '</a></td></tr></table>';
    }

    return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>New Lead &mdash; {$brandName}</title>
</head>
<body style="margin:0;padding:0;background:{$bodyBg};font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif;color:{$textDark};">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background:{$bodyBg};padding:32px 16px;">
        <tr><td align="center">
            <table role="presentation" width="600" cellspacing="0" cellpadding="0" border="0" style="max-width:600px;width:100%;background:{$cardBg};border-radius:16px;overflow:hidden;box-shadow:0 6px 30px rgba(15,62,46,.10);">
                <tr><td style="background:{$primary};background-image:linear-gradient(135deg,{$primary},{$primary2});padding:24px 32px;">
                    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <td style="color:#fff;font-size:13px;font-weight:700;letter-spacing:1.4px;text-transform:uppercase;">New Lead</td>
                            <td align="right" style="color:rgba(255,255,255,.75);font-size:12px;">{$brandName}</td>
                        </tr>
                    </table>
                </td></tr>

                <tr><td style="padding:34px 32px 18px;">
                    <h1 style="margin:0 0 6px;font-size:24px;line-height:1.25;color:{$textDark};font-weight:700;">{$name} just got in touch</h1>
                    <p style="margin:0;font-size:14px;color:{$textMuted};">via <strong style="color:{$primary};">{$sourceLabel}</strong> &nbsp;&middot;&nbsp; {$receivedAt}</p>
                </td></tr>

                <tr><td style="padding:0 32px 8px;">
                    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="border:1px solid {$hairline};border-radius:12px;overflow:hidden;">
                        {$rowsHtml}
                    </table>
                </td></tr>

                <tr><td style="padding:0 32px 28px;text-align:center;">{$replyCta}</td></tr>

                <tr><td style="padding:18px 32px 28px;border-top:1px solid {$hairline};">{$metaHtml}</td></tr>
            </table>

            <p style="margin:18px auto 0;max-width:600px;font-size:11px;color:#9aa39f;line-height:1.6;">
                This notification was sent automatically by <a href="{$brandSite}" style="color:{$textMuted};">{$brandName}</a>.
            </p>
        </td></tr>
    </table>
</body>
</html>
HTML;
}

function send_lead_email(array $lead, array $attachments = []): bool {
    global $LEAD;
    $sourceLabel = lead_form_label($lead['form_type']);
    $name        = $lead['name'] !== '' ? $lead['name'] : 'New lead';
    $subject     = sprintf('New Lead: %s — %s', $name, $sourceLabel);
    return send_lead_mail(
        $LEAD['recipients'] ?? [],
        $subject,
        build_lead_text($lead),
        build_lead_html($lead),
        $lead['email'] ?: '',
        $attachments
    );
}

/* ---------------------------------------------------------------------------
 *  Process the submission
 * ------------------------------------------------------------------------- */

$formType = field_value('form_type') ?: 'website';

// Bot defence — server-side reCAPTCHA v3 verification (skipped if not configured)
$token   = field_value('g-recaptcha-token');
$captcha = recaptcha_verify($token, expected_recaptcha_action($formType));
if (!$captcha['success']) {
    error_log('[lead] reCAPTCHA rejected (' . ($captcha['reason'] ?? 'unknown') . '): ' . json_encode($captcha['data'] ?? []));
    redirect_back('captcha');
}

// Build the lead payload — flexible across form field naming conventions
$firstName = field_value('first_name') ?: field_value('firstName');
$lastName  = field_value('last_name')  ?: field_value('lastName');
$name      = field_value('name') ?: trim($firstName . ' ' . $lastName);

$message   = field_value('message') ?: field_value('notes') ?: field_value('msg');
$phone     = field_value('phone') ?: field_value('number');

$lead = [
    'form_type'  => $formType,
    'name'       => $name,
    'email'      => field_value('email'),
    'phone'      => $phone,
    'country'    => field_value('country'),
    'book_title' => field_value('book_title'),
    'genre'      => field_value('genre'),
    'service'    => field_value('service'),
    'source'     => field_value('source'),
    'message'    => $message,
    'page_url'   => field_value('source_page') ?: ($_SERVER['HTTP_REFERER'] ?? ''),
    'ip_address' => client_ip(),
    'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
];

// Newsletter form takes only an email — relax the name/phone requirement
if ($formType === 'newsletter') {
    if (!filter_var($lead['email'], FILTER_VALIDATE_EMAIL)) {
        redirect_back('invalid');
    }
    if ($lead['name'] === '') $lead['name'] = 'Newsletter signup';
} else {
    if ($lead['name'] === ''
        || !filter_var($lead['email'], FILTER_VALIDATE_EMAIL)
        || $lead['phone'] === '') {
        redirect_back('invalid');
    }
}

// Manuscript form: file is required, plus book title + genre
$attachments = [];
if ($formType === 'manuscript') {
    if ($lead['book_title'] === '' || $lead['genre'] === '') {
        redirect_back('invalid');
    }
    $upload = handle_manuscript_upload('manuscript_file');
    if (!$upload['ok']) {
        $reason = $upload['reason'] ?? 'unknown';
        error_log('[lead] manuscript upload rejected: ' . $reason);
        $status = match ($reason) {
            'too-large'        => 'file-too-large',
            'virus-detected'   => 'file-virus',
            'suspicious-content', 'forbidden-extension' => 'file-blocked',
            default            => 'invalid-file',
        };
        redirect_back($status);
    }
    $attachments[] = ['path' => $upload['path'], 'name' => $upload['name']];
    $scanLabel = $upload['scanned'] === 'clean'
        ? 'ClamAV: clean'
        : 'ClamAV: not installed (signature + MIME verified)';
    $lead['manuscript_file'] = sprintf(
        '%s · %s KB · %s · %s',
        $upload['name'],
        number_format($upload['size'] / 1024, 1),
        $upload['mime'],
        $scanLabel
    );
}

$emailSent = send_lead_email($lead, $attachments);
if (!$emailSent) {
    error_log('[lead] mail send returned false for ' . $lead['email']);
}

log_lead_to_db($lead);

redirect_back('success');
