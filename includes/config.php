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
        'title' => WEBSITE_NAME . ', ' . WEBSITE_TAGLINE,
        'description' => WEBSITE_DESCRIPTION,
        'keywords' => SEO_DEFAULT_KEYWORDS,
        'canonical' => WEBSITE_URL . '/',
    ],
    'about' => [
        'title' => 'About Us | ' . WEBSITE_NAME,
        'description' => 'Discover the story behind European Publishing House, a publisher built for authors who want professional support without the gatekeepers.',
        'keywords' => 'about EU Publishing House, European publisher story, hybrid publisher Ireland',
        'canonical' => WEBSITE_URL . '/about.php',
    ],
    'services' => [
        'title' => 'Author Services | ' . WEBSITE_NAME,
        'description' => 'Full-service publishing for serious authors, editing, ghostwriting, design, formatting, distribution and marketing.',
        'keywords' => 'book publishing services, editing, ghostwriting, cover design, book marketing',
        'canonical' => WEBSITE_URL . '/services.php',
    ],
    'publishing' => [
        'title' => 'Professional Book Publishing Services in Europe | ' . WEBSITE_NAME,
        'description' => 'End-to-end book publishing across Amazon KDP, Apple Books, Kobo, Google Play, IngramSpark and 150+ retailers. You keep your rights and royalties.',
        'keywords' => 'book publishing Europe, hybrid publisher, Amazon KDP, IngramSpark, global book distribution',
        'canonical' => WEBSITE_URL . '/publishing.php',
    ],
    'editing' => [
        'title' => 'Professional Book Editing Services in Europe | ' . WEBSITE_NAME,
        'description' => 'Developmental, line, copy, academic, technical editing and proofreading from editors with real publishing experience.',
        'keywords' => 'book editing Europe, developmental editing, copy editing, proofreading, manuscript editing',
        'canonical' => WEBSITE_URL . '/editing.php',
    ],
    'ghostwriting' => [
        'title' => 'Professional Ghostwriting Services in Europe | ' . WEBSITE_NAME,
        'description' => 'Confidential ghostwriting across fiction, memoir, business, non-fiction, self-help and children\'s books. You keep 100% of the rights.',
        'keywords' => 'ghostwriting services Europe, hire a ghostwriter, memoir ghostwriter, business book ghostwriter',
        'canonical' => WEBSITE_URL . '/ghostwriting.php',
    ],
    'design' => [
        'title' => 'Book Cover Design Services in Europe | ' . WEBSITE_NAME,
        'description' => 'Custom book cover design for eBook, paperback wraparounds, audiobooks, series branding and children\'s illustration.',
        'keywords' => 'book cover design Europe, custom cover design, eBook cover, print wraparound, children\'s book illustration',
        'canonical' => WEBSITE_URL . '/design.php',
    ],
    'marketing' => [
        'title' => 'Book Marketing Services in Europe That Actually Sell Books | ' . WEBSITE_NAME,
        'description' => 'Amazon optimisation, paid advertising, social campaigns, author branding, review generation and book fair promotion across Europe.',
        'keywords' => 'book marketing Europe, Amazon ads for authors, author branding, book launch marketing',
        'canonical' => WEBSITE_URL . '/marketing.php',
    ],
    'formatting' => [
        'title' => 'Professional Book Formatting Services in Europe | ' . WEBSITE_NAME,
        'description' => 'Print-ready PDFs, ePub, MOBI, KDP and IngramSpark files for paperback, hardback and eBook, built to every platform\'s exact specifications.',
        'keywords' => 'book formatting Europe, ePub MOBI formatting, KDP formatting, print ready PDF, IngramSpark formatting',
        'canonical' => WEBSITE_URL . '/formatting.php',
    ],
    'portfolios' => [
        'title' => 'Portfolio | ' . WEBSITE_NAME,
        'description' => 'Explore titles published by European Publishing House across fiction, memoir, business, children\'s and specialist categories.',
        'keywords' => 'published books, portfolio, EU Publishing House titles',
        'canonical' => WEBSITE_URL . '/portfolios.php',
    ],
    'blog' => [
        'title' => 'Our Blogs | ' . WEBSITE_NAME,
        'description' => 'Essays and resources on publishing, editing, design and marketing from the European Publishing House editorial desk.',
        'keywords' => 'publishing blog, author journal, writing craft, book marketing tips',
        'canonical' => WEBSITE_URL . '/blog.php',
    ],
    'testimonial' => [
        'title' => 'Testimonials | ' . WEBSITE_NAME,
        'description' => 'What our authors say about working with European Publishing House.',
        'keywords' => 'EU Publishing House testimonials, author reviews, publishing testimonials',
        'canonical' => WEBSITE_URL . '/testimonial.php',
    ],
    'faq' => [
        'title' => 'Frequently Asked Questions | ' . WEBSITE_NAME,
        'description' => 'Answers to the most common questions from authors considering European Publishing House.',
        'keywords' => 'publishing FAQ, author questions, manuscript submission',
        'canonical' => WEBSITE_URL . '/faq.php',
    ],
    'contact' => [
        'title' => 'Contact Us | ' . WEBSITE_NAME,
        'description' => 'Speak with the European Publishing House team. Submit a manuscript or schedule a free consultation.',
        'keywords' => 'contact publisher, submit manuscript, publishing consultation',
        'canonical' => WEBSITE_URL . '/contact.php',
    ],
    'privacy-policy' => [
        'title' => 'Privacy Policy | ' . WEBSITE_NAME,
        'description' => 'How European Publishing House collects, uses, and safeguards your information.',
        'keywords' => 'privacy policy, EU Publishing House privacy',
        'canonical' => WEBSITE_URL . '/privacy-policy.php',
    ],
    'terms-conditions' => [
        'title' => 'Terms & Conditions | ' . WEBSITE_NAME,
        'description' => 'Terms governing your use of the European Publishing House website and services.',
        'keywords' => 'terms and conditions, EU Publishing House terms',
        'canonical' => WEBSITE_URL . '/terms-conditions.php',
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
        'info@eupublishinghouse.com',
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
    'name'    => '',
    'user'    => '',
    'pass'    => '',
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
    return site_base() . rtrim(ASSETS_URL, '/') . '/' . ltrim($path, '/');
}

/**
 * Resolve a root-level page link, honouring the current page's site_base
 * so that links from /blogs/<slug>.php correctly walk up to /<page>.php.
 */
function link_to($path) {
    return site_base() . ltrim($path, '/');
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
