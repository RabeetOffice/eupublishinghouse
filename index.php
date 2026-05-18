<?php
/**
 * EU Publishing House — Homepage
 * Self-contained: every section is inlined here. Only header & footer are included.
 */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/portfolio-data.php';

$page_title       = BRAND_NAME . ' — Expert Book Publishers in Europe, Built for Authors Who Mean It';
$page_description = 'European Publishing House is a hybrid publisher in Dublin handling editing, ghostwriting, cover design, formatting, marketing and global distribution. Over 800 books published since 2021.';
$page_keywords    = 'book publishing Europe, hybrid publisher Ireland, book editing, ghostwriting, cover design, book marketing, publish a book Europe';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/';

/* =====================================================
   DATA — every section's data prepared up front
   ===================================================== */

// Hero — use the dynamic portfolio (with Amazon links) as the single source of truth
$heroBooks  = $portfolioItems;
$sideBooks  = array_slice($portfolioItems, 0, 2);
if (count($sideBooks) < 2) $sideBooks = array_pad($sideBooks, 2, $portfolioItems[0] ?? null);

// Stats
$stats = [
    ['icon' => 'fa-book',    'count' => 800, 'suffix' => '+', 'label' => 'Books Published',  'note' => 'Across every genre & specialism'],
    ['icon' => 'fa-globe',   'count' => 25,  'suffix' => '+', 'label' => 'Countries Reached', 'note' => 'A truly global readership'],
    ['icon' => 'fa-star',    'count' => 4.9, 'suffix' => '',  'label' => 'Author Rating',     'note' => 'From verified author reviews'],
    ['icon' => 'fa-feather', 'count' => 150, 'suffix' => '+', 'label' => 'Authors Published', 'note' => 'Debut to international bestseller'],
];

// Genres
$genres = [
    ['tag' => 'Fiction',     'title' => 'Literary &<br>Genre Fiction',          'desc' => 'Novels that linger long after the last page — from quiet literary studies to commercial thrillers and romance.',
        'list' => ['Literary Fiction', 'Mystery & Thriller', 'Romance', 'Fantasy & Sci-Fi'], 'art' => 'fiction'],
    ['tag' => 'Non-Fiction', 'title' => 'Memoir, Business<br>& Self-Discovery', 'desc' => 'Stories rooted in real life — designed to inspire, inform and challenge a discerning readership.',
        'list' => ['Memoir & Biography', 'Business & Leadership', 'Self-Improvement', 'History & Culture'], 'art' => 'nonfiction'],
    ['tag' => 'Specialist',  'title' => 'Children, Poetry<br>& Academic',       'desc' => 'Specialist imprints crafted with the same care as our flagship list — for younger readers and scholarly audiences.',
        'list' => ['Children & YA', 'Poetry & Essays', 'Academic & Reference', 'Coffee-Table Editions'], 'art' => 'specialist'],
];

// Portfolio slider
$sliderCovers = getBookCovers(['limit' => 24, 'offset' => 4]);
if (empty($sliderCovers)) $sliderCovers = getBookCovers(['limit' => 24]);

// Process
// ---- Live-site content data ----

$trustBadges = [
    ['src' => 'assets/images/livesite/ebark.png',           'alt' => 'eBark Trusted'],
    ['src' => 'assets/images/livesite/trusted2.png',        'alt' => 'Trustpilot'],
    ['src' => 'assets/images/livesite/google-partners.jpg', 'alt' => 'Google Partner'],
    ['src' => 'assets/images/livesite/review-io.png',       'alt' => 'Reviews.io'],
];

// Genres (live site copy)
$genres = [
    [
        'tag'  => 'Fiction',
        'art'  => 'fiction',
        'list' => [
            'Literary & Contemporary Fiction',
            'Romance & Romantic Suspense',
            'Mystery, Thriller & Crime',
            'Science Fiction & Fantasy',
            'Historical Fiction',
            'Horror & Supernatural',
            "Young Adult & Children's Books",
        ],
    ],
    [
        'tag'  => 'Non-Fiction',
        'art'  => 'nonfiction',
        'list' => [
            'Business & Entrepreneurship',
            'Memoirs & Autobiographies',
            'Self-Help & Personal Development',
            'Health & Wellness',
            'True Crime',
            'Religion & Spirituality',
            'Travel Writing',
        ],
    ],
    [
        'tag'  => 'Specialist',
        'art'  => 'specialist',
        'list' => [
            'Academic & Educational',
            'Poetry Collections',
            'Biography & History',
            'How-To & Instructional Guides',
            'Art & Photography Books',
        ],
    ],
];

// Top Categories — six icon cards
$topCategories = [
    ['icon' => 'fa-user-pen',         'label' => 'Memoirs & Autobiographies'],
    ['icon' => 'fa-briefcase',        'label' => 'Business and Leadership'],
    ['icon' => 'fa-seedling',         'label' => 'Self-Help'],
    ['icon' => 'fa-book-open',        'label' => 'Fiction'],
    ['icon' => 'fa-children',         'label' => "Children's Book"],
    ['icon' => 'fa-heart-pulse',      'label' => 'Health and Lifestyle'],
];

