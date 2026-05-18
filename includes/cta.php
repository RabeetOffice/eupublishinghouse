<?php require_once __DIR__ . '/config.php'; ?>
<section class="cta-section" id="cta">
    <div class="container">
        <div class="cta-card" data-aos="zoom-in">
            <div class="cta-bg" aria-hidden="true">
                <span class="cta-shape cta-shape--1"></span>
                <span class="cta-shape cta-shape--2"></span>
                <span class="cta-shape cta-shape--3"></span>
                <span class="paper-grain"></span>
            </div>
            <span class="eyebrow eyebrow--light">Ready to Begin?</span>
            <h2 class="cta-title">We&rsquo;re Invested in Your <em class="gold-italic">Book&rsquo;s Success</em></h2>
            <p class="cta-sub">Every book we publish gets the same level of care, whether it&rsquo;s your first or your fifth. We don&rsquo;t consider our job done until your book is out in the world and you&rsquo;re happy with it. That&rsquo;s been our standard since day one.</p>
            <div class="cta-row">
                <a href="contact.php#submit" class="btn btn-gold btn-lg magnetic">Start Publishing With Confidence <i class="fa-solid fa-arrow-right"></i></a>
                <a href="tel:<?= PHONE_NUMBER_RAW ?>" class="btn btn-outline-light btn-lg"><i class="fa-solid fa-phone"></i> <?= safe(PHONE_NUMBER) ?></a>
            </div>
        </div>
    </div>
</section>
