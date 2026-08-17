<?php
/* =================================================================
   STRUCTURED DATA FOR LOCATION PAGES

   Emits a BreadcrumbList (so Google shows the Home › Locations › Ireland
   trail instead of a bare URL) and, when asked, a Service node tied to
   the site-wide Organization already declared in header.php.

   Set before include:
     $schemaCrumbs  , [['name' => 'Locations', 'url' => 'https://.../locations/'], ...]
                      Home is prepended automatically. The final item is the
                      current page and should still carry its own URL.
     $schemaService , optional [
                          'name'        => 'Book Editing Services in Ireland',
                          'description' => '...',
                          'url'         => 'https://.../book-editing-services-in-ireland/',
                          'serviceType' => 'Book editing',
                          'areaServed'  => 'Ireland',
                      ]
================================================================= */

require_once __DIR__ . '/config.php';

$schemaCrumbs  = $schemaCrumbs  ?? [];
$schemaService = $schemaService ?? null;
$_org          = rtrim(BRAND_SITE_URL, '/') . '/#organization';

if ($schemaCrumbs):
    $_items = array_merge(
        [['name' => 'Home', 'url' => rtrim(BRAND_SITE_URL, '/') . '/']],
        $schemaCrumbs
    );
    $_crumbLd = [
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => [],
    ];
    foreach ($_items as $i => $c) {
        $_crumbLd['itemListElement'][] = [
            '@type'    => 'ListItem',
            'position' => $i + 1,
            'name'     => $c['name'],
            'item'     => $c['url'],
        ];
    }
?>
<script type="application/ld+json">
<?= json_encode($_crumbLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>

</script>
<?php endif; ?>

<?php if ($schemaService):
    $_svcLd = [
        '@context'    => 'https://schema.org',
        '@type'       => 'Service',
        'name'        => $schemaService['name'],
        'description' => $schemaService['description'],
        'serviceType' => $schemaService['serviceType'] ?? $schemaService['name'],
        'url'         => $schemaService['url'],
        'provider'    => [
            '@type'     => 'Organization',
            '@id'       => $_org,
            'name'      => BRAND_NAME,
            'url'       => rtrim(BRAND_SITE_URL, '/') . '/',
            'telephone' => PHONE_NUMBER,
            'email'     => EMAIL_ADDRESS,
            'address'   => [
                '@type'           => 'PostalAddress',
                'streetAddress'   => 'The Observatory, 22 Windmill Ln',
                'addressLocality' => 'Dublin',
                'postalCode'      => 'D02 W282',
                'addressCountry'  => 'IE',
            ],
        ],
        'areaServed'  => [
            '@type' => 'Country',
            'name'  => $schemaService['areaServed'] ?? 'Ireland',
        ],
        'availableChannel' => [
            '@type'         => 'ServiceChannel',
            'serviceUrl'    => $schemaService['url'],
            'servicePhone'  => PHONE_NUMBER,
        ],
    ];
?>
<script type="application/ld+json">
<?= json_encode($_svcLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>

</script>
<?php endif; ?>
