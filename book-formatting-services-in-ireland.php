<?php
/* =================================================================
   /book-formatting-services-in-ireland/
   Ireland location cluster — formatting. Copy from the content brief
   "Book Formatting Services Ireland | Print, Kindle & EPUB".
================================================================= */

require_once __DIR__ . '/includes/locations-data.php';

$locKey = 'ireland';
$loc    = location_get($locKey);
$svc    = $loc['services']['formatting'];

$page_title       = 'Book Formatting Services Ireland | Professional Help';
$page_description = 'Looking for expert book formatting services in Ireland? We craft clean, polished layouts for print and eBooks that meet publishing industry standards.';
$page_keywords    = 'book formatting services Ireland, Kindle book format Ireland, EPUB formatting Ireland, book manuscript format Ireland, comic book script format Ireland';
$canonical_url    = location_abs($svc['href']);

require __DIR__ . '/includes/header.php';

$hero = [
    'crumbs' => [
        ['label' => 'Locations', 'href' => link_to('locations.php')],
        ['label' => 'Ireland',   'href' => location_url($locKey)],
        ['label' => 'Book Formatting'],
    ],
    'title'      => 'Book Formatting Services Ireland for Flawless <em class="serif-italic">Print and Digital Editions</em>',
    'paragraphs' => [
        "Writing a book takes months, sometimes years. Getting it formatted properly should not take nearly as long, but it still needs to be done right. A badly formatted book puts readers off before they even read the first line. Pages look cluttered, chapters start in the wrong place, and ebooks display strangely on different devices.",
        "At EU Publishing House, we sort all of this out for you. We work with authors across Ireland who are getting ready to self-publish, submit to an agent, or send a manuscript to a printer. Whatever stage you are at, we can format your book so it looks like it belongs on a shelf next to any traditionally published title. We understand that most authors are not designers. You should not have to learn the ins and outs of margins, gutters, and file types just to get your book out into the world. That is our job. You focus on the writing. We handle the layout.",
        "A lot of the formatting problems we see are small on their own but add up quickly. Inconsistent line spacing, chapter titles that jump around in size, images that shift out of place when a file is converted, page numbers that vanish halfway through a document. None of these are difficult to fix, but they are easy to miss if you are formatting your own book for the first time, especially when you are trying to do it in the same word processor you wrote the whole thing in.",
    ],
    'ctas' => [
        ['label' => 'Get a Free Quote', 'href' => '#popup',                'class' => 'btn-cta',   'popup'    => true],
        ['label' => 'Live Chat',        'href' => link_to('javascript:;'), 'class' => 'btn-glass', 'livechat' => true],
    ],
];
include __DIR__ . '/includes/service-hero.php';
include __DIR__ . '/includes/distributors.php';
?>

<!-- ============================================================
     FORMATTING SERVICES
     ============================================================ -->
<section class="services-section" id="formatting-types">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Every Output Covered</span>
            <h2 class="section-title">Where professional book formatting turns manuscripts <em class="serif-italic">into finished editions</em></h2>
            <p>Formatting is not just one job. It changes depending on whether your book is going to print, going onto an e-reader, or going to an agent or publisher for review. We handle all of these, and we treat each one differently because each one has its own rules.</p>
        </div>

        <div class="services-grid">
            <?php
            $types = [
                ['fa-print', 'Print Book Formatting and Layout',
                 'If your book is heading to a printer, the layout needs to match the exact page size and binding you have chosen. We set margins so nothing gets lost in the spine, add running headers and page numbers, and make sure chapter openings look consistent from start to finish. We also check that fonts are embedded properly, since a missing font can throw out an entire print run.'],
                ['fa-tablet-screen-button', 'Kindle Books Format in Ireland',
                 'Ereaders do not behave like printed pages. Text needs to reflow so it looks right on a phone screen, a tablet, or a dedicated e-reader. When we prepare an ebook for release, we build a clickable table of contents, set up proper chapter breaks, and check that images resize correctly instead of stretching or pixelating. We test the file on more than one device before it goes anywhere near a store.'],
                ['fa-a', 'Amazon Kindle Book Format in Ireland',
                 'Amazon has its own upload rules, and they change from time to time. If you are self-publishing through KDP, your file needs the correct trim size, cover specifications, and metadata, or you will hit rejections and delays. We prepare files to Amazon’s current requirements, set up front and back matter the way KDP expects, and make sure your book previews correctly before you hit publish.'],
                ['fa-file-lines', 'Digital Book Formats in Ireland',
                 'Not every author sells only through one platform. Many want their book available as an EPUB for Apple Books and Kobo, a MOBI file for older Kindle devices, or a PDF for direct sales from their own website. We build these out to match whichever mix of platforms you are aiming for, so you are not stuck reformatting the same book five times over.'],
                ['fa-g', 'Google Books Format in Ireland',
                 'Google Play Books has its own file requirements, separate from Amazon and Apple. A listing there needs a clean EPUB with correct metadata and a working table of contents, or Google will flag it during review. We prepare files that pass Google’s checks the first time, so your listing does not sit in limbo.'],
                ['fa-file-signature', 'Book Manuscript Format in Ireland',
                 'If you are sending your work to a literary agent or a traditional publisher, presentation matters more than most authors realise. A messy manuscript can get passed over regardless of how good the story is. A properly presented submission uses standard fonts, correct spacing, a title page with your details, and consistent scene and chapter breaks, exactly what agents expect to see when they open a file.'],
                ['fa-heading', 'Book Chapter Format in Ireland',
                 'Chapter openings set the tone for a book. Drop caps, numbering, section breaks, and spacing all need to be consistent from chapter one to the last page. Our work covers all of this, plus small details like widow and orphan lines, so no chapter ends with a single stray word sitting on its own at the top of a page.'],
                ['fa-comment-dots', 'Comic Book Script Format in Ireland',
                 'Comic scripts are a different animal entirely. Panels, dialogue, captions, and artist notes all need to be laid out clearly so an illustrator can follow the story without confusion. We offer this service for writers working with artists, covering panel breakdowns, character tags, and page numbering in a style that is standard across the industry.'],
            ];
            foreach ($types as $i => $s): ?>
                <article class="service-card" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 80 ?>">
                    <span class="service-icon"><i class="fa-solid <?= $s[0] ?>"></i></span>
                    <h3 class="service-title"><?= $s[1] ?></h3>
                    <p class="service-desc"><?= $s[2] ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================================
     WHO WE WORK WITH
     ============================================================ -->
