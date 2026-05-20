<?php
/* =================================================================
   PORTFOLIO, single source of truth for every book card on the site.
   Edit this file once; every page that pulls portfolio data updates.

   Files that consume this data:
     - index.php                (home hero slider + portfolio grid)
     - includes/portfolio-slider.php  (home-page slider include)
     - portfolios.php           (full portfolio page · genres + search)

   Each entry: category, author, title, amazon_link
   Cover URL is auto-derived from the Amazon ASIN inside the link.
================================================================= */

if (!function_exists('amazonCoverFromLink')) {
    function amazonCoverFromLink(string $amazonLink): string
    {
        if (preg_match('~/dp/([A-Z0-9]{10})~i', $amazonLink, $matches)) {
            return 'https://m.media-amazon.com/images/P/' . strtoupper($matches[1]) . '.01._SCLZZZZZZZ_SX500_.jpg';
        }
        return 'assets/images/hero-book-horizon.png';
    }
}

$portfolioItems = array_map(static function (array $item): array {
    $item['image']         = amazonCoverFromLink($item['amazon_link']);
    $item['category_slug'] = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $item['category']));
    return $item;
}, [
    ['category' => 'Fiction',       'author' => 'Patrick Budden',     'title' => 'Heartbreak Farm',                                          'amazon_link' => 'https://www.amazon.com/Heartbreak-Farm-Patrick-Budden-ebook/dp/B0GCJJ9H9M/'],
    ['category' => 'Biography',     'author' => 'Robert Rosamond',    'title' => "A Bobby's Job",                                            'amazon_link' => 'https://www.amazon.com/Bobbys-Job-Robert-Rosamond-ebook/dp/B0FKHHKQVQ/'],
    ['category' => 'Fiction',       'author' => 'Jason Bradwell',     'title' => 'Roll of Reality: A Dungeon and Dreamers Tale',             'amazon_link' => 'https://www.amazon.com/ROLL-REALITY-Dungeon-Dreamers-Tale/dp/1918162824/'],
    ['category' => 'Informative',   'author' => 'Dominic Bayor',      'title' => 'Mystery of Days, Times, and Seasons',                      'amazon_link' => 'https://www.amazon.com/Mystery-Times-Seasons-Dominic-Bayor-ebook/dp/B0FYNH7LMW'],
    ['category' => 'Non Fiction',   'author' => 'Dominic Bayor',      'title' => 'The Mystery of Prayer',                                    'amazon_link' => 'https://www.amazon.com/Mystery-Prayer-Dominic-Bayor-ebook/dp/B0G9X9CNRF/'],
    ['category' => 'Non Fiction',   'author' => 'Sheena L.C. Walker', 'title' => 'Say Yes: The Hidden Laws of Business Performance',         'amazon_link' => 'https://www.amazon.com/SAY-YES-Business-Performance-World-Class-ebook/dp/B0FYTHR2WT/'],
    ['category' => 'Fiction',       'author' => 'Vera Brown',         'title' => 'The Old Ways of Witches and Black Magic',                  'amazon_link' => 'https://www.amazon.com/Old-Ways-Witches-Black-Magic-ebook/dp/B0FTNDHYPZ/'],
    ['category' => 'Informative',   'author' => 'Heather Green',      'title' => 'Art & Poetry',                                             'amazon_link' => 'https://www.amazon.com/Art-Poetry-Heather-Green-ebook/dp/B0FXGYYQZ1/'],
    ['category' => 'Children Book', 'author' => 'Heather Green',      'title' => "The Duck, the Limpet and the Crab",                        'amazon_link' => 'https://www.amazon.com/DUCK-LIMPET-CRAB-Childrens-Stories-ebook/dp/B0GPB1YCF9/'],
    ['category' => 'Children Book', 'author' => 'Chelsey Thomas',     'title' => 'Being Me is My Superpower',                                'amazon_link' => 'https://www.amazon.com/Being-Me-My-Superpower-inspire-ebook/dp/B0FYS1PVNP/'],
    ['category' => 'Memoir',        'author' => 'Cerys Pugh',         'title' => 'Flames Into Dust, Edition Two',                           'amazon_link' => 'https://www.amazon.com/Flames-Into-Dust-Cerys-Pugh-ebook/dp/B0GBXD237W/'],
    ['category' => 'Fiction',       'author' => 'Michael Wattam',     'title' => 'Ragnarok: The Twilight of the Gods',                       'amazon_link' => 'https://www.amazon.com/Ragnar%C3%B6k-Twilight-Gods-Michael-Wattam/dp/1918162344/'],
    ['category' => 'Fiction',       'author' => 'Rose Lainie',        'title' => 'The Cafe on the Corner',                                   'amazon_link' => 'https://www.amazon.com/Caf%C3%A9-Corner-Rose-Lainie-ebook/dp/B0GBXSPCM6/'],
    ['category' => 'Fiction',       'author' => 'Peter Mellors',      'title' => 'Fox, Badger Hedgehog, and Me',                             'amazon_link' => 'https://www.amazon.com/Fox-Badger-Hedgehog-Peter-Mellors-ebook/dp/B0GCX1KW3Z/'],
    ['category' => 'Fiction',       'author' => 'Patrick Gillan',     'title' => 'Ladder to Murder: A Philippa Abbott Mystery',              'amazon_link' => 'https://www.amazon.com/Ladder-Murder-Philippa-Abbott-Mystery-ebook/dp/B0GCMTPZK9/'],
    ['category' => 'Biography',     'author' => 'Patrick Gillan',     'title' => "A Boy's Story: Abused, Survived, Thrived",                 'amazon_link' => 'https://www.amazon.com/Boys-Story-ABUSED-SURVIVED-THRIVED-ebook/dp/B0GS4FZCZR/'],
    ['category' => 'Memoir',        'author' => 'Keith Hagger',       'title' => 'Paint the Sky',                                            'amazon_link' => 'https://www.amazon.com/Paint-Sky-Keith-Hagger-ebook/dp/B0GSFQCJ26/'],
    ['category' => 'Memoir',        'author' => 'Joy Jewett',         'title' => 'Chaos of Life: Whispers From a Soul Trying to Stay',       'amazon_link' => 'https://www.amazon.com/Chaos-Life-Whispers-Soul-Trying-ebook/dp/B0GHZRGPXN/'],
]);

/* Build the genre tabs list dynamically from the data, `All` first,
   then unique categories sorted alphabetically. */
$portfolioCategories = [];
foreach ($portfolioItems as $b) {
    $portfolioCategories[$b['category_slug']] = $b['category'];
}
asort($portfolioCategories);
$portfolioTabs = ['all' => 'All'] + $portfolioCategories;
