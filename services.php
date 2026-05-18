<?php
require_once __DIR__ . '/includes/config.php';

$page_title       = 'Author Services | ' . BRAND_NAME;
$page_description = 'Use one service or commission the entire pipeline — publishing, editing, ghostwriting, cover design, formatting, and marketing for serious authors.';
$page_keywords    = 'author services Europe, book publishing services, book editing services, ghostwriting, cover design, book marketing';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/services.php';

require __DIR__ . '/includes/header.php';

$hero = [
    'crumb'      => 'Services',
    'eyebrow'    => 'Author Services',
    'title'      => 'Every <em class="gold-italic">Publishing Service</em>, One Place',
    'paragraphs' => [
        'We launched in 2021 because we kept seeing the same problem &mdash; brilliant manuscripts that never became books. Not because they weren&rsquo;t good enough, but because traditional publishing is slow, closed-off, and difficult to break into.',
        'Use one service or commission the entire pipeline. Either way, you work directly with a team that&rsquo;s genuinely invested in your book &mdash; editing, ghostwriting, cover design, formatting, marketing, and global distribution all under one roof.',
    ],
    'ctas' => [
        ['label' => 'Get Started',     'href' => 'contact.php#submit', 'class' => 'btn-cta'],
        ['label' => 'Browse Services', 'href' => '#services',          'class' => 'btn-outline-dark'],
    ],
];
include __DIR__ . '/includes/service-hero.php';
include __DIR__ . '/includes/logo-slider.php';

$services = [
    ['icon' => 'fa-book',       'label' => 'Book Publishing',   'url' => 'publishing.php',   'desc' => 'We publish books across major platforms, including Amazon KDP, IngramSpark and other global distributors. Whether you choose print, eBook or both, we guide you in selecting the right format and publishing route for your goals.'],
    ['icon' => 'fa-pen-fancy',  'label' => 'Book Editing',      'url' => 'editing.php',      'desc' => 'We provide developmental editing, line editing, copy editing and proofreading, depending on what your manuscript needs. Our editors improve structure, language and accuracy while keeping your tone and message intact.'],
    ['icon' => 'fa-feather',    'label' => 'Ghostwriting',      'url' => 'ghostwriting.php', 'desc' => 'We offer ghostwriting support across all genres, including fiction, non-fiction, autobiographies, business books, self-help, academic work and children&rsquo;s stories. Our writers shape your ideas into clear, well-written manuscripts.'],
    ['icon' => 'fa-palette',    'label' => 'Book Cover Design', 'url' => 'design.php',       'desc' => 'We design covers for fiction, non-fiction, academic books and children&rsquo;s titles in both print and digital formats. From illustrated concepts to clean typographic styles, our designers create covers that suit your genre and audience.'],
    ['icon' => 'fa-align-left', 'label' => 'Book Formatting',   'url' => 'formatting.php',   'desc' => 'We format books for novels, academic texts, children&rsquo;s books and non-fiction titles. Our layouts are prepared for paperback, hardback and eBook versions, ensuring your content meets platform and printing requirements.'],
    ['icon' => 'fa-bullhorn',   'label' => 'Book Marketing',    'url' => 'marketing.php',    'desc' => 'We help promote your book through launch planning, online listings, author branding and targeted campaigns. Our strategies focus on visibility across digital platforms while helping you reach the right readership for your genre.'],
];
?>

<section class="services-section" id="services">
    <div class="container">
        <div class="section-head text-center" data-aos="fade-up">
            <span class="eyebrow">Author Services</span>
            <h2 class="section-title">Every Publishing Service, <em class="gold-italic">One Place</em></h2>
            <p style="max-width:760px;margin-inline:auto;">Manuscript editing, ghostwriting, cover design, formatting, marketing and global distribution — all under one roof, all built around your specific book.</p>
        </div>

        <div class="services-grid mt-5">
            <?php foreach ($services as $i => $s): ?>
                <article class="service-card" data-aos="fade-up" data-aos-delay="<?= $i * 70 ?>">
                    <span class="service-icon"><i class="fa-solid <?= safe($s['icon']) ?>"></i></span>
                    <h3 class="service-title"><?= safe($s['label']) ?></h3>
                    <p class="service-desc"><?= $s['desc'] ?></p>
                    <a href="<?= safe($s['url']) ?>" class="service-link">Learn more <i class="fa-solid fa-arrow-right"></i></a>
                    <span class="service-glow" aria-hidden="true"></span>
                </article>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="contact.php#submit" class="btn btn-cta btn-lg">Get Started <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>
</section>

<?php
include __DIR__ . '/includes/process.php';
include __DIR__ . '/includes/why-choose.php';
include __DIR__ . '/includes/cta.php';
include __DIR__ . '/includes/footer.php';
