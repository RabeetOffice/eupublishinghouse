<?php
require_once __DIR__ . '/includes/config.php';

$page_title       = 'Author Services | ' . BRAND_NAME;
$page_description = 'Use one service or commission the entire pipeline: publishing, editing, ghostwriting, cover design, formatting, and marketing for serious authors.';
$page_keywords    = 'author services Europe, book publishing services, book editing services, ghostwriting, cover design, book marketing';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/services.php';

require __DIR__ . '/includes/header.php';

$hero = [
    'crumb'      => 'Services',
    'title'      => 'Every <em class="serif-italic">publishing service</em>, one place',
    'paragraphs' => [
        'We launched in 2021 because we kept seeing the same problem, brilliant manuscripts that never became books. Not because they weren\'t good enough, but because traditional publishing is slow, closed-off, and difficult to break into.',
        'Use one service or commission the entire pipeline. Either way, you work directly with a team that\'s genuinely invested in your book, editing, ghostwriting, cover design, formatting, marketing, and global distribution all under one roof.',
    ],
    'ctas' => [
        ['label' => 'Get Started',     'href' => '#popup',    'class' => 'btn-cta',  'popup' => true],
        ['label' => 'Browse Services', 'href' => '#services', 'class' => 'btn-glass'],
    ],
];
include __DIR__ . '/includes/service-hero.php';
include __DIR__ . '/includes/distributors.php';

// Use the homepage services include (9-card grid) for the full services list
include __DIR__ . '/includes/services.php';

include __DIR__ . '/includes/process.php';
include __DIR__ . '/includes/why-choose.php';
include __DIR__ . '/includes/books-portfolio.php';
include __DIR__ . '/includes/categories.php';
include __DIR__ . '/includes/final-cta.php';
include __DIR__ . '/includes/footer.php';
