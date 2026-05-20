<?php
require_once __DIR__ . '/includes/config.php';

$page_title       = 'Book Marketing Services in Europe That Actually Sell Books | ' . BRAND_NAME;
$page_description = 'Amazon listing optimisation, paid advertising, social campaigns, author branding, review generation and book fair promotion built around your specific book.';
$page_keywords    = 'book marketing Europe, Amazon ads for authors, author branding, book launch marketing, book fair promotion';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/marketing.php';

require __DIR__ . '/includes/header.php';

$hero = [
    'crumb'      => 'Marketing',
    'eyebrow'    => 'Book Marketing',
    'title'      => 'Book Marketing Services in Europe That <em class="gold-italic">Actually Sell Books</em>',
    'paragraphs' => [
        'Publishing your book is one thing. Getting it in front of the right readers is another thing entirely. A professionally edited book with a great cover will still sit unnoticed without a proper marketing strategy behind it.',
        'At European Publishing House, our book marketing services are built around one goal , putting your book in front of the people who want to read it. Every campaign is built around your specific book, your audience, and the platforms where your readers actually spend their time.',
    ],
    'ctas' => [
        ['label' => 'Plan Your Campaign', 'href' => 'contact.php#submit', 'class' => 'btn-cta'],
        ['label' => 'Marketing Services', 'href' => '#marketing-services', 'class' => 'btn-outline-dark'],
    ],
];
include __DIR__ . '/includes/service-hero.php';
include __DIR__ . '/includes/logo-slider.php';
?>

<section class="services-section section--dark" id="marketing-services">
    <div class="container">
        <div class="section-head text-center" data-aos="fade-up">
            <span class="eyebrow eyebrow--light">Strategic, Transparent</span>
            <h2 class="section-title text-light">Book Marketing Services <em class="gold-italic">We Offer</em></h2>
            <p class="hero-sub" style="max-width:760px;margin-inline:auto;color:rgba(255,255,255,0.78);">Focused on actual sales rather than vanity metrics.</p>
        </div>

        <div class="services-grid mt-5">
            <article class="service-card" data-aos="fade-up">
                <span class="service-icon"><i class="fa-brands fa-amazon"></i></span>
                <h3 class="service-title">Amazon Marketing &amp; Optimisation</h3>
                <p class="service-desc">Amazon is where most book sales happen, and most authors aren&rsquo;t using it properly. We optimise your book listing from the ground up , title, subtitle, description, keywords, categories, and author profile , so your book surfaces in the right searches and converts browsers into buyers.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="70">
                <span class="service-icon"><i class="fa-solid fa-hashtag"></i></span>
                <h3 class="service-title">Social Media Campaigns</h3>
                <p class="service-desc">We build social media strategies around your book and your genre rather than generic content calendars. Instagram, Facebook, TikTok, LinkedIn, and X , tailored to whatever suits your book and your audience best.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="140">
                <span class="service-icon"><i class="fa-solid fa-rectangle-ad"></i></span>
                <h3 class="service-title">Paid Advertising</h3>
                <p class="service-desc">We run paid advertising campaigns across Amazon, Facebook, Instagram, and BookBub, building and managing ads that target readers by genre, interest, and reading behaviour. Every campaign is monitored and adjusted based on performance data.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="210">
                <span class="service-icon"><i class="fa-solid fa-user-tie"></i></span>
                <h3 class="service-title">Author Branding</h3>
                <p class="service-desc">Your author brand is how readers recognise you, trust you, and come back for your next book. We develop biography, online presence, visual identity, and messaging that holds together across every platform.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <article class="service-card" data-aos="fade-up">
                <span class="service-icon"><i class="fa-solid fa-star"></i></span>
                <h3 class="service-title">Review Generation</h3>
                <p class="service-desc">Reviews are one of the most important factors in a book&rsquo;s visibility and credibility on Amazon and other platforms. We run structured review outreach campaigns, connecting your book with relevant advance readers, book bloggers, and review platforms.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="70">
                <span class="service-icon"><i class="fa-solid fa-tent"></i></span>
                <h3 class="service-title">Book Fair Promotion</h3>
                <p class="service-desc">Frankfurt, London Book Fair, Bologna, and others are significant opportunities for authors and publishers to generate visibility, rights deals, and press coverage. We help authors prepare for and promote their work at the major European fairs.</p>
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
                    <img src="assets/images/livesite/AuthorChoose.jpg" alt="Why most books don't sell, and how we fix that" loading="lazy" decoding="async">
                    <span class="why-eph-art__chip">Strategy</span>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Why Most Books Don&rsquo;t Sell</span>
                <h2 class="section-title">Why Most Books Don&rsquo;t Sell, And <em class="gold-italic">How We Fix That</em></h2>
                <p>The honest truth about book marketing is that most authors underestimate how much work it takes. Writing the book is the part most people plan for. Marketing is the part most people figure out after the fact, usually when sales aren&rsquo;t moving.</p>
                <p>Good book marketing isn&rsquo;t about shouting louder than everyone else. It&rsquo;s about finding the readers who are already looking for a book like yours and making sure they find it before they find someone else&rsquo;s. That means the right Amazon listing, the right social media presence, the right launch timing, and the right advertising strategy, all working together rather than in isolation.</p>
                <p>Our team at European Publishing House builds marketing campaigns that are strategic from the start, not bolted on after publication. Whether your book is launching next month or has been live for a year with disappointing sales, we look at where you are and build a plan that makes sense for your book and your budget.</p>
                <ul class="genre-list mt-3" role="list">
                    <li><i class="fa-solid fa-check" style="color:var(--c-leaf,#6CB04C);"></i>Campaigns built around your specific book and audience</li>
                    <li><i class="fa-solid fa-check" style="color:var(--c-leaf,#6CB04C);"></i>All genres, all formats, all platforms</li>
                    <li><i class="fa-solid fa-check" style="color:var(--c-leaf,#6CB04C);"></i>Transparent strategy , you know exactly what we&rsquo;re doing and why</li>
                    <li><i class="fa-solid fa-check" style="color:var(--c-leaf,#6CB04C);"></i>Focused on actual sales, not vanity metrics</li>
                </ul>
                <div class="mt-4">
                    <a href="contact.php#submit" class="btn btn-cta">Plan Your Campaign <i class="fa-solid fa-arrow-right"></i></a>
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
                    <img src="assets/images/livesite/publishCostsection.jpg" alt="What do book marketing services cost in Europe" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Pricing</span>
                <h2 class="section-title">What Do Book Marketing Services Cost in <em class="gold-italic">Europe?</em></h2>
                <p>Marketing budgets vary as much as the books themselves. A children&rsquo;s picture book launch looks completely different from a business book campaign or a thriller series promotion. Some authors come to us needing a full campaign built from scratch. Others have already published and just need targeted help with one or two things that aren&rsquo;t working.</p>
                <p>We don&rsquo;t sell generic marketing packages because generic marketing doesn&rsquo;t sell books. Get in touch and we&rsquo;ll have an honest conversation about where your book is and what it needs. No inflated proposals. No paying for campaigns that don&rsquo;t fit your book.</p>
                <a href="contact.php#submit" class="btn btn-cta btn-lg">Get a Marketing Quote <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<?php
