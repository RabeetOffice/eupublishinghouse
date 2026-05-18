<?php require_once __DIR__ . '/config.php';
$services = [
    ['icon' => 'fa-book',         'title' => 'Book Publishing',  'desc' => 'End-to-end publishing — from manuscript to global launch — under our flagship imprint.'],
    ['icon' => 'fa-pen-fancy',    'title' => 'Editing',          'desc' => 'Developmental, copy and proofreading editing handled by senior literary editors.'],
    ['icon' => 'fa-feather',      'title' => 'Ghostwriting',     'desc' => 'Long-form ghostwriting partnerships built around your voice, not ours.'],
    ['icon' => 'fa-palette',      'title' => 'Cover Design',     'desc' => 'Posters for the shelf — direction-led design with premium finishes and typography.'],
    ['icon' => 'fa-align-left',   'title' => 'Formatting',       'desc' => 'European-grade interior typesetting for print, e-book and audio editions.'],
    ['icon' => 'fa-bullhorn',     'title' => 'Marketing & PR',   'desc' => 'Author-publicist pairings, press placements and considered digital launches.'],
];
?>
<section class="services-section" id="services">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Author Services</span>
            <h2 class="section-title">A full editorial <em class="gold-italic">studio</em> behind every book.</h2>
            <p class="section-lead">Use one service or commission the entire pipeline. We are equally at home publishing a debut novel or producing a single-edition coffee-table volume.</p>
        </div>

        <div class="row g-4 mt-2">
            <?php foreach ($services as $i => $s): ?>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= $i * 80 ?>">
                <article class="service-card">
                    <span class="service-icon"><i class="fa-solid <?= $s['icon'] ?>"></i></span>
                    <h3 class="service-title"><?= safe($s['title']) ?></h3>
                    <p class="service-desc"><?= safe($s['desc']) ?></p>
                    <a href="services.php" class="service-link">Learn more <i class="fa-solid fa-arrow-right"></i></a>
                    <span class="service-glow" aria-hidden="true"></span>
                </article>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
