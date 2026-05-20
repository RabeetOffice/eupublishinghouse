<?php
require_once __DIR__ . '/config.php';

$costEyebrow = $costEyebrow ?? 'Pricing';
$costTitle   = $costTitle   ?? 'What does it cost to publish a book in <em class="serif-italic">Europe?</em>';
$costBody    = $costBody    ?? "Publishing costs vary, and honestly, anyone who quotes you a flat rate without reading your manuscript first is guessing. A 40,000-word memoir has different needs than a 100,000-word fantasy novel. A children's picture book is a completely different project to a business guide. Some authors come to us needing the full package, editing, design, formatting, marketing. Others have a finished manuscript and just need distribution. We price based on what your book actually needs, not a generic bundle.";
$costBody2   = $costBody2   ?? "The best thing we can do is have an honest conversation about your book, where it's at, and what it needs to be ready for readers. From there, we'll put together a clear quote with no surprises.";

$costBullets = $costBullets ?? [
    'No flat-rate guessing',
    'Custom quote after manuscript review',
    'Pay only for services you need',
    'No hidden fees, ever',
];

$costImage   = $costImage   ?? 'assets/images/livesite/publishCostsection.jpg';
$costCtaText = $costCtaText ?? 'Get Your Publishing Quote';
$costCtaHref = $costCtaHref ?? '#popup';
?>
<section class="cost-section" id="publishing-cost">
    <div class="container">
        <div class="cost-grid">

            <div class="cost-visual" data-aos="fade-right">
                <img src="<?= safe($costImage) ?>" alt="What it costs to publish a book in Europe" loading="lazy" decoding="async">
                <span class="cost-chip"><i class="fa-solid fa-tag"></i> Transparent &amp; tailored pricing</span>
            </div>

            <div class="cost-copy" data-aos="fade-left">
                <span class="eyebrow"><?= safe($costEyebrow) ?></span>
                <h2 class="section-title"><?= $costTitle ?></h2>
                <p class="lead"><?= safe($costBody) ?></p>
                <p><?= safe($costBody2) ?></p>

                <ul class="about-bullets">
                    <?php foreach ($costBullets as $b): ?>
                        <li><i class="fa-solid fa-check"></i><?= safe($b) ?></li>
                    <?php endforeach; ?>
                </ul>

                <a href="<?= safe($costCtaHref) ?>" class="btn btn-cta btn-lg" data-popup>
                    <?= safe($costCtaText) ?> <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

        </div>
    </div>
</section>
