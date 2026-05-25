<?php
/**
 * Emits JSON-LD structured data for a single blog post page.
 * Expects: $post (array), $faqs (array, optional), $canonical_url (string),
 *          $og_image (string|null), $page_description (string)
 */
require_once __DIR__ . '/config.php';
if (!isset($post) || !is_array($post)) return;

$base       = rtrim(BRAND_SITE_URL, '/');
$imageAbs   = $og_image ?? ($base . '/' . ltrim($post['image'] ?? 'assets/images/og-default.jpg', '/'));
$datePub    = date('c', strtotime($post['date'] ?? 'now'));
$author     = $post['author'] ?? 'EU Publishing House';
$category   = $post['category'] ?? 'Publishing';
$desc       = $page_description ?? ($post['excerpt'] ?? '');

$articleSchema = [
    '@context'      => 'https://schema.org',
    '@type'         => 'BlogPosting',
    'headline'      => $post['title'] ?? '',
    'description'   => $desc,
    'image'         => [$imageAbs],
    'datePublished' => $datePub,
    'dateModified'  => $datePub,
    'articleSection'=> $category,
    'keywords'      => $page_keywords ?? '',
    'mainEntityOfPage' => [
        '@type' => 'WebPage',
        '@id'   => $canonical_url ?? $base,
    ],
    'author' => [
        '@type' => 'Person',
        'name'  => $author,
    ],
    'publisher' => [
        '@type' => 'Organization',
        'name'  => BRAND_NAME,
        'logo'  => [
            '@type' => 'ImageObject',
            'url'   => $base . '/assets/images/logo.webp',
        ],
    ],
];

$breadcrumbSchema = [
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',  'item' => $base . '/'],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog',  'item' => $base . '/blog.php'],
        ['@type' => 'ListItem', 'position' => 3, 'name' => $post['title'] ?? '', 'item' => $canonical_url ?? ($base . '/')],
    ],
];

$jsonFlags = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;
?>
<script type="application/ld+json"><?= json_encode($articleSchema, $jsonFlags) ?></script>
<script type="application/ld+json"><?= json_encode($breadcrumbSchema, $jsonFlags) ?></script>

<?php if (!empty($faqs) && is_array($faqs)): ?>
<?php
$faqSchema = [
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => array_map(static function ($f) {
        return [
            '@type' => 'Question',
            'name'  => strip_tags($f['q'] ?? ''),
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text'  => strip_tags($f['a'] ?? ''),
            ],
        ];
    }, $faqs),
];
?>
<script type="application/ld+json"><?= json_encode($faqSchema, $jsonFlags) ?></script>
<?php endif; ?>
