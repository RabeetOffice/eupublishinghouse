<?php
require_once __DIR__ . '/includes/config.php';

$page_title       = 'Contact Us | ' . BRAND_NAME;
$page_description = 'Speak with the European Publishing House team. Submit a manuscript, ask a question, or schedule a free consultation with a senior editor.';
$page_keywords    = 'contact European Publishing House, submit manuscript Dublin, publishing consultation Europe';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/contact.php';

require __DIR__ . '/includes/header.php';

$banner = [
    'crumb' => 'Contact Us',
    'title' => 'Contact <em class="serif-italic">Us</em>',
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
                <h2 class="section-title">Let’s Talk <em class="serif-italic">About Your Book</em></h2>
                <p>Every book starts with a conversation. Maybe you’ve got a finished manuscript and you’re not sure what comes next. Maybe you’re mid-draft and want to understand what publishing actually involves before you get there. Maybe you’ve published before and it didn’t go the way you hoped.</p>
                <p>Whatever stage you’re at, we’re happy to talk it through, no pressure, no sales pitch. Just an honest conversation about your book, what it needs, and whether we’re the right fit to help you get it published properly.</p>
                <p>We work with authors across Europe on everything from editing and cover design to full publishing and marketing. If you have a question about any of it, or you’re ready to get started, get in touch and we’ll take it from there.</p>

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

                <!-- <ul class="contact-perks" role="list">
                    <li><i class="fa-solid fa-check"></i>Free manuscript review by a senior editor</li>
                    <li><i class="fa-solid fa-check"></i>Honest, no-pressure conversation</li>
                    <li><i class="fa-solid fa-check"></i>Reply within a few working days</li>
                    <li><i class="fa-solid fa-check"></i>Your manuscript stays confidential</li>
                </ul> -->
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
