<?php require_once __DIR__ . '/config.php';
$reviews = [
    ['name' => 'Maya Thompson', 'role' => 'Memoirist, "Becoming Whole"',     'rating' => 5, 'text' => 'They treated my manuscript like a piece of literature, not a content asset. The editorial conversation alone was worth the partnership.'],
    ['name' => 'J. R. Kaelen',  'role' => 'Author, "The Last Guardian"',     'rating' => 5, 'text' => 'My fantasy series found its proper home. Every page — text, cover, paper stock — was considered. That is unbelievably rare in modern publishing.'],
    ['name' => 'David Lincoln', 'role' => 'Author, "The Founder\'s Playbook"','rating' => 5, 'text' => 'The marketing was strategic, not noisy. Reviews in three national papers and a placement on the FT summer-reads list. That is what a real publicist does.'],
    ['name' => 'Elena Hart',    'role' => 'Novelist, "Fragments of Us"',     'rating' => 5, 'text' => 'They saw the book the way I saw it — and pushed me to write the version I had been too afraid to commit to. A truly literary partnership.'],
];
?>
<section class="testimonials-section" id="testimonials">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">From Our Authors</span>
            <h2 class="section-title">Quiet praise from <em class="gold-italic">serious</em> writers.</h2>
        </div>

        <div class="owl-carousel owl-theme testimonials-slider" data-aos="fade-up" data-aos-delay="120">
            <?php foreach ($reviews as $r): ?>
            <div class="testimonial-card">
                <div class="testimonial-rating">
                    <?php for ($s = 0; $s < $r['rating']; $s++): ?>
                        <i class="fa-solid fa-star"></i>
                    <?php endfor; ?>
                </div>
                <p class="testimonial-text">&ldquo;<?= safe($r['text']) ?>&rdquo;</p>
                <div class="testimonial-author">
                    <span class="testimonial-mark"><?= safe(substr($r['name'], 0, 1)) ?></span>
                    <div>
                        <strong><?= safe($r['name']) ?></strong>
                        <span class="testimonial-role"><?= safe($r['role']) ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