<section class="section loc-audience-sec" id="who-we-help">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Who We Work With</span>
            <h2 class="section-title">Formatting support for authors publishing across <em class="serif-italic">every major platform</em></h2>
            <p>Our formatting clients come from all sorts of backgrounds. We regularly work with:</p>
        </div>

        <div class="loc-audience-grid">
            <?php
            $audience = [
                ['fa-book-open',        'First-time authors preparing their debut novel for self-publishing'],
                ['fa-file-lines',       'Non-fiction writers with reports, memoirs, or business books'],
                ['fa-feather-pointed',  'Poets putting together a collection for print'],
                ['fa-comment-dots',     'Comic and graphic novel writers working alongside an illustrator'],
                ['fa-building-columns', 'Small presses that need consistent formatting across a list of titles'],
                ['fa-screwdriver-wrench','Authors who already have a formatted file but need it updated or fixed'],
            ];
            foreach ($audience as $i => $a): ?>
                <div class="loc-audience-item" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 70 ?>">
                    <i class="fa-solid <?= $a[0] ?>"></i>
                    <span><?= $a[1] ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================================
     HOW TO CHOOSE
     ============================================================ -->
<section class="section loc-check-sec" id="how-to-choose">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Before You Commit</span>
            <h2 class="section-title">How to choose a book formatting service <em class="serif-italic">in Ireland</em></h2>
            <p>Not every formatting service is the same, and picking the wrong one can cost you time and money. Before you commit to anyone, ask:</p>
        </div>

        <div class="loc-check-grid">
            <?php
            $questions = [
                'Can they show you a sample of a finished, formatted book, not just a template?',
                'Do they format for the specific platform you need, whether that is print, Kindle, EPUB, or comic script?',
                'Will they test the file on an actual device before calling it finished?',
                'Is the price clear upfront, or will extra charges appear later?',
                'How many rounds of revisions are included if something needs adjusting?',
                'Do they understand the current upload requirements for the platform you are publishing on?',
            ];
            foreach ($questions as $i => $q): ?>
                <div class="loc-check-card" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 70 ?>">
                    <span class="loc-check-card__n"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                    <p><?= $q ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <p class="loc-note" data-aos="fade-up">If a provider cannot answer these clearly, that is worth noticing before you hand over your manuscript.</p>
    </div>
</section>

<!-- ============================================================
     WHY FORMATTING MATTERS
     ============================================================ -->
