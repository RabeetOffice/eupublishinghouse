<?php require_once __DIR__ . '/config.php'; ?>
</main><!-- /.site-main -->

<footer class="site-footer">
    <svg class="footer-feather" viewBox="0 0 120 200" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path d="M60 10 C 25 60, 25 150, 60 190 C 95 150, 95 60, 60 10 Z" fill="#6CB04C"/>
        <path d="M60 10 L 60 190" stroke="#fff" stroke-width="1.5"/>
        <path d="M60 40 L 35 65 M60 60 L 30 90 M60 80 L 28 110 M60 100 L 30 130 M60 120 L 35 150 M60 140 L 42 170" stroke="#fff" stroke-width=".8" opacity=".6"/>
        <path d="M60 40 L 85 65 M60 60 L 90 90 M60 80 L 92 110 M60 100 L 90 130 M60 120 L 85 150 M60 140 L 78 170" stroke="#fff" stroke-width=".8" opacity=".6"/>
    </svg>
    <div class="container">

        <div class="footer-top">

            <div class="footer-brand-col">
                <a href="<?= link_to('index.php') ?>" class="footer-brand" aria-label="<?= safe(WEBSITE_NAME) ?> home">
                    <img src="<?= asset('images/logo.webp') ?>" alt="<?= safe(WEBSITE_NAME) ?>" loading="lazy" decoding="async">
                </a>
                <p class="footer-about">
                    EU Publishing House helps writers publish professional books. We provide publishing, editing, ghostwriting, design, formatting, and marketing services. Our team supports authors from the first draft to the final published book.
                </p>
                <ul class="footer-social" role="list">
                    <li><a href="<?= SOCIAL_FACEBOOK ?>"  target="_blank" rel="noopener" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a href="<?= SOCIAL_INSTAGRAM ?>" target="_blank" rel="noopener" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href="<?= SOCIAL_LINKEDIN ?>"  target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a></li>
                    <li><a href="<?= SOCIAL_TWITTER ?>"   target="_blank" rel="noopener" aria-label="X"><i class="fa-brands fa-x-twitter"></i></a></li>
                    <li><a href="<?= SOCIAL_YOUTUBE ?>"   target="_blank" rel="noopener" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a></li>
                    <li><a href="<?= SOCIAL_PINTEREST ?>" target="_blank" rel="noopener" aria-label="Pinterest"><i class="fa-brands fa-pinterest-p"></i></a></li>
                </ul>
            </div>

            <div class="footer-links-col">
                <h4 class="footer-title">Explore</h4>
                <ul class="footer-links">
                    <li><a href="<?= link_to('index.php') ?>">Home</a></li>
                    <li><a href="<?= link_to('about.php') ?>">About</a></li>
                    <li><a href="<?= link_to('portfolios.php') ?>">Portfolio</a></li>
                    <li><a href="<?= link_to('blog.php') ?>">Journal</a></li>
                    <li><a href="<?= link_to('testimonial.php') ?>">Testimonials</a></li>
                    <li><a href="<?= link_to('faq.php') ?>">FAQs</a></li>
                    <li><a href="<?= link_to('contact.php') ?>">Contact</a></li>
                </ul>
            </div>

            <div class="footer-links-col">
                <h4 class="footer-title">Services</h4>
                <ul class="footer-links">
                    <li><a href="<?= link_to('publishing.php') ?>">Publishing</a></li>
                    <li><a href="<?= link_to('editing.php') ?>">Editing</a></li>
                    <li><a href="<?= link_to('ghostwriting.php') ?>">Ghostwriting</a></li>
                    <li><a href="<?= link_to('design.php') ?>">Cover Design</a></li>
                    <li><a href="<?= link_to('formatting.php') ?>">Formatting</a></li>
                    <li><a href="<?= link_to('marketing.php') ?>">Marketing</a></li>
                </ul>
            </div>

            <div class="footer-contact-col">
                <h4 class="footer-title">Editorial Desk</h4>
                <ul class="footer-contact">
                    <li><i class="fa-solid fa-location-dot"></i><a href="https://g.page/r/CfC-n6QmdJxNEBM/" target="_blank" rel="noopener noreferrer"><?= safe(ADDRESS) ?></a></li>
                    <li><i class="fa-solid fa-phone"></i><a href="tel:<?= PHONE_NUMBER_RAW ?>"><?= safe(PHONE_NUMBER) ?></a></li>
                    <li><i class="fa-solid fa-envelope"></i><a href="mailto:<?= EMAIL_ADDRESS ?>"><?= safe(EMAIL_ADDRESS) ?></a></li>
                </ul>
                <?php include __DIR__ . '/forms/newsletter.php'; ?>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?= date('Y') ?> <?= safe(WEBSITE_NAME) ?>. All rights reserved.</p>
            <ul class="footer-legal">
                <li><a href="<?= link_to('privacy-policy.php') ?>">Privacy Policy</a></li>
                <li><a href="<?= link_to('terms-conditions.php') ?>">Terms &amp; Conditions</a></li>
                <li><a href="<?= link_to('contact.php') ?>">Contact</a></li>
            </ul>
        </div>
    </div>
