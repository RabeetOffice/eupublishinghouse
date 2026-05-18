/* =========================================================
   EU PUBLISHING HOUSE — MAIN JS
   ========================================================= */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {

        /* ---------- AOS ----------
           Horizontal slide-in animations (data-aos="fade-left/fade-right")
           push elements offscreen during the start state, which makes the
           page wider than the viewport on tablet & mobile and triggers a
           horizontal scrollbar. Two defenses below:

           1. Re-tag every fade-left / fade-right element to a pure fade-up
              on viewports <992px so nothing translates horizontally.
           2. Pass `disableMutationObserver: true` so AOS doesn't re-process
              dynamically-added nodes (Owl-carousel clones etc) and add
              fresh offscreen translations after init. */
        if (window.AOS) {
            var isNarrow = window.matchMedia('(max-width: 991px)').matches;
            if (isNarrow) {
                document.querySelectorAll('[data-aos="fade-left"], [data-aos="fade-right"]').forEach(function (el) {
                    el.setAttribute('data-aos', 'fade-up');
                });
                document.querySelectorAll('[data-aos="zoom-in"]').forEach(function (el) {
                    el.setAttribute('data-aos', 'fade-up');
                });
            }
            AOS.init({
                duration: 900,
                easing: 'ease-out-cubic',
                once: true,
                offset: 80,
                disableMutationObserver: true,
                // Disable AOS entirely on very small screens or when the user
                // prefers reduced motion. The fade-up reassignment above already
                // keeps tablets visually animated without horizontal overflow.
                disable: function () {
                    return window.matchMedia('(prefers-reduced-motion: reduce)').matches
                        || window.matchMedia('(max-width: 575px)').matches;
                }
            });
            // Refresh on resize so the layout recalculates trigger points
            var refreshTimer;
            window.addEventListener('resize', function () {
                clearTimeout(refreshTimer);
                refreshTimer = setTimeout(function () {
                    if (window.AOS && typeof window.AOS.refresh === 'function') AOS.refresh();
                }, 200);
            });
        }

        /* ---------- PRELOADER ---------- */
        var loader = document.getElementById('pageLoader');
        if (loader) {
            window.addEventListener('load', function () {
                setTimeout(function () { loader.classList.add('is-hidden'); }, 280);
            });
            setTimeout(function () { loader.classList.add('is-hidden'); }, 2200);
        }

        /* ---------- HEADER SHRINK ---------- */
        var header = document.getElementById('siteHeader');
        var onScroll = function () {
            if (!header) return;
            if (window.scrollY > 28) header.classList.add('is-scrolled');
            else header.classList.remove('is-scrolled');

            var top = document.getElementById('toTop');
            if (top) {
                if (window.scrollY > 600) top.classList.add('is-visible');
                else top.classList.remove('is-visible');
            }
        };
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();

        /* ---------- MOBILE SLIDE-IN MENU ---------- */
        var navToggle      = document.getElementById('navToggle');
        var mobileMenu     = document.getElementById('mobileMenu');
        var mobileOverlay  = document.getElementById('mobileOverlay');
        var mobileClose    = document.getElementById('navDrawerClose');

        function setMobileMenu(open) {
            if (!mobileMenu) return;
            mobileMenu.classList.toggle('is-open', open);
            if (mobileOverlay) mobileOverlay.classList.toggle('is-open', open);
            if (navToggle) {
                navToggle.classList.toggle('is-open', open);
                navToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            }
            mobileMenu.setAttribute('aria-hidden', open ? 'false' : 'true');
            document.body.style.overflow = open ? 'hidden' : '';
        }

        if (navToggle && mobileMenu) {
            navToggle.addEventListener('click', function () {
                setMobileMenu(!mobileMenu.classList.contains('is-open'));
            });
        }
        if (mobileClose) {
            mobileClose.addEventListener('click', function () { setMobileMenu(false); });
        }
        if (mobileOverlay) {
            mobileOverlay.addEventListener('click', function () { setMobileMenu(false); });
        }
        // Close on link click inside the mobile menu (so navigation feels snappy)
        if (mobileMenu) {
            mobileMenu.querySelectorAll('.mm-links > a, .mm-sub a, .mm-cta a').forEach(function (a) {
                a.addEventListener('click', function () { setMobileMenu(false); });
            });
            // Expand/collapse mobile group sections (Services, etc.)
            mobileMenu.querySelectorAll('.mm-trigger').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var group = btn.closest('.mm-group');
                    if (!group) return;
                    var isOpen = group.classList.toggle('is-open');
                    btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                });
            });
        }
        // ESC closes mobile menu
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && mobileMenu && mobileMenu.classList.contains('is-open')) {
                setMobileMenu(false);
            }
        });

        /* ---------- DESKTOP DROPDOWN MENUS (.nav-item.has-dd) ---------- */
        var dropdownItems = document.querySelectorAll('.navlinks .nav-item.has-dd');
        if (dropdownItems.length) {
            dropdownItems.forEach(function (item) {
                var trigger = item.querySelector(':scope > a');
                if (!trigger) return;

                // Caret-only click toggle: keep the link clickable, but tapping
                // the caret opens the panel without navigating.
                trigger.addEventListener('click', function (e) {
                    var isMobile = window.matchMedia('(max-width: 991px)').matches;
                    if (isMobile) return;
                    if (e.target.closest('.nav-caret')) {
                        e.preventDefault();
                        var wasOpen = item.classList.contains('is-open');
                        dropdownItems.forEach(function (other) { other.classList.remove('is-open'); });
                        if (!wasOpen) item.classList.add('is-open');
                        trigger.setAttribute('aria-expanded', !wasOpen ? 'true' : 'false');
                    }
                });
            });

            // Click outside -> close any open dropdowns
            document.addEventListener('click', function (e) {
                if (e.target.closest('.navlinks .nav-item.has-dd')) return;
                dropdownItems.forEach(function (item) {
                    item.classList.remove('is-open');
                    var t = item.querySelector(':scope > a');
                    if (t) t.setAttribute('aria-expanded', 'false');
                });
            });

            // ESC closes any open dropdown
            document.addEventListener('keydown', function (e) {
                if (e.key !== 'Escape') return;
                dropdownItems.forEach(function (item) {
                    item.classList.remove('is-open');
                    var t = item.querySelector(':scope > a');
                    if (t) t.setAttribute('aria-expanded', 'false');
                });
            });
        }

        /* ---------- TO TOP ---------- */
        var toTop = document.getElementById('toTop');
        if (toTop) {
            toTop.addEventListener('click', function () {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }

        /* ---------- COUNT UP ---------- */
        var counters = document.querySelectorAll('.count-up');
        if (counters.length && 'IntersectionObserver' in window) {
            var io = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (!entry.isIntersecting) return;
                    var el = entry.target;
                    var target = parseFloat(el.dataset.target || '0');
                    var decimals = target % 1 !== 0 ? 1 : 0;
                    var start = 0;
                    var duration = 1600;
                    var t0 = performance.now();
                    function step(now) {
                        var p = Math.min((now - t0) / duration, 1);
                        var eased = 1 - Math.pow(1 - p, 3);
                        var val = start + (target - start) * eased;
                        el.textContent = decimals ? val.toFixed(decimals) : Math.floor(val).toString();
                        if (p < 1) requestAnimationFrame(step);
                        else el.textContent = decimals ? target.toFixed(decimals) : target.toString();
                    }
                    requestAnimationFrame(step);
                    io.unobserve(el);
                });
            }, { threshold: 0.4 });
            counters.forEach(function (c) { io.observe(c); });
        }

        /* ---------- MAGNETIC BUTTONS ---------- */
        var prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (!prefersReduced) {
            document.querySelectorAll('.magnetic').forEach(function (btn) {
                btn.addEventListener('mousemove', function (e) {
                    var r = btn.getBoundingClientRect();
                    var x = e.clientX - r.left - r.width / 2;
                    var y = e.clientY - r.top - r.height / 2;
                    btn.style.transform = 'translate(' + (x * 0.15) + 'px,' + (y * 0.18) + 'px)';
                });
                btn.addEventListener('mouseleave', function () {
                    btn.style.transform = '';
                });
            });
        }

        /* ---------- OWL SLIDERS ---------- */
        if (window.jQuery && jQuery.fn.owlCarousel) {

            /* ---- HERO BOOK SLIDER (fanned 3D shelf) ---- */
            var $heroSlider = jQuery('.hero-book-slider');
            if ($heroSlider.length) {

                function applyHeroFan() {
                    var $items = $heroSlider.find('.owl-item');
                    if (!$items.length) return;

                    // Find the centered slide
                    var centerIdx = -1;
                    $items.each(function (i) {
                        if (jQuery(this).hasClass('center')) centerIdx = i;
                    });
                    if (centerIdx < 0) return;

                    $items.each(function (i) {
                        var d = i - centerIdx;
                        var cls = '';
                        if (d === 0)       cls = 'fan-c';
                        else if (d === -1) cls = 'fan-l1';
                        else if (d === -2) cls = 'fan-l2';
                        else if (d === -3) cls = 'fan-l3';
                        else if (d === 1)  cls = 'fan-r1';
                        else if (d === 2)  cls = 'fan-r2';
                        else if (d === 3)  cls = 'fan-r3';

                        var el = this;
                        // Only touch the DOM when the class actually needs to change
                        if (!el.classList.contains(cls)) {
                            el.classList.remove('fan-c','fan-l1','fan-l2','fan-l3','fan-r1','fan-r2','fan-r3');
                            if (cls) el.classList.add(cls);
                        }
                    });
                }

                // Fire on EVERY relevant event — including 'translate' (slide start) and
                // 'changed' (Owl announces the new center) so books reposition WITH the
                // stage, not after it settles. That removes the perceived delay.
                $heroSlider.on(
                    'initialized.owl.carousel changed.owl.carousel translate.owl.carousel translated.owl.carousel resized.owl.carousel refreshed.owl.carousel',
                    function () { window.requestAnimationFrame(applyHeroFan); }
                );

                $heroSlider.owlCarousel({
                    loop: true,
                    margin: 6,
                    nav: false,
                    dots: false,
                    center: true,
                    autoplay: true,
                    autoplayTimeout: 4200,
                    autoplayHoverPause: true,
                    smartSpeed: 850,
                    fluidSpeed: true,
                    mouseDrag: true,
                    touchDrag: true,
                    pullDrag: false,
                    responsive: {
                        0:    { items: 3 },
                        480:  { items: 5 },
                        768:  { items: 7 },
                        1100: { items: 7 }
                    }
                });

                // Initial paint after Owl finishes its async setup
                window.requestAnimationFrame(applyHeroFan);
                setTimeout(applyHeroFan, 200);
                setTimeout(applyHeroFan, 600);
            }

            /* ---- PORTFOLIO SLIDER ---- */
            jQuery('.portfolio-slider').owlCarousel({
                loop: true,
                margin: 16,
                nav: false,
                dots: true,
                center: true,
                autoplay: true,
                autoplayTimeout: 4200,
                autoplayHoverPause: true,
                smartSpeed: 1100,
                responsive: {
                    0:    { items: 1 },
                    480:  { items: 3 },
                    768:  { items: 5 },
                    1100: { items: 5 },
                    1400: { items: 7 }
                }
            });

            jQuery('.testimonials-slider').owlCarousel({
                loop: true,
                margin: 24,
                nav: false,
                dots: true,
                autoplay: true,
                autoplayTimeout: 6000,
                autoplayHoverPause: true,
                smartSpeed: 900,
                responsive: {
                    0:   { items: 1 },
                    768: { items: 2 },
                    1100:{ items: 3 }
                }
            });
        }

        /* ---------- PORTFOLIO GRID — tilted 3-column scroll ----------
           PHP renders each column's covers twice for the seamless loop. As a
           safety net, if a list has fewer than 6 items (i.e. it was rendered
           only once somewhere), duplicate its children here so the keyframe
           still loops cleanly without showing empty space. */
        document.querySelectorAll('.book-grid-list').forEach(function (ul) {
            if (ul.dataset.duplicated === '1') return;
            if (ul.children.length > 0 && ul.children.length < 6) {
                ul.innerHTML += ul.innerHTML;
            }
            ul.dataset.duplicated = '1';
        });

        /* ---------- PORTFOLIO FILTERS ---------- */
        var chips = document.querySelectorAll('.pf-chip');
        if (chips.length) {
            chips.forEach(function (chip) {
                chip.addEventListener('click', function () {
                    chips.forEach(function (c) { c.classList.remove('active'); });
                    chip.classList.add('active');
                    var filter = chip.dataset.filter;
                    document.querySelectorAll('.pf-item').forEach(function (item) {
                        var cat = item.dataset.cat;
                        if (filter === 'all' || filter === cat) item.classList.remove('is-hidden');
                        else item.classList.add('is-hidden');
                    });
                });
            });
        }

        /* ---------- GLOBAL POPUP FORM ----------
           Auto-open the popup when the user clicks any primary CTA button
           (.btn-cta, .btn-gold, .nav-cta) or any element with [data-popup].
           Buttons that should keep navigating (e.g. "View More", "Learn More")
           opt out by adding the [data-no-popup] attribute. */
        var popupOverlay = document.getElementById('popupOverlay');
        var popupClose   = document.getElementById('popupClose');
        var popupForm    = document.getElementById('popupForm');

        function openPopup(triggerEl) {
            if (!popupOverlay) return;
            popupOverlay.classList.add('is-open');
            popupOverlay.setAttribute('aria-hidden', 'false');
            document.body.classList.add('popup-open');
            // Focus the first input for accessibility
            setTimeout(function () {
                var firstInput = popupOverlay.querySelector('input, select, textarea');
                if (firstInput) firstInput.focus({ preventScroll: true });
            }, 200);
        }
        function closePopup() {
            if (!popupOverlay) return;
            popupOverlay.classList.remove('is-open');
            popupOverlay.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('popup-open');
        }

        if (popupOverlay && popupClose) {
            popupClose.addEventListener('click', closePopup);
            // Backdrop click closes (but clicks on the modal itself don't)
            popupOverlay.addEventListener('click', function (e) {
                if (e.target === popupOverlay) closePopup();
            });
            // ESC closes
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && popupOverlay.classList.contains('is-open')) closePopup();
            });

            // Intercept every primary CTA click site-wide. Selector targets:
            //   - explicit triggers via [data-popup]
            //   - all primary action buttons (.btn-cta, .btn-gold, .nav-cta)
            //   - hrefs aimed at the legacy contact-form anchor
            // Bypasses any element carrying [data-no-popup].
            document.addEventListener('click', function (e) {
                var trigger = e.target.closest(
                    '[data-popup], .btn-cta, .btn-gold, .nav-cta, a[href$="contact.php#submit"]'
                );
                if (!trigger) return;
                if (trigger.hasAttribute('data-no-popup')) return;
                // The popup's own submit button is .btn-cta — exclude clicks inside the modal
                if (popupOverlay.contains(trigger)) return;

                e.preventDefault();
                openPopup(trigger);
            });

            // Form submit handler (placeholder — wire to your backend / mailer here)
            if (popupForm) {
                popupForm.addEventListener('submit', function (e) {
                    e.preventDefault();
                    // Visual confirmation; replace this block with your real submit logic
                    var submitBtn = popupForm.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        var original = submitBtn.innerHTML;
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="fa-solid fa-check"></i> Sent — we\'ll be in touch';
                        setTimeout(function () {
                            popupForm.reset();
                            submitBtn.innerHTML = original;
                            submitBtn.disabled = false;
                            closePopup();
                        }, 2200);
                    }
                });
            }
        }
    });
})();
