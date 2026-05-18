<?php
require_once __DIR__ . '/config.php';

/* --------------------------------------------------------------
   PER-PAGE SEO
   Each page may set any of these BEFORE including this file:
     $page_title       — full <title> string
     $page_description — meta description
     $page_keywords    — meta keywords (optional)
     $canonical_url    — full canonical URL (preferred)
     $og_image         — full URL to OG image (1200×630 recommended)
     $og_type          — "website" (default) or "article"
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

    <!-- Open Graph -->
    <meta property="og:type"        content="<?= safe($_ogType) ?>" />
    <meta property="og:site_name"   content="<?= safe(BRAND_NAME) ?>" />
    <meta property="og:title"       content="<?= safe($_title) ?>" />
    <meta property="og:description" content="<?= safe($_desc) ?>" />
    <meta property="og:url"         content="<?= safe($_canon) ?>" />
    <meta property="og:image"       content="<?= safe($_ogImg) ?>" />
    <meta property="og:image:width"  content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:locale"      content="<?= safe(SEO_LOCALE) ?>" />

    <!-- Twitter -->
    <meta name="twitter:card"        content="summary_large_image" />
    <meta name="twitter:title"       content="<?= safe($_title) ?>" />
    <meta name="twitter:description" content="<?= safe($_desc) ?>" />
    <meta name="twitter:image"       content="<?= safe($_ogImg) ?>" />

    <!-- Schema -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "<?= addslashes(BRAND_NAME) ?>",
      "url": "<?= BRAND_SITE_URL ?>",
      "logo": "<?= BRAND_SITE_URL ?>/<?= IMG_URL ?>/logo.webp",
      "email": "<?= EMAIL_ADDRESS ?>",
      "telephone": "<?= PHONE_NUMBER ?>",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "The Observatory, 22 Windmill Ln",
        "addressLocality": "Dublin",
        "postalCode": "D02 W282",
        "addressCountry": "IE"
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

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="<?= img('favicon.png') ?>" />
    <link rel="apple-touch-icon" href="<?= img('favicon.png') ?>" />

    <!-- Resource hints -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://unpkg.com">
    <link rel="dns-prefetch" href="https://m.media-amazon.com">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,600;1,700;1,800&family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Lato:wght@300;400;500;600;700;900&family=Caveat:wght@400;500;600;700&display=swap" rel="stylesheet">

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

<!-- Page preloader -->
<div class="page-loader" id="pageLoader">
    <div class="loader-inner">
        <span class="loader-mark">EU</span>
        <span class="loader-line"></span>
    </div>
</div>

<?php include __DIR__ . '/navbar.php'; ?>

<main class="site-main">
