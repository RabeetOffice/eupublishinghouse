<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../recaptcha.php';
?>
<aside class="quote-card">
    <div class="quote-card__head">
        <span class="quote-card__ico" aria-hidden="true">
            <i class="fa-solid fa-feather"></i>
        </span>
        <div>
            <span class="quote-card__eyebrow">Free Consultation</span>
            <h3 class="quote-card__title">
                Get a free manuscript <em class="serif-italic">review</em>
            </h3>
        </div>
    </div>

    <p class="quote-card__lead">
        Send us your manuscript or a short note. A senior editor will read it personally and reply, no auto-screening, no sales pitch.
    </p>

    <form class="quote-card__form site-form" action="<?= safe(link_to('form-submission.php')) ?>" method="post" novalidate data-form-action="quote_card">
        <div class="qc-grid">
            <label class="qc-field">
                <span class="qc-label">First name</span>
                <input type="text" name="first_name" placeholder="John" required>
            </label>
            <label class="qc-field">
                <span class="qc-label">Last name</span>
                <input type="text" name="last_name" placeholder="Smith">
            </label>
            <label class="qc-field">
                <span class="qc-label">Email</span>
                <input type="email" name="email" placeholder="you@yourdomain.com" required>
            </label>
            <label class="qc-field">
                <span class="qc-label">Phone</span>
                <input type="tel" name="phone" placeholder="+353 ...">
            </label>
            <label class="qc-field qc-field--full">
                <span class="qc-label">I'm interested in</span>
                <select name="service">
                    <option value="">Choose a service</option>
                    <option>Book Publishing</option>
                    <option>Book Editing</option>
                    <option>Ghostwriting</option>
                    <option>Book Cover Design</option>
                    <option>Book Formatting</option>
                    <option>Book Marketing</option>
                    <option>Other Services</option>
                </select>
            </label>
            <label class="qc-field qc-field--full">
                <span class="qc-label">Tell us about your book</span>
                <textarea name="message" rows="3" placeholder="A short paragraph is plenty. We'll write back personally."></textarea>
            </label>
        </div>

        <button type="submit" class="btn btn-cta btn-lg qc-submit" data-no-popup>
            <span class="btn-label">Submit to Editorial</span>
            <i class="fa-solid fa-arrow-right"></i>
        </button>

        <div class="qc-note">
            <i class="fa-solid fa-lock"></i>
            Your manuscript stays confidential.
        </div>

        <input type="hidden" name="form_type" value="quote_card">
        <input type="hidden" name="source_page" value="">
        <?php recaptcha_field('quote_card'); ?>
    </form>
</aside>
