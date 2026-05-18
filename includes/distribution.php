<?php require_once __DIR__ . '/config.php';
$partners = [
    ['label' => 'Amazon Kindle',    'icon' => 'fa-brands fa-amazon'],
    ['label' => 'Apple Books',      'icon' => 'fa-brands fa-apple'],
    ['label' => 'Kobo',             'icon' => 'fa-solid fa-book-bookmark'],
    ['label' => 'Google Play Books','icon' => 'fa-brands fa-google-play'],
    ['label' => 'Barnes & Noble',   'icon' => 'fa-solid fa-book-open-reader'],
    ['label' => 'Waterstones',      'icon' => 'fa-solid fa-store'],
];
?>
<section class="distribution-section" id="distribution">
    <div class="dist-map" aria-hidden="true">
        <span class="dist-glow"></span>
    </div>
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Global Distribution</span>
            <h2 class="section-title">On shelves &amp; screens in <em class="gold-italic">25+ countries.</em></h2>
            <p class="section-lead">Our titles ship through the world's leading retailers, libraries and independent bookstores.</p>
        </div>

        <ul class="partners-grid" data-aos="fade-up" data-aos-delay="120">
            <?php foreach ($partners as $p): ?>
            <li class="partner">
                <i class="<?= $p['icon'] ?>"></i>
                <span><?= safe($p['label']) ?></span>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
