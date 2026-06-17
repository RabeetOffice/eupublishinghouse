<?php
/**
 * EU Publishing House — Admin helpers
 * Atomic / locked file IO, backups, slugify, read-time, PHP lint, WebP uploads.
 * No secrets here. Pure utilities shared by every admin module.
 */

if (!defined('ADMIN_DIR'))  define('ADMIN_DIR', dirname(__DIR__));        // .../admin
if (!defined('SITE_ROOT'))  define('SITE_ROOT', dirname(ADMIN_DIR));      // site root
if (!defined('ADMIN_DATA'))  define('ADMIN_DATA', ADMIN_DIR . '/data');
if (!defined('ADMIN_BACKUPS')) define('ADMIN_BACKUPS', ADMIN_DATA . '/backups');
if (!defined('ADMIN_POSTS'))  define('ADMIN_POSTS', ADMIN_DATA . '/posts');

/* Pull in the brand config so admin code can reuse e(), link_to(), asset(),
   BRAND_* constants, and $DB / $RECAPTCHA / $LEAD / $SMTP. */
require_once SITE_ROOT . '/includes/config.php';

/** Make sure the writable data directories exist. */
function admin_ensure_dirs(): void {
    foreach ([ADMIN_DATA, ADMIN_BACKUPS, ADMIN_POSTS] as $d) {
        if (!is_dir($d)) @mkdir($d, 0775, true);
    }
}

/* ---------------------------------------------------------------------------
   JSON read / write with advisory locking
--------------------------------------------------------------------------- */
function admin_json_read(string $path, $default = []) {
    if (!is_file($path)) return $default;
    $fh = @fopen($path, 'rb');
    if (!$fh) return $default;
    @flock($fh, LOCK_SH);
    $raw = stream_get_contents($fh);
    @flock($fh, LOCK_UN);
    fclose($fh);
    if ($raw === false || $raw === '') return $default;
    $data = json_decode($raw, true);
    return is_array($data) ? $data : $default;
}

function admin_json_write(string $path, $data): bool {
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    if ($json === false) return false;
    return admin_atomic_write($path, $json);
}

/* ---------------------------------------------------------------------------
   Atomic write — temp file in the same dir, then rename.
   On Windows rename() will NOT overwrite, so unlink the target first.
--------------------------------------------------------------------------- */
function admin_atomic_write(string $path, string $content): bool {
    $dir = dirname($path);
    if (!is_dir($dir) && !@mkdir($dir, 0775, true) && !is_dir($dir)) return false;
    try {
        $tmp = $dir . '/.tmp_' . bin2hex(random_bytes(6));
    } catch (Throwable $e) {
        $tmp = $dir . '/.tmp_' . uniqid('', true);
    }
    if (@file_put_contents($tmp, $content, LOCK_EX) === false) {
        @unlink($tmp);
        return false;
    }
    // Windows: rename() cannot clobber an existing file.
    if (DIRECTORY_SEPARATOR === '\\' && is_file($path)) {
        @unlink($path);
    }
    if (!@rename($tmp, $path)) {
        // Fallback: direct copy then remove temp.
        if (@copy($tmp, $path)) { @unlink($tmp); return true; }
        @unlink($tmp);
        return false;
    }
    return true;
}

/* ---------------------------------------------------------------------------
   Backups — copy a live site file to data/backups/<name>.<ts>.bak, keep last 20
--------------------------------------------------------------------------- */
function admin_backup_file(string $path): ?string {
    if (!is_file($path)) return null;
    admin_ensure_dirs();
    $name = basename($path);
    $stamp = date('Ymd-His');
    $dest = ADMIN_BACKUPS . '/' . $name . '.' . $stamp . '.bak';
    $i = 0;
    while (is_file($dest)) { $dest = ADMIN_BACKUPS . '/' . $name . '.' . $stamp . '-' . (++$i) . '.bak'; }
    if (!@copy($path, $dest)) return null;
    admin_prune_backups($name, 20);
    return $dest;
}

