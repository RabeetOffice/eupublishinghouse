<?php
require_once __DIR__ . '/config.php';

$ctaEyebrow   = $ctaEyebrow   ?? 'Ready to Begin?';
$ctaTitle     = $ctaTitle     ?? "We're invested in your <em class=\"serif-italic\">book's success</em>";
$ctaSub       = $ctaSub       ?? "Every book we publish gets the same level of care, whether it's your first or your fifth. We don't consider our job done until your book is out in the world and you're happy with it. That's been our standard since day one.";
$ctaPrimary   = $ctaPrimary   ?? ['label' => 'Start Publishing With Confidence', 'href' => '#popup', 'class' => 'btn btn-gold btn-lg', 'popup' => true];
$ctaSecondary = $ctaSecondary ?? ['label' => 'Book a free call', 'href' => link_to('contact.php'), 'class' => 'btn btn-outline-light btn-lg', 'icon' => 'fa-comments'];

$ctaPerks = $ctaPerks ?? [
    ['icon' => 'fa-feather', 'title' => 'Free manuscript review', 'desc' => 'Read by a senior editor, no auto-screening.'],
    ['icon' => 'fa-shield',  'title' => 'You keep your rights',   'desc' => '100% royalties and creative ownership.'],
    ['icon' => 'fa-globe',   'title' => 'Worldwide distribution', 'desc' => 'Amazon, Apple, Kobo and 150+ retailers.'],
];
?>
<section class="final-cta-section" id="final-cta">
    <div class="final-cta-band" data-aos="fade-up">
        <i class="fa-solid fa-feather floating-leaf floating-leaf--1" aria-hidden="true"></i>
        <i class="fa-solid fa-feather floating-leaf floating-leaf--2" aria-hidden="true"></i>

        <div class="final-cta-inner">
            <div class="final-cta-copy">
                <span class="eyebrow eyebrow--light"><?= safe($ctaEyebrow) ?></span>
                <h2 class="final-cta-title"><?= $ctaTitle ?></h2>
                <p class="final-cta-sub"><?= safe($ctaSub) ?></p>

                <div class="final-cta-row">
                    <a href="<?= safe($ctaPrimary['href']) ?>"
                       class="<?= safe($ctaPrimary['class']) ?>"
                       <?= !empty($ctaPrimary['popup']) ? 'data-popup' : '' ?>>
                        <?= safe($ctaPrimary['label']) ?> <i class="fa-solid fa-arrow-right"></i>
                    </a>
                    <?php if (!empty($ctaSecondary)): ?>
                        <a href="<?= safe($ctaSecondary['href']) ?>" class="<?= safe($ctaSecondary['class']) ?>" data-no-popup>
                            <?php if (!empty($ctaSecondary['icon'])): ?><i class="fa-solid <?= safe($ctaSecondary['icon']) ?>"></i><?php endif; ?>
                            <?= safe($ctaSecondary['label']) ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="final-cta-side">
                <?php foreach ($ctaPerks as $p): ?>
                    <div class="final-cta-perk">
                        <i class="fa-solid <?= safe($p['icon']) ?>"></i>
                        <div>
                            <strong><?= safe($p['title']) ?></strong>
                            <span><?= safe($p['desc']) ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