<section class="section section-mint loc-benefit-sec" id="why-it-matters">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Why It Matters</span>
            <h2 class="section-title">Why precision formatting protects your book’s <em class="serif-italic">reading experience</em></h2>
            <p>Authors sometimes treat formatting as an afterthought, something to rush through once the writing is done. In practice, it affects how the whole book is received.</p>
        </div>

        <div class="loc-benefit-grid">
            <?php
            $benefits = [
                ['fa-stopwatch',        'Readers judge quickly',      'Odd spacing, inconsistent fonts, or a table of contents that does not work will put a reader off within the first few pages.'],
                ['fa-clipboard-list',   'Retailers have rules',       'Amazon, Apple, and Google all reject files that do not meet their formatting standards, which delays your launch.'],
                ['fa-user-tie',         'Agents notice presentation', 'A cleanly formatted manuscript signals that you take the submission seriously.'],
                ['fa-euro-sign',        'Print runs are expensive to redo', 'A formatting mistake caught after printing means paying for the print job twice.'],
                ['fa-universal-access', 'Accessibility matters',      'Proper heading structure and reflowable text help readers using screen readers or larger font settings.'],
                ['fa-handshake',        'Consistency builds trust',   'Small details like matching fonts, aligned margins, and tidy chapter breaks tell a reader that care went into the whole book, not just the words.'],
            ];
            foreach ($benefits as $i => $b): ?>
                <article class="loc-benefit-card" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 70 ?>">
                    <span class="loc-benefit-card__icon"><i class="fa-solid <?= $b[0] ?>"></i></span>
                    <h3><?= $b[1] ?></h3>
                    <p><?= $b[2] ?></p>
                </article>
            <?php endforeach; ?>
        </div>

        <p class="loc-note" data-aos="fade-up">Getting it right the first time saves money, saves time, and gives your book the best possible start. It also means you are not stuck fixing the same file again a few weeks after launch, once readers or retailers start pointing out issues you missed.</p>
    </div>
</section>

<?php
/* ---- Process (6 steps from the brief) ---- */
$processEyebrow = 'Manuscript to Upload-Ready';
$processTitle   = 'How our book formatting process <em class="serif-italic">works</em>';
$processIntro   = 'Six stages, and every file is tested before it reaches you.';
$processSteps   = [
    ['n' => '01', 'title' => 'Send us your manuscript',
        'desc' => 'You send us your finished manuscript along with details on where it is heading, whether that is print, a specific e-reader store, or a submission to an agent. Tell us about any special elements too, such as images, tables, footnotes, or a comic script layout.'],
    ['n' => '02', 'title' => 'We review and quote',
        'desc' => 'We look through your file, note anything unusual that might affect the layout, and send you a clear quote. There are no hidden extras added later.'],
    ['n' => '03', 'title' => 'Formatting begins',
        'desc' => 'Our team formats your book to match your chosen output. This includes setting up styles, headers, chapter breaks, front matter, and back matter, plus any platform-specific requirements.'],
    ['n' => '04', 'title' => 'We test the file',
        'desc' => 'Before sending anything back, we check the file properly. Print files get checked for margins and bleed. Digital files get tested across devices and validated against store requirements.'],
    ['n' => '05', 'title' => 'You review and approve',
        'desc' => 'We send you the finished file to look over. If anything needs adjusting, we make the changes as part of the service, within the agreed scope.'],
    ['n' => '06', 'title' => 'Final delivery',
        'desc' => 'Once you are happy, we send you the final files in whatever formats you need, ready to upload, print, or submit.'],
];
include __DIR__ . '/includes/process.php';
?>

<!-- ============================================================
     WHY IRISH AUTHORS TRUST US
     ============================================================ -->
<section class="why-eph-sec" id="why-us">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="why-eph-art">
                    <img src="<?= asset('images/FormattingMatters-2048x1536.webp') ?>" alt="Why Irish authors trust EU Publishing House with book formatting" loading="lazy" decoding="async">
                    <span class="why-eph-art__chip">Formatting</span>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Why Authors Trust Us</span>
                <h2 class="section-title">Why Irish authors trust us with <em class="serif-italic">every final detail</em></h2>
                <ul class="loc-diff-list" role="list">
                    <li><i class="fa-solid fa-check"></i><span><strong>We format for every output, not just one.</strong> Print, Kindle, EPUB, PDF, Google Play, and comic scripts are all covered under one roof, so you are not juggling different providers.</span></li>
                    <li><i class="fa-solid fa-check"></i><span><strong>We keep pricing straightforward.</strong> You get a quote before any work starts, based on your actual manuscript, not a guess.</span></li>
                    <li><i class="fa-solid fa-check"></i><span><strong>We test before we deliver.</strong> Files are checked on real devices and against current platform requirements, not just eyeballed on a screen.</span></li>
                    <li><i class="fa-solid fa-check"></i><span><strong>We work with Irish authors regularly.</strong> We understand the small press and self-publishing scene here, and we are easy to reach by phone or email.</span></li>
                    <li><i class="fa-solid fa-check"></i><span><strong>We stick to deadlines.</strong> If you have a launch date or a submission deadline, we plan the work around it.</span></li>
                </ul>
                <div class="mt-4">
                    <a href="#popup" class="btn btn-cta" data-popup>Get Your Quote <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
