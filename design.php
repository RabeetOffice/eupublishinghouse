<?php
require_once __DIR__ . '/includes/config.php';

$page_title       = 'Book Cover Design Services in Europe | ' . BRAND_NAME;
$page_description = 'Custom book cover design for eBook, paperback wraparounds, audiobooks, series branding and children\'s illustration. Multiple concepts, unlimited revisions.';
$page_keywords    = 'book cover design Europe, custom cover design, eBook cover, print wraparound, children\'s book illustration, series branding';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/design.php';

require __DIR__ . '/includes/header.php';

$hero = [
    'crumb'      => 'Cover Design',
    'title'      => 'Book Cover Design Services in <em class="serif-italic">Europe</em>',
    'paragraphs' => [
        "Two seconds. That's roughly how long your cover has to make someone stop scrolling on Amazon and actually look. In a bookshop it's even less, a spine catching the eye, a front cover doing its job before the reader has consciously decided to pick it up. A cover that doesn't work in those two seconds is a sale that doesn't happen, and no amount of good writing makes up for it.",
        "The covers that work aren't accidental. They're built around a deep understanding of genre, reader expectations, and what makes one book stand out from the fifty others sitting in the same category. Typography, colour, imagery, composition, every decision is deliberate, and every deliberate decision serves the book.",
        "At European Publishing House, we design covers from scratch for fiction, non-fiction, children's books, academic titles, and everything that sits between those categories. There are no templates being pulled from a library and personalised with your title. No designs recycled from a previous project with the name changed. Every cover starts with your book specifically, what it's about, who it's for, and what it needs to communicate before a reader has read a single word.",
    ],
    'ctas' => [
        ['label' => 'Get Started',  'href' => '#popup',          'class' => 'btn-cta',  'popup' => true],
        ['label' => 'See Formats',  'href' => '#cover-services', 'class' => 'btn-glass'],
    ],
];
include __DIR__ . '/includes/service-hero.php';
include __DIR__ . '/includes/distributors.php';
?>

<section class="services-section" id="cover-services">
    <div class="container">
        <div class="section-head text-center" data-aos="fade-up">
            <span class="eyebrow">Cover Formats</span>
            <h2 class="section-title">Book Cover Design Services <em class="serif-italic">We Offer</em></h2>
            <p class="hero-sub" style="max-width:760px;margin-inline:auto;">Every format your book needs, designed by people who understand how covers actually sell.</p>
        </div>

        <div class="services-grid mt-5">
            <article class="service-card" data-aos="fade-up">
                <span class="service-icon"><i class="fa-solid fa-mobile-screen-button"></i></span>
                <h3 class="service-title">eBook Cover Design</h3>
                <p class="service-desc">Your eBook cover needs to work at thumbnail size on Amazon, Apple Books, Kobo, and Google Play, often no bigger than a postage stamp on a mobile screen. We design for that reality first.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="70">
                <span class="service-icon"><i class="fa-solid fa-book"></i></span>
                <h3 class="service-title">Print Wraparound Design</h3>
                <p class="service-desc">A print book needs a full wraparound design, front cover, back cover, and spine all working together as a single piece. Built to your printer&rsquo;s exact specifications.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="140">
                <span class="service-icon"><i class="fa-solid fa-grip-lines-vertical"></i></span>
                <h3 class="service-title">Spine &amp; Back Cover</h3>
                <p class="service-desc">The spine is what readers see first when your book is shelved. The back cover is where a browser decides whether to open it. Both deserve the same care as the front.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="210">
                <span class="service-icon"><i class="fa-solid fa-paintbrush"></i></span>
                <h3 class="service-title">Children&rsquo;s Book Illustration</h3>
                <p class="service-desc">Children&rsquo;s books live and die by their illustrations. The art has to carry the story, work for the age group, and be the kind of thing a child wants to look at again and again.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <article class="service-card" data-aos="fade-up">
                <span class="service-icon"><i class="fa-solid fa-layer-group"></i></span>
                <h3 class="service-title">Series Branding</h3>
                <p class="service-desc">If you&rsquo;re publishing more than one book, series branding matters enormously. Consistent visual language across covers builds reader trust and recognition.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="70">
                <span class="service-icon"><i class="fa-solid fa-bullhorn"></i></span>
                <h3 class="service-title">Marketing &amp; Promo Graphics</h3>
                <p class="service-desc">A great cover is the starting point for your marketing materials, not the end of them. We produce 3D mockups, social banners, and ad creatives built from your cover.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
        </div>
    </div>
</section>

<section class="why-eph-sec" id="value">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="why-eph-art">
                    <img src="assets/images/livesite/AuthorChoose.jpg" alt="What a professional book cover actually does" loading="lazy" decoding="async">
                    <span class="why-eph-art__chip">Custom</span>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">What a Great Cover Does</span>
                <h2 class="section-title">What a professional book cover <em class="serif-italic">actually does</em></h2>
                <p>A great cover communicates genre, tone, and audience before a reader has read a single word. It tells a thriller reader this is for them. It tells a romance reader the same. It positions your book correctly in the market and gives readers the visual cues they've come to expect from the category you're publishing in, while still standing out from everything around it.</p>
                <p>Getting that balance right takes more than good design skills. It takes an understanding of what's selling in your genre, what readers respond to, and how a cover translates across formats, from a thumbnail on a phone screen to a full wraparound in print.</p>
                <p>Our design team at European Publishing House works across every genre and every format. We start by understanding your book properly, the story, the tone, the audience, and the feel you're going for, before a single concept is developed. You'll see multiple directions, give feedback, and we keep refining until the cover is exactly right. Unlimited revisions, always.</p>
                <ul class="genre-list mt-3" role="list">
                    <li><i class="fa-solid fa-check"></i>Custom designs built around your book, not repurposed templates</li>
                    <li><i class="fa-solid fa-check"></i>Every genre, every format, every platform</li>
                    <li><i class="fa-solid fa-check"></i>Multiple concepts to choose from</li>
                    <li><i class="fa-solid fa-check"></i>Unlimited revisions until you're completely happy</li>
                </ul>
                <div class="mt-4">
                    <a href="#popup" class="btn btn-cta" data-popup>Brief Your Cover <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/categories.php'; ?>

