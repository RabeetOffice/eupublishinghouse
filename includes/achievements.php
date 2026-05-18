<?php require_once __DIR__ . '/config.php';
$awards = [
    ['n' => 47,  'suffix' => '',  'label' => 'Industry Awards'],
    ['n' => 12,  'suffix' => '',  'label' => 'Bestseller Lists'],
    ['n' => 9,  'suffix' => 'M', 'label' => 'Copies Sold'],
    ['n' => 38,  'suffix' => '',  'label' => 'Languages Licensed'],
];
?>
<section class="achievements-section" id="achievements">
    <div class="container">
        <div class="achievements-inner" data-aos="zoom-in">
            <div class="achievements-head">
                <span class="eyebrow">Recognition</span>
                <h2 class="section-title">A decade of <em class="gold-italic">quiet</em> milestones.</h2>
            </div>
            <div class="row g-0 achievements-row">
                <?php foreach ($awards as $i => $a): ?>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
                    <div class="achievement">
                        <div class="achievement-num">
                            <span class="count-up" data-target="<?= $a['n'] ?>">0</span><span class="achievement-suffix"><?= $a['suffix'] ?></span>
                        </div>
                        <span class="achievement-label"><?= safe($a['label']) ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
