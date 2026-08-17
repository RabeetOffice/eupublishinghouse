<?php
/* =================================================================
   SHARED "COMPLETE BOOK PUBLISHING SERVICES" BLOCK

   Every location service page closes with the same six-service summary
   (the copy is identical in all the content briefs), so it lives here
   once and is driven from includes/locations-data.php.

   Each card links across to that location's sibling page, which is what
   ties the cluster together. The card for the page you are already on
   renders without a link instead of pointing at itself.

   Set before include:
     $coreLocation , location key           (default 'ireland')
     $coreCurrent  , service key of THIS page, so it doesn't self-link
     $coreEyebrow  , small label above the heading
     $coreTitle    , H2 (HTML allowed — the brief's wording differs per page)
     $coreIntro    , lead paragraph
================================================================= */

require_once __DIR__ . '/locations-data.php';

$coreLocation = $coreLocation ?? 'ireland';
$coreCurrent  = $coreCurrent  ?? null;
$_coreLoc     = location_get($coreLocation);
$_coreItems   = $_coreLoc['services'] ?? [];

$coreEyebrow  = $coreEyebrow ?? 'Everything Under One Roof';
$coreTitle    = $coreTitle   ?? 'Complete book publishing services for <em class="serif-italic">authors</em>';
$coreIntro    = $coreIntro   ?? 'We provide complete book publishing solutions to help authors turn their ideas and manuscripts into professionally published books. From writing and editing to design, formatting, publishing, and promotion, every service is managed with care and attention. Our team supports authors at every stage while maintaining the quality, purpose, and originality of their work.';
?>
<!-- ============================================================
     COMPLETE SERVICES — cross-links across the location cluster
     ============================================================ -->
<section class="services-section loc-core-sec" id="all-services">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow"><?= safe($coreEyebrow) ?></span>
            <h2 class="section-title"><?= $coreTitle ?></h2>
            <p><?= safe($coreIntro) ?></p>
        </div>

        <div class="services-grid">
            <?php foreach ($_coreItems as $key => $s):
                $isCurrent = ($key === $coreCurrent);
            ?>
                <article class="service-card <?= $isCurrent ? 'is-current' : '' ?>" data-aos="fade-up" data-aos-delay="<?= (array_search($key, array_keys($_coreItems), true) % 3) * 80 ?>">
                    <span class="service-icon"><i class="fa-solid <?= safe($s['icon']) ?>"></i></span>
                    <h3 class="service-title"><?= safe($s['core_title']) ?></h3>
                    <p class="service-desc"><?= $s['core_desc'] ?></p>
                    <?php if ($isCurrent): ?>
                        <span class="service-link is-current-label">
                            <i class="fa-solid fa-location-crosshairs"></i> You’re on this page
                        </span>
                    <?php else: ?>
                        <a href="<?= safe(link_to($s['href'])) ?>" class="service-link" data-no-popup>
                            <?= safe($s['title']) ?> <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="<?= safe(location_url($coreLocation)) ?>" class="btn btn-glass btn-lg" data-no-popup>
                All <?= safe($_coreLoc['name'] ?? '') ?> services <i class="fa-solid fa-arrow-right"></i>
            </a>
            <a href="#popup" class="btn btn-cta btn-lg" data-popup>
                Get a Free Quote <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
