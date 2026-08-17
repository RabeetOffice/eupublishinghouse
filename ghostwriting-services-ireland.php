<?php
/* =================================================================
   /ghostwriting-services-ireland/
   Ireland location cluster — ghostwriting. Copy from the content brief
   "Ghostwriting Services Ireland | Write Your Book With Experts".
================================================================= */

require_once __DIR__ . '/includes/locations-data.php';

$locKey = 'ireland';
$loc    = location_get($locKey);
$svc    = $loc['services']['ghostwriting'];

$page_title       = 'Ghostwriting Services Ireland | Your Story, Told Right';
$page_description = 'Professional ghostwriting services in Ireland to turn your ideas into a polished, publish-ready book. Confidential, skilled writers who capture your voice.';
$page_keywords    = 'ghostwriting services Ireland, ghostwriter Ireland, autobiography ghostwriting Ireland, ebook ghostwriting Ireland, business ghostwriter Ireland';
$canonical_url    = location_abs($svc['href']);

require __DIR__ . '/includes/header.php';

$hero = [
    'crumbs' => [
        ['label' => 'Locations', 'href' => link_to('locations.php')],
        ['label' => 'Ireland',   'href' => location_url($locKey)],
        ['label' => 'Ghostwriting'],
    ],
    'title'      => 'Ghostwriting Services Ireland: Turning Your Ideas Into <em class="serif-italic">a Compelling Book</em>',
    'paragraphs' => [
        "Everyone has a story worth telling. Not everyone has the time, the training, or the confidence to sit down and write it. That’s where we come in.",
        "EU Publishing House works with people across Ireland who have something to say but need a skilled writer to say it well. Maybe you’re a business owner who wants a book that builds your reputation. Maybe you’re a parent who wants to leave your life story behind for your children. Maybe you’re a researcher who needs help getting your work into proper written form. Whatever the reason, we listen, we write, and we hand you a finished piece of work with your name on it.",
        "We offer ghostwriting services in Ireland for books, business content, speeches, articles, and more. Every project starts with a conversation, not a template. We want to understand your voice, your goals and your deadline before we write a single word.",
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
     WHAT WE WRITE
     ============================================================ -->
<section class="services-section" id="what-we-write">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">What We Write</span>
            <h2 class="section-title">Ghostwriting services in Ireland built around <em class="serif-italic">your real voice</em></h2>
            <p>Ghostwriting is a broad term, so let’s break it down into the areas we work in most often. Each type of project has its own rhythm, and we adjust our approach depending on what you need.</p>
        </div>

        <div class="services-grid">
            <?php
            $types = [
                ['fa-book', 'Books and Memoirs',
                 '<p>This is the heart of what we do. Whether it’s a novel, a business book, or a personal memoir, we work closely with you to shape your ideas into a finished manuscript. You bring the story and the knowledge. We bring the structure, the pacing, and the polish.</p><p>Some clients arrive with a full outline already in their head. Others arrive with a box of old letters, a head full of memories, and no idea where to start. Both are fine. Part of our job is helping you find the shape of the book before we start writing chapters, so the finished manuscript feels planned rather than pieced together.</p>'],
                ['fa-user-pen', 'Autobiographies',
                 '<p>Writing about your own life is harder than it sounds. Memories don’t come out in order, and it’s easy to lose the thread halfway through. We specialise in ghostwriting autobiographies in Ireland projects, sitting down with clients over a series of conversations and turning those memories into a book that reads like it was written in one sitting, even though it took months of careful work.</p>'],
                ['fa-briefcase', 'Business and Corporate Writing',
                 '<p>Founders, executives, and consultants often have valuable insight but no time to write it down properly. We write leadership books, thought pieces, company histories and internal training material that sounds like you, not like a corporate press release.</p><p>This kind of writing usually needs a few conversations to get right. We ask about the decisions you’ve made, the mistakes you’ve learned from, and the way you explain things to your own team. Then we turn that into writing that reads naturally, rather than a stiff summary of your career.</p>'],
                ['fa-tablet-screen-button', 'Ebooks and Digital Content',
                 '<p>Short-form guides, lead magnets and digital books are a fast, affordable way to build authority online. Our ebook ghostwriting services in Ireland cover everything from planning the outline to writing the final chapter, ready for you to publish or give away to your audience.</p>'],
                ['fa-graduation-cap', 'Academic and Research Support',
                 '<p>Students, researchers, and professionals sometimes need help turning dense material into clear, well-organised writing. Our academic ghostwriting services in Ireland are built for structure and clarity, helping writers present their own research and ideas in a properly formatted, readable way. We do not write assignments to be passed off as original student work for assessment. Our academic support is aimed at theses, reports, portfolios and research writing where professional writing assistance is permitted.</p>'],
                ['fa-microphone-lines', 'Speeches and Personal Pieces',
                 '<p>Wedding speeches, eulogies, retirement speeches and other personal writing. These are short projects, but they matter enormously to the person delivering them. We take extra care to get the tone right, because there’s no room for a second draft on the day.</p>'],
            ];
            foreach ($types as $i => $s): ?>
                <article class="service-card service-card--tall" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 80 ?>">
                    <span class="service-icon"><i class="fa-solid <?= $s[0] ?>"></i></span>
                    <h3 class="service-title"><?= $s[1] ?></h3>
                    <div class="service-desc"><?= $s[2] ?></div>
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
            <span class="eyebrow">Who We Write For</span>
            <h2 class="section-title">Stories we shape for Ireland authors, experts <em class="serif-italic">and everyday lives</em></h2>
            <p>Our clients come from all walks of life. Some of the people we’ve helped include:</p>
        </div>

        <div class="loc-audience-grid">
            <?php
            $audience = [
                ['fa-briefcase',      'Business owners who want a book to support their brand'],
                ['fa-book-open',      'First-time authors who have a story but no writing experience'],
                ['fa-house-user',     'Parents and grandparents who want to record their life story'],
                ['fa-chalkboard-user','Consultants and coaches who want a book to build credibility'],
                ['fa-graduation-cap', 'Students and professionals who need help structuring research writing'],
                ['fa-champagne-glasses','Anyone preparing a speech for a wedding, funeral, or big event'],
            ];
            foreach ($audience as $i => $a): ?>
                <div class="loc-audience-item" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 70 ?>">
                    <i class="fa-solid <?= $a[0] ?>"></i>
                    <span><?= $a[1] ?></span>
                </div>
            <?php endforeach; ?>
        </div>

        <p class="loc-note" data-aos="fade-up">If you fall into one of these groups, or somewhere close to it, we can probably help. If you’re not sure, get in touch, and we’ll tell you honestly whether we’re the right fit.</p>
    </div>
</section>

<!-- ============================================================
     HOW TO CHOOSE
     ============================================================ -->
<section class="section loc-check-sec" id="how-to-choose">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Before You Hire Anyone</span>
            <h2 class="section-title">How to choose an Irish ghostwriter <em class="serif-italic">without losing your voice</em></h2>
            <p>Not every ghostwriter is the same, and not every writing service is honest about what they can deliver. Before you hire anyone, ask these questions:</p>
        </div>

        <div class="loc-check-grid">
            <?php
            $questions = [
                'Will I own the copyright to the finished work? A proper contract should hand full rights to you.',
                'Will I see sample chapters before the full project is finished, or only at the very end?',
                'Is confidentiality written into the contract, not just promised verbally?',
                'How many rounds of revisions are included in the price?',
                'Will the same writer stay on my project from start to finish?',
                'What happens if I’m not happy with the first draft?',
                'Is the pricing clear from the start, or will extra costs appear later?',
            ];
            foreach ($questions as $i => $q): ?>
                <div class="loc-check-card" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 70 ?>">
                    <span class="loc-check-card__n"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                    <p><?= $q ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <p class="loc-note" data-aos="fade-up">Any honest provider, including us, should be able to answer these questions without hesitation. If a writer avoids these questions or gives vague answers, take that as a warning sign.</p>
    </div>
</section>

<!-- ============================================================
     WHAT A TRAINED WRITER BRINGS
     ============================================================ -->
<section class="section section-mint loc-benefit-sec" id="why-it-matters">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="eyebrow">Why It Matters</span>
            <h2 class="section-title">Why Ireland best ghostwriting turns raw ideas <em class="serif-italic">into powerful books</em></h2>
            <p>Writing a full-length book or a polished piece of business content is a different skill from writing an email or a report. It takes planning, structure, and an understanding of how to keep a reader interested for a whole chapter, not just a paragraph. Here’s what a trained writer brings to your project:</p>
        </div>

        <div class="loc-benefit-grid">
            <?php
            $benefits = [
                ['fa-sitemap',      'Structure',    'Turning scattered ideas or memories into chapters that flow in a logical order.'],
                ['fa-gauge-high',   'Pacing',       'Knowing when to slow down for detail and when to move the story along.'],
                ['fa-equals',       'Consistency',  'Keeping the tone and voice steady across a long piece of writing.'],
                ['fa-scissors',     'Editing skill','Spotting repetition, gaps and weak sections that are hard to see in your own writing.'],
                ['fa-clock',        'Time saved',   'Freeing you up to focus on your business, your family or your research, while the writing gets done.'],
            ];
            foreach ($benefits as $i => $b): ?>
                <article class="loc-benefit-card" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 70 ?>">
                    <span class="loc-benefit-card__icon"><i class="fa-solid <?= $b[0] ?>"></i></span>
                    <h3><?= $b[1] ?></h3>
                    <p><?= $b[2] ?></p>
                </article>
            <?php endforeach; ?>
        </div>

        <p class="loc-note" data-aos="fade-up">A book written without this kind of support often reads unevenly, with strong sections next to weak ones. A professionally written book reads the same from the first page to the last. This matters just as much for shorter projects. A speech that rambles loses the room. A business chapter that buries its point under too much detail loses the reader’s attention. Good writing is about knowing what to leave out just as much as what to put in, and that’s a skill that takes years to build.</p>
    </div>
</section>

<?php
/* ---- Process (6 steps from the brief) ---- */
$processEyebrow = 'Conversation to Manuscript';
$processTitle   = 'How our ghostwriting process <em class="serif-italic">works</em>';
$processIntro   = 'We keep the process simple and easy to follow, from the first phone call to the finished manuscript.';
$processSteps   = [
    ['n' => '01', 'title' => 'Free initial consultation',
        'desc' => 'We start with a conversation, either by phone or video call. You tell us about your project, your goals, and your timeline. We ask questions to understand your voice and your audience. There’s no cost and no obligation at this stage.'],
    ['n' => '02', 'title' => 'Proposal and quote',
        'desc' => 'Based on that conversation, we send you a clear proposal. It includes the scope of the project, the timeline, and the price. Nothing hidden, nothing added later.'],
    ['n' => '03', 'title' => 'Research and outline',
        'desc' => 'Once you’re happy to proceed, we build a detailed outline. For books and memoirs, this often involves recorded interviews where you talk us through your story or your ideas. For business or academic content, this stage involves reviewing your notes, research, or existing material.'],
    ['n' => '04', 'title' => 'Writing the first draft',
        'desc' => 'This is where the bulk of the work happens. We write in your voice, using the outline as our guide, and check in with you at agreed points so you’re never left wondering what’s happening with your project.'],
    ['n' => '05', 'title' => 'Review and revisions',
        'desc' => 'You read the draft and tell us what’s working and what needs to change. We revise until the manuscript matches what you had in mind. Revision rounds are agreed at the start, so there are no surprises.'],
    ['n' => '06', 'title' => 'Final delivery',
        'desc' => 'Once you’re happy with the final version, we hand over the finished manuscript, fully formatted and ready for publishing, printing, or whatever comes next for you.'],
];
include __DIR__ . '/includes/process.php';
?>

<!-- ============================================================
     WHY CLIENTS TRUST US
     ============================================================ -->
<section class="why-eph-sec" id="why-us">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="why-eph-art">
                    <img src="<?= asset('images/OurWriting.YourBook-2048x1559.webp') ?>" alt="Why Irish clients trust EU Publishing House with their stories" loading="lazy" decoding="async">
                    <span class="why-eph-art__chip">Confidential</span>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Why Clients Trust Us</span>
                <h2 class="section-title">Why Irish clients trust us with stories <em class="serif-italic">that matter</em></h2>
                <p>There are a few things that set us apart from other writing services in this space.</p>
                <ul class="loc-diff-list" role="list">
                    <li><i class="fa-solid fa-check"></i><span><strong>Clear, upfront pricing.</strong> We quote based on the actual size and complexity of your project, not a one-size-fits-all rate.</span></li>
                    <li><i class="fa-solid fa-check"></i><span><strong>Confidentiality as standard.</strong> Every project is covered by a confidentiality agreement, and your name stays off any promotional material unless you tell us otherwise.</span></li>
                    <li><i class="fa-solid fa-check"></i><span><strong>One writer, start to finish.</strong> You won’t be passed between different writers halfway through your project.</span></li>
                    <li><i class="fa-solid fa-check"></i><span><strong>Irish tone and spelling.</strong> Our writers understand Irish English and write content that sounds natural to an Irish reader, not translated from somewhere else.</span></li>
                    <li><i class="fa-solid fa-check"></i><span><strong>Honest communication.</strong> If something in your project isn’t working, we’ll tell you early, not after months of writing in the wrong direction.</span></li>
                    <li><i class="fa-solid fa-check"></i><span><strong>Full ownership.</strong> Once the project is complete, the finished work and the copyright belong entirely to you.</span></li>
                </ul>
                <p class="mt-3">We aim to be one of the more dependable, top ghostwriting services in Ireland, not by claiming to be the biggest, but by doing the work properly and treating every client’s story with the care it deserves.</p>
                <div class="mt-4">
                    <a href="#popup" class="btn btn-cta" data-popup>Start Your Book <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
/* ---- Shared six-service cross-link block ---- */
$coreLocation = $locKey;
$coreCurrent  = 'ghostwriting';
$coreEyebrow  = 'Complete Support';
$coreTitle    = 'Other services for authors: support for <em class="serif-italic">your finished book</em>';
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
                    <img src="<?= asset('images/MostBooksDon-2048x1835.webp') ?>" alt="Ghostwriting costs in Ireland explained" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Pricing</span>
                <h2 class="section-title">Ghostwriting costs in Ireland without <em class="serif-italic">hidden fees or guesswork</em></h2>
                <p>Pricing depends on the length, complexity, and research needed for your project. A short ebook costs less than a full memoir with dozens of interview hours behind it. Rather than quote a flat number that won’t apply to your project, we prefer to talk through what you need first and then send a clear, itemised quote.</p>
                <p>If you’re comparing ghostwriting services rates in Ireland, we’re happy to give you a straightforward quote alongside anyone else you’re considering. We believe in affordable ghostwriting services in Ireland that don’t cut corners on quality, and we’ll always explain exactly what’s included in the price before you commit to anything.</p>
                <a href="#popup" class="btn btn-cta btn-lg" data-popup>Get Your Free Quote <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<?php
$exclude_slug = 'ghostwriting';
include __DIR__ . '/includes/books-portfolio.php';

/* ---- FAQs ---- */
$faqId    = 'ireGhostFaq';
$faqTitle = 'Frequently asked <em class="serif-italic">questions</em>';
$faqs = [
    ['q' => 'How much do professional ghostwriting services in Ireland typically cost?',
     'a' => 'It depends on the length and complexity of the project. A short ebook will cost far less than a full book built from interviews. We always provide a clear, itemised quote after our first conversation, so you know the full cost before you commit.'],
    ['q' => 'Will I own the rights to my book once it’s finished?',
     'a' => 'Yes. Once the project is complete and paid for, full copyright belongs to you. This is written into our contract before any work begins.'],
    ['q' => 'How long does it take to write a book?',
     'a' => 'Most full-length books take between four and nine months, depending on the length, the amount of research involved, and how quickly we can schedule interviews with you. Shorter projects, like ebooks or speeches, take considerably less time.'],
    ['q' => 'Do you offer ghostwriting services outside Dublin?',
     'a' => 'Yes. We work with clients across the whole of Ireland, not just Dublin. Most of our process happens over phone and video calls, so your location doesn’t limit how we work together.'],
    ['q' => 'Can you help with a book I’ve already started writing?',
     'a' => 'Yes. Many clients come to us partway through a project. We can review what you have, suggest how to finish it, and either write the remaining sections or edit what’s already there.'],
    ['q' => 'Is my project kept confidential?',
     'a' => 'Yes. Confidentiality is built into every contract. We won’t discuss your project or use your name in our marketing unless you specifically agree to it.'],
    ['q' => 'What makes your service different from other ghostwriters in Ireland?',
     'a' => 'We keep the same writer on your project from start to finish, we’re upfront about pricing from the beginning, and we take the time to understand your voice before we start writing. We’d rather do fewer projects well than take on more than we can properly manage.'],
];
include __DIR__ . '/includes/location-faq.php';

/* ---- Closing CTA ---- */
$ctaEyebrow = 'Ready When You Are';
$ctaTitle   = 'Ready to turn your story <em class="serif-italic">into a finished book?</em>';
$ctaSub     = 'If you’ve got a story, an idea, or a manuscript sitting in your head or scattered across old notes, we’d like to hear about it. Get in touch for a free, no-obligation chat about your project. There’s no pressure and no sales pitch, just an honest conversation about whether we’re the right fit to help you get your words on the page.';
include __DIR__ . '/includes/final-cta.php';

/* ---- Structured data ---- */
$schemaCrumbs = [
    ['name' => 'Locations',    'url' => rtrim(BRAND_SITE_URL, '/') . '/locations/'],
    ['name' => 'Ireland',      'url' => location_abs($loc['hub'])],
    ['name' => 'Ghostwriting', 'url' => $canonical_url],
];
$schemaService = [
    'name'        => 'Ghostwriting Services in Ireland',
    'description' => $page_description,
    'url'         => $canonical_url,
    'serviceType' => 'Ghostwriting',
    'areaServed'  => 'Ireland',
];
include __DIR__ . '/includes/location-schema.php';

include __DIR__ . '/includes/footer.php';
