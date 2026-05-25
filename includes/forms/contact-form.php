<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../recaptcha.php';
?>
<form class="contact-form site-form" action="<?= safe(link_to('form-submission.php')) ?>" method="post" novalidate data-form-action="contact_form">
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">First Name <span class="opt">(required)</span></label>
            <input type="text" name="first_name" class="form-control" placeholder="Your given name" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Last Name <span class="opt">(required)</span></label>
            <input type="text" name="last_name" class="form-control" placeholder="Your family name" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Email <span class="opt">(required)</span></label>
            <input type="email" name="email" class="form-control" placeholder="hello@yourdomain.com" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Phone <span class="opt">(required)</span></label>
            <input type="tel" name="phone" class="form-control" placeholder="+353 ..." required>
        </div>
        <div class="col-md-12">
            <label class="form-label">I&rsquo;m Interested in <span class="opt">(required)</span></label>
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
            <label class="form-label">Message</label>
            <textarea name="message" rows="5" class="form-control" placeholder="Tell us a little about your project , a short paragraph is plenty."></textarea>
        </div>
        <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <small class="form-note"><i class="fa-solid fa-lock"></i> Your details stay confidential.</small>
            <button type="submit" class="btn btn-cta btn-lg" data-no-popup>
                <span class="btn-label">Get My Free Quote</span>
                <i class="fa-solid fa-arrow-right"></i>
            </button>
        </div>
    </div>
    <input type="hidden" name="form_type" value="contact">
    <input type="hidden" name="source_page" value="">
    <?php recaptcha_field('contact_form'); ?>
</form>
