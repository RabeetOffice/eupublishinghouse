<?php
/* =================================================================
   LOCATIONS REGISTRY — single source of truth for the location hub.

   Everything location-related is driven from $SITE_LOCATIONS:
     • /locations/                     -> one card per entry here
     • the country hub page            -> one card per entry['services']
     • the shared cross-link block     -> includes/location-core-services.php

   TO ADD A NEW COUNTRY
   --------------------
   1. Copy the 'ireland' block, change the key, name, demonym, copy and
      the six 'services' entries (each `href` must be a real .php file at
      the site root, matching the canonical URL in the content brief).
   2. Build the country hub page + its service pages.
   3. Register the new URLs in /sitemap.php and $PAGE_META (config.php).
   Nothing else needs touching — the hub, nav and cross-links pick it up.
================================================================= */

require_once __DIR__ . '/config.php';

/* ----------------------------------------------------------------
   The six core service descriptions are brand-level boilerplate and
   read identically on every location page (they come straight from the
   content briefs), so they live here once instead of in seven files.
---------------------------------------------------------------- */

$SITE_LOCATIONS = [

    'ireland' => [
        'name'      => 'Ireland',
        'demonym'   => 'Irish',
        'region'    => 'Republic of Ireland',
        'country'   => 'IE',
        'hub'       => 'book-publishing-services-in-ireland.php',
        'icon'      => 'fa-clover',
        'badge'     => 'Head Office',
        'tagline'   => 'Dublin-based, working with authors nationwide',
        'blurb'     => 'Publishing, editing, ghostwriting, cover design, formatting and marketing for authors across every county, run from our Dublin office and delivered wherever you are.',
        'address'   => ADDRESS,
        'phone'     => PHONE_NUMBER,
        'phone_raw' => PHONE_NUMBER_RAW,
        'email'     => EMAIL_ADDRESS,
        'map_url'   => 'https://g.page/r/CfC-n6QmdJxNEBM/',

        /* Counties we name on the hub page. Ireland-wide service, but
           saying so specifically reads better than "nationwide". */
        'counties'  => [
            'Dublin', 'Cork', 'Galway', 'Limerick', 'Waterford', 'Kilkenny',
            'Wexford', 'Kerry', 'Mayo', 'Donegal', 'Sligo', 'Louth',
            'Meath', 'Wicklow', 'Clare', 'Tipperary',
        ],

        'stats' => [
            ['n' => '6',    'l' => 'Author services'],
            ['n' => '26',   'l' => 'Counties covered'],
            ['n' => '100%', 'l' => 'Rights stay yours'],
            ['n' => '1',    'l' => 'Point of contact'],
        ],

        'services' => [

            'publishing' => [
                'label'      => 'Book Publishing',
                'title'      => 'Book Publishers in Ireland',
                'href'       => 'book-publishers-in-ireland.php',
                'icon'       => 'fa-book',
                'card_desc'  => 'Editing, design, print and distribution handled end to end, with a written quote before anything starts and your rights left where they belong.',
                'core_title' => 'Book Publishing Services',
                'core_desc'  => 'Our book publishing services support authors through every stage of bringing a manuscript to the market. We manage editing, cover design, formatting, publishing setup, and distribution with careful attention. Our team ensures your book meets the required standards for both print and digital platforms. You remain involved throughout the process and retain full control of your work.',
            ],

            'editing' => [
                'label'      => 'Book Editing',
                'title'      => 'Book Editing Services in Ireland',
                'href'       => 'book-editing-services-in-ireland.php',
                'icon'       => 'fa-pen-fancy',
                'card_desc'  => 'Developmental, line, copy and academic editing, plus proofreading and manuscript assessments, all in Irish English as standard.',
                'core_title' => 'Book Editing Services',
                'core_desc'  => 'Our book editing services improve the clarity, structure, flow, and overall quality of your manuscript. Experienced editors review grammar, spelling, sentence structure, consistency, tone, and readability. We carefully preserve your original voice while strengthening the content and correcting errors. The final manuscript is polished, engaging, and properly prepared for publication.',
            ],

            'ghostwriting' => [
                'label'      => 'Ghostwriting',
                'title'      => 'Ghostwriting Services Ireland',
                'href'       => 'ghostwriting-services-ireland.php',
                'icon'       => 'fa-feather',
                'card_desc'  => 'Books, memoirs, autobiographies, business writing and speeches, written in your voice and signed over to you in full.',
                'core_title' => 'Ghostwriting Services',
                'core_desc'  => 'Our ghostwriting services help transform your ideas, experiences, and knowledge into a professionally written book. We work closely with you to understand your story, preferred writing style, audience, and publishing goals. Each chapter is carefully planned, written, reviewed, and refined with your approval. You remain the named author and retain full ownership of the finished manuscript.',
            ],

            'design' => [
                'label'      => 'Cover Design',
                'title'      => 'Custom Book Cover Design in Ireland',
                'href'       => 'custom-book-cover-design-in-ireland.php',
                'icon'       => 'fa-palette',
                'card_desc'  => 'Print wraparounds, Kindle-ready covers and children\'s book illustration, built to read clearly at thumbnail size as well as on a shelf.',
                'core_title' => 'Book Cover Design Services',
                'core_desc'  => 'Our book cover design services create visually appealing covers that reflect the genre, theme, and message of your book. We combine suitable imagery, typography, colours, and layout to create a strong and attractive design. Each cover is prepared according to the technical requirements of publishing platforms. The final design helps your book stand out and create a memorable first impression.',
            ],

            'formatting' => [
                'label'      => 'Book Formatting',
                'title'      => 'Book Formatting Services Ireland',
                'href'       => 'book-formatting-services-in-ireland.php',
                'icon'       => 'fa-align-left',
                'card_desc'  => 'Print layouts, Kindle and KDP files, EPUB for Apple and Kobo, Google Play, agent submissions and comic scripts, tested on real devices.',
                'core_title' => 'Book Formatting Services',
                'core_desc'  => 'Our book formatting services ensure your manuscript looks clean, organised, and consistent on every page. We format chapter headings, fonts, spacing, margins, page numbers, and other interior elements carefully. Separate layouts can be prepared for paperback, hardcover, and eBook editions where required. The finished format provides readers with a smooth and comfortable reading experience.',
            ],

            'marketing' => [
                'label'      => 'Book Marketing',
                'title'      => 'Book Marketing Services Ireland',
                'href'       => 'book-marketing-services-in-ireland.php',
                'icon'       => 'fa-bullhorn',
                'card_desc'  => 'Amazon listing and keyword work, launch planning, social content, reader lists and review outreach, sized to your actual budget.',
                'core_title' => 'Book Marketing Services',
                'core_desc'  => 'Our book marketing services help authors increase visibility, reach potential readers, and build a stronger presence. We create tailored promotional strategies using social media, digital advertising, content creation, and audience targeting. Every campaign is developed according to your book’s genre, message, and intended readership. Our approach supports greater awareness and long-term book discoverability.',
            ],
        ],
    ],

];

/* ================================================================
   HELPERS
================================================================ */

/** Full record for one location, or null if the key is unknown. */
function location_get($key) {
    return $GLOBALS['SITE_LOCATIONS'][$key] ?? null;
}

/** Clean URL of a location's hub page (e.g. /book-publishing-services-in-ireland/). */
function location_url($key) {
    $loc = location_get($key);
    return $loc ? link_to($loc['hub']) : link_to('locations.php');
}

/**
 * A location's service pages, optionally with one removed.
 * Pass the service key of the current page as $exclude so a page never
 * cross-links to itself.
 */
function location_services($key, $exclude = null) {
    $loc = location_get($key);
    if (!$loc) return [];
    $services = $loc['services'];
    if ($exclude !== null) unset($services[$exclude]);
    return $services;
}

/** Absolute canonical URL for a location page, for use in JSON-LD. */
function location_abs($path) {
    return rtrim(BRAND_SITE_URL, '/') . '/' . trim(preg_replace('/\.php$/i', '/', ltrim($path, '/')), '/') . '/';
}
