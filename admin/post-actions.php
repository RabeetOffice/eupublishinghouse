<?php
/** AJAX endpoint for the blog editor: save / publish / unpublish / delete / preview / upload. */
require __DIR__ . '/includes/auth.php';
admin_require_module('posts');
require_once __DIR__ . '/includes/post-store.php';

header('Content-Type: application/json');
admin_send_security_headers();

function out($ok, $extra = []) { echo json_encode(array_merge(['ok' => $ok], $extra)); exit; }

if ($_SERVER['REQUEST_METHOD'] !== 'POST') out(false, ['error' => 'POST required.']);
admin_require_csrf();

$action = $_POST['action'] ?? '';

/* ---------- image upload (featured / inline) ---------- */
if ($action === 'upload') {
    if (empty($_FILES['file'])) out(false, ['error' => 'No file received.']);
    $hint = $_POST['hint'] ?? 'blog-image';
    [$ok, $res] = admin_upload_image_webp($_FILES['file'], 'assets/images/blog', $hint);
    if (!$ok) out(false, ['error' => $res]);
    $assetArg = preg_replace('#^assets/#', '', $res);     // -> images/blog/foo.webp for asset()
    $url = function_exists('asset') ? asset($assetArg) : '/' . $res;
    out(true, ['asset' => $assetArg, 'url' => $url]);
}

/* ---------- gather submitted fields into a post source ---------- */
function admin_collect_post(): array {
    $orig = isset($_POST['orig_slug']) ? admin_slugify($_POST['orig_slug']) : '';
    $existing = $orig !== '' ? admin_post_load($orig) : null;
    $publishedExisting = $existing && (($existing['status'] ?? '') === 'published');

    $title = trim((string)($_POST['title'] ?? ''));
    $slugIn = trim((string)($_POST['slug'] ?? ''));
    if ($publishedExisting) {
        $slug = $orig;                                   // slug locked after publish
    } else {
        $slug = admin_slugify($slugIn !== '' ? $slugIn : $title);
        if ($slug === 'post' && $title === '') $slug = 'untitled-' . date('YmdHis');
        // ensure uniqueness for brand-new posts
        if ($orig === '') {
            $base = $slug; $i = 1;
            $taken = array_merge(array_keys(admin_all_sources()), array_column(admin_registry_model(), 'slug'));
            while (in_array($slug, $taken, true)) { $slug = $base . '-' . (++$i); }
        }
    }

    $rawBody = (string)($_POST['body'] ?? '');
    $body = ukph_sanitize_body($rawBody);

    $readAuto = ($_POST['read_auto'] ?? '0') === '1';
    $read = trim((string)($_POST['read'] ?? ''));
    if ($readAuto || $read === '') $read = admin_read_time($body);

    $faqs = [];
    $faqsIn = json_decode((string)($_POST['faqs'] ?? '[]'), true);
    if (is_array($faqsIn)) {
        foreach ($faqsIn as $f) {
            $q = trim(ukph_sanitize_faq((string)($f['q'] ?? '')));
            $a = trim(ukph_sanitize_faq((string)($f['a'] ?? '')));
            if ($q !== '') $faqs[] = ['q' => $q, 'a' => $a];
        }
    }

    $data = [
        'slug' => $slug,
        'status' => $existing['status'] ?? 'draft',
        'registry' => [
            'title' => $title,
            'excerpt' => trim((string)($_POST['excerpt'] ?? '')),
            'date' => trim((string)($_POST['date'] ?? date('Y-m-d'))) ?: date('Y-m-d'),
            'category' => trim((string)($_POST['category'] ?? 'Journal')) ?: 'Journal',
            'image' => trim((string)($_POST['image'] ?? '')) ?: 'images/og.webp',
            'image_alt' => trim((string)($_POST['image_alt'] ?? '')) ?: $title,
            'author' => trim((string)($_POST['author'] ?? 'EU Publishing House')) ?: 'EU Publishing House',
            'read' => $read,
        ],
        'seo' => [
            'page_title' => trim((string)($_POST['page_title'] ?? '')) ?: $title,
            'page_description' => trim((string)($_POST['page_description'] ?? '')) ?: trim((string)($_POST['excerpt'] ?? '')),
            'page_keywords' => trim((string)($_POST['page_keywords'] ?? '')),
        ],
        'banner' => [
            'crumb' => trim((string)($_POST['crumb'] ?? '')) ?: $title,
            'title' => trim((string)($_POST['banner_title'] ?? '')) ?: htmlspecialchars($title, ENT_QUOTES),
            'sub' => trim((string)($_POST['banner_sub'] ?? '')),
        ],
        'cat_suffix' => (string)($_POST['cat_suffix'] ?? ''),
        'cta_href' => admin_slugify_keep((string)($_POST['cta_href'] ?? 'ghostwriting.php')),
        'cta_label' => trim((string)($_POST['cta_label'] ?? 'Explore Our Services')) ?: 'Explore Our Services',
        'body' => $body,
        'body_format' => 'html',
        'faqs' => $faqs,
        'read_auto' => $readAuto,
        'source' => $existing['source'] ?? 'admin',
        'created' => $existing['created'] ?? date('c'),
    ];
    // Validate the CTA target against the whitelist; fall back if unknown.
    $valid = admin_internal_link_values();
    if (!in_array($data['cta_href'], $valid, true)) $data['cta_href'] = 'ghostwriting.php';
    return [$data, $publishedExisting];
}

/** Keep a page path like 'editing.php' or 'blogs/x.php' intact (no slugify mangling). */
function admin_slugify_keep(string $s): string {
    $s = trim($s);
    return preg_match('#^[a-z0-9/\-]+\.php$#i', $s) ? $s : 'ghostwriting.php';
}

if ($action === 'save' || $action === 'publish' || $action === 'preview') {
    [$data, $wasPublished] = admin_collect_post();
    if ($data['registry']['title'] === '') out(false, ['error' => 'A title is required.']);

    if ($action === 'preview') {
        [$ok, $res] = admin_generate_preview($data);
        if (!$ok) out(false, ['error' => $res]);
        out(true, ['url' => function_exists('link_to') ? link_to('blogs/' . ADMIN_PREVIEW_SLUG . '.php') : ('/blogs/' . ADMIN_PREVIEW_SLUG . '/')]);
    }

    if ($action === 'save') {
        admin_post_save($data);
        out(true, ['slug' => $data['slug'], 'read' => $data['registry']['read'], 'message' => 'Draft saved.']);
    }

    // publish / update
    [$pok, $pmsg] = admin_publish_post($data);
    if (!$pok) out(false, ['error' => $pmsg]);
    out(true, ['slug' => $data['slug'], 'read' => $data['registry']['read'],
               'url' => function_exists('link_to') ? link_to('blogs/' . $data['slug'] . '.php') : ('/blogs/' . $data['slug'] . '/'),
               'message' => $wasPublished ? 'Post updated.' : 'Published!']);
}

if ($action === 'unpublish') {
    $slug = admin_slugify((string)($_POST['slug'] ?? ''));
    [$ok, $msg] = admin_unpublish_post($slug);
    out($ok, ['message' => $msg]);
}

if ($action === 'delete') {
    $slug = admin_slugify((string)($_POST['slug'] ?? ''));
    [$ok, $msg] = admin_delete_post($slug);
    out($ok, ['message' => $msg, 'redirect' => 'posts.php']);
}

out(false, ['error' => 'Unknown action.']);
