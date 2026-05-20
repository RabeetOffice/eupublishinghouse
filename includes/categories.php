<?php
require_once __DIR__ . '/config.php';

$categoriesList = $categoriesList ?? [
    ['icon' => 'fa-user-pen',    'label' => 'Memoir & Biography'],
    ['icon' => 'fa-briefcase',   'label' => 'Business & Leadership'],
    ['icon' => 'fa-seedling',    'label' => 'Self-Improvement'],
    ['icon' => 'fa-book-open',   'label' => 'Literary Fiction'],
    ['icon' => 'fa-children',    'label' => 'Children & YA'],
    ['icon' => 'fa-heart-pulse', 'label' => 'Health & Wellness'],
    ['icon' => 'fa-dragon',      'label' => 'Fantasy & Sci-Fi'],
    ['icon' => 'fa-magnifying-glass', 'label' => 'Mystery & Thriller'],
    ['icon' => 'fa-heart',       'label' => 'Romance'],
    ['icon' => 'fa-landmark',    'label' => 'History & Culture'],
    ['icon' => 'fa-graduation-cap','label' => 'Academic'],
    ['icon' => 'fa-feather',     'label' => 'Poetry & Essays'],
];
$categoriesEyebrow = $categoriesEyebrow ?? 'Most-Requested';
$categoriesTitle   = $categoriesTitle   ?? 'Book categories we <em class="serif-italic">specialise in</em>';
$categoriesIntro   = $categoriesIntro   ?? null;
?>
<section class="categories-section" id="categories">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow"><?= safe($categoriesEyebrow) ?></span>
            <h2 class="section-title"><?= $categoriesTitle ?></h2>
            <?php if ($categoriesIntro): ?><p><?= safe($categoriesIntro) ?></p><?php endif; ?>
        </div>

        <div class="categories-grid">
            <?php foreach ($categoriesList as $i => $c): ?>
                <article class="category-card" data-aos="fade-up" data-aos-delay="<?= ($i % 6) * 50 ?>">
                    <span class="ic"><i class="fa-solid <?= safe($c['icon']) ?>"></i></span>
                    <h3><?= safe($c['label']) ?></h3>
                </article>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="#popup" class="btn btn-cta btn-lg" data-popup>
                Publish in your genre <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
