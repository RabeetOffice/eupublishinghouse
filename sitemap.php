<?php
/* =================================================================
   XML SITEMAP — pulled live from blog-data.php so newly-added posts
   show up automatically. Served at /sitemap.xml via .htaccess rewrite
   (see the rule at the bottom of /.htaccess).
================================================================= */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/blog-data.php';
require_once __DIR__ . '/includes/locations-data.php';

header('Content-Type: application/xml; charset=utf-8');

$base   = rtrim(BRAND_SITE_URL, '/');
$today  = date('Y-m-d');

/* ----- Static pages with priority + change frequency ----- */
$staticPages = [
    ['',                       '1.0', 'weekly'],
    ['about/',                 '0.8', 'monthly'],
    ['services/',              '0.9', 'monthly'],
    ['publishing/',            '0.9', 'monthly'],
    ['editing/',               '0.8', 'monthly'],
    ['ghostwriting/',          '0.8', 'monthly'],
    ['design/',                '0.8', 'monthly'],
    ['formatting/',            '0.8', 'monthly'],
    ['marketing/',             '0.8', 'monthly'],
    ['locations/',             '0.8', 'monthly'],
    ['portfolios/',            '0.7', 'weekly'],
    ['blog/',                  '0.9', 'weekly'],
    ['testimonial/',           '0.6', 'monthly'],
    ['faq/',                   '0.7', 'monthly'],
    ['contact/',               '0.8', 'monthly'],
    ['privacy-policy/',        '0.3', 'yearly'],
    ['terms-conditions/',      '0.3', 'yearly'],
];

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

foreach ($staticPages as [$path, $priority, $freq]) {
    $loc = $base . '/' . ltrim($path, '/');
    echo "  <url>\n";
    echo "    <loc>" . htmlspecialchars($loc, ENT_QUOTES | ENT_XML1, 'UTF-8') . "</loc>\n";
    echo "    <lastmod>{$today}</lastmod>\n";
    echo "    <changefreq>{$freq}</changefreq>\n";
    echo "    <priority>{$priority}</priority>\n";
    echo "  </url>\n";
}

/* ----- Location pages (driven by locations-data.php) -----
   The country hub gets the higher priority; its service pages sit just
   below it, matching the /locations/ -> country -> service hierarchy. */
foreach ($SITE_LOCATIONS as $location) {
    $locPages = [[$location['hub'], '0.9']];
    foreach ($location['services'] as $service) {
        $locPages[] = [$service['href'], '0.8'];
    }
    foreach ($locPages as [$file, $priority]) {
        $loc = $base . '/' . trim(preg_replace('/\.php$/i', '', $file), '/') . '/';
        echo "  <url>\n";
        echo "    <loc>" . htmlspecialchars($loc, ENT_QUOTES | ENT_XML1, 'UTF-8') . "</loc>\n";
        echo "    <lastmod>{$today}</lastmod>\n";
        echo "    <changefreq>monthly</changefreq>\n";
        echo "    <priority>{$priority}</priority>\n";
        echo "  </url>\n";
    }
}

/* ----- Blog detail pages (driven by blog-data.php) ----- */
foreach ($blog_posts as $post) {
    $loc      = $base . '/blogs/' . $post['slug'] . '/';
    $lastmod  = date('Y-m-d', strtotime($post['date'] ?? 'now'));
    echo "  <url>\n";
    echo "    <loc>" . htmlspecialchars($loc, ENT_QUOTES | ENT_XML1, 'UTF-8') . "</loc>\n";
    echo "    <lastmod>{$lastmod}</lastmod>\n";
    echo "    <changefreq>monthly</changefreq>\n";
    echo "    <priority>0.7</priority>\n";
    echo "  </url>\n";
}

echo '</urlset>' . "\n";
