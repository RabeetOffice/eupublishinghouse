<?php
require_once __DIR__ . '/config.php';

$aboutEyebrow = $aboutEyebrow ?? 'About Us';
$aboutTitle   = $aboutTitle   ?? 'About <em class="serif-italic">European Publishing House</em>';
$aboutLead    = $aboutLead    ?? "We launched in 2021 because we kept seeing the same problem, brilliant manuscripts that never became books. Not because they weren't good enough, but because traditional publishing is slow, closed-off, and difficult to break into. Self-publishing, on the other hand, can feel like you're building a plane while it's taking off.";
$aboutBody    = $aboutBody    ?? "We built European Publishing House to sit in the middle of those two worlds. Professional-quality publishing, accessible to authors who don't have a literary agent or decades of industry connections. Since then, we've published over 800 books across every genre, working with debut authors and experienced writers alike.";
$aboutBody2   = $aboutBody2   ?? "Our team includes editors with serious experience across fiction and non-fiction, designers who understand what sells in different markets, and publishing specialists who know every step of the process.";

$aboutBullets = $aboutBullets ?? [
    'Senior editors only',
    'Honest, no-pressure quotes',
    'You keep your rights & royalties',
    'Worldwide distribution',
];

$aboutImage    = $aboutImage    ?? 'assets/images/about-image.png';
$aboutChipNum  = $aboutChipNum  ?? '800+';
$aboutChipLbl  = $aboutChipLbl  ?? 'Books published since 2021 across every major genre';
$aboutCtaText  = $aboutCtaText  ?? 'Learn More About Us';
$aboutCtaHref  = $aboutCtaHref  ?? 'about.php';
$aboutCtaPopup = $aboutCtaPopup ?? false;
?>
<section class="about-section section-paper" id="about">
    <div class="container">
        <div class="about-grid">

            <div class="about-image" data-aos="fade-right">
                <img src="<?= safe($aboutImage) ?>" alt="Inside the EU Publishing House editorial studio" loading="lazy" decoding="async">
                <div class="about-image-chip">
                    <div class="num"><?= safe($aboutChipNum) ?></div>
                    <div class="lbl"><?= safe($aboutChipLbl) ?></div>
                </div>
            </div>

            <div class="about-copy" data-aos="fade-left">
                <span class="eyebrow"><?= safe($aboutEyebrow) ?></span>
                <h2 class="section-title"><?= $aboutTitle ?></h2>
                <p class="lead"><?= safe($aboutLead) ?></p>
                <p><?= safe($aboutBody) ?></p>
                <p><?= safe($aboutBody2) ?></p>

                <ul class="about-bullets">
                    <?php foreach ($aboutBullets as $b): ?>
                        <li><i class="fa-solid fa-check"></i><?= safe($b) ?></li>
                    <?php endforeach; ?>
                </ul>

                <a href="<?= safe($aboutCtaHref) ?>" class="btn btn-cta" <?= $aboutCtaPopup ? 'data-popup' : 'data-no-popup' ?>>
                    <?= safe($aboutCtaText) ?> <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

        </div>
    </div>
</section>
