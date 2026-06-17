<?php
require_once __DIR__ . '/includes/config.php';

$page_title       = 'European Publishing House – Author Testimonials & Reviews';
$page_description = 'Read what authors say about European Publishing House. Honest testimonials reflecting our commitment, expertise, and dedicated publishing support across Europe.';
$page_keywords    = 'EU Publishing House testimonials, author reviews, publishing testimonials Dublin';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/testimonial/';

require __DIR__ . '/includes/header.php';

$banner = [
    'crumb'   => 'Testimonials',

    'title'   => 'What our <em class="serif-italic">authors</em> say.',
    'sub'     => 'Stories from writers who&rsquo;ve published with European Publishing House across fiction, memoir, business and children&rsquo;s books.',
];
include __DIR__ . '/includes/page-banner.php';

// Single source of truth (managed in /admin → Testimonials).
require __DIR__ . '/includes/testimonials-data.php';
?>

<section class="testimonials-section" id="testimonials">
    <div class="container">
        <div class="section-head text-center" data-aos="fade-up">
            <span class="eyebrow">Testimonials</span>
            <h2 class="section-title">We&rsquo;re Invested in Your <em class="serif-italic">Book&rsquo;s Success</em></h2>
            <p style="max-width:720px;margin-inline:auto;">Every book we publish gets the same level of care, whether it&rsquo;s your first or your fifth. We don&rsquo;t consider our job done until your book is out in the world and you&rsquo;re happy with it. That&rsquo;s been our standard since day one.</p>
        </div>

        <div class="row g-4 mt-2">
            <?php foreach ($reviews as $i => $r): ?>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 100 ?>">
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <?php for ($s = 0; $s < $r['rating']; $s++): ?><i class="fa-solid fa-star"></i><?php endfor; ?>
                    </div>
                    <p class="testimonial-text">&ldquo;<?= $r['text'] ?>&rdquo;</p>
                    <div class="testimonial-author">
                        <span class="testimonial-mark"><?= safe(substr($r['name'], 0, 1)) ?></span>
                        <div>
                            <strong><?= safe($r['name']) ?></strong>
                            <span class="testimonial-role"><?= safe($r['role']) ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
include __DIR__ . '/includes/footer.php';
