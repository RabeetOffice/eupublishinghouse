<?php
require_once __DIR__ . '/config.php';

$whyEyebrow = $whyEyebrow ?? 'Why Authors Choose Us';
$whyTitle   = $whyTitle   ?? 'Built around the <em class="serif-italic">author</em>, not the platform';
$whyLead    = $whyLead    ?? 'We\'re not a publishing mill. Every manuscript gets read, edited, designed and launched by a real person who genuinely wants it to succeed.';

$whyFeatures = $whyFeatures ?? [
    ['icon' => 'fa-check', 'title' => 'You keep your rights',   'desc' => '100% creative ownership, always. Royalties paid in full.'],
    ['icon' => 'fa-check', 'title' => 'Senior editors only',     'desc' => 'No outsourced reads. Real publishing experience, real attention.'],
    ['icon' => 'fa-check', 'title' => 'Transparent pricing',     'desc' => 'No hidden fees. Quote on what your book actually needs.'],
    ['icon' => 'fa-check', 'title' => 'Honest editorial advice', 'desc' => 'We\'ll tell you if your manuscript isn\'t ready, then help fix it.'],
    ['icon' => 'fa-check', 'title' => 'Global distribution',     'desc' => 'Amazon, Apple, Kobo, Google Play, IngramSpark, all of it.'],
    ['icon' => 'fa-check', 'title' => 'Post-launch support',     'desc' => 'We stay with you after publication, not just until the invoice clears.'],
];

$whyStats = $whyStats ?? [
    ['n' => '800+', 'l' => 'Books published'],
    ['n' => '4.9',  'l' => 'Author rating'],
    ['n' => '35+',  'l' => 'Countries reached'],
    ['n' => '150+', 'l' => 'Retail partners'],
];

$whyImage   = $whyImage   ?? 'assets/images/livesite/AuthorChoose.jpg';
$whyCtaText = $whyCtaText ?? 'Work With Us';
$whyCtaHref = $whyCtaHref ?? '#popup';
?>
<section class="why-section" id="why">
    <div class="container">
        <div class="why-grid">
            <div class="why-visual" data-aos="fade-right">
                <img src="<?= safe($whyImage) ?>" alt="Author-first publishing at EU Publishing House" loading="lazy" decoding="async">
                <div class="why-stats">
                    <?php foreach ($whyStats as $s): ?>
                        <div class="stat">
                            <div class="n"><?= safe($s['n']) ?></div>
                            <div class="l"><?= safe($s['l']) ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="why-copy" data-aos="fade-left">
                <span class="eyebrow"><?= safe($whyEyebrow) ?></span>
                <h2 class="section-title"><?= $whyTitle ?></h2>
                <p class="lead"><?= safe($whyLead) ?></p>

                <ul class="why-features">
                    <?php foreach ($whyFeatures as $f): ?>
                        <li>
                            <i class="fa-solid <?= safe($f['icon']) ?>"></i>
                            <div>
                                <b><?= safe($f['title']) ?></b>
                                <span><?= safe($f['desc']) ?></span>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <a href="<?= safe($whyCtaHref) ?>" class="btn btn-cta" data-popup>
                    <?= safe($whyCtaText) ?> <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>
