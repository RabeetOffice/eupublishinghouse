<?php
require_once __DIR__ . '/includes/config.php';

$page_title       = 'Professional Book Editing Services Across Europe';
$page_description = 'Enhance your manuscript with expert book editing services across Europe. Precision, quality, and trusted support to help authors perfect every page.';
$page_keywords    = 'book editing Europe, developmental editing, copy editing, line editing, proofreading services, manuscript editing Ireland';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/editing.php';

require __DIR__ . '/includes/header.php';

$hero = [
    'crumb'      => 'Editing',
    'title'      => 'Professional Book Editing Services in <em class="serif-italic">Europe</em>',
    'paragraphs' => [
        "Even the most acclaimed authors rely on editors, and not because their writing falls short. The truth is, after spending so much time with a manuscript, it's easy to miss the details a fresh, professional perspective will catch. That's where European Publishing House comes in: our book editing services are designed to spot what you no longer see and elevate your work without changing your unique voice.",
        "We partner with writers across every genre, fiction, non-fiction, memoirs, business books, children's literature, academic writing, and more. Whether you've just wrapped your first draft or are weeks away from publication, our editors step in at the right moment to fine-tune your manuscript, always respecting the style and personality that make it yours.",
        "Transparency is key. Every suggestion we make comes with a clear explanation, and every change is yours to approve or decline. That's the way we collaborate.",
    ],
    'ctas' => [
        ['label' => 'Get Started', 'href' => '#popup',                'class' => 'btn-cta',   'popup'    => true],
        ['label' => 'Live Chat',   'href' => link_to('javascript:;'), 'class' => 'btn-glass', 'livechat' => true],
    ],
];
include __DIR__ . '/includes/service-hero.php';
include __DIR__ . '/includes/distributors.php';
?>

<!-- ============================================================
     TYPES OF BOOK EDITING WE OFFER
     ============================================================ -->