/* ---- Shared six-service cross-link block ---- */
$coreLocation = $locKey;
$coreCurrent  = 'formatting';
$coreEyebrow  = 'Complete Support';
$coreTitle    = 'Complete services for authors that carry your formatted book <em class="serif-italic">into market</em>';
include __DIR__ . '/includes/location-core-services.php';
?>

<!-- ============================================================
     COST
     ============================================================ -->
<section class="publish-cost-sec" id="pricing">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="publish-cost-art">
                    <img src="<?= asset('images/BookFormattingCost-2048x1536.webp') ?>" alt="Cost of formatting a book for print in Ireland" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Pricing</span>
                <h2 class="section-title">Cost of formatting a book for print <em class="serif-italic">in Ireland</em></h2>
                <p>Pricing depends on the length of your manuscript, the complexity of the layout, and how many formats you need. A straightforward novel with no images costs less than a heavily illustrated non-fiction book or a comic script with detailed panel layouts.</p>
                <p>Pricing also depends on extras like custom chapter headers, an index, footnotes, or a table of contents that needs to be built by hand. Rather than quote a flat rate that will not fit most projects, we look at your manuscript first and send you a clear, itemised quote. There are no surprise charges once the work has started.</p>
                <p>Get in touch with a sample of your manuscript, and we will get a quote back to you quickly.</p>
                <a href="#popup" class="btn btn-cta btn-lg" data-popup>Get Your Free Quote <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<?php
$exclude_slug = 'formatting';
include __DIR__ . '/includes/books-portfolio.php';

/* ---- FAQs ---- */
$faqId    = 'ireFormatFaq';
$faqTitle = 'Frequently asked <em class="serif-italic">questions</em>';
$faqs = [
    ['q' => 'How long does book formatting take in Ireland?',
     'a' => 'Most straightforward manuscripts take between one and two weeks. Larger or more complex projects, such as illustrated books or comic scripts, can take longer. We will give you a timeline once we have seen your manuscript.'],
    ['q' => 'Do you format books for authors outside Dublin?',
     'a' => 'Yes. We work with authors right across Ireland, and everything can be handled by email and phone, so your location does not matter.'],
    ['q' => 'Can you format my book for more than one platform at once?',
     'a' => 'Yes. Many of our clients need a print version alongside an ebook version. We can prepare both from the same manuscript, formatted correctly for each output.'],
    ['q' => 'What file should I send you to start?',
     'a' => 'A Word document is usually best, since it is easy for us to work with. If your manuscript is in another format, let us know, and we can advise.'],
    ['q' => 'Do you offer formatting for comic scripts as well as novels?',
     'a' => 'Yes. We format comic scripts for writers working with an illustrator, laying out panels, dialogue, and notes in a clear, standard style.'],
    ['q' => 'Will my book meet Amazon’s requirements after formatting?',
     'a' => 'Yes. We prepare files to meet current upload requirements for Amazon, Apple Books, Google Play, and other major platforms, so you should not run into rejections.'],
    ['q' => 'How much does book formatting cost?',
     'a' => 'It depends on your manuscript’s length and complexity, and how many formats you need. We send a clear quote after reviewing your file, with no hidden extras.'],
    ['q' => 'Do I need my book formatted separately for print and for ebook?',
     'a' => 'Yes, print and digital files are built differently, since one is a fixed page and the other needs to reflow across screens. We can prepare both from a single manuscript, so you only need to send it to us once.'],
    ['q' => 'Can you help if I already tried formatting my book myself and it went wrong?',
     'a' => 'Yes, this is common. Send us the file as it is, along with a note on what looks wrong, and we will assess it and quote for putting it right.'],
];
include __DIR__ . '/includes/location-faq.php';

/* ---- Closing CTA ---- */
$ctaEyebrow = 'Ready When You Are';
$ctaTitle   = 'Ready to make every page look <em class="serif-italic">professionally published?</em>';
$ctaSub     = 'Your book has taken long enough to write. Do not let a formatting problem hold it back now. Send us your manuscript and tell us where it is headed, whether that is a print run, an ebook store, or an agent’s inbox. We will take care of the rest and keep you updated the whole way through. Contact EU Publishing House today for a free, no-obligation quote on your book formatting.';
include __DIR__ . '/includes/final-cta.php';

/* ---- Structured data ---- */
$schemaCrumbs = [
    ['name' => 'Locations',       'url' => rtrim(BRAND_SITE_URL, '/') . '/locations/'],
    ['name' => 'Ireland',         'url' => location_abs($loc['hub'])],
    ['name' => 'Book Formatting', 'url' => $canonical_url],
];
$schemaService = [
    'name'        => 'Book Formatting Services in Ireland',
    'description' => $page_description,
    'url'         => $canonical_url,
    'serviceType' => 'Book formatting',
    'areaServed'  => 'Ireland',
];
include __DIR__ . '/includes/location-schema.php';

include __DIR__ . '/includes/footer.php';
