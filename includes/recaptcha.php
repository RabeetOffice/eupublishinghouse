<?php
/* =================================================================
   reCAPTCHA v3 helpers — lazy-loaded, focus-triggered.

   USAGE
   -----
   In a form, drop a hidden token field where the user submits:
       <?php recaptcha_field('quote_form'); ?>

   On the server (when a real submit endpoint is wired up):
       require __DIR__ . '/includes/recaptcha.php';
       $r = recaptcha_verify($_POST['g-recaptcha-token'] ?? '', 'quote_form');
       if (!$r['success']) { http_response_code(400); exit('Failed bot check.'); }

   The Google script is loaded only when a user focuses any form
   that contains a [data-recaptcha-token] field — see the inline
   loader emitted by recaptcha_loader().
================================================================= */
if (!isset($BRAND)) { require_once __DIR__ . '/config.php'; }

if (!function_exists('recaptcha_field')) {
    /**
     * Hidden token field for a form. $action labels the submission
     * (must match the action passed to recaptcha_verify on the server).
     */
    function recaptcha_field(string $action = 'submit'): void {
        global $RECAPTCHA;
        if (empty($RECAPTCHA['site_key'])) return;
        echo '<input type="hidden" name="g-recaptcha-token"'
           . ' data-recaptcha-token'
           . ' data-recaptcha-action="' . htmlspecialchars($action, ENT_QUOTES, 'UTF-8') . '"'
           . ' value="">';
    }
}

if (!function_exists('recaptcha_loader')) {
    /**
     * Emit the lazy-loader script ONCE per page. Loads the Google SDK
     * the first time a user focuses any form containing a recaptcha field.
     * Exposes window.recaptchaGetToken(action) → Promise<token>.
     */
    function recaptcha_loader(): void {
        global $RECAPTCHA;
        if (empty($RECAPTCHA['site_key'])) return;
        static $emitted = false;
        if ($emitted) return;
        $emitted = true;
        $siteKey = htmlspecialchars($RECAPTCHA['site_key'], ENT_QUOTES, 'UTF-8');
        ?>
        <!-- ============== reCAPTCHA v3 (lazy, focus-triggered) ============== -->
        <link rel="preconnect" href="https://www.google.com" crossorigin>
        <link rel="preconnect" href="https://www.gstatic.com" crossorigin>
        <script>
        (function () {
          if (window.__recaptchaWired) return;
          window.__recaptchaWired = true;

          var SITE_KEY = '<?= $siteKey ?>';
          var loadingPromise = null;

          function loadScript() {
            if (loadingPromise) return loadingPromise;
            loadingPromise = new Promise(function (resolve, reject) {
              var s = document.createElement('script');
              s.src = 'https://www.google.com/recaptcha/api.js?render=' + encodeURIComponent(SITE_KEY);
              s.async = true; s.defer = true;
              s.onload  = function () { resolve(); };
              s.onerror = function () { reject(new Error('recaptcha script failed')); };
              document.head.appendChild(s);
            });
            return loadingPromise;
          }

          /**
           * window.recaptchaGetToken(action) → Promise<string>
           * Lazy-loads the SDK if needed, then runs grecaptcha.execute.
           */
          window.recaptchaGetToken = function (action) {
            return loadScript().then(function () {
              return new Promise(function (resolve, reject) {
                if (!window.grecaptcha || !window.grecaptcha.ready) {
                  return reject(new Error('grecaptcha unavailable'));
                }
                window.grecaptcha.ready(function () {
                  window.grecaptcha.execute(SITE_KEY, { action: action || 'submit' })
                    .then(resolve, reject);
                });
              });
            });
          };

          // Lazy-load on first focus inside any form that uses a token field
          var preloaded = false;
          document.addEventListener('focusin', function (e) {
            if (preloaded) return;
            var f = e.target && e.target.closest && e.target.closest('form');
            if (!f) return;
            if (!f.querySelector('[data-recaptcha-token]')) return;
            preloaded = true;
            loadScript();
          }, true);
        })();
        </script>
        <?php
    }
}

if (!function_exists('recaptcha_verify')) {
    /**
     * Server-side verification — call before processing a submit.
     * Returns ['success' => bool, 'data' => array, 'reason' => string?]
     *
     * If no keys are configured, returns success=true so dev environments
     * without reCAPTCHA still pass through. Configure $RECAPTCHA in config.php
     * to enable real bot defence.
     */
    function recaptcha_verify(string $token, string $expectedAction = 'submit'): array {
        global $RECAPTCHA;
        if (empty($RECAPTCHA['site_key']) || empty($RECAPTCHA['secret_key'])) {
            // reCAPTCHA not configured — accept all submissions.
            return ['success' => true, 'data' => [], 'reason' => 'not-configured'];
        }
        if ($token === '') {
            return ['success' => false, 'reason' => 'empty-token'];
        }

        $payload = http_build_query([
            'secret'   => $RECAPTCHA['secret_key'],
            'response' => $token,
            'remoteip' => $_SERVER['REMOTE_ADDR'] ?? '',
        ]);

        $body = null;
        if (function_exists('curl_init')) {
            $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
            curl_setopt_array($ch, [
                CURLOPT_POST           => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POSTFIELDS     => $payload,
                CURLOPT_TIMEOUT        => 8,
                CURLOPT_CONNECTTIMEOUT => 4,
            ]);
            $body = curl_exec($ch);
            curl_close($ch);
        } else {
            $ctx = stream_context_create(['http' => [
                'method'  => 'POST',
                'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
                'content' => $payload,
                'timeout' => 8,
            ]]);
            $body = @file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $ctx);
        }

        $data = is_string($body) ? (json_decode($body, true) ?: []) : [];
        $minScore = (float)($RECAPTCHA['min_score'] ?? 0.5);
        $ok = !empty($data['success'])
            && (($data['action'] ?? '') === $expectedAction)
            && ((float)($data['score'] ?? 0) >= $minScore);

        return [
            'success' => $ok,
            'data'    => $data,
            'reason'  => $ok ? null : ($data['error-codes'][0] ?? 'low-score-or-action-mismatch'),
        ];
    }
}
