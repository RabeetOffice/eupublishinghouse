<?php
/* =================================================================
   /book-editing-services-in-ireland/
   Ireland location cluster — editing. Copy from the content brief
   "Professional Book Editing Services Ireland | Free Quote".
================================================================= */

require_once __DIR__ . '/includes/locations-data.php';

$locKey = 'ireland';
$loc    = location_get($locKey);
$svc    = $loc['services']['editing'];

$page_title       = 'Book Editing Services in Ireland | Professional Editors';
$page_description = 'Get expert book editing services in Ireland to polish your manuscript for clarity, flow, and publishing success. Trusted editors deliver fast results.';
$page_keywords    = 'book editing services Ireland, copy editing Ireland, proofreading Ireland, academic book editing Ireland, manuscript assessment Ireland';
$canonical_url    = location_abs($svc['href']);

require __DIR__ . '/includes/header.php';

$hero = [
    'crumbs' => [
        ['label' => 'Locations', 'href' => link_to('locations.php')],
        ['label' => 'Ireland',   'href' => location_url($locKey)],
        ['label' => 'Book Editing'],
    ],
    'title'      => 'Expert Book Editing Services in Ireland to Polish <em class="serif-italic">Every Page</em>',
    'paragraphs' => [
        "Writing a book takes months, sometimes years, of your life. Getting it edited properly is what turns that manuscript into something readers, agents, and publishers will take seriously. At EU Publishing House, we work with authors right across Ireland, from first-time writers to people publishing their fifth or sixth book, and we treat every manuscript with the same care.",
        "Editing is not just about fixing typos. It is about making your story or your argument clearer, tighter, and more enjoyable to read. A good editor spots the things you cannot see anymore because you have read your own chapters fifty times. That is where we come in.",
        "Whether you are self-publishing a novel, submitting a manuscript to agents, or finishing an academic thesis, we have an editing package that fits. We keep our process simple, our communication honest, and our pricing clear from the start. If you have been searching for a team that understands Irish writers and Irish readers, you are in the right place.",
    ],
    'ctas' => [
        ['label' => 'Get a Free Quote', 'href' => '#popup',                'class' => 'btn-cta',   'popup'    => true],
        ['label' => 'Live Chat',        'href' => link_to('javascript:;'), 'class' => 'btn-glass', 'livechat' => true],
    ],
];
include __DIR__ . '/includes/service-hero.php';
include __DIR__ . '/includes/distributors.php';
?>

<!-- ============================================================
     EDITING STAGES
     ============================================================ -->