// Process (live site)
$steps = [
    ['n' => '01', 'icon' => 'fa-comments',  'title' => 'Free Consultation & Manuscript Review', 'desc' => "Send us your manuscript and we'll take a proper look. We'll talk through your goals, what your book needs, realistic timelines, and put together a publishing plan that fits your budget. No pressure, no sales pitch, just a straight conversation."],
    ['n' => '02', 'icon' => 'fa-pen-nib',   'title' => 'Professional Editing',                  'desc' => "Our editors go through your manuscript thoroughly. Depending on what stage you're at, that might mean developmental editing for structure and pacing, copy editing for grammar and consistency, or proofreading before the final files go to print. You'll see every change tracked and explained."],
    ['n' => '03', 'icon' => 'fa-palette',   'title' => 'Custom Cover Design',                   'desc' => "We design covers that stop readers mid-scroll. You'll get multiple concepts to choose from, as many revisions as needed, and final files sized and optimised for every platform your book will sell on. No templates, no stock cover designs, something made for your book specifically."],
    ['n' => '04', 'icon' => 'fa-align-left','title' => 'Formatting',                            'desc' => "We format your book for eBook and print, making sure it reads cleanly on every device and meets every retailer's technical requirements. Proper chapter breaks, clickable contents, correct margins, everything that makes the difference between a professional-looking book and an amateur one."],
];

// Services (live site)
$services = [
    ['icon' => 'fa-book',           'title' => 'Book Publishing',     'desc' => "We publish your book across every major platform, Amazon Kindle, Apple Books, Google Play, Kobo, Barnes & Noble, and 150+ retailers worldwide. We handle the entire process from file submission to going live, including ISBN registration, metadata setup, and platform-specific requirements. You keep your rights. You keep your royalties."],
    ['icon' => 'fa-pen-fancy',      'title' => 'Book Editing',        'desc' => "Good editing isn't one thing, it depends on where your manuscript is. We offer developmental editing for books that need structural and narrative work, copy editing for grammar, consistency, and clarity, and line editing for sentence-level flow and voice. A lot of manuscripts need more than one pass, and we'll tell you honestly which type of editing yours needs before we quote you anything."],
    ['icon' => 'fa-feather',        'title' => 'Ghostwriting Services','desc' => "If the ideas are there but the words aren't coming, our ghostwriters can write the whole thing for you. Fiction, literary fiction, romance, thrillers, fantasy, memoirs, business books, self-help, every genre, every tone. You brief us, we write it, you own it entirely. Complete confidentiality, always."],
    ['icon' => 'fa-palette',        'title' => 'Book Cover Design',   'desc' => "We design covers across every category, fiction, non-fiction, children's books, illustrated titles, series, and everything in between. That includes front covers, full print wraparounds, spine design, back cover copy layout, and interior illustrations where the book calls for it. You get multiple concepts to choose from and revisions until it's right."],
    ['icon' => 'fa-align-left',     'title' => 'Book Formatting',     'desc' => "We format your manuscript into every format it needs to be published in, PDF for print, ePub for Apple Books and Kobo, MOBI for Kindle, and any other format your chosen platforms require. Clean layouts, proper chapter breaks, correct margins, and files that pass every retailer's technical review first time."],
    ['icon' => 'fa-bullhorn',       'title' => 'Book Marketing',      'desc' => "Publishing is only half the job. We build marketing around your specific book, Amazon listing optimisation, social media campaigns, email marketing, book launch planning, paid advertising, and review outreach. Every strategy is built around getting your book in front of the readers who are actually looking for it."],
    ['icon' => 'fa-headphones',     'title' => 'Audiobook Production', 'desc' => "Professional audiobook narration, recording and mastering. We match the right voice to your book, handle every production detail, and deliver files ready for Audible, Apple Books, and every audiobook retailer worldwide."],
];

// Achievements (live site labels)
$awards = [
    ['n' => 4.9, 'suffix' => '',  'label' => 'Average Rating on Google'],
    ['n' => 800, 'suffix' => '+', 'label' => 'Authors Published'],
    ['n' => 25,  'suffix' => 'k+','label' => 'Community Members'],
    ['n' => 35,  'suffix' => '+', 'label' => 'Countries Published In'],
];

// Distribution platforms (live site)
$distPlatforms = [
    'Amazon Kindle (UK, EU, US, Canada, Australia, Germany, France, Spain, Italy, Japan, and more)',
    'Apple Books (170+ countries)',
    'Google Play Books (75+ countries)',
    'Kobo (190+ countries)',
    'Barnes & Noble',
    'Scribd',
    'OverDrive (library distribution)',
    '150+ additional retailers worldwide',
];
$distFormats = [
    'Kindle eBooks',
    'ePub (Apple Books, Kobo, Google Play)',
    'Print-on-demand paperbacks',
    'Print-on-demand hardcovers',
    'Large print editions',
];

