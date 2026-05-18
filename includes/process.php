<?php require_once __DIR__ . '/config.php';
$steps = [
    ['n' => '01', 'icon' => 'fa-pen-nib',  'title' => 'Manuscript Submission', 'desc' => 'You submit your manuscript through our editorial portal. A senior editor reads every word personally.'],
    ['n' => '02', 'icon' => 'fa-feather',  'title' => 'Editorial Partnership', 'desc' => 'We pair you with the right structural and line editor. We refine voice, pace and intent — never overwrite it.'],
    ['n' => '03', 'icon' => 'fa-palette',  'title' => 'Design & Production',   'desc' => 'Type-set in fine European traditions. Cover art directed by our in-house design studio.'],
    ['n' => '04', 'icon' => 'fa-globe',    'title' => 'Launch & Distribution', 'desc' => 'Print, e-book and audio rolled out across 25+ countries. Marketing led by a dedicated publicist.'],
];
?>
<section class="process-section" id="process">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">The Editorial Journey</span>
            <h2 class="section-title">From manuscript to <em class="gold-italic">masterpiece.</em></h2>
            <p class="section-lead">Four considered stages — every one led by humans, not pipelines.</p>
        </div>

        <div class="process-grid">
            <?php foreach ($steps as $i => $s): ?>
            <article class="process-card" data-aos="fade-up" data-aos-delay="<?= $i * 120 ?>">
                <span class="process-n"><?= safe($s['n']) ?></span>
                <i class="fa-solid <?= $s['icon'] ?> process-icon"></i>
                <h3 class="process-title"><?= safe($s['title']) ?></h3>
                <p class="process-desc"><?= safe($s['desc']) ?></p>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
