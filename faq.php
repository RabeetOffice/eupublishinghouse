<?php
require_once __DIR__ . '/includes/config.php';

$page_title       = 'Frequently Asked Questions | ' . BRAND_NAME;
$page_description = '15 honest answers to the questions authors ask most often about publishing with European Publishing House, services, rights, timelines, and pricing.';
$page_keywords    = 'publishing FAQ, EU Publishing House questions, manuscript submission, book publishing rights, publishing timelines';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/faq.php';

require __DIR__ . '/includes/header.php';

$banner = [
    'crumb'   => 'FAQs',
    'eyebrow' => 'Frequently Asked',
    'title'   => 'We&rsquo;re Here To Answer All Your <em class="gold-italic">Questions.</em>',
    'sub'     => 'A short brief on how we work, who we publish, and what authors can expect.',
];
include __DIR__ . '/includes/page-banner.php';

$faqs = [
    [
        'q' => 'What services does European Publishing House offer?',
        'a' => 'We cover every part of the publishing process under one roof, book editing across all levels, ghostwriting, cover design, book formatting, marketing, and full publishing with global distribution.',
    ],
    [
        'q' => 'Do I need to have a completed manuscript before contacting you?',
        'a' => 'Not at all. Some authors come to us with a finished, polished manuscript ready to go. Others are mid-draft and want to understand what the publishing process involves before they get there.',
    ],
    [
        'q' => 'What types of books do you publish?',
        'a' => 'We publish across every genre, fiction, literary fiction, romance, thrillers, science fiction, fantasy, historical fiction, horror, young adult, children\'s books, memoirs, autobiographies, business books, self-help, academic writing, non-fiction, and more.',
    ],
    [
        'q' => 'What does your book editing service include?',
        'a' => 'We offer developmental editing for books that need structural and narrative work, line editing for sentence-level flow and voice, copy editing for grammar, punctuation, and consistency, and proofreading as a final pass.',
    ],
    [
        'q' => 'Will I keep the rights to my book?',
        'a' => 'Yes, always. You retain 100% of your rights throughout the entire process, regardless of which services you use.',
    ],
    [
        'q' => 'How long does the publishing process take?',
        'a' => 'Timeline depends on services needed, two to three weeks for formatting-only work, or four to six weeks for complete packages. We&rsquo;ll give you a clear timeline at the start of your project.',
    ],
    [
        'q' => 'Do you design custom book covers?',
        'a' => 'Yes, every cover we produce is custom built around your specific book. We don&rsquo;t work from templates or reuse designs across different titles.',
    ],
    [
        'q' => 'Can you help promote my book after publishing?',
        'a' => 'Yes. Our marketing services cover Amazon listing optimisation, social media campaigns, email marketing, book launch planning, paid advertising, author branding, review generation, and book fair promotion.',
    ],
    [
        'q' => 'Is your publishing service suitable for first-time authors?',
        'a' => 'Absolutely, and a significant part of the authors we work with are publishing for the first time. We walk you through every stage of the process without making you feel foolish for not already knowing it.',
    ],
    [
        'q' => 'How can I get started with European Publishing House?',
        'a' => 'Contact us through our website, describe your project, and we&rsquo;ll have a free consultation, talk through your project properly, and put together a clear plan and quote.',
    ],
    [
        'q' => 'Do you offer ghostwriting services?',
        'a' => 'Yes. Our ghostwriters work across fiction, non-fiction, memoirs, business books, children\'s stories, self-help, academic writing, and eBooks.',
    ],
    [
        'q' => 'Will my book be available in both print and digital formats?',
        'a' => 'Yes. We publish in both eBook and print formats, paperback and hardback, and distribute across Amazon KDP, Apple Books, Kobo, Google Play, IngramSpark, Barnes &amp; Noble, and 150+ retailers worldwide.',
    ],
    [
        'q' => 'Do you help with book formatting and layout?',
        'a' => 'Yes. We format manuscripts for every format and every platform, ePub for Apple Books, Kobo, and Google Play, MOBI for Kindle, and print-ready PDFs.',
    ],
    [
        'q' => 'Can I be involved in the editing and design process?',
        'a' => 'Completely. Every stage of the process involves your input and approval. Nothing is finalised without your sign-off.',
    ],
    [
        'q' => 'How much do your publishing services cost?',
        'a' => 'Costs vary depending on which services your book needs and how much work is involved. We don&rsquo;t publish fixed prices because they rarely reflect what a specific project actually costs. Get in touch and we&rsquo;ll talk through your project and give you a clear, transparent quote.',
    ],
];
?>

<section class="faq-section" id="faq">
    <div class="container">
        <div class="row g-5 align-items-start">
            <div class="col-lg-4" data-aos="fade-right">
                <span class="eyebrow">Frequently Asked</span>
                <h2 class="section-title">We&rsquo;re Here To Answer All Your <em class="gold-italic">Questions.</em></h2>
                <p class="section-lead">Can&rsquo;t find what you&rsquo;re looking for? Speak with our team directly.</p>
                <a href="contact.php" class="btn btn-cta">Get in Touch <i class="fa-solid fa-arrow-right"></i></a>
            </div>

            <div class="col-lg-8" data-aos="fade-left" data-aos-delay="100">
                <div class="accordion faq-accordion" id="faqAcc">
                    <?php foreach ($faqs as $i => $f): ?>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button <?= $i === 0 ? '' : 'collapsed' ?>" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq<?= $i ?>"
                                    aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>" aria-controls="faq<?= $i ?>">
                                <span class="faq-num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                                <?= $f['q'] ?>
                            </button>
                        </h3>
                        <div id="faq<?= $i ?>" class="accordion-collapse collapse <?= $i === 0 ? 'show' : '' ?>" data-bs-parent="#faqAcc">
                            <div class="accordion-body"><p><?= $f['a'] ?></p></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include __DIR__ . '/includes/cta.php';
include __DIR__ . '/includes/footer.php';
