<?php
require_once __DIR__ . '/config.php';

/* --------------------------------------------------------------
   PER-PAGE SEO
   Each page may set any of these BEFORE including this file:
     $page_title      , full <title> string
     $page_description, meta description
     $page_keywords   , meta keywords (optional)
     $canonical_url   , full canonical URL (preferred)
     $og_image        , full URL to OG image (1200×630 recommended)
     $og_type         , "website" (default) or "article"
   Falls back to the $PAGE_META registry, then to global SEO defaults.
-------------------------------------------------------------- */
$_meta = getMeta();

$_title   = $page_title       ?? ($_meta['title']       ?? SEO_DEFAULT_TITLE);
$_desc    = $page_description ?? ($_meta['description'] ?? SEO_DEFAULT_DESCRIPTION);
$_kw      = $page_keywords    ?? ($_meta['keywords']    ?? SEO_DEFAULT_KEYWORDS);
$_canon   = $canonical_url    ?? ($_meta['canonical']   ?? rtrim(BRAND_SITE_URL, '/') . '/');
$_ogImg   = $og_image         ?? SEO_DEFAULT_IMAGE;
$_ogType  = $og_type          ?? 'website';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="<?= BRAND_PRIMARY ?>" />

    <title><?= safe($_title) ?></title>
    <meta name="description" content="<?= safe($_desc) ?>" />
    <?php if (!empty($_kw)): ?>
    <meta name="keywords" content="<?= safe($_kw) ?>" />
    <?php endif; ?>
    <meta name="author" content="<?= safe(SEO_AUTHOR) ?>" />
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <link rel="canonical" href="<?= safe($_canon) ?>" />

    <?php
    /* Detect og image mime so social validators know what to expect.
       Falls back to image/jpeg if the URL has no recognised extension. */
    $_ogImgExt  = strtolower(pathinfo(parse_url($_ogImg, PHP_URL_PATH) ?? '', PATHINFO_EXTENSION));
    $_ogImgMime = [
        'webp' => 'image/webp', 'png' => 'image/png', 'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg', 'gif' => 'image/gif',  'svg' => 'image/svg+xml',
    ][$_ogImgExt] ?? 'image/jpeg';
    ?>
    <!-- Open Graph -->
    <meta property="og:type"         content="<?= safe($_ogType) ?>" />
    <meta property="og:site_name"    content="<?= safe(BRAND_NAME) ?>" />
    <meta property="og:title"        content="<?= safe($_title) ?>" />
    <meta property="og:description"  content="<?= safe($_desc) ?>" />
    <meta property="og:url"          content="<?= safe($_canon) ?>" />
    <meta property="og:image"        content="<?= safe($_ogImg) ?>" />
    <meta property="og:image:secure_url" content="<?= safe($_ogImg) ?>" />
    <meta property="og:image:type"   content="<?= safe($_ogImgMime) ?>" />
    <meta property="og:image:width"  content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:image:alt"    content="<?= safe($_title) ?>" />
    <meta property="og:locale"       content="<?= safe(SEO_LOCALE) ?>" />

    <!-- Twitter -->
    <meta name="twitter:card"        content="summary_large_image" />
    <meta name="twitter:title"       content="<?= safe($_title) ?>" />
    <meta name="twitter:description" content="<?= safe($_desc) ?>" />
    <meta name="twitter:image"       content="<?= safe($_ogImg) ?>" />
    <meta name="twitter:image:alt"   content="<?= safe($_title) ?>" />

    <!-- Schema: Organization (site-wide entity) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "@id": "<?= BRAND_SITE_URL ?>/#organization",
      "name": "<?= addslashes(BRAND_NAME) ?>",
      "alternateName": "EUPH",
      "url": "<?= BRAND_SITE_URL ?>",
      "logo": {
        "@type": "ImageObject",
        "url": "<?= BRAND_SITE_URL ?>/<?= IMG_URL ?>/logo.webp",
        "width": 512,
        "height": 128
      },
      "description": "<?= addslashes(WEBSITE_DESCRIPTION) ?>",
      "email": "<?= EMAIL_ADDRESS ?>",
      "telephone": "<?= PHONE_NUMBER ?>",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "The Observatory, 22 Windmill Ln",
        "addressLocality": "Dublin",
        "postalCode": "D02 W282",
        "addressCountry": "IE"
      },
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "<?= PHONE_NUMBER ?>",
        "contactType": "customer service",
        "email": "<?= EMAIL_ADDRESS ?>",
        "areaServed": ["IE", "GB", "EU", "Worldwide"],
        "availableLanguage": ["English"]
      },
      "sameAs": [
        "<?= SOCIAL_FACEBOOK ?>",
        "<?= SOCIAL_INSTAGRAM ?>",
        "<?= SOCIAL_LINKEDIN ?>",
        "<?= SOCIAL_TWITTER ?>",
        "<?= SOCIAL_YOUTUBE ?>",
        "<?= SOCIAL_PINTEREST ?>"
      ]
    }
    </script>

    <!-- Schema: WebSite (enables Google sitelinks search box) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "@id": "<?= BRAND_SITE_URL ?>/#website",
      "url": "<?= BRAND_SITE_URL ?>/",
      "name": "<?= addslashes(BRAND_NAME) ?>",
      "publisher": { "@id": "<?= BRAND_SITE_URL ?>/#organization" },
      "inLanguage": "en",
      "potentialAction": {
        "@type": "SearchAction",
        "target": {
          "@type": "EntryPoint",
          "urlTemplate": "<?= BRAND_SITE_URL ?>/blog.php?q={search_term_string}"
        },
        "query-input": "required name=search_term_string"
      }
    }
    </script>

    <!-- Favicons (Google-recommended set) -->
    <link rel="icon" href="<?= asset('images/favicon/favicon.ico') ?>" sizes="any" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?= asset('images/favicon/favicon-16x16.png') ?>" />
    <link rel="icon" type="image/png" sizes="32x32" href="<?= asset('images/favicon/favicon-32x32.png') ?>" />
    <link rel="icon" type="image/png" sizes="192x192" href="<?= asset('images/favicon/android-chrome-192x192.png') ?>" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?= asset('images/favicon/apple-touch-icon.png') ?>" />
    <link rel="manifest" href="<?= asset('images/favicon/site.webmanifest') ?>" />
    <meta name="application-name" content="<?= safe(WEBSITE_NAME) ?>" />
    <meta name="apple-mobile-web-app-title" content="<?= safe(WEBSITE_NAME) ?>" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="default" />
    <meta name="msapplication-TileColor" content="<?= BRAND_PRIMARY ?>" />
    <meta name="msapplication-TileImage" content="<?= asset('images/favicon/android-chrome-192x192.png') ?>" />

    <!-- LCP hint: preload the navbar logo so it paints fast -->
    <link rel="preload" as="image" href="<?= asset('images/logo.webp') ?>" type="image/webp" />

    <!-- Resource hints -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://unpkg.com">
    <link rel="dns-prefetch" href="https://m.media-amazon.com">

    <!-- Fonts: Inter (Apple/SF Pro alternative) + Instrument Serif for editorial italic accents -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

    <!-- Site CSS -->
    <link rel="stylesheet" href="<?= asset('css/style.css') ?>" />

    <style>
        :root {
            --c-primary: <?= BRAND_PRIMARY ?>;
            --c-primary-2: <?= BRAND_PRIMARY_2 ?>;
            --c-leaf: <?= BRAND_LEAF ?>;
            --c-leaf-2: <?= BRAND_LEAF_2 ?>;
            --c-gold: <?= BRAND_GOLD ?>;
            --c-ivory: <?= BRAND_IVORY ?>;
            --c-parchment: <?= BRAND_PARCHMENT ?>;
            --c-text: <?= BRAND_TEXT ?>;
            --c-muted: <?= BRAND_MUTED ?>;
            --c-cta: <?= BRAND_CTA ?>;
        }
    </style>
</head>
<body class="page-<?= safe(getCurrentPage()) ?>">

<?php include __DIR__ . '/navbar.php'; ?>

<main class="site-main">
