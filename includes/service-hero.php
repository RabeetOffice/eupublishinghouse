<?php
/**
 * Two-column service-page hero.
 *
 * Set $hero before include:
 *   $hero = [
 *       'crumb'      => 'Publishing',
 *       'title'      => 'H1 <em class="serif-italic">title</em> (HTML allowed)',
 *       'paragraphs' => ['First intro paragraph.', 'Second intro paragraph.'],
 *       'ctas'       => [
 *           ['label' => 'Get Started',  'href' => '#popup',  'class' => 'btn-cta',  'popup' => true],
 *           ['label' => 'View Pricing', 'href' => '#pricing','class' => 'btn-glass'],
 *       ],
 *   ];
 *
 * Deeper pages (e.g. location services) can replace the single 'crumb' with a
 * full trail. Home is always prepended; the last item renders as plain text:
 *   'crumbs' => [
 *       ['label' => 'Locations', 'href' => link_to('locations.php')],
 *       ['label' => 'Ireland',   'href' => link_to('...-in-ireland.php')],
 *       ['label' => 'Book Editing'],
 *   ];
 */
require_once __DIR__ . '/config.php';
$h        = $hero ?? [];
$hCrumb   = $h['crumb']      ?? '';
$hCrumbs  = $h['crumbs']     ?? [];
$hTitle   = $h['title']      ?? '';
$hParas   = $h['paragraphs'] ?? [];
$hCtas    = $h['ctas']       ?? [];
$hImage   = $h['image']      ?? null;

/* A single 'crumb' is just the one-level version of a trail. */
if (!$hCrumbs && $hCrumb) {
    $hCrumbs = [['label' => $hCrumb]];
}
?>
<section class="service-hero">

    <div class="hero-bg" aria-hidden="true">
        <span class="blob blob-1"></span>
        <span class="blob blob-2"></span>
        <svg class="leaf leaf-1" viewBox="0 0 120 200" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M60 10 C 25 60, 25 150, 60 190 C 95 150, 95 60, 60 10 Z" fill="#6CB04C"/>
            <path d="M60 10 L 60 190" stroke="#4F932F" stroke-width="2"/>
        </svg>
    </div>

    <div class="container">
        <div class="service-hero-grid">

            <div class="service-hero-copy">

                <?php if ($hCrumbs): ?>
                    <nav class="breadcrumb-pill" aria-label="Breadcrumb">
                        <a href="<?= link_to('index.php') ?>">
                            <i class="fa-solid fa-house-chimney"></i>
                            Home
                        </a>
                        <?php foreach ($hCrumbs as $c): ?>
                            <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
                            <?php if (!empty($c['href'])): ?>
                                <a href="<?= safe($c['href']) ?>"><?= safe($c['label']) ?></a>
                            <?php else: ?>
                                <span class="current"><?= safe($c['label']) ?></span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </nav>
                <?php endif; ?>

                <h1 class="service-hero__title"><?= $hTitle ?></h1>

                <?php foreach ($hParas as $p): ?>
                    <p class="service-hero__lead"><?= $p ?></p>
                <?php endforeach; ?>

                <?php if (!empty($hCtas)): ?>
                    <div class="hero-cta-row service-hero__ctas">
                        <?php foreach ($hCtas as $cta):
                            $isPopup    = !empty($cta['popup']);
                            $isLiveChat = !empty($cta['livechat']);
                        ?>
                            <a href="<?= safe($cta['href']) ?>"
                               class="btn <?= safe($cta['class'] ?? 'btn-cta') ?> btn-lg"
                               <?= $isLiveChat ? 'data-livechat role="button"' : '' ?>
                               <?= $isPopup ? 'data-popup' : 'data-no-popup' ?>>
                                <?= safe($cta['label']) ?> <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="service-hero-side">
                <?php include __DIR__ . '/forms/quote-card.php'; ?>
            </div>

        </div>
    </div>
</section>
