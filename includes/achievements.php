<?php
require_once __DIR__ . '/config.php';

$awards = $awards ?? [
    ['n' => 4.9, 'suffix' => '',   'label' => 'Average rating on Google'],
    ['n' => 800, 'suffix' => '+',  'label' => 'Authors published'],
    ['n' => 25,  'suffix' => 'k+', 'label' => 'Reader community'],
    ['n' => 35,  'suffix' => '+',  'label' => 'Countries published in'],
];
?>
<section class="achievements" id="achievements">
    <div class="container">
        <div class="achievements-card" data-aos="fade-up">
            <?php foreach ($awards as $i => $a): ?>
                <div class="achievement">
                    <div class="achievement-num">
                        <span class="count-up" data-target="<?= safe((string)$a['n']) ?>">0</span><span class="achievement-suffix"><?= safe($a['suffix']) ?></span>
                    </div>
                    <div class="achievement-label"><?= safe($a['label']) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
