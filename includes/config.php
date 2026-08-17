<?php
/**
 * EU Publishing House - Master Configuration
 * Centralized branding, SEO, and helper system
 */

// =====================================================
// BRAND IDENTITY
// =====================================================
define('WEBSITE_NAME', 'EU Publishing House');
define('WEBSITE_TAGLINE', 'We Publish Ideas That Leave a Legacy');
define('WEBSITE_URL', 'https://eupublishinghouse.com');
define('WEBSITE_DESCRIPTION', 'EU Publishing House is where powerful storytelling meets timeless design. We publish books that inspire, educate, and transform lives.');

// Friendly aliases used throughout pages
define('BRAND_NAME',     WEBSITE_NAME);
define('BRAND_SITE_URL', WEBSITE_URL);
define('BRAND_TAGLINE',  WEBSITE_TAGLINE);

// =====================================================
// CONTACT
// =====================================================
define('PHONE_NUMBER', '+353 (01) 913 1648');
define('PHONE_NUMBER_RAW', '+35319131648');
define('EMAIL_ADDRESS', 'info@eupublishinghouse.com');
define('SUPPORT_EMAIL', 'support@eupublishinghouse.com');
define('ADDRESS', 'The Observatory, 22 Windmill Ln, Dublin 2, D02 W282, Ireland');
define('ADDRESS_SHORT', 'Dublin, Ireland');

// =====================================================
// LIVE CHAT (Tawk.to)
// =====================================================
// Replace with your Tawk.to property ID and widget ID, e.g. '5f9c3...'
// Find these in Tawk dashboard -> Administration -> Property Settings -> Property ID,
// and the widget ID at the end of your Tawk JS embed URL.
// Leave empty to disable the chat widget loader (the floating button stays clickable
// and shows a graceful fallback).
define('TAWK_PROPERTY_ID', '69b3ccc23a61e31c3587d38a');
define('TAWK_WIDGET_ID',   '1jjj5fmcf');

// =====================================================
// SOCIAL
// =====================================================
define('SOCIAL_FACEBOOK',  'https://www.facebook.com/eupublishinghouse/');
define('SOCIAL_INSTAGRAM', 'https://www.instagram.com/eupublishinghouse/');
define('SOCIAL_LINKEDIN',  'https://www.linkedin.com/company/eu-publishing-house');
define('SOCIAL_TWITTER',   'https://x.com/EUPublishingH');
define('SOCIAL_YOUTUBE',   'https://www.youtube.com/@EUPublishingHouse');
define('SOCIAL_PINTEREST', 'https://www.pinterest.com/eupublishinghouse/');

// =====================================================
// BRAND COLORS, Derived from the EU Publishing House logo
// =====================================================
define('BRAND_PRIMARY',   '#1B5340');   // Deep forest green ("EU Publishing" text)
define('BRAND_PRIMARY_2', '#0F3E2E');   // Darker shade for hovers / footer
define('BRAND_LEAF',      '#6CB04C');   // Leaf-green accent (logo feather)
define('BRAND_LEAF_2',    '#4F932F');   // Darker leaf for hovers
define('BRAND_GOLD',      '#C9A84C');   // Editorial gold accent (kept for "Legacy" italic)
define('BRAND_IVORY',     '#F9F6F0');   // Ivory background
define('BRAND_PARCHMENT', '#EDE8DF');   // Parchment sections
define('BRAND_TEXT',      '#2C2C2A');   // Main text
define('BRAND_MUTED',     '#7A7570');   // Secondary text
define('BRAND_CTA',       '#1B5340');   // CTA uses primary forest green

// =====================================================
// INSTALL BASE — runtime-detected URL prefix
// =====================================================
// On XAMPP/localhost (project in subfolder): "/brands/eupublishinghouse.com/"
// On a domain-root production install:       "/"
// Used by asset() and link_to() to emit absolute URLs that work in both
// environments. Required because pretty URLs (/about/ instead of /about.php)
// change how browsers resolve relative paths inside the page.
if (!defined('INSTALL_BASE')) {
    $__doc  = isset($_SERVER['DOCUMENT_ROOT'])
        ? str_replace('\\', '/', rtrim($_SERVER['DOCUMENT_ROOT'], '/\\'))
        : '';
    $__proj = str_replace('\\', '/', dirname(__DIR__));
    if ($__doc !== '' && stripos($__proj, $__doc) === 0) {
        $__base = substr($__proj, strlen($__doc));
        $__base = '/' . trim($__base, '/');
        if (substr($__base, -1) !== '/') $__base .= '/';
    } else {
        $__base = '/';
    }
    define('INSTALL_BASE', $__base);
    unset($__doc, $__proj, $__base);
}