<section class="publish-cost-sec" id="pricing">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="publish-cost-art">
                    <img src="assets/images/livesite/publishCostsection.jpg" alt="How much does book cover design cost in Europe" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Pricing</span>
                <h2 class="section-title">How much does book cover design cost in <em class="serif-italic">Europe?</em></h2>
                <p>Cover design costs depend on what your book needs. An eBook cover for a straightforward non-fiction title is a different project from a full illustrated wraparound for a fantasy novel or a complete illustration set for a children's picture book. The complexity of the design, the number of formats required, and whether illustration is involved all affect the pricing.</p>
                <p>What stays the same regardless of project size is our revision policy, unlimited revisions until your cover is exactly what you want. We don't charge extra for going back and forth until it's right.</p>
                <p>Get in touch and tell us about your book. We'll talk through what your cover needs and give you a clear, honest quote built around your specific project.</p>
                <a href="#popup" class="btn btn-cta btn-lg" data-popup>Get Your Free Design Quote <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<?php
$exclude_slug = 'design';
include __DIR__ . '/includes/books.php';
include __DIR__ . '/includes/services.php';
?>

<section class="faq-section" id="faq">
    <div class="container">
        <div class="row g-5 align-items-start">
            <div class="col-lg-4" data-aos="fade-right">
                <span class="eyebrow">FAQs</span>
                <h2 class="section-title">We&rsquo;re here to answer all your <em class="serif-italic">questions</em></h2>
                <p>Can&rsquo;t find what you&rsquo;re looking for? Speak with our team directly.</p>
                <a href="contact.php" class="btn btn-cta" data-no-popup>Get in Touch <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <div class="col-lg-8" data-aos="fade-left" data-aos-delay="100">
                <div class="accordion faq-accordion" id="designFaq">
                    <?php
                    $faqs = [
                        ['q' => 'How much does book cover design cost in Europe?',
                         'a' => "Book cover design costs in Europe vary depending on the type of cover, the genre, and what's involved in producing it. A straightforward eBook cover sits at a different price point from a fully illustrated children's book cover or a complete series branding package. Most professional designers charge per project rather than per hour, and the complexity of the brief is what drives the cost. We don't quote without understanding your book first, get in touch and we'll give you a clear, transparent price based on exactly what your cover needs."],
                        ['q' => 'What makes a professional book cover design in Europe?',
                         'a' => "A professional cover does several things at once. It signals genre clearly enough that the right readers recognise it immediately. It uses typography, imagery, and colour in a way that's consistent with what's selling in that category. It works at every size, from a small thumbnail on a phone to a full-size print edition. And it stands out from the titles around it without looking like it doesn't belong in the same genre. The difference between a professional cover and an amateur one is usually obvious within seconds, even to readers who couldn't explain exactly why."],
                        ['q' => 'How long does it take to design a book cover?',
                         'a' => "A standard book cover design typically takes two to three weeks from briefing to final files, accounting for concept development, your feedback, and revision rounds. More complex projects, full wraparound print covers, children's book illustrations, or complete series branding, take longer, usually three to five weeks depending on the scope. If you have a specific launch deadline, let us know at the start and we'll work to a timeline that fits. Rush turnarounds are possible in some cases, though we'd always rather give a cover the time it deserves."],
                        ['q' => 'Do book cover designers in Europe provide eBook and print cover formats?',
                         'a' => "Yes. We provide final files in every format your book needs, optimised eBook covers sized for Amazon KDP, Apple Books, Kobo, and Google Play, as well as full print-ready wraparound files built to your printer's exact specifications. If you're publishing in both formats, which most authors do, we design both from the start so they're consistent and properly sized for each use. You won't need to take a file to a third party to get it reformatted."],
                        ['q' => 'Can I request revisions for my book cover design?',
                         'a' => "Yes, unlimited revisions, always. We keep refining until the cover is exactly what you want. That's not a marketing line; it's genuinely how we work. You'll see multiple initial concepts, give feedback on the direction you prefer, and we develop that direction through as many rounds as it takes. Nothing is finalised until you're completely happy with it. Your cover represents your book, and it needs to be right."],
                    ];
                    foreach ($faqs as $i => $f): ?>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button <?= $i === 0 ? '' : 'collapsed' ?>" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#designFaq<?= $i ?>"
                                    aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>" aria-controls="designFaq<?= $i ?>">
                                <span class="faq-num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                                <?= $f['q'] ?>
                            </button>
                        </h3>
                        <div id="designFaq<?= $i ?>" class="accordion-collapse collapse <?= $i === 0 ? 'show' : '' ?>" data-bs-parent="#designFaq">
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
include __DIR__ . '/includes/final-cta.php';
include __DIR__ . '/includes/footer.php';