<section class="services-section" id="editing-types">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Editing Levels</span>
            <h2 class="section-title">What expert book editing in Ireland <em class="serif-italic">actually does</em></h2>
            <p>No two manuscripts need the same kind of work. Some need a full structural rework. Others just need a careful final read before they go to print. We break our service into clear stages so you only pay for what your book actually needs, and our online book editing services in Ireland mean you can work with us no matter where you live.</p>
        </div>

        <div class="services-grid">
            <?php
            $levels = [
                ['fa-diagram-project', 'Developmental Editing: Fixing the Big Picture First',
                 'This is the deep-dive stage. Our editor reads your full manuscript and looks at the things that matter most: plot, pacing, character development, structure, and whether your argument or story actually holds together from start to finish. You will get a full report plus notes throughout the manuscript explaining what works, what does not, and how to fix it.'],
                ['fa-pen-nib', 'Line and Copy Editing: Making Every Sentence Work',
                 'Once the big structural issues are sorted, it is time to look at the sentence level. This covers grammar, word choice, sentence flow, repetition, and consistency of tone and style. If you have been searching for the best copy editing services in Ireland, this is the stage that gets the most attention from our team, because it is where most manuscripts are let down.'],
                ['fa-graduation-cap', 'Academic and Non-Fiction Editing',
                 'Theses, dissertations, research papers, and non-fiction books all need a different eye. Our team handles academic book editing in Ireland for students and researchers who need referencing checked, arguments tightened, and academic tone kept consistent throughout. We work to whatever citation style your college or publisher requires.'],
                ['fa-child-reaching', 'Children’s Book Editing',
                 'Writing for children is its own skill, and editing for children is too. Word choice, rhythm, age-appropriate vocabulary, and pacing all matter more than usual. Our children’s book editing services in Ireland cover picture books, early readers, and middle-grade fiction, always with an eye on what will actually hold a young reader’s attention.'],
                ['fa-magnifying-glass', 'Proofreading: The Final Safety Net',
                 'This is the last check before your book goes to print or goes live. Our proofreading and copy editing services in Ireland catch spelling mistakes, punctuation errors, formatting issues, and any small inconsistencies that slipped through earlier stages. Think of it as quality control before your book meets its readers.'],
                ['fa-keyboard', 'Copywriting Support',
                 'Not every project is a full manuscript. We also offer copy writing Ireland authors and small businesses, used for author bios, back-cover blurbs, book descriptions, and marketing copy. Good copy sells a book just as much as a good cover does.'],
                ['fa-clipboard-check', 'Manuscript Assessment',
                 'If you are not sure your book is ready for a full edit, a manuscript assessment might be the better starting point. Our editor reads the whole manuscript and gives you a written report covering the strengths, the weak spots, and a clear recommendation on what to do next. It is a good option if you are working to a tight budget and want direction before committing to a full edit.'],
            ];
            foreach ($levels as $i => $s): ?>
                <article class="service-card" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 80 ?>">
                    <span class="service-icon"><i class="fa-solid <?= $s[0] ?>"></i></span>
                    <h3 class="service-title"><?= $s[1] ?></h3>
                    <p class="service-desc"><?= $s[2] ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================================
     EXTRA SUPPORT
     ============================================================ -->
<section class="section section-mint loc-benefit-sec" id="extra-support">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Beyond Editing</span>
            <h2 class="section-title">Extra support that gets books <em class="serif-italic">submission-ready</em></h2>
            <p>Editing rarely happens in isolation. Most authors need a few other things sorted before their book is genuinely ready, and we can help with those too.</p>
        </div>

        <div class="loc-benefit-grid">
            <?php
            $extras = [
                ['fa-align-left',   'Formatting for print and ebook', 'Once the text is finalised, we can format your manuscript so it is ready to upload to a printer or an ebook platform, with consistent spacing, chapter breaks, and layout.'],
                ['fa-users',        'Beta reader coordination',       'For some projects, honest reader feedback before the final edit is useful. We can help organise this as part of a wider editing package.'],
                ['fa-envelope-open-text', 'Query letters and submission packages', 'If your goal is traditional publishing, a strong query letter matters as much as the manuscript itself. We can help you put one together that gives your book a fair shot.'],
                ['fa-list-check',   'Style sheets',                   'For longer projects or series, we build a style sheet that tracks spelling choices, character names, and formatting decisions, so everything stays consistent from the first page to the last.'],
            ];
            foreach ($extras as $i => $b): ?>
                <article class="loc-benefit-card" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 70 ?>">
                    <span class="loc-benefit-card__icon"><i class="fa-solid <?= $b[0] ?>"></i></span>
                    <h3><?= $b[1] ?></h3>
                    <p><?= $b[2] ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================================
     WHO WE WORK WITH
     ============================================================ -->
<section class="section loc-audience-sec" id="who-we-help">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Who We Work With</span>
            <h2 class="section-title">Irish writers, we help turn drafts into <em class="serif-italic">stronger books</em></h2>
            <p>Our clients come from all sorts of backgrounds and all corners of Ireland. We regularly work with:</p>
        </div>

        <div class="loc-audience-grid">
            <?php
            $audience = [
                ['fa-book-open',       'First-time authors preparing a manuscript for submission'],
                ['fa-store',           'Self-publishing writers who want a polished final product'],
                ['fa-graduation-cap',  'Students and academics finishing a thesis or research paper'],
                ['fa-briefcase',       'Small businesses needing website or marketing copy'],
                ['fa-building-columns','Publishers who need overflow editing support'],
                ['fa-child-reaching',  'Parents and teachers writing children’s stories'],
            ];
            foreach ($audience as $i => $a): ?>
                <div class="loc-audience-item" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 70 ?>">
                    <i class="fa-solid <?= $a[0] ?>"></i>
                    <span><?= $a[1] ?></span>
                </div>
            <?php endforeach; ?>
        </div>

        <p class="loc-note" data-aos="fade-up">You do not need to live near an office to work with us. All our editing is done online, so you can be based in Dublin, Cork, Galway, a small town, or working remotely from anywhere in the world.</p>
    </div>