function admin_prune_backups(string $name, int $keep = 20): void {
    $glob = glob(ADMIN_BACKUPS . '/' . $name . '.*.bak');
    if (!$glob || count($glob) <= $keep) return;
    usort($glob, static function ($a, $b) { return filemtime($a) <=> filemtime($b); });
    foreach (array_slice($glob, 0, count($glob) - $keep) as $old) { @unlink($old); }
}

/**
 * Replace a LIVE site file safely: back it up, then atomic-write the new content.
 * Use this for EVERY write to a real site file (post files, registry, data, sitemap).
 */
function admin_replace_site_file(string $path, string $content): bool {
    if (is_file($path)) admin_backup_file($path);
    return admin_atomic_write($path, $content);
}

/* ---------------------------------------------------------------------------
   PHP lint — write to temp, run `php -l`, return false on parse error.
   Degrades to "trust" (true) if no usable PHP binary / exec is available, so a
   host without exec() still works (the generator output is template-controlled).
--------------------------------------------------------------------------- */
function admin_php_binary(): ?string {
    static $bin = false;
    if ($bin !== false) return $bin;
    $cands = [];
    if (defined('PHP_BINARY') && PHP_BINARY && preg_match('/php(\.exe)?$/i', PHP_BINARY)) {
        $cands[] = PHP_BINARY;
    }
    if (DIRECTORY_SEPARATOR === '\\') {
        $cands[] = 'C:\\xampp\\php\\php.exe';
        $cands[] = 'php.exe';
    } else {
        $cands[] = '/usr/bin/php';
        $cands[] = '/usr/local/bin/php';
    }
    $cands[] = 'php';
    foreach ($cands as $c) {
        if ($c === 'php' || $c === 'php.exe') { $bin = $c; return $bin; } // rely on PATH
        if (@is_file($c)) { $bin = $c; return $bin; }
    }
    $bin = null;
    return $bin;
}

function admin_exec_enabled(): bool {
    if (!function_exists('exec')) return false;
    $disabled = array_map('trim', explode(',', (string)ini_get('disable_functions')));
    return !in_array('exec', $disabled, true);
}

/**
 * @return array{0:bool,1:string}  [ok, message]  ok=true means lint passed OR was skipped.
 */
function admin_php_lint(string $code): array {
    if (!admin_exec_enabled()) return [true, 'lint-skipped:no-exec'];
    $bin = admin_php_binary();
    if (!$bin) return [true, 'lint-skipped:no-binary'];

    $tmp = ADMIN_DATA . '/.lint_' . bin2hex(random_bytes(5)) . '.php';
    admin_ensure_dirs();
    if (@file_put_contents($tmp, $code) === false) return [true, 'lint-skipped:no-temp'];

    $cmd = escapeshellarg($bin) . ' -l -d display_errors=1 -d error_reporting=E_ALL ' . escapeshellarg($tmp) . ' 2>&1';
    $out = [];
    $ret = 1;
    @exec($cmd, $out, $ret);
    @unlink($tmp);
    $msg = trim(implode("\n", $out));
    if ($ret === 0 || stripos($msg, 'No syntax errors') !== false) {
        return [true, 'ok'];
    }
    // If we couldn't actually invoke PHP (e.g. "is not recognized"), don't block.
    if ($msg === '' || stripos($msg, 'not recognized') !== false || stripos($msg, 'No such file') !== false) {
        return [true, 'lint-skipped:no-run'];
    }
    return [false, $msg];
}

/* ---------------------------------------------------------------------------
   Slug + text utilities
--------------------------------------------------------------------------- */
function admin_slugify(string $s): string {
    $s = trim($s);
    if (function_exists('iconv')) {
        $t = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $s);
        if ($t !== false) $s = $t;
    }
    $s = strtolower($s);
    $s = preg_replace('/[^a-z0-9]+/', '-', $s);
    $s = trim($s, '-');
    return $s !== '' ? $s : 'post';
}

