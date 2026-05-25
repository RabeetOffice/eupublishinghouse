<?php
/* =================================================================
   SMTP / MAIL HELPER — EU Publishing House

   send_lead_mail($to, $subject, $text, $html, $replyTo, $attachments): bool

   Strategy:
     - If $SMTP['enabled'] is true AND PHPMailer is autoloadable, use SMTP.
     - Otherwise fall back to PHP's built-in mail() with a multipart MIME
       body so HTML + text alternative both render.

   Drop-in PHPMailer (`composer require phpmailer/phpmailer`) for
   production-grade deliverability against Gmail / Workspace.
================================================================= */
if (!isset($BRAND)) { require_once __DIR__ . '/config.php'; }

if (!function_exists('send_lead_mail')) {
    /**
     * Send a lead email.
     *
     * $attachments = [ ['path' => '/abs/path/to/file', 'name' => 'pretty-name.pdf'], ... ]
     */
    function send_lead_mail($to, string $subject, string $textBody, string $htmlBody, string $replyTo = '', array $attachments = []): bool {
        global $LEAD, $SMTP, $BRAND;

        $recipients = is_array($to) ? $to : [$to];
        $recipients = array_values(array_filter(array_map('trim', $recipients)));
        if (empty($recipients)) return false;

        // Force sender name to the brand name so every outbound mail is branded consistently.
        $fromName  = $BRAND['name'] ?? ($LEAD['from_name'] ?? 'Website');
        $fromEmail = $LEAD['from_email'] ?? ('no-reply@' . ($_SERVER['HTTP_HOST'] ?? 'localhost'));
        $replyTo   = $replyTo !== '' ? $replyTo : ($LEAD['reply_to'] ?? $fromEmail);

        /* ---------- PHPMailer path ---------- */
        if (!empty($SMTP['enabled'])) {
            $phpMailerLoaded = class_exists('PHPMailer\\PHPMailer\\PHPMailer');
            if (!$phpMailerLoaded) {
                // Try common autoloader paths
                foreach (['/../vendor/autoload.php', '/../PHPMailer/src/PHPMailer.php'] as $rel) {
                    $candidate = __DIR__ . $rel;
                    if (file_exists($candidate)) { require_once $candidate; break; }
                }
                $phpMailerLoaded = class_exists('PHPMailer\\PHPMailer\\PHPMailer');
            }
            if ($phpMailerLoaded) {
                try {
                    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host       = $SMTP['host'] ?? '';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = $SMTP['user'] ?? '';
                    $mail->Password   = $SMTP['pass'] ?? '';
                    $mail->Port       = (int)($SMTP['port'] ?? 587);
                    $secure = strtolower((string)($SMTP['secure'] ?? 'tls'));
                    if ($secure === 'tls') $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
                    elseif ($secure === 'ssl') $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;

                    $mail->CharSet  = 'UTF-8';
                    $mail->setFrom($fromEmail, $fromName);
                    if ($replyTo !== '') $mail->addReplyTo($replyTo);
                    foreach ($recipients as $r) $mail->addAddress($r);

                    $mail->isHTML(true);
                    $mail->Subject = $subject;
                    $mail->Body    = $htmlBody;
                    $mail->AltBody = $textBody;

                    foreach ($attachments as $att) {
                        $path = $att['path'] ?? '';
                        $name = $att['name'] ?? basename($path);
                        if ($path !== '' && is_file($path) && is_readable($path)) {
                            $mail->addAttachment($path, $name);
                        }
                    }

                    return (bool) $mail->send();
                } catch (\Throwable $e) {
                    error_log('[mailer] PHPMailer error: ' . $e->getMessage());
                    // fall through to mail()
                }
            } else {
                error_log('[mailer] SMTP enabled but PHPMailer not found — falling back to mail()');
            }
        }

        /* ---------- PHP mail() fallback (multipart) ---------- */
        $altBoundary = '=_alt_' . bin2hex(random_bytes(8));
        $mixBoundary = '=_mix_' . bin2hex(random_bytes(8));

        $hasAttachments = false;
        foreach ($attachments as $att) {
            if (!empty($att['path']) && is_file($att['path']) && is_readable($att['path'])) {
                $hasAttachments = true;
                break;
            }
        }

        $headers = [
            'MIME-Version: 1.0',
            'From: ' . sprintf('%s <%s>', mb_encode_mimeheader($fromName, 'UTF-8'), $fromEmail),
            'Reply-To: ' . $replyTo,
            'X-Mailer: EUPH-Lead/1.0',
            $hasAttachments
                ? 'Content-Type: multipart/mixed; boundary="' . $mixBoundary . '"'
                : 'Content-Type: multipart/alternative; boundary="' . $altBoundary . '"',
        ];

        // text + html alternative block
        $altBody  = "--{$altBoundary}\r\n";
        $altBody .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $altBody .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
        $altBody .= $textBody . "\r\n\r\n";
        $altBody .= "--{$altBoundary}\r\n";
        $altBody .= "Content-Type: text/html; charset=UTF-8\r\n";
        $altBody .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
        $altBody .= $htmlBody . "\r\n\r\n";
        $altBody .= "--{$altBoundary}--";

        if ($hasAttachments) {
            $body  = "--{$mixBoundary}\r\n";
            $body .= "Content-Type: multipart/alternative; boundary=\"{$altBoundary}\"\r\n\r\n";
            $body .= $altBody . "\r\n\r\n";

            foreach ($attachments as $att) {
                $path = $att['path'] ?? '';
                $name = $att['name'] ?? basename($path);
                if ($path === '' || !is_file($path) || !is_readable($path)) continue;
                $data = base64_encode((string) file_get_contents($path));
                $chunked = chunk_split($data, 76, "\r\n");
                $mime = function_exists('mime_content_type') ? (mime_content_type($path) ?: 'application/octet-stream') : 'application/octet-stream';
                $safeName = mb_encode_mimeheader($name, 'UTF-8');
                $body .= "--{$mixBoundary}\r\n";
                $body .= "Content-Type: {$mime}; name=\"{$safeName}\"\r\n";
                $body .= "Content-Disposition: attachment; filename=\"{$safeName}\"\r\n";
                $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
                $body .= $chunked . "\r\n";
            }
            $body .= "--{$mixBoundary}--";
        } else {
            $body = $altBody;
        }

        $encodedSubject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
        $to = implode(', ', $recipients);
        $sent = @mail($to, $encodedSubject, $body, implode("\r\n", $headers));
        if (!$sent) {
            error_log('[mailer] PHP mail() returned false for ' . $to);
        }
        return (bool) $sent;
    }
}
