<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/portfolio-data.php';

/* Page-level overrides, set before include if desired. */
$heroEyebrow   = $heroEyebrow   ?? 'European Publishing House';
$heroHeading   = $heroHeading   ?? 'Expert Book Publishers in Europe, <em class="serif-italic">Built for Authors Who Mean It</em>';
$heroParas     = $heroParas     ?? [
    "European Publishing House started in 2021 with one straightforward idea, that a good manuscript deserves a proper home. Since then, we've helped authors publish over 800 books across every genre you can think of. Fiction, non-fiction, memoirs, business books, children's stories. We work with first-time authors figuring out where to start and seasoned writers who know exactly what they want.",
    "We're a publishing house in Europe that handles everything under one roof. Manuscript editing, cover design, formatting, distribution, and marketing, all of it. You don't need to piece together five different freelancers or navigate publishing on your own. We do it with you, from the first read-through to the day your book is on sale worldwide.",
];
$heroPrimary   = $heroPrimary   ?? ['label' => 'Start Publishing', 'href' => '#popup', 'class' => 'btn btn-cta btn-lg', 'icon' => 'fa-arrow-right', 'popup' => true];
$heroSecondary = $heroSecondary ?? ['label' => 'Explore Our Books', 'href' => 'portfolios.php', 'class' => 'btn btn-glass btn-lg', 'icon' => 'fa-book-open'];

$stackBooks = $portfolioItems;
?>
<section class="hero-section" id="hero">

    <div class="hero-bg" aria-hidden="true">
        <span class="lines"></span>
        <span class="blob blob-1"></span>
        <span class="blob blob-2"></span>
        <span class="blob blob-3"></span>
        <span class="stream stream--1"></span>
        <span class="stream stream--2"></span>
        <span class="stream stream--3"></span>
        <span class="stream stream--4"></span>
        <svg class="leaf leaf-1" viewBox="0 0 120 200" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M60 10 C 25 60, 25 150, 60 190 C 95 150, 95 60, 60 10 Z" fill="#1B5340"/>
            <path d="M60 10 L 60 190" stroke="#0F3E2E" stroke-width="2"/>
        </svg>
        <svg class="leaf leaf-2" viewBox="0 0 120 200" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M60 10 C 25 60, 25 150, 60 190 C 95 150, 95 60, 60 10 Z" fill="#6CB04C"/>
            <path d="M60 10 L 60 190" stroke="#4F932F" stroke-width="2"/>
        </svg>
    </div>

    <div class="container">
        <div class="hero-grid">

            <div class="hero-copy">
                <span class="eyebrow"><?= safe($heroEyebrow) ?></span>
                <h1 class="hero-title"><?= $heroHeading ?></h1>

                <?php foreach ($heroParas as $para): ?>
                    <p class="hero-sub"><?= safe($para) ?></p>
                <?php endforeach; ?>

                <div class="hero-cta-row">
                    <a href="<?= safe($heroPrimary['href']) ?>"
                       class="<?= safe($heroPrimary['class']) ?>"
                       <?= !empty($heroPrimary['popup']) ? 'data-popup' : '' ?>>
                        <?= safe($heroPrimary['label']) ?>
                        <?php if (!empty($heroPrimary['icon'])): ?><i class="fa-solid <?= safe($heroPrimary['icon']) ?>"></i><?php endif; ?>
                    </a>
                    <a href="<?= safe($heroSecondary['href']) ?>" class="<?= safe($heroSecondary['class']) ?>" data-no-popup>
                        <?php if (!empty($heroSecondary['icon'])): ?><i class="fa-solid <?= safe($heroSecondary['icon']) ?>"></i><?php endif; ?>
                        <?= safe($heroSecondary['label']) ?>
                    </a>
                </div>
            </div>

            <div class="hero-stack-wrap">

                <div id="heroStack" data-autoplay="3500" aria-label="Featured books slider">
                    <?php foreach ($stackBooks as $i => $book): ?>
                        <a href="<?= safe($book['amazon_link']) ?>"
                           class="stack-slide<?= $i === 0 ? ' s-center'
                                          : ($i === 1 ? ' s-left1'
                                          : ($i === 2 ? ' s-right1'
                                          : ($i === 3 ? ' s-left2'
                                          : ($i === 4 ? ' s-right2'
                                          : ' s-hidden')))) ?>"
                           data-index="<?= $i ?>"
                           target="_blank" rel="noopener noreferrer"
                           data-no-popup
                           aria-label="<?= safe($book['title']) ?> by <?= safe($book['author']) ?>, Buy on Amazon"
                           title="<?= safe($book['title']) ?> by <?= safe($book['author']) ?>">
                            <img src="<?= safe($book['image']) ?>"
                                 alt="<?= safe($book['title']) ?> by <?= safe($book['author']) ?>"
                                 loading="<?= $i < 5 ? 'eager' : 'lazy' ?>"
                                 decoding="async">
                        </a>
                    <?php endforeach; ?>
                </div>

                <div class="hero-chip-wrap">
                    <span class="hero-stage-chip">
                        <span class="stars">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </span>
                        4.9 / 5
                        <small>· 25k+ reader reviews</small>
                    </span>
                </div>
            </div>

        </div>
    </div>

</section>
