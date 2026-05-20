<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/portfolio-data.php';

$booksLimit   = $booksLimit   ?? 18;
$booksTitle   = $booksTitle   ?? 'Books we\'ve <em class="serif-italic">recently published</em>';
$booksIntro   = $booksIntro   ?? 'Eight hundred titles, every genre. Every cover above started as someone\'s manuscript.';
$booksEyebrow = $booksEyebrow ?? 'Our Catalog';

$booksList = array_slice($portfolioItems, 0, (int)$booksLimit);
?>
<section class="books-section section-paper" id="books">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow"><?= safe($booksEyebrow) ?></span>
            <h2 class="section-title"><?= $booksTitle ?></h2>
            <p><?= safe($booksIntro) ?></p>
        </div>

        <div class="books-carousel owl-carousel owl-theme">
            <?php foreach ($booksList as $book): ?>
                <a href="<?= safe($book['amazon_link']) ?>"
                   class="book-card"
                   target="_blank" rel="noopener noreferrer"
                   aria-label="<?= safe($book['title']) ?> by <?= safe($book['author']) ?> on Amazon"
                   data-no-popup>
                    <img src="<?= safe($book['image']) ?>"
                         alt="<?= safe($book['title']) ?> by <?= safe($book['author']) ?>"
                         loading="lazy" decoding="async">
                    <span class="book-card-meta">
                        <b><?= safe($book['title']) ?></b>
                        <span><?= safe($book['author']) ?></span>
                    </span>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="portfolios.php" class="btn btn-glass btn-lg" data-no-popup>
                See full portfolio <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
