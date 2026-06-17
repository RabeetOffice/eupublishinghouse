<?php
/**
 * Pure-PHP RFC 6238 TOTP (Time-based One-Time Password) + RFC 4648 Base32.
 * Verified against the RFC 6238 published test vectors (see tests/totp_test.php).
 * No external dependencies.
 */

/** Generate a new Base32 secret (default 160-bit / 32 chars). */
function totp_generate_secret(int $length = 32): string {
    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
    $out = '';
    for ($i = 0; $i < $length; $i++) {
        $out .= $alphabet[random_int(0, 31)];
    }
    return $out;
}

/** RFC 4648 Base32 decode (uppercase, no padding required). */
function totp_base32_decode(string $b32): string {
    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
    $b32 = strtoupper(preg_replace('/[^A-Z2-7]/', '', $b32));
    if ($b32 === '') return '';
    $bits = '';
    $out = '';
    $len = strlen($b32);
    for ($i = 0; $i < $len; $i++) {
        $val = strpos($alphabet, $b32[$i]);
        if ($val === false) continue;
        $bits .= str_pad(decbin($val), 5, '0', STR_PAD_LEFT);
    }
    for ($i = 0; $i + 8 <= strlen($bits); $i += 8) {
        $out .= chr(bindec(substr($bits, $i, 8)));
    }
    return $out;
}

/**
 * Compute the HOTP/TOTP code for a given counter.
 * @param string $secret  Base32 secret.
 * @param int    $counter Time-step counter (TOTP) or event counter (HOTP).
 * @param int    $digits  Number of digits (default 6).
 * @param string $algo    Hash algo: sha1 (default), sha256, sha512.
 */
function totp_hotp(string $secret, int $counter, int $digits = 6, string $algo = 'sha1'): string {
    $key = totp_base32_decode($secret);
    if ($key === '') return str_repeat('0', $digits);
    // 8-byte big-endian counter.
    $binCounter = pack('N*', 0) . pack('N*', $counter);
    $hash = hash_hmac($algo, $binCounter, $key, true);
    $offset = ord($hash[strlen($hash) - 1]) & 0x0F;
    $binary = ((ord($hash[$offset]) & 0x7F) << 24)
        | ((ord($hash[$offset + 1]) & 0xFF) << 16)
        | ((ord($hash[$offset + 2]) & 0xFF) << 8)
        | (ord($hash[$offset + 3]) & 0xFF);
    $otp = $binary % (10 ** $digits);
    return str_pad((string)$otp, $digits, '0', STR_PAD_LEFT);
}

/** Current TOTP code. */
function totp_now(string $secret, ?int $time = null, int $period = 30, int $digits = 6, string $algo = 'sha1'): string {
    $time = $time ?? time();
    $counter = (int)floor($time / $period);
    return totp_hotp($secret, $counter, $digits, $algo);
}

/**
 * Verify a user-supplied code, allowing a ±$window step drift (default ±1 = 90s span).
 * Constant-time comparison.
 */
function totp_verify(string $secret, string $code, int $window = 1, ?int $time = null, int $period = 30, int $digits = 6, string $algo = 'sha1'): bool {
    $code = preg_replace('/\D/', '', $code);
    if (strlen($code) !== $digits) return false;
    $time = $time ?? time();
    $counter = (int)floor($time / $period);
    for ($i = -$window; $i <= $window; $i++) {
        $candidate = totp_hotp($secret, $counter + $i, $digits, $algo);
        if (hash_equals($candidate, $code)) return true;
    }
    return false;
}

/** Build the otpauth:// provisioning URI for a QR code. */
function totp_provisioning_uri(string $secret, string $account, string $issuer, int $digits = 6, int $period = 30): string {
    $label = rawurlencode($issuer) . ':' . rawurlencode($account);
    $params = http_build_query([
        'secret'    => $secret,
        'issuer'    => $issuer,
        'algorithm' => 'SHA1',
        'digits'    => $digits,
        'period'    => $period,
    ], '', '&', PHP_QUERY_RFC3986);
    return 'otpauth://totp/' . $label . '?' . $params;
}

/** Group a secret into readable 4-char blocks for manual entry. */
function totp_format_secret(string $secret): string {
    return trim(chunk_split($secret, 4, ' '));
}
