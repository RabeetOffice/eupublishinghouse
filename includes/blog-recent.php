<?php
/**
 * "Related / Recent" strip used at the bottom of single blog posts.
 * Expects: $current_slug (string|null)
 */
require_once __DIR__ . '/blog-data.php';

$current_slug = $current_slug ?? null;
$recent_posts = blog_get_recent(3, $current_slug);
if (empty($recent_posts)) return;
?>
<section class="blog-recent">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Keep Reading</span>
            <h2 class="section-title">More from <em class="serif-italic">the journal</em></h2>
        </div>

        <div class="row g-4 mt-2">
            <?php foreach ($recent_posts as $i => $rp): ?>
                <?php
                /* From inside /blogs/<slug>.php, sibling blog files are just <slug>.php */
                $rp_href = basename($rp['slug']) . '.php';
                ?>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 90 ?>">
                    <article class="blog-card">
                        <a href="<?= safe($rp_href) ?>" class="blog-card__art-link" aria-label="Read <?= safe($rp['title']) ?>">
                            <div class="blog-card__art" style="background-image:url('<?= safe(link_to($rp['image'])) ?>')" aria-hidden="true"></div>
                        </a>
                        <div class="blog-card__body">
                            <span class="post-cat"><?= safe($rp['category'] ?? 'Journal') ?></span>
                            <h3 class="post-title">
                                <a href="<?= safe($rp_href) ?>"><?= safe($rp['title']) ?></a>
                            </h3>
                            <p class="post-desc"><?= safe($rp['excerpt']) ?></p>
                            <div class="post-meta">
                                <span><i class="fa-regular fa-calendar"></i> <?= safe(blog_format_date($rp['date'])) ?></span>
                                <span><i class="fa-regular fa-clock"></i> <?= safe($rp['read'] ?? '5 min read') ?></span>
                            </div>
                            <a href="<?= safe($rp_href) ?>" class="post-link">Read article <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
