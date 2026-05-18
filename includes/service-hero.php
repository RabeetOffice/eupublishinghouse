<?php
/**
 * Two-column service-page hero.
 *
 * Set $hero before include:
 *   $hero = [
 *       'crumb'      => 'Publishing',
 *       'eyebrow'    => 'Book Publishing',
 *       'title'      => 'H1 <em class="gold-italic">title</em> (HTML allowed)',
 *       'paragraphs' => ['First intro paragraph.', 'Second intro paragraph.'],
 *       'ctas'       => [
 *           ['label' => 'Get Started',    'href' => 'contact.php#submit', 'class' => 'btn-cta'],
 *           ['label' => 'View Pricing',   'href' => '#pricing',           'class' => 'btn-outline-dark'],
 *       ],
 *   ];
 */
require_once __DIR__ . '/config.php';
$h = $hero ?? [];
$hCrumb    = $h['crumb']      ?? '';
$hEyebrow  = $h['eyebrow']    ?? '';
$hTitle    = $h['title']      ?? '';
$hParas    = $h['paragraphs'] ?? [];
$hCtas     = $h['ctas']       ?? [];
?>
<section class="service-hero">
    <div class="service-hero__bg" aria-hidden="true">
        <span class="bg-shape bg-shape--arch-left"></span>
        <span class="bg-shape bg-shape--arch-right"></span>
        <span class="paper-grain"></span>
    </div>
    <div class="container service-hero__inner">
        <div class="row g-5 align-items-center">

            <!-- Left: copy + CTAs -->
            <div class="col-lg-6 service-hero__copy" data-aos="fade-right">
                <?php if ($hCrumb): ?>
                <nav class="crumbs service-hero__crumbs" aria-label="Breadcrumb">
                    <a href="index.php">Home</a>
                    <i class="fa-solid fa-chevron-right"></i>
                    <span><?= safe($hCrumb) ?></span>
                </nav>
                <?php endif; ?>

                <?php if ($hEyebrow): ?>
                    <span class="eyebrow eyebrow--pill"><?= safe($hEyebrow) ?></span>
                <?php endif; ?>

                <h1 class="service-hero__title"><?= $hTitle ?></h1>

                <?php foreach ($hParas as $p): ?>
                    <p class="service-hero__lead"><?= $p ?></p>
                <?php endforeach; ?>

                <?php if (!empty($hCtas)): ?>
                <div class="hero-cta-row service-hero__ctas">
                    <?php foreach ($hCtas as $cta): ?>
                        <a href="<?= safe($cta['href']) ?>" class="btn <?= safe($cta['class'] ?? 'btn-cta') ?> btn-lg" data-no-popup>
                            <?= safe($cta['label']) ?> <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Right: quote-card form -->
            <div class="col-lg-6">
                <?php include __DIR__ . '/forms/quote-card.php'; ?>
            </div>
        </div>
    </div>
</section>