// FAQ (live site)
$faqs = [
    ['q' => 'Who owns European Publishing House?',                       'a' => "European Publishing House is an independent publishing company founded in 2021. We're not affiliated with any of the Big 5 publishers, we operate independently, which means we can offer authors faster turnaround, more flexibility, and a direct working relationship with our team."],
    ['q' => 'What is the average cost to publish a book in Europe?',     'a' => "Publishing costs in Europe vary quite a bit depending on what your book needs. A basic self-publishing package might start from a few hundred pounds or euros, while a full-service package covering editing, cover design, formatting, and distribution can run into the thousands. The honest answer is that pricing depends on your manuscript's length, genre, current state, and which services you need. We build a custom quote for every author after a free consultation."],
    ['q' => 'How much does it cost to make 1,000 copies of a book in Europe?', 'a' => "Print-on-demand means you don't have to order 1,000 copies upfront, books are printed as readers buy them. If you do want a bulk print run, the cost per copy varies based on page count, size, colour interiors, and binding. Generally, a standard paperback with black-and-white interiors might cost anywhere from &pound;2&ndash;&pound;6 per copy at volume. We'll walk you through the options during your consultation."],
    ['q' => 'Are there any reputable hybrid publishers in Europe?',      'a' => "Yes, European Publishing House offers hybrid publishing services in Europe. Hybrid publishing sits between traditional and self-publishing: you get professional editing, design, and distribution, while retaining your rights and a larger share of royalties than a traditional deal would give you. It's a strong option for authors who want quality without the waiting list."],
    ['q' => 'How expensive is hybrid publishing in Europe?',             'a' => "Hybrid publishing costs more than DIY self-publishing because you're paying for professional services, but you retain rights and earn higher royalties than through a traditional publisher. Costs vary based on what's included. Some authors need the full package, editing, design, formatting, marketing, and distribution. Others just need certain services. We quote based on what your book actually needs."],
    ['q' => 'Who are the best publishing houses in Europe?',             'a' => "Finding the right publishing house in Europe comes down to one thing, who's actually going to care about your book. European Publishing House is one of the best publishing houses in Europe, and the numbers speak for themselves. Since 2021, we've published over 800 books across every genre, working with authors from first draft to final sale. We handle editing, cover design, formatting, ghostwriting, marketing, and global distribution, all under one roof. You keep your rights, you keep your royalties, and you work directly with a team that treats your manuscript like it matters. You've already found your publisher."],
];

// Testimonials kept (live site shows empty placeholder)
$reviews = [
    ['name' => 'Maya Thompson', 'role' => 'Memoirist',  'rating' => 5, 'text' => 'They treated my manuscript like a piece of literature, not a content asset. The editorial conversation alone was worth the partnership.'],
    ['name' => 'J. R. Kaelen',  'role' => 'Author',     'rating' => 5, 'text' => 'My fantasy series found its proper home. Every page — text, cover, paper stock — was considered. That is unbelievably rare in modern publishing.'],
    ['name' => 'David Lincoln', 'role' => 'Author',     'rating' => 5, 'text' => 'The marketing was strategic, not noisy. Reviews in three national papers and a placement on the FT summer-reads list. That is what a real publicist does.'],
    ['name' => 'Elena Hart',    'role' => 'Novelist',   'rating' => 5, 'text' => 'They saw the book the way I saw it — and pushed me to write the version I had been too afraid to commit to. A truly literary partnership.'],
];

include __DIR__ . '/includes/header.php';
?>

<!-- ============================================================
     HERO
     ============================================================ -->