</section>

<!-- ============================================================
     HOW TO CHOOSE
     ============================================================ -->
<section class="section loc-check-sec" id="how-to-choose">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Before You Hire Anyone</span>
            <h2 class="section-title">Choosing a book editor in Ireland <em class="serif-italic">without costly mistakes</em></h2>
            <p>There are a lot of people online calling themselves editors, and not all of them have the training or experience to back it up. Before you hire anyone, it is worth asking:</p>
        </div>

        <div class="loc-check-grid">
            <?php
            $questions = [
                'Do they specialise in your genre or type of writing?',
                'Will you get a sample edit before committing to the full project?',
                'Is the pricing clear upfront, with no vague add-ons later?',
                'Do they explain their edits, or just make changes without context?',
                'Can they give you a realistic timeline before you pay anything?',
                'Do they offer more than one round of feedback if needed?',
            ];
            foreach ($questions as $i => $q): ?>
                <div class="loc-check-card" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 70 ?>">
                    <span class="loc-check-card__n"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                    <p><?= $q ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <p class="loc-note" data-aos="fade-up">A good editor will answer all of these without hesitation. If someone is cagey about pricing or timelines, that is usually a warning sign.</p>
    </div>
</section>

<!-- ============================================================
     WHY EDITING MATTERS
     ============================================================ -->
<section class="why-eph-sec" id="why-it-matters">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="why-eph-art">
                    <img src="<?= asset('images/ManuscriptProfessionalEditor-2048x1635.webp') ?>" alt="Why professional book editing changes how readers respond" loading="lazy" decoding="async">
                    <span class="why-eph-art__chip">Editorial</span>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Why It Matters</span>
                <h2 class="section-title">Why Ireland professional book editing changes <em class="serif-italic">how readers respond</em></h2>
                <p>It is tempting to think editing is optional, especially if you are working with a tight budget. In our experience, skipping it almost always costs more in the long run.</p>
                <ul class="loc-diff-list" role="list">
                    <li><i class="fa-solid fa-check"></i><span>Agents and publishers reject manuscripts within the first few pages if the writing is not tight</span></li>
                    <li><i class="fa-solid fa-check"></i><span>Readers leave negative reviews over basic errors, even when the story itself is good</span></li>
                    <li><i class="fa-solid fa-check"></i><span>Self-published books without proper editing often get returned or refunded</span></li>
                    <li><i class="fa-solid fa-check"></i><span>A polished manuscript gives you a genuine shot at traditional publishing</span></li>
                    <li><i class="fa-solid fa-check"></i><span>Good editing protects your reputation as a writer, especially for a first book</span></li>
                </ul>
                <p class="mt-3">Editing is not about changing your voice. It is about making sure your voice comes through as clearly as possible. Most authors are simply too close to their own writing to see where a sentence drags, where a chapter loses pace, or where an argument needs another source. A second, trained set of eyes catches these things without judgement, and gives you the chance to fix them before anyone else reads the book.</p>
                <div class="mt-4">
                    <a href="#popup" class="btn btn-cta" data-popup>Get Your Free Quote <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
