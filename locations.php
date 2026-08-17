<?php
/* =================================================================
   LOCATIONS HUB — /locations/

   A signpost page: one card per country we publish from, nothing more.
   Everything on it is driven by $SITE_LOCATIONS in
   includes/locations-data.php, so adding a country there surfaces it
   here automatically.
================================================================= */

require_once __DIR__ . '/includes/locations-data.php';

$page_title       = 'Book Publishing Locations | EU Publishing House';
$page_description = 'Find EU Publishing House in your country. Publishing, editing, ghostwriting, cover design, formatting and book marketing for authors in Ireland and across Europe.';
$page_keywords    = 'book publishing locations, book publishers Ireland, publishing services by country, EU Publishing House offices';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/locations/';

$locations = $SITE_LOCATIONS;

require __DIR__ . '/includes/header.php';

$hero = [
    'crumbs'     => [['label' => 'Locations']],
    'title'      => 'Book Publishing Services by <em class="serif-italic">Location</em>',
    'paragraphs' => [
        "Publishing works better when the people handling your book understand the readers it is written for. Spelling, tone, retailers, launch timing and even the questions authors ask all shift from one market to the next, so we work country by country rather than treating everywhere as one audience.",
        "Choose your location below to see the full list of services available there, who you will be dealing with, and how to get a written quote before any work starts.",
    ],
    'ctas' => [
        ['label' => 'Talk to Our Team', 'href' => '#popup',                'class' => 'btn-cta',   'popup'    => true],
        ['label' => 'Live Chat',        'href' => link_to('javascript:;'), 'class' => 'btn-glass', 'livechat' => true],
    ],
];
include __DIR__ . '/includes/service-hero.php';
include __DIR__ . '/includes/distributors.php';
?>

<!-- ============================================================
     LOCATION CARDS
     ============================================================ -->
<section class="section loc-hub-sec" id="locations">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Where We Work</span>
            <h2 class="section-title">Choose your <em class="serif-italic">country</em></h2>
            <p>Each location page lists every author service available there, the counties and cities we cover, and the team you will be speaking to.</p>
        </div>

        <div class="loc-hub-grid">
            <?php foreach ($locations as $key => $loc): ?>
                <article class="loc-hub-card" data-aos="fade-up">
                    <div class="loc-hub-card__head">
                        <span class="loc-hub-card__icon"><i class="fa-solid <?= safe($loc['icon']) ?>"></i></span>
                        <div>
                            <span class="loc-hub-card__badge"><?= safe($loc['badge']) ?></span>
                            <h3 class="loc-hub-card__name"><?= safe($loc['name']) ?></h3>
                            <span class="loc-hub-card__region"><?= safe($loc['region']) ?></span>
                        </div>
                    </div>

                    <p class="loc-hub-card__blurb"><?= safe($loc['blurb']) ?></p>

                    <ul class="loc-hub-card__services" role="list">
                        <?php foreach ($loc['services'] as $s): ?>
                            <li>
                                <a href="<?= safe(link_to($s['href'])) ?>" data-no-popup>
                                    <i class="fa-solid <?= safe($s['icon']) ?>"></i>
                                    <?= safe($s['label']) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <ul class="loc-hub-card__contact" role="list">
                        <li><i class="fa-solid fa-location-dot"></i><address><?= safe($loc['address']) ?></address></li>
                        <li><i class="fa-solid fa-phone"></i><a href="tel:<?= safe($loc['phone_raw']) ?>"><?= safe($loc['phone']) ?></a></li>
                        <li><i class="fa-solid fa-envelope"></i><a href="mailto:<?= safe($loc['email']) ?>"><?= safe($loc['email']) ?></a></li>
                    </ul>

                    <div class="loc-hub-card__actions">
                        <a href="<?= safe(location_url($key)) ?>" class="btn btn-cta" data-no-popup>
                            View <?= safe($loc['name']) ?> services <i class="fa-solid fa-arrow-right"></i>
                        </a>
                        <a href="tel:<?= safe($loc['phone_raw']) ?>" class="btn btn-glass" data-no-popup>
                            <i class="fa-solid fa-phone"></i> Call the office
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>

            <!-- Standing invitation for markets that don't have their own page yet. -->
            <article class="loc-hub-card loc-hub-card--soon" data-aos="fade-up" data-aos-delay="100">
                <div class="loc-hub-card__head">
                    <span class="loc-hub-card__icon"><i class="fa-solid fa-earth-europe"></i></span>
                    <div>
                        <span class="loc-hub-card__badge">Everywhere Else</span>
                        <h3 class="loc-hub-card__name">Rest of Europe &amp; Beyond</h3>
                        <span class="loc-hub-card__region">Remote, in English</span>
                    </div>
                </div>
                <p class="loc-hub-card__blurb">Not seeing your country yet? It makes no difference to how we work. Every service we offer is delivered by email, phone and video call, and we publish authors well outside the locations listed here. Tell us where you are and what your book needs.</p>
                <div class="loc-hub-card__actions">
                    <a href="#popup" class="btn btn-cta" data-popup>Get a Free Quote <i class="fa-solid fa-arrow-right"></i></a>
                    <a href="<?= link_to('contact.php') ?>" class="btn btn-glass" data-no-popup>Contact Us</a>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- ============================================================
     WHAT IS THE SAME EVERYWHERE
     ============================================================ -->
