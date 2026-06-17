<?php
/**
 * EU Publishing House — content stores for the optional modules this brand has:
 * Portfolio (Amazon-ASIN books + optional uploaded cover), Testimonials (written),
 * and Author bios. Each reader falls back to the brand's existing data on first run,
 * each writer regenerates the public data file in the brand's house style, linting
 * before it replaces the live file.
 */

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/post-store.php';   // for admin_safe_eval_array()

define('SITE_PORTFOLIO_DATA',  SITE_ROOT . '/includes/portfolio-data.php');
define('SITE_TESTI_DATA',      SITE_ROOT . '/includes/testimonials-data.php');
define('SITE_TESTI_LEGACY',    SITE_ROOT . '/includes/testimonials.php');
define('SITE_AUTHORS_DATA',    SITE_ROOT . '/includes/authors-data.php');
define('SITE_AUTHOR_INCLUDE',  SITE_ROOT . '/includes/blog-author.php');

/* ===========================================================================
   PORTFOLIO
=========================================================================== */
/** Raw items: each has category, author, title, amazon_link, optional cover. */
function admin_portfolio_read(): array {
    if (!is_file(SITE_PORTFOLIO_DATA)) return [];
    $src = (string)file_get_contents(SITE_PORTFOLIO_DATA);
    if (!preg_match('/array_map\(.*?\},\s*(\[.*\])\s*\)\s*;/s', $src, $m)) return [];
    $items = admin_safe_eval_array($m[1]);
    if (!is_array($items)) return [];
    $out = [];
    foreach ($items as $it) {
        if (!is_array($it)) continue;
        $out[] = [
            'category'    => (string)($it['category'] ?? ''),
            'author'      => (string)($it['author'] ?? ''),
            'title'       => (string)($it['title'] ?? ''),
            'amazon_link' => (string)($it['amazon_link'] ?? ''),
            'cover'       => isset($it['cover']) ? (string)$it['cover'] : '',
        ];
    }
    return $out;
}

/** The cover URL a card will actually use (uploaded cover preferred over Amazon ASIN). */
function admin_portfolio_cover(array $item): string {
    if (!empty($item['cover'])) {
        return function_exists('asset') ? asset($item['cover']) : $item['cover'];
    }
    if (preg_match('~/dp/([A-Z0-9]{10})~i', $item['amazon_link'] ?? '', $m)) {
        return 'https://m.media-amazon.com/images/P/' . strtoupper($m[1]) . '.01._SCLZZZZZZZ_SX500_.jpg';
    }
    return (function_exists('asset') ? asset('images/hero-book-horizon.png') : 'assets/images/hero-book-horizon.png');
}

function admin_portfolio_render(array $items): string {
    $out = "<?php\n"
        . "/* =================================================================\n"
        . "   PORTFOLIO, single source of truth for every book card on the site.\n"
        . "   Edit this file once; every page that pulls portfolio data updates.\n"
        . "   Managed by /admin (Portfolio). Each entry: category, author, title,\n"
        . "   amazon_link and an OPTIONAL uploaded 'cover'. Cover URL is the uploaded\n"
        . "   cover if present, otherwise auto-derived from the Amazon ASIN.\n"
        . "================================================================= */\n\n"
        . "if (!function_exists('amazonCoverFromLink')) {\n"
        . "    function amazonCoverFromLink(string \$amazonLink): string\n"
        . "    {\n"
        . "        if (preg_match('~/dp/([A-Z0-9]{10})~i', \$amazonLink, \$matches)) {\n"
        . "            return 'https://m.media-amazon.com/images/P/' . strtoupper(\$matches[1]) . '.01._SCLZZZZZZZ_SX500_.jpg';\n"
        . "        }\n"
        . "        return 'assets/images/hero-book-horizon.png';\n"
        . "    }\n"
        . "}\n\n"
        . "\$portfolioItems = array_map(static function (array \$item): array {\n"
        . "    \$item['image']         = (!empty(\$item['cover'])\n"
        . "        ? (function_exists('asset') ? asset(\$item['cover']) : \$item['cover'])\n"
        . "        : amazonCoverFromLink(\$item['amazon_link']));\n"
        . "    \$item['category_slug'] = strtolower(preg_replace('/[^a-z0-9]+/i', '-', \$item['category']));\n"
        . "    return \$item;\n"
        . "}, [\n";
    foreach ($items as $it) {
        $line = "    ['category' => '" . admin_php_sq($it['category']) . "', "
            . "'author' => '" . admin_php_sq($it['author']) . "', "
            . "'title' => '" . admin_php_sq($it['title']) . "', "
            . "'amazon_link' => '" . admin_php_sq($it['amazon_link']) . "'";
        if (!empty($it['cover'])) $line .= ", 'cover' => '" . admin_php_sq($it['cover']) . "'";
        $line .= "],\n";
        $out .= $line;
    }
    $out .= "]);\n\n"
        . "/* Build the genre tabs list dynamically from the data, `All` first,\n"
        . "   then unique categories sorted alphabetically. */\n"
        . "\$portfolioCategories = [];\n"
        . "foreach (\$portfolioItems as \$b) {\n"
        . "    \$portfolioCategories[\$b['category_slug']] = \$b['category'];\n"
        . "}\n"
        . "asort(\$portfolioCategories);\n"
        . "\$portfolioTabs = ['all' => 'All'] + \$portfolioCategories;\n";
    return $out;
}

