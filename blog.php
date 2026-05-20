<?php
require_once __DIR__ . '/includes/config.php';

$page_title       = 'Our Blogs | ' . BRAND_NAME;
$page_description = 'Essays, pricing guides and long-form resources on publishing, editing, cover design and book marketing from the European Publishing House editorial desk.';
$page_keywords    = 'publishing blog, author journal, writing craft, book marketing tips, cover design pricing';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/blog.php';

require __DIR__ . '/includes/header.php';

$banner = [
    'crumb' => 'Blog',
    'title' => 'Publishing essays &amp; <em class="serif-italic">resources</em>',
    'sub'   => 'Practical guides and longer essays from the European Publishing House editorial desk.',
];
include __DIR__ . '/includes/page-banner.php';

$posts = [
    [
        'cat'    => 'Design',
        'date'   => '11-05-2026',
        'read'   => '14 min read',
        'title'  => 'How Much Does Book Cover Design Cost in Europe?',
        'desc'   => 'A 2026 breakdown of cover design costs across Europe by region, by experience, by complexity. Includes VAT, contracts and rights.',
        'image'  => 'assets/images/blog/book-cover-design-cost.webp',
        'url'    => 'blog-book-cover-design-cost.php',
        'author' => 'Clara Lichtenberg',
    ],
    [
        'cat'    => 'Industry',
        'date'   => '11-05-2026',
        'read'   => '12 min read',
        'title'  => 'Top 10 Book Publishers in Europe',
        'desc'   => 'A practical guide to the top 10 book publishers in Europe, from indie-friendly modern publishers to the Big Five traditional houses.',
        'image'  => 'assets/images/blog/top-publishers.webp',
        'url'    => 'blog-top-publishers.php',
        'author' => 'Clara Lichtenberg',
    ],
];
?>

<section class="blog-section">
    <div class="container">

        <!-- Search bar -->
        <div class="blog-search-wrap" data-aos="fade-up">
            <label class="blog-search">
                <i class="fa-solid fa-magnifying-glass blog-search__ico" aria-hidden="true"></i>
                <input id="blogSearch" type="search"
                       placeholder="Search articles by title, topic, or keyword..."
                       autocomplete="off"
                       aria-label="Search blog articles">
                <button type="button" class="blog-search__clear" id="blogSearchClear" aria-label="Clear search" hidden>
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </label>
            <span class="blog-search-count" id="blogSearchCount" aria-live="polite">
                <?= count($posts) ?> article<?= count($posts) === 1 ? '' : 's' ?>
            </span>
        </div>

        <!-- Blog grid (uniform cards) -->
        <div class="row g-4 mt-4" id="blogGrid">
            <?php foreach ($posts as $i => $p): ?>
                <div class="col-md-6 col-lg-4 blog-grid-item"
                     data-title="<?= safe(strtolower($p['title'])) ?>"
                     data-desc="<?= safe(strtolower($p['desc'])) ?>"
                     data-cat="<?= safe(strtolower($p['cat'])) ?>"
                     data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 90 ?>">
                    <article class="blog-card">
                        <a href="<?= safe($p['url']) ?>" class="blog-card__art-link" aria-label="Read <?= safe($p['title']) ?>">
                            <div class="blog-card__art" style="background-image:url('<?= safe($p['image']) ?>')" aria-hidden="true"></div>
                        </a>
                        <div class="blog-card__body">
                            <span class="post-cat"><?= safe($p['cat']) ?></span>
                            <h3 class="post-title">
                                <a href="<?= safe($p['url']) ?>"><?= safe($p['title']) ?></a>
                            </h3>
                            <p class="post-desc"><?= safe($p['desc']) ?></p>
                            <div class="post-meta">
                                <span><i class="fa-regular fa-calendar"></i> <?= safe($p['date']) ?></span>
                                <span><i class="fa-regular fa-clock"></i> <?= safe($p['read']) ?></span>
                                <span><i class="fa-regular fa-user"></i> <?= safe($p['author']) ?></span>
                            </div>
                            <a href="<?= safe($p['url']) ?>" class="post-link">Read article <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Empty-state, shown by JS when no results -->
        <div class="blog-empty" id="blogEmpty" hidden>
            <i class="fa-regular fa-folder-open"></i>
            <h3>No articles found</h3>
            <p>Try a different keyword or browse all our articles.</p>
            <button type="button" class="btn btn-glass" id="blogResetBtn">
                Clear search
            </button>
        </div>

    </div>
</section>

<?php
include __DIR__ . '/includes/services.php';
include __DIR__ . '/includes/final-cta.php';
include __DIR__ . '/includes/footer.php';
