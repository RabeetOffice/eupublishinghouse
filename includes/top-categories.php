<?php
/** Reusable "Top Categories" block used on service pages and About. */
require_once __DIR__ . '/config.php';

$_topCategories = [
    ['icon' => 'fa-user-pen',    'label' => 'Memoirs &amp; Autobiographies'],
    ['icon' => 'fa-briefcase',   'label' => 'Business Books'],
    ['icon' => 'fa-children',    'label' => "Children's Books"],
    ['icon' => 'fa-book-open',   'label' => 'Fiction'],
    ['icon' => 'fa-newspaper',   'label' => 'Non-Fiction'],
    ['icon' => 'fa-seedling',    'label' => 'Self Help'],
];
?>
<section class="top-cats-sec" id="top-categories">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Most-Requested</span>
            <h2 class="section-title">Top <em class="gold-italic">Categories</em></h2>
        </div>
        <div class="row g-4">
            <?php foreach ($_topCategories as $i => $c): ?>
            <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="<?= $i * 70 ?>">
                <article class="top-cat-card">
                    <span class="top-cat-card__icon"><i class="fa-solid <?= safe($c['icon']) ?>"></i></span>
                    <h3 class="top-cat-card__label"><?= $c['label'] ?></h3>
                </article>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
