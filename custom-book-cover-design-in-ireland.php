<?php
/* =================================================================
   /custom-book-cover-design-in-ireland/
   Ireland location cluster — cover design and illustration. Copy from
   the brief "Book Cover Design Ireland | Illustration & Kindle Covers".
================================================================= */

require_once __DIR__ . '/includes/locations-data.php';

$locKey = 'ireland';
$loc    = location_get($locKey);
$svc    = $loc['services']['design'];

$page_title       = 'Book Cover Design in Ireland for Authors Who Stand Out';
$page_description = 'Get book cover design in Ireland that turns browsers into buyers. Custom, genre-ready covers crafted to reflect your story and grab reader attention fast.';
$page_keywords    = 'book cover design Ireland, Kindle cover design Ireland, children\'s book illustration Ireland, print book design Ireland, book illustrator Ireland';
$canonical_url    = location_abs($svc['href']);

require __DIR__ . '/includes/header.php';

$hero = [
    'crumbs' => [
        ['label' => 'Locations', 'href' => link_to('locations.php')],
        ['label' => 'Ireland',   'href' => location_url($locKey)],
        ['label' => 'Cover Design'],
    ],
    'title'      => 'Custom Book Cover Design in Ireland That Helps <em class="serif-italic">Your Book Sell</em>',
    'paragraphs' => [
        "Your book deserves a cover that stops people scrolling. Whether you are self-publishing your first novel, formatting a Kindle edition, or bringing a children’s story to life with pictures, the way your book looks matters just as much as what it says inside.",
        "At EU Publishing House, we work with authors, small presses, and independent publishers across Ireland. We know that a rushed cover or a mismatched illustration style can hold back a great story. That’s why we take the time to understand your book before we design a single thing.",
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
     FIRST GLANCE
     ============================================================ -->
<section class="why-eph-sec" id="first-glance">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="why-eph-art">
                    <img src="<?= asset('images/ProfessionalBookCover-2048x1967.webp') ?>" alt="Why a book cover must win the first glance" loading="lazy" decoding="async">
                    <span class="why-eph-art__chip">First look</span>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Why Covers Decide</span>
                <h2 class="section-title">Why your book cover must win <em class="serif-italic">the first glance</em></h2>
                <p>Readers make snap decisions. A cluttered cover, a font that doesn’t fit the genre, or an illustration that looks out of place can turn a reader away before they even read your blurb. On the other hand, a clean, well-thought-out cover builds trust straight away. It tells the reader what kind of book they’re about to pick up, and it sets the tone for everything that follows.</p>
                <p>This is true whether your book is a thriller, a memoir, a business guide, or a picture book for children. Every genre has its own visual language, and getting that right is part of the job.</p>
                <div class="mt-4">
                    <a href="#popup" class="btn btn-cta" data-popup>Design My Cover <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     DESIGN SERVICES
     ============================================================ -->
<section class="services-section" id="design-services">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">What We Design</span>
            <h2 class="section-title">Creative book design and illustration services in Ireland <em class="serif-italic">built to stand out</em></h2>
            <p>We split our work into a few clear areas, so you always know what you’re getting and what it will involve.</p>
        </div>

        <div class="services-grid">
            <?php
            $services = [
                ['fa-palette', 'Book Cover Design',
                 'This is where most projects start. Our full front, back, and spine cover work covers print books, along with a matching digital version for online listings. We talk to you about your genre, your target reader, and any cover styles you like before we start sketching ideas. You’ll see a small number of concepts first, not one option with no context.'],
                ['fa-tablet-screen-button', 'Kindle and E-Book Cover Design',
                 'E-book covers work differently to print. They need to read clearly as a small thumbnail on a phone screen, not just as a full size image. Our Kindle book cover design service in Ireland is built around that. We design covers that hold up at any size, so your book still looks sharp when it’s one of dozens of thumbnails on a search page.'],
                ['fa-file-code', 'Full Kindle Formatting and Layout',
                 'Beyond the cover itself, a lot of authors need help getting the whole file ready for Amazon and other e-book platforms. Our Kindle book design service in Ireland includes interior formatting, chapter breaks, table of contents links, and making sure the file displays properly across different devices. There’s nothing worse than a beautiful cover attached to a file that looks broken once someone opens it.'],
                ['fa-book-open', 'Print Book Design',
                 'For paperback and hardback editions, layout is a different job again. Margins, gutters, page numbering, chapter openers and font choices all need to work together so the book is comfortable to read and looks professional on a shelf. Our print layout work covers the full interior, not just the cover, so your finished book is consistent from front to back.'],
                ['fa-child-reaching', 'Children’s Book Illustration',
                 'Picture books need a different skill set entirely. Our children’s book illustration in Ireland work covers character design, full-page and spread illustrations, and colour palettes that match the mood and age group of your story. We work closely with authors and, where relevant, with parents or educators, to make sure the pictures support the story rather than just decorate it.'],
                ['fa-pen-ruler', 'Illustration for Older Readers and Chapter Books',
                 'Not every illustration project is a full picture book. Some authors just need a handful of spot illustrations, a strong cover illustration, or chapter opener artwork. Our book illustration services in Ireland flex to fit the size of your project, whether that’s one image or forty.'],
            ];
            foreach ($services as $i => $s): ?>
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
     GENRES
     ============================================================ -->
<section class="section section-mint loc-audience-sec" id="genres">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Genre Styles</span>
            <h2 class="section-title">Visual styles crafted for every genre <em class="serif-italic">and Irish reader</em></h2>
            <p>Every genre carries its own visual expectations, and readers pick up on this quickly, even without realising it. A crime thriller cover that looks like a romance novel will confuse readers before they even open the book. We design and illustrate across a wide range of categories, including:</p>
        </div>

        <div class="loc-audience-grid">
            <?php
            $genres = [
                ['fa-masks-theater', 'Fiction, from literary novels to genre fiction like crime, romance and fantasy'],
                ['fa-heart',         'Memoir and biography, where tone and honesty matter more than flashy graphics'],
                ['fa-chart-line',    'Business and self-help books, which usually need a cleaner, more direct look'],
                ['fa-feather-pointed','Poetry collections, which often benefit from simpler, more atmospheric covers'],
                ['fa-child-reaching','Picture books and early reader books for children'],
                ['fa-user-group',    'Middle grade and young adult fiction, which sits between picture books and adult covers in style'],
            ];
            foreach ($genres as $i => $a): ?>
                <div class="loc-audience-item" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 70 ?>">
                    <i class="fa-solid <?= $a[0] ?>"></i>
                    <span><?= $a[1] ?></span>
                </div>
            <?php endforeach; ?>
        </div>

        <p class="loc-note" data-aos="fade-up">If your book doesn’t fit neatly into one category, that’s fine. Tell us about it, and we’ll suggest a direction that fits.</p>
    </div>
</section>

<!-- ============================================================
     WHO WE WORK WITH
     ============================================================ -->
<section class="section loc-audience-sec" id="who-we-help">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Who We Work With</span>
            <h2 class="section-title">How to choose the right Ireland book designer <em class="serif-italic">without regret</em></h2>
            <p>We take on projects for a wide range of clients, including:</p>
        </div>

        <div class="loc-audience-grid">
            <?php
            $clients = [
                ['fa-book-open',        'First-time authors self-publishing their debut book'],
                ['fa-rotate',           'Established authors refreshing an old cover or series'],
                ['fa-building-columns', 'Small publishers who need reliable design support without hiring in-house'],
                ['fa-chalkboard-user',  'Parents and educators producing a picture book for a specific child or classroom'],
                ['fa-briefcase',        'Non-fiction writers who need a professional look for business or memoir books'],
                ['fa-pen-nib',          'Illustrators’ agents and studios looking for overflow support'],
            ];
            foreach ($clients as $i => $a): ?>
                <div class="loc-audience-item" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 70 ?>">
                    <i class="fa-solid <?= $a[0] ?>"></i>
                    <span><?= $a[1] ?></span>
                </div>
            <?php endforeach; ?>
        </div>

        <p class="loc-note" data-aos="fade-up">If you’re not sure whether your project fits, get in touch and describe it to us. We’ll tell you honestly if we’re the right match.</p>
    </div>
</section>

<!-- ============================================================
     HOW TO CHOOSE
     ============================================================ -->
<section class="section loc-check-sec" id="how-to-choose">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Before You Commit</span>
            <h2 class="section-title">How to choose an illustrator or cover designer <em class="serif-italic">without getting it wrong</em></h2>
            <p>Not every design studio suits every book. Before you commit to anyone, including us, it’s worth asking a few honest questions:</p>
        </div>

        <div class="loc-check-grid">
            <?php
            $questions = [
                'Can they show you a portfolio in a style close to what you have in mind, not just their favourite pieces?',
                'Do they explain their process clearly, or do they just quote a price and go quiet?',
                'Will you get more than one concept to choose from, or just one take it or leave it option?',
                'Are revisions included, and how many rounds do you get before extra charges apply?',
                'Do they understand the technical side, like file formats for print versus Kindle?',
                'Will you own the final files and rights once the project is finished?',
            ];
            foreach ($questions as $i => $q): ?>
                <div class="loc-check-card" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 70 ?>">
                    <span class="loc-check-card__n"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                    <p><?= $q ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <p class="loc-note" data-aos="fade-up">A good design studio should be able to answer all of these clearly, without hesitation. If someone dodges these questions, take that as a warning sign.</p>
    </div>
</section>

<!-- ============================================================
     WHY DESIGN CHANGES THE OUTCOME
     ============================================================ -->
<section class="section loc-benefit-sec" id="why-it-matters">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Why It Matters</span>
            <h2 class="section-title">Why good design and illustration actually <em class="serif-italic">changes the outcome</em></h2>
            <p>It’s tempting to think of a cover or illustration as the last step, something to tick off once the writing is done. In reality, it affects your book long after publication:</p>
        </div>

        <div class="loc-benefit-grid">
            <?php
            $benefits = [
                ['fa-eye',            'More readers stop to look',      'A strong cover increases the chance someone stops to read your blurb at all.'],
                ['fa-file-circle-check','Fewer returns and complaints', 'Clear, professional formatting reduces returns and one-star reviews about “broken” files.'],
                ['fa-child-reaching', 'Young readers stay engaged',     'Consistent illustration style across a picture book keeps young readers engaged from page to page.'],
                ['fa-bullseye',       'The right readers find you',     'A cover that fits your genre helps the right readers find your book, and helps the wrong readers self-select out, saving everyone time.'],
                ['fa-book-open',      'A better reading experience',    'Good interior layout makes your print book easier to read, which matters for reviews and word of mouth.'],
            ];
            foreach ($benefits as $i => $b): ?>
                <article class="loc-benefit-card" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 70 ?>">
                    <span class="loc-benefit-card__icon"><i class="fa-solid <?= $b[0] ?>"></i></span>
                    <h3><?= $b[1] ?></h3>
                    <p><?= $b[2] ?></p>
                </article>
            <?php endforeach; ?>
        </div>

        <p class="loc-note" data-aos="fade-up">None of this replaces good writing. But it does decide whether people give your writing a chance in the first place.</p>
    </div>
</section>

<?php
/* ---- Process ---- */
$processEyebrow = 'Brief to Final Files';
$processTitle   = 'From creative brief to final files: <em class="serif-italic">our design process</em>';
$processIntro   = 'Five stages, with real concepts to choose from rather than one take it or leave it design.';
$processSteps   = [
    ['n' => '01', 'title' => 'You tell us about your book',
        'desc' => 'We start with a short conversation or a form where you describe your book, your genre, your audience, and any cover or illustration styles you already like. The more detail you give us here, the fewer rounds of changes we’ll need later.'],
    ['n' => '02', 'title' => 'We send a quote and timeline',
        'desc' => 'Once we understand the scope, we send you a clear quote and an honest timeframe. No vague promises, just what it will cost and roughly how long it will take.'],
    ['n' => '03', 'title' => 'We create initial concepts',
        'desc' => 'For cover design, we usually put together a small number of different directions so you can see real options, not just one idea. For illustration projects, this stage might include character sketches or a sample spread before we commit to the full book.'],
    ['n' => '04', 'title' => 'You give feedback, and we refine',
        'desc' => 'You pick a direction, or tell us what’s working and what isn’t. We refine based on your notes. This is a back-and-forth stage, and we build in a set number of revision rounds so there are no surprises.'],
    ['n' => '05', 'title' => 'Final files and delivery',
        'desc' => 'Once you’re happy, we deliver the final files in the formats you need, whether that’s print-ready PDFs, Kindle-compatible files, or high-resolution illustration files for your own use. You’ll get clear instructions on how to use each file, not just a folder dropped in your inbox. If you run into an upload issue with a platform after delivery, you can come back to us, and we’ll help sort it out rather than leaving you to figure it out alone.'],
];
include __DIR__ . '/includes/process.php';
?>

<!-- ============================================================
     WHY CHOOSE OUR TEAM
     ============================================================ -->
<section class="why-eph-sec" id="why-us">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="why-eph-art">
                    <img src="<?= asset('images/BookCoverDesignCost-2048x1365.webp') ?>" alt="Why Irish authors choose our creative design team" loading="lazy" decoding="async">
                    <span class="why-eph-art__chip">Design</span>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Why Authors Choose Us</span>
                <h2 class="section-title">Why Irish authors choose our <em class="serif-italic">creative design team</em></h2>
                <ul class="loc-diff-list" role="list">
                    <li><i class="fa-solid fa-check"></i><span><strong>We’re straightforward about pricing.</strong> You get a proper quote before any work starts, not a surprise invoice halfway through.</span></li>
                    <li><i class="fa-solid fa-check"></i><span><strong>We work in Irish English by default.</strong> Your book is edited and discussed with Irish spelling and phrasing in mind, so nothing reads oddly for a local audience.</span></li>
                    <li><i class="fa-solid fa-check"></i><span><strong>You keep control of the process.</strong> You see real concepts, not a single take it or leave it design, and you have a say at every stage.</span></li>
                    <li><i class="fa-solid fa-check"></i><span><strong>We understand both print and digital.</strong> Many designers only know one side of publishing. We handle print layout, Kindle formatting, and illustration under one roof, so your files work properly wherever they’re read.</span></li>
                    <li><i class="fa-solid fa-check"></i><span><strong>We’re honest when something isn’t a fit.</strong> If your project needs a different kind of specialist, we’ll tell you rather than take the job anyway.</span></li>
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
$coreCurrent  = 'design';
$coreEyebrow  = 'Complete Support';
$coreTitle    = 'Additional book services beyond covers, layouts <em class="serif-italic">and illustrations</em>';
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
                    <img src="<?= asset('images/whatWeAreHereToDo-2048x1677.webp') ?>" alt="Book cover and illustration pricing in Ireland" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Pricing</span>
                <h2 class="section-title">Book cover and illustration pricing without <em class="serif-italic">hidden surprises</em></h2>
                <p>Pricing depends on the scope of your project. A single e-book cover costs less than a full picture book with twenty illustrated spreads, and a straightforward genre novel cover costs less than a highly detailed custom illustration. Rather than publish a flat rate that won’t fit most projects, we prefer to give you a proper quote once we understand what you need. Get in touch with a short description of your book, and we’ll come back to you with clear, honest pricing and no obligation to proceed.</p>
                <a href="#popup" class="btn btn-cta btn-lg" data-popup>Get Your Free Quote <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<?php
$exclude_slug = 'design';
include __DIR__ . '/includes/books-portfolio.php';

/* ---- FAQs ---- */
$faqId    = 'ireDesignFaq';
$faqTitle = 'Frequently asked <em class="serif-italic">questions</em>';
$faqs = [
    ['q' => 'Do you only work with authors based in Ireland?',
     'a' => 'No, but we’re set up specifically to support Irish authors and publishers, with Irish English used throughout the design and editing process. We’re happy to hear from authors elsewhere too.'],
    ['q' => 'How long does a typical book cover design project take?',
     'a' => 'It depends on the project, but most single cover designs take a few weeks from first chat to final file, including a round or two of revisions. Larger illustration projects, like a full picture book, take longer. We’ll give you a realistic timeline once we know the scope.'],
    ['q' => 'Can you design a cover for a book I’ve already published?',
     'a' => 'Yes. Plenty of authors come to us to refresh an older cover that isn’t performing well, or to update a series so all the books match. We can work from your existing files or start fresh.'],
    ['q' => 'Are you a children’s book illustration agency in Ireland for self-published authors, or only for traditional publishers?',
     'a' => 'Both. Most of our children’s book clients are self-published authors and parents working on a personal project, alongside some small publishers. You don’t need any industry connections to work with us.'],
    ['q' => 'What file formats will I receive at the end?',
     'a' => 'That depends on where your book will be published. Typically you’ll get print-ready PDF files for paperback or hardback, and separate Kindle-compatible files for e-book platforms, along with the original design files for your own records.'],
    ['q' => 'Do I need to already have a finished manuscript before contacting you?',
     'a' => 'Not necessarily. It helps if your manuscript is close to final, especially for interior layout work, but for cover concepts and illustration planning, we can often start once you have a clear outline and sense of the story.'],
    ['q' => 'Is EU Publishing House available for authors outside Dublin?',
     'a' => 'Yes. We work with clients right across Ireland, and all of our design and illustration work is done remotely, so your location doesn’t affect how we work together.'],
];
include __DIR__ . '/includes/location-faq.php';

/* ---- Closing CTA ---- */
$ctaEyebrow = 'Ready When You Are';
$ctaTitle   = 'Ready to give your story a <em class="serif-italic">shelf-stopping visual identity?</em>';
$ctaSub     = 'Your story has taken time and effort to write. It’s worth giving it a cover and, where needed, illustrations that match that effort. Reach out to EU Publishing House with a few details about your book, and we’ll get back to you with ideas and a clear quote. No pressure, no jargon, just a straightforward conversation about your book.';
include __DIR__ . '/includes/final-cta.php';

/* ---- Structured data ---- */
$schemaCrumbs = [
    ['name' => 'Locations',    'url' => rtrim(BRAND_SITE_URL, '/') . '/locations/'],
    ['name' => 'Ireland',      'url' => location_abs($loc['hub'])],
    ['name' => 'Cover Design', 'url' => $canonical_url],
];
$schemaService = [
    'name'        => 'Custom Book Cover Design in Ireland',
    'description' => $page_description,
    'url'         => $canonical_url,
    'serviceType' => 'Book cover design and illustration',
    'areaServed'  => 'Ireland',
];
include __DIR__ . '/includes/location-schema.php';

include __DIR__ . '/includes/footer.php';
