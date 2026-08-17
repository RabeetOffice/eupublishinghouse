<?php
/* =================================================================
   IRELAND LOCATION HUB — /book-publishing-services-in-ireland/

   Second level of the location structure: /locations/ points here, and
   this page fans out to the six Ireland service pages. The service list,
   counties and office details all come from includes/locations-data.php.
================================================================= */

require_once __DIR__ . '/includes/locations-data.php';

$loc     = location_get('ireland');
$locKey  = 'ireland';

$page_title       = 'Book Publishing Services in Ireland | EU Publishing House';
$page_description = 'Book publishing services in Ireland covering editing, ghostwriting, cover design, formatting and marketing. Dublin-based team working with authors in every county.';
$page_keywords    = 'book publishing services Ireland, book publishers Ireland, publishing company Ireland, author services Ireland, Dublin book publisher';
$canonical_url    = location_abs($loc['hub']);

require __DIR__ . '/includes/header.php';

$hero = [
    'crumbs' => [
        ['label' => 'Locations', 'href' => link_to('locations.php')],
        ['label' => 'Ireland'],
    ],
    'title'      => 'Book Publishing Services in <em class="serif-italic">Ireland</em>',
    'paragraphs' => [
        "Our office is on Windmill Lane in Dublin, and the authors we work with are spread right across the country, from first-time novelists in Cork to business owners in Galway turning years of experience into a book. Six services, one team, and the same person looking after your project from the first conversation to launch day.",
        "Everything below is available on its own or as part of a fuller package. Pick the service you need, or start with a conversation and we will tell you honestly what your manuscript actually requires before quoting for anything.",
    ],
    'ctas' => [
        ['label' => 'Get a Free Quote', 'href' => '#popup',   'class' => 'btn-cta',   'popup' => true],
        ['label' => 'See All Services', 'href' => '#services', 'class' => 'btn-glass'],
    ],
];
include __DIR__ . '/includes/service-hero.php';
include __DIR__ . '/includes/distributors.php';
?>

<!-- ============================================================
     THE SIX IRELAND SERVICE PAGES
     ============================================================ -->
<section class="services-section loc-services-sec" id="services">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Ireland Author Services</span>
            <h2 class="section-title">Every service we offer <em class="serif-italic">in Ireland</em></h2>
            <p>Each page below covers what the service includes, how the process runs, what it costs and the questions Irish authors ask most often.</p>
        </div>

        <div class="loc-service-grid">
            <?php foreach ($loc['services'] as $key => $s): ?>
                <a class="loc-service-card" href="<?= safe(link_to($s['href'])) ?>" data-aos="fade-up" data-no-popup>
                    <span class="loc-service-card__icon"><i class="fa-solid <?= safe($s['icon']) ?>"></i></span>
                    <h3 class="loc-service-card__title"><?= safe($s['title']) ?></h3>
                    <p class="loc-service-card__desc"><?= safe($s['card_desc']) ?></p>
                    <span class="loc-service-card__cta">
                        Read about <?= safe(strtolower($s['label'])) ?> <i class="fa-solid fa-arrow-right"></i>
                    </span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================================
     WHY IRELAND-SPECIFIC SUPPORT MATTERS
     ============================================================ -->
<section class="why-eph-sec" id="why-ireland">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="why-eph-art">
                    <img src="<?= asset('images/PublishingThatWorksfortheAuthor-1969x2048.webp') ?>" alt="Publishing support built around Irish authors" loading="lazy" decoding="async">
                    <span class="why-eph-art__chip">Ireland</span>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Why It Matters Locally</span>
                <h2 class="section-title">Publishing built around <em class="serif-italic">Irish authors and readers</em></h2>
                <p>Plenty of publishing services will take an Irish author's money and hand back a book edited to American spelling, laid out for a US trim size, and marketed at readers who will never see it. The writing might be fine. The finish tells a different story.</p>
                <p>We work in Irish English by default, we know which retailers and bookshops actually matter here, and we understand how a launch runs in a country this size, where a local event and a bit of press can do more than a big paid campaign. That local knowledge is the reason this page exists separately from our main service pages.</p>
                <ul class="genre-list mt-3" role="list">
                    <li><i class="fa-solid fa-check"></i>Irish spelling, grammar and tone as standard, not an American default</li>
                    <li><i class="fa-solid fa-check"></i>Print runs sized for a real launch, so you are not left with boxes of unsold stock</li>
                    <li><i class="fa-solid fa-check"></i>ISBNs, listings and distribution set up for the retailers Irish readers actually use</li>
                    <li><i class="fa-solid fa-check"></i>A Dublin phone number and a real person on the end of it</li>
                </ul>
                <div class="mt-4">
                    <a href="#popup" class="btn btn-cta" data-popup>Start Your Book <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     OFFICE + COUNTIES
     ============================================================ -->
