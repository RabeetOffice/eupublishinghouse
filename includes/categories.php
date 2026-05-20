<?php
require_once __DIR__ . '/config.php';

$categoriesList = $categoriesList ?? [
    ['icon' => 'fa-user-pen',     'label' => 'Memoirs & Autobiographies'],
    ['icon' => 'fa-briefcase',    'label' => 'Business and Leadership'],
    ['icon' => 'fa-seedling',     'label' => 'Self-Help'],
    ['icon' => 'fa-book-open',    'label' => 'Fiction'],
    ['icon' => 'fa-children',     'label' => "Children's Book"],
    ['icon' => 'fa-heart-pulse',  'label' => 'Health and Lifestyle'],
];
$categoriesEyebrow = $categoriesEyebrow ?? 'Top Categories';
$categoriesTitle   = $categoriesTitle   ?? 'Most-requested <em class="serif-italic">book categories</em>';
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
