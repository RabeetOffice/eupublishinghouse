<?php
require_once __DIR__ . '/includes/config.php';

$page_title       = 'Professional Book Formatting Services in Europe | ' . BRAND_NAME;
$page_description = 'Print-ready PDFs, ePub, MOBI, KDP and IngramSpark files for paperback, hardback and eBook editions, built to every platform\'s exact specifications.';
$page_keywords    = 'book formatting Europe, ePub MOBI formatting, KDP formatting, print ready PDF, IngramSpark formatting';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/formatting.php';

require __DIR__ . '/includes/header.php';

$hero = [
    'crumb'      => 'Formatting',
    'title'      => 'Professional Book Formatting Services in <em class="serif-italic">Europe</em>',
    'paragraphs' => [
        "A well-written book with poor formatting is still a book readers won't finish. Awkward spacing, inconsistent chapter breaks, margins that don't work in print, or an ePub file that displays differently on every device, these aren't minor issues. They're the things that make a book feel unprofessional before a reader has given it a fair chance.",
        "At European Publishing House, we format manuscripts for every format and every platform. Paperback, hardback, eBook, Amazon KDP, IngramSpark, wherever your book is going, we produce files that meet every technical requirement and look exactly right when readers open them. Clean, consistent, and ready to publish.",
    ],
    'ctas' => [
        ['label' => 'Get Started', 'href' => '#popup',                'class' => 'btn-cta',   'popup'    => true],
        ['label' => 'Live Chat',   'href' => link_to('javascript:;'), 'class' => 'btn-glass', 'livechat' => true],
    ],
];
include __DIR__ . '/includes/service-hero.php';
include __DIR__ . '/includes/distributors.php';
?>

<section class="services-section" id="format-services">
    <div class="container">
        <div class="section-head text-center" data-aos="fade-up">
            <span class="eyebrow">Formats &amp; Platforms</span>
            <h2 class="section-title">Book formatting services <em class="serif-italic">we offer</em></h2>
            <p>Every format your book needs, produced correctly first time.</p>
        </div>

        <div class="services-grid mt-5">
            <article class="service-card" data-aos="fade-up">
                <span class="service-icon"><i class="fa-solid fa-tablet-screen-button"></i></span>
                <h3 class="service-title">eBook Formatting</h3>
                <p class="service-desc">We format eBooks into ePub and MOBI, the two formats that cover every major digital platform. ePub for Apple Books, Kobo, Google Play, and most other retailers. MOBI for Amazon Kindle. Every file includes a clickable table of contents, properly styled chapter headings, correct font embedding, and formatting that adapts cleanly to whatever screen size or font setting a reader uses. We test every file before delivery so you know it'll pass platform review.</p>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="70">
                <span class="service-icon"><i class="fa-solid fa-print"></i></span>
                <h3 class="service-title">Print Formatting</h3>
                <p class="service-desc">Print formatting is a different discipline from eBook formatting entirely. Margins, bleed, gutter widths, header and footer placement, page numbering, and trim size all have to be right before a file goes to print. We produce print-ready PDFs for paperback and hardback editions across all standard trim sizes, 5x8, 5.5x8.5, 6x9, and others, built to the exact specifications of your chosen printer or platform. If you're publishing through Amazon KDP or IngramSpark, we know their requirements and build your files accordingly.</p>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="140">
                <span class="service-icon"><i class="fa-brands fa-amazon"></i></span>
                <h3 class="service-title">Amazon KDP Formatting</h3>
                <p class="service-desc">Amazon KDP has specific formatting requirements for both Kindle eBooks and print editions, and files that don't meet them get rejected or display incorrectly. We format manuscripts specifically for KDP, producing Kindle-ready files for digital publication and print-ready PDFs for KDP print, all built to Amazon's current specifications. If you're publishing exclusively through Amazon, we make sure your files are optimised for that platform specifically, including metadata formatting and cover file sizing.</p>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="210">
                <span class="service-icon"><i class="fa-solid fa-children"></i></span>
                <h3 class="service-title">Children's Book Formatting</h3>
                <p class="service-desc">Children's books need a completely different approach to formatting. The relationship between text and illustration, the page flow, the way spreads work across a print edition, all of it requires careful layout rather than standard manuscript formatting. We work with your illustrations and text together, producing print-ready files and eBook versions that preserve the visual integrity of your book across both formats.</p>
            </article>
            <article class="service-card" data-aos="fade-up">
                <span class="service-icon"><i class="fa-solid fa-graduation-cap"></i></span>
                <h3 class="service-title">Academic &amp; Technical Formatting</h3>
                <p class="service-desc">Academic and technical manuscripts have their own requirements, consistent citation formatting, properly styled footnotes and endnotes, tables, figures, and reference lists that hold together throughout. We format academic books, theses, and technical titles to the standards required by academic publishers and institutional guidelines, producing files ready for both digital and print distribution.</p>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="70">
                <span class="service-icon"><i class="fa-solid fa-layer-group"></i></span>
                <h3 class="service-title">Multi-Format Formatting</h3>
                <p class="service-desc">Most authors publish in more than one format, eBook and paperback as a minimum, sometimes hardback as well. We handle all formats together as a single project, ensuring consistency across every version while meeting each platform's individual specifications. You get every file you need in one process rather than managing separate formatting jobs for each format.</p>
            </article>
        </div>
    </div>
