<?php require_once __DIR__ . '/config.php';
require_once __DIR__ . '/portfolio-data.php';

// Single source of truth: the dynamic portfolio (with Amazon links).
$heroBooks = $portfolioItems;
$sideBooks = array_slice($portfolioItems, 0, 2);
if (count($sideBooks) < 2) $sideBooks = array_pad($sideBooks, 2, $portfolioItems[0] ?? null);
?>
<section class="hero-section" id="hero">

    <!-- Organic background shapes -->
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

    <!-- ===== LEFT-SIDE FLOATING CLUSTER ===== -->
    <div class="hero-side hero-side--left" aria-hidden="true">

        <span class="side-chip side-chip--est">
            <small>Established</small>
            <strong>2014</strong>
            <small>Dublin · Ireland</small>
        </span>

        <a href="<?= safe($sideBooks[0]['amazon_link']) ?>"
           class="float-book float-book--left" data-float="1"
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

    <!-- ===== RIGHT-SIDE FLOATING CLUSTER ===== -->
    <div class="hero-side hero-side--right" aria-hidden="true">

        <span class="side-chip side-chip--rating">
            <span class="rating-stars">
                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
            </span>
            <strong>4.9 / 5</strong>
            <small>from 25,000+ readers</small>
        </span>

        <a href="<?= safe($sideBooks[1]['amazon_link']) ?>"
           class="float-book float-book--right" data-float="2"
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

        <!-- Editorial typography -->
        <div class="hero-copy text-center" data-aos="fade-up" data-aos-duration="1100">
            <span class="eyebrow">European Publishing House</span>

            <h1 class="hero-title">
                Expert Book Publishers<br><em class="gold-italic">in Europe<span class="sparkle"></span></em>Built for Authors Who Mean It
            </h1>

            <!-- Handwritten annotations flanking the headline -->
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

            <p class="hero-sub">European Publishing House started in 2021 with one straightforward idea, that a good manuscript deserves a proper home. Since then, we’ve helped authors publish over 800 books across every genre you can think of. Fiction, non-fiction, memoirs, business books, children’s stories. We work with first-time authors figuring out where to start and seasoned writers who know exactly what they want.</p>
            <p class="hero-sub">We’re a publishing house in Europe that handles everything under one roof. Manuscript editing, cover design, formatting, distribution, and marketing, all of it. You don’t need to piece together five different freelancers or navigate publishing on your own. We do it with you, from the first read-through to the day your book is on sale worldwide.</p>

            <div class="hero-cta-row">
                <a href="portfolios.php" class="btn btn-cta btn-lg magnetic" data-no-popup>
                    Explore Our Books <i class="fa-solid fa-arrow-right"></i>
                </a>
                <a href="contact.php#submit" class="btn btn-ghost btn-lg">
                    Start Publishing
                </a>
            </div>
        </div>

        <!-- Spacer between CTAs and the slider, with a divider sparkle -->
        <div class="hero-spacer" aria-hidden="true">
            <span class="spacer-rule"></span>
            <span class="spacer-dot"></span>
            <span class="spacer-rule"></span>
        </div>

        <!-- ===== HERO BOOK SLIDER — dynamic portfolio, each cover links to Amazon ===== -->
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
