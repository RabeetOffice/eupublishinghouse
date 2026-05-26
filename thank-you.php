<?php
require_once __DIR__ . '/includes/config.php';

$page_title       = 'Thank You | ' . BRAND_NAME;
$page_description = 'Thanks for reaching out to ' . BRAND_NAME . '. A senior editor will reply within one working day.';
$page_keywords    = 'thank you, EU Publishing House, submission confirmation';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/thank-you/';

/* This page is transactional — don't index it in search results. */
header('X-Robots-Tag: noindex, nofollow', true);

/* Auto-redirect to home after 8s (also enforced via JS with a live countdown).
 * The meta refresh is the no-JS fallback. */
$redirect_seconds = 8;
$home_url         = link_to('index.php');

require __DIR__ . '/includes/header.php';
?>

<meta http-equiv="refresh" content="<?= (int)$redirect_seconds ?>;url=<?= safe($home_url) ?>">

<section class="thank-you-section">
    <div class="container">
        <div class="thank-you-card thank-you-card--minimal" data-aos="fade-up">
            <span class="thank-you-ico" aria-hidden="true">
                <i class="fa-solid fa-check"></i>
            </span>

            <h1 class="thank-you-title">
                Thanks &mdash; we&rsquo;ve <em class="serif-italic">got it</em>.
            </h1>
            <p class="thank-you-lead">
                A senior editor will reply within one working day.
            </p>

            <div class="thank-you-redirect" role="status" aria-live="polite"
                 data-redirect-url="<?= safe($home_url) ?>"
                 data-redirect-seconds="<?= (int)$redirect_seconds ?>">
                <span class="redirect-ring" aria-hidden="true">
                    <svg viewBox="0 0 36 36">
                        <circle class="ring-bg"   cx="18" cy="18" r="16"></circle>
                        <circle class="ring-fill" cx="18" cy="18" r="16"></circle>
                    </svg>
                    <span class="redirect-count"><?= (int)$redirect_seconds ?></span>
                </span>
                <span class="redirect-text">
                    Redirecting to home<a href="<?= safe($home_url) ?>" class="redirect-skip">go now</a>
                </span>
            </div>
        </div>
    </div>
</section>

<script>
(function () {
    var box = document.querySelector('.thank-you-redirect');
    if (!box) return;

    var url      = box.dataset.redirectUrl || 'index.php';
    var seconds  = parseInt(box.dataset.redirectSeconds, 10) || 8;
    var countEl  = box.querySelector('.redirect-count');
    var ringFill = box.querySelector('.ring-fill');
    var ringLen  = 2 * Math.PI * 16; // matches r="16" on the SVG circle
    if (ringFill) {
        ringFill.style.strokeDasharray  = ringLen.toFixed(2);
        ringFill.style.strokeDashoffset = '0';
    }

    var remaining = seconds;
    var start = Date.now();

    var tick = setInterval(function () {
        var elapsed = (Date.now() - start) / 1000;
        remaining = Math.max(0, Math.ceil(seconds - elapsed));
        if (countEl) countEl.textContent = remaining;
        if (ringFill) {
            var progress = Math.min(1, elapsed / seconds);
            ringFill.style.strokeDashoffset = (ringLen * progress).toFixed(2);
        }
        if (remaining <= 0) {
            clearInterval(tick);
            window.location.href = url;
        }
    }, 100);
})();
</script>

<?php
include __DIR__ . '/includes/footer.php';
