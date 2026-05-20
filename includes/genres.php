<?php require_once __DIR__ . '/config.php';
$genres = [
    [
        'tag'   => 'Fiction',
        'title' => 'Literary &<br>Genre Fiction',
        'desc'  => 'Novels that linger long after the last page, from quiet literary studies to commercial thrillers and romance.',
        'list'  => ['Literary Fiction', 'Mystery & Thriller', 'Romance', 'Fantasy & Sci-Fi'],
        'art'   => 'fiction',
    ],
    [
        'tag'   => 'Non-Fiction',
        'title' => 'Memoir, Business<br>& Self-Discovery',
        'desc'  => 'Stories rooted in real life, designed to inspire, inform and challenge a discerning readership.',
        'list'  => ['Memoir & Biography', 'Business & Leadership', 'Self-Improvement', 'History & Culture'],
        'art'   => 'nonfiction',
    ],
    [
        'tag'   => 'Specialist',
        'title' => 'Children, Poetry<br>& Academic',
        'desc'  => 'Specialist imprints crafted with the same care as our flagship list, for younger readers and scholarly audiences.',
        'list'  => ['Children & YA', 'Poetry & Essays', 'Academic & Reference', 'Coffee-Table Editions'],
        'art'   => 'specialist',
    ],
];
?>
<section class="genres-section" id="genres">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">What We Publish</span>
            <h2 class="section-title">Three pillars. One commitment to <em class="gold-italic">craft.</em></h2>
            <p class="section-lead">Our editorial scope is intentionally narrow and deeply specialist, every imprint shares the same uncompromising standards of writing, design and distribution.</p>
        </div>

        <div class="row g-4 mt-2">
            <?php foreach ($genres as $i => $g): ?>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= $i * 120 ?>">
                <article class="genre-card genre-art--<?= $g['art'] ?>">
                    <span class="genre-tag"><?= safe($g['tag']) ?></span>
                    <h3 class="genre-title"><?= $g['title'] ?></h3>
                    <p class="genre-desc"><?= safe($g['desc']) ?></p>
                    <ul class="genre-list" role="list">
                        <?php foreach ($g['list'] as $item): ?>
                            <li><i class="fa-solid fa-feather"></i><?= safe($item) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="portfolios.php" class="genre-link">
                        Explore titles <i class="fa-solid fa-arrow-right"></i>
                    </a>
                    <span class="genre-glow" aria-hidden="true"></span>
                </article>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
