<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../recaptcha.php';
?>
<!-- ===== GLOBAL POPUP FORM ===== -->
<div class="popup-overlay" id="popupOverlay" aria-hidden="true" role="presentation">
    <div class="popup-modal" role="dialog" aria-modal="true" aria-labelledby="popupTitle">
        <button class="popup-close" id="popupClose" type="button" aria-label="Close form">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="popup-grid">

            <aside class="popup-aside">
                <span class="popup-aside__bg" aria-hidden="true">
                    <span class="popup-blob popup-blob--1"></span>
                    <span class="popup-blob popup-blob--2"></span>
                </span>
                <div class="popup-aside__inner">
                    <span class="eyebrow eyebrow--light">Speak with our team</span>
                    <h3 class="popup-title" id="popupTitle">Get a free <em class="gold-italic">consultation</em> for your book.</h3>
                    <p class="popup-lead">Tell us about your book and the service you're after. A senior editor will reply personally with a clear plan and a realistic quote, no automated screening, no sales pitch.</p>
                    <ul class="popup-perks">
                        <li><i class="fa-solid fa-check"></i>Free editorial consultation</li>
                        <li><i class="fa-solid fa-check"></i>Honest, no-pressure quote</li>
                        <li><i class="fa-solid fa-check"></i>Personal reply within four weeks</li>
                        <li><i class="fa-solid fa-check"></i>You keep your rights &amp; royalties</li>
                    </ul>
                    <div class="popup-contact">
                        <a href="mailto:<?= EMAIL_ADDRESS ?>"><i class="fa-solid fa-envelope"></i><?= safe(EMAIL_ADDRESS) ?></a>
                        <a href="tel:<?= PHONE_NUMBER_RAW ?>"><i class="fa-solid fa-phone"></i><?= safe(PHONE_NUMBER) ?></a>
                    </div>
                </div>
            </aside>

            <form class="popup-form site-form" action="<?= safe(link_to('form-submission.php')) ?>" method="post" novalidate id="popupForm" data-form-action="popup_quote">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" placeholder="Your given name" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" placeholder="Your family name" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="hello@yourdomain.com" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="tel" name="phone" class="form-control" placeholder="+353 ..." required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">I&rsquo;m Interested in</label>
                        <select name="service" class="form-select" required>
                            <option value="">Select a service</option>
                            <option>Book Publishing</option>
                            <option>3D Book Cover Design</option>
                            <option>Book Marketing</option>
                            <option>Proof-Reading</option>
                            <option>Author&rsquo;s Website Development</option>
                            <option>Book Writing</option>
                            <option>Other Services</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Tell us about your book</label>
                        <textarea name="message" rows="4" class="form-control" placeholder="A short paragraph is plenty. We'll write back personally."></textarea>
                    </div>
                    <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <small class="form-note"><i class="fa-solid fa-lock"></i> Your details stay confidential.</small>
                        <button type="submit" class="btn btn-cta btn-lg" data-no-popup>
                            <span class="btn-label">Get My Free Quote</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
                <input type="hidden" name="form_type" value="popup">
                <input type="hidden" name="source_page" value="">
                <?php recaptcha_field('popup_quote'); ?>
            </form>

        </div>
    </div>
</div>
