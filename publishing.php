<?php
require_once __DIR__ . '/includes/config.php';

$page_title       = 'Professional Book Publishing Services in Europe | ' . BRAND_NAME;
$page_description = 'End-to-end book publishing across Amazon KDP, Apple Books, Kobo, Google Play, IngramSpark and 150+ retailers. You keep your rights, your royalties, and your creative control.';
$page_keywords    = 'book publishing Europe, hybrid publisher Ireland, Amazon KDP publishing, IngramSpark, global book distribution, publish a book Europe';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/publishing.php';

require __DIR__ . '/includes/header.php';

$hero = [
    'crumb'      => 'Publishing',
    'title'      => 'Professional Book Publishing Services in <em class="serif-italic">Europe</em>',
    'paragraphs' => [
        "Getting published used to mean waiting years for a traditional publisher to say yes. It doesn't anymore. At European Publishing House, we help authors across Europe publish their books properly, without the gatekeepers, without giving up their rights, and without figuring it all out alone.",
        "We've helped over 800 authors publish since 2021, across every genre you can think of. Fiction, non-fiction, memoirs, children's books, business titles, academic writing. First-time authors who don't know where to start and experienced writers who just want a reliable team to handle the process. Whatever stage you're at, we take your manuscript and get it published, professionally, globally, and on your terms.",
    ],
    'ctas' => [
        ['label' => 'Get Started', 'href' => '#popup',                'class' => 'btn-cta',   'popup'    => true],
        ['label' => 'Live Chat',   'href' => link_to('javascript:;'), 'class' => 'btn-glass', 'livechat' => true],
    ],
];
include __DIR__ . '/includes/service-hero.php';
include __DIR__ . '/includes/distributors.php';
?>

<!-- ============================================================
     HOW WE PUBLISH YOUR BOOK, six structured stages
     ============================================================ -->
<section class="services-section" id="how-we-publish">
    <div class="container">
        <div class="section-head text-center" data-aos="fade-up">
            <span class="eyebrow">Our Process</span>
            <h2 class="section-title">How We Publish <em class="serif-italic">Your Book</em></h2>
            <p class="hero-sub" style="max-width:760px;margin-inline:auto;">Six structured stages from finished manuscript to global retail availability.</p>
        </div>

        <div class="services-grid mt-5">
            <article class="service-card" data-aos="fade-up">
                <span class="service-icon"><i class="fa-solid fa-pen-fancy"></i></span>
                <h3 class="service-title">Manuscript Preparation</h3>
                <p class="service-desc">Before anything else, your manuscript needs to be ready. We work through editing, proofreading, and any structural changes needed to get your book to a publication-ready standard. If you've already had your manuscript edited elsewhere and it's good to go, we move straight to the next stage. We publish across all genres, fiction, literary fiction, romance, thrillers, sci-fi, fantasy, memoirs, self-help, business, children's books, and academic titles.</p>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="70">
                <span class="service-icon"><i class="fa-solid fa-palette"></i></span>
                <h3 class="service-title">Cover Design</h3>
                <p class="service-desc">Your cover is the first thing a reader sees, and on a platform like Amazon, it's often the only thing they look at before deciding whether to click. We design custom covers built around your genre and your audience, eBook covers, full print wraparounds, spine design, and back cover layout. Multiple concepts, revisions until it's right, and final files sized for every platform.</p>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="140">
                <span class="service-icon"><i class="fa-solid fa-align-left"></i></span>
                <h3 class="service-title">Formatting</h3>
                <p class="service-desc">We format your book for every format it needs to be published in. PDF for print, ePub for Apple Books, Kobo and Google Play, MOBI for Kindle. Every file is built to meet each platform's technical specifications so your book passes review first time and looks right on every device a reader might use.</p>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="210">
                <span class="service-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                <h3 class="service-title">Proofreading</h3>
                <p class="service-desc">The last read before your book goes to print or goes live. We catch typos, spacing issues, formatting glitches, and missing punctuation that may have slipped through earlier. Proofreading covers all genres and all formats, both print layouts and eBook files. It's a focused, detail-level pass, and it's the one that makes sure nothing embarrassing makes it to publication.</p>
            </article>
            <article class="service-card" data-aos="fade-up">
                <span class="service-icon"><i class="fa-solid fa-fingerprint"></i></span>
                <h3 class="service-title">ISBN &amp; Copyright Registration</h3>
                <p class="service-desc">We handle all the administrative groundwork, ISBN assignment, copyright documentation, author profile setup, and metadata optimisation so your book is properly catalogued and discoverable. These details matter more than most authors realise when it comes to getting found by readers.</p>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="70">
                <span class="service-icon"><i class="fa-solid fa-globe"></i></span>
                <h3 class="service-title">Global Distribution</h3>
                <p class="service-desc">Once everything is ready, your book goes live. We upload and manage your book across Amazon KDP, Apple Books, Kobo, Google Play, IngramSpark, Barnes &amp; Noble, and 150+ additional retailers worldwide. Every platform has its own submission requirements and technical standards, we handle all of it so you don't have to work through each one separately.</p>
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
                    <img src="<?= asset('images/PublishingThatWorksfortheAuthor-1969x2048.webp') ?>" alt="Publishing that works for the author" loading="lazy" decoding="async">
                    <span class="why-eph-art__chip">Author-First</span>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Why It Matters</span>
                <h2 class="section-title">Publishing That Works <em class="serif-italic">for the Author</em>, Not Against Them</h2>
                <p>Traditional publishing asks a lot from authors. Years of submissions, literary agents, rejection letters, and at the end of it, if you're one of the lucky ones, a deal that hands over most of your rights and a royalty rate that won't make you rich. It works for some. For most, there's a better way.</p>
                <p>Self-publishing through European Publishing House gives you everything a traditional deal offers, professional editing, proper cover design, global distribution, and real marketing support, without any of the compromises. Your book. Your rights. Your royalties.</p>
                <p>We handle every part of the process, from preparing your manuscript for publication all the way through to going live on every major platform worldwide. You make the decisions. We do the work.</p>
                <ul class="genre-list mt-3" role="list">
                    <li><i class="fa-solid fa-check"></i>Full rights retained by you, always</li>
                    <li><i class="fa-solid fa-check"></i>Higher royalty rates than traditional publishing</li>
                    <li><i class="fa-solid fa-check"></i>Global distribution from day one</li>
                    <li><i class="fa-solid fa-check"></i>One team handling everything end to end</li>
                </ul>
                <div class="mt-4">
                    <a href="#popup" class="btn btn-cta" data-popup>Get Your Quote <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/categories.php'; ?>

