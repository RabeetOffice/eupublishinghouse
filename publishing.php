<?php
require_once __DIR__ . '/includes/config.php';

$page_title       = 'Professional Book Publishing Services in Europe | ' . BRAND_NAME;
$page_description = 'End-to-end book publishing across Amazon KDP, Apple Books, Kobo, Google Play, IngramSpark and 150+ retailers. You keep your rights, your royalties, and your creative control.';
$page_keywords    = 'book publishing Europe, hybrid publisher Ireland, Amazon KDP publishing, IngramSpark, global book distribution, publish a book Europe';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/publishing.php';

require __DIR__ . '/includes/header.php';

$hero = [
    'crumb'      => 'Publishing',
    'eyebrow'    => 'Book Publishing',
    'title'      => 'Professional Book Publishing Services in <em class="gold-italic">Europe</em>',
    'paragraphs' => [
        'Getting published used to mean waiting years for a traditional publisher to say yes. It doesn&rsquo;t anymore. At European Publishing House, we help authors across Europe publish their books properly , without the gatekeepers, without giving up their rights, and without figuring it all out alone.',
        'We&rsquo;ve helped over 800 authors publish since 2021, across every genre you can think of.',
    ],
    'ctas' => [
        ['label' => 'Get Started',  'href' => 'contact.php#submit', 'class' => 'btn-cta'],
        ['label' => 'View Pricing', 'href' => '#pricing',           'class' => 'btn-outline-dark'],
    ],
];
include __DIR__ . '/includes/service-hero.php';
include __DIR__ . '/includes/logo-slider.php';
?>

<!-- ============================================================
     HOW WE PUBLISH YOUR BOOK, six structured stages
     ============================================================ -->
<section class="services-section section--dark" id="how-we-publish">
    <div class="container">
        <div class="section-head text-center" data-aos="fade-up">
            <span class="eyebrow eyebrow--light">Our Process</span>
            <h2 class="section-title text-light">How We Publish <em class="gold-italic">Your Book</em></h2>
            <p class="hero-sub" style="max-width:760px;margin-inline:auto;color:rgba(255,255,255,0.78);">Six structured stages from finished manuscript to global retail availability.</p>
        </div>

        <div class="services-grid mt-5">
            <article class="service-card" data-aos="fade-up">
                <span class="service-icon"><i class="fa-solid fa-pen-fancy"></i></span>
                <h3 class="service-title">Manuscript Preparation</h3>
                <p class="service-desc">Before anything else, your manuscript needs to be ready. We work through editing, proofreading, and any structural changes needed to get your book to a publication-ready standard.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="70">
                <span class="service-icon"><i class="fa-solid fa-palette"></i></span>
                <h3 class="service-title">Cover Design</h3>
                <p class="service-desc">Your cover is the first thing a reader sees, and on a platform like Amazon, it&rsquo;s often the only thing they look at before deciding whether to click.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="140">
                <span class="service-icon"><i class="fa-solid fa-align-left"></i></span>
                <h3 class="service-title">Formatting</h3>
                <p class="service-desc">We format your book for every format it needs to be published in , PDF for print, ePub for Apple Books, Kobo and Google Play, MOBI for Kindle.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="210">
                <span class="service-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                <h3 class="service-title">Proofreading</h3>
                <p class="service-desc">The last read before your book goes to print or goes live. We catch typos, spacing issues, formatting glitches, and missing punctuation.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <article class="service-card" data-aos="fade-up">
                <span class="service-icon"><i class="fa-solid fa-fingerprint"></i></span>
                <h3 class="service-title">ISBN &amp; Copyright Registration</h3>
                <p class="service-desc">We handle all the administrative groundwork , ISBN assignment, copyright documentation, author profile setup, and metadata optimisation.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="70">
                <span class="service-icon"><i class="fa-solid fa-globe"></i></span>
                <h3 class="service-title">Global Distribution</h3>
                <p class="service-desc">Once everything is ready, your book goes live. We upload and manage your book across Amazon KDP, Apple Books, Kobo, Google Play, IngramSpark, Barnes &amp; Noble, and 150+ additional retailers worldwide.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
        </div>
    </div>
</section>

<!-- ============================================================
     VALUE, Publishing that works for the author
     ============================================================ -->
