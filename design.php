<?php
require_once __DIR__ . '/includes/config.php';

$page_title       = 'Book Cover Design Services in Europe | ' . BRAND_NAME;
$page_description = 'Custom book cover design for eBook, paperback wraparounds, audiobooks, series branding and children\'s illustration. Multiple concepts, unlimited revisions.';
$page_keywords    = 'book cover design Europe, custom cover design, eBook cover, print wraparound, children\'s book illustration, series branding';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/design.php';

require __DIR__ . '/includes/header.php';

$hero = [
    'crumb'      => 'Cover Design',
    'eyebrow'    => 'Book Cover Design',
    'title'      => 'Book Cover Design Services in <em class="gold-italic">Europe</em>',
    'paragraphs' => [
        'Two seconds. That&rsquo;s roughly how long your cover has to make someone stop scrolling on Amazon and actually look. The covers that work aren&rsquo;t accidental , they&rsquo;re built around a deep understanding of genre, reader expectations, and what makes one book stand out from the fifty others sitting in the same category.',
        'At European Publishing House, we design covers from scratch for fiction, non-fiction, children&rsquo;s books, academic titles, and everything that sits between those categories.',
    ],
    'ctas' => [
        ['label' => 'Brief Your Cover', 'href' => 'contact.php#submit', 'class' => 'btn-cta'],
        ['label' => 'See Formats',      'href' => '#cover-services',    'class' => 'btn-outline-dark'],
    ],
];
include __DIR__ . '/includes/service-hero.php';
include __DIR__ . '/includes/logo-slider.php';
?>

<section class="services-section section--dark" id="cover-services">
    <div class="container">
        <div class="section-head text-center" data-aos="fade-up">
            <span class="eyebrow eyebrow--light">Cover Formats</span>
            <h2 class="section-title text-light">Book Cover Design Services <em class="gold-italic">We Offer</em></h2>
            <p class="hero-sub" style="max-width:760px;margin-inline:auto;color:rgba(255,255,255,0.78);">Every format your book needs, designed by people who understand how covers actually sell.</p>
        </div>

        <div class="services-grid mt-5">
            <article class="service-card" data-aos="fade-up">
                <span class="service-icon"><i class="fa-solid fa-mobile-screen-button"></i></span>
                <h3 class="service-title">eBook Cover Design</h3>
                <p class="service-desc">Your eBook cover needs to work at thumbnail size on Amazon, Apple Books, Kobo, and Google Play , often no bigger than a postage stamp on a mobile screen. We design for that reality first.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="70">
                <span class="service-icon"><i class="fa-solid fa-book"></i></span>
                <h3 class="service-title">Print Wraparound Design</h3>
                <p class="service-desc">A print book needs a full wraparound design , front cover, back cover, and spine all working together as a single piece. Built to your printer&rsquo;s exact specifications.</p>
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
                <h2 class="section-title">What a Professional Book Cover <em class="gold-italic">Actually Does</em></h2>
                <p>A great cover communicates genre, tone, and audience before a reader has read a single word. It signals quality. It builds trust. And on a crowded retailer page, it&rsquo;s the difference between a click and a scroll past.</p>
                <p>We don&rsquo;t work from templates and we don&rsquo;t reuse designs. Every cover is built around your specific book, with as many concept directions and revisions as it takes to get it right.</p>
                <ul class="genre-list mt-3" role="list">
                    <li><i class="fa-solid fa-check" style="color:var(--c-leaf,#6CB04C);"></i>Custom designs built around your book, not repurposed templates</li>
                    <li><i class="fa-solid fa-check" style="color:var(--c-leaf,#6CB04C);"></i>Every genre, every format, every platform</li>
                    <li><i class="fa-solid fa-check" style="color:var(--c-leaf,#6CB04C);"></i>Multiple concepts to choose from</li>
                    <li><i class="fa-solid fa-check" style="color:var(--c-leaf,#6CB04C);"></i>Unlimited revisions until you&rsquo;re completely happy</li>
                </ul>
                <div class="mt-4">
                    <a href="contact.php#submit" class="btn btn-cta">Brief Your Cover <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/top-categories.php'; ?>

<section class="publish-cost-sec section--dark" id="pricing">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="publish-cost-art">
                    <img src="assets/images/livesite/publishCostsection.jpg" alt="How much does book cover design cost in Europe" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Pricing</span>
                <h2 class="section-title">How Much Does Book Cover Design Cost in <em class="gold-italic">Europe?</em></h2>
                <p>Cover design costs depend on what your book needs. An eBook cover for a straightforward non-fiction title is a different project from a full illustrated wraparound for a fantasy novel or a complete illustration set for a children&rsquo;s picture book.</p>
                <p>Get in touch and we&rsquo;ll talk through your book, your audience, and the formats you need. You&rsquo;ll get a clear, honest quote based on what your specific project actually needs.</p>
                <a href="contact.php#submit" class="btn btn-cta btn-lg">Get a Custom Quote <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<?php
$exclude_slug = 'design';
include __DIR__ . '/includes/other-services.php';
?>

<section class="faq-section" id="faq">
    <div class="container">
        <div class="row g-5 align-items-start">
            <div class="col-lg-4" data-aos="fade-right">
                <span class="eyebrow">FAQs</span>
                <h2 class="section-title">We&rsquo;re Here To Answer All Your <em class="gold-italic">Questions.</em></h2>
                <p>Can&rsquo;t find what you&rsquo;re looking for? Speak with our team directly.</p>
                <a href="contact.php" class="btn btn-cta">Get in Touch <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <div class="col-lg-8" data-aos="fade-left" data-aos-delay="100">
                <div class="accordion faq-accordion" id="designFaq">
                    <?php
                    $faqs = [
                        ['q' => 'How much does book cover design cost in Europe?',          'a' => 'Book cover design costs in Europe vary depending on the type of cover, the genre, and what&rsquo;s involved in producing it. Most professional projects sit between &euro;400 and &euro;1,500, with custom-illustrated covers and series branding sitting at the higher end.'],
                        ['q' => 'What makes a professional book cover?',                     'a' => 'A professional cover does several things at once. It signals genre clearly enough that the right readers recognise it immediately, it looks polished at thumbnail size, and it gives a sense of the book&rsquo;s tone before a reader has opened it.'],
                        ['q' => 'How long does it take to design a book cover?',             'a' => 'A standard book cover design typically takes two to three weeks from briefing to final files, accounting for concept development, your feedback, and revision rounds.'],
                        ['q' => 'Do you provide eBook and print cover formats?',             'a' => 'Yes. We provide final files in every format your book needs , optimised eBook covers sized for Amazon KDP, Apple Books, Kobo, and Google Play, as well as full print-ready wraparound files built to your printer&rsquo;s exact specifications.'],
                        ['q' => 'Can I request revisions for my book cover design?',         'a' => 'Yes, unlimited revisions, always. We keep refining until the cover is exactly what you want.'],
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
include __DIR__ . '/includes/cta.php';
include __DIR__ . '/includes/footer.php';
