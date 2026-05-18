<?php
require_once __DIR__ . '/config.php';

$brandLogos = [
    'assets/images/logo-slider/googlebooks.webp',
    'assets/images/logo-slider/booktopia.webp',
    'assets/images/logo-slider/draft2digital.webp',
    'assets/images/logo-slider/ingram.webp',
    'assets/images/logo-slider/kindle.webp',
    'assets/images/logo-slider/lulu.webp',
    'assets/images/logo-slider/publishdrive.webp',
    'assets/images/logo-slider/smashwords.webp',
];
?>
<section class="brand-slider-section" aria-label="Distribution partners">
    <div class="brand-slider-track">
        <?php foreach ($brandLogos as $logo): ?>
            <div class="brand-slide">
                <img src="<?= safe($logo) ?>" alt="Distribution partner logo" loading="lazy" decoding="async">
            </div>
        <?php endforeach; ?>
        <?php /* duplicate for seamless infinite loop */ ?>
        <?php foreach ($brandLogos as $logo): ?>
            <div class="brand-slide" aria-hidden="true">
                <img src="<?= safe($logo) ?>" alt="" loading="lazy" decoding="async">
            </div>
        <?php endforeach; ?>
    </div>
</section>