// =====================================================
// ASSETS
// =====================================================
define('ASSETS_URL', 'assets');
define('CSS_URL', ASSETS_URL . '/css');
define('JS_URL', ASSETS_URL . '/js');
define('IMG_URL', ASSETS_URL . '/images');
define('UPLOADS_URL', 'uploads');

// =====================================================
// SEO DEFAULTS
// =====================================================
define('SEO_DEFAULT_TITLE', WEBSITE_NAME . ', ' . WEBSITE_TAGLINE);
define('SEO_DEFAULT_DESCRIPTION', WEBSITE_DESCRIPTION);
define('SEO_DEFAULT_KEYWORDS', 'book publishing, publishing house, European publisher, manuscript publishing, book editing, ghostwriting, cover design, author services, Dublin publisher, literary publishing');
define('SEO_DEFAULT_IMAGE', WEBSITE_URL . '/assets/images/og.webp');
define('SEO_AUTHOR', 'EU Publishing House');
define('SEO_LOCALE', 'en_IE');

// =====================================================
// PAGE META REGISTRY
// =====================================================
$PAGE_META = [
    'index' => [
        'title' => 'EU Publishing House - Expert Book Publishers in Europe',
        'description' => 'Discover top book publishers across Europe, offering expert guidance, quality services, and reliable support for authors seeking professional publishing',
        'keywords' => SEO_DEFAULT_KEYWORDS,
        'canonical' => WEBSITE_URL . '/',
    ],
    'about' => [
        'title' => 'European Publishing House – About Our Story & Mission',
        'description' => 'Learn about European Publishing House, our journey, mission, and commitment to helping authors across Europe achieve their publishing goals with expertise.',
        'keywords' => 'about EU Publishing House, European publisher story, hybrid publisher Ireland',
        'canonical' => WEBSITE_URL . '/about/',
    ],
    'services' => [
        'title' => 'Professional Author Services Across Europe | EU Publishing House',
        'description' => 'Comprehensive author services across Europe including publishing, editing, ghostwriting, design, formatting, and marketing tailored to every writer\'s needs.',
        'keywords' => 'book publishing services, editing, ghostwriting, cover design, book marketing',
        'canonical' => WEBSITE_URL . '/services/',
    ],
    'publishing' => [
        'title' => 'Professional Book Publishing Services Across Europe',
        'description' => 'Offering professional book publishing services across Europe, with expert guidance, quality production, and reliable support for authors and publishers.',
        'keywords' => 'book publishing Europe, hybrid publisher, Amazon KDP, IngramSpark, global book distribution',
        'canonical' => WEBSITE_URL . '/publishing/',
    ],
    'editing' => [
        'title' => 'Professional Book Editing Services Across Europe',
        'description' => 'Enhance your manuscript with expert book editing services across Europe. Precision, quality, and trusted support to help authors perfect every page.',
        'keywords' => 'book editing Europe, developmental editing, copy editing, proofreading, manuscript editing',
        'canonical' => WEBSITE_URL . '/editing/',
    ],
    'ghostwriting' => [
        'title' => 'Expert Ghostwriting Services for Authors in Europe',
        'description' => 'Turn your ideas into compelling books with expert ghostwriting in Europe. Creative, professional, and confidential services tailored for authors.',
        'keywords' => 'ghostwriting services Europe, hire a ghostwriter, memoir ghostwriter, business book ghostwriter',
        'canonical' => WEBSITE_URL . '/ghostwriting/',
    ],
    'design' => [
        'title' => 'Creative Book Cover Design Services Across Europe',
        'description' => 'Make your book stand out with professional cover design services in Europe. Unique, eye-catching designs crafted to capture readers\' attention instantly.',
        'keywords' => 'book cover design Europe, custom cover design, eBook cover, print wraparound, children\'s book illustration',
        'canonical' => WEBSITE_URL . '/design/',
    ],
    'marketing' => [
        'title' => 'Effective Book Marketing Services Across Europe',
        'description' => 'Boost your book\'s reach with expert marketing services in Europe. Proven strategies, targeted campaigns, and professional support to grow your readership.',
        'keywords' => 'book marketing Europe, Amazon ads for authors, author branding, book launch marketing',
        'canonical' => WEBSITE_URL . '/marketing/',
    ],
    'formatting' => [
        'title' => 'Professional Book Formatting Services Across Europe',
        'description' => 'Ensure your book looks perfect with expert formatting services in Europe. Precise layouts, polished designs, and professional support for every author.',
        'keywords' => 'book formatting Europe, ePub MOBI formatting, KDP formatting, print ready PDF, IngramSpark formatting',
        'canonical' => WEBSITE_URL . '/formatting/',
    ],
    /* ---- Location hub + Ireland cluster ----
       These pages also set their own $page_title / $page_description before
       including header.php (the explicit values win). Entries are kept here
       so the registry stays a complete list of the site's pages. */
    'locations' => [
        'title' => 'Book Publishing Locations | EU Publishing House',
        'description' => 'Find EU Publishing House in your country. Publishing, editing, ghostwriting, cover design, formatting and book marketing for authors in Ireland and across Europe.',
        'keywords' => 'book publishing locations, book publishers Ireland, publishing services by country',
        'canonical' => WEBSITE_URL . '/locations/',
    ],
    'book-publishing-services-in-ireland' => [
        'title' => 'Book Publishing Services in Ireland | EU Publishing House',
        'description' => 'Book publishing services in Ireland covering editing, ghostwriting, cover design, formatting and marketing. Dublin-based team working with authors in every county.',
        'keywords' => 'book publishing services Ireland, author services Ireland, Dublin book publisher',
        'canonical' => WEBSITE_URL . '/book-publishing-services-in-ireland/',
    ],
    'book-publishers-in-ireland' => [
        'title' => 'Leading Book Publishers in Ireland for Aspiring Authors',
        'description' => 'Choose book publishers in Ireland dedicated to bringing your manuscript to life with expert editing, design, and guidance from concept through to launch.',
        'keywords' => 'book publishers Ireland, hybrid publishing services Ireland, book printing Ireland',
        'canonical' => WEBSITE_URL . '/book-publishers-in-ireland/',
    ],
    'book-editing-services-in-ireland' => [
        'title' => 'Book Editing Services in Ireland | Professional Editors',
        'description' => 'Get expert book editing services in Ireland to polish your manuscript for clarity, flow, and publishing success. Trusted editors deliver fast results.',
        'keywords' => 'book editing services Ireland, copy editing Ireland, proofreading Ireland',
        'canonical' => WEBSITE_URL . '/book-editing-services-in-ireland/',
    ],
    'ghostwriting-services-ireland' => [
        'title' => 'Ghostwriting Services Ireland | Your Story, Told Right',
        'description' => 'Professional ghostwriting services in Ireland to turn your ideas into a polished, publish-ready book. Confidential, skilled writers who capture your voice.',
        'keywords' => 'ghostwriting services Ireland, ghostwriter Ireland, autobiography ghostwriting Ireland',
        'canonical' => WEBSITE_URL . '/ghostwriting-services-ireland/',
    ],
    'custom-book-cover-design-in-ireland' => [
        'title' => 'Book Cover Design in Ireland for Authors Who Stand Out',
        'description' => 'Get book cover design in Ireland that turns browsers into buyers. Custom, genre-ready covers crafted to reflect your story and grab reader attention fast.',
        'keywords' => 'book cover design Ireland, Kindle cover design Ireland, children\'s book illustration Ireland',
        'canonical' => WEBSITE_URL . '/custom-book-cover-design-in-ireland/',
    ],
    'book-formatting-services-in-ireland' => [
        'title' => 'Book Formatting Services Ireland | Professional Help',
        'description' => 'Looking for expert book formatting services in Ireland? We craft clean, polished layouts for print and eBooks that meet publishing industry standards.',
        'keywords' => 'book formatting services Ireland, Kindle book format Ireland, EPUB formatting Ireland',
        'canonical' => WEBSITE_URL . '/book-formatting-services-in-ireland/',
    ],
    'book-marketing-services-in-ireland' => [
        'title' => 'Book Marketing Services Ireland to Boost Your Sales',
        'description' => 'Get expert book marketing services Ireland authors trust to build visibility, reach engaged readers, and turn book launches into lasting sales success.',
        'keywords' => 'book marketing services Ireland, Amazon book marketing Ireland, book promotion Ireland',
        'canonical' => WEBSITE_URL . '/book-marketing-services-in-ireland/',
    ],
    'portfolios' => [
        'title' => 'Portfolio | Branding & Publishing Work – EU House UK',
        'description' => 'Explore EU Publishing House portfolio featuring publishing, branding, and creative design projects. View our work, expertise, and client collaborations.',
        'keywords' => 'published books, portfolio, EU Publishing House titles',
        'canonical' => WEBSITE_URL . '/portfolios/',
    ],
    'blog' => [
        'title' => 'European Publishing House – Our Blogs & Insights',
        'description' => 'Explore European Publishing House blogs for expert tips, news, and valuable insights to help authors and publishers stay ahead in the literary world.',
        'keywords' => 'publishing blog, author journal, writing craft, book marketing tips',
        'canonical' => WEBSITE_URL . '/blog/',
    ],
    'testimonial' => [
        'title' => 'European Publishing House – Author Testimonials & Reviews',
        'description' => 'Read what authors say about European Publishing House. Honest testimonials reflecting our commitment, expertise, and dedicated publishing support across Europe.',
        'keywords' => 'EU Publishing House testimonials, author reviews, publishing testimonials',
        'canonical' => WEBSITE_URL . '/testimonial/',
    ],
    'faq' => [
        'title' => 'European Publishing House – FAQs & Author Support',
        'description' => 'Find answers to common questions about publishing with European Publishing House. Expert guidance, clear solutions, and support for authors across Europe.',
        'keywords' => 'publishing FAQ, author questions, manuscript submission',
        'canonical' => WEBSITE_URL . '/faq/',
    ],
    'contact' => [
        'title' => 'Contact European Publishing House – Get in Touch',
        'description' => 'Reach out to European Publishing House for inquiries, support, or publishing guidance. Friendly, professional assistance for authors across Europe is here.',
        'keywords' => 'contact publisher, submit manuscript, publishing consultation',
        'canonical' => WEBSITE_URL . '/contact/',
    ],
    'privacy-policy' => [
        'title' => 'European Publishing House – Privacy Policy & Safety',
        'description' => 'Read European Publishing House\'s Privacy Policy to see how we protect your data. Committed to security, transparency, and author privacy across Europe.',
        'keywords' => 'privacy policy, EU Publishing House privacy',
        'canonical' => WEBSITE_URL . '/privacy-policy/',
    ],
    'terms-conditions' => [
        'title' => 'European Publishing House – Terms & Conditions',
        'description' => 'Review the Terms & Conditions of European Publishing House. Clear guidelines and policies to ensure a secure, fair, and professional experience for authors.',
        'keywords' => 'terms and conditions, EU Publishing House terms',
        'canonical' => WEBSITE_URL . '/terms-conditions/',
    ],
];