<!-- ============================================================
     PRICING
     ============================================================ -->
<section class="publish-cost-sec" id="pricing">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="publish-cost-art">
                    <img src="<?= asset('images/CosttoPublishaBook-2048x1365.webp') ?>" alt="What does it cost to publish a book in Europe" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Pricing</span>
                <h2 class="section-title">What does it cost to publish a book in <em class="serif-italic">Europe?</em></h2>
                <p>Publishing costs depend entirely on what your book needs. A children's picture book is a different project from a 100,000-word thriller. Some authors come to us with a fully edited manuscript and just need formatting, distribution, and a cover. Others need the full package from the ground up, editing, design, formatting, and marketing. The cost reflects that difference.</p>
                <p>What we don't do is charge you for services your book doesn't need. During a free consultation, we look at your manuscript, talk through your goals, and put together a clear quote covering exactly what your project requires. No inflated packages. No hidden fees appearing later.</p>
                <a href="#popup" class="btn btn-cta btn-lg" data-popup>Get Your Publishing Quote <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<?php
$exclude_slug = 'publishing';
include __DIR__ . '/includes/books-portfolio.php';
include __DIR__ . '/includes/services.php';
?>

<!-- ============================================================
     FAQs
     ============================================================ -->
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
                <div class="accordion faq-accordion" id="pubFaq">
                    <?php
                    $faqs = [
                        ['q' => 'Which publisher is best for first-time authors?',
                         'a' => "For most first-time authors, self-publishing with a professional team behind them is the strongest option. Traditional publishing is slow, competitive, and requires a literary agent before most publishers will even look at your manuscript. The process can take years with no guarantee of a deal at the end of it. Self-publishing through European Publishing House means your book gets published professionally, proper editing, proper design, global distribution, on a timeline that makes sense, and you keep your rights and royalties throughout. We've helped hundreds of debut authors publish their first books, and we're set up to guide you through every step of the process."],
                        ['q' => 'What does it cost to publish a book?',
                         'a' => "It depends on what your book needs. Authors who come to us with a fully edited manuscript and a finished cover need far less than someone starting from scratch. Costs vary based on manuscript length, genre, which services are required, and the platforms you want to distribute to. Rather than give you a number that may not reflect your project at all, we'd rather have a proper conversation first. Get in touch and we'll give you a clear, honest quote built around your specific book."],
                        ['q' => 'Can I use ChatGPT to write a book and sell it?',
                         'a' => "You can, but it comes with real risks worth understanding before you go down that route. AI-generated content is increasingly detectable, and major platforms including Amazon have introduced policies around AI-authored work that require disclosure. Readers are also getting better at recognising it, and they don't tend to respond well to it. If you have a strong idea but need help with the actual writing, working with a professional ghostwriter produces a far better book, one that reads like a human wrote it because one did, and one that won't put your publishing account at risk."],
                        ['q' => 'Can Amazon tell if a book was written by AI?',
                         'a' => "Amazon has detection tools in place and has already removed thousands of AI-generated titles from its platform for policy violations. They require authors to disclose AI-generated content during the publishing process, and undisclosed AI content can result in your book being removed or your account being flagged. The short answer is yes, they can often tell, and the consequences of getting it wrong aren't worth it."],
                        ['q' => 'Can I sell a book that AI helped me write?',
                         'a' => "This depends on how much of the book is AI-generated and how transparent you are about it. Using AI as a drafting or brainstorming tool while doing substantial human writing and editing yourself sits in different territory from submitting a fully AI-generated manuscript. Platform policies on this are still evolving, but disclosure is currently required on Amazon and several other retailers for content that is substantially AI-generated. If you're unsure where your manuscript falls, it's worth getting proper advice before publishing."],
                        ['q' => 'How much does it cost to make 1,000 copies of a book?',
                         'a' => "Print-on-demand means you don't need to order copies upfront, books are printed as readers buy them, which removes the financial risk of a bulk print run entirely. If you do want physical copies for events, gifts, or direct sales, the cost per copy depends on page count, trim size, interior colour, and binding type. A standard paperback with black-and-white interiors typically costs somewhere between &euro;3 and &euro;7 per copy at volume. Get in touch and we'll walk you through the print options that make sense for your book."],
                        ['q' => 'How do I know if someone buys my book on Amazon?',
                         'a' => "Amazon KDP provides a sales dashboard where you can track purchases, royalties, page reads through Kindle Unlimited, and sales by marketplace in real time. You'll receive monthly royalty payments directly to your account for all sales the previous month. We help you set up and understand your KDP dashboard as part of our publishing process, so you're never left wondering where your numbers are coming from or how to read them."],
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
include __DIR__ . '/includes/final-cta.php';
include __DIR__ . '/includes/footer.php';
