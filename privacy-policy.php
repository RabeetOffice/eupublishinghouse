<?php
require_once __DIR__ . '/includes/config.php';

$page_title       = 'Privacy Policy | ' . BRAND_NAME;
$page_description = 'How European Publishing House collects, uses, and safeguards your information when you visit our website or engage our services.';
$page_keywords    = 'privacy policy EU Publishing House, data protection, GDPR';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/privacy-policy.php';

require __DIR__ . '/includes/header.php';

$banner = [
    'crumb'   => 'Privacy Policy',
    'eyebrow' => 'Legal',
    'title'   => 'Privacy <em class="gold-italic">Policy</em>',
    'sub'     => 'How European Publishing House collects, uses, and safeguards your information.',
];
include __DIR__ . '/includes/page-banner.php';
?>

<section class="legal-section" style="padding-block:80px;background:var(--c-ivory);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 legal-body" data-aos="fade-up">
                <p><strong>Effective Date:</strong> 1 January 2026</p>

                <h2>Introduction</h2>
                <p>European Publishing House is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website. By accessing or using our site, you agree to the terms of this Privacy Policy.</p>

                <h2>Information We Collect</h2>
                <p>We gather personal data through website visits, newsletter signups, purchases, manuscript submissions, and other interactions with our team. The categories of information we collect include:</p>
                <ul>
                    <li><strong>Contact Information:</strong> Name, email address, mailing address, and phone number.</li>
                    <li><strong>Payment Information:</strong> Credit card details or other payment information when you purchase services.</li>
                    <li><strong>Manuscript &amp; Project Information:</strong> Manuscripts, briefs, draft material, project notes, and any other content you choose to share with us in the course of working together.</li>
                    <li><strong>Usage Data:</strong> Information about your browsing activity on our site, such as IP address, browser type, pages visited, and time spent on each page.</li>
                    <li><strong>Newsletter &amp; Marketing Preferences:</strong> Your preferences regarding communication from us.</li>
                </ul>

                <h2>How We Use Your Information</h2>
                <p>We use the information we collect for the following purposes:</p>
                <ul>
                    <li>To deliver the services you have requested, including editing, publishing, design, formatting and marketing.</li>
                    <li>To communicate with you about your account, project status, or any enquiries you raise.</li>
                    <li>To send you marketing or promotional communications, but only where you have consented to receive them.</li>
                    <li>To improve our services, website, and overall author experience.</li>
                    <li>To meet our legal, regulatory and accounting obligations.</li>
                </ul>

                <h2>How We Protect Your Information</h2>
                <p>We implement a variety of security measures to maintain the safety of your personal information. We use encryption, including SSL technology, to protect sensitive information transmitted online. Access to client data is restricted to team members who need it to perform their work.</p>

                <h2>Sharing Your Information</h2>
                <p>We do not sell your personal information. We may share information with:</p>
                <ul>
                    <li><strong>Service providers</strong> who help us operate our business (such as payment processors, hosting providers, or email platforms), under appropriate confidentiality obligations.</li>
                    <li><strong>Legal authorities</strong> where required by law, court order, or to protect our rights and the rights of others.</li>
                    <li><strong>Successor entities</strong> in the event of a merger, acquisition, or restructuring of our business.</li>
                </ul>

                <h2>Cookies and Tracking Technologies</h2>
                <p>Our website uses cookies and similar technologies to provide a better browsing experience, analyse traffic, and improve our content. You can choose to disable cookies through your browser settings, though doing so may limit certain features on our site.</p>

                <h2>Your Rights and Choices</h2>
                <p>Depending on where you live, you may have certain rights regarding your personal information, including the right to:</p>
                <ul>
                    <li>Access the personal information we hold about you.</li>
                    <li>Request correction of any inaccurate or incomplete information.</li>
                    <li>Request deletion of your personal information, subject to legal and contractual obligations.</li>
                    <li>Opt out of marketing communications at any time.</li>
                </ul>
                <p>To exercise any of these rights, please contact us at <a href="mailto:<?= EMAIL_ADDRESS ?>"><?= safe(EMAIL_ADDRESS) ?></a>.</p>

                <h2>Third-Party Links</h2>
                <p>Our website may contain links to third-party websites. We are not responsible for the privacy practices or content of those external sites and encourage you to review their privacy policies before sharing any personal information with them.</p>

                <h2>Children&rsquo;s Privacy</h2>
                <p>Our website and services are not directed at children under 13. We do not knowingly collect personal information from children under 13. If you believe a child has provided us with information without parental consent, please contact us so that we can remove it.</p>

                <h2>Changes to This Privacy Policy</h2>
                <p>We may update this Privacy Policy from time to time. When we do, we will update the effective date at the top of this page. Continued use of our site or services following any changes constitutes your acceptance of the updated policy.</p>

                <h2>Contact Us</h2>
                <p>If you have questions about this Privacy Policy or how we handle your information, please contact us:</p>
                <ul>
                    <li><strong>Email:</strong> <a href="mailto:<?= EMAIL_ADDRESS ?>"><?= safe(EMAIL_ADDRESS) ?></a></li>
                    <li><strong>Phone:</strong> <a href="tel:<?= PHONE_NUMBER_RAW ?>"><?= safe(PHONE_NUMBER) ?></a></li>
                    <li><strong>Address:</strong> <?= safe(ADDRESS) ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php
include __DIR__ . '/includes/final-cta.php';
include __DIR__ . '/includes/footer.php';