<section class="services-section" id="editing-types">
    <div class="container">
        <div class="section-head text-center" data-aos="fade-up">
            <span class="eyebrow">Editing Levels</span>
            <h2 class="section-title">Types of Book Editing <em class="serif-italic">We Offer</em></h2>
            <p class="hero-sub" style="max-width:760px;margin-inline:auto;">Different manuscripts need different kinds of editing. We&rsquo;ll tell you honestly which type yours needs.</p>
        </div>

        <div class="services-grid mt-5">
            <article class="service-card" data-aos="fade-up">
                <span class="service-icon"><i class="fa-solid fa-diagram-project"></i></span>
                <h3 class="service-title">Developmental Editing</h3>
                <p class="service-desc">This is the big-picture edit. Structure, pacing, plot coherence, character arcs, and whether your argument or narrative actually holds together from start to finish. If your manuscript needs foundational work before anything else, this is where we start. We offer developmental editing across fiction, non-fiction, memoirs, business books, children's literature, and academic writing. You'll receive detailed editorial feedback covering what's working, what isn't, and a clear direction for what to do next.</p>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="70">
                <span class="service-icon"><i class="fa-solid fa-pen-nib"></i></span>
                <h3 class="service-title">Line Editing</h3>
                <p class="service-desc">Once the structure is solid, line editing works at the sentence level. Wordy passages get tightened, awkward phrasing gets untangled, and unclear writing gets sharpened, all while keeping your voice completely intact. We work across all genres at this stage, fiction, non-fiction, business, memoirs, and children's books. Line editing is the edit that makes your writing feel effortless to read, even when the subject matter is anything but.</p>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="140">
                <span class="service-icon"><i class="fa-solid fa-spell-check"></i></span>
                <h3 class="service-title">Copy Editing</h3>
                <p class="service-desc">Copy editing covers the technical side, grammar, punctuation, spelling, and consistency all the way through. We check for tense inconsistencies, continuity errors, character detail changes between chapters, and anything that doesn't hold to consistent standards throughout. We work across fiction, non-fiction, academic manuscripts, business books, children's titles, and memoirs. By the end of a copy edit, your manuscript is clean, consistent, and ready for its final pass.</p>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="210">
                <span class="service-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                <h3 class="service-title">Proofreading</h3>
                <p class="service-desc">The last read before your book goes to print or goes live. We catch typos, spacing issues, formatting glitches, and missing punctuation that may have slipped through earlier. Proofreading covers all genres and all formats, both print layouts and eBook files. It's a focused, detail-level pass, and it's the one that makes sure nothing embarrassing makes it to publication.</p>
            </article>
            <article class="service-card" data-aos="fade-up">
                <span class="service-icon"><i class="fa-solid fa-graduation-cap"></i></span>
                <h3 class="service-title">Academic Editing</h3>
                <p class="service-desc">If you're publishing research, a thesis, or scholarly work, you need editors who understand academic standards. We check citations (APA, MLA, Chicago, whatever your field requires), verify references, ensure your argument meets academic rigour, and make sure your writing is clear without dumbing down complex ideas. Academic writing has specific rules, and we know them.</p>
            </article>
            <article class="service-card" data-aos="fade-up" data-aos-delay="70">
                <span class="service-icon"><i class="fa-solid fa-microscope"></i></span>
                <h3 class="service-title">Technical Editing</h3>
                <p class="service-desc">For instruction manuals, scientific writing, or anything requiring absolute accuracy in terminology and data, technical editing ensures clarity without sacrificing precision. We make sure your specialized content is understandable to your target audience while keeping technical details correct.</p>
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
                    <img src="<?= asset('images/ManuscriptProfessionalEditor-2048x1635.webp') ?>" alt="Why your manuscript needs a professional editor" loading="lazy" decoding="async">
                    <span class="why-eph-art__chip">Editorial</span>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Why Use a Professional Editor</span>
                <h2 class="section-title">Why your manuscript needs a <em class="serif-italic">professional editor</em></h2>
                <p>A basic spell-check can fix typos, but it won't notice when a character suddenly changes name halfway through the story. Grammar software might tidy sentences, yet it can't point out when the ending of your book feels rushed or unsatisfying. And while friends or family may read your draft with good intentions, they rarely provide the clear, professional feedback needed to truly refine a manuscript.</p>
                <p>At European Publishing House, our editors bring real publishing knowledge to every book we work on. Our team has experience with a wide range of genres, understands reader expectations, and knows what turns a rough manuscript into a polished book that can succeed in the market. Our goal is never to replace your voice. Instead, we help strengthen it so your writing becomes clearer, more engaging, and more impactful.</p>
                <p>We also believe editing should be a collaborative process. Our online book editing services across Europe focus on transparency and discussion, not simply sending back a document full of unexplained corrections. You'll always understand the changes we suggest, the reasons behind them, and nothing is finalised without your approval.</p>
                <ul class="genre-list mt-3" role="list">
                    <li><i class="fa-solid fa-check"></i>Editing available for fiction, non-fiction, memoirs, business titles, children's books, academic work, and more</li>
                    <li><i class="fa-solid fa-check"></i>Every revision is clearly explained while you remain fully in control</li>
                    <li><i class="fa-solid fa-check"></i>We continue working with you until your manuscript is truly ready for publication</li>
                </ul>
                <div class="mt-4">
                    <a href="#popup" class="btn btn-cta" data-popup>Get Your Quote <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/categories.php'; ?>

<!-- ============================================================
     PRICING
     ============================================================ -->
<section class="publish-cost-sec" id="pricing">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="publish-cost-art">
                    <img src="<?= asset('images/BookEditingServices-2048x1365.webp') ?>" alt="How much do book editing services cost in Europe" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Pricing</span>
                <h2 class="section-title">How much do book editing services in <em class="serif-italic">Europe</em> cost?</h2>
                <p>Editing costs depend on what your manuscript actually needs and how long it is. The cost of editing a book in Europe isn't a fixed number, a 90,000-word novel going through full developmental editing is a completely different project from a 30,000-word memoir that only needs a proofreading pass, and the pricing reflects that honestly.</p>
                <p>Most professional editors charge either per word or per hour. Developmental editing sits at the higher end because of the depth of work involved. Copy editing and proofreading are more affordable. Genre matters too, a children's book and an academic manuscript are both edited carefully, but differently, and that affects how long it takes.</p>
                <p>We don't quote blindly. Get in touch and we'll talk through your manuscript, work out what type of editing would actually benefit it most, and give you clear, transparent pricing built around your specific project. No generic packages. No guesswork.</p>
                <a href="#popup" class="btn btn-cta btn-lg" data-popup>Get Your Free Quote <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<?php