// =====================================================
// FORM SYSTEM — lead routing, SMTP, reCAPTCHA, DB
// Used by /form-submission.php, includes/smtp-mailer.php and includes/recaptcha.php.
// =====================================================

/* ---------- $BRAND — required by smtp-mailer.php so the "From" name on every
 *            outbound email is the brand, even when SMTP uses a different mailbox. */
$BRAND = [
    'name'       => WEBSITE_NAME,
    'tagline'    => WEBSITE_TAGLINE,
    'base_url'   => WEBSITE_URL,
];

/* ---------- LEAD / EMAIL ROUTING ----------
 * `recipients`  : ALWAYS forces lead notifications to info@eupublishinghouse.com
 *                 regardless of whichever mailbox is used to authenticate SMTP.
 * `from_name`   : The brand name appears as the sender name in inboxes.
 * `from_email`  : Should match the SMTP auth user below so Google Workspace
 *                 doesn't rewrite the From header.
 * `reply_to`    : Where clicking "Reply" sends the response (usually same).
 */
$LEAD = [
    'recipients' => [
        'maaz.rayyan@ukpublishinghouse.co.uk',
        'sam.naran@ukpublishinghouse.co.uk'
    ],
    'from_name'  => WEBSITE_NAME . ' Leads',
    'from_email' => 'info@eupublishinghouse.com',
    'reply_to'   => 'info@eupublishinghouse.com',
];

