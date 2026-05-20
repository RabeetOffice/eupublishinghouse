<?php
require_once __DIR__ . '/config.php';

$servicesList = $servicesList ?? [
    ['icon' => 'fa-book',       'title' => 'Book Publishing',
        'desc' => "We publish your book across every major platform, Amazon Kindle, Apple Books, Google Play, Kobo, Barnes & Noble, and 150+ retailers worldwide. We handle the entire process from file submission to going live, including ISBN registration, metadata setup, and platform-specific requirements. You keep your rights. You keep your royalties.",
        'href' => 'publishing.php'],
    ['icon' => 'fa-pen-fancy',  'title' => 'Book Editing',
        'desc' => "Good editing isn't one thing, it depends on where your manuscript is. We offer developmental editing for books that need structural and narrative work, copy editing for grammar, consistency, and clarity, and line editing for sentence-level flow and voice. A lot of manuscripts need more than one pass, and we'll tell you honestly which type of editing yours needs before we quote you anything.",
        'href' => 'editing.php'],
    ['icon' => 'fa-feather',    'title' => 'Ghostwriting Services',
        'desc' => "If the ideas are there but the words aren't coming, our ghostwriters can write the whole thing for you. Fiction, literary fiction, romance, thrillers, fantasy, memoirs, business books, self-help, every genre, every tone. You brief us, we write it, you own it entirely. Complete confidentiality, always.",
        'href' => 'ghostwriting.php'],
    ['icon' => 'fa-palette',    'title' => 'Book Cover Design',
        'desc' => "We design covers across every category, fiction, non-fiction, children's books, illustrated titles, series, and everything in between. That includes front covers, full print wraparounds, spine design, back cover copy layout, and interior illustrations where the book calls for it. You get multiple concepts to choose from and revisions until it's right.",
        'href' => 'design.php'],
    ['icon' => 'fa-align-left', 'title' => 'Book Formatting',
        'desc' => "We format your manuscript into every format it needs to be published in, PDF for print, ePub for Apple Books and Kobo, MOBI for Kindle, and any other format your chosen platforms require. Clean layouts, proper chapter breaks, correct margins, and files that pass every retailer's technical review first time.",
        'href' => 'formatting.php'],
    ['icon' => 'fa-bullhorn',   'title' => 'Book Marketing',
        'desc' => "Publishing is only half the job. We build marketing around your specific book, Amazon listing optimisation, social media campaigns, email marketing, book launch planning, paid advertising, and review outreach. Every strategy is built around getting your book in front of the readers who are actually looking for it.",
        'href' => 'marketing.php'],
];

$servicesEyebrow = $servicesEyebrow ?? 'Author Services';
$servicesTitle   = $servicesTitle   ?? 'Every publishing service, <em class="serif-italic">one place</em>';
$servicesIntro   = $servicesIntro   ?? null;
?>
<section class="services-section" id="services">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow"><?= safe($servicesEyebrow) ?></span>
            <h2 class="section-title"><?= $servicesTitle ?></h2>
            <?php if ($servicesIntro): ?><p><?= safe($servicesIntro) ?></p><?php endif; ?>
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
                Get Started <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