<section class="hero-section" id="hero">

    <div class="hero-bg" aria-hidden="true">
        <span class="bg-shape bg-shape--arch-left"></span>
        <span class="bg-shape bg-shape--arch-right"></span>
        <span class="bg-shape bg-shape--circle"></span>
        <span class="bg-leaf bg-leaf--left"></span>
        <span class="bg-leaf bg-leaf--right"></span>
        <span class="bg-blob bg-blob--gold"></span>
        <span class="bg-blob bg-blob--green"></span>
        <span class="paper-grain"></span>
    </div>

    <div class="hero-side hero-side--left" aria-hidden="true">
        <span class="side-chip side-chip--est">
            <small>Established</small>
            <strong>2014</strong>
            <small>Dublin · Ireland</small>
        </span>
        <a href="<?= safe($sideBooks[0]['amazon_link']) ?>"
           class="float-book float-book--left"
           target="_blank" rel="noopener noreferrer"
           aria-label="<?= safe($sideBooks[0]['title']) ?> by <?= safe($sideBooks[0]['author']) ?> — Buy on Amazon">
            <div class="book__cover book__cover--img">
                <img src="<?= safe($sideBooks[0]['image']) ?>"
                     alt="<?= safe($sideBooks[0]['title']) ?> by <?= safe($sideBooks[0]['author']) ?>"
                     loading="lazy" decoding="async">
                <span class="book__shine"></span>
            </div>
            <span class="float-book__tag">New Release</span>
        </a>
        <span class="ink-dots ink-dots--left">
            <span></span><span></span><span></span><span></span><span></span><span></span>
        </span>
        <svg class="hero-doodle hero-doodle--swirl-left" viewBox="0 0 120 80" fill="none" aria-hidden="true">
            <path d="M5 70 C 30 30, 60 10, 110 8" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" fill="none"/>
            <path d="M110 8 L 100 18 M110 8 L 100 4" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
        </svg>
    </div>

    <div class="hero-side hero-side--right" aria-hidden="true">
        <span class="side-chip side-chip--rating">
            <span class="rating-stars">
                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
            </span>
            <strong>4.9 / 5</strong>
            <small>from 25,000+ readers</small>
        </span>
        <a href="<?= safe($sideBooks[1]['amazon_link']) ?>"
           class="float-book float-book--right"
           target="_blank" rel="noopener noreferrer"
           aria-label="<?= safe($sideBooks[1]['title']) ?> by <?= safe($sideBooks[1]['author']) ?> — Buy on Amazon">
            <div class="book__cover book__cover--img">
                <img src="<?= safe($sideBooks[1]['image']) ?>"
                     alt="<?= safe($sideBooks[1]['title']) ?> by <?= safe($sideBooks[1]['author']) ?>"
                     loading="lazy" decoding="async">
                <span class="book__shine"></span>
            </div>
            <span class="float-book__tag">Bestseller</span>
        </a>
        <span class="quill-mark" aria-hidden="true">
            <svg viewBox="0 0 60 80" fill="none">
                <path d="M12 75 C 18 50, 28 25, 50 8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" fill="none"/>
                <path d="M50 8 L 38 14 L 44 22 Z" fill="currentColor"/>
                <circle cx="12" cy="75" r="2" fill="currentColor"/>
            </svg>
        </span>
    </div>

    <div class="container hero-container">

        <div class="hero-copy text-center" data-aos="fade-up" data-aos-duration="1100">
            <span class="eyebrow">European Publishing House</span>

            <h1 class="hero-title">
                Expert Book Publishers<br>
                <em class="gold-italic">in Europe<span class="sparkle"></span></em>
                Built for Authors Who Mean It
            </h1>

            <span class="annotate annotate--left" aria-hidden="true">
                <span class="annotate__text">Curated stories<br>for a better world</span>
                <svg class="annotate__arrow" viewBox="0 0 80 60" fill="none">
                    <path d="M3 5 C 25 25, 45 35, 70 50" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" fill="none"/>
                    <path d="M70 50 L 60 46 M70 50 L 66 40" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                </svg>
            </span>

            <span class="annotate annotate--right" aria-hidden="true">
                <span class="annotate__text">Exceptional<br>books, beautifully<br>crafted</span>
                <svg class="annotate__arrow" viewBox="0 0 80 60" fill="none">
                    <path d="M77 5 C 55 25, 35 35, 10 50" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" fill="none"/>
                    <path d="M10 50 L 20 46 M10 50 L 14 40" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                </svg>
            </span>

            <p class="hero-sub">European Publishing House started in 2021 with one straightforward idea — that a good manuscript deserves a proper home. Since then, we've helped authors publish over 800 books across every genre you can think of. Fiction, non-fiction, memoirs, business books, children's stories. We work with first-time authors figuring out where to start and seasoned writers who know exactly what they want.</p>
            <p class="hero-sub">We're a publishing house in Europe that handles everything under one roof — manuscript editing, cover design, formatting, distribution and marketing. You don't need to piece together five different freelancers or navigate publishing on your own. We do it with you, from the first read-through to the day your book is on sale worldwide.</p>

            <div class="hero-cta-row">
                <a href="portfolios.php" class="btn btn-cta btn-lg magnetic" data-no-popup>
                    Explore Our Books <i class="fa-solid fa-arrow-right"></i>
                </a>
                <a href="contact.php#submit" class="btn btn-ghost btn-lg">
                    Start Publishing
                </a>
            </div>
        </div>

        <div class="hero-spacer" aria-hidden="true">
            <span class="spacer-rule"></span>
            <span class="spacer-dot"></span>
            <span class="spacer-rule"></span>
        </div>

        <div class="hero-book-shelf" data-aos="fade-up" data-aos-delay="220">
            <div class="owl-carousel owl-theme hero-book-slider">
                <?php foreach ($heroBooks as $i => $book): ?>
                    <div class="book-slot">
                        <a href="<?= safe($book['amazon_link']) ?>"
                           class="book book--img"
                           target="_blank" rel="noopener noreferrer"
                           title="<?= safe($book['title']) ?> by <?= safe($book['author']) ?> — Buy on Amazon"
                           aria-label="<?= safe($book['title']) ?> by <?= safe($book['author']) ?> — Buy on Amazon">
                            <div class="book__cover book__cover--img">
                                <?php if ($i % 3 === 0): ?>
                                    <span class="book__badge" aria-hidden="true"><i class="fa-solid fa-award"></i></span>
                                <?php endif; ?>
                                <img src="<?= safe($book['image']) ?>"
                                     alt="<?= safe($book['title']) ?> by <?= safe($book['author']) ?> — published by <?= safe(WEBSITE_NAME) ?>"
                                     loading="<?= $i < 3 ? 'eager' : 'lazy' ?>"
                                     decoding="async">
                                <span class="book__shine" aria-hidden="true"></span>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <span class="shelf-floor" aria-hidden="true"></span>
        </div>
    </div>
