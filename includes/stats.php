<?php require_once __DIR__ . '/config.php';
$stats = [
    ['icon' => 'fa-book',    'count' => 800, 'suffix' => '+', 'label' => 'Books Published',  'note' => 'Across every genre & specialism'],
    ['icon' => 'fa-globe',   'count' => 25,  'suffix' => '+', 'label' => 'Countries Reached', 'note' => 'A truly global readership'],
    ['icon' => 'fa-star',    'count' => 4.9, 'suffix' => '',  'label' => 'Author Rating',    'note' => 'From verified author reviews'],
    ['icon' => 'fa-feather', 'count' => 150, 'suffix' => '+', 'label' => 'Authors Published','note' => 'Debut to international bestseller'],
];
?>
<section class="stats-section" id="stats">
    <div class="container">
        <div class="stats-head" data-aos="fade-up">
            <span class="eyebrow">By the Numbers</span>
            <h2 class="section-title">A house built on quiet excellence.</h2>
        </div>

        <div class="row stats-row g-0">
            <?php foreach ($stats as $i => $s): ?>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="<?= $i * 90 ?>">
                <div class="stat-card">
                    <i class="fa-solid <?= $s['icon'] ?> stat-icon" aria-hidden="true"></i>
                    <div class="stat-count">
                        <span class="count-up" data-target="<?= $s['count'] ?>"><?= $s['count'] ?></span><span class="stat-suffix"><?= $s['suffix'] ?></span>
                    </div>
                    <h3 class="stat-label"><?= safe($s['label']) ?></h3>
                    <p class="stat-note"><?= safe($s['note']) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
