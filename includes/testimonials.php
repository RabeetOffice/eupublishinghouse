<?php
require_once __DIR__ . '/config.php';

// Testimonials now come from a single source of truth (managed in /admin),
// unless a page injected its own $reviews before including this file.
if (!isset($reviews) || !is_array($reviews) || !$reviews) {
    require __DIR__ . '/testimonials-data.php';
}
$testimonialsEyebrow = $testimonialsEyebrow ?? 'From Our Authors';
$testimonialsTitle   = $testimonialsTitle   ?? 'What our <em class="serif-italic">authors say</em>';
$testimonialsIntro   = $testimonialsIntro   ?? 'Quiet praise from writers who chose us to publish the book they had been working on for years.';

// Split into two rows for the opposite-direction marquees
$half  = (int) ceil(count($reviews) / 2);
$rowA  = array_slice($reviews, 0, $half);
$rowB  = array_slice($reviews, $half);
if (empty($rowB)) $rowB = $rowA;
?>
<section class="testimonials-section" id="testimonials">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow"><?= safe($testimonialsEyebrow) ?></span>
            <h2 class="section-title"><?= $testimonialsTitle ?></h2>
            <p><?= safe($testimonialsIntro) ?></p>
        </div>
    </div>

    <div class="testimonial-marquee" data-aos="fade-up" data-aos-delay="100">
        <div class="testimonial-row testimonial-row--top">
            <?php for ($d = 0; $d < 2; $d++): foreach ($rowA as $r): ?>
                <article class="testimonial-card" <?= $d ? 'aria-hidden="true"' : '' ?>>
                    <div class="testimonial-rating">
                        <?php for ($s = 0; $s < $r['rating']; $s++): ?><i class="fa-solid fa-star"></i><?php endfor; ?>
                    </div>
                    <p class="testimonial-text"><?= safe($r['text']) ?></p>
                    <div class="testimonial-author">
                        <span class="testimonial-mark"><?= safe(mb_substr($r['name'], 0, 1)) ?></span>
                        <div>
                            <strong><?= safe($r['name']) ?></strong>
                            <span class="testimonial-role"><?= safe($r['role']) ?></span>
                        </div>
                    </div>
                </article>
            <?php endforeach; endfor; ?>
        </div>

        <div class="testimonial-row testimonial-row--bottom">
            <?php for ($d = 0; $d < 2; $d++): foreach ($rowB as $r): ?>
                <article class="testimonial-card" <?= $d ? 'aria-hidden="true"' : '' ?>>
                    <div class="testimonial-rating">
                        <?php for ($s = 0; $s < $r['rating']; $s++): ?><i class="fa-solid fa-star"></i><?php endfor; ?>
                    </div>
                    <p class="testimonial-text"><?= safe($r['text']) ?></p>
                    <div class="testimonial-author">
                        <span class="testimonial-mark"><?= safe(mb_substr($r['name'], 0, 1)) ?></span>
                        <div>
                            <strong><?= safe($r['name']) ?></strong>
                            <span class="testimonial-role"><?= safe($r['role']) ?></span>
                        </div>
                    </div>
                </article>
            <?php endforeach; endfor; ?>
        </div>
    </div>

    <div class="container text-center mt-5" data-aos="fade-up">
        <a href="#popup" class="btn btn-cta btn-lg" data-popup>
            Share Your Story <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</section>
