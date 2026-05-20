<?php
require_once __DIR__ . '/includes/config.php';

$page_title       = 'Professional Book Editing Services in Europe | ' . BRAND_NAME;
$page_description = 'Developmental, line, copy, academic and technical editing plus proofreading from editors with real publishing experience. Transparent revisions, clear explanations.';
$page_keywords    = 'book editing Europe, developmental editing, copy editing, line editing, proofreading services, manuscript editing Ireland';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/editing.php';

require __DIR__ . '/includes/header.php';

$hero = [
    'crumb'      => 'Editing',
    'eyebrow'    => 'Book Editing',
    'title'      => 'Professional Book Editing Services in <em class="gold-italic">Europe</em>',
    'paragraphs' => [
        'Even the most acclaimed authors rely on editors, and not because their writing falls short. The truth is, after spending so much time with a manuscript, it&rsquo;s easy to miss the details a fresh, professional perspective will catch.',
        'We partner with writers across every genre , fiction, non-fiction, memoirs, business books, children&rsquo;s literature, academic writing, and more. Every suggestion we make comes with a clear explanation, and every change is yours to approve or decline.',
    ],
    'ctas' => [
        ['label' => 'Get a Quote',    'href' => 'contact.php#submit', 'class' => 'btn-cta'],
        ['label' => 'Editing Levels', 'href' => '#editing-types',     'class' => 'btn-outline-dark'],
    ],
];
include __DIR__ . '/includes/service-hero.php';
include __DIR__ . '/includes/logo-slider.php';
?>

<!-- ============================================================
     TYPES OF BOOK EDITING WE OFFER
     ============================================================ -->
<section class="services-section section--dark" id="editing-types">
    <div class="container">
        <div class="section-head text-center" data-aos="fade-up">
            <span class="eyebrow eyebrow--light">Editing Levels</span>
            <h2 class="section-title text-light">Types of Book Editing <em class="gold-italic">We Offer</em></h2>
            <p class="hero-sub" style="max-width:760px;margin-inline:auto;color:rgba(255,255,255,0.78);">Different manuscripts need different kinds of editing. We&rsquo;ll tell you honestly which type yours needs.</p>
        </div>

        <div class="services-grid mt-5">
            <article class="service-card" data-aos="fade-up">
                <span class="service-icon"><i class="fa-solid fa-diagram-project"></i></span>
                <h3 class="service-title">Developmental Editing</h3>
                <p class="service-desc">The big-picture edit. Structure, pacing, plot coherence, character arcs, and whether your argument or narrative actually holds together from start to finish. You&rsquo;ll receive detailed editorial feedback covering what&rsquo;s working, what isn&rsquo;t, and a clear direction for what to do next.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="70">
                <span class="service-icon"><i class="fa-solid fa-pen-nib"></i></span>
                <h3 class="service-title">Line Editing</h3>
                <p class="service-desc">Once the structure is solid, line editing works at the sentence level. Wordy passages get tightened, awkward phrasing gets untangled, and unclear writing gets sharpened , all while keeping your voice completely intact.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="140">
                <span class="service-icon"><i class="fa-solid fa-spell-check"></i></span>
                <h3 class="service-title">Copy Editing</h3>
                <p class="service-desc">The technical side , grammar, punctuation, spelling, and consistency all the way through. By the end of a copy edit, your manuscript is clean, consistent, and ready for its final pass.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="210">
                <span class="service-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                <h3 class="service-title">Proofreading</h3>
                <p class="service-desc">The last read before your book goes to print or goes live. We catch typos, spacing issues, formatting glitches, and missing punctuation that may have slipped through earlier.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <article class="service-card" data-aos="fade-up">
                <span class="service-icon"><i class="fa-solid fa-graduation-cap"></i></span>
                <h3 class="service-title">Academic Editing</h3>
                <p class="service-desc">If you&rsquo;re publishing research, a thesis, or scholarly work, you need editors who understand academic standards. We check citations (APA, MLA, Chicago), verify references, and ensure your argument meets academic rigour.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="70">
                <span class="service-icon"><i class="fa-solid fa-microscope"></i></span>
                <h3 class="service-title">Technical Editing</h3>
                <p class="service-desc">For instruction manuals, scientific writing, or anything requiring absolute accuracy in terminology and data, technical editing ensures clarity without sacrificing precision.</p>
                <span class="service-glow" aria-hidden="true"></span>
            </article>
        </div>
    </div>
</section>

<!-- ============================================================
     VALUE
     ============================================================ -->
