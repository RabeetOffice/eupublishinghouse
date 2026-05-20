<?php
require_once __DIR__ . '/includes/config.php';

$page_title       = 'Testimonials | ' . BRAND_NAME;
$page_description = 'What authors say about working with European Publishing House across fiction, memoir, business, biography and children\'s books.';
$page_keywords    = 'EU Publishing House testimonials, author reviews, publishing testimonials Dublin';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/testimonial.php';

require __DIR__ . '/includes/header.php';

$banner = [
    'crumb'   => 'Testimonials',
    'eyebrow' => 'From Our Authors',
    'title'   => 'What our <em class="gold-italic">authors</em> say.',
    'sub'     => 'Stories from writers who&rsquo;ve published with European Publishing House across fiction, memoir, business and children&rsquo;s books.',
];
include __DIR__ . '/includes/page-banner.php';

$reviews = [
    ['name' => 'Maya Thompson', 'role' => 'Memoirist',        'rating' => 5, 'text' => 'They treated my manuscript like a piece of literature, not a content asset. The editorial conversation alone was worth the partnership.'],
    ['name' => 'J. R. Kaelen',  'role' => 'Fantasy Author',   'rating' => 5, 'text' => 'My fantasy series found its proper home. Every page , text, cover, paper stock , was considered. That is unbelievably rare in modern publishing.'],
    ['name' => 'David Lincoln', 'role' => 'Non-Fiction Author','rating' => 5, 'text' => 'The marketing was strategic, not noisy. Reviews in three national papers and a placement on the FT summer-reads list. That is what a real publicist does.'],
    ['name' => 'Elena Hart',    'role' => 'Novelist',         'rating' => 5, 'text' => 'They saw the book the way I saw it , and pushed me to write the version I had been too afraid to commit to. A truly literary partnership.'],
    ['name' => 'Patrick Gillan','role' => 'Biography Author', 'rating' => 5, 'text' => 'I needed someone who would handle a difficult story with care. They did, every step of the way, and the finished book is exactly what I hoped it would be.'],
    ['name' => 'Sheena L.C. Walker','role' => 'Business Author','rating' => 5, 'text' => 'From manuscript to Amazon listing, the team was honest about what worked and what needed to change. The end result has been a credible, well-positioned business book.'],
    ['name' => 'Heather Green', 'role' => 'Children\'s Author','rating' => 5, 'text' => 'They cared as much about the illustrations as I did. The book my child loved became a book other children love too.'],
    ['name' => 'Rose Lainie',   'role' => 'Fiction Author',   'rating' => 5, 'text' => 'A team that reads carefully, edits honestly, and publishes properly. Exactly what a writer hopes for.'],
];
?>

<section class="testimonials-section" id="testimonials">
    <div class="container">
        <div class="section-head text-center" data-aos="fade-up">
            <span class="eyebrow">Testimonials</span>
            <h2 class="section-title">We&rsquo;re Invested in Your <em class="gold-italic">Book&rsquo;s Success</em></h2>
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
include __DIR__ . '/includes/books.php';
include __DIR__ . '/includes/distributors.php';
include __DIR__ . '/includes/final-cta.php';
include __DIR__ . '/includes/footer.php';
