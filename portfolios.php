<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/portfolio-data.php';

$page_title       = 'Portfolio | ' . BRAND_NAME;
$page_description = 'Explore titles published by European Publishing House across fiction, memoir, business, children\'s, biography and specialist categories. Every cover links to Amazon.';
$page_keywords    = 'EU Publishing House portfolio, published books, EUPH titles, books on Amazon';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/portfolios.php';

require __DIR__ . '/includes/header.php';

$banner = [
    'crumb'   => 'Portfolio',
    'eyebrow' => 'Published Titles',
    'title'   => 'Books we&rsquo;ve <em class="gold-italic">put</em> our name to.',
    'sub'     => 'A curated selection of recent and signature titles across our imprints.',
];
include __DIR__ . '/includes/page-banner.php';

$total = count($portfolioItems);
?>
<section class="portfolio-grid-section">
    <div class="container">
        <div class="portfolio-filters" data-aos="fade-up">
            <?php foreach ($portfolioTabs as $slug => $label):
                $count = $slug === 'all'
                    ? $total
                    : count(array_filter($portfolioItems, fn($b) => $b['category_slug'] === $slug));
            ?>
                <button class="pf-chip <?= $slug === 'all' ? 'active' : '' ?>"
                        data-filter="<?= safe($slug) ?>">
                    <?= safe($label) ?> <span class="pf-count"><?= $count ?></span>
                </button>
            <?php endforeach; ?>
        </div>

        <div class="row g-4 portfolio-grid">
            <?php foreach ($portfolioItems as $i => $book): ?>
            <div class="col-6 col-md-4 col-lg-3 pf-item"
                 data-cat="<?= safe($book['category_slug']) ?>"
                 data-aos="fade-up" data-aos-delay="<?= ($i % 4) * 80 ?>">
                <a href="<?= safe($book['amazon_link']) ?>"
                   class="portfolio-card book book--grid"
                   target="_blank" rel="noopener noreferrer"
                   aria-label="<?= safe($book['title']) ?> by <?= safe($book['author']) ?>, Buy on Amazon">
                    <div class="book__cover book__cover--img">
                        <img src="<?= safe($book['image']) ?>"
                             alt="<?= safe($book['title']) ?> by <?= safe($book['author']) ?>, published by <?= safe(WEBSITE_NAME) ?>"
                             loading="lazy" decoding="async">
                        <span class="book__shine" aria-hidden="true"></span>
                    </div>
                    <div class="portfolio-card__meta">
                        <span class="portfolio-card__cat"><?= safe($book['category']) ?></span>
                        <h3 class="portfolio-card__title"><?= safe($book['title']) ?></h3>
                        <span class="portfolio-card__author">by <?= safe($book['author']) ?></span>
                        <span class="portfolio-card__cta">
                            <i class="fa-brands fa-amazon"></i> View on Amazon
                        </span>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
include __DIR__ . '/includes/testimonials.php';
include __DIR__ . '/includes/cta.php';
include __DIR__ . '/includes/footer.php';
