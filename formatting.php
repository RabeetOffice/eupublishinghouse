<?php
require_once __DIR__ . '/includes/config.php';

$page_title       = 'Professional Book Formatting Services in Europe | ' . BRAND_NAME;
$page_description = 'Print-ready PDFs, ePub, MOBI, KDP and IngramSpark files for paperback, hardback and eBook editions — built to every platform\'s exact specifications.';
$page_keywords    = 'book formatting Europe, ePub MOBI formatting, KDP formatting, print ready PDF, IngramSpark formatting';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/formatting.php';

require __DIR__ . '/includes/header.php';

$hero = [
    'crumb'      => 'Formatting',
    'eyebrow'    => 'Book Formatting',
    'title'      => 'Professional Book Formatting Services in <em class="gold-italic">Europe</em>',
    'paragraphs' => [
        'A well-written book with poor formatting is still a book readers won&rsquo;t finish. Awkward spacing, inconsistent chapter breaks, margins that don&rsquo;t work in print &mdash; these are the things that make a book feel unprofessional before a reader has given it a fair chance.',
        'At European Publishing House, we format manuscripts for every format and every platform &mdash; paperback, hardback, eBook, Amazon KDP, IngramSpark. We produce files that meet every technical requirement and look exactly right when readers open them.',
    ],
    'ctas' => [
        ['label' => 'Get Your Files', 'href' => 'contact.php#submit', 'class' => 'btn-cta'],
        ['label' => 'See Formats',    'href' => '#format-services',   'class' => 'btn-outline-dark'],
    ],
];
include __DIR__ . '/includes/service-hero.php';
include __DIR__ . '/includes/logo-slider.php';
?>

<section class="services-section section--dark" id="format-services">
    <div class="container">
        <div class="section-head text-center" data-aos="fade-up">
            <span class="eyebrow eyebrow--light">Formats &amp; Platforms</span>
            <h2 class="section-title text-light">Book Formatting Services <em class="gold-italic">We Offer</em></h2>
            <p class="hero-sub" style="max-width:760px;margin-inline:auto;color:rgba(255,255,255,0.78);">Every format your book needs, produced correctly first time.</p>
        </div>

        <div class="services-grid mt-5">
            <article class="service-card" data-aos="fade-up">
                <span class="service-icon"><i class="fa-solid fa-tablet-screen-button"></i></span>
                <h3 class="service-title">eBook Formatting</h3>
                <p class="service-desc">We format eBooks into ePub and MOBI — the two formats that cover every major digital platform. Every file includes a clickable table of contents, properly styled chapter headings, correct font embedding, and formatting that adapts cleanly to whatever screen size or font setting a reader uses.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="70">
                <span class="service-icon"><i class="fa-solid fa-print"></i></span>
                <h3 class="service-title">Print Formatting</h3>
                <p class="service-desc">Print formatting is a different discipline from eBook formatting entirely. Margins, bleed, gutter widths, header and footer placement, page numbering, and trim size all have to be right before a file goes to print. We produce print-ready PDFs across all standard trim sizes.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="140">
                <span class="service-icon"><i class="fa-brands fa-amazon"></i></span>
                <h3 class="service-title">Amazon KDP Formatting</h3>
                <p class="service-desc">Amazon KDP has specific formatting requirements for both Kindle eBooks and print editions. We format manuscripts specifically for KDP, producing Kindle-ready files for digital publication and print-ready PDFs for KDP print, all built to Amazon&rsquo;s current specifications.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="210">
                <span class="service-icon"><i class="fa-solid fa-children"></i></span>
                <h3 class="service-title">Children&rsquo;s Book Formatting</h3>
                <p class="service-desc">Children&rsquo;s books need a completely different approach to formatting. We work with your illustrations and text together, producing print-ready files and eBook versions that preserve the visual integrity of your book across both formats.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <article class="service-card" data-aos="fade-up">
                <span class="service-icon"><i class="fa-solid fa-graduation-cap"></i></span>
                <h3 class="service-title">Academic &amp; Technical</h3>
                <p class="service-desc">Academic and technical manuscripts have their own requirements — consistent citation formatting, properly styled footnotes and endnotes, tables, figures, and reference lists that hold together throughout.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="70">
                <span class="service-icon"><i class="fa-solid fa-layer-group"></i></span>
                <h3 class="service-title">Multi-Format Formatting</h3>
                <p class="service-desc">Most authors publish in more than one format — eBook and paperback as a minimum, sometimes hardback as well. We handle all formats together as a single project, ensuring consistency across every version while meeting each platform&rsquo;s individual specifications.</p>
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
                    <img src="assets/images/livesite/AuthorChoose.jpg" alt="Why formatting matters more than most authors realise" loading="lazy" decoding="async">
                    <span class="why-eph-art__chip">Layout</span>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Why Formatting Matters</span>
                <h2 class="section-title">Why Formatting Matters More Than <em class="gold-italic">Most Authors Realise</em></h2>
                <p>There&rsquo;s a reason some books feel effortless to read and others feel like hard work, even when the writing itself is solid. A lot of the time, it comes down to formatting. Readers won&rsquo;t stop to diagnose it. They&rsquo;ll just drift away, and you&rsquo;ll never know why.</p>
                <p>Done properly, formatting disappears completely. The reader never thinks about margins, chapter breaks, or how the text sits on the page, because everything is exactly where it should be. Done badly, it creates a low-level friction that works against your book from the first page.</p>
                <p>Beyond how it looks, formatting has a technical side that trips up more authors than any other part of the publishing process. Every platform has its own specifications. Get any of it wrong and your files come back rejected, or worse, they go live with errors you don&rsquo;t catch until a reader does. We take all of that off your plate.</p>
                <ul class="genre-list mt-3" role="list">
                    <li><i class="fa-solid fa-check" style="color:var(--c-leaf,#6CB04C);"></i>Every format your book needs, produced correctly first time</li>
                    <li><i class="fa-solid fa-check" style="color:var(--c-leaf,#6CB04C);"></i>Files built to each platform&rsquo;s exact technical specifications</li>
                    <li><i class="fa-solid fa-check" style="color:var(--c-leaf,#6CB04C);"></i>eBook and print versions handled together or separately</li>
                    <li><i class="fa-solid fa-check" style="color:var(--c-leaf,#6CB04C);"></i>ePub, MOBI, Print-Ready PDF, Amazon KDP, IngramSpark, Hardback Layout</li>
                </ul>
                <div class="mt-4">
                    <a href="contact.php#submit" class="btn btn-cta">Get Your Files <i class="fa-solid fa-arrow-right"></i></a>
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
                    <img src="assets/images/livesite/publishCostsection.jpg" alt="How much does book formatting cost in Europe" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Pricing</span>
                <h2 class="section-title">How Much Does Book Formatting Cost in <em class="gold-italic">Europe?</em></h2>
                <p>The cost of formatting a book depends on what your manuscript needs and how many formats you&rsquo;re publishing in. A straightforward fiction novel going into eBook and paperback is a different project from a heavily illustrated children&rsquo;s book or an academic title with complex footnotes and reference lists.</p>
                <p>Get in touch and tell us about your book and where you&rsquo;re planning to publish. We&rsquo;ll give you a clear, straightforward quote based on what your specific project actually needs.</p>
                <a href="contact.php#submit" class="btn btn-cta btn-lg">Get a Formatting Quote <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<?php
