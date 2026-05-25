<?php
require_once __DIR__ . '/includes/config.php';

$page_title       = 'Thank You | ' . BRAND_NAME;
$page_description = 'Thanks for reaching out to ' . BRAND_NAME . '. A senior editor will read your note personally and reply within one working day.';
$page_keywords    = 'thank you, EU Publishing House, manuscript submission, contact confirmation';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/thank-you.php';

require __DIR__ . '/includes/header.php';
?>

<section class="thank-you-section">
    <div class="container">
        <div class="thank-you-card" data-aos="fade-up">
            <span class="thank-you-ico" aria-hidden="true">
                <i class="fa-solid fa-feather"></i>
            </span>

            <span class="eyebrow"><i class="fa-solid fa-circle-check"></i> Submission Received</span>
            <h1 class="thank-you-title">
                Thanks &mdash; we&rsquo;ve <em class="serif-italic">got it</em>.
            </h1>
            <p class="thank-you-lead">
                One of our senior editors at <?= safe(WEBSITE_NAME) ?> will read your note personally and reply within one working day. Please keep an eye on your inbox &mdash; and your spam folder, just in case.
            </p>

            <ul class="thank-you-perks">
                <li><i class="fa-solid fa-shield-halved"></i><span>Your manuscript stays confidential</span></li>
                <li><i class="fa-solid fa-pen-nib"></i><span>Read by a senior editor, no auto-screening</span></li>
                <li><i class="fa-solid fa-bullhorn"></i><span>Honest, no-pressure feedback</span></li>
            </ul>

            <div class="thank-you-actions">
                <a href="<?= safe(link_to('index.php')) ?>" class="btn btn-cta btn-lg">
                    <i class="fa-solid fa-arrow-left"></i> Back to home
                </a>
                <a href="<?= safe(link_to('blog.php')) ?>" class="btn btn-outline-dark btn-lg">
                    Read the journal <i class="fa-solid fa-book-open"></i>
                </a>
            </div>

            <p class="thank-you-meta">
                Need to reach us in the meantime?
                <a href="mailto:<?= safe(EMAIL_ADDRESS) ?>"><?= safe(EMAIL_ADDRESS) ?></a>
                &middot;
                <a href="tel:<?= safe(PHONE_NUMBER_RAW) ?>"><?= safe(PHONE_NUMBER) ?></a>
            </p>
        </div>
    </div>
</section>

<?php
include __DIR__ . '/includes/footer.php';