/** Word count from HTML — \S+ whitespace tokens, matching the editor's JS counter. */
function admin_word_count(string $html): int {
    $text = preg_replace('/<[^>]+>/', ' ', $html);
    $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $text = trim(preg_replace('/\s+/u', ' ', $text));
    if ($text === '') return 0;
    return count(preg_split('/\s+/u', $text));
}

/** Auto read-time string, e.g. "16 min read". ~210 wpm, minimum 3 minutes. */
function admin_read_time(string $html, int $wpm = 210): string {
    $words = admin_word_count($html);
    $mins = (int)max(3, ceil($words / max(1, $wpm)));
    return $mins . ' min read';
}

/** Escape a string for embedding inside a SINGLE-quoted PHP literal. */
function admin_php_sq(string $s): string {
    return str_replace(['\\', "'"], ['\\\\', "\\'"], $s);
}

/** Escape for a DOUBLE-quoted PHP literal (e.g. review text). */
function admin_php_dq(string $s): string {
    return addcslashes($s, "\\\"\$");
}

/* ---------------------------------------------------------------------------
   .htaccess that disables script execution inside an upload directory
--------------------------------------------------------------------------- */
function admin_harden_upload_dir(string $dir): void {
    if (!is_dir($dir)) @mkdir($dir, 0775, true);
    $ht = $dir . '/.htaccess';
    if (is_file($ht)) return;
    $rules = "# Uploaded assets only — never execute code here.\n"
        . "php_flag engine off\n"
        . "<IfModule mod_rewrite.c>\n  RewriteEngine Off\n</IfModule>\n"
        . "<FilesMatch \"\\.(php[0-9]?|phtml|phar|cgi|pl|py|sh|asp|aspx|jsp)$\">\n"
        . "  <IfModule mod_authz_core.c>\n    Require all denied\n  </IfModule>\n"
        . "  <IfModule !mod_authz_core.c>\n    Order allow,deny\n    Deny from all\n  </IfModule>\n"
        . "</FilesMatch>\n"
        . "AddType text/plain .php .phtml .phar\n";
    @file_put_contents($ht, $rules);
}

