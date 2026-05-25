<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/blog-data.php';

$page_title       = 'European Publishing House – Our Blogs & Insights';
$page_description = 'Explore European Publishing House blogs for expert tips, news, and valuable insights to help authors and publishers stay ahead in the literary world.';
$page_keywords    = 'publishing blog, author journal, writing craft, book marketing tips, cover design pricing';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/blog.php';

require __DIR__ . '/includes/header.php';

$banner = [
    'crumb' => 'Blog',
    'title' => 'Publishing essays &amp; <em class="serif-italic">resources</em>',
    'sub'   => 'Practical guides and longer essays from the European Publishing House editorial desk.',
];
include __DIR__ . '/includes/page-banner.php';
?>

<section class="blog-section">
    <div class="container">

        <!-- Filter bar: search + category chips + count -->
        <?php
        // Unique, alphabetised category list pulled from the blog index
        $blog_categories = array_values(array_unique(array_map(
            static function ($p) { return $p['category']; },
            $blog_posts
        )));
        sort($blog_categories, SORT_STRING | SORT_FLAG_CASE);
        ?>
        <div class="blog-filter-bar" data-aos="fade-up">
            <div class="blog-filter-search">
                <i class="fa-solid fa-magnifying-glass blog-filter-search__ico" aria-hidden="true"></i>
                <input id="blogSearch" type="search"
                       class="blog-filter-search__input"
                       placeholder="Search articles by title, topic, or keyword..."
                       autocomplete="off"
                       aria-label="Search blog articles">
                <button type="button" class="blog-filter-search__clear" id="blogSearchClear" aria-label="Clear search" hidden>
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="blog-filter-row">
                <div class="blog-filter-chips" role="tablist" aria-label="Filter by category">
                    <button type="button" class="blog-chip is-active" data-cat="" role="tab" aria-selected="true">
                        <i class="fa-solid fa-layer-group" aria-hidden="true"></i>
                        <span>All</span>
                        <span class="blog-chip__count"><?= count($blog_posts) ?></span>
                    </button>
                    <?php foreach ($blog_categories as $cat):
                        $cat_count = count(array_filter($blog_posts, static function ($p) use ($cat) {
                            return $p['category'] === $cat;
                        }));
                    ?>
                        <button type="button" class="blog-chip" data-cat="<?= safe(strtolower($cat)) ?>" role="tab" aria-selected="false">
                            <span><?= safe($cat) ?></span>
                            <span class="blog-chip__count"><?= $cat_count ?></span>
                        </button>
                    <?php endforeach; ?>
                </div>
                <span class="blog-filter-count" id="blogSearchCount" aria-live="polite">
                    <i class="fa-regular fa-newspaper" aria-hidden="true"></i>
                    <strong><?= count($blog_posts) ?></strong> article<?= count($blog_posts) === 1 ? '' : 's' ?>
                </span>
            </div>
        </div>

        <!-- Blog grid (uniform cards) -->
        <div class="row g-4 mt-4" id="blogGrid">
            <?php foreach ($blog_posts as $i => $p):
                $post_url = blog_post_url($p['slug']);
            ?>
                <div class="col-md-6 col-lg-4 blog-grid-item"
                     data-title="<?= safe(strtolower($p['title'])) ?>"
                     data-desc="<?= safe(strtolower($p['excerpt'])) ?>"
                     data-cat="<?= safe(strtolower($p['category'])) ?>"
                     data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 90 ?>">
                    <article class="blog-card">
                        <a href="<?= safe($post_url) ?>" class="blog-card__art-link" aria-label="Read <?= safe($p['title']) ?>">
                            <div class="blog-card__art">
                                <img src="<?= safe($p['image']) ?>"
                                     alt=""
                                     class="blog-card__img"
                                     loading="lazy"
                                     decoding="async"
                                     onload="this.parentElement.classList.add('is-loaded')"
                                     onerror="this.parentElement.classList.add('is-loaded','is-error')">
                            </div>
                        </a>
                        <div class="blog-card__body">
                            <span class="post-cat"><?= safe($p['category']) ?></span>
                            <h3 class="post-title">
                                <a href="<?= safe($post_url) ?>"><?= safe($p['title']) ?></a>
                            </h3>
                            <p class="post-desc"><?= safe($p['excerpt']) ?></p>
                            <div class="post-meta">
                                <span><i class="fa-regular fa-calendar"></i> <?= safe(blog_format_date($p['date'])) ?></span>
                                <span><i class="fa-regular fa-clock"></i> <?= safe($p['read']) ?></span>
                                <span><i class="fa-regular fa-user"></i> <?= safe($p['author']) ?></span>
                            </div>
                            <a href="<?= safe($post_url) ?>" class="post-link">Read article <i class="fa-solid fa-arrow-right"></i></a>
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
include __DIR__ . '/includes/footer.php';