<section class="why-eph-sec" id="value">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="why-eph-art">
                    <img src="assets/images/livesite/AuthorChoose.jpg" alt="Publishing that works for the author" loading="lazy" decoding="async">
                    <span class="why-eph-art__chip">Author-First</span>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Why It Matters</span>
                <h2 class="section-title">Publishing That Works <em class="gold-italic">for the Author</em>, Not Against Them</h2>
                <p>Most publishers are built around the publisher&rsquo;s economics, not the author&rsquo;s. Slow contracts, low royalties, rights locked up for years, marketing budgets reserved for a handful of lead titles. We started European Publishing House because authors deserved a model that actually worked in their favour.</p>
                <p>That means transparent pricing, clean contracts, and a publishing process that keeps you involved at every stage. You wrote the book. We just make sure the world actually gets to read it.</p>
                <ul class="genre-list mt-3" role="list">
                    <li><i class="fa-solid fa-check" style="color:var(--c-leaf,#6CB04C);"></i>Full rights retained by you, always</li>
                    <li><i class="fa-solid fa-check" style="color:var(--c-leaf,#6CB04C);"></i>Higher royalty rates than traditional publishing</li>
                    <li><i class="fa-solid fa-check" style="color:var(--c-leaf,#6CB04C);"></i>Global distribution from day one</li>
                    <li><i class="fa-solid fa-check" style="color:var(--c-leaf,#6CB04C);"></i>One team handling everything end to end</li>
                </ul>
                <div class="mt-4">
                    <a href="contact.php#submit" class="btn btn-cta">Get Your Quote <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/top-categories.php'; ?>

<!-- ============================================================
     PRICING
     ============================================================ -->
<section class="publish-cost-sec section--dark" id="pricing">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="publish-cost-art">
                    <img src="assets/images/livesite/publishCostsection.jpg" alt="What does it cost to publish a book in Europe" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Pricing</span>
                <h2 class="section-title">What Does It Cost to Publish a Book in <em class="gold-italic">Europe?</em></h2>
                <p>Publishing costs depend entirely on what your book needs. A children&rsquo;s picture book is a different project from a 100,000-word thriller, and any quote that doesn&rsquo;t reflect that is guessing.</p>
                <p>Get in touch and we&rsquo;ll have an honest conversation about your manuscript and what it actually needs to be ready for readers. From there, we&rsquo;ll put together a clear quote with no surprises.</p>
                <a href="contact.php#submit" class="btn btn-cta btn-lg">Get Your Publishing Quote <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<?php
$exclude_slug = 'publishing';
include __DIR__ . '/includes/other-services.php';
?>

<!-- ============================================================
     FAQs
     ============================================================ -->
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
                <div class="accordion faq-accordion" id="pubFaq">
                    <?php
                    $faqs = [
                        ['q' => 'Who owns my book after publishing with European Publishing House?', 'a' => 'You do, completely. You retain 100% of your rights, your royalties, and your creative ownership throughout the process and after publication.'],
                        ['q' => 'Which retailers will my book be available on?',                     'a' => 'Amazon Kindle (UK, EU, US, Canada, Australia, Germany, France, Spain, Italy, Japan, and more), Apple Books, Google Play Books, Kobo, Barnes &amp; Noble, Scribd, OverDrive for libraries, and 150+ additional retailers worldwide.'],
                        ['q' => 'How long does the publishing process take?',                       'a' => 'Most full-service projects run four to six weeks once your manuscript is ready. Formatting-only or distribution-only projects can be turned around in two to three weeks.'],
                        ['q' => 'Do I need an ISBN?',                                                'a' => 'Yes, and we handle ISBN registration as part of the publishing process. You don&rsquo;t need to source one separately unless you prefer to.'],
                    ];
                    foreach ($faqs as $i => $f): ?>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button <?= $i === 0 ? '' : 'collapsed' ?>" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#pubFaq<?= $i ?>"
                                    aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>" aria-controls="pubFaq<?= $i ?>">
                                <span class="faq-num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                                <?= $f['q'] ?>
                            </button>
                        </h3>
                        <div id="pubFaq<?= $i ?>" class="accordion-collapse collapse <?= $i === 0 ? 'show' : '' ?>" data-bs-parent="#pubFaq">
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