</section>

<!-- ============================================================
     LOGO SLIDER — continuous scrolling partner logos
     ============================================================ -->
<?php include __DIR__ . '/includes/logo-slider.php'; ?>



<!-- ============================================================
     ABOUT — About European Publishing House
     Left half is a full-bleed image touching the viewport's left edge.
     Right half is inside the normal container with the copy block.
     ============================================================ -->
<section class="about-snippet" id="about">

    <!-- Full-bleed image panel (left half, escapes the container) -->
    <div class="about-snippet__image"
         style="background-image: url('assets/images/about-image.png');"
         aria-hidden="true"></div>

    <div class="container">
        <div class="row">
            <!-- Spacer column so the text starts on the right half on desktop -->
            <div class="col-lg-6 about-snippet__spacer" aria-hidden="true"></div>

            <div class="col-lg-6 about-snippet__copy" data-aos="fade-left">
                <span class="eyebrow">About Us</span>
                <h2 class="section-title about-snippet__title">
                    About <em class="gold-italic">European Publishing House</em>
                    <img src="assets/images/favicon.png"
                         class="about-feather-mark"
                         alt=""
                         aria-hidden="true"
                         loading="lazy"
                         decoding="async">
                </h2>
                <p>We launched in 2021 because we kept seeing the same problem, brilliant manuscripts that never became books. Not because they weren't good enough, but because traditional publishing is slow, closed-off, and difficult to break into. Self-publishing, on the other hand, can feel like you're building a plane while it's taking off.</p>
                <p>We built European Publishing House to sit in the middle of those two worlds. Professional-quality publishing, accessible to authors who don't have a literary agent or decades of industry connections. Since then, we've published over 800 books across every genre, working with debut authors and experienced writers alike.</p>
                <p>Our team includes editors with serious experience across fiction and non-fiction, designers who understand what sells in different markets, and publishing specialists who know every step of the process.</p>
                <a href="contact.php#submit" class="btn btn-cta">Get Your Publishing Quote <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     GENRES — We Publish Books in Every Genre
     ============================================================ -->
<section class="genres-section" id="genres">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Genres</span>
            <h2 class="section-title">We Publish Books in <em class="gold-italic">Every Genre</em></h2>
            <p>Whether you've written a sweeping fantasy novel, a sharp business guide, or a memoir you've been sitting on for years, we know what each genre needs. Our editors and designers specialise across categories, so your book gets worked on by people who actually read that kind of writing.</p>
        </div>
        <div class="row g-4 mt-2">
            <?php foreach ($genres as $i => $g): ?>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= $i * 120 ?>">
                <article class="genre-card genre-art--<?= safe($g['art']) ?>">
                    <span class="genre-tag"><?= safe($g['tag']) ?></span>
                    <ul class="genre-list" role="list">
                        <?php foreach ($g['list'] as $item): ?>
                            <li><i class="fa-solid fa-feather"></i><?= safe($item) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <span class="genre-glow" aria-hidden="true"></span>
                </article>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="contact.php#submit" class="btn btn-cta btn-lg">Publish Your Genre <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>
</section>

<!-- ============================================================
     PORTFOLIO GRID — editorial copy + tilted 3-column scroll
     ============================================================ -->
<?php
    // Tilted 3-column scroll, populated from the dynamic portfolio.
    $gridBooks = $portfolioItems;
    $third = (int) ceil(count($gridBooks) / 3);
    $colA  = array_slice($gridBooks, 0, $third);
    $colB  = array_slice($gridBooks, $third, $third);
    $colC  = array_slice($gridBooks, $third * 2);
    if (empty($colA)) $colA = $gridBooks;
    if (empty($colB)) $colB = array_reverse($gridBooks);
    if (empty($colC)) $colC = $gridBooks;
