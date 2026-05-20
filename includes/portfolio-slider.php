<?php require_once __DIR__ . '/config.php';
require_once __DIR__ . '/portfolio-data.php';

// Single source of truth: the dynamic portfolio (with Amazon links).
$sliderBooks = $portfolioItems;
?>
<section class="portfolio-section" id="portfolio">
    <div class="container">
        <div class="section-head row align-items-end" data-aos="fade-up">
            <div class="col-lg-8">
                <span class="eyebrow">Published Titles</span>
                <h2 class="section-title">Recent books from our <em class="gold-italic">imprint.</em></h2>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <a href="portfolios.php" class="btn btn-outline-dark btn-quiet">View Full Catalog <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>

    <div class="portfolio-slider-wrap" data-aos="fade-up" data-aos-delay="180">
        <div class="owl-carousel owl-theme portfolio-slider">
            <?php foreach ($sliderBooks as $i => $book): ?>
                <a href="<?= safe($book['amazon_link']) ?>"
                   class="portfolio-card book book--slider"
                   target="_blank" rel="noopener noreferrer"
                   aria-label="<?= safe($book['title']) ?> by <?= safe($book['author']) ?>, Buy on Amazon">
                    <div class="book__cover book__cover--img">
                        <?php if ($i % 4 === 0): ?>
                            <span class="book__badge" aria-hidden="true"><i class="fa-solid fa-award"></i></span>
                        <?php endif; ?>
                        <img src="<?= safe($book['image']) ?>"
                             alt="<?= safe($book['title']) ?> by <?= safe($book['author']) ?>, published by <?= safe(WEBSITE_NAME) ?>"
                             loading="lazy" decoding="async">
                        <span class="book__shine" aria-hidden="true"></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <span class="slider-floor" aria-hidden="true"></span>
    </div>
</section>
