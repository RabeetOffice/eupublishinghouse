<?php
require_once __DIR__ . '/config.php';

$processSteps = $processSteps ?? [
    ['n' => '01', 'icon' => 'fa-comments',   'title' => 'Free Consultation',
        'desc' => 'Send your manuscript. A senior editor reads it personally and replies with a clear plan, budget and timeline.'],
    ['n' => '02', 'icon' => 'fa-pen-nib',    'title' => 'Professional Editing',
        'desc' => 'Developmental, copy editing or proofreading, every change tracked and explained, paced to your manuscript.'],
    ['n' => '03', 'icon' => 'fa-palette',    'title' => 'Custom Cover Design',
        'desc' => 'Multiple concepts, unlimited refinements, files sized for every retailer your book will sell on.'],
    ['n' => '04', 'icon' => 'fa-globe',      'title' => 'Format & Publish',
        'desc' => 'Print-ready files, ISBN, metadata, then live across Amazon, Apple, Kobo, Google Play and 150+ retailers.'],
];
$processEyebrow = $processEyebrow ?? 'The Editorial Journey';
$processTitle   = $processTitle   ?? 'How we publish <em class="serif-italic">your book</em>';
$processIntro   = $processIntro   ?? 'Four considered steps, from the manuscript on your desk to a book in readers\' hands.';
?>
<section class="process-section section-mint" id="process">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow"><?= safe($processEyebrow) ?></span>
            <h2 class="section-title"><?= $processTitle ?></h2>
            <p><?= safe($processIntro) ?></p>
        </div>

        <div class="process-grid">
            <?php foreach ($processSteps as $i => $s): ?>
                <article class="process-card" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
                    <span class="process-n"><?= safe($s['n']) ?></span>
                    <h3 class="process-title"><?= safe($s['title']) ?></h3>
                    <p class="process-desc"><?= safe($s['desc']) ?></p>
                </article>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="#popup" class="btn btn-cta btn-lg" data-popup>
                Start your book today <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