<section class="section loc-office-sec" id="office">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Getting In Touch</span>
            <h2 class="section-title">Our <em class="serif-italic">Dublin</em> desk</h2>
            <p>Call, email or send the manuscript over. Everything after that can happen remotely, wherever in the country you are writing from.</p>
        </div>

        <div class="loc-office-grid">
            <div class="loc-office-card" data-aos="fade-up">
                <h3><i class="fa-solid fa-building"></i> <?= safe(BRAND_NAME) ?> &mdash; <?= safe($loc['name']) ?></h3>
                <ul role="list">
                    <li>
                        <i class="fa-solid fa-location-dot"></i>
                        <a href="<?= safe($loc['map_url']) ?>" target="_blank" rel="noopener noreferrer"><?= safe($loc['address']) ?></a>
                    </li>
                    <li><i class="fa-solid fa-phone"></i><a href="tel:<?= safe($loc['phone_raw']) ?>"><?= safe($loc['phone']) ?></a></li>
                    <li><i class="fa-solid fa-envelope"></i><a href="mailto:<?= safe($loc['email']) ?>"><?= safe($loc['email']) ?></a></li>
                    <li><i class="fa-solid fa-clock"></i><span>Monday to Friday, 9am – 6pm</span></li>
                </ul>
                <div class="loc-office-card__actions">
                    <a href="tel:<?= safe($loc['phone_raw']) ?>" class="btn btn-cta" data-no-popup><i class="fa-solid fa-phone"></i> Call the office</a>
                    <a href="<?= link_to('contact.php') ?>" class="btn btn-glass" data-no-popup>Contact form</a>
                </div>
            </div>

            <div class="loc-counties-card" data-aos="fade-up" data-aos-delay="100">
                <h3><i class="fa-solid fa-map"></i> Counties we work with</h3>
                <p>All of our editing, design, formatting and marketing work is handled remotely, so authors outside the cities get exactly the same service and the same editor.</p>
                <ul class="loc-county-list" role="list">
                    <?php foreach ($loc['counties'] as $county): ?>
                        <li><i class="fa-solid fa-location-dot"></i><?= safe($county) ?></li>
                    <?php endforeach; ?>
                    <li class="is-more"><i class="fa-solid fa-plus"></i>Every other county</li>
                </ul>
                <div class="loc-stat-row">
                    <?php foreach ($loc['stats'] as $st): ?>
                        <div class="loc-stat">
                            <span class="loc-stat__n"><?= safe($st['n']) ?></span>
                            <span class="loc-stat__l"><?= safe($st['l']) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
/* ---- Shared process block, reworded for the location cluster ---- */
$processEyebrow = 'How It Runs';
$processTitle   = 'From manuscript to <em class="serif-italic">finished book</em>';
$processIntro   = 'The same five steps whichever service you start with, and nothing moves forward without your sign-off.';
$processSteps   = [
    ['n' => '01', 'title' => 'A free chat about your book',
        'desc' => "Send the manuscript, a few chapters, or just an outline. We will talk through where it stands, what it realistically needs, and roughly what that involves in time and cost. No pitch, no obligation."],
    ['n' => '02', 'title' => 'A written, itemised quote',
        'desc' => "Once we understand the scope, you get the price and the timeline in writing, based on your actual word count and the work involved. Nothing is added to it later."],
    ['n' => '03', 'title' => 'The work itself',
        'desc' => "Editing, design, formatting, or whichever services you have chosen. You see drafts and tracked changes as we go, with the same person on your project throughout, rather than one big reveal at the end."],
    ['n' => '04', 'title' => 'Your review and sign-off',
        'desc' => "You get a proof to check, whether that is a physical copy, a print-ready PDF or an ebook file on a real device. Nothing goes to a print run or a store listing until you have approved it."],
    ['n' => '05', 'title' => 'Launch and afterwards',
        'desc' => "We help with listings, ISBNs and launch planning, and we stay reachable afterwards for reprints, a second edition, or advice further down the line."],
];
include __DIR__ . '/includes/process.php';

