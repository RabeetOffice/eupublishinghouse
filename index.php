<?php
/**
 * EU Publishing House, Homepage
 * Composed entirely from reusable PHP includes for maximum modularity.
 *
 * Every <section> below is a self-contained include living in /includes
 * with its own dynamic data array, drop into any page and override
 * variables before the include() if needed.
 */
require_once __DIR__ . '/includes/config.php';

$page_title       = BRAND_NAME . ', Premium Book Publishing in Europe';
$page_description = 'European Publishing House is a premium hybrid publisher in Dublin. Editing, ghostwriting, cover design, formatting, marketing and global distribution, authors keep their rights and royalties. 800+ books published since 2021.';
$page_keywords    = 'book publishing Europe, hybrid publisher Ireland, book editing, ghostwriting, cover design, book marketing, publish a book Europe';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/';

// 1. Header (SEO, fonts, CSS, preloader, navbar, <main> opens)
require_once __DIR__ . '/includes/header.php';

// 2. Hero, premium light hero with redesigned book slider
require_once __DIR__ . '/includes/hero.php';

// 3. Distributors, continuous logo strip
require_once __DIR__ . '/includes/distributors.php';

// 4. About, split image + copy
require_once __DIR__ . '/includes/about-snippet.php';

// 5. Services, glass service cards
require_once __DIR__ . '/includes/services.php';

// 7. Published books showcase
require_once __DIR__ . '/includes/books.php';

// 8. Book categories
require_once __DIR__ . '/includes/categories.php';

// 9. Publishing cost
require_once __DIR__ . '/includes/publishing-cost.php';

// 10. Publishing process timeline
require_once __DIR__ . '/includes/process.php';

// 15. Final CTA
require_once __DIR__ . '/includes/final-cta.php';

// 11. Why authors choose us
require_once __DIR__ . '/includes/why-choose.php';

// 12. Global distribution
require_once __DIR__ . '/includes/distribution.php';

// 13. Testimonials slider
require_once __DIR__ . '/includes/testimonials.php';

// 14. FAQ accordion
require_once __DIR__ . '/includes/faqs.php';



// 16. Footer (closes </main>, scripts, popup, </body>, </html>)
require_once __DIR__ . '/includes/footer.php';
