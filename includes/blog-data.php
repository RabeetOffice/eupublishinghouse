<?php
require_once __DIR__ . '/config.php';

/**
 * Central blog index for EU Publishing House.
 * Each entry's `slug` matches its filename in /blogs/<slug>.php
 */
$blog_posts = [
    [
        'slug'     => 'top-book-publishers-in-europe',
        'title'    => 'Top 10 Book Publishers in Europe',
        'excerpt'  => 'A practical 2026 guide to the top 10 book publishers in Europe, from indie-friendly modern publishers to the Big Five traditional houses.',
        'date'     => '2026-05-11',
        'category' => 'Industry',
        'image'    => 'assets/images/blog/top-publishers.webp',
        'author'   => 'Clara Lichtenberg',
        'read'     => '12 min read',
    ],
    [
        'slug'     => 'how-much-does-book-cover-design-cost-in-europe',
        'title'    => 'How Much Does Book Cover Design Cost in Europe?',
        'excerpt'  => 'A 2026 breakdown of book cover design costs across Europe by region, designer experience and complexity. VAT, contracts, rights, and the cheapest places to hire.',
        'date'     => '2026-05-11',
        'category' => 'Design',
        'image'    => 'assets/images/blog/book-cover-design-cost.webp',
        'author'   => 'Clara Lichtenberg',
        'read'     => '14 min read',
    ],
];

usort($blog_posts, static function ($a, $b) {
    return strcmp($b['date'], $a['date']);
});

if (!function_exists('blog_get_post')) {
    function blog_get_post(string $slug): ?array {
        global $blog_posts;
        foreach ($blog_posts as $post) {
            if ($post['slug'] === $slug) return $post;
        }
        return null;
    }
}

if (!function_exists('blog_get_recent')) {
    function blog_get_recent(int $limit = 3, ?string $excludeSlug = null): array {
        global $blog_posts;
        $out = [];
        foreach ($blog_posts as $post) {
            if ($excludeSlug !== null && $post['slug'] === $excludeSlug) continue;
            $out[] = $post;
            if (count($out) >= $limit) break;
        }
        return $out;
    }
}

if (!function_exists('blog_post_url')) {
    function blog_post_url(string $slug): string {
        return 'blogs/' . $slug . '.php';
    }
}

if (!function_exists('blog_format_date')) {
    function blog_format_date(string $iso): string {
        $ts = strtotime($iso);
        return $ts ? date('j M Y', $ts) : $iso;
    }
}