<section class="why-eph-sec" id="value">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="why-eph-art">
                    <img src="assets/images/livesite/AuthorChoose.jpg" alt="Why your manuscript needs a professional editor" loading="lazy" decoding="async">
                    <span class="why-eph-art__chip">Editorial</span>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Why Use a Professional Editor</span>
                <h2 class="section-title">Why Your Manuscript Needs a <em class="gold-italic">Professional Editor</em></h2>
                <p>A basic spell-check can fix typos, but it won&rsquo;t notice when a character suddenly changes name halfway through the story. Grammar software might tidy sentences, yet it can&rsquo;t point out when the ending of your book feels rushed or unsatisfying.</p>
                <p>At European Publishing House, our editors bring real publishing knowledge to every book we work on. Our goal is never to replace your voice. Instead, we help strengthen it so your writing becomes clearer, more engaging, and more impactful.</p>
                <p>We also believe editing should be a collaborative process. Our online book editing services across Europe focus on transparency and discussion, not simply sending back a document full of unexplained corrections.</p>
                <ul class="genre-list mt-3" role="list">
                    <li><i class="fa-solid fa-check" style="color:var(--c-leaf,#6CB04C);"></i>Editing available for fiction, non-fiction, memoirs, business titles, children&rsquo;s books, academic work, and more</li>
                    <li><i class="fa-solid fa-check" style="color:var(--c-leaf,#6CB04C);"></i>Every revision is clearly explained while you remain fully in control</li>
                    <li><i class="fa-solid fa-check" style="color:var(--c-leaf,#6CB04C);"></i>We continue working with you until your manuscript is truly ready for publication</li>
                </ul>
                <div class="mt-4">
                    <a href="contact.php#submit" class="btn btn-cta">Get Your Quote <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/top-categories.php'; ?>

<!-- ============================================================
     PRICING
     ============================================================ -->
<section class="publish-cost-sec section--dark" id="pricing">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="publish-cost-art">
                    <img src="assets/images/livesite/publishCostsection.jpg" alt="How much do book editing services cost in Europe" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Pricing</span>
                <h2 class="section-title">How Much Do Book Editing Services in <em class="gold-italic">Europe Cost?</em></h2>
                <p>Editing costs depend on what your manuscript actually needs and how long it is. Most professional editors charge either per word or per hour.</p>
                <p>We don&rsquo;t quote blindly. Get in touch and we&rsquo;ll talk through your manuscript, work out what type of editing would actually benefit it most, and give you clear, transparent pricing built around your specific project.</p>
                <p>No generic packages. No guesswork.</p>
                <a href="contact.php#submit" class="btn btn-cta btn-lg">Get a Custom Quote <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<?php
$exclude_slug = 'editing';
include __DIR__ . '/includes/other-services.php';
?>

<!-- ============================================================
     FAQs
     ============================================================ -->
<section class="faq-section" id="faq">
    <div class="container">
        <div class="row g-5 align-items-start">
            <div class="col-lg-4" data-aos="fade-right">
                <span class="eyebrow">FAQs</span>
                <h2 class="section-title">We&rsquo;re Here To Answer All Your <em class="gold-italic">Questions.</em></h2>
                <p>Can&rsquo;t find what you&rsquo;re looking for? Speak with our team directly.</p>
                <a href="contact.php" class="btn btn-cta">Get in Touch <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <div class="col-lg-8" data-aos="fade-left" data-aos-delay="100">
                <div class="accordion faq-accordion" id="editFaq">
                    <?php
                    $faqs = [
                        ['q' => 'How much does it cost to have someone edit my book in Europe?',  'a' => 'Editing costs in Europe vary depending on the type of editing your manuscript needs and how long it is. Most professional editors charge either per word or per hour, with rates shifting based on experience, genre, and the complexity of your project. Get in touch and we&rsquo;ll give you a clear, transparent quote tailored to your specific project.'],
                        ['q' => 'How much does it cost to proofread 1,000 words in Europe?',       'a' => 'Proofreading rates across Europe typically fall somewhere between &euro;3 and &euro;10 per 1,000 words, depending on the editor&rsquo;s experience, the complexity of the text, and the turnaround time required. Academic and technical manuscripts often sit at the higher end.'],
                        ['q' => 'Can I hire someone to edit my book in Europe?',                   'a' => 'Absolutely. You can hire a freelance editor independently or work with a publishing house that offers professional editorial services as part of a broader publishing package. The advantage of working with European Publishing House is that our editors are part of a full team, working alongside our designers, formatters, and publishing specialists.'],
                        ['q' => 'Can you make a living off proofreading?',                         'a' => 'Yes, though it takes time to build. Experienced proofreaders who work across book publishing, academic writing, and business content can earn a stable income, particularly those who specialise in a specific genre or field.'],
                        ['q' => 'Why is proofreading so hard?',                                    'a' => 'Because your brain reads what it expects to see, not what&rsquo;s actually on the page. That&rsquo;s why authors shouldn&rsquo;t proofread their own manuscripts, and why even experienced proofreaders read slowly, deliberately, and often out of sequence to stop their brains from filling in the gaps automatically.'],
                    ];
                    foreach ($faqs as $i => $f): ?>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button <?= $i === 0 ? '' : 'collapsed' ?>" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#editFaq<?= $i ?>"
                                    aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>" aria-controls="editFaq<?= $i ?>">
                                <span class="faq-num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                                <?= $f['q'] ?>
                            </button>
                        </h3>
                        <div id="editFaq<?= $i ?>" class="accordion-collapse collapse <?= $i === 0 ? 'show' : '' ?>" data-bs-parent="#editFaq">
                            <div class="accordion-body"><p><?= $f['a'] ?></p></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include __DIR__ . '/includes/cta.php';
include __DIR__ . '/includes/footer.php';
