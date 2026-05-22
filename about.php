<?php
require_once __DIR__ . '/includes/config.php';

$page_title       = 'About Us | ' . BRAND_NAME;
$page_description = 'European Publishing House started in 2021 to give authors across Europe professional publishing support without the gatekeepers. Over 800 books published, every one treated like it matters.';
$page_keywords    = 'about European Publishing House, hybrid publisher Dublin, Irish book publisher, EU Publishing House story';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/about.php';

require __DIR__ . '/includes/header.php';

$banner = [
    'crumb' => 'About Us',
    'title' => 'Welcome to <em class="serif-italic">European Publishing House</em>',
    'sub'   => 'Author-first publishing for writers across Europe who want the quality of a traditional house without the gatekeepers.',
];
include __DIR__ . '/includes/page-banner.php';
?>

<!-- ============================================================
     WELCOME / INTRO
     ============================================================ -->
<section class="about-snippet" id="about">
    <div class="about-snippet__image"></div>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 about-snippet__spacer" aria-hidden="true">
                <div class="about-image" data-aos="fade-right">
                    <img src="assets/images/about-image.png" alt="Inside the EU Publishing House editorial studio"
                        loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-lg-6 about-snippet__copy" data-aos="fade-left">
                <span class="eyebrow">Our Story</span>
                <h2 class="section-title about-snippet__title">
                    Welcome to <em class="serif-italic">European Publishing House</em>
                </h2>
                <p>We started European Publishing House in 2021 because authors across Europe deserved a better way to
                    publish. Before that, we spent years working closely with writers from all corners of the continent,
                    and what we kept seeing was the same thing, talented people with genuinely good manuscripts, let
                    down by a process that was either too closed off, too expensive, or too indifferent to actually help
                    them. So we built something different.</p>
                <p>European Publishing House exists to give authors the kind of publishing support that used to be
                    reserved for the few, professional editing that makes your writing sharper, cover design that makes
                    your book impossible to scroll past, marketing that puts it in front of the right readers, and
                    distribution that gets it onto every major platform worldwide. We&rsquo;ve published over 800 books
                    since 2021 across every genre, and the one thing that hasn&rsquo;t changed is that we treat every
                    manuscript like it matters. Because it does.</p>
                <p>Whether you&rsquo;re working on your first novel or your fifth business book, you&rsquo;ll work
                    directly with a team that&rsquo;s genuinely invested in what you&rsquo;re trying to publish, not a
                    faceless process that moves your manuscript through a pipeline and sends you an invoice at the end.
                </p>
                <a href="contact.php#submit" class="btn btn-cta">Start the Conversation <i
                        class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     WHAT WE'RE HERE TO DO
     ============================================================ -->
<section class="publish-cost-sec" id="what-we-do">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Our Purpose</span>
                <h2 class="section-title">What We&rsquo;re <em class="serif-italic">Here to Do</em></h2>
                <p>Publishing is one of those industries that has a habit of making authors feel like they need it more
                    than it needs them. Long waiting lists, vague feedback, processes that nobody properly explains, it
                    puts a lot of good writers off before they&rsquo;ve even started. That&rsquo;s not how we work.</p>
                <p>Our job is straightforward: take the parts of publishing that are complicated, time-consuming, or
                    just genuinely confusing, and handle them properly so you don&rsquo;t have to. The editing, the
                    design, the formatting, the distribution, the marketing, all of it. You wrote the book.
                    That&rsquo;s the hard part. Everything that comes after it shouldn&rsquo;t feel harder.</p>
                <p>We work with authors across Europe who are publishing for the first time and authors who&rsquo;ve
                    been through the process before and want it done better this time. What they have in common is that
                    they want a team that&rsquo;s honest with them, transparent about what things cost, and actually
                    invested in whether their book succeeds. That&rsquo;s what we try to be, every time.</p>
            </div>
            <div class="col-lg-6" data-aos="fade-right">
                <div class="publish-cost-art">
                    <img src="assets/images/livesite/AuthorChoose.jpg"
                        alt="What European Publishing House is here to do" loading="lazy" decoding="async">
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/categories.php';?>


<!-- ============================================================
     BOOK PUBLISHERS YOU CAN TRUST
     ============================================================ -->
<section class="why-eph-sec" id="trust">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="why-eph-art">
                    <img src="assets/images/livesite/publishCostsection.jpg"
                        alt="Book publishers across Europe you can trust" loading="lazy" decoding="async">
                    <span class="why-eph-art__chip">Independent</span>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">Why Authors Trust Us</span>
                <h2 class="section-title">Book Publishers Across Europe You Can <em class="serif-italic">Actually
                        Trust</em></h2>
                <p>Being independent means we don&rsquo;t have shareholders to answer to or quarterly targets pushing us
                    to take on more than we can handle properly. What we have instead is a straightforward interest in
                    doing good work, because that&rsquo;s what keeps authors coming back, and it&rsquo;s what builds a
                    publishing house worth its name.</p>
                <p>We work with first-time authors who need someone to walk them through the process without making them
                    feel foolish for not already knowing it. We work with established writers who&rsquo;ve been through
                    traditional publishing and want more control this time around. We work with academics,
                    entrepreneurs, and industry specialists who have genuine expertise worth putting into a book. And we
                    work with storytellers across Europe, writers with distinct voices and regional perspectives that
                    deserve a wider audience than they&rsquo;d otherwise reach.</p>
                <p>Bigger publishers are juggling hundreds of authors at once. We&rsquo;re not. That difference shows up
                    in the quality of the feedback, the honesty of the advice, and the amount of care that goes into
                    each project. Your book isn&rsquo;t one of hundreds on a production line here. It gets proper
                    attention from people who&rsquo;ve actually read it.</p>
                <p>We&rsquo;ve published over 800 books across fiction, memoirs, business, children&rsquo;s literature,
                    non-fiction, and more since 2021. Every single one of them was treated as its own project, because
                    that&rsquo;s the only way to do this properly.</p>
                <a href="contact.php" class="btn btn-cta">Work With Us <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>



<?php
include __DIR__ . '/includes/distributors.php';
include __DIR__ . '/includes/books.php';
include __DIR__ . '/includes/services.php';
include __DIR__ . '/includes/testimonials.php';
include __DIR__ . '/includes/final-cta.php';
include __DIR__ . '/includes/footer.php';