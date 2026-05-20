<?php
require_once __DIR__ . '/config.php';

$aboutEyebrow = $aboutEyebrow ?? 'About the House';
$aboutTitle   = $aboutTitle   ?? 'A publisher built for authors who <em class="serif-italic">mean it</em>';
$aboutLead    = $aboutLead    ?? "We launched in 2021 because brilliant manuscripts kept slipping through the cracks of traditional publishing. Not because they weren't good enough, but because the gates were closed. We built " . WEBSITE_NAME . " to sit between traditional and self-publishing, professional, accessible, author-led.";
$aboutBody    = $aboutBody    ?? "Since then we've helped authors publish over 800 books across every genre, working with debut writers and experienced authors alike. Our team includes editors with serious publishing experience, designers who understand what sells, and publishing specialists who know every step of the process.";

$aboutBullets = $aboutBullets ?? [
    'Senior editors only',
    'Honest, no-pressure quotes',
    'You keep your rights & royalties',
    'Worldwide distribution',
];

$aboutImage    = $aboutImage    ?? 'assets/images/about-image.png';
$aboutChipNum  = $aboutChipNum  ?? '800+';
$aboutChipLbl  = $aboutChipLbl  ?? 'Books published since 2021 across every major genre';
$aboutCtaText  = $aboutCtaText  ?? 'Get your publishing quote';
$aboutCtaHref  = $aboutCtaHref  ?? '#popup';
$aboutCtaPopup = $aboutCtaPopup ?? true;
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

                <ul class="about-bullets">
                    <?php foreach ($aboutBullets as $b): ?>
                        <li><i class="fa-solid fa-check"></i><?= safe($b) ?></li>
                    <?php endforeach; ?>
                </ul>

                <a href="<?= safe($aboutCtaHref) ?>" class="btn btn-cta" <?= $aboutCtaPopup ? 'data-popup' : '' ?>>
                    <?= safe($aboutCtaText) ?> <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

        </div>
    </div>
</section>