/* ---- Process ---- */
$processEyebrow = 'From First Read to Finish';
$processTitle   = 'Your manuscript editing <em class="serif-italic">journey</em>';
$processIntro   = 'Five stages, with a real person on the other end at every one of them.';
$processSteps   = [
    ['n' => '01', 'title' => 'Send us your manuscript',
        'desc' => 'Get in touch through our website with a short description of your project, your word count, and your deadline if you have one. There is no obligation at this stage, and you will always hear back from a real person, not an automated system.'],
    ['n' => '02', 'title' => 'Get a free quote and sample edit',
        'desc' => 'We will look at your manuscript and come back with a clear quote based on the type of editing you need and the length of your book. For most projects, we can also provide a short sample edit so you can see our style before committing.'],
    ['n' => '03', 'title' => 'We edit your manuscript',
        'desc' => 'Your editor works through your manuscript at a realistic pace, leaving comments and tracked changes so you can see exactly what has been suggested and why.'],
    ['n' => '04', 'title' => 'Review and discuss',
        'desc' => 'Once the edit is done, you get your manuscript back with full notes. If anything is unclear, you can ask questions or request clarification before moving forward.'],
    ['n' => '05', 'title' => 'Final polish',
        'desc' => 'If you need a second round, a proofread, or any final adjustments, we handle that too, so your manuscript is genuinely ready to submit or publish.'],
];
include __DIR__ . '/includes/process.php';
?>

<!-- ============================================================
     WHY IRISH AUTHORS TRUST US
     ============================================================ -->
<section class="section loc-trust-sec" id="why-us">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Why Authors Trust Us</span>
            <h2 class="section-title">Why Irish authors trust our editors <em class="serif-italic">with their manuscripts</em></h2>
        </div>

        <div class="loc-benefit-grid">
            <?php
            $trust = [
                ['fa-book-open-reader', 'Editors who actually read the whole book', 'We do not skim. Every manuscript gets a proper, careful read from start to finish.'],
                ['fa-tag',              'Clear, upfront pricing',                   'You will know what you are paying before any work begins, with no hidden extras added halfway through.'],
                ['fa-comments',         'Real feedback, not just red pen marks',     'We explain our reasoning so you understand why a change is being suggested, which helps you grow as a writer too.'],
                ['fa-flag',             'Irish English as standard',                'If your book is aimed at an Irish audience, we edit with Irish spelling, grammar, and tone in mind, not American defaults.'],
                ['fa-user-graduate',    'Genre and subject specialists',            'Whether it is fiction, academic work, or a children’s book, your manuscript goes to someone who actually works in that area.'],
                ['fa-calendar-check',   'Flexible turnaround',                      'We work with your deadline where we can, whether that is a college submission date or a self-publishing launch.'],
                ['fa-user-pen',         'One editor from start to finish',          'Where possible, the same editor stays with your project from the first read to the final proofread, so they get to know your voice and your book properly instead of starting fresh at every stage.'],
                ['fa-lock',             'Confidentiality as standard',              'Your manuscript is your work. We do not share it, discuss it, or use it for anything beyond the editing you have asked for.'],
            ];
            foreach ($trust as $i => $b): ?>
                <article class="loc-benefit-card" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 70 ?>">
                    <span class="loc-benefit-card__icon"><i class="fa-solid <?= $b[0] ?>"></i></span>
                    <h3><?= $b[1] ?></h3>
                    <p><?= $b[2] ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
/* ---- Shared six-service cross-link block ---- */
$coreLocation = $locKey;
$coreCurrent  = 'editing';
$coreEyebrow  = 'Complete Support';
$coreTitle    = 'Complete book publishing services for authors beyond <em class="serif-italic">the final manuscript edit</em>';
include __DIR__ . '/includes/location-core-services.php';
?>

<!-- ============================================================
     COST
     ============================================================ -->