<section class="why-eph-sec loc-promise-sec" id="promise">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="why-eph-art">
                    <img src="<?= asset('images/BookPublishersAcrossEurope-2048x1754.webp') ?>" alt="EU Publishing House team supporting authors across Europe" loading="lazy" decoding="async">
                    <span class="why-eph-art__chip">Every location</span>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">What Never Changes</span>
                <h2 class="section-title">Same standards, <em class="serif-italic">wherever you write from</em></h2>
                <p>The local knowledge changes from country to country. The way we treat authors does not. Whichever location page you land on, these are the terms of working with us.</p>
                <ul class="genre-list mt-3" role="list">
                    <li><i class="fa-solid fa-check"></i>A written quote based on your actual manuscript before any work begins, with no add-ons appearing later</li>
                    <li><i class="fa-solid fa-check"></i>You keep the rights to your own book, along with your royalties and creative control</li>
                    <li><i class="fa-solid fa-check"></i>One point of contact from the first conversation through to launch, not a new name on every email</li>
                    <li><i class="fa-solid fa-check"></i>Honest advice, including when the answer is that your manuscript needs more work first</li>
                    <li><i class="fa-solid fa-check"></i>Nothing goes to print or goes live without your sign-off on the proof</li>
                </ul>
                <div class="mt-4">
                    <a href="<?= link_to('services.php') ?>" class="btn btn-cta" data-no-popup>Browse All Services <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$faqId    = 'locHubFaq';
$faqTitle = 'Questions about working with us <em class="serif-italic">from a distance</em>';
$faqs = [
    ['q' => 'Do I need to live near one of your offices to work with you?',
     'a' => "No. Our office is in Dublin, but editing, design, formatting and marketing are all handled by email, phone and video call. Most authors we publish never visit an office at any point in the process, and it makes no difference to the work or the timeline."],
    ['q' => 'Why do you have separate pages for each location?',
     'a' => "Because the details genuinely differ. Spelling and tone, which retailers matter most, printing options, launch timing and the questions authors ask all vary by market. A location page lets us answer those specifics properly instead of writing one vague page that half-fits everybody."],
    ['q' => 'Can you publish my book if my country is not listed here?',
     'a' => "Yes. The locations listed are the markets we know best and have dedicated pages for, not a limit on who we take on. We work with English-language authors well beyond them. Get in touch and tell us where you are based and where you want the book sold."],
    ['q' => 'Is the pricing the same across every location?',
     'a' => "Pricing is based on your manuscript, not your postcode. Word count, the level of editing needed, the design work involved and how many formats you need are what move the number. You always get a written, itemised quote before anything starts."],
    ['q' => 'Which location should I choose if I am an Irish author living abroad?',
     'a' => "Start with the Ireland page. If your book is written in Irish English and aimed mainly at Irish readers, that is the team and the market knowledge you want, regardless of where you happen to be living while you write it."],
];
include __DIR__ . '/includes/location-faq.php';

include __DIR__ . '/includes/final-cta.php';

/* ---- Structured data: breadcrumb + the list of location pages ---- */
$schemaCrumbs = [
    ['name' => 'Locations', 'url' => rtrim(BRAND_SITE_URL, '/') . '/locations/'],
];
include __DIR__ . '/includes/location-schema.php';

$_hubLd = [
    '@context'        => 'https://schema.org',
    '@type'           => 'CollectionPage',
    'name'            => $page_title,
    'description'     => $page_description,
    'url'             => $canonical_url,
    'isPartOf'        => ['@id' => rtrim(BRAND_SITE_URL, '/') . '/#website'],
    'about'           => ['@id' => rtrim(BRAND_SITE_URL, '/') . '/#organization'],
    'mainEntity'      => [
        '@type'           => 'ItemList',
        'itemListElement' => [],
    ],
];
$_pos = 1;
foreach ($locations as $key => $loc) {
    $_hubLd['mainEntity']['itemListElement'][] = [
        '@type'    => 'ListItem',
        'position' => $_pos++,
        'name'     => 'Book Publishing Services in ' . $loc['name'],
        'url'      => location_abs($loc['hub']),
    ];
}
?>
<script type="application/ld+json">
<?= json_encode($_hubLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>

</script>
<?php include __DIR__ . '/includes/footer.php'; ?>
