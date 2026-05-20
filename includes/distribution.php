<?php
require_once __DIR__ . '/config.php';

$distPlatforms = $distPlatforms ?? [
    'Amazon Kindle (UK, EU, US, Canada, Australia, Germany, France, Spain, Italy, Japan, and more)',
    'Apple Books (170+ countries)',
    'Google Play Books (75+ countries)',
    'Kobo (190+ countries)',
    'Barnes &amp; Noble',
    'Scribd',
    'OverDrive (library distribution)',
    '150+ additional retailers worldwide',
];
$distFormats = $distFormats ?? [
    'Kindle eBooks',
    'ePub (Apple Books, Kobo, Google Play)',
    'Print-on-demand paperbacks',
    'Print-on-demand hardcovers',
    'Large print editions',
];

$distEyebrow  = $distEyebrow  ?? 'Global Distribution';
$distTitle    = $distTitle    ?? 'Your book, available <em class="serif-italic">worldwide</em>';
$distIntro    = $distIntro    ?? "Publishing with us means your book is available globally from the moment it goes live. We distribute across every major retailer in every major format, so readers can find and buy your book however they prefer to read, on a Kindle, through Apple Books, in paperback, or in hardcover.";
$distFootnote = $distFootnote ?? 'We handle every upload, every platform requirement, and every technical specification. You manage your book. We manage the logistics.';
$distCtaText  = $distCtaText  ?? 'Publish Globally';
?>
<section class="distribution-section section-paper" id="distribution">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow"><?= safe($distEyebrow) ?></span>
            <h2 class="section-title"><?= $distTitle ?></h2>
            <p><?= safe($distIntro) ?></p>
        </div>

        <div class="dist-grid">
            <div class="dist-card" data-aos="fade-up">
                <h3 class="dist-card-title">
                    <i class="fa-solid fa-globe"></i>
                    Platforms we distribute to
                </h3>
                <ul class="dist-list">
                    <?php foreach ($distPlatforms as $p): ?>
                        <li><i class="fa-solid fa-check"></i><?= $p ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="dist-card" data-aos="fade-up" data-aos-delay="100">
                <h3 class="dist-card-title">
                    <i class="fa-solid fa-book"></i>
                    Available formats
                </h3>
                <ul class="dist-list">
                    <?php foreach ($distFormats as $f): ?>
                        <li><i class="fa-solid fa-check"></i><?= safe($f) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <p class="dist-footnote" data-aos="fade-up"><?= safe($distFootnote) ?></p>

        <div class="text-center mt-4" data-aos="fade-up">
            <a href="#popup" class="btn btn-cta btn-lg" data-popup>
                <?= safe($distCtaText) ?> <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