</footer>

<button id="toTop" class="to-top" aria-label="Back to top">
    <i class="fa-solid fa-arrow-up"></i>
</button>

<!-- Glass live-chat toggle (wired to Tawk.to when TAWK_PROPERTY_ID is set) -->
<button id="liveChatBtn" class="live-chat-btn" type="button" aria-label="Open live chat">
    <span class="lc-icon">
        <i class="fa-solid fa-comment-dots"></i>
        <span class="lc-pulse" aria-hidden="true"></span>
    </span>
    <span class="lc-label">
        <span class="top">We're online</span>
        <span class="bot">Live chat</span>
    </span>
</button>

<!-- Floating WhatsApp contact -->
<a id="whatsappBtn"
   class="whatsapp-btn"
   href="https://wa.me/353899595672"
   target="_blank"
   rel="noopener"
   aria-label="Chat with us on WhatsApp at +353 89 959 5672">
    <span class="wa-icon">
        <i class="fa-brands fa-whatsapp"></i>
        <span class="wa-pulse" aria-hidden="true"></span>
    </span>
    <span class="wa-label">
        <span class="top">WhatsApp</span>
        <span class="bot">+353 89 959 5672</span>
    </span>
</a>

<?php include __DIR__ . '/forms/manuscript-popup.php'; ?>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" defer></script>
<script src="<?= asset('js/main.js') ?>" defer></script>

<?php if (TAWK_PROPERTY_ID): ?>
<!-- Tawk.to live chat -->
<script>
    var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();

    /* Hide the default Tawk bubble at every lifecycle hook so only our
       custom .live-chat-btn launches the chat. */
    function _euphHideTawk() {
        try { if (window.Tawk_API && Tawk_API.hideWidget) Tawk_API.hideWidget(); } catch (e) {}
    }
    /* When Tawk's chat panel is open, hide our floating Live chat pill and
       the back-to-top button so they don't overlap the Tawk window. */
    function _euphChatOpen()  { document.body.classList.add('chat-open'); }
    function _euphChatClose() { document.body.classList.remove('chat-open'); _euphHideTawk(); }

    Tawk_API.onLoad           = _euphHideTawk;
    Tawk_API.onStatusChange   = _euphHideTawk;
    Tawk_API.onChatMaximized  = _euphChatOpen;
    Tawk_API.onChatMinimized  = _euphChatClose;
    Tawk_API.onChatHidden     = _euphChatClose;
    Tawk_API.onChatEnded      = _euphChatClose;

    /* Single helper used by the floating Live Chat button to open Tawk. */
    window.openTawkChat = function () {
        if (!window.Tawk_API) return false;
        try {
            if (typeof Tawk_API.showWidget === 'function') Tawk_API.showWidget();
            if (typeof Tawk_API.maximize === 'function') {
                Tawk_API.maximize();
                _euphChatOpen();
                return true;
            }
            if (typeof Tawk_API.toggle === 'function') {
                Tawk_API.toggle();
                _euphChatOpen();
                return true;
            }
        } catch (e) { /* swallow — JS fallback below */ }
        return false;
    };

    (function () {
        var s1 = document.createElement('script'), s0 = document.getElementsByTagName('script')[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/<?= safe(TAWK_PROPERTY_ID) ?>/<?= safe(TAWK_WIDGET_ID) ?>';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>
<?php endif; ?>
</body>
</html>