/* ---------- SMTP — Google Workspace ----------
 * Requirements:
 *   1. PHPMailer must be installed:
 *        composer require phpmailer/phpmailer
 *      (or drop into includes/PHPMailer/src/).
 *   2. `user` must be a real Google Workspace mailbox.
 *   3. `pass` MUST be a Google App Password (16-char), NOT the account password.
 *      Generate at https://myaccount.google.com/apppasswords after enabling
 *      2-Step Verification on the account.
 *   4. If you later switch `user` to a different mailbox, leave `from_email`
 *      as info@eupublishinghouse.com and set up "Send mail as" in Gmail so
 *      Google allows the From header — otherwise it'll be rewritten.
 */
$SMTP = [
    'enabled' => true,
    'host'    => 'smtp.gmail.com',
    'port'    => 587,
    'user'    => 'sales@eupublishinghouse.com',
    'pass'    => 'ttlk bmlm gjfz qtzk',                  // <-- 16-char Google App Password
    'secure'  => 'tls',                          // STARTTLS on 587 (use 'ssl' + 465 for SMTPS)
];

/* ---------- DATABASE (optional lead log) ----------
 * Leave `host` blank to skip DB logging — email is the source of truth.
 * If credentials are filled in, form-submission.php auto-creates a `leads`
 * table on first write.
 */
