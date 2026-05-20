<?php
/**
 * Reusable "Other Services We Offer" cross-promo block for service pages.
 * Caller may set $exclude_slug = 'publishing' (or any slug) to skip its own card.
 */
require_once __DIR__ . '/config.php';

$exclude = $exclude_slug ?? '';

$_otherServices = [
    'publishing'   => ['icon' => 'fa-book',       'label' => 'Book Publishing',   'url' => 'publishing.php',   'desc' => 'We publish books across major platforms including Amazon KDP, IngramSpark and global retailers.'],
    'editing'      => ['icon' => 'fa-pen-fancy',  'label' => 'Book Editing',      'url' => 'editing.php',      'desc' => 'Developmental, line, copy editing and proofreading from editors with real publishing experience.'],
    'ghostwriting' => ['icon' => 'fa-feather',    'label' => 'Ghostwriting',      'url' => 'ghostwriting.php', 'desc' => 'Confidential ghostwriting across every genre, you keep 100% of the rights.'],
    'design'       => ['icon' => 'fa-palette',    'label' => 'Book Cover Design', 'url' => 'design.php',       'desc' => 'Custom covers built from scratch for fiction, non-fiction, children\'s and academic titles.'],
    'formatting'   => ['icon' => 'fa-align-left', 'label' => 'Book Formatting',   'url' => 'formatting.php',   'desc' => 'Print-ready PDFs, ePub, MOBI and KDP files built to every platform\'s exact specifications.'],
    'marketing'    => ['icon' => 'fa-bullhorn',   'label' => 'Book Marketing',    'url' => 'marketing.php',    'desc' => 'Amazon optimisation, paid ads, social, author branding and launch planning.'],
];
?>
<section class="services-section" id="other-services">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Author Services</span>
            <h2 class="section-title">Other services <em class="serif-italic">we offer</em></h2>
            <p>Most authors need more than one service. Here is everything else we can help you with.</p>
        </div>

        <div class="services-grid">
            <?php $i = 0; foreach ($_otherServices as $slug => $svc):
                if ($slug === $exclude) continue; ?>
                <article class="service-card" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 80 ?>">
                    <span class="service-icon"><i class="fa-solid <?= safe($svc['icon']) ?>"></i></span>
                    <h3 class="service-title"><?= safe($svc['label']) ?></h3>
                    <p class="service-desc"><?= safe($svc['desc']) ?></p>
                    <a href="<?= safe($svc['url']) ?>" class="service-link" data-no-popup>
                        Learn more <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </article>
            <?php $i++; endforeach; ?>
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="#popup" class="btn btn-cta btn-lg" data-popup>
                Get a free quote <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
