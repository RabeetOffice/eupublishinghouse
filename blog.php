<?php
require_once __DIR__ . '/includes/config.php';

$page_title       = 'Our Blogs | ' . BRAND_NAME;
$page_description = 'Essays, pricing guides and long-form resources on publishing, editing, cover design and book marketing from the European Publishing House editorial desk.';
$page_keywords    = 'publishing blog, author journal, writing craft, book marketing tips, cover design pricing';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/blog.php';

require __DIR__ . '/includes/header.php';

$banner = [
    'crumb'   => 'Blog',
    'eyebrow' => 'Our Blogs',
    'title'   => 'Publishing essays &amp; <em class="gold-italic">resources.</em>',
    'sub'     => 'Practical guides and longer essays from the European Publishing House editorial desk.',
];
include __DIR__ . '/includes/page-banner.php';

$posts = [
    [
        'cat'    => 'Design',
        'date'   => '11-05-2026',
        'read'   => '14 min read',
        'title'  => 'How Much Does Book Cover Design Cost in Europe?',
        'desc'   => 'A 2026 breakdown of cover design costs across Europe , by region, by experience, by complexity. Includes VAT, contracts and rights.',
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

$featured = $posts[0];
$rest = array_slice($posts, 1);
?>

<section class="blog-section">
    <div class="container">
        <article class="blog-feature" data-aos="fade-up">
            <div class="blog-feature__art" style="background-image:url('<?= safe($featured['image']) ?>');background-size:cover;background-position:center;" aria-hidden="true"></div>
            <div class="blog-feature__body">
                <span class="post-cat"><?= safe($featured['cat']) ?></span>
                <h2 class="post-title"><?= safe($featured['title']) ?></h2>
                <p class="post-desc"><?= safe($featured['desc']) ?></p>
                <div class="post-meta">
                    <span><i class="fa-regular fa-calendar"></i> <?= safe($featured['date']) ?></span>
                    <span><i class="fa-regular fa-clock"></i> <?= safe($featured['read']) ?></span>
                    <span><i class="fa-regular fa-user"></i> <?= safe($featured['author']) ?></span>
                </div>
                <a href="<?= safe($featured['url']) ?>" class="btn btn-cta">Read Article <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </article>

        <div class="row g-4 mt-5">
            <?php foreach ($rest as $i => $p): ?>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 90 ?>">
                <article class="blog-card">
                    <div class="blog-card__art" style="background-image:url('<?= safe($p['image']) ?>');background-size:cover;background-position:center;" aria-hidden="true"></div>
                    <div class="blog-card__body">
                        <span class="post-cat"><?= safe($p['cat']) ?></span>
                        <h3 class="post-title"><?= safe($p['title']) ?></h3>
                        <p class="post-desc"><?= safe($p['desc']) ?></p>
                        <div class="post-meta">
                            <span><i class="fa-regular fa-calendar"></i> <?= safe($p['date']) ?></span>
                            <span><i class="fa-regular fa-clock"></i> <?= safe($p['read']) ?></span>
                        </div>
                        <a href="<?= safe($p['url']) ?>" class="post-link">Read article <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
include __DIR__ . '/includes/services.php';
include __DIR__ . '/includes/final-cta.php';
include __DIR__ . '/includes/footer.php';