$DB = [
    'host'    => 'localhost',
    'name'    => 'lumihuxq_eupubhouse',
    'user'    => 'lumihuxq_eupubhouseuser',
    'pass'    => '0(qU4SW3tRHnlE%9',
    'charset' => 'utf8mb4',
];

/* ---------- reCAPTCHA v3 ----------
 * Leave keys blank to disable bot check entirely. When filled, every form
 * gets a hidden token field, the SDK is lazy-loaded on first focus, and
 * form-submission.php verifies server-side before processing.
 */
$RECAPTCHA = [
    'site_key'   => '6LfTp_ssAAAAAFOub_iWJD270Dsak6u2Yz5Kdbrz',
    'secret_key' => '6LfTp_ssAAAAABUCpVXwNJWbUfs9btQYoODy1M2H',
    'min_score'  => 0.5,
];

// =====================================================
// HELPER FUNCTIONS
// =====================================================
/* Short alias for the HTML-escape helper. Some shared includes (form-submission,
 * smtp-mailer, recaptcha) use the conventional `e()` name. */
if (!function_exists('e')) {
    function e($str) { return htmlspecialchars((string)$str, ENT_QUOTES, 'UTF-8'); }
}

function getCurrentPage() {
    // If a page has explicitly declared what menu key it represents, use that
    // (so /blogs/<slug>.php can still register as 'blog' for nav highlighting).
    if (!empty($GLOBALS['current_page_key'])) {
        return $GLOBALS['current_page_key'];
    }
    $script = basename($_SERVER['SCRIPT_NAME'], '.php');
    return $script ?: 'index';
}

function getMeta($key = null) {
    global $PAGE_META;
    $page = getCurrentPage();
    $meta = $PAGE_META[$page] ?? $PAGE_META['index'];
    if ($key) return $meta[$key] ?? '';
    return $meta;
}

/**
 * Returns the relative path prefix that lets a page in a subfolder
 * (e.g. /blogs/<slug>.php) link back up to root-level assets and pages.
 * Pages can set $GLOBALS['site_base'] = '../'; before including header.php.
 */
function site_base() {
    return $GLOBALS['site_base'] ?? '';
}

function asset($path) {
    return INSTALL_BASE . rtrim(ASSETS_URL, '/') . '/' . ltrim($path, '/');
}

