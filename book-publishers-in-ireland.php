<?php
/* =================================================================
   /book-publishers-in-ireland/
   Ireland location cluster — publishing. Copy from the content brief
   "Book Publishers Ireland | Publishing for Irish Authors".
================================================================= */

require_once __DIR__ . '/includes/locations-data.php';

$locKey = 'ireland';
$loc    = location_get($locKey);
$svc    = $loc['services']['publishing'];

$page_title       = 'Leading Book Publishers in Ireland for Aspiring Authors';
$page_description = 'Choose book publishers in Ireland dedicated to bringing your manuscript to life with expert editing, design, and guidance from concept through to launch.';
$page_keywords    = 'book publishers Ireland, hybrid publishing services Ireland, book printing Ireland, business book publishers Ireland, publishing houses Ireland';
$canonical_url    = location_abs($svc['href']);

require __DIR__ . '/includes/header.php';

$hero = [
    'crumbs' => [
        ['label' => 'Locations', 'href' => link_to('locations.php')],
        ['label' => 'Ireland',   'href' => location_url($locKey)],
        ['label' => 'Book Publishing'],
    ],
    'title'      => 'Book Publishers in Ireland Committed to Quality <em class="serif-italic">Editing and Design</em>',
    'paragraphs' => [
        "Writing a book takes months, sometimes years, of hard work. Once the manuscript is finished, a new set of decisions begins. How do you edit it properly? Who designs the cover? Where do you get it printed, and how do you get it in front of readers? That is where we come in.",
        "EU Publishing House works with authors right across the country, from first-time writers to business owners who want to turn their knowledge into a book people can actually hold. Irish book publishing has changed a lot over the last few years, and there are now more paths to getting a book out than most people realise.",
        "Some writers want full control over every decision and a fast turnaround. Others want more guidance from a team who has done this many times before. Whichever stage you are at, we meet you where you are, and we explain everything in plain terms before you commit to anything. Before you choose a partner for your book, it helps to know what a publisher actually does day to day, and what to ask before you sign anything. That is what the rest of this page is about.",
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
     WHAT WE DO
     ============================================================ -->
<section class="services-section" id="what-we-do">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Manuscript to Bookstore</span>
            <h2 class="section-title">What we actually do for your book, from finished manuscript <em class="serif-italic">to bookstore</em></h2>
            <p>A finished manuscript is only the starting point. Getting from a Word document to a finished book on a shelf, or in an online store, involves several stages. Here is how we break it down.</p>
        </div>

        <div class="services-grid">
            <?php
            $stages = [
                ['icon' => 'fa-pen-fancy', 'title' => 'Editing That Respects Your Voice',
                 'desc' => 'Every manuscript we take on goes through an editing stage first. This can mean developmental editing, where we look at structure, pacing, and plot or argument. It can also mean line editing, where we tighten sentences and fix awkward phrasing, or a final proofread to catch typos and formatting slips before print. We do not rewrite your book for you. We help it read the way you meant it to.'],
                ['icon' => 'fa-palette', 'title' => 'Cover and Interior Design',
                 'desc' => 'A reader judges a book by its cover, whether we like it or not. Our design team builds covers that fit the genre and the audience, and lays out the interior pages so they are easy to read, whether that is a novel, a poetry collection, or a business book packed with charts and case studies.'],
                ['icon' => 'fa-handshake', 'title' => 'Hybrid Publishing Services Ireland Authors Are Choosing More Often',
                 'desc' => 'Not every author wants to go fully independent, and not every author wants to hand over all creative control either. This middle path is exactly what more Irish writers are turning to now. You keep more say over your book and a larger share of the rights, while we handle the editing, design, printing and distribution work that takes real time and skill. It suits authors who want a professional finish without giving up ownership of their work, and who would rather stay involved in every decision along the way rather than sign a full package over to someone else.'],
                ['icon' => 'fa-print', 'title' => 'Book Printing Ireland Authors Can Rely On',
                 'desc' => 'Once a manuscript is edited and designed, it needs to be printed well. That means solid paper stock, proper binding, and colour that actually matches what was approved on screen, not a washed out copy of it. We can arrange short print runs for a launch event, or larger runs once you know demand, so you are not left with boxes of stock you cannot sell. We also check every proof copy ourselves before it goes anywhere near you, so mistakes get caught early rather than after five hundred copies have already been printed.'],
                ['icon' => 'fa-briefcase', 'title' => 'Business Book Publishers in Ireland for Founders and Experts',
                 'desc' => 'More consultants, coaches and business owners are writing books to support their work, whether that is for credibility, for client education, or as a lead generation tool. We understand that these books have a different job to do than a novel. They need to be clear, well structured, and easy for a busy reader to skim, while still reading as a proper, professional book, with case studies and examples laid out so they are easy to find again later.'],
                ['icon' => 'fa-globe', 'title' => 'Distribution and Launch Support',
                 'desc' => 'Printing a book is not the same as getting it read. We help authors set up listings on the major online stores, arrange ISBNs, and plan a launch that actually reaches people, whether that is a local bookshop event, a press release, or a simple online campaign.'],
            ];
            foreach ($stages as $i => $s): ?>
                <article class="service-card" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 80 ?>">
                    <span class="service-icon"><i class="fa-solid <?= $s['icon'] ?>"></i></span>
                    <h3 class="service-title"><?= $s['title'] ?></h3>
                    <p class="service-desc"><?= $s['desc'] ?></p>
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
            <h2 class="section-title">Publishing support for every story, genre <em class="serif-italic">and author goal</em></h2>
            <p>We have worked with a wide range of authors, including:</p>
        </div>

        <div class="loc-audience-grid">
            <?php
            $audience = [
                ['fa-book-open',      'First time novelists who have never worked with a publisher before'],
                ['fa-feather-pointed','Poets and short story writers putting together their first collection'],
                ['fa-heart',          'People writing a memoir for family, or for a wider audience'],
                ['fa-briefcase',      'Business owners and consultants writing their first book'],
                ['fa-landmark',       'Local historians and community groups documenting local stories'],
                ['fa-arrow-up-right-dots', 'Self-published authors who want a more polished, professional result'],
            ];
            foreach ($audience as $i => $a): ?>
                <div class="loc-audience-item" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 70 ?>">
                    <i class="fa-solid <?= $a[0] ?>"></i>
                    <span><?= $a[1] ?></span>
                </div>
            <?php endforeach; ?>
        </div>

        <p class="loc-note" data-aos="fade-up">If you fit into one of these groups, or none of them, get in touch anyway. Most projects do not fit neatly into a category, and that is fine. We would rather have a conversation about your actual book than try to slot you into a package that does not quite suit what you are trying to do.</p>
    </div>
</section>

<!-- ============================================================
     HOW TO CHOOSE
     ============================================================ -->
<section class="section loc-check-sec" id="how-to-choose">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Before You Sign Anything</span>
            <h2 class="section-title">How to choose the right <em class="serif-italic">book publisher in Ireland</em></h2>
            <p>Not all Irish publishers work the same way, and that is worth understanding before you sign anything or hand over any money. Whoever you choose to work with, ask these questions first:</p>
        </div>

        <div class="loc-check-grid">
            <?php
            $questions = [
                'Who owns the rights to my book once it is published?',
                'What exactly is included in the price, and what costs extra later?',
                'How long will editing, design, and printing take, from start to finish?',
                'Will I see and approve the cover and interior before it goes to print?',
                'Where will my book be sold, and who controls that listing?',
                'Can I speak to a real person if something goes wrong along the way?',
            ];
            foreach ($questions as $i => $q): ?>
                <div class="loc-check-card" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 70 ?>">
                    <span class="loc-check-card__n"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                    <p><?= $q ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <p class="loc-note" data-aos="fade-up">A lot of writers search online for the best publisher Ireland has to offer without knowing what questions to ask first, and end up choosing based on price alone or on a slick-looking website. Getting clear answers to the points above matters more than any single review or recommendation, and a publisher who is happy to answer them plainly, without vague or evasive replies, is usually one worth trusting.</p>
    </div>
</section>

<!-- ============================================================
     WHY IT MATTERS
     ============================================================ -->
<section class="section section-mint loc-benefit-sec" id="why-it-matters">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Why Use a Team</span>
            <h2 class="section-title">Why Ireland publishing shapes how readers <em class="serif-italic">value your book</em></h2>
            <p>Self-publishing without any support is possible, and plenty of people do it. But there are reasons so many authors still choose to work with a team:</p>
        </div>

        <div class="loc-benefit-grid">
            <?php
            $benefits = [
                ['fa-triangle-exclamation', 'Fewer costly mistakes', 'A missed formatting error or a badly cropped cover image can mean an entire print run has to be redone.'],
                ['fa-book',                 'A book that looks and reads as it should', 'Readers notice poor spacing, inconsistent fonts, and clumsy editing, even if they cannot always say why something feels off.'],
                ['fa-clock',                'Time saved', 'Learning design software, sourcing a printer, and setting up online listings from scratch takes far longer than most people expect.'],
                ['fa-flag-checkered',       'A clearer path to actually finishing', 'Many manuscripts never become books simply because the process afterwards feels too complicated to face alone.'],
                ['fa-circle-question',      'Someone to ask when you are not sure', 'Questions come up at every stage, from rights to royalties to launch timing, and it helps to have someone experienced to ask rather than guessing.'],
            ];
            foreach ($benefits as $i => $b): ?>
                <article class="loc-benefit-card" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 70 ?>">
                    <span class="loc-benefit-card__icon"><i class="fa-solid <?= $b[0] ?>"></i></span>
                    <h3><?= $b[1] ?></h3>
                    <p><?= $b[2] ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
/* ---- Process (5 steps from the brief) ---- */
$processEyebrow = 'Step by Step';
$processTitle   = 'How our process works <em class="serif-italic">in Ireland</em>';
$processIntro   = 'Five stages, and you approve each one before we move on to the next.';
$processSteps   = [
    ['n' => '01', 'title' => 'A free chat about your manuscript',
        'desc' => 'We start with a conversation, not a sales pitch. Send us your manuscript, or even just an outline, and we will talk through where it stands and what it needs.'],
    ['n' => '02', 'title' => 'Editing and structural feedback',
        'desc' => 'Once we agree on scope, your book goes through the appropriate level of editing, with clear notes so you understand every suggested change.'],
    ['n' => '03', 'title' => 'Design and layout',
        'desc' => 'Our designers build your cover and lay out the interior, sending drafts for your feedback at each stage rather than presenting one final version and hoping it lands.'],
    ['n' => '04', 'title' => 'Printing and proofing',
        'desc' => 'Before any full print run, you get a physical or digital proof copy to check. Nothing goes to a larger print run without your sign-off.'],
    ['n' => '05', 'title' => 'Launch and ongoing support',
        'desc' => 'We help you set up your online listings, plan a launch, and remain available if you need reprints, a second edition, or advice further down the line.'],
];
include __DIR__ . '/includes/process.php';
?>

<!-- ============================================================
     WHY CHOOSE US
     ============================================================ -->
<section class="why-eph-sec" id="why-us">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="why-eph-art">
                    <img src="<?= asset('images/BookPublishersAcrossEurope-2048x1754.webp') ?>" alt="Why authors across Ireland choose EU Publishing House" loading="lazy" decoding="async">
                    <span class="why-eph-art__chip">Ireland</span>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Why Authors Choose Us</span>
                <h2 class="section-title">Why authors across Ireland choose <em class="serif-italic">EU Publishing House</em></h2>
                <p>There are many publishing houses in Ireland, but not all of them offer the same level of honesty about cost, timeline and rights. Here is what sets us apart:</p>
                <ul class="loc-diff-list" role="list">
                    <li><i class="fa-solid fa-check"></i><span><strong>Clear, upfront pricing.</strong> You get a written quote before any work begins, so there are no surprise invoices later.</span></li>
                    <li><i class="fa-solid fa-check"></i><span><strong>You keep control of your rights.</strong> We do not ask authors to sign away ownership of their own work.</span></li>
                    <li><i class="fa-solid fa-check"></i><span><strong>Local understanding.</strong> We know Irish spelling, tone and readers, and we write and design with that audience in mind.</span></li>
                    <li><i class="fa-solid fa-check"></i><span><strong>One point of contact.</strong> You deal with the same person throughout your project, not a different name every time you email.</span></li>
                    <li><i class="fa-solid fa-check"></i><span><strong>Honest advice, even when it is not what you want to hear.</strong> If a manuscript needs more editing before it is ready, we will tell you.</span></li>
                </ul>
                <p class="mt-3">Most Ireland publishing houses ask authors to fit into one fixed package. We would rather understand your book first, then suggest the right level of support for it.</p>
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
$coreCurrent  = 'publishing';
$coreEyebrow  = 'Complete Support';
$coreTitle    = 'Complete book publishing services for authors <em class="serif-italic">that move books forward</em>';
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
                    <img src="<?= asset('images/CosttoPublishaBook-2048x1365.webp') ?>" alt="Transparent book publishing costs in Ireland" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Pricing</span>
                <h2 class="section-title">Transparent book publishing costs with <em class="serif-italic">no surprise add-ons</em></h2>
                <p>There is no single flat rate for publishing a book, because no two projects are the same. A short poetry collection needs far less work than a three hundred page business book with charts and references. Across publishing houses Ireland-wide, pricing varies a lot depending on scope, so we always start with a written quote based on your actual manuscript, word count, and the level of editing and design it needs. There are no hidden add-ons once that quote is agreed.</p>
                <a href="#popup" class="btn btn-cta btn-lg" data-popup>Get Your Free Quote <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<?php
$exclude_slug = 'publishing';
include __DIR__ . '/includes/books-portfolio.php';

/* ---- FAQs (from the brief) ---- */
$faqId    = 'irePubFaq';
$faqTitle = 'Frequently asked <em class="serif-italic">questions</em>';
$faqs = [
    ['q' => 'Do you only work with authors based in Dublin?',
     'a' => 'No. While many of our authors are based in Dublin, we work with writers across the whole country and support authors remotely, by phone, email, and video call.'],
    ['q' => 'Are you a book publisher near Ireland, or do you work with authors nationwide?',
     'a' => 'We are based in Ireland and work with authors nationwide, so location is never a barrier to getting started, whether you are in a city or a small town.'],
    ['q' => 'How long does it take to publish a book from start to finish?',
     'a' => 'It depends on the length and condition of your manuscript, but most projects take a few months from the first edit to a finished, printed book.'],
    ['q' => 'Do I need to have finished writing before I contact you?',
     'a' => 'No. Many authors reach out while they are still writing, just to understand the process and get a sense of timing and cost for later.'],
    ['q' => 'Can you help with a book that has already been printed elsewhere?',
     'a' => 'Yes. We can review an existing book, suggest improvements for a second edition, or help with ebook conversion and wider distribution.'],
    ['q' => 'Do you work with authors in Cork, Galway and other counties, not just the capital?',
     'a' => 'Yes. Most of our work happens by email and video call, so authors in Cork, Galway, Limerick and every other county get the same level of service.'],
    ['q' => 'What happens if I am not happy with the cover or layout design?',
     'a' => 'You review and approve every stage before we move forward, so changes happen during the design process itself, not after printing.'],
];
include __DIR__ . '/includes/location-faq.php';

/* ---- Closing CTA (brief: "Ready to Move Your Book Beyond the Manuscript Stage?") ---- */
$ctaEyebrow = 'Ready When You Are';
$ctaTitle   = 'Ready to move your book <em class="serif-italic">beyond the manuscript stage?</em>';
$ctaSub     = 'If you have a finished manuscript, a rough draft, or even just an idea you keep coming back to, we would like to hear about it. Send us a message, tell us where your book is at, and we will get back to you with honest, practical next steps, no pressure and no obligation to go any further. There is no cost to have that first conversation, and no script we are working from either, just a genuine chat about what your book needs.';
include __DIR__ . '/includes/final-cta.php';

/* ---- Structured data ---- */
$schemaCrumbs = [
    ['name' => 'Locations',        'url' => rtrim(BRAND_SITE_URL, '/') . '/locations/'],
    ['name' => 'Ireland',          'url' => location_abs($loc['hub'])],
    ['name' => 'Book Publishing',  'url' => $canonical_url],
];
$schemaService = [
    'name'        => 'Book Publishing Services in Ireland',
    'description' => $page_description,
    'url'         => $canonical_url,
    'serviceType' => 'Book publishing',
    'areaServed'  => 'Ireland',
];
include __DIR__ . '/includes/location-schema.php';

include __DIR__ . '/includes/footer.php';