$exclude_slug = 'marketing';
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
                <div class="accordion faq-accordion" id="mktFaq">
                    <?php
                    $faqs = [
                        ['q' => 'What is the largest book fair in Europe?',                    'a' => 'The Frankfurt Book Fair is the largest book fair in Europe and the largest in the world , over 7,000 exhibitors from more than 100 countries attend each year. The London Book Fair and Bologna Children&rsquo;s Book Fair are the other two major European events.'],
                        ['q' => 'What is the best book marketing company in Europe?',           'a' => 'The best book marketing company for your book is the one that understands your genre, your audience, and what realistic success looks like for your specific title. At European Publishing House, we&rsquo;ve been marketing books across every genre since 2021, building campaigns around what actually sells books rather than what looks impressive in a proposal.'],
                        ['q' => 'Is marketing in demand in Europe?',                            'a' => 'In publishing specifically, demand for professional book marketing has grown significantly alongside the rise of self-publishing. More authors publishing independently means more authors who need marketing support that traditional publishers used to provide.'],
                        ['q' => 'Which country is best for marketing in Europe?',                'a' => 'For book marketing specifically, the UK is the most developed market in Europe , it has the largest English-language readership and the strongest presence on global platforms like Amazon. Germany and the Netherlands are strong markets for translated and multilingual titles.'],
                    ];
                    foreach ($faqs as $i => $f): ?>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button <?= $i === 0 ? '' : 'collapsed' ?>" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#mktFaq<?= $i ?>"
                                    aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>" aria-controls="mktFaq<?= $i ?>">
                                <span class="faq-num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                                <?= $f['q'] ?>
                            </button>
                        </h3>
                        <div id="mktFaq<?= $i ?>" class="accordion-collapse collapse <?= $i === 0 ? 'show' : '' ?>" data-bs-parent="#mktFaq">
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