</section>

<section class="why-eph-sec" id="value">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="why-eph-art">
                    <img src="assets/images/FormattingMatters-2048x1536.webp" alt="Why formatting matters more than most authors realise" loading="lazy" decoding="async">
                    <span class="why-eph-art__chip">Layout</span>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Why Formatting Matters</span>
                <h2 class="section-title">Why formatting matters more than <em class="serif-italic">most authors realise</em></h2>
                <p>There's a reason some books feel effortless to read and others feel like hard work, even when the writing itself is solid. A lot of the time, it comes down to formatting. Readers won't stop to diagnose it. They'll just drift away, and you'll never know why.</p>
                <p>Done properly, formatting disappears completely. The reader never thinks about margins, chapter breaks, or how the text sits on the page, because everything is exactly where it should be. Done badly, it creates a low-level friction that works against your book from the first page.</p>
                <p>Beyond how it looks, formatting has a technical side that trips up more authors than any other part of the publishing process. Every platform has its own specifications. Amazon KDP wants something different from IngramSpark. An ePub behaves differently across Apple Books, Kobo, and Google Play. A children's book with illustrations needs entirely different layout thinking from a 90,000-word thriller. Get any of it wrong and your files come back rejected, or worse, they go live with errors you don't catch until a reader does.</p>
                <p>We take all of that off your plate. Send us your manuscript, tell us where you're publishing, and we'll handle every file from start to finish.</p>
                <ul class="genre-list mt-3" role="list">
                    <li><i class="fa-solid fa-check"></i>Every format your book needs, produced correctly first time</li>
                    <li><i class="fa-solid fa-check"></i>Files built to each platform's exact technical specifications</li>
                    <li><i class="fa-solid fa-check"></i>eBook and print versions handled together or separately</li>
                </ul>
                <div class="mt-4">
                    <a href="#popup" class="btn btn-cta" data-popup>Get Your Files <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     FORMATS WE PRODUCE
     ============================================================ -->
<section class="categories-section" id="formats-list">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Output</span>
            <h2 class="section-title">Formats <em class="serif-italic">we produce</em></h2>
            <p>Every file your book needs, built to the exact technical specifications of each platform.</p>
        </div>

        <div class="categories-grid">
            <article class="category-card" data-aos="fade-up">
                <span class="ic"><i class="fa-solid fa-file-lines"></i></span>
                <h3>ePub</h3>
            </article>
            <article class="category-card" data-aos="fade-up" data-aos-delay="60">
                <span class="ic"><i class="fa-solid fa-mobile-screen"></i></span>
                <h3>MOBI</h3>
            </article>
            <article class="category-card" data-aos="fade-up" data-aos-delay="120">
                <span class="ic"><i class="fa-solid fa-file-pdf"></i></span>
                <h3>Print-Ready PDF</h3>
            </article>
            <article class="category-card" data-aos="fade-up" data-aos-delay="180">
                <span class="ic"><i class="fa-brands fa-amazon"></i></span>
                <h3>Amazon KDP Files</h3>
            </article>
            <article class="category-card" data-aos="fade-up" data-aos-delay="240">
                <span class="ic"><i class="fa-solid fa-print"></i></span>
                <h3>IngramSpark Files</h3>
            </article>
            <article class="category-card" data-aos="fade-up" data-aos-delay="300">
                <span class="ic"><i class="fa-solid fa-book"></i></span>
                <h3>Hardback Layout Files</h3>
            </article>
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="#popup" class="btn btn-cta btn-lg" data-popup>
                Get your formatting files <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/categories.php'; ?>

