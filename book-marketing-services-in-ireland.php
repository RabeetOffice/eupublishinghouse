<?php
/* =================================================================
   /book-marketing-services-in-ireland/
   Ireland location cluster — marketing. Copy from the content brief
   "Book Marketing Services Ireland | Reach More Readers".
================================================================= */

require_once __DIR__ . '/includes/locations-data.php';

$locKey = 'ireland';
$loc    = location_get($locKey);
$svc    = $loc['services']['marketing'];

$page_title       = 'Book Marketing Services Ireland to Boost Your Sales';
$page_description = 'Get expert book marketing services Ireland authors trust to build visibility, reach engaged readers, and turn book launches into lasting sales success.';
$page_keywords    = 'book marketing services Ireland, Amazon book marketing Ireland, book launch Ireland, self publishing marketing Ireland, book promotion Ireland';
$canonical_url    = location_abs($svc['href']);

require __DIR__ . '/includes/header.php';

$hero = [
    'crumbs' => [
        ['label' => 'Locations', 'href' => link_to('locations.php')],
        ['label' => 'Ireland',   'href' => location_url($locKey)],
        ['label' => 'Book Marketing'],
    ],
    'title'      => 'Book Marketing Services Ireland Designed to <em class="serif-italic">Boost Your Book Sales</em>',
    'paragraphs' => [
        "Writing a book is hard work. Getting people to buy it is a different job entirely, and it is one most authors never get taught. If you have spent months, maybe years, on a manuscript and it is now sitting online with barely any sales, you are not alone. This happens to good books all the time, not because the writing is weak, but because nobody told readers the book exists.",
        "At EU Publishing House, we work with authors across Ireland who want their books to find readers. We are not a shortcut factory promising overnight bestseller status. We look at your book, your genre, and your goals, and we build a plan around that. Our approach to promoting and selling books is built for real authors with real budgets, not just big publishing houses with unlimited spend. Whether you have self-published through Amazon, gone with a small press, or are still deciding how to launch, we can help you get the word out.",
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
     MARKETING SERVICES
     ============================================================ -->
<section class="services-section" id="marketing-services">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">What We Actually Do</span>
            <h2 class="section-title">Where strategic book marketing turns attention <em class="serif-italic">into reader action</em></h2>
            <p>Book marketing is a broad term, so let us be specific. We help authors plan, launch, and grow the visibility of their books using a mix of proven tactics. No guesswork, no vague promises, just practical steps that move the needle.</p>
        </div>

        <div class="services-grid">
            <?php
            $services = [
                ['fa-a', 'Amazon Strategy And Optimisation',
                 'Amazon is where most Irish readers browse and buy books, so this is often where we start. We look at your book listing, your keywords, your categories, and your description, and we tighten all of it up. Small changes here can make a real difference to how often your book gets found. Our digital marketing book Amazon in Ireland work covers everything from keyword research to category placement, so your book is sitting in front of the right readers rather than getting lost in the noise.'],
                ['fa-rocket', 'Self Publishing Launch Support',
                 'If you are going it alone, launch week matters more than most authors realise. We help plan the run-up to publication, from pre-order pages to review requests to timing your release for the best chance of visibility. Our self-publishing book marketing Amazon in Ireland service is built specifically for independent authors who do not have a publisher’s marketing team behind them.'],
                ['fa-share-nodes', 'Social Media And Content Promotion',
                 'We build simple, honest content plans for social platforms that suit your genre and audience. This is not about posting for the sake of it. It is about creating content that makes readers curious enough to click through and buy.'],
                ['fa-envelope-open-text', 'Email And Reader List Building',
                 'If you plan to write more than one book, your reader list is one of the most valuable things you can build. We help set up simple systems to capture reader interest and keep them updated when your next book is ready.'],
                ['fa-trophy', 'Bestseller Campaign Planning',
                 'For authors with a specific launch goal, such as hitting a category chart, we plan a bestseller book marketing campaign in Ireland around a single, focused release window. This takes careful timing, coordinated promotion, and realistic targets, and we walk you through exactly what is involved before you commit to anything.'],
                ['fa-star', 'Reviews And Reader Feedback',
                 'Reviews carry a lot of weight with new readers, and with Amazon’s own systems too. We help authors put together an honest, above-board plan for gathering reviews, such as reaching out to advance readers or existing fans, rather than anything that risks breaking Amazon’s rules.'],
                ['fa-bullseye', 'Advertising Support',
                 'For authors ready to spend a little on paid promotion, we can advise on running simple, targeted ads, whether that is on Amazon itself or on social platforms. We keep this straightforward and focused on your budget, rather than pushing you toward spending more than makes sense for your book.'],
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
     WHO WE WORK WITH
     ============================================================ -->
<section class="section loc-audience-sec" id="who-we-help">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Who We Work With</span>
            <h2 class="section-title">Book marketing built for Irish authors <em class="serif-italic">at every growth stage</em></h2>
            <p>We work with a wide range of authors, including:</p>
        </div>

        <div class="loc-audience-grid">
            <?php
            $audience = [
                ['fa-book-open',      'First-time authors publishing their debut book'],
                ['fa-chart-line',     'Self-published writers on Amazon looking to improve slow sales'],
                ['fa-building-columns','Small press authors who want extra marketing support'],
                ['fa-boxes-stacked',  'Authors with a backlist who want to relaunch older titles'],
                ['fa-briefcase',      'Nonfiction writers, including business and memoir authors'],
                ['fa-masks-theater',  'Fiction authors across most genres, from romance to thrillers'],
            ];
            foreach ($audience as $i => $a): ?>
                <div class="loc-audience-item" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 70 ?>">
                    <i class="fa-solid <?= $a[0] ?>"></i>
                    <span><?= $a[1] ?></span>
                </div>
            <?php endforeach; ?>
        </div>

        <p class="loc-note" data-aos="fade-up">If you are unsure whether your book fits, get in touch and tell us about it. We will give you an honest answer, even if that answer is that marketing alone will not fix a deeper issue like cover design or formatting. We also hear from authors who tried a bit of marketing themselves first, maybe a few social posts or a paid ad they set up on their own, and did not see much come from it. That is common. Marketing a book takes a joined-up plan rather than one-off actions, and that is usually the gap we help fill.</p>
    </div>
</section>

<!-- ============================================================
     HOW TO CHOOSE
     ============================================================ -->
<section class="section loc-check-sec" id="how-to-choose">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Before You Hire Anyone</span>
            <h2 class="section-title">How to choose a book marketing company <em class="serif-italic">in Ireland</em></h2>
            <p>There are a lot of people online offering book marketing services, and not all of them are worth your money. Before you hire anyone, including us, ask these questions:</p>
        </div>

        <div class="loc-check-grid">
            <?php
            $questions = [
                'Can they explain exactly what tasks they will do for your fee, in plain language?',
                'Do they promise guaranteed sales numbers or bestseller status? If so, be cautious, because nobody can honestly guarantee that.',
                'Will they give you a realistic timeline, or do they promise instant results?',
                'Do they understand your specific genre and its readers?',
                'Can they show you real examples of the type of work they do, not just vague testimonials?',
                'Are they upfront about pricing, or do they hide costs until later?',
            ];
            foreach ($questions as $i => $q): ?>
                <div class="loc-check-card" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 70 ?>">
                    <span class="loc-check-card__n"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                    <p><?= $q ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <p class="loc-note" data-aos="fade-up">Any of the best book marketing companies in Ireland should be happy to answer these questions clearly and without pressure. If a company avoids straight answers, take that as a warning sign. It is also worth asking how a company measures success. Sales numbers matter, but so do things like review counts, ranking movement, and reader engagement. A company that only talks about vanity metrics, such as follower counts with no link to actual sales, is not necessarily helping your book in a meaningful way.</p>
    </div>
</section>

<!-- ============================================================
     WHY MARKETING MATTERS
     ============================================================ -->
<section class="section section-mint loc-benefit-sec" id="why-it-matters">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Why It Matters</span>
            <h2 class="section-title">Why Ireland strong book marketing changes discovery, <em class="serif-italic">trust and sales</em></h2>
            <p>A book without marketing is a book that relies entirely on luck. Here is what proper marketing actually changes:</p>
        </div>

        <div class="loc-benefit-grid">
            <?php
            $benefits = [
                ['fa-eye',           'Visibility',        'Readers cannot buy a book they never see. Marketing puts your book in front of people actively searching for something like it.'],
                ['fa-shield-halved', 'Trust',             'A well-presented listing, with a strong description and the right categories, tells a reader this is a professionally produced book worth their money.'],
                ['fa-arrow-trend-up','Momentum',          'Early sales and reviews feed Amazon’s own algorithm, which can lead to more organic visibility over time.'],
                ['fa-infinity',      'Longevity',         'A book with an ongoing, light touch marketing plan tends to keep selling steadily, rather than spiking once and disappearing.'],
                ['fa-face-smile',    'Author confidence', 'Knowing your book has a proper plan behind it takes pressure off you, so you can focus on writing the next one.'],
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
/* ---- Process ---- */
$processEyebrow = 'Strategy to Visibility';
$processTitle   = 'Your book marketing <em class="serif-italic">journey</em>';
$processIntro   = 'Five stages, and you will hear from us throughout rather than only at the start and the end.';
$processSteps   = [
    ['n' => '01', 'title' => 'We talk about your book',
        'desc' => 'We start with a conversation about your book, your genre, your goals, and your budget. This is not a sales pitch. It is us understanding what you actually need before we suggest anything.'],
    ['n' => '02', 'title' => 'We build a plan',
        'desc' => 'Based on that conversation, we put together a marketing plan tailored to your book. This might be a single service, like Amazon optimisation, or a fuller campaign combining several elements. You will see exactly what is included before you agree to anything.'],
    ['n' => '03', 'title' => 'We get to work',
        'desc' => 'Once you approve the plan, we get started. Depending on the scope, this could involve rewriting your book description, researching keywords, building a social content calendar, or organising a launch timeline.'],
    ['n' => '04', 'title' => 'We keep you updated',
        'desc' => 'You will hear from us regularly throughout the process, not just at the start and end. If something is not working as expected, we will tell you and adjust the plan rather than staying quiet about it.'],
    ['n' => '05', 'title' => 'We review and adjust',
        'desc' => 'Marketing is not a one-off task. After the initial push, we look at what worked, what did not, and whether any ongoing support makes sense for your book going forward.'],
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
                    <img src="<?= asset('images/MostBooksDon-2048x1835.webp') ?>" alt="Why Irish authors choose EU Publishing House for book marketing" loading="lazy" decoding="async">
                    <span class="why-eph-art__chip">Marketing</span>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Why Authors Choose Us</span>
                <h2 class="section-title">Why Irish authors choose <em class="serif-italic">EU Publishing House</em></h2>
                <ul class="loc-diff-list" role="list">
                    <li><i class="fa-solid fa-check"></i><span><strong>Straight-talking advice.</strong> We tell you what your book actually needs, even if that is less than you expected to spend.</span></li>
                    <li><i class="fa-solid fa-check"></i><span><strong>Genre-aware planning.</strong> We take the time to understand your readers, not just your book’s category label.</span></li>
                    <li><i class="fa-solid fa-check"></i><span><strong>Fair, upfront pricing.</strong> You will know the cost before we start, with no hidden extras added later.</span></li>
                    <li><i class="fa-solid fa-check"></i><span><strong>Experience with Irish and wider European authors.</strong> We understand the local market as well as the wider English language book market.</span></li>
                    <li><i class="fa-solid fa-check"></i><span><strong>No guaranteed bestseller nonsense.</strong> We will not promise you numbers we cannot deliver, because that kind of promise usually ends badly for the author.</span></li>
                    <li><i class="fa-solid fa-check"></i><span><strong>A team that answers your questions.</strong> You will always be able to reach someone who knows your book and your plan.</span></li>
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
$coreCurrent  = 'marketing';
$coreEyebrow  = 'Complete Support';
$coreTitle    = 'Complete book publishing services for authors that strengthen <em class="serif-italic">every reader touchpoint</em>';
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
                    <img src="<?= asset('images/PublishingThatWorksfortheAuthor-1969x2048.webp') ?>" alt="What book marketing costs in Ireland" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Pricing</span>
                <h2 class="section-title">What does book marketing <em class="serif-italic">cost in Ireland</em></h2>
                <p>Every book is different, so we do not offer one flat rate for everyone. The right plan depends on your genre, your goals, and how much support you already have in place. We are happy to talk through affordable book marketing services in Ireland options that suit smaller budgets, as well as fuller campaigns for authors who want a bigger push. After our first conversation, we will give you a clear quote with no vague add-ons hidden in the small print.</p>
                <p>If your budget is tight, tell us that up front. We would rather suggest one or two things that will genuinely help than sell you a large package you do not need. Some authors only need help with their Amazon listing and description. Others want a fuller campaign covering several months. Both are valid starting points, and we will not push you toward spending more than makes sense for your book right now.</p>
                <a href="#popup" class="btn btn-cta btn-lg" data-popup>Get Your Free Quote <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<?php
$exclude_slug = 'marketing';
include __DIR__ . '/includes/books-portfolio.php';

/* ---- FAQs ---- */
$faqId    = 'ireMarketFaq';
$faqTitle = 'Frequently asked <em class="serif-italic">questions</em>';
$faqs = [
    ['q' => 'Do you work with authors outside of Dublin?',
     'a' => 'Yes. We work with authors right across Ireland, not just in the capital. Most of our work happens online, so your location does not limit what we can do together.'],
    ['q' => 'Can you guarantee my book will become a bestseller?',
     'a' => 'No, and you should be careful of anyone who tells you they can. What we can promise is a clear, honest plan and real effort behind your book’s visibility, particularly through a well-planned Amazon book marketing services in Ireland approach.'],
    ['q' => 'How long does a typical marketing campaign take?',
     'a' => 'It depends on the scope. A focused launch campaign might run for a few weeks around publication, while ongoing visibility work can continue for months. We will map this out with you before starting.'],
    ['q' => 'I already published my book months ago. Is it too late to market it?',
     'a' => 'Not at all. Many of our clients come to us after a quiet launch, looking to relaunch or refresh their book’s marketing. It is never too late to improve a listing or start a new push.'],
    ['q' => 'What is the best book marketing agency in Ireland for a first-time author?',
     'a' => 'That depends on your book and your budget, and we would say the same about any company, including ours. Look for a team that explains things clearly, does not overpromise, and takes time to understand your specific book rather than offering a one-size-fits-all package.'],
    ['q' => 'Do you only work on Amazon marketing, or other platforms too?',
     'a' => 'Amazon is a big part of what we do, since that is where most readers in Ireland shop for books, but we also support social media promotion, email list building, and wider campaign planning depending on what suits your book.'],
    ['q' => 'How do I get started?',
     'a' => 'Just reach out through our contact page with a short description of your book and what you are hoping to achieve. We will get back to you and set up a time to talk it through properly.'],
];
include __DIR__ . '/includes/location-faq.php';

/* ---- Closing CTA ---- */
$ctaEyebrow = 'Ready When You Are';
$ctaTitle   = 'Ready to put your book <em class="serif-italic">where readers are looking?</em>';
$ctaSub     = 'If your book deserves more readers than it is currently getting, we would like to help. Get in touch with EU Publishing House and tell us a bit about your book. We will have an honest conversation about what marketing could realistically do for you, with no pressure to sign up for anything you do not need.';
include __DIR__ . '/includes/final-cta.php';

/* ---- Structured data ---- */
$schemaCrumbs = [
    ['name' => 'Locations',      'url' => rtrim(BRAND_SITE_URL, '/') . '/locations/'],
    ['name' => 'Ireland',        'url' => location_abs($loc['hub'])],
    ['name' => 'Book Marketing', 'url' => $canonical_url],
];
$schemaService = [
    'name'        => 'Book Marketing Services in Ireland',
    'description' => $page_description,
    'url'         => $canonical_url,
    'serviceType' => 'Book marketing',
    'areaServed'  => 'Ireland',
];
include __DIR__ . '/includes/location-schema.php';

include __DIR__ . '/includes/footer.php';