$exclude_slug = 'editing';
include __DIR__ . '/includes/books-portfolio.php';
include __DIR__ . '/includes/services.php';
?>

<!-- ============================================================
     FAQs
     ============================================================ -->
<section class="faq-section" id="faq">
    <div class="container">
        <div class="row g-5 align-items-start">
            <div class="col-lg-4" data-aos="fade-right">
                <span class="eyebrow">FAQs</span>
                <h2 class="section-title">We&rsquo;re here to answer all your <em class="serif-italic">questions</em></h2>
                <p>Can&rsquo;t find what you&rsquo;re looking for? Speak with our team directly.</p>
                <a href="contact.php" class="btn btn-cta" data-no-popup>Get in Touch <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <div class="col-lg-8" data-aos="fade-left" data-aos-delay="100">
                <div class="accordion faq-accordion" id="editFaq">
                    <?php
                    $faqs = [
                        ['q' => 'How much does it cost to have someone edit my book in Europe?',
                         'a' => "Editing costs in Europe vary depending on the type of editing your manuscript needs and how long it is. Developmental editing involves significantly more work than proofreading, so the pricing reflects that. Most professional editors charge either per word or per hour, with rates shifting based on experience, genre, and the complexity of your project. We can't give you an honest number without understanding your manuscript first. Get in touch and we'll talk through what your book needs, then give you clear, transparent pricing tailored to your specific project."],
                        ['q' => 'How much does it cost to proofread 1,000 words in Europe?',
                         'a' => "Proofreading rates across Europe typically fall somewhere between &euro;3 and &euro;10 per 1,000 words, depending on the editor's experience, the complexity of the text, and the turnaround time required. Academic and technical manuscripts often sit at the higher end. That said, most authors aren't pricing proofreading per thousand words, they're pricing it per full manuscript. The best way to get an accurate figure is to share your manuscript with us and we'll give you a straightforward quote based on what your book actually needs."],
                        ['q' => 'Can I hire someone to edit my book in Europe?',
                         'a' => "Absolutely. You can hire a freelance editor independently or work with a publishing house that offers professional editorial services as part of a broader publishing package. The advantage of working with European Publishing House is that our editors are part of a full team, working alongside our designers, formatters, and publishing specialists, so your manuscript moves smoothly from editing all the way through to publication. You're not chasing five separate freelancers. You have one team that handles everything."],
                        ['q' => 'Can you make a living off proofreading?',
                         'a' => "Yes, though it takes time to build. Experienced proofreaders who work across book publishing, academic writing, and business content can earn a stable income, particularly those who specialise in a specific genre or field. Freelance proofreading income tends to be variable in the early years as you build a client base, but many experienced proofreaders supplement their work with copy editing or manuscript assessments alongside it. For people with a genuine eye for detail and the patience the work demands, it's a completely viable career."],
                        ['q' => 'Why is proofreading so hard?',
                         'a' => "Because your brain reads what it expects to see, not what's actually on the page. It's a well-documented quirk of how we process familiar text, especially our own writing. That's why authors shouldn't proofread their own manuscripts, and why even experienced proofreaders read slowly, deliberately, and often out of sequence to stop their brains from filling in the gaps automatically. Professional proofreading is a specific skill built on technique and practice, not just good grammar. It's the reason that final pass before publication is always worth having done by someone who didn't write the book."],
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
include __DIR__ . '/includes/final-cta.php';
include __DIR__ . '/includes/footer.php';