?>
<section class="portfolio-grid-sec" id="portfolio-grid">
    <div class="container">
        <div class="row align-items-center g-5">

            <div class="col-lg-6 portfolio-grid-sec__copy" data-aos="fade-right">
                <span class="eyebrow">Our Catalog</span>
                <h2 class="section-title">Our <em class="gold-italic">Published</em> Books</h2>
                <p>Since 2021, we&rsquo;ve helped over 800 authors turn manuscripts into published books, and the range is about as wide as publishing gets. Literary fiction and page-turning thrillers. Memoirs that needed the right voice to come alive on the page. Business books from people with genuine expertise worth sharing. Children&rsquo;s stories that had to work for the child reading them and the adult reading them aloud. Academic titles, self-help, romance, fantasy, non-fiction, all of it.</p>
                <p>Every book in our portfolio started as someone&rsquo;s idea, and every one of them got the same level of attention regardless of genre or length. Take a look at what we&rsquo;ve published, and if you&rsquo;re working on something you&rsquo;d like to see alongside them, get in touch.</p>
                <a class="btn btn-cta" href="portfolios.php" data-no-popup>View More <i class="fa-solid fa-arrow-right"></i></a>
            </div>

            <div class="col-lg-6 portfolio-grid-sec__visual" data-aos="fade-left">
                <div class="book-grid-stage">
                    <?php $cols = [$colA, $colB, $colC]; foreach ($cols as $idx => $colBooks): ?>
                        <div class="book-grid-col book-grid-col--<?= $idx + 1 ?>">
                            <ul class="book-grid-list">
                                <?php for ($d = 0; $d < 2; $d++):
                                    foreach ($colBooks as $book): ?>
                                        <li style="background-image:url('<?= safe($book['image']) ?>')">
                                            <a href="<?= safe($book['amazon_link']) ?>"
                                               target="_blank" rel="noopener noreferrer"
                                               aria-label="<?= safe($book['title']) ?> by <?= safe($book['author']) ?> — Buy on Amazon"
                                               <?= $d ? 'tabindex="-1" aria-hidden="true"' : '' ?>></a>
                                        </li>
                                    <?php endforeach;
                                endfor; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ============================================================
     TOP CATEGORIES — six icon cards
     ============================================================ -->
<section class="top-cats-sec" id="top-categories">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Most-Requested</span>
            <h2 class="section-title">Top <em class="gold-italic">Categories</em></h2>
        </div>
        <div class="row g-4">
            <?php foreach ($topCategories as $i => $c): ?>
            <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="<?= $i * 70 ?>">
                <article class="top-cat-card">
                    <span class="top-cat-card__icon"><i class="fa-solid <?= safe($c['icon']) ?>"></i></span>
                    <h3 class="top-cat-card__label"><?= safe($c['label']) ?></h3>
                </article>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================================
     PUBLISHING COSTS — image + copy split
     ============================================================ -->
<section class="publish-cost-sec section--dark" id="publish-cost">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="publish-cost-art">
                    <img src="assets/images/livesite/publishCostsection.jpg" alt="What does it cost to publish a book in Europe" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Pricing</span>
                <h2 class="section-title">What Does It Cost to Publish a Book in <em class="gold-italic">Europe?</em></h2>
                <p>Publishing costs vary, and honestly, anyone who quotes you a flat rate without reading your manuscript first is guessing. A 40,000-word memoir has different needs than a 100,000-word fantasy novel. A children's picture book is a completely different project to a business guide. Some authors come to us needing the full package, editing, design, formatting, marketing. Others have a finished manuscript and just need distribution. We price based on what your book actually needs, not a generic bundle.</p>
                <p>The best thing we can do is have an honest conversation about your book, where it's at, and what it needs to be ready for readers. From there, we'll put together a clear quote with no surprises.</p>
                <a href="contact.php#submit" class="btn btn-cta btn-lg">Get Your Publishing Quote <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     PROCESS — How We Publish Your Book
     ============================================================ -->
<section class="process-section" id="process">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">The Editorial Journey</span>
            <h2 class="section-title">How We Publish <em class="gold-italic">Your Book</em></h2>
            <p>Four Steps from Manuscript to Published</p>
        </div>
        <div class="process-grid">
            <?php foreach ($steps as $i => $s): ?>
            <article class="process-card" data-aos="fade-up" data-aos-delay="<?= $i * 120 ?>">
                <span class="process-n"><?= safe($s['n']) ?></span>
                <i class="fa-solid <?= safe($s['icon']) ?> process-icon"></i>
                <h3 class="process-title"><?= safe($s['title']) ?></h3>
                <p class="process-desc"><?= safe($s['desc']) ?></p>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================================
     WHY AUTHORS CHOOSE EPH
     ============================================================ -->
<section class="why-eph-sec section--dark" id="why">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="why-eph-art">
                    <img src="assets/images/livesite/AuthorChoose.jpg" alt="Why authors choose European Publishing House" loading="lazy" decoding="async">
                    <span class="why-eph-art__chip">Author-First</span>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Why Authors Choose Us</span>
                <h2 class="section-title">Why Authors Choose <em class="gold-italic">European Publishing House</em></h2>
                <p>We're not a publishing mill. We're a team of editors, designers, and publishing specialists who genuinely care whether your book lands well. Since 2021, we've published over 800 books, and every single one has had a real person behind it who read it, worked on it, and wanted it to succeed.</p>
                <p>We'll tell you the honest truth about your manuscript, even if that means saying it needs more work before it's ready to publish. We'd rather lose the job than send a book into the world that's not ready. Our pricing has no hidden fees. Your rights stay yours. And we're with you after publication too, not just until we've taken your money.</p>
                <p>We work with authors across Europe and beyond, bringing the kind of quality and care you'd expect from the best publishing houses in Europe, without the exclusivity or the years-long waiting lists.</p>
                <a href="contact.php" class="btn btn-cta">Work With Us <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     SERVICES — Every Publishing Service, One Place
     Featured card (Book Cover Design) takes a wide slot in the
     grid with two floating book covers on the right.
     ============================================================ -->
