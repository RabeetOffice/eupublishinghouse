<?php
require_once __DIR__ . '/config.php';

/**
 * Central blog index for EU Publishing House.
 * Each entry's `slug` matches its filename in /blogs/<slug>.php
 */
$blog_posts = [
    [
        'slug'     => 'what-is-a-short-story',
        'title'    => 'What Is a Short Story? Full Guide for Swiss Writers',
        'excerpt'  => 'Learn what a short story is, its structure, word count, and core elements, plus how Swiss writers can craft, publish, and share short fiction effectively.',
        'date'     => '2026-06-17',
        'category' => 'Writing',
        'image'    => asset('images/blog/What Is a Short Storys.png'),
        'image_alt'=> 'What Is a Short Story? Full Guide for Swiss Writers',
        'author'   => 'Clara Lichtenberg',
        'read'     => '16 min read',
    ],
    [
        'slug'     => 'what-is-a-memoir',
        'title'    => 'What Is a Memoir? A Complete Writing Guide for Writers',
        'excerpt'  => 'Discover what a memoir is, how it differs from an autobiography, and what it truly takes to sit down and write one well with genuine craft and intention.',
        'date'     => '2026-06-08',
        'category' => 'Writing',
        'image'    => asset('images/blog/what-is-a-memoir.webp'),
        'image_alt'=> 'What is a memoir – a complete memoir writing guide for writers',
        'author'   => 'Clara Lichtenberg',
        'read'     => '16 min read',
    ],
    [
        'slug'     => 'top-book-publishers-in-europe',
        'title'    => 'Top 10 Book Publishers in Europe',
        'excerpt'  => 'A practical 2026 guide to the top 10 book publishers in Europe, from indie-friendly modern publishers to the Big Five traditional houses.',
        'date'     => '2026-05-11',
        'category' => 'Industry',
        'image'    => asset('images/blog/top-publishers.webp'),
        'image_alt'=> 'Top book publishers in the world – leading traditional publishing houses',
        'author'   => 'Clara Lichtenberg',
        'read'     => '12 min read',
    ],
    [
        'slug'     => 'how-much-does-book-cover-design-cost-in-europe',
        'title'    => 'How Much Does Book Cover Design Cost in Europe?',
        'excerpt'  => 'A 2026 breakdown of book cover design costs across Europe by region, designer experience and complexity. VAT, contracts, rights, and the cheapest places to hire.',
        'date'     => '2026-05-11',
        'category' => 'Design',
        'image'    => asset('images/blog/book-cover-design-cost.webp'),
        'image_alt'=> 'How much does book cover design cost – professional book cover pricing guide',
        'author'   => 'Clara Lichtenberg',
        'read'     => '14 min read',
    ],
    [
        'slug'     => 'self-publish-on-amazon-kdp-in-europe',
        'title'    => 'How to Self-Publish on Amazon KDP in Europe',
        'excerpt'  => 'A complete 2026 walkthrough of self-publishing on Amazon KDP for European authors. Manuscript prep, cover design, formatting, KDP upload, pricing, royalties and marketing.',
        'date'     => '2026-05-25',
        'category' => 'Publishing',
        'image'    => asset('images/blog/self-publish-kdp-europe.webp'),
        'image_alt'=> 'How to self-publish on KDP in Europe – step-by-step guide for European authors',
        'author'   => 'Clara Lichtenberg',
        'read'     => '18 min read',
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
        // Absolute pretty URL: /brands/eupublishinghouse.com/blogs/<slug>/
        return link_to('blogs/' . $slug . '.php');
    }
}

if (!function_exists('blog_format_date')) {
    function blog_format_date(string $iso): string {
        $ts = strtotime($iso);
        return $ts ? date('j M Y', $ts) : $iso;
    }
}