/**
 * Resolve a root-level page link as a clean, trailing-slash URL.
 *
 * - `link_to('about.php')`             -> /about/
 * - `link_to('blogs/foo.php')`         -> /blogs/foo/
 * - `link_to('index.php')` / `''`      -> /        (homepage)
 * - `link_to('form-submission.php')`   -> /form-submission.php  (POST handler exempt)
 * - `link_to('javascript:;')`,
 *   `link_to('mailto:x@y')`,
 *   `link_to('#anchor')`,
 *   `link_to('https://...')`           -> passed through unchanged
 * - Anything else (assets, images)     -> site_base() . $path  (unchanged)
 *
 * Honours $GLOBALS['site_base'] so links from /blogs/<slug>.php still resolve
 * correctly. Pretty URLs are enforced by .htaccess; this just emits them
 * directly so the browser never hits the 301 redirect hop.
 */
function link_to($path) {
    $path = ltrim($path, '/');

    // Homepage shortcut — empty path or index.php => install root.
    if ($path === '' || $path === 'index.php' || $path === 'index') {
        return INSTALL_BASE;
    }

    // Form handler must keep its .php extension (POST endpoint, .htaccess exempt).
    if ($path === 'form-submission.php') {
        return INSTALL_BASE . $path;
    }

    // Pass non-page schemes through unchanged.
    if (preg_match('/^(javascript:|mailto:|tel:|#|https?:\/\/)/i', $path)) {
        return $path;
    }

    // Strip .php from page paths and force a trailing slash.
    if (preg_match('/\.php$/i', $path)) {
        return INSTALL_BASE . preg_replace('/\.php$/i', '/', $path);
    }

    // Everything else (assets, images, files with other extensions) — leave alone.
    return INSTALL_BASE . $path;
}

function img($name) {
    return rtrim(IMG_URL, '/') . '/' . ltrim($name, '/');
}

function isActive($page) {
    return getCurrentPage() === $page ? 'active' : '';
}

function activeIf($page) {
    return getCurrentPage() === $page ? 'aria-current="page"' : '';
}

function brandColor($name) {
    $map = [
        'primary'   => BRAND_PRIMARY,
        'primary-2' => BRAND_PRIMARY_2,
        'leaf'      => BRAND_LEAF,
        'leaf-2'    => BRAND_LEAF_2,
        'gold'      => BRAND_GOLD,
        'ivory'     => BRAND_IVORY,
        'parchment' => BRAND_PARCHMENT,
        'text'      => BRAND_TEXT,
        'muted'     => BRAND_MUTED,
        'cta'       => BRAND_CTA,
    ];
    return $map[$name] ?? BRAND_TEXT;
}

