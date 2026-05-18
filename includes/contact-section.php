<?php require_once __DIR__ . '/config.php'; ?>
<section class="contact-section" id="submit">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <span class="eyebrow">Submit · Talk · Visit</span>
                <h2 class="section-title">A short note is enough to <em class="gold-italic">begin.</em></h2>
                <p class="section-lead">Whether you have a finished manuscript or simply a question, our editorial desk replies personally to every enquiry.</p>

                <ul class="contact-list" role="list">
                    <li>
                        <span class="contact-ico"><i class="fa-solid fa-envelope"></i></span>
                        <div>
                            <small>Editorial</small>
                            <a href="mailto:<?= EMAIL_ADDRESS ?>"><?= safe(EMAIL_ADDRESS) ?></a>
                        </div>
                    </li>
                    <li>
                        <span class="contact-ico"><i class="fa-solid fa-phone"></i></span>
                        <div>
                            <small>Reception</small>
                            <a href="tel:<?= PHONE_NUMBER_RAW ?>"><?= safe(PHONE_NUMBER) ?></a>
                        </div>
                    </li>
                    <li>
                        <span class="contact-ico"><i class="fa-solid fa-location-dot"></i></span>
                        <div>
                            <small>Studio</small>
                            <p><?= safe(ADDRESS) ?></p>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="col-lg-7" data-aos="fade-left">
                <form class="contact-form" action="#" method="post" novalidate>
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
                            <label class="form-label">Phone <span class="opt">(optional)</span></label>
                            <input type="tel" name="phone" class="form-control" placeholder="+353 ...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Manuscript Genre</label>
                            <select name="genre" class="form-select">
                                <option>Literary Fiction</option>
                                <option>Memoir &amp; Biography</option>
                                <option>Business &amp; Leadership</option>
                                <option>Children &amp; YA</option>
                                <option>Poetry &amp; Essays</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Stage</label>
                            <select name="stage" class="form-select">
                                <option>Finished manuscript</option>
                                <option>First draft</option>
                                <option>Outline / proposal</option>
                                <option>Just an idea</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Tell us about your book</label>
                            <textarea name="message" rows="5" class="form-control" placeholder="A short paragraph is plenty. We'll write back personally." required></textarea>
                        </div>
                        <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <small class="form-note"><i class="fa-solid fa-lock"></i> Your manuscript stays confidential.</small>
                            <button type="submit" class="btn btn-cta btn-lg">
                                Submit to Editorial <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
