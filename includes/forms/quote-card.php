<?php require_once __DIR__ . '/../config.php'; ?>
<aside class="quote-card" data-aos="fade-left">
    <div class="quote-card__head">
        <span class="quote-card__mark" aria-hidden="true">
            <img src="<?= img('favicon.png') ?>" alt="" style="height: 30px; margin-right: -4px;" loading="lazy" decoding="async">
        </span>
        <h3 class="quote-card__title">
            Get a free <em class="gold-italic">Consultation &amp; Manuscript Review.</em>
        </h3>
    </div>
    <form class="quote-card__form" action="#" method="post" novalidate>
        <div class="row g-3">
            <div class="col-sm-6">
                <label class="form-label">First Name <span class="opt">(required)</span></label>
                <input type="text" name="first_name" class="form-control" placeholder="John" required>
            </div>
            <div class="col-sm-6">
                <label class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control" placeholder="Smith">
            </div>
            <div class="col-sm-6">
                <label class="form-label">Email <span class="opt">(required)</span></label>
                <input type="email" name="email" class="form-control" placeholder="john.smith@example.com" required>
            </div>
            <div class="col-sm-6">
                <label class="form-label">Phone <span class="opt">(required)</span></label>
                <input type="tel" name="phone" class="form-control" placeholder="+353 ..." required>
            </div>
            <div class="col-12">
                <label class="form-label">I&rsquo;m Interested in</label>
                <select name="service" class="form-select">
                    <option value="">Select a Service</option>
                    <option>Book Publishing</option>
                    <option>Book Editing</option>
                    <option>Ghostwriting</option>
                    <option>Book Cover Design</option>
                    <option>Book Formatting</option>
                    <option>Book Marketing</option>
                    <option>Other Services</option>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label">Tell us about your book</label>
                <textarea name="message" rows="3" class="form-control" placeholder="A short paragraph is plenty. We'll write back personally."></textarea>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-cta btn-lg w-100" data-no-popup>
                    Submit <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>
            <div class="col-12 d-flex justify-content-center align-items-center">
                <small class="form-note"><i class="fa-solid fa-lock"></i> Your manuscript stays confidential.</small>
            </div>
        </div>
    </form>
</aside>