/* ---- Shared six-service block (cross-links the whole cluster) ---- */
$coreLocation = $locKey;
$coreCurrent  = null;
$coreEyebrow  = 'Complete Support';
$coreTitle    = 'Complete book publishing services for <em class="serif-italic">Irish authors</em>';
include __DIR__ . '/includes/location-core-services.php';

$exclude_slug = 'publishing';
include __DIR__ . '/includes/books-portfolio.php';

/* ---- FAQs ---- */
$faqId    = 'irelandHubFaq';
$faqTitle = 'Common questions from <em class="serif-italic">Irish authors</em>';
$faqs = [
    ['q' => 'Do you only work with authors based in Dublin?',
     'a' => "No. The office is in Dublin, but our authors are spread across the whole country. Everything is handled by phone, email and video call, so writers in Cork, Galway, Limerick or a small village get the same service and the same editor as someone around the corner from us."],
    ['q' => 'Can I use just one service, or do I have to take a full package?',
     'a' => "One service is completely fine. Plenty of authors come to us only for editing, or only for a cover, and that is how it stays. If you would rather have the whole thing handled end to end, we can do that too, but nothing is bundled in without you asking for it."],
    ['q' => 'How much does it cost to publish a book in Ireland?',
     'a' => "There is no single flat rate, because a short poetry collection and a three hundred page business book with charts and references are completely different jobs. We quote in writing against your actual manuscript, word count and the level of editing and design it needs, and that quote does not change afterwards."],
    ['q' => 'Do I keep the rights to my book?',
     'a' => "Yes. We do not ask authors to sign away ownership of their own work. The rights, the royalties and the creative control stay with you, which is the main difference between working with us and signing a traditional contract."],
    ['q' => 'How long does the whole process take?',
     'a' => "It depends on the length and condition of the manuscript, but most projects run a few months from the first edit to a finished, printed book. Single services are much quicker — a proofread or a cover can often be turned around in a couple of weeks."],
    ['q' => 'Do you print in Ireland?',
     'a' => "We arrange printing to suit the project, including short runs for a launch event and larger runs once you know what demand looks like. Every proof copy is checked on our side before it reaches you, so mistakes get caught before hundreds of copies exist."],
    ['q' => 'What if my manuscript is not finished yet?',
     'a' => "Get in touch anyway. A lot of authors contact us mid-draft just to understand the process, the likely cost and the timing. Knowing what happens after the writing often makes it easier to finish the writing."],
];
include __DIR__ . '/includes/location-faq.php';

/* ---- CTA ---- */
$ctaEyebrow = 'Ready When You Are';
$ctaTitle   = "Let's talk about your book, <em class=\"serif-italic\">wherever you are in Ireland</em>";
$ctaSub     = "Send us the manuscript, a draft, or just the idea you keep coming back to. We will read it, tell you honestly what it needs, and give you a clear quote with no pressure attached to it.";
include __DIR__ . '/includes/final-cta.php';

/* ---- Structured data ---- */
$schemaCrumbs = [
    ['name' => 'Locations', 'url' => rtrim(BRAND_SITE_URL, '/') . '/locations/'],
    ['name' => 'Ireland',   'url' => $canonical_url],
];
$schemaService = [
    'name'        => 'Book Publishing Services in Ireland',
    'description' => $page_description,
    'url'         => $canonical_url,
    'serviceType' => 'Book publishing',
    'areaServed'  => 'Ireland',
];
include __DIR__ . '/includes/location-schema.php';

/* An ItemList of the six service pages helps Google understand this page
   as the parent of the Ireland cluster rather than a seventh sibling. */
$_ldItems = [];
$_pos = 1;
foreach ($loc['services'] as $s) {
    $_ldItems[] = [
        '@type'    => 'ListItem',
        'position' => $_pos++,
        'name'     => $s['title'],
        'url'      => location_abs($s['href']),
    ];
}
$_pageLd = [
    '@context'    => 'https://schema.org',
    '@type'       => 'CollectionPage',
    'name'        => $page_title,
    'description' => $page_description,
    'url'         => $canonical_url,
    'isPartOf'    => ['@id' => rtrim(BRAND_SITE_URL, '/') . '/#website'],
    'mainEntity'  => ['@type' => 'ItemList', 'itemListElement' => $_ldItems],
];
?>
<script type="application/ld+json">
<?= json_encode($_pageLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>

</script>
<?php include __DIR__ . '/includes/footer.php'; ?>