<?php
    // Pick the cover-design service as featured, render the rest normally.
    $featuredIdx = 3;                                  // 0-based: "Book Cover Design"
    $featured    = $services[$featuredIdx] ?? null;
    $regularServices = array_values(array_filter($services, function ($_, $i) use ($featuredIdx) {
        return $i !== $featuredIdx;
    }, ARRAY_FILTER_USE_BOTH));

    // Two real book covers for the featured card's right-side stack
    $featuredCovers = getBookCovers(['shuffle' => true, 'limit' => 2, 'offset' => 60]);
    if (count($featuredCovers) < 2) $featuredCovers = getBookCovers(['shuffle' => true, 'limit' => 2]);
?>
<section class="services-section" id="services">
    <div class="container">
        <div class="section-head text-center" data-aos="fade-up">
            <span class="eyebrow">Author Services</span>
            <h2 class="section-title">Every Publishing Service, <em class="gold-italic">One Place</em></h2>
        </div>

        <div class="services-grid mt-5">

            <?php if ($featured): ?>
            <!-- Featured card -->
            <article class="service-card service-card--featured" data-aos="fade-up">
                <div class="service-card__body">
                    <span class="service-icon"><i class="fa-solid <?= safe($featured['icon']) ?>"></i></span>
                    <h3 class="service-title"><?= safe($featured['title']) ?></h3>
                    <p class="service-desc"><?= safe($featured['desc']) ?></p>
                    <a href="services.php" class="service-link">Learn more <i class="fa-solid fa-arrow-right"></i></a>
                </div>
                <div class="service-card__covers" aria-hidden="true">
                    <?php foreach ($featuredCovers as $i => $c): ?>
                        <img src="<?= safe($c) ?>" alt="" class="service-cover service-cover--<?= $i + 1 ?>" loading="lazy" decoding="async">
                    <?php endforeach; ?>
                </div>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <?php endif; ?>

            <!-- Regular cards -->
            <?php foreach ($regularServices as $i => $s): ?>
            <article class="service-card" data-aos="fade-up" data-aos-delay="<?= $i * 70 ?>">
                <span class="service-icon"><i class="fa-solid <?= safe($s['icon']) ?>"></i></span>
                <h3 class="service-title"><?= safe($s['title']) ?></h3>
                <p class="service-desc"><?= safe($s['desc']) ?></p>
                <a href="services.php" class="service-link">Learn more <i class="fa-solid fa-arrow-right"></i></a>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <?php endforeach; ?>

        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="contact.php#submit" class="btn btn-cta btn-lg">Get Started <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>
</section>

<!-- ============================================================
     ACHIEVEMENTS / OUR IMPACT
     ============================================================ -->
<section class="achievements-section" id="achievements">
    <div class="container">
        <div class="achievements-inner" data-aos="zoom-in">
            <div class="achievements-head">
                <span class="eyebrow">Our Impact</span>
                <h2 class="section-title">Our <em class="gold-italic">Achievements</em></h2>
            </div>
            <div class="row g-0 achievements-row">
                <?php foreach ($awards as $i => $a): ?>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
                    <div class="achievement">
                        <div class="achievement-num">
                            <span class="count-up" data-target="<?= $a['n'] ?>">0</span><span class="achievement-suffix"><?= safe($a['suffix']) ?></span>
                        </div>
                        <span class="achievement-label"><?= safe($a['label']) ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     TEAM CALLOUT
     ============================================================ -->
<section class="team-callout-sec" id="team-callout">
    <div class="container">
        <div class="team-callout-card" data-aos="zoom-in">
            <div class="team-callout-card__bg" aria-hidden="true">
                <span class="cta-shape cta-shape--1"></span>
                <span class="cta-shape cta-shape--2"></span>
                <span class="paper-grain"></span>
            </div>
            <span class="eyebrow eyebrow--light">100% Experienced &middot; 100% Trustworthy</span>
            <h2 class="team-callout-card__title">Our Team Will Take Your Project to the <em class="gold-italic">Next Level</em></h2>
            <div class="team-callout-card__cta-row">
                <a href="contact.php" class="btn btn-gold btn-lg magnetic">Book A Call With The Team <i class="fa-solid fa-arrow-right"></i></a>
                <a href="contact.php" class="btn btn-outline-light btn-lg"><i class="fa-regular fa-comment-dots"></i> Chat with us</a>
            </div>
        </div>
    </div>
</section>





