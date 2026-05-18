<?php
/**
 * Reusable inner-page banner.
 *
 * Set $banner before include:
 *   $banner = [
 *       'crumb'   => 'Page name',
 *       'eyebrow' => 'Eyebrow pill text',
 *       'title'   => 'Title (HTML allowed)',
 *       'sub'     => 'Optional subhead',
 *   ];
 */
require_once __DIR__ . '/config.php';
$b = $banner ?? [];
?>
<section class="page-banner">
    <div class="page-banner__bg" aria-hidden="true">
        <span class="bg-shape bg-shape--arch-left"></span>
        <span class="bg-shape bg-shape--arch-right"></span>
        <span class="paper-grain"></span>
    </div>
    <div class="container page-banner__inner">

        <!-- Breadcrumb pinned to the top of the banner -->
        <nav class="crumbs page-banner__crumbs" aria-label="Breadcrumb">
            <a href="index.php">Home</a>
            <i class="fa-solid fa-chevron-right"></i>
            <span><?= safe($b['crumb'] ?? '') ?></span>
        </nav>

        <!-- Title block pinned to the bottom of the banner -->
        <div class="page-banner__content">
            <?php if (!empty($b['eyebrow'])): ?>
                <span class="eyebrow eyebrow--pill" data-aos="fade-up"><?= safe($b['eyebrow']) ?></span>
            <?php endif; ?>
            <h1 class="page-title" data-aos="fade-up" data-aos-delay="80"><?= $b['title'] ?? '' ?></h1>
            <?php if (!empty($b['sub'])): ?>
                <p class="page-sub" data-aos="fade-up" data-aos-delay="160"><?= safe($b['sub']) ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>
