<?php require_once __DIR__ . '/config.php'; ?>
</main><!-- /.site-main -->

<footer class="site-footer">
    <div class="footer-grain" aria-hidden="true"></div>
    <div class="container">

        <div class="footer-top">
            <div class="row g-5">
                <div class="col-lg-4">
                    <a href="index.php" class="brand brand--footer" aria-label="<?= safe(WEBSITE_NAME) ?>">
                        <img src="<?= asset('images/logo.webp') ?>" style="filter : brightness(0) invert(1)" alt="<?= safe(WEBSITE_NAME) ?>">
                    </a>
                    <p class="footer-about">
                        European Publishing House helps writers publish professional books. We provide publishing, editing, ghostwriting, design, formatting and marketing services. Our team supports authors from the first draft to the final published book.
                    </p>
                    <ul class="footer-social" role="list">
                        <li><a href="<?= SOCIAL_FACEBOOK ?>"  target="_blank" rel="noopener" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
                        <li><a href="<?= SOCIAL_INSTAGRAM ?>" target="_blank" rel="noopener" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href="<?= SOCIAL_LINKEDIN ?>"  target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a></li>
                        <li><a href="<?= SOCIAL_TWITTER ?>"   target="_blank" rel="noopener" aria-label="X / Twitter"><i class="fa-brands fa-x-twitter"></i></a></li>
                        <li><a href="<?= SOCIAL_YOUTUBE ?>"   target="_blank" rel="noopener" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a></li>
                        <li><a href="<?= SOCIAL_PINTEREST ?>" target="_blank" rel="noopener" aria-label="Pinterest"><i class="fa-brands fa-pinterest-p"></i></a></li>
                    </ul>
                </div>

                <div class="col-6 col-lg-2">
                    <h4 class="footer-title">Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="portfolios.php">Portfolio</a></li>
                        <li><a href="blog.php">Blog</a></li>
                        <li><a href="testimonial.php">Testimonials</a></li>
                        <li><a href="faq.php">FAQs</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                    </ul>
                </div>

                <div class="col-6 col-lg-2">
                    <h4 class="footer-title">Services</h4>
                    <ul class="footer-links">
                        <li><a href="publishing.php">Publishing</a></li>
                        <li><a href="editing.php">Editing</a></li>
                        <li><a href="ghostwriting.php">Ghostwriting</a></li>
                        <li><a href="design.php">Cover Design</a></li>
                        <li><a href="marketing.php">Marketing</a></li>
                        <li><a href="formatting.php">Formatting</a></li>
                    </ul>
                </div>

                <div class="col-lg-4">
                    <h4 class="footer-title">Editorial Desk</h4>
                    <ul class="footer-contact">
                        <li><i class="fa-solid fa-location-dot"></i><?= safe(ADDRESS) ?></li>
                        <li><i class="fa-solid fa-phone"></i><a href="tel:<?= PHONE_NUMBER_RAW ?>"><?= safe(PHONE_NUMBER) ?></a></li>
                        <li><i class="fa-solid fa-envelope"></i><a href="mailto:<?= EMAIL_ADDRESS ?>"><?= safe(EMAIL_ADDRESS) ?></a></li>
                    </ul>
                    <?php include __DIR__ . '/forms/newsletter.php'; ?>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?= date('Y') ?> <?= safe(WEBSITE_NAME) ?>. All rights reserved.</p>
            <ul class="footer-legal">
                <li><a href="privacy-policy.php">Privacy Policy</a></li>
                <li><a href="terms-conditions.php">Terms &amp; Conditions</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
    </div>
</footer>

<button id="toTop" class="to-top" aria-label="Back to top">
    <i class="fa-solid fa-arrow-up"></i>
</button>

<?php include __DIR__ . '/forms/manuscript-popup.php'; ?>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" defer></script>
<script src="<?= asset('js/main.js') ?>" defer></script>
</body>
</html>
