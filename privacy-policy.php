<?php
require_once __DIR__ . '/includes/config.php';

$page_title       = 'Privacy Policy | ' . BRAND_NAME;
$page_description = 'How European Publishing House collects, uses, and safeguards your information when you visit our website or engage our services.';
$page_keywords    = 'privacy policy EU Publishing House, data protection, GDPR';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/privacy-policy.php';

require __DIR__ . '/includes/header.php';

$banner = [
    'crumb' => 'Privacy Policy',
    'title' => 'Privacy <em class="serif-italic">Policy</em>',
    'sub'   => 'How European Publishing House collects, uses, and safeguards your information.',
];
include __DIR__ . '/includes/page-banner.php';

/* Ordered list of (anchor, title) pairs — drives the sticky TOC and each
 * section card's heading. Content for each section is below in the same order. */
$sections = [
    ['intro',       'Introduction'],
    ['collect',     'Information We Collect'],
    ['use',         'How We Use Your Information'],
    ['protect',     'How We Protect Your Information'],
    ['sharing',     'Sharing Your Information'],
    ['cookies',     'Cookies and Tracking Technologies'],
    ['rights',      'Your Rights and Choices'],
    ['third-party', 'Third-Party Links'],
    ['children',    'Children&rsquo;s Privacy'],
    ['changes',     'Changes to This Privacy Policy'],
    ['contact',     'Contact Us'],
];
?>

<section class="legal-section">
    <div class="container">
        <div class="legal-layout">

            <aside class="legal-toc" aria-label="On this page">
                <span class="legal-toc__label">On this page</span>
                <ol class="legal-toc__list">
                    <?php foreach ($sections as $i => [$anchor, $title]): ?>
                        <li>
                            <a href="#<?= safe($anchor) ?>">
                                <span class="legal-toc__num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                                <span><?= $title ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </aside>

            <div class="legal-body" data-aos="fade-up">

                <article class="legal-card" id="intro">
                    <span class="legal-card__num">01</span>
                    <h2 class="legal-card__title">Introduction</h2>
                    <p>European Publishing House is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website. By accessing or using our site, you agree to the terms of this Privacy Policy.</p>
                </article>

                <article class="legal-card" id="collect">
                    <span class="legal-card__num">02</span>
                    <h2 class="legal-card__title">Information We Collect</h2>
                    <p>We may collect personal information when you visit our site, sign up for our newsletter, make a purchase, or engage with us in other ways. The types of personal information we collect may include:</p>
                    <ul class="legal-list">
                        <li><strong>Contact Information:</strong> Name, email address, mailing address, and phone number.</li>
                        <li><strong>Payment Information:</strong> Credit card details or other payment information.</li>
                        <li><strong>Usage Data:</strong> Information about your browsing activity on our site, such as IP address, browser type, and pages visited.</li>
                        <li><strong>Newsletter &amp; Marketing Preferences:</strong> Preferences regarding communication from us.</li>
                    </ul>
                </article>

                <article class="legal-card" id="use">
                    <span class="legal-card__num">03</span>
                    <h2 class="legal-card__title">How We Use Your Information</h2>
                    <p>We use the information we collect for the following purposes:</p>
                    <ul class="legal-list">
                        <li>To process and fulfil orders, including sending order confirmations and updates.</li>
                        <li>To communicate with you about your account, orders, or enquiries.</li>
                        <li>To send promotional emails or newsletters if you have opted in to receive them.</li>
                        <li>To improve our site and services, including analysing user behaviour to enhance user experience.</li>
                        <li>To comply with legal obligations or enforce our legal rights.</li>
                    </ul>
                </article>

                <article class="legal-card" id="protect">
                    <span class="legal-card__num">04</span>
                    <h2 class="legal-card__title">How We Protect Your Information</h2>
                    <p>We implement a variety of security measures to maintain the safety of your personal information. We use encryption, including SSL technology, to protect sensitive information transmitted online. We also use secure servers and restrict access to your personal data to authorised personnel only.</p>
                </article>

                <article class="legal-card" id="sharing">
                    <span class="legal-card__num">05</span>
                    <h2 class="legal-card__title">Sharing Your Information</h2>
                    <p>We do not sell, rent, or trade your personal information to third parties. However, we may share your information in the following circumstances:</p>
                    <ul class="legal-list">
                        <li><strong>Service Providers:</strong> We may share information with trusted third-party service providers who assist us in operating our business, such as payment processors and email marketing services.</li>
                        <li><strong>Legal Compliance:</strong> We may disclose your information if required by law, such as in response to a court order or government request.</li>
                        <li><strong>Business Transfers:</strong> In the event of a merger, acquisition, or sale of European Publishing House, your information may be transferred as part of that transaction.</li>
                    </ul>
                </article>

                <article class="legal-card" id="cookies">
                    <span class="legal-card__num">06</span>
                    <h2 class="legal-card__title">Cookies and Tracking Technologies</h2>
                    <p>We use cookies and other tracking technologies to improve the functionality and performance of our site. These technologies allow us to remember your preferences, analyse trends, and gather information about how users interact with our site. You can choose to disable cookies through your browser settings, though doing so may limit certain features on our site.</p>
                </article>

                <article class="legal-card" id="rights">
                    <span class="legal-card__num">07</span>
                    <h2 class="legal-card__title">Your Rights and Choices</h2>
                    <p>You have the following rights regarding your personal information:</p>
                    <ul class="legal-list">
                        <li><strong>Access &amp; Correction:</strong> You may request to access or correct your personal information by contacting us directly.</li>
                        <li><strong>Opt-Out:</strong> You can unsubscribe from marketing communications at any time by following the instructions in any email we send or by contacting us directly.</li>
                        <li><strong>Data Deletion:</strong> You may request the deletion of your personal information, subject to certain legal exceptions.</li>
                    </ul>
                </article>

                <article class="legal-card" id="third-party">
                    <span class="legal-card__num">08</span>
                    <h2 class="legal-card__title">Third-Party Links</h2>
                    <p>Our site may contain links to third-party websites. We are not responsible for the privacy practices or content of those websites. We encourage you to review the privacy policies of any third-party websites before providing them with your personal information.</p>
                </article>

                <article class="legal-card" id="children">
                    <span class="legal-card__num">09</span>
                    <h2 class="legal-card__title">Children&rsquo;s Privacy</h2>
                    <p>Our site is not intended for children under the age of 13. We do not knowingly collect personal information from children. If we become aware that we have collected information from a child under 13, we will take steps to delete that information promptly.</p>
                </article>

                <article class="legal-card" id="changes">
                    <span class="legal-card__num">10</span>
                    <h2 class="legal-card__title">Changes to This Privacy Policy</h2>
                    <p>We may update this Privacy Policy from time to time. When we make changes, we will update the effective date at the top of the policy. We encourage you to review this Privacy Policy periodically to stay informed about how we are protecting your information.</p>
                </article>

                <article class="legal-card legal-card--accent" id="contact">
                    <span class="legal-card__num">11</span>
                    <h2 class="legal-card__title">Contact Us</h2>
                    <p>If you have any questions about this Privacy Policy or how we handle your personal information, please get in touch with us through our <a href="<?= safe(link_to('contact.php')) ?>">contact page</a>.</p>
                </article>

            </div>
        </div>
    </div>
</section>

<?php
include __DIR__ . '/includes/footer.php';
