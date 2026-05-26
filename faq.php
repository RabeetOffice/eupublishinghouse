<?php
require_once __DIR__ . '/includes/config.php';

$page_title       = 'European Publishing House – FAQs & Author Support';
$page_description = 'Find answers to common questions about publishing with European Publishing House. Expert guidance, clear solutions, and support for authors across Europe.';
$page_keywords    = 'publishing FAQ, EU Publishing House questions, manuscript submission, book publishing rights, publishing timelines';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/faq/';

require __DIR__ . '/includes/header.php';

$banner = [
    'crumb'   => 'FAQs',

    'title'   => 'We&rsquo;re Here To Answer All Your <em class="serif-italic">Questions.</em>',
    // 'sub'     => '',
];
include __DIR__ . '/includes/page-banner.php';

$faqs = [
    [
        'q' => 'What services does European Publishing House offer?',
        'a' => 'We cover every part of the publishing process under one roof, book editing across all levels, ghostwriting, cover design, book formatting, marketing, and full publishing with global distribution. You can come to us for a single service or hand the entire process over and let us manage it from manuscript to published book. Either way, you’re working with one team throughout rather than piecing together separate freelancers for each stage.',
    ],

    [
        'q' => 'Do I need to have a completed manuscript before contacting you?',
        'a' => 'Not at all. Some authors come to us with a finished, polished manuscript ready to go. Others are mid-draft and want to understand what the publishing process involves before they get there. Some haven’t started writing yet and need ghostwriting support from the beginning. Whatever stage you’re at, get in touch and we’ll have an honest conversation about where you are and what makes sense from here.',
    ],

    [
        'q' => 'What types of books do you publish?',
        'a' => 'We publish across every genre, fiction, literary fiction, romance, thrillers, science fiction, fantasy, historical fiction, horror, young adult, children’s books, memoirs, autobiographies, business books, self-help, academic writing, non-fiction, and more. If you’ve written it, we’ve almost certainly published something like it before.',
    ],

    [
        'q' => 'What does your book editing service include?',
        'a' => 'It depends on what your manuscript needs. We offer developmental editing for books that need structural and narrative work, line editing for sentence-level flow and voice, copy editing for grammar, punctuation, and consistency, and proofreading as a final pass before publication. Most manuscripts don’t need all four, after reviewing your work, we’ll tell you honestly which type of editing would benefit it most and why.',
    ],

    [
        'q' => 'Will I keep the rights to my book?',
        'a' => 'Yes, always. You retain 100% of your rights throughout the entire process, regardless of which services you use. Your book is yours. We’re here to help you publish it properly, not to take ownership of it.',
    ],

    [
        'q' => 'How long does the publishing process take?',
        'a' => 'It depends on which services your book needs. A manuscript that arrives fully edited and just needs formatting, cover design, and distribution can be live within two to three weeks. A complete publishing package covering editing, design, formatting, and marketing typically takes four to six weeks from start to finish. We’ll give you a realistic timeline at the start of your project based on your manuscript’s current state and your publication goals.',
    ],

    [
        'q' => 'Do you design custom book covers?',
        'a' => 'Yes, every cover we produce is custom built around your specific book. We don’t work from templates or reuse designs across different titles. You’ll receive multiple initial concepts, give feedback on the direction you prefer, and we refine from there with unlimited revisions until the cover is exactly right. We design eBook covers, full print wraparounds, children’s book illustrations, spine and back cover layouts, and series branding.',
    ],

    [
        'q' => 'Can you help promote my book after publishing?',
        'a' => 'Yes. Our marketing services cover Amazon listing optimisation, social media campaigns, email marketing, book launch planning, paid advertising, author branding, review generation, and book fair promotion. Some authors come to us for marketing support before their book launches. Others get in touch after publication when sales aren’t moving the way they hoped. We work with both, building campaigns around your specific book, genre, and audience rather than applying a generic strategy.',
    ],

    [
        'q' => 'Is your publishing service suitable for first-time authors?',
        'a' => 'Absolutely, and a significant part of the authors we work with are publishing for the first time. The process can feel overwhelming when you don’t know what’s involved, our job is to make it straightforward. We explain every stage, give honest advice at every decision point, and make sure you understand what’s happening with your book throughout. You won’t be left guessing or handed a technical process to navigate alone.',
    ],

    [
        'q' => 'How can I get started with European Publishing House?',
        'a' => 'Get in touch through our contact page and tell us a bit about your book, what it is, where it’s at, and what you’re looking to do with it. From there we’ll have a free consultation, talk through your project properly, and put together a clear plan and quote based on what your book actually needs. No pressure, no obligation, just an honest conversation to start.',
    ],

    [
        'q' => 'Do you offer ghostwriting services?',
        'a' => 'Yes. Our ghostwriters work across fiction, non-fiction, memoirs, business books, children’s stories, self-help, academic writing, and eBooks. You brief us on your idea, your story, or your expertise, and we write the manuscript. You keep 100% ownership of everything produced and complete confidentiality is guaranteed throughout. The finished book is entirely yours.',
    ],

    [
        'q' => 'Will my book be available in both print and digital formats?',
        'a' => 'Yes. We publish in both eBook and print formats, paperback and hardback, and distribute across Amazon KDP, Apple Books, Kobo, Google Play, IngramSpark, Barnes & Noble, and 150+ retailers worldwide. Most authors publish in both formats, and we handle the formatting and distribution for each one. Publishing in print and digital from the start gives your book the widest possible reach from day one.',
    ],

    [
        'q' => 'Do you help with book formatting and layout?',
        'a' => 'Yes. We format manuscripts for every format and every platform, ePub for Apple Books, Kobo, and Google Play, MOBI for Kindle, and print-ready PDFs for paperback and hardback editions. Every file is built to each platform’s exact technical specifications so it passes review first time and displays correctly on every device. We handle eBook and print formatting together or separately depending on what your project needs.',
    ],

    [
        'q' => 'Can I be involved in the editing and design process?',
        'a' => 'Completely. Every stage of the process involves your input and approval. In editing, you receive tracked changes with explanations for every significant suggestion, nothing is changed without your knowledge, and every edit is yours to accept or reject. In cover design, you see multiple concepts, give feedback, and we revise until the cover is exactly what you want. You stay in control of your book throughout. We’re here to advise and execute, not to override your vision.',
    ],

    [
        'q' => 'How much do your publishing services cost?',
        'a' => 'Costs vary depending on which services your book needs and how much work is involved. A straightforward eBook needing only formatting and distribution is a very different project from a full package covering editing, cover design, formatting, marketing, and global distribution. We don’t publish fixed prices because they rarely reflect what a specific project actually costs. Get in touch, tell us about your book, and we’ll give you a clear and honest quote built around your manuscript specifically. No generic packages, no hidden fees.',
    ],
];
?>

<section class="faq-section" id="faq">
    <div class="container">
        <div class="row g-5 align-items-start">
            <!-- <div class="col-lg-4" data-aos="fade-right">
                <span class="eyebrow">Frequently Asked</span>
                <h2 class="section-title">We&rsquo;re Here To Answer All Your <em class="serif-italic">Questions.</em></h2>
                <p class="section-lead">Can&rsquo;t find what you&rsquo;re looking for? Speak with our team directly.</p>
                <a href="contact.php" class="btn btn-cta">Get in Touch <i class="fa-solid fa-arrow-right"></i></a>
            </div> -->

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
include __DIR__ . '/includes/footer.php';
