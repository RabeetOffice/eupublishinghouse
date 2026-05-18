<?php require_once __DIR__ . '/config.php';
$blocks = [
    [
        'eyebrow' => 'Editorial Integrity',
        'title'   => 'Senior editors. <em class="gold-italic">Every</em> manuscript.',
        'desc'    => 'No outsourced reads. No automated copy-checks. Every manuscript is shepherded by an editor who has spent at least a decade in the industry.',
        'list'    => ['Personally read by a senior editor', 'Structural & line edit included', 'Author-led revision rounds'],
        'art'     => 'editorial',
    ],
    [
        'eyebrow' => 'Design Studio',
        'title'   => 'Covers crafted like <em class="gold-italic">posters</em>.',
        'desc'    => 'Our in-house art directors approach every cover as a standalone object — typography, illustration and finish chosen for shelf presence and longevity.',
        'list'    => ['Bespoke cover direction', 'Premium finishes & foiling', 'Print and ebook parity'],
        'art'     => 'design',
    ],
    [
        'eyebrow' => 'Global Reach',
        'title'   => 'Distributed in <em class="gold-italic">25+ countries</em>.',
        'desc'    => 'Our distribution partners place your book on the shelves of independent bookshops, chains and major online retailers across the world.',
        'list'    => ['Amazon Kindle • Apple • Kobo', 'Independent bookshops', 'Print on demand + offset'],
        'art'     => 'global',
    ],
];
?>
<section class="why-section" id="why">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Why Choose Us</span>
            <h2 class="section-title">Built around the <em class="gold-italic">author.</em></h2>
        </div>

        <?php foreach ($blocks as $i => $b):
            $reverse = $i % 2 === 1;
        ?>
        <div class="why-row <?= $reverse ? 'why-row--reverse' : '' ?>">
            <div class="why-art why-art--<?= $b['art'] ?>" data-aos="fade-<?= $reverse ? 'left' : 'right' ?>">
                <span class="why-art__inner"></span>
                <span class="why-art__chip"><?= safe($b['eyebrow']) ?></span>
            </div>
            <div class="why-copy" data-aos="fade-<?= $reverse ? 'right' : 'left' ?>">
                <span class="eyebrow"><?= safe($b['eyebrow']) ?></span>
                <h3 class="why-title"><?= $b['title'] ?></h3>
                <p class="why-desc"><?= safe($b['desc']) ?></p>
                <ul class="why-list" role="list">
                    <?php foreach ($b['list'] as $item): ?>
                        <li><i class="fa-solid fa-check"></i><?= safe($item) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>