<section class="publish-cost-sec" id="pricing">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="publish-cost-art">
                    <img src="<?= asset('images/BookEditingServices-2048x1365.webp') ?>" alt="What book editing costs in Ireland" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Pricing</span>
                <h2 class="section-title">What does book editing <em class="serif-italic">cost in Ireland?</em></h2>
                <p>This is usually the first question people ask, and it is a fair one. Honestly, there is no single flat rate that works for every project, and any editor telling you otherwise is not being straight with you. Book editing fees in Ireland depend on a few things: the type of edit you need, the length of your manuscript, and how much work the text needs before it is ready. A light proofread will always cost less than a full developmental edit, simply because the amount of work involved is different.</p>
                <p>We understand that book editing costs in Ireland can feel like a big unknown, especially for first-time authors working out a budget. That is why we always give a clear quote before any work starts, based on your actual manuscript rather than a generic price list. If you are trying to work out the cost of editing a book in Ireland for your specific project, the best way is to send us your word count and a short sample. We will give you a real number, not a rough guess.</p>
                <p>We also know that budget is a genuine concern for a lot of writers, particularly students and first-time authors. If you are looking for cheap book editing in Ireland, talk to us about your options. We would rather find a package that fits your budget than have you skip editing altogether.</p>
                <a href="#popup" class="btn btn-cta btn-lg" data-popup>Get Your Free Quote <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<?php
$exclude_slug = 'editing';
include __DIR__ . '/includes/books-portfolio.php';

/* ---- FAQs ---- */
$faqId    = 'ireEditFaq';
$faqTitle = 'Frequently asked <em class="serif-italic">questions</em>';
$faqs = [
    ['q' => 'How long does book editing take?',
     'a' => 'It depends on the length of your manuscript and the type of edit needed. A full novel-length developmental edit usually takes several weeks, while a proofread can often be turned around much faster. We will give you a realistic timeline once we have seen your manuscript.'],
    ['q' => 'Do you offer book editing services near me if I am not based in a big city?',
     'a' => 'Yes. All our editing is done online, so it does not matter whether you are in a city, a small town, or working remotely. Location is never a barrier to working with us.'],
    ['q' => 'Can I get a sample edit before I commit?',
     'a' => 'In most cases, yes. We can usually provide a short sample edit on a few pages of your manuscript so you can see our approach before agreeing to the full project.'],
    ['q' => 'Do you edit both fiction and non-fiction?',
     'a' => 'Yes. We work across fiction, non-fiction, academic writing, and children’s books, and each project is matched with someone who has experience in that area.'],
    ['q' => 'What is the average book editing services cost in Ireland?',
     'a' => 'It varies by project, since pricing depends on manuscript length and the type of edit required. We always provide a clear, itemised quote before starting any work, so there are no surprises.'],
    ['q' => 'Do you only offer full manuscript edits, or can I get one chapter reviewed first?',
     'a' => 'You can absolutely start with a single chapter or a sample section. Many authors do this first to get a feel for our editing style before committing to the full manuscript.'],
    ['q' => 'Is your service only for print books, or do you help with ebooks too?',
     'a' => 'We work with both. Whether your book is heading to print, to an ebook platform, or both, we edit and format with that end goal in mind.'],
];
include __DIR__ . '/includes/location-faq.php';

/* ---- Closing CTA ---- */
$ctaEyebrow = 'Ready When You Are';
$ctaTitle   = 'Ready to give your manuscript <em class="serif-italic">the edit it deserves?</em>';
$ctaSub     = 'If you have been putting off getting your book edited because you were not sure where to start, this is your sign to send it over. Get in touch with EU Publishing House today for a free, no-obligation quote. We will read your project, tell you honestly what it needs, and give you a clear plan from there.';
include __DIR__ . '/includes/final-cta.php';

/* ---- Structured data ---- */
$schemaCrumbs = [
    ['name' => 'Locations',    'url' => rtrim(BRAND_SITE_URL, '/') . '/locations/'],
    ['name' => 'Ireland',      'url' => location_abs($loc['hub'])],
    ['name' => 'Book Editing', 'url' => $canonical_url],
];
$schemaService = [
    'name'        => 'Book Editing Services in Ireland',
    'description' => $page_description,
    'url'         => $canonical_url,
    'serviceType' => 'Book editing',
    'areaServed'  => 'Ireland',
];
include __DIR__ . '/includes/location-schema.php';

include __DIR__ . '/includes/footer.php';
