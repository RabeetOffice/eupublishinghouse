<?php
require_once __DIR__ . '/config.php';

$reviews = $reviews ?? [
    ['name' => 'Maya Thompson', 'role' => 'Memoirist',  'rating' => 5,
        'text' => 'They treated my manuscript like a piece of literature, not a content asset. The editorial conversation alone was worth the partnership.'],
    ['name' => 'J. R. Kaelen',  'role' => 'Fantasy Author', 'rating' => 5,
        'text' => 'My fantasy series found its proper home. Every page, text, cover, paper stock, was considered. That is unbelievably rare in modern publishing.'],
    ['name' => 'David Lincoln', 'role' => 'Business Author', 'rating' => 5,
        'text' => 'The marketing was strategic, not noisy. Reviews in three national papers and a placement on the FT summer-reads list. That is what a real publicist does.'],
    ['name' => 'Elena Hart',    'role' => 'Novelist',   'rating' => 5,
        'text' => 'They saw the book the way I saw it, and pushed me to write the version I was too afraid to commit to. A truly literary partnership.'],
    ['name' => 'Patrick Budden','role' => 'Author of Heartbreak Farm', 'rating' => 5,
        'text' => 'Professional from the first email to launch day. My book is on shelves I never thought I would see, and they made it feel inevitable.'],
    ['name' => 'Heather Green', 'role' => "Children's Author", 'rating' => 5,
        'text' => 'The illustration brief was handled with such care. My characters came to life exactly how I pictured them. I would write a hundred more books with this team.'],
    ['name' => 'Cerys Pugh',    'role' => 'Memoirist', 'rating' => 5,
        'text' => 'Honest, warm, and exacting. They believed in the book before I did, and that changed how I wrote the final chapters. Forever grateful.'],
    ['name' => 'Robert Rosamond','role' => 'Author of A Bobby\'s Job', 'rating' => 5,
        'text' => 'Thirty years on the force and writing the book felt harder than the job itself, until I found this team. They made the process effortless.'],
    ['name' => 'Vera Brown',    'role' => 'Author', 'rating' => 5,
        'text' => 'A small publisher with the polish of a major house. Every email answered within hours, every decision explained. That is a rare combination.'],
    ['name' => 'Joy Jewett',    'role' => 'Author', 'rating' => 5,
        'text' => 'I have published before, this was on a different level. Editorial, design, production, launch, all of it considered, all of it caring.'],
];
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
