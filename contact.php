<?php
require_once __DIR__ . '/includes/config.php';

$page_title       = 'Contact Us | ' . BRAND_NAME;
$page_description = 'Speak with the European Publishing House team. Submit a manuscript, ask a question, or schedule a free consultation with a senior editor.';
$page_keywords    = 'contact European Publishing House, submit manuscript Dublin, publishing consultation Europe';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/contact.php';

require __DIR__ . '/includes/header.php';

$banner = [
    'crumb'   => 'Contact Us',
    'eyebrow' => 'Get in Touch',
    'title'   => 'Every book starts with a <em class="gold-italic">conversation.</em>',
    'sub'     => 'Wherever you are in the process, we&rsquo;re happy to talk it through &mdash; no pressure, no sales pitch.',
];
include __DIR__ . '/includes/page-banner.php';
?>

<!-- ============================================================
     CONTACT INTRO COPY
     ============================================================ -->
<section class="about-snippet" id="contact-intro" style="background:var(--c-ivory);">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7" data-aos="fade-right">
                <span class="eyebrow">Contact Us</span>
                <h2 class="section-title">A short note is enough to <em class="gold-italic">begin.</em></h2>
                <p>Maybe you&rsquo;ve got a finished manuscript and you&rsquo;re not sure what comes next. Maybe you&rsquo;re mid-draft and want to understand what publishing actually involves before you get there. Maybe you&rsquo;ve published before and it didn&rsquo;t go the way you hoped.</p>
                <p>Whatever stage you&rsquo;re at, we&rsquo;re happy to talk it through &mdash; no pressure, no sales pitch. Just an honest conversation about your book, what it needs, and whether we&rsquo;re the right fit to help you get it published properly.</p>
                <p>We work with authors across Europe on everything from editing and cover design to full publishing and marketing.</p>
            </div>
            <div class="col-lg-5" data-aos="fade-left">
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
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     CONTACT FORM — pulled from includes/forms/contact-form.php
     ============================================================ -->
<section class="contact-section" id="submit">
    <div class="container">
        <div class="section-head text-center" data-aos="fade-up">
            <span class="eyebrow">Submit a Manuscript</span>
            <h2 class="section-title">Questions? <em class="gold-italic">Reach Out</em> Now</h2>
            <p class="section-lead">Tell us a little about your project. A senior member of our team will reply personally.</p>
        </div>

        <div class="row g-5 align-items-start mt-3">
            <div class="col-lg-12" data-aos="fade-up">
                <?php include __DIR__ . '/includes/forms/contact-form.php'; ?>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     MAP
     ============================================================ -->
<section class="map-section">
    <div class="container">
        <div class="map-card" data-aos="fade-up">
            <iframe
                src="https://www.openstreetmap.org/export/embed.html?bbox=-6.245%2C53.343%2C-6.235%2C53.349&amp;layer=mapnik&amp;marker=53.3459%2C-6.2403"
                loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="<?= safe(BRAND_NAME) ?> Studio"></iframe>
        </div>
    </div>
</section>

<?php
include __DIR__ . '/includes/cta.php';
include __DIR__ . '/includes/footer.php';