function safe($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

/**
 * Single source of truth for the primary navigation.
 *
 * Add a new top-level item or sub-service by appending an entry to the array.
 * Each entry supports:
 *   - key      : used by isActive() to highlight the current page
 *   - label    : visible text
 *   - href     : link target
 *   - icon     : Font Awesome class (used in sub-items)
 *   - desc     : short blurb shown in mega-menu sub-items
 *   - mega     : true to render children as a wide multi-column mega panel
 *   - children : array of sub-items, recursively supporting `children` again
 *                if you ever need a third level.
 *
 * The parent item's `key` should match the script filename (without .php) so
 * `isActive()` picks it up automatically.
 */
function navMenu() {
    return [
        [
            'key'   => 'index',
            'label' => 'Home',
            'href'  => 'index.php',
        ],
        [
            'key'   => 'about',
            'label' => 'About Us',
            'href'  => 'about.php',
        ],
        [
            'key'   => 'services',
            'label' => 'Services',
            'href'  => 'services.php',
            'mega'  => true,
            'children' => [
                ['key' => 'publishing',   'label' => 'Publishing',    'href' => 'publishing.php',    'icon' => 'fa-book',       'desc' => 'End-to-end publishing across every major retailer'],
                ['key' => 'editing',      'label' => 'Editing',       'href' => 'editing.php',       'icon' => 'fa-pen-fancy',  'desc' => 'Developmental, line, copy editing & proofreading'],
                ['key' => 'ghostwriting', 'label' => 'Ghostwriting',  'href' => 'ghostwriting.php',  'icon' => 'fa-feather',    'desc' => 'Long-form partnerships in your voice'],
                ['key' => 'design',       'label' => 'Cover Design',  'href' => 'design.php',        'icon' => 'fa-palette',    'desc' => 'Custom covers built around your book'],
                ['key' => 'formatting',   'label' => 'Formatting',    'href' => 'formatting.php',    'icon' => 'fa-align-left', 'desc' => 'Print-ready PDFs, ePub & MOBI files'],
                ['key' => 'marketing',    'label' => 'Marketing',     'href' => 'marketing.php',     'icon' => 'fa-bullhorn',   'desc' => 'Amazon, social, ads, reviews & launch'],
            ],
        ],
        /* NOTE: Locations is deliberately NOT in the header nav. The location
           pages are reachable from the footer (Explore > Locations, plus the
           Ireland column) and from each other's breadcrumbs and cross-links.
           To surface it in the header again, re-add an entry here with
           'href' => 'locations.php'. */
        [
            'key'   => 'portfolios',
            'label' => 'Portfolio',
            'href'  => 'portfolios.php',
        ],
        [
            'key'   => 'blog',
            'label' => 'Blog',
            'href'  => 'blog.php',
        ],
        [
            'key'   => 'testimonial',
            'label' => 'Testimonials',
            'href'  => 'testimonial.php',
        ],
        [
            'key'   => 'faq',
            'label' => 'FAQs',
            'href'  => 'faq.php',
        ],
        [
            'key'   => 'contact',
            'label' => 'Contact Us',
            'href'  => 'contact.php',
        ],
    ];
}

/**
 * Is the current page this nav item OR one of its descendants?
 * Lets the parent menu item stay highlighted when on a sub-service page.
 */
function navIsActiveTree($item) {
    $cur = getCurrentPage();
    if (!empty($item['key']) && $item['key'] === $cur) return true;
    if (!empty($item['children'])) {
        foreach ($item['children'] as $child) {
            if (navIsActiveTree($child)) return true;
        }
    }
    return false;
}

/**
 * Read every book cover image from /assets/images/book-covers/ and return
 * a list of web-relative paths. Used dynamically by the hero slider,
 * portfolio slider and portfolios grid, no filenames are hard-coded.
 *
 * @param array $options {
 *     @type int    $limit    Max number of items to return. 0 = all.
 *     @type int    $offset   Skip the first N items (after sort/shuffle).
 *     @type bool   $shuffle  Randomize the order.
 *     @type bool   $sort     Alphabetical sort (default true; ignored when shuffle is true).
 * }
 * @return string[]
 */
function getBookCovers($options = []) {
    $opts = array_merge([
        'limit'   => 0,
        'offset'  => 0,
        'shuffle' => false,
        'sort'    => true,
    ], $options);

    $dir = __DIR__ . '/../assets/images/book-covers/';
    $rel = 'assets/images/book-covers/';

    if (!is_dir($dir)) return [];

    $exts = ['jpg', 'jpeg', 'png', 'webp', 'avif', 'gif'];
    $files = [];
    foreach (scandir($dir) as $f) {
        if ($f === '' || $f[0] === '.') continue;
        $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
        if (in_array($ext, $exts, true)) {
            $files[] = $rel . $f;
        }
    }

    if ($opts['shuffle']) {
        shuffle($files);
    } elseif ($opts['sort']) {
        sort($files);
    }

    if ($opts['offset'] > 0) $files = array_slice($files, (int)$opts['offset']);
    if ($opts['limit']  > 0) $files = array_slice($files, 0, (int)$opts['limit']);

    return $files;
}

/**
 * Turn a cover filename into a presentable title, used as alt text & fallback labels
 * when no per-book metadata is available.
 */
function coverLabel($path) {
    $base = pathinfo($path, PATHINFO_FILENAME);
    $base = preg_replace('/[_\-]+/', ' ', $base);
    $base = preg_replace('/\b\d+\b/', '', $base);
    $base = trim(preg_replace('/\s+/', ' ', $base));
    return $base !== '' ? ucwords($base) : 'Published Title';
}
