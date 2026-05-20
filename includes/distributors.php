<?php
require_once __DIR__ . '/config.php';

/* Distribution partner logos. Override $distributorLogos before include to customize. */
$distributorLogos = $distributorLogos ?? [
    ['src' => 'assets/images/logo-slider/googlebooks.webp',  'alt' => 'Google Books'],
    ['src' => 'assets/images/logo-slider/booktopia.webp',    'alt' => 'Booktopia'],
    ['src' => 'assets/images/logo-slider/draft2digital.webp','alt' => 'Draft2Digital'],
    ['src' => 'assets/images/logo-slider/ingram.webp',       'alt' => 'IngramSpark'],
    ['src' => 'assets/images/logo-slider/kindle.webp',       'alt' => 'Amazon Kindle'],
    ['src' => 'assets/images/logo-slider/lulu.webp',         'alt' => 'Lulu'],
    ['src' => 'assets/images/logo-slider/publishdrive.webp', 'alt' => 'PublishDrive'],
    ['src' => 'assets/images/logo-slider/smashwords.webp',   'alt' => 'Smashwords'],
];
$distributorsTitle = $distributorsTitle ?? 'Distributed across 150+ retailers worldwide';
?>
<section class="distributors" aria-label="Distribution partners">
    <div class="container">
        <p class="distributors__title"><?= safe($distributorsTitle) ?></p>
    </div>
    <div class="brand-slider-track">
        <?php foreach ($distributorLogos as $logo): ?>
            <div class="brand-slide">
                <img src="<?= safe($logo['src']) ?>" alt="<?= safe($logo['alt']) ?>" loading="lazy" decoding="async">
            </div>
        <?php endforeach; ?>
        <?php /* duplicate for seamless infinite loop */ ?>
        <?php foreach ($distributorLogos as $logo): ?>
            <div class="brand-slide" aria-hidden="true">
                <img src="<?= safe($logo['src']) ?>" alt="" loading="lazy" decoding="async">
            </div>
        <?php endforeach; ?>
    </div>
</section>
