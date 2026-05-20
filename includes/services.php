<?php
require_once __DIR__ . '/config.php';

/* Services data, override $servicesList before include to filter / reorder */
$servicesList = $servicesList ?? [
    ['icon' => 'fa-feather',     'title' => 'Ghostwriting',      'desc' => 'Confidential long-form partnerships in your voice. Fiction, memoir, business, you own every word.',           'href' => 'ghostwriting.php'],
    ['icon' => 'fa-pen-fancy',   'title' => 'Editing',           'desc' => 'Developmental, line, copy editing & proofreading from editors who actually read your genre.',                 'href' => 'editing.php'],
    ['icon' => 'fa-align-left',  'title' => 'Book Formatting',   'desc' => 'Print-ready PDFs, ePub & MOBI tuned to every retailer\'s exact specification.',                                'href' => 'formatting.php'],
    ['icon' => 'fa-palette',     'title' => 'Cover Design',      'desc' => 'Custom covers, wraparounds & series branding designed to stop readers mid-scroll.',                            'href' => 'design.php'],
    ['icon' => 'fa-book',        'title' => 'Publishing',        'desc' => 'End-to-end publishing across Amazon, Apple, Kobo, Google Play and 150+ retailers worldwide.',                  'href' => 'publishing.php'],
    ['icon' => 'fa-headphones',  'title' => 'Audiobooks',        'desc' => 'Professional narration, recording and mastering, delivered ready for Audible and beyond.',                    'href' => 'services.php'],
    ['icon' => 'fa-bullhorn',    'title' => 'Marketing',         'desc' => 'Amazon ads, launch campaigns, social and review outreach built for your specific book.',                       'href' => 'marketing.php'],
    ['icon' => 'fa-globe',       'title' => 'Author Website',    'desc' => 'A polished author site that mirrors your book\'s craft, built fast, optimised, mobile-first.',                'href' => 'services.php'],
    ['icon' => 'fa-print',       'title' => 'Premium Printing',  'desc' => 'Print-on-demand and small-batch luxury runs, paperback, hardcover and large-print editions.',                 'href' => 'services.php'],
];

$servicesEyebrow = $servicesEyebrow ?? 'Author Services';
$servicesTitle   = $servicesTitle   ?? 'Every publishing service, <em class="serif-italic">one elegant home</em>';
$servicesIntro   = $servicesIntro   ?? 'Nine considered services that cover every step from first draft to the moment your book is on sale worldwide.';
?>
<section class="services-section" id="services">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow"><?= safe($servicesEyebrow) ?></span>
            <h2 class="section-title"><?= $servicesTitle ?></h2>
            <p><?= safe($servicesIntro) ?></p>
        </div>

        <div class="services-grid">
            <?php foreach ($servicesList as $i => $s): ?>
                <article class="service-card" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 80 ?>">
                    <span class="service-icon"><i class="fa-solid <?= safe($s['icon']) ?>"></i></span>
                    <h3 class="service-title"><?= safe($s['title']) ?></h3>
                    <p class="service-desc"><?= safe($s['desc']) ?></p>
                    <?php if (!empty($s['href'])): ?>
                        <a href="<?= safe($s['href']) ?>" class="service-link" data-no-popup>
                            Learn more <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="#popup" class="btn btn-cta btn-lg" data-popup>
                Get a free quote <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