function admin_portfolio_write(array $items): array {
    $content = admin_portfolio_render(array_values($items));
    [$ok, $msg] = admin_php_lint($content);
    if (!$ok) return [false, 'Portfolio data failed PHP lint: ' . $msg];
    if (!admin_replace_site_file(SITE_PORTFOLIO_DATA, $content)) return [false, 'Could not write portfolio data.'];
    return [true, 'Saved.'];
}

/* ===========================================================================
   TESTIMONIALS (written) — unified single source
=========================================================================== */
function admin_testimonials_read(): array {
    $file = is_file(SITE_TESTI_DATA) ? SITE_TESTI_DATA : null;
    if ($file) {
        $reviews = [];
        require $file;             // sets $reviews
        return is_array($reviews) ? array_values($reviews) : [];
    }
    // First run: seed from the existing marquee include.
    if (is_file(SITE_TESTI_LEGACY)) {
        $src = (string)file_get_contents(SITE_TESTI_LEGACY);
        if (preg_match('/\$reviews\s*=\s*\$reviews\s*\?\?\s*(\[.*?\])\s*;/s', $src, $m)) {
            $arr = admin_safe_eval_array($m[1]);
            if (is_array($arr)) return admin_testimonials_normalise($arr);
        }
    }
    return [];
}
function admin_testimonials_normalise(array $arr): array {
    $out = [];
    foreach ($arr as $r) {
        if (!is_array($r)) continue;
        $out[] = [
            'name'   => (string)($r['name'] ?? ''),
            'role'   => (string)($r['role'] ?? ''),
            'rating' => (int)($r['rating'] ?? 5),
            'text'   => (string)($r['text'] ?? ''),
        ];
    }
    return $out;
}
function admin_testimonials_render(array $reviews): string {
    $out = "<?php\n"
        . "/* Author testimonials — single source of truth (managed in /admin).\n"
        . "   Consumed by includes/testimonials.php (marquee) and testimonial.php (grid). */\n"
        . "\$reviews = [\n";
    foreach ($reviews as $r) {
        $rating = max(1, min(5, (int)($r['rating'] ?? 5)));
        $out .= "    ['name' => '" . admin_php_sq((string)$r['name']) . "', "
            . "'role' => '" . admin_php_sq((string)$r['role']) . "', "
            . "'rating' => " . $rating . ", "
            . "'text' => '" . admin_php_sq((string)$r['text']) . "'],\n";
    }
    $out .= "];\n";
    return $out;
}
function admin_testimonials_write(array $reviews): array {
    $reviews = admin_testimonials_normalise($reviews);
    $content = admin_testimonials_render($reviews);
    [$ok, $msg] = admin_php_lint($content);
    if (!$ok) return [false, 'Testimonials data failed PHP lint: ' . $msg];
    if (!admin_replace_site_file(SITE_TESTI_DATA, $content)) return [false, 'Could not write testimonials data.'];
    return [true, 'Saved.'];
}

/* ===========================================================================
   AUTHORS — bios for the "About the Author" box
=========================================================================== */
function admin_authors_read(): array {
    if (is_file(SITE_AUTHORS_DATA)) {
        $author_bios = []; $author_fallback_bio = '';
        require SITE_AUTHORS_DATA;
        return ['bios' => is_array($author_bios) ? $author_bios : [], 'fallback' => (string)$author_fallback_bio];
    }
    // First run: seed from blog-author.php.
    $bios = []; $fallback = '';
    if (is_file(SITE_AUTHOR_INCLUDE)) {
        $src = (string)file_get_contents(SITE_AUTHOR_INCLUDE);
        if (preg_match('/\$author_bios\s*=\s*(\[.*?\])\s*;/s', $src, $m)) {
            $arr = admin_safe_eval_array($m[1]);
            if (is_array($arr)) $bios = $arr;
        }
        if (preg_match('/\$author_desc\s*=\s*\$author_bios\[[^\]]*\]\s*\?\?\s*\'((?:[^\'\\\\]|\\\\.)*)\'\s*;/s', $src, $m)) {
            $fallback = admin_unphp_sq($m[1]);
        }
    }
    return ['bios' => $bios, 'fallback' => $fallback];
}
function admin_authors_render(array $bios, string $fallback): string {
    $out = "<?php\n"
        . "/* Author bios — managed in /admin (Authors). Consumed by includes/blog-author.php. */\n"
        . "\$author_bios = [\n";
    foreach ($bios as $name => $bio) {
        $out .= "    '" . admin_php_sq((string)$name) . "' => '" . admin_php_sq((string)$bio) . "',\n";
    }
    $out .= "];\n"
        . "\$author_fallback_bio = '" . admin_php_sq($fallback) . "';\n";
    return $out;
}
function admin_authors_write(array $bios, string $fallback): array {
    $content = admin_authors_render($bios, $fallback);
    [$ok, $msg] = admin_php_lint($content);
    if (!$ok) return [false, 'Authors data failed PHP lint: ' . $msg];
    if (!admin_replace_site_file(SITE_AUTHORS_DATA, $content)) return [false, 'Could not write authors data.'];
    return [true, 'Saved.'];
}

/** Post counts per author (from the blog registry). */
function admin_author_post_counts(): array {
    $counts = [];
    foreach (admin_registry_model() as $r) {
        $a = $r['author'] ?? '';
        if ($a === '') continue;
        $counts[$a] = ($counts[$a] ?? 0) + 1;
    }
    return $counts;
}
