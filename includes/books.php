<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/portfolio-data.php';

$booksLimit   = $booksLimit   ?? 18;
$booksTitle   = $booksTitle   ?? 'Our Published <em class="serif-italic">Books</em>';
$booksIntro   = $booksIntro   ?? "Since 2021, we've helped over 800 authors turn manuscripts into published books, and the range is about as wide as publishing gets. Literary fiction and page-turning thrillers. Memoirs that needed the right voice to come alive on the page. Business books from people with genuine expertise worth sharing. Children's stories that had to work for the child reading them and the adult reading them aloud. Academic titles, self-help, romance, fantasy, non-fiction, all of it.";
$booksIntro2  = $booksIntro2  ?? "Every book in our portfolio started as someone's idea, and every one of them got the same level of attention regardless of genre or length. Take a look at what we've published, and if you're working on something you'd like to see alongside them, get in touch.";
$booksEyebrow = $booksEyebrow ?? 'Our Catalog';
$booksCtaText = $booksCtaText ?? 'View More';

$booksList = array_slice($portfolioItems, 0, (int)$booksLimit);
?>
<section class="books-section section-paper" id="books">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow"><?= safe($booksEyebrow) ?></span>
            <h2 class="section-title"><?= $booksTitle ?></h2>
            <p><?= safe($booksIntro) ?></p>
            <?php if (!empty($booksIntro2)): ?><p><?= safe($booksIntro2) ?></p><?php endif; ?>
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
                <?= safe($booksCtaText) ?> <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
