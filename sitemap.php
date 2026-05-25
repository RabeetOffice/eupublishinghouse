<?php
/* =================================================================
   XML SITEMAP — pulled live from blog-data.php so newly-added posts
   show up automatically. Served at /sitemap.xml via .htaccess rewrite
   (see the rule at the bottom of /.htaccess).
================================================================= */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/blog-data.php';

header('Content-Type: application/xml; charset=utf-8');

$base   = rtrim(BRAND_SITE_URL, '/');
$today  = date('Y-m-d');

/* ----- Static pages with priority + change frequency ----- */
$staticPages = [
    ['',                       '1.0', 'weekly'],
    ['about.php',              '0.8', 'monthly'],
    ['services.php',           '0.9', 'monthly'],
    ['publishing.php',         '0.9', 'monthly'],
    ['editing.php',            '0.8', 'monthly'],
    ['ghostwriting.php',       '0.8', 'monthly'],
    ['design.php',             '0.8', 'monthly'],
    ['formatting.php',         '0.8', 'monthly'],
    ['marketing.php',          '0.8', 'monthly'],
    ['portfolios.php',         '0.7', 'weekly'],
    ['blog.php',               '0.9', 'weekly'],
    ['testimonial.php',        '0.6', 'monthly'],
    ['faq.php',                '0.7', 'monthly'],
    ['contact.php',            '0.8', 'monthly'],
    ['privacy-policy.php',     '0.3', 'yearly'],
    ['terms-conditions.php',   '0.3', 'yearly'],
];

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
echo '        xmlns:xhtml="http://www.w3.org/1999/xhtml"' . "\n";
echo '        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";

foreach ($staticPages as [$path, $priority, $freq]) {
    $loc = $base . '/' . ltrim($path, '/');
    echo "  <url>\n";
    echo "    <loc>" . htmlspecialchars($loc, ENT_QUOTES | ENT_XML1, 'UTF-8') . "</loc>\n";
    echo "    <lastmod>{$today}</lastmod>\n";
    echo "    <changefreq>{$freq}</changefreq>\n";
    echo "    <priority>{$priority}</priority>\n";
    echo "  </url>\n";
}

/* ----- Blog detail pages (driven by blog-data.php) ----- */
foreach ($blog_posts as $post) {
    $loc      = $base . '/blogs/' . $post['slug'] . '.php';
    $lastmod  = date('Y-m-d', strtotime($post['date'] ?? 'now'));
    $imageUrl = $base . '/' . ltrim($post['image'] ?? '', '/');
    $title    = htmlspecialchars($post['title'] ?? '', ENT_QUOTES | ENT_XML1, 'UTF-8');
    echo "  <url>\n";
    echo "    <loc>" . htmlspecialchars($loc, ENT_QUOTES | ENT_XML1, 'UTF-8') . "</loc>\n";
    echo "    <lastmod>{$lastmod}</lastmod>\n";
    echo "    <changefreq>monthly</changefreq>\n";
    echo "    <priority>0.7</priority>\n";
    if (!empty($post['image'])) {
        echo "    <image:image>\n";
        echo "      <image:loc>" . htmlspecialchars($imageUrl, ENT_QUOTES | ENT_XML1, 'UTF-8') . "</image:loc>\n";
        echo "      <image:title>{$title}</image:title>\n";
        echo "    </image:image>\n";
    }
    echo "  </url>\n";
}

echo '</urlset>' . "\n";
