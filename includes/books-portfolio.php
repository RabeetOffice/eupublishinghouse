<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/portfolio-data.php';

$booksLimit   = $booksLimit   ?? 18;
$booksTitle   = $booksTitle   ?? 'Our Published <em class="serif-italic">Books</em>';
$booksEyebrow = $booksEyebrow ?? 'Our Catalog';
$booksTagline = $booksTagline ?? "800+ books since 2021, across every genre that matters. Every one of them got the same level of attention, regardless of length or category.";
$booksCtaText = $booksCtaText ?? 'View Full Portfolio';

$booksGenres = $booksGenres ?? [
    'Literary Fiction', 'Thrillers', 'Memoir', 'Business', 'Children\'s',
    'Romance', 'Fantasy', 'Self-Help', 'Academic', 'Non-Fiction',
];

$booksList = array_slice($portfolioItems, 0, (int)$booksLimit);
?>
<section class="books-section section-paper" id="books">
    <div class="container">

        <div class="books-intro books-intro--center">
            <div class="books-intro__copy" data-aos="fade-up">
                <span class="eyebrow"><?= safe($booksEyebrow) ?></span>
                <h2 class="section-title"><?= $booksTitle ?></h2>
                <p class="books-intro__lead"><?= safe($booksTagline) ?></p>

                <div class="books-genre-chips" role="list">
                    <?php foreach ($booksGenres as $g): ?>
                        <span class="books-genre-chip" role="listitem"><?= safe($g) ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="books-carousel owl-carousel owl-theme">
            <?php foreach ($booksList as $book): ?>
                <a href="<?= safe($book['amazon_link']) ?>"
                   class="book-card"
                   target="_blank" rel="noopener noreferrer"
                   aria-label="<?= safe($book['title']) ?> by <?= safe($book['author']) ?> on Amazon"
                   data-no-popup>
                    <img src="<?= safe($book['image']) ?>"
                         alt="<?= safe($book['title']) ?> by <?= safe($book['author']) ?> &mdash; published by <?= safe(WEBSITE_NAME) ?>"
                         width="300" height="450"
                         loading="lazy" decoding="async">
                    <span class="book-card-meta">
                        <b><?= safe($book['title']) ?></b>
                        <span><?= safe($book['author']) ?></span>
                    </span>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="portfolios.php" class="btn btn-cta btn-lg" data-no-popup>
                <?= safe($booksCtaText) ?> <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
