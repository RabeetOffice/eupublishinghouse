<?php
require_once __DIR__ . '/config.php';

$processSteps = $processSteps ?? [
    ['n' => '01', 'icon' => 'fa-comments',    'title' => 'Free Consultation & Manuscript Review',
        'desc' => "Send us your manuscript and we'll take a proper look. We'll talk through your goals, what your book needs, realistic timelines, and put together a publishing plan that fits your budget. No pressure, no sales pitch, just a straight conversation."],
    ['n' => '02', 'icon' => 'fa-pen-nib',     'title' => 'Professional Editing',
        'desc' => "Our editors go through your manuscript thoroughly. Depending on what stage you're at, that might mean developmental editing for structure and pacing, copy editing for grammar and consistency, or proofreading before the final files go to print. You'll see every change tracked and explained."],
    ['n' => '03', 'icon' => 'fa-palette',     'title' => 'Custom Cover Design',
        'desc' => "We design covers that stop readers mid-scroll. You'll get multiple concepts to choose from, as many revisions as needed, and final files sized and optimised for every platform your book will sell on. No templates, no stock cover designs, something made for your book specifically."],
    ['n' => '04', 'icon' => 'fa-align-left',  'title' => 'Formatting',
        'desc' => "We format your book for eBook and print, making sure it reads cleanly on every device and meets every retailer's technical requirements. Proper chapter breaks, clickable contents, correct margins, everything that makes the difference between a professional-looking book and an amateur one."],
];
$processEyebrow = $processEyebrow ?? 'The Editorial Journey';
$processTitle   = $processTitle   ?? 'How we publish <em class="serif-italic">your book</em>';
$processIntro   = $processIntro   ?? 'Four steps from manuscript to published.';
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
