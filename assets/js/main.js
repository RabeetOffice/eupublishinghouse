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
        var header = document.getElementById('topNav') || document.getElementById('siteHeader');
        var onScroll = function () {
            if (header) {
                if (window.scrollY > 28) header.classList.add('is-scrolled');
                else header.classList.remove('is-scrolled');
            }

            var top = document.getElementById('toTop');
            if (top) {
                if (window.scrollY > 600) top.classList.add('is-visible');
                else top.classList.remove('is-visible');
            }
        };
        // ensure header state is correct on load
        if (header && window.scrollY > 28) header.classList.add('is-scrolled');
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

        /* ---------- BLOG SEARCH ---------- */
        (function initBlogSearch() {
            var input = document.getElementById('blogSearch');
            if (!input) return;

            var grid    = document.getElementById('blogGrid');
            var empty   = document.getElementById('blogEmpty');
            var count   = document.getElementById('blogSearchCount');
            var clearEl = document.getElementById('blogSearchClear');
            var resetEl = document.getElementById('blogResetBtn');
            var items   = grid ? Array.prototype.slice.call(grid.querySelectorAll('.blog-grid-item')) : [];
            var total   = items.length;

            function plural(n) { return n === 1 ? '1 article' : n + ' articles'; }

            function filter(q) {
                q = (q || '').trim().toLowerCase();
                var visible = 0;
                items.forEach(function (el) {
                    if (!q) {
                        el.classList.remove('is-hidden');
                        visible++;
                        return;
                    }
                    var hay = (el.dataset.title || '') + ' ' + (el.dataset.desc || '') + ' ' + (el.dataset.cat || '');
                    if (hay.indexOf(q) !== -1) {
                        el.classList.remove('is-hidden');
                        visible++;
                    } else {
                        el.classList.add('is-hidden');
                    }
                });

                if (empty) empty.hidden = visible !== 0;
                if (count) count.textContent = q
                    ? (visible === 0 ? 'No matches' : plural(visible) + ' of ' + total)
                    : plural(total);
                if (clearEl) clearEl.hidden = !q;
            }

            input.addEventListener('input', function () { filter(this.value); });
            if (clearEl) {
                clearEl.addEventListener('click', function () {
                    input.value = '';
                    input.focus();
                    filter('');
                });
            }
            if (resetEl) {
                resetEl.addEventListener('click', function () {
                    input.value = '';
                    input.focus();
                    filter('');
                });
            }
        })();

        /* ---------- FAQ ACCORDION ---------- */
        document.querySelectorAll('[data-faq-accordion]').forEach(function (acc) {
            acc.querySelectorAll('.faq-trigger').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var item = btn.closest('.faq-item');
                    if (!item) return;
                    var isOpen = item.classList.contains('is-open');
                    // Close all siblings for a clean single-open accordion
                    acc.querySelectorAll('.faq-item.is-open').forEach(function (open) {
                        open.classList.remove('is-open');
                        var t = open.querySelector('.faq-trigger');
                        if (t) t.setAttribute('aria-expanded', 'false');
                    });
                    if (!isOpen) {
                        item.classList.add('is-open');
                        btn.setAttribute('aria-expanded', 'true');
                    }
                });
            });
        });

        /* ---------- TO TOP ---------- */
        var toTop = document.getElementById('toTop');
        if (toTop) {
            toTop.addEventListener('click', function () {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }

        /* ---------- LIVE CHAT TOGGLE ---------- */
        var liveChatBtn = document.getElementById('liveChatBtn');
        if (liveChatBtn) {
            liveChatBtn.addEventListener('click', function () {
                // If Tawk.to is loaded, toggle its window
                if (window.Tawk_API && typeof Tawk_API.toggle === 'function') {
                    try { Tawk_API.toggle(); return; } catch (e) {}
                }
                if (window.Tawk_API && typeof Tawk_API.maximize === 'function') {
                    try { Tawk_API.maximize(); return; } catch (e) {}
                }
                // Fallback: open the manuscript popup so the user can still reach us
                var overlay = document.getElementById('popupOverlay');
                if (overlay) {
                    overlay.classList.add('is-open');
                    overlay.setAttribute('aria-hidden', 'false');
                    document.body.classList.add('popup-open');
                }
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

        /* ---- HERO STACK SLIDER — fanned 5-position book showcase ---- */
        (function initHeroStack() {
                var stage = document.getElementById('heroStack');
                if (!stage) return;

                var slides = Array.prototype.slice.call(stage.querySelectorAll('.stack-slide'));
                if (slides.length < 5) return;

                var n = slides.length;
                var center = 0;
                var positions = { '-2': 's-left2', '-1': 's-left1', '0': 's-center', '1': 's-right1', '2': 's-right2' };
                var allPositionClasses = ['s-center', 's-left1', 's-left2', 's-right1', 's-right2', 's-hidden'];

                function render() {
                    slides.forEach(function (sl, i) {
                        var offset = i - center;
                        if (offset >  Math.floor(n / 2)) offset -= n;
                        if (offset < -Math.floor(n / 2)) offset += n;
                        var cls = positions[offset] || 's-hidden';
                        // Only rewrite classes if needed
                        if (sl.dataset._pos !== cls) {
                            allPositionClasses.forEach(function (c) { sl.classList.remove(c); });
                            sl.classList.add(cls);
                            sl.dataset._pos = cls;
                        }
                    });
                }

                function next() { center = (center + 1) % n; render(); }
                function prev() { center = (center - 1 + n) % n; render(); }

                render();

                /* ---- Autoplay ---- */
                var interval = parseInt(stage.getAttribute('data-autoplay'), 10) || 3500;
                var timer = null;
                function play() {
                    stop();
                    timer = setInterval(next, interval);
                }
                function stop() {
                    if (timer) { clearInterval(timer); timer = null; }
                }
                play();

                /* Hover-to-pause */
                stage.addEventListener('mouseenter', stop);
                stage.addEventListener('mouseleave', play);

                /* Pause when tab hidden, resume when visible */
                document.addEventListener('visibilitychange', function () {
                    if (document.hidden) stop(); else play();
                });

                /* ---- Click side slide to jump there ---- */
                slides.forEach(function (sl, i) {
                    sl.addEventListener('click', function (e) {
                        var pos = sl.dataset._pos;
                        // Center cover keeps its link behavior; sides slide in
                        if (pos && pos !== 's-center') {
                            e.preventDefault();
                            center = i;
                            render();
                            play();
                        }
                    });
                });

                /* ---- Drag / swipe ---- */
                var startX = 0, dragging = false, threshold = 50;
                function pointerDown(x) {
                    dragging = true; startX = x;
                    stop();
                    stage.classList.add('is-grabbing');
                }
                function pointerUp(x) {
                    if (!dragging) return;
                    var delta = x - startX;
                    dragging = false;
                    stage.classList.remove('is-grabbing');
                    if (delta >  threshold) prev();
                    if (delta < -threshold) next();
                    play();
                }
                stage.addEventListener('mousedown',  function (e) { pointerDown(e.clientX); });
                window.addEventListener('mouseup',   function (e) { pointerUp(e.clientX); });
                stage.addEventListener('mouseleave', function () { if (dragging) { dragging = false; stage.classList.remove('is-grabbing'); play(); } });
                stage.addEventListener('touchstart', function (e) { pointerDown(e.touches[0].clientX); }, { passive: true });
                stage.addEventListener('touchend',   function (e) { pointerUp(e.changedTouches[0].clientX); }, { passive: true });
                /* Prevent native drag-image when dragging the cover */
                slides.forEach(function (sl) {
                    sl.addEventListener('dragstart', function (e) { e.preventDefault(); });
                });
        })();

        /* ---------- OWL SLIDERS ---------- */
        if (window.jQuery && jQuery.fn.owlCarousel) {

            /* ---- BOOKS CAROUSEL (homepage "Our Catalog") ---- */
            jQuery('.books-carousel').owlCarousel({
                loop: true,
                margin: 22,
                nav: false,
                dots: true,
                autoplay: true,
                autoplayTimeout: 4500,
                autoplayHoverPause: true,
                smartSpeed: 900,
                mouseDrag: true,
                touchDrag: true,
                responsive: {
                    0:    { items: 2 },
                    480:  { items: 3 },
                    768:  { items: 4 },
                    1100: { items: 5 },
                    1400: { items: 6 }
                }
            });

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

            // Open the popup on explicit triggers:
            //   - [data-popup] attribute
            //   - hrefs of "#popup" or "contact.php#submit"
            // Skip elements carrying [data-no-popup].
            document.addEventListener('click', function (e) {
                var trigger = e.target.closest('[data-popup], a[href="#popup"], a[href$="contact.php#submit"]');
                if (!trigger) return;
                if (trigger.hasAttribute('data-no-popup')) return;
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
