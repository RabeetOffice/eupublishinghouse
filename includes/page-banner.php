<?php
/**
 * Reusable inner-page banner.
 *
 * Set $banner before include:
 *   $banner = [
 *       'crumb' => 'Page name',         // breadcrumb label (required)
 *       'title' => 'Title HTML',        // h1 (required)
 *       'sub'   => 'Optional subhead',  // p (optional)
 *   ];
 */
require_once __DIR__ . '/config.php';
$b = $banner ?? [];
$crumb = $b['crumb'] ?? '';
$title = $b['title'] ?? '';
$sub   = $b['sub']   ?? '';
?>
<section class="page-banner">
    <div class="hero-bg" aria-hidden="true">
        <span class="blob blob-1"></span>
        <span class="blob blob-2"></span>
        <svg class="leaf leaf-1" viewBox="0 0 120 200" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M60 10 C 25 60, 25 150, 60 190 C 95 150, 95 60, 60 10 Z" fill="#6CB04C"/>
            <path d="M60 10 L 60 190" stroke="#4F932F" stroke-width="2"/>
        </svg>
        <svg class="leaf leaf-2" viewBox="0 0 120 200" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M60 10 C 25 60, 25 150, 60 190 C 95 150, 95 60, 60 10 Z" fill="#1B5340"/>
            <path d="M60 10 L 60 190" stroke="#0F3E2E" stroke-width="2"/>
        </svg>
    </div>

    <div class="container page-banner__inner">

        <?php if ($crumb): ?>
            <nav class="breadcrumb-pill" aria-label="Breadcrumb">
                <a href="index.php">
                    <i class="fa-solid fa-house-chimney"></i>
                    Home
                </a>
                <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
                <span class="current"><?= safe($crumb) ?></span>
            </nav>
        <?php endif; ?>

        <h1 class="page-title"><?= $title ?></h1>

        <?php if ($sub): ?>
            <p class="page-sub"><?= $sub ?></p>
        <?php endif; ?>
    </div>
</section>