$exclude_slug = 'formatting';
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
                <div class="accordion faq-accordion" id="fmtFaq">
                    <?php
                    $faqs = [
                        ['q' => 'How much does book formatting cost in Europe?',         'a' => 'Book formatting costs vary depending on the type of book, the number of formats needed, and the complexity of the layout. Most professional formatters charge per project, and the scope of the work is what drives the cost.'],
                        ['q' => 'What is included in professional book formatting?',      'a' => 'Setting correct margins and trim sizes for print, styling chapter headings, page numbers, headers and footers, creating a clickable table of contents for eBooks, embedding fonts correctly, and producing final files in every format required — ePub, MOBI, and print-ready PDF.'],
                        ['q' => 'How long does book formatting take?',                    'a' => 'Standard book formatting typically takes three to five working days for a straightforward manuscript. More complex projects — children&rsquo;s books with illustrations, academic titles, or multi-format projects — take one to two weeks depending on what&rsquo;s involved.'],
                        ['q' => 'Do you support Amazon KDP and print-ready files?',       'a' => 'Yes. We produce files specifically built to Amazon KDP&rsquo;s current technical requirements for both Kindle eBooks and KDP print editions, as well as print-ready PDFs for IngramSpark and other print platforms.'],
                        ['q' => 'Can I format my book for both eBook and paperback?',     'a' => 'Absolutely, and most authors do both. eBook and print formatting are different processes with different technical requirements, but we handle both together as a single project so everything stays consistent and you get every file you need in one go.'],
                    ];
                    foreach ($faqs as $i => $f): ?>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button <?= $i === 0 ? '' : 'collapsed' ?>" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#fmtFaq<?= $i ?>"
                                    aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>" aria-controls="fmtFaq<?= $i ?>">
                                <span class="faq-num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                                <?= $f['q'] ?>
                            </button>
                        </h3>
                        <div id="fmtFaq<?= $i ?>" class="accordion-collapse collapse <?= $i === 0 ? 'show' : '' ?>" data-bs-parent="#fmtFaq">
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