<section class="publish-cost-sec" id="pricing">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="publish-cost-art">
                    <img src="assets/images/BookFormattingCost-2048x1536.webp" alt="How much does book formatting cost in Europe" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Pricing</span>
                <h2 class="section-title">How much does book formatting cost in <em class="serif-italic">Europe?</em></h2>
                <p>The cost of formatting a book depends on what your manuscript needs and how many formats you're publishing in. A straightforward fiction novel going into eBook and paperback is a different project from a heavily illustrated children's book or an academic title with complex footnotes and reference lists. The number of formats, the complexity of the layout, and the current state of your manuscript all affect what the work involves.</p>
                <p>What formatting always has to do, regardless of the book, is meet each platform's technical requirements exactly. That's not optional, and cutting corners on it costs more in the long run when files get rejected or display incorrectly after publication.</p>
                <p>Get in touch and tell us about your book and where you're planning to publish. We'll give you a clear, straightforward quote based on what your specific project actually needs.</p>
                <a href="#popup" class="btn btn-cta btn-lg" data-popup>Get Your Free Formatting Quote <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<?php
$exclude_slug = 'formatting';
include __DIR__ . '/includes/books-portfolio.php';
include __DIR__ . '/includes/services.php';
?>

<section class="faq-section" id="faq">
    <div class="container">
        <div class="row g-5 align-items-start">
            <div class="col-lg-4" data-aos="fade-right">
                <span class="eyebrow">FAQs</span>
                <h2 class="section-title">We're here to answer all your <em class="serif-italic">questions</em></h2>
                <p>Can't find what you're looking for? Speak with our team directly.</p>
                <a href="contact.php" class="btn btn-cta" data-no-popup>Get in Touch <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <div class="col-lg-8" data-aos="fade-left" data-aos-delay="100">
                <div class="accordion faq-accordion" id="fmtFaq">
                    <?php
                    $faqs = [
                        ['q' => 'How much does book formatting cost in Europe?',
                         'a' => "Book formatting costs vary depending on the type of book, the number of formats needed, and the complexity of the layout. A standard fiction novel formatted for eBook and paperback sits at a different price point from a heavily illustrated children's book or an academic manuscript with complex reference structures. Most professional formatters charge per project, and the scope of the work is what drives the cost. Get in touch and we'll talk through your manuscript and where you're publishing, you'll get a clear, honest quote based on what your book actually needs."],
                        ['q' => 'What is included in professional book formatting services in Europe?',
                         'a' => "Professional book formatting covers everything needed to take a manuscript from a Word document or similar file to a properly structured, platform-ready publication file. That includes setting correct margins and trim sizes for print, styling chapter headings, page numbers, headers and footers, creating a clickable table of contents for eBooks, embedding fonts correctly, and producing final files in every format required, ePub, MOBI, and print-ready PDF. For more complex projects it also covers footnote and endnote formatting, figure and table placement, and any layout work specific to the book's genre or format."],
                        ['q' => 'How long does book formatting take for a manuscript?',
                         'a' => "Standard book formatting typically takes three to five working days for a straightforward manuscript. More complex projects, children's books with illustrations, academic titles with extensive reference lists, or multi-format projects covering several different editions, take longer, usually one to two weeks depending on what's involved. If you have a specific publication deadline, let us know at the start and we'll work to a timeline that fits. Files are delivered ready to upload, so there's no back and forth after delivery unless something needs adjusting."],
                        ['q' => 'Do book formatting services in Europe support Amazon KDP and print-ready files?',
                         'a' => "Yes. We produce files specifically built to Amazon KDP's current technical requirements for both Kindle eBooks and KDP print editions, as well as print-ready PDFs for IngramSpark and other print platforms. Every file is built to the exact specifications required by each platform, which means they pass technical review and display correctly rather than coming back with errors. If you're publishing across multiple platforms, we produce separate optimised files for each one rather than a single file adapted across all of them."],
                        ['q' => 'Can I format my book for both eBook and paperback versions?',
                         'a' => "Absolutely, and most authors do both. eBook and print formatting are different processes with different technical requirements, but we handle both together as a single project so everything stays consistent and you get every file you need in one go. Your eBook will be formatted for ePub and MOBI, and your print edition will have a properly laid out, print-ready PDF built to your trim size and platform specifications. Publishing in both formats significantly increases your book's visibility and the number of readers who can access it, and it's always worth doing both from the start."],
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
include __DIR__ . '/includes/final-cta.php';
include __DIR__ . '/includes/footer.php';
