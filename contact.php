<?php
require_once __DIR__ . '/includes/config.php';

$page_title       = 'Contact Us | ' . BRAND_NAME;
$page_description = 'Speak with the European Publishing House team. Submit a manuscript, ask a question, or schedule a free consultation with a senior editor.';
$page_keywords    = 'contact European Publishing House, submit manuscript Dublin, publishing consultation Europe';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/contact.php';

require __DIR__ . '/includes/header.php';

$banner = [
    'crumb' => 'Contact Us',
    'title' => 'Every book starts with a <em class="serif-italic">conversation</em>',
    'sub'   => 'Wherever you are in the process, we\'re happy to talk it through. No pressure, no sales pitch.',
];
include __DIR__ . '/includes/page-banner.php';
?>

<section class="contact-page" id="submit">
    <div class="container">
        <div class="contact-page-grid">

            <!-- LEFT: copy + details -->
            <div class="contact-page-copy">
                <span class="eyebrow">Get in Touch</span>
                <h2 class="section-title">A short note is enough to <em class="serif-italic">begin</em></h2>
                <p class="lead">
                    Maybe you have a finished manuscript and are not sure what comes next. Maybe you are mid-draft and want to understand what publishing actually involves. Maybe you have published before and it did not go the way you hoped.
                </p>
                <p>
                    Whatever stage you are at, we are happy to talk it through. Just an honest conversation about your book, what it needs, and whether we are the right fit to help you publish it properly.
                </p>

                <ul class="contact-list" role="list">
                    <li>
                        <span class="contact-ico"><i class="fa-solid fa-envelope"></i></span>
                        <div>
                            <small>Editorial</small>
                            <a href="mailto:<?= EMAIL_ADDRESS ?>"><?= safe(EMAIL_ADDRESS) ?></a>
                        </div>
                    </li>
                    <li>
                        <span class="contact-ico"><i class="fa-solid fa-phone"></i></span>
                        <div>
                            <small>Reception</small>
                            <a href="tel:<?= PHONE_NUMBER_RAW ?>"><?= safe(PHONE_NUMBER) ?></a>
                        </div>
                    </li>
                    <li>
                        <span class="contact-ico"><i class="fa-solid fa-location-dot"></i></span>
                        <div>
                            <small>Studio</small>
                            <p><?= safe(ADDRESS) ?></p>
                        </div>
                    </li>
                </ul>

                <ul class="contact-perks" role="list">
                    <li><i class="fa-solid fa-check"></i>Free manuscript review by a senior editor</li>
                    <li><i class="fa-solid fa-check"></i>Honest, no-pressure conversation</li>
                    <li><i class="fa-solid fa-check"></i>Reply within a few working days</li>
                    <li><i class="fa-solid fa-check"></i>Your manuscript stays confidential</li>
                </ul>
            </div>

            <!-- RIGHT: form -->
            <div class="contact-page-form">
                <?php include __DIR__ . '/includes/forms/quote-card.php'; ?>
            </div>

        </div>
    </div>
</section>

<?php
include __DIR__ . '/includes/footer.php';