<!-- ============================================================
     GLOBAL DISTRIBUTION — Your Book, Available Worldwide
     ============================================================ -->
<section class="distribution-section section--dark" id="distribution">
    <div class="dist-map" aria-hidden="true"><span class="dist-glow"></span></div>
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Global Distribution</span>
            <h2 class="section-title">Your Book, Available <em class="gold-italic">Worldwide</em></h2>
            <p>Publishing with us means your book is available globally from the moment it goes live. We distribute across every major retailer in every major format, so readers can find and buy your book however they prefer to read, on a Kindle, through Apple Books, in paperback, or in hardcover.</p>
        </div>

        <div class="row g-4 mt-4">
            <div class="col-md-7" data-aos="fade-up">
                <div class="dist-list-card">
                    <h3 class="dist-list-card__title"><i class="fa-solid fa-globe"></i>Platforms we distribute to</h3>
                    <ul class="dist-list">
                        <?php foreach ($distPlatforms as $p): ?>
                            <li><i class="fa-solid fa-check"></i><?= safe($p) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-5" data-aos="fade-up" data-aos-delay="100">
                <div class="dist-list-card">
                    <h3 class="dist-list-card__title"><i class="fa-solid fa-book"></i>Available formats</h3>
                    <ul class="dist-list">
                        <?php foreach ($distFormats as $f): ?>
                            <li><i class="fa-solid fa-check"></i><?= safe($f) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <p class="dist-footnote text-center mt-4" data-aos="fade-up">We handle every upload, every platform requirement, and every technical specification. You manage your book. We manage the logistics.</p>

        <div class="text-center mt-4" data-aos="fade-up">
            <a href="contact.php#submit" class="btn btn-cta btn-lg">Publish Globally <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>
</section>

<!-- ============================================================
     TESTIMONIALS — What Our Authors Say
     ============================================================ -->
<section class="testimonials-section" id="testimonials">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">From Our Authors</span>
            <h2 class="section-title">What Our <em class="gold-italic">Authors Say</em></h2>
        </div>
        <div class="owl-carousel owl-theme testimonials-slider" data-aos="fade-up" data-aos-delay="120">
            <?php foreach ($reviews as $r): ?>
            <div class="testimonial-card">
                <div class="testimonial-rating">
                    <?php for ($s = 0; $s < $r['rating']; $s++): ?><i class="fa-solid fa-star"></i><?php endfor; ?>
                </div>
                <p class="testimonial-text">&ldquo;<?= safe($r['text']) ?>&rdquo;</p>
                <div class="testimonial-author">
                    <span class="testimonial-mark"><?= safe(substr($r['name'], 0, 1)) ?></span>
                    <div>
                        <strong><?= safe($r['name']) ?></strong>
                        <span class="testimonial-role"><?= safe($r['role']) ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================================
     FAQ — We're Here To Answer All Your Questions
     ============================================================ -->
<section class="faq-section" id="faq">
    <div class="container">
        <div class="row g-5 align-items-start">
            <div class="col-lg-4" data-aos="fade-right">
                <span class="eyebrow">FAQs</span>
                <h2 class="section-title">We're Here To Answer All Your <em class="gold-italic">Questions.</em></h2>
                <p>Can't find what you're looking for? Speak with our team directly.</p>
                <a href="contact.php" class="btn btn-cta">Get in Touch <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <div class="col-lg-8" data-aos="fade-left" data-aos-delay="100">
                <div class="accordion faq-accordion" id="faqAcc">
                    <?php foreach ($faqs as $i => $f): ?>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button <?= $i === 0 ? '' : 'collapsed' ?>" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq<?= $i ?>"
                                    aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>" aria-controls="faq<?= $i ?>">
                                <span class="faq-num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                                <?= $f['q'] ?>
                            </button>
                        </h3>
                        <div id="faq<?= $i ?>" class="accordion-collapse collapse <?= $i === 0 ? 'show' : '' ?>" data-bs-parent="#faqAcc">
                            <div class="accordion-body"><p><?= $f['a'] ?></p></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     FINAL CTA — We're Invested in Your Book's Success
     ============================================================ -->
<section class="cta-section" id="cta">
    <div class="container">
        <div class="cta-card" data-aos="zoom-in">
            <div class="cta-bg" aria-hidden="true">
                <span class="cta-shape cta-shape--1"></span>
                <span class="cta-shape cta-shape--2"></span>
                <span class="cta-shape cta-shape--3"></span>
                <span class="paper-grain"></span>
            </div>
            <span class="eyebrow eyebrow--light">Ready to Begin?</span>
            <h2 class="cta-title">We're Invested in Your <em class="gold-italic">Book's Success</em></h2>
            <p class="cta-sub">Every book we publish gets the same level of care, whether it's your first or your fifth. We don't consider our job done until your book is out in the world and you're happy with it. That's been our standard since day one.</p>
            <div class="cta-row">
                <a href="contact.php#submit" class="btn btn-gold btn-lg magnetic">Start Publishing With Confidence <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
