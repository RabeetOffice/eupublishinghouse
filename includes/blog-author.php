<?php
/**
 * Renders an "About the Author" block for blog single pages.
 * Expects: $post (array) with 'author' key.
 */
require_once __DIR__ . '/config.php';
if (!isset($post) || !is_array($post)) return;

$author_name = trim($post['author'] ?? 'EU Publishing House');

$author_bios = [
    'Clara Lichtenberg' => 'Clara Lichtenberg is presented as a European academic-style writer whose work sits at the intersection of literary philosophy, cultural theory, and narrative fiction. Her writing is characterised by a deliberate, measured prose style that prioritises conceptual depth over plot-driven storytelling, often resembling a hybrid between philosophical essays and introspective fiction.',
];

$author_desc = $author_bios[$author_name] ?? 'The editorial team at EU Publishing House brings together editors, designers, and publishing professionals who help authors take their manuscripts from draft to published book. Our writers share practical guidance drawn from years of hands-on experience across editing, design, formatting, printing, and marketing.';

$author_initials = '';
foreach (preg_split('/\s+/', $author_name) as $part) {
    if ($part !== '') { $author_initials .= mb_substr($part, 0, 1); }
}
$author_initials = mb_strtoupper(mb_substr($author_initials, 0, 2));
?>
<section class="blog-author">
    <div class="blog-author-card">
        <div class="blog-author-avatar" aria-hidden="true"><?= safe($author_initials) ?></div>
        <div class="blog-author-body">
            <span class="blog-author-eyebrow">About the Author</span>
            <h3 class="blog-author-name"><?= safe($author_name) ?></h3>
            <p class="blog-author-desc"><?= safe($author_desc) ?></p>
        </div>
    </div>
</section>
