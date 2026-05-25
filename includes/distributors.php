<?php
require_once __DIR__ . '/config.php';

/* Distribution partner logos. Override $distributorLogos before include to customize. */
$distributorLogos = $distributorLogos ?? [
    ['src' => asset('images/logo-slider/googlebooks.webp'),  'alt' => 'Google Books logo – digital book discovery and preview platform'],
    ['src' => asset('images/logo-slider/booktopia.webp'),    'alt' => 'Booktopia logo – Australian online bookstore and retailer'],
    ['src' => asset('images/logo-slider/draft2digital.webp'),'alt' => 'Draft2Digital logo – ebook formatting and distribution service'],
    ['src' => asset('images/logo-slider/ingram.webp'),       'alt' => 'Ingram Content Group logo – book distribution and publishing services'],
    ['src' => asset('images/logo-slider/kindle.webp'),       'alt' => 'Kindle Direct Publishing (KDP) logo – Amazon self-publishing platform'],
    ['src' => asset('images/logo-slider/lulu.webp'),         'alt' => 'Lulu logo – self-publishing and print-on-demand platform'],
    ['src' => asset('images/logo-slider/publishdrive.webp'), 'alt' => 'PublishDrive logo – global ebook distribution platform'],
    ['src' => asset('images/logo-slider/smashwords.webp'),   'alt' => 'Smashwords logo – independent ebook publishing and distribution'],
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
