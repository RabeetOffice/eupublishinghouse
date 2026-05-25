<?php
require_once __DIR__ . '/includes/config.php';

$page_title       = 'Terms & Conditions | ' . BRAND_NAME;
$page_description = 'The terms that govern your use of the European Publishing House website and our publishing, editing, design, formatting and marketing services.';
$page_keywords    = 'terms and conditions, EU Publishing House terms, publishing agreement';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/terms-conditions.php';

require __DIR__ . '/includes/header.php';

$banner = [
    'crumb' => 'Terms & Conditions',
    'title' => 'Terms &amp; <em class="serif-italic">Conditions</em>',
    'sub'   => 'The terms that govern your use of the European Publishing House website and services.',
];
include __DIR__ . '/includes/page-banner.php';

$sections = [
    ['intro',        'Introduction'],
    ['services',     'Services'],
    ['ip',           'Intellectual Property &amp; Ownership'],
    ['payment',      'Payment Terms'],
    ['confidential', 'Confidentiality'],
    ['revisions',    'Revisions and Approvals'],
    ['turnaround',   'Turnaround Times'],
    ['liability',    'Limitation of Liability'],
    ['platforms',    'Third-Party Platforms'],
    ['termination',  'Termination'],
    ['changes',      'Changes to These Terms'],
    ['law',          'Governing Law'],
    ['contact',      'Contact Us'],
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
                    <p>These Terms and Conditions govern your use of the European Publishing House website and the services we provide. By accessing our site or engaging our services, you agree to be bound by these terms. Please read them carefully before proceeding.</p>
                </article>

                <article class="legal-card" id="services">
                    <span class="legal-card__num">02</span>
                    <h2 class="legal-card__title">Services</h2>
                    <p>European Publishing House provides book publishing services including but not limited to editing, ghostwriting, cover design, formatting, marketing, and global distribution. The specific scope of services provided to each client will be agreed upon in writing prior to commencement of any project.</p>
                </article>

                <article class="legal-card" id="ip">
                    <span class="legal-card__num">03</span>
                    <h2 class="legal-card__title">Intellectual Property &amp; Ownership</h2>
                    <p>All rights to your manuscript, book, and associated content remain entirely yours throughout and after the publishing process. European Publishing House does not claim ownership over any content produced on your behalf. Any materials created by European Publishing House as part of your project, including cover designs, formatted files, and marketing materials, are transferred to you in full upon completion of payment.</p>
                </article>

                <article class="legal-card" id="payment">
                    <span class="legal-card__num">04</span>
                    <h2 class="legal-card__title">Payment Terms</h2>
                    <p>Payment terms for each project will be agreed upon in writing before work begins. European Publishing House reserves the right to pause or cease work on a project in the event of non-payment. All fees quoted are inclusive of the services outlined in your project agreement. Any additional services requested outside the original scope will be quoted and agreed separately before being carried out.</p>
                </article>

                <article class="legal-card" id="confidential">
                    <span class="legal-card__num">05</span>
                    <h2 class="legal-card__title">Confidentiality</h2>
                    <p>European Publishing House treats all client projects, manuscripts, and personal information with strict confidentiality. We do not share, discuss, or disclose details of any client project to third parties without your explicit consent, except where required by law.</p>
                </article>

                <article class="legal-card" id="revisions">
                    <span class="legal-card__num">06</span>
                    <h2 class="legal-card__title">Revisions and Approvals</h2>
                    <p>All editing, design, and formatting work is subject to a review and approval process. Nothing is finalised without your explicit approval. Revision policies specific to each service will be outlined in your project agreement.</p>
                </article>

                <article class="legal-card" id="turnaround">
                    <span class="legal-card__num">07</span>
                    <h2 class="legal-card__title">Turnaround Times</h2>
                    <p>Estimated timelines provided at the start of a project are given in good faith and are based on the information available at that time. European Publishing House will always aim to meet agreed deadlines and will communicate promptly if any delays arise. We are not liable for delays caused by factors outside our reasonable control.</p>
                </article>

                <article class="legal-card" id="liability">
                    <span class="legal-card__num">08</span>
                    <h2 class="legal-card__title">Limitation of Liability</h2>
                    <p>European Publishing House will always endeavour to deliver services to a professional standard. However, we cannot guarantee specific commercial outcomes, including sales figures or reader reviews, as these are subject to market factors outside our control. Our liability in any circumstance is limited to the value of the services provided under your project agreement.</p>
                </article>

                <article class="legal-card" id="platforms">
                    <span class="legal-card__num">09</span>
                    <h2 class="legal-card__title">Third-Party Platforms</h2>
                    <p>European Publishing House distributes books through third-party platforms including Amazon KDP, Apple Books, Kobo, IngramSpark, and others. We are not responsible for the policies, decisions, or technical requirements of these platforms, which are subject to change. We will always work to meet current platform requirements at the time of publication.</p>
                </article>

                <article class="legal-card" id="termination">
                    <span class="legal-card__num">10</span>
                    <h2 class="legal-card__title">Termination</h2>
                    <p>Either party may terminate a project agreement with written notice. In the event of termination, payment will be due for all work completed up to the date of termination. Any materials produced up to that point will be provided to the client upon receipt of payment for completed work.</p>
                </article>

                <article class="legal-card" id="changes">
                    <span class="legal-card__num">11</span>
                    <h2 class="legal-card__title">Changes to These Terms</h2>
                    <p>We may update these Terms and Conditions from time to time. When we do, we will update the effective date at the top of this page. Continued use of our site or services following any changes constitutes your acceptance of the updated terms.</p>
                </article>

                <article class="legal-card" id="law">
                    <span class="legal-card__num">12</span>
                    <h2 class="legal-card__title">Governing Law</h2>
                    <p>These Terms and Conditions are governed by and construed in accordance with the laws of Europe. Any disputes arising from these terms or our services will be subject to the jurisdiction of the relevant courts.</p>
                </article>

                <article class="legal-card legal-card--accent" id="contact">
                    <span class="legal-card__num">13</span>
                    <h2 class="legal-card__title">Contact Us</h2>
                    <p>If you have any questions about these Terms and Conditions, please get in touch with us through our <a href="<?= safe(link_to('contact.php')) ?>">contact page</a>.</p>
                </article>

            </div>
        </div>
    </div>
</section>

<?php
include __DIR__ . '/includes/footer.php';
