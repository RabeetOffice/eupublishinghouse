<?php require_once __DIR__ . '/config.php'; ?>
<section class="about-snippet" id="about">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="about-collage">
                    <span class="about-img about-img--1"></span>
                    <span class="about-img about-img--2"></span>
                    <span class="about-img about-img--3"></span>
                    <span class="about-badge">
                        <strong>Est. 2014</strong>
                        <span>Dublin · Ireland</span>
                    </span>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="eyebrow">About the House</span>
                <h2 class="section-title">A publisher for writers who believe a book is still a <em class="gold-italic">cultural artefact.</em></h2>
                <p class="about-lead">
                    Founded in a quiet Dublin studio, <?= safe(WEBSITE_NAME) ?> exists for authors who want their work read in fifty years, not just fifty days.
                    We publish a small, curated list each year — and put everything we have behind every book.
                </p>
                <ul class="about-list" role="list">
                    <li><i class="fa-solid fa-check"></i>Independent &amp; author-owned royalties</li>
                    <li><i class="fa-solid fa-check"></i>European production standards</li>
                    <li><i class="fa-solid fa-check"></i>Worldwide distribution &amp; rights</li>
                </ul>
                <a href="about.php" class="btn btn-cta" data-no-popup>Read Our Story <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>