/* ---------------------------------------------------------------------------
   ONE reusable image upload → WebP helper.
   $file    : a single $_FILES entry (['name','type','tmp_name','error','size'])
   $relDir  : destination dir relative to the SITE ROOT, e.g. 'blogs/images'
   $hint    : filename hint (slugified)
   $maxBytes: hard size cap (default ~8 MB)
   Returns [true, '<relDir>/<name>'] (web-relative path) or [false, 'error message'].
--------------------------------------------------------------------------- */
function admin_upload_image_webp(array $file, string $relDir, string $hint = '', int $maxBytes = 8388608): array {
    if (!isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK) {
        return [false, 'Upload failed (error code ' . ($file['error'] ?? 'n/a') . ').'];
    }
    $tmp = $file['tmp_name'] ?? '';
    if ($tmp === '' || !is_uploaded_file($tmp)) {
        // Allow non-HTTP callers (tests) to pass a readable path.
        if ($tmp === '' || !is_file($tmp)) return [false, 'No uploaded file.'];
    }
    if (($file['size'] ?? filesize($tmp)) > $maxBytes) {
        return [false, 'Image is larger than ' . round($maxBytes / 1048576) . ' MB.'];
    }

    // MIME sniff (never trust the extension).
    $mime = '';
    if (class_exists('finfo')) {
        $fi = new finfo(FILEINFO_MIME_TYPE);
        $mime = (string)$fi->file($tmp);
    } elseif (function_exists('mime_content_type')) {
        $mime = (string)mime_content_type($tmp);
    }
    $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp', 'image/gif' => 'gif'];
    if ($mime !== '' && !isset($allowed[$mime])) {
        return [false, 'Unsupported image type (' . $mime . ').'];
    }

    // Must be a real, parseable image.
    $info = @getimagesize($tmp);
    if ($info === false) return [false, 'File is not a valid image.'];

    $base = admin_slugify($hint !== '' ? $hint : pathinfo($file['name'] ?? 'image', PATHINFO_FILENAME));
    if ($base === '' || $base === 'post') $base = 'image';

    $destDirAbs = SITE_ROOT . '/' . trim($relDir, '/');
    if (!is_dir($destDirAbs) && !@mkdir($destDirAbs, 0775, true) && !is_dir($destDirAbs)) {
        return [false, 'Cannot create destination directory.'];
    }
    admin_harden_upload_dir($destDirAbs);

    $hasGd = function_exists('imagewebp') && function_exists('imagecreatetruecolor');

    if ($hasGd) {
        $name = admin_unique_name($destDirAbs, $base, 'webp');
        $destAbs = $destDirAbs . '/' . $name;
        if (admin_gd_to_webp($tmp, $destAbs, $mime ?: ('image/' . ($allowed[$mime] ?? 'jpeg')), 1920, 82)) {
            return [true, trim($relDir, '/') . '/' . $name];
        }
        // fall through to raw copy if GD failed
    }

    // No GD (or GD failed): keep original bytes but FORCE a safe image extension.
    $ext = $allowed[$mime] ?? (in_array(strtolower(pathinfo($file['name'] ?? '', PATHINFO_EXTENSION)), ['jpg','jpeg','png','webp','gif'], true)
        ? strtolower(pathinfo($file['name'], PATHINFO_EXTENSION)) : 'jpg');
    $name = admin_unique_name($destDirAbs, $base, $ext);
    $destAbs = $destDirAbs . '/' . $name;
    if (!@copy($tmp, $destAbs)) return [false, 'Could not save the image.'];
    return [true, trim($relDir, '/') . '/' . $name];
}

function admin_unique_name(string $dirAbs, string $base, string $ext): string {
    $name = $base . '.' . $ext;
    $i = 1;
    while (is_file($dirAbs . '/' . $name)) { $name = $base . '-' . (++$i) . '.' . $ext; }
    return $name;
}

/** Downscale to max width and re-encode to WebP. Re-encoding also destroys any
    payload smuggled inside a valid image. Returns true on success. */
function admin_gd_to_webp(string $srcPath, string $destPath, string $mime, int $maxW = 1920, int $quality = 82): bool {
    $src = null;
    switch ($mime) {
        case 'image/jpeg': $src = @imagecreatefromjpeg($srcPath); break;
        case 'image/png':  $src = @imagecreatefrompng($srcPath); break;
        case 'image/gif':  $src = @imagecreatefromgif($srcPath); break;
        case 'image/webp': $src = function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($srcPath) : null; break;
    }
    if (!$src) {
        // Last-ditch: let GD sniff it.
        $src = @imagecreatefromstring((string)@file_get_contents($srcPath));
    }
    if (!$src) return false;

    $w = imagesx($src); $h = imagesy($src);
    if ($w < 1 || $h < 1) { imagedestroy($src); return false; }

    if ($w > $maxW) {
        $nh = (int)round($h * ($maxW / $w));
        $dst = imagecreatetruecolor($maxW, $nh);
        imagealphablending($dst, false); imagesavealpha($dst, true);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $maxW, $nh, $w, $h);
        imagedestroy($src);
        $src = $dst;
    } else {
        imagepalettetotruecolor($src);
        imagealphablending($src, false); imagesavealpha($src, true);
    }
    $ok = imagewebp($src, $destPath, $quality);
    imagedestroy($src);
    return (bool)$ok;
}

/** Random URL-safe token. */
function admin_token(int $bytes = 32): string {
    try { return rtrim(strtr(base64_encode(random_bytes($bytes)), '+/', '-_'), '='); }
    catch (Throwable $e) { return bin2hex(uniqid('', true)); }
}
