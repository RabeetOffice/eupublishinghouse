<?php
/**
 * EU Publishing House — Blog publish pipeline.
 *
 * The single most important property: a generated blogs/<slug>.php is BYTE-IDENTICAL
 * to the brand's hand-built post template, so SEO (title/meta/canonical/JSON-LD/TOC/
 * internal links/FAQ schema) is never degraded. See tests/byte_identical_test.php.
 *
 * Security: the article BODY is the only raw-HTML sink. It is sanitised through a
 * DOMDocument whitelist that DROPS PHP processing-instruction nodes (gotcha #1), then
 * a belt-and-suspenders ukph_strip_php() pass. Internal links / inline images are a
 * controlled feature: the generator re-emits them as <?= link_to('page.php') ?> /
 * <?= asset('path') ?> from VALIDATED, whitelisted attributes — content can never
 * become arbitrary code.
 */

require_once __DIR__ . '/helpers.php';

define('SITE_BLOGS_DIR', SITE_ROOT . '/blogs');
define('SITE_BLOG_DATA', SITE_ROOT . '/includes/blog-data.php');
define('SITE_TRASH_DIR', SITE_ROOT . '/trash');
define('ADMIN_PREVIEW_SLUG', 'admin-preview');

/* ===========================================================================
   POST TEMPLATE — transcribed from the newest post (what-is-a-memoir.php).
   Only the per-post bits are placeholders. Everything else is verbatim.
=========================================================================== */
function admin_post_template(): string {
    return <<<'TPL'
<?php
$site_base = '../';
$GLOBALS['site_base']        = $site_base;
$GLOBALS['current_page_key'] = 'blog';

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/blog-data.php';

$current_slug = '%%SLUG%%';
$post = blog_get_post($current_slug);

if (!$post) {
    header('HTTP/1.0 404 Not Found');
    echo 'Article not found.';
    exit;
}

$page_title       = '%%PAGE_TITLE%%';
$page_description = '%%PAGE_DESC%%';
$page_keywords    = '%%PAGE_KEYWORDS%%';
$canonical_url    = rtrim(BRAND_SITE_URL, '/') . '/blogs/' . $current_slug . '/';
$og_image         = rtrim(BRAND_SITE_URL, '/') . '/' . ltrim($post['image'], '/');
$og_type          = 'article';
$share_url        = $canonical_url;

require __DIR__ . '/../includes/header.php';

$banner = [
    'crumb' => '%%BANNER_CRUMB%%',
    'title' => '%%BANNER_TITLE%%',
    'sub'   => '%%BANNER_SUB%%',
];
include __DIR__ . '/../includes/page-banner.php';
?>

<section class="blog-section">
    <div class="container">

        <figure class="blog-feature" data-aos="fade-up">
            <div class="blog-feature__art">
                <img src="<?= safe($post['image']) ?>"
                     alt="<?= safe($post['image_alt']) ?>"
                     class="blog-feature__img"
                     loading="lazy"
                     decoding="async"
                     onload="this.parentElement.classList.add('is-loaded')"
                     onerror="this.parentElement.classList.add('is-loaded','is-error')">
            </div>
        </figure>

        <div class="blog-layout" data-aos="fade-up">
            <div class="blog-post-body" id="blog-post-body">
                <div class="blog-post-meta-strip">
                    <span class="post-cat"><?= safe($post['category']) ?>%%CAT_SUFFIX%%</span>
                    <span><i class="fa-regular fa-calendar"></i><?= safe(blog_format_date($post['date'])) ?></span>
                    <span class="meta-divider" aria-hidden="true"></span>
                    <span><i class="fa-regular fa-user"></i><?= safe($post['author']) ?></span>
                    <span class="meta-divider" aria-hidden="true"></span>
                    <span><i class="fa-regular fa-clock"></i><?= safe($post['read']) ?></span>
                </div>

%%BODY%%
            </div>

            <div class="blog-sidebar-col">
                <?php include __DIR__ . '/../includes/blog-sidebar.php'; ?>
            </div>
        </div>

        <?php include __DIR__ . '/../includes/blog-author.php'; ?>

        <!-- FAQ -->
        <div class="row mt-5 justify-content-center" data-aos="fade-up">
            <div class="col-lg-9">
                <h2 class="section-title text-center">Frequently Asked <em class="serif-italic">Questions</em></h2>
                <div class="accordion faq-accordion mt-4" id="postFaq">
                    <?php
%%FAQS%%
                    foreach ($faqs as $i => $f): ?>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button <?= $i === 0 ? '' : 'collapsed' ?>" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#pfaq<?= $i ?>"
                                    aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>">
                                <span class="faq-num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                                <?= safe($f['q']) ?>
                            </button>
                        </h3>
                        <div id="pfaq<?= $i ?>" class="accordion-collapse collapse <?= $i === 0 ? 'show' : '' ?>" data-bs-parent="#postFaq">
                            <div class="accordion-body"><p><?= safe($f['a']) ?></p></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="<?= link_to('blog.php') ?>" class="btn btn-outline-dark">&larr; Back to all articles</a>
            <a href="<?= link_to('%%CTA_HREF%%') ?>" class="btn btn-cta">%%CTA_LABEL%% <i class="fa-solid fa-arrow-right"></i></a>
        </div>

    </div>
</section>

<?php
$current_slug = $post['slug'];
include __DIR__ . '/../includes/blog-recent.php';
include __DIR__ . '/../includes/blog-schema.php';
include __DIR__ . '/../includes/final-cta.php';
include __DIR__ . '/../includes/footer.php';
?>

<script>
/* Build the in-article Table of Contents from H2/H3s in the post body */
(function () {
    var body = document.getElementById('blog-post-body');
    var toc  = document.getElementById('blog-toc');
    if (!body || !toc) return;

    var headings = body.querySelectorAll('h2, h3');
    if (!headings.length) return;

    var slugify = function (text) {
        return text.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
    };

    headings.forEach(function (h, i) {
        if (!h.id) h.id = slugify(h.textContent || ('section-' + i));
        var li = document.createElement('li');
        li.className = h.tagName === 'H3' ? 'toc-h3' : 'toc-h2';
        var a  = document.createElement('a');
        a.href = '#' + h.id;
        a.textContent = h.textContent || '';
        li.appendChild(a);
        toc.appendChild(li);
    });

    /* Active-section highlighting */
    var links = toc.querySelectorAll('a');
    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                links.forEach(function (l) { l.parentElement.classList.remove('is-active'); });
                var active = toc.querySelector('a[href="#' + entry.target.id + '"]');
                if (active) active.parentElement.classList.add('is-active');
            }
        });
    }, { rootMargin: '-30% 0px -65% 0px' });
    headings.forEach(function (h) { io.observe(h); });
})();
</script>

TPL;
}

/* ===========================================================================
   POST SOURCE (admin/data/posts/<slug>.json) — the admin's source of truth
=========================================================================== */
function admin_post_path(string $slug): string { return ADMIN_POSTS . '/' . admin_slugify($slug) . '.json'; }
function admin_post_load(string $slug): ?array {
    $p = admin_post_path($slug);
    return is_file($p) ? admin_json_read($p, null) : null;
}
function admin_post_save(array $data): bool {
    admin_ensure_dirs();
    $data['updated'] = date('c');
    return admin_json_write(admin_post_path($data['slug']), $data);
}
function admin_post_delete_source(string $slug): void { @unlink(admin_post_path($slug)); }

/** All admin-managed sources, newest first. */
function admin_all_sources(): array {
    $out = [];
    foreach (glob(ADMIN_POSTS . '/*.json') ?: [] as $f) {
        $d = admin_json_read($f, null);
        if (is_array($d) && !empty($d['slug'])) $out[$d['slug']] = $d;
    }
    return $out;
}

/**
 * Merged post list for the Posts page: every registry entry + every draft source.
 * Each row: slug, title, status, date, category, author, image, read, source.
 */
function admin_list_posts(): array {
    $rows = [];
    foreach (admin_registry_model() as $r) {
        $rows[$r['slug']] = [
            'slug' => $r['slug'], 'title' => $r['title'], 'status' => 'published',
            'date' => $r['date'], 'category' => $r['category'], 'author' => $r['author'],
            'image' => function_exists('asset') ? asset($r['image']) : $r['image'],
            'read' => $r['read'], 'source' => 'registry',
            'has_source' => is_file(admin_post_path($r['slug'])),
        ];
    }
    foreach (admin_all_sources() as $slug => $d) {
        if ($slug === ADMIN_PREVIEW_SLUG) continue;
        if (isset($rows[$slug])) { $rows[$slug]['has_source'] = true; $rows[$slug]['status'] = $d['status'] ?? $rows[$slug]['status']; continue; }
        $reg = $d['registry'] ?? [];
        $rows[$slug] = [
            'slug' => $slug, 'title' => $reg['title'] ?? $slug, 'status' => $d['status'] ?? 'draft',
            'date' => $reg['date'] ?? '', 'category' => $reg['category'] ?? '', 'author' => $reg['author'] ?? '',
            'image' => !empty($reg['image']) && function_exists('asset') ? asset($reg['image']) : ($reg['image'] ?? ''),
            'read' => $reg['read'] ?? '', 'source' => 'draft', 'has_source' => true,
        ];
    }
    uasort($rows, static function ($a, $b) { return strcmp($b['date'], $a['date']); });
    return array_values($rows);
}

/* ===========================================================================
   SANITISER — the property that makes a file-writing CMS safe
=========================================================================== */
function ukph_strip_php(string $s): string {
    $s = preg_replace('/<\?(?:php|=)?[\s\S]*?\?>/i', '', $s);   // complete tags
    $s = preg_replace('/<\?(?:php|=)?[\s\S]*$/i', '', $s);       // dangling open tag
    $s = preg_replace('/<%[\s\S]*?%>/', '', $s);                 // ASP-style
    $s = preg_replace('/<%[\s\S]*$/', '', $s);
    return $s;
}

function ukph_body_whitelist(): array {
    return [
        'tags' => ['p','h2','h3','h4','ul','ol','li','table','thead','tbody','tr','td','th',
                   'blockquote','figure','figcaption','hr','a','img','b','strong','i','em','u','br','span','sub','sup'],
        'attrs' => [
            'a'   => ['href','title','target','rel','data-int'],
            'img' => ['src','alt','width','height','loading','decoding','class','data-asset'],
            'table' => ['class'], 'td' => ['class','colspan','rowspan'], 'th' => ['class','colspan','rowspan','scope'],
            'blockquote' => ['class'], 'figure' => ['class'], 'figcaption' => ['class'], 'span' => ['class'],
            'ul' => ['class'], 'ol' => ['class'], 'p' => ['class'],
        ],
        'demote' => ['h1' => 'h2', 'h5' => 'h4', 'h6' => 'h4'],
    ];
}

/**
 * Whitelist-sanitise editor HTML. Drops comments/CDATA/PHP processing-instructions
 * in the DOM walk (gotcha #1). Internal links / inline images are tagged data-int /
 * data-asset so the generator can later re-emit them as link_to()/asset() calls.
 */
function ukph_sanitize_body(string $html): string {
    $html = trim($html);
    if ($html === '') return '';
    // Strip whole PHP/ASP tags up-front so DOMDocument can never leave a PI tail
    // as stray text (the HTML parser only swallows the opening "<?").
    $html = ukph_strip_php($html);
    $wl = ukph_body_whitelist();
    $internal = admin_internal_link_values();

    $dom = new DOMDocument('1.0', 'UTF-8');
    libxml_use_internal_errors(true);
    $dom->loadHTML('<?xml encoding="UTF-8"?><body><div id="ukroot">' . $html . '</div></body>',
        LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    libxml_clear_errors();

    $root = $dom->getElementById('ukroot');
    $out = $root ? ukph_walk_children($root, $wl, $internal, $dom) : '';
    $out = ukph_strip_php($out);
    // collapse runs of blank lines
    $out = preg_replace("/\n{3,}/", "\n\n", $out);
    return trim($out);
}

function ukph_walk_children(DOMNode $node, array $wl, array $internal, DOMDocument $dom): string {
    $html = '';
    foreach ($node->childNodes as $child) {
        // KEEP ONLY element + text nodes. Drop comments, CDATA, and PHP processing
        // instructions (the node type DOMDocument uses for short-tag PHP) — gotcha #1.
        if ($child->nodeType === XML_TEXT_NODE) {
            $html .= htmlspecialchars($child->nodeValue, ENT_QUOTES, 'UTF-8');
            continue;
        }
        if ($child->nodeType !== XML_ELEMENT_NODE) continue;

        $tag = strtolower($child->nodeName);
        if (isset($wl['demote'][$tag])) $tag = $wl['demote'][$tag];

        if (!in_array($tag, $wl['tags'], true)) {
            // Unknown tag: unwrap (keep sanitised children).
            $html .= ukph_walk_children($child, $wl, $internal, $dom);
            continue;
        }

        $void = in_array($tag, ['br','hr','img'], true);
        $attrStr = ukph_clean_attrs($child, $tag, $wl, $internal);

        if ($void) { $html .= '<' . $tag . $attrStr . '>'; continue; }
        $inner = ukph_walk_children($child, $wl, $internal, $dom);
        $html .= '<' . $tag . $attrStr . '>' . $inner . '</' . $tag . '>';
    }
    return $html;
}

function ukph_clean_attrs(DOMElement $el, string $tag, array $wl, array $internal): string {
    $allowed = $wl['attrs'][$tag] ?? [];
    $keep = [];
    foreach (iterator_to_array($el->attributes) as $attr) {
        $name = strtolower($attr->nodeName);
        $val  = $attr->nodeValue;
        if (strpos($name, 'on') === 0) continue;            // strip event handlers
        if (!in_array($name, $allowed, true)) continue;

        if ($name === 'href') {
            $clean = ukph_clean_url($val);
            if ($clean === null) continue;
            if (in_array($clean, $internal, true)) {
                $keep['href'] = $clean;                      // link_to() arg
                $keep['data-int'] = '1';
            } else {
                $keep['href'] = $clean;
            }
            continue;
        }
        if ($name === 'src') {
            // data-asset internal path, or a real http(s)/site URL
            if (preg_match('/^(javascript|data|vbscript):/i', trim($val))) continue;
            $keep['src'] = $val;
            continue;
        }
        if ($name === 'data-int' || $name === 'data-asset') { continue; } // set explicitly above / below
        $keep[$name] = $val;
    }
    // Re-affirm data-asset for internal asset images (src is a bare path, not a URL).
    if ($tag === 'img' && isset($keep['src']) && $el->getAttribute('data-asset') === '1'
        && !preg_match('#^(https?:)?//#i', $keep['src'])) {
        $keep['data-asset'] = '1';
    }
    $out = '';
    foreach ($keep as $k => $v) {
        $out .= ' ' . $k . '="' . htmlspecialchars($v, ENT_QUOTES, 'UTF-8') . '"';
    }
    return $out;
}

function ukph_clean_url(?string $url): ?string {
    $url = trim((string)$url);
    if ($url === '') return null;
    if (preg_match('/^(javascript|data|vbscript):/i', $url)) return null;
    return $url;
}

/** FAQ answers/questions: plain-ish text. Allow only a small inline set + safe href. */
function ukph_sanitize_faq(string $html): string {
    $html = ukph_strip_php($html);
    $html = strip_tags($html, '<a><strong><em><b><i>');
    // strip every attribute except a safe href on <a>
    $html = preg_replace_callback('/<a\b[^>]*>/i', function ($m) {
        if (preg_match('/href\s*=\s*("|\')(.*?)\1/i', $m[0], $h)) {
            $u = ukph_clean_url($h[2]);
            return $u !== null ? '<a href="' . htmlspecialchars($u, ENT_QUOTES) . '">' : '<a>';
        }
        return '<a>';
    }, $html);
    $html = preg_replace('/<(strong|em|b|i)\b[^>]*>/i', '<$1>', $html);
    return trim($html);
}

/**
 * Sanitise a short inline-HTML snippet that the template echoes RAW (the hero
 * title/subtitle, the meta-strip category suffix, the CTA label). Removes PHP/
 * script/handlers and any tag outside a tiny inline whitelist, keeping only a
 * safe `class` attribute. This is what stops a crafted cat_suffix / cta_label /
 * banner from becoming executable code or stored XSS in the generated file.
 * It is a no-op on the brand's legitimate values (e.g. ' &middot; Memoir',
 * 'What Is a <em class="serif-italic">Memoir</em>?'), so byte-fidelity holds.
 */
function ukph_sanitize_inline_html(string $s): string {
    $s = ukph_strip_php($s);
    $s = preg_replace('#<\s*(script|style)\b[^>]*>.*?<\s*/\s*\1\s*>#is', '', $s);
    $s = preg_replace('#<\s*/?\s*(script|style)\b[^>]*>#i', '', $s);
    $s = strip_tags($s, '<em><strong><b><i><span><sub><sup><br>');
    // keep ONLY a validated class attribute on the surviving inline tags
    $s = preg_replace_callback('#<(em|strong|b|i|span|sub|sup)\b([^>]*)>#i', function ($m) {
        if (preg_match('/\bclass\s*=\s*("|\')([-_a-z0-9 ]*)\1/i', $m[2], $c)) {
            return '<' . strtolower($m[1]) . ' class="' . $c[2] . '">';
        }
        return '<' . strtolower($m[1]) . '>';
    }, $s);
    return $s;
}

/* ===========================================================================
   Internal-link / inline-image conversion (stored HTML  <->  generated PHP)
=========================================================================== */
function admin_internal_link_targets(): array {
    $targets = [];
    $pages = [
        'index.php' => 'Home', 'about.php' => 'About', 'services.php' => 'Services',
        'publishing.php' => 'Publishing', 'editing.php' => 'Editing', 'ghostwriting.php' => 'Ghostwriting',
        'design.php' => 'Cover Design', 'formatting.php' => 'Formatting', 'marketing.php' => 'Marketing',
        'portfolios.php' => 'Portfolio', 'blog.php' => 'Blog', 'testimonial.php' => 'Testimonials',
        'faq.php' => 'FAQs', 'contact.php' => 'Contact', 'privacy-policy.php' => 'Privacy Policy',
        'terms-conditions.php' => 'Terms & Conditions',
    ];
    foreach ($pages as $v => $label) $targets[] = ['value' => $v, 'label' => $label, 'group' => 'Pages'];
    foreach (admin_registry_model() as $r) {
        $targets[] = ['value' => 'blogs/' . $r['slug'] . '.php', 'label' => $r['title'], 'group' => 'Blog posts'];
    }
    return $targets;
}
function admin_internal_link_values(): array {
    return array_map(static function ($t) { return $t['value']; }, admin_internal_link_targets());
}

/** Stored sanitised HTML -> file-ready HTML (re-emit internal links/images as PHP). */
function admin_body_to_php(string $html): string {
    $html = preg_replace_callback('/<a\b([^>]*)>/i', function ($m) {
        $attrs = $m[1];
        if (!preg_match('/\bdata-int=("|\')1\1/i', $attrs)) return $m[0];
        $attrs = preg_replace('/\s*data-int=("|\')1\1/i', '', $attrs);
        $attrs = preg_replace_callback('/\bhref=("|\')(.*?)\1/i', function ($h) {
            $page = html_entity_decode($h[2], ENT_QUOTES, 'UTF-8');
            return 'href="<?= link_to(\'' . admin_php_sq($page) . '\') ?>"';
        }, $attrs);
        return '<a' . $attrs . '>';
    }, $html);

    $html = preg_replace_callback('/<img\b([^>]*)>/i', function ($m) {
        $attrs = $m[1];
        if (!preg_match('/\bdata-asset=("|\')1\1/i', $attrs)) return $m[0];
        $attrs = preg_replace('/\s*data-asset=("|\')1\1/i', '', $attrs);
        $attrs = preg_replace_callback('/\bsrc=("|\')(.*?)\1/i', function ($h) {
            $p = html_entity_decode($h[2], ENT_QUOTES, 'UTF-8');
            return 'src="<?= asset(\'' . admin_php_sq($p) . '\') ?>"';
        }, $attrs);
        return '<img' . $attrs . '>';
    }, $html);

    return $html;
}

/** File-ready HTML (raw imported body) -> editor HTML (resolve PHP echoes for display). */
function admin_php_to_body(string $html): string {
    // link_to('x') | link_to("x") -> href="x" data-int="1"
    $html = preg_replace_callback('/href="<\?=?\s*(?:php\s+echo\s+)?link_to\(\s*(?:\'([^\']*)\'|"([^"]*)")\s*\)\s*;?\s*\?>"/i', function ($m) {
        $p = $m[1] !== '' ? $m[1] : ($m[2] ?? '');
        return 'href="' . htmlspecialchars($p, ENT_QUOTES) . '" data-int="1"';
    }, $html);
    // asset('x') | asset("x") -> src="x" data-asset="1"
    $html = preg_replace_callback('/src="<\?=?\s*(?:php\s+echo\s+)?asset\(\s*(?:\'([^\']*)\'|"([^"]*)")\s*\)\s*;?\s*\?>"/i', function ($m) {
        $p = $m[1] !== '' ? $m[1] : ($m[2] ?? '');
        return 'src="' . htmlspecialchars($p, ENT_QUOTES) . '" data-asset="1"';
    }, $html);
    return $html;
}

/** Editor-ready HTML for a stored post (handles both raw-imported and html sources). */
function admin_body_for_editor(array $data): string {
    $body = $data['body'] ?? '';
    if (($data['body_format'] ?? 'html') === 'raw') {
        $body = admin_php_to_body($body);
        $body = ukph_sanitize_body($body);
    }
    return $body;
}

/* ===========================================================================
   Generator
=========================================================================== */
function admin_build_faqs_block(array $faqs): string {
    $lines = ['                    $faqs = ['];
    foreach ($faqs as $f) {
        $q = admin_php_sq((string)($f['q'] ?? ''));
        $a = admin_php_sq((string)($f['a'] ?? ''));
        $lines[] = "                        ['q'=>'{$q}', 'a'=>'{$a}'],";
    }
    $lines[] = '                    ];';
    return implode("\n", $lines);
}

function admin_indent_body(string $html): string {
    $html = preg_replace('/>\s*<(p|h2|h3|h4|ul|ol|table|blockquote|figure|hr)\b/i', ">\n                <$1", $html);
    return '                ' . ltrim($html);
}

/**
 * Assemble the final blogs/<slug>.php content from a stored post source.
 */
function admin_build_post_file(array $data): string {
    $tpl = admin_post_template();
    $reg = $data['registry'] ?? [];
    $seo = $data['seo'] ?? [];
    $banner = $data['banner'] ?? [];
    $raw = (($data['body_format'] ?? 'html') === 'raw');

    if ($raw) {
        $body = $data['body'] ?? '';
        $faqsBlock = $data['faqs_block'] ?? admin_build_faqs_block($data['faqs'] ?? []);
    } else {
        $body = admin_body_to_php(admin_indent_body($data['body'] ?? ''));
        $faqsBlock = admin_build_faqs_block($data['faqs'] ?? []);
    }

    $repl = [
        '%%SLUG%%'          => admin_php_sq($data['slug']),
        '%%PAGE_TITLE%%'    => admin_php_sq((string)($seo['page_title'] ?? $reg['title'] ?? '')),
        '%%PAGE_DESC%%'     => admin_php_sq((string)($seo['page_description'] ?? $reg['excerpt'] ?? '')),
        '%%PAGE_KEYWORDS%%' => admin_php_sq((string)($seo['page_keywords'] ?? '')),
        '%%BANNER_CRUMB%%'  => admin_php_sq((string)($banner['crumb'] ?? $reg['title'] ?? '')),
        '%%BANNER_TITLE%%'  => admin_php_sq(ukph_sanitize_inline_html((string)($banner['title'] ?? $reg['title'] ?? ''))),
        '%%BANNER_SUB%%'    => admin_php_sq(ukph_sanitize_inline_html((string)($banner['sub'] ?? $reg['excerpt'] ?? ''))),
        '%%CAT_SUFFIX%%'    => ukph_sanitize_inline_html((string)($data['cat_suffix'] ?? '')),
        '%%BODY%%'          => $body,
        '%%FAQS%%'          => $faqsBlock,
        '%%CTA_HREF%%'      => admin_php_sq((string)($data['cta_href'] ?? 'ghostwriting.php')),
        '%%CTA_LABEL%%'     => ukph_sanitize_inline_html((string)($data['cta_label'] ?? 'Explore Our Services')),
    ];
    return strtr($tpl, $repl);
}

/** Admin-only preview file (404 to everyone else), robots-disallowed. */
function admin_generate_preview(array $data): array {
    $content = admin_build_post_file($data);
    $reg = $data['registry'] ?? [];
    $inline = "[\n"
        . "    'slug'      => 'admin-preview',\n"
        . "    'title'     => '" . admin_php_sq((string)($reg['title'] ?? 'Preview')) . "',\n"
        . "    'excerpt'   => '" . admin_php_sq((string)($reg['excerpt'] ?? '')) . "',\n"
        . "    'date'      => '" . admin_php_sq((string)($reg['date'] ?? date('Y-m-d'))) . "',\n"
        . "    'category'  => '" . admin_php_sq((string)($reg['category'] ?? 'Journal')) . "',\n"
        . "    'image'     => asset('" . admin_php_sq((string)($reg['image'] ?? 'images/og.webp')) . "'),\n"
        . "    'image_alt' => '" . admin_php_sq((string)($reg['image_alt'] ?? ($reg['title'] ?? ''))) . "',\n"
        . "    'author'    => '" . admin_php_sq((string)($reg['author'] ?? 'EU Publishing House')) . "',\n"
        . "    'read'      => '" . admin_php_sq((string)($reg['read'] ?? '5 min read')) . "',\n"
        . "]";

    $origPreamble = "require_once __DIR__ . '/../includes/config.php';\n"
        . "require_once __DIR__ . '/../includes/blog-data.php';\n\n"
        . "\$current_slug = '" . admin_php_sq($data['slug']) . "';\n"
        . "\$post = blog_get_post(\$current_slug);\n\n"
        . "if (!\$post) {\n"
        . "    header('HTTP/1.0 404 Not Found');\n"
        . "    echo 'Article not found.';\n"
        . "    exit;\n"
        . "}";

    $guard = "require_once __DIR__ . '/../includes/config.php';\n"
        . "require_once __DIR__ . '/../admin/includes/auth.php';\n"
        . "if (!admin_is_logged_in()) { header('HTTP/1.0 404 Not Found'); echo 'Article not found.'; exit; }\n"
        . "require_once __DIR__ . '/../includes/blog-data.php';\n\n"
        . "\$current_slug = 'admin-preview';\n"
        . "\$post = " . $inline . ";";

    $content = str_replace($origPreamble, $guard, $content);
    // The footer re-sets $current_slug = $post['slug']; keep preview slug stable for blog-recent.
    $content = str_replace("\$current_slug = \$post['slug'];", "\$current_slug = 'admin-preview';", $content);

    $path = SITE_BLOGS_DIR . '/' . ADMIN_PREVIEW_SLUG . '.php';
    $ok = admin_atomic_write($path, $content);
    return [$ok, $ok ? ('blogs/' . ADMIN_PREVIEW_SLUG . '/') : 'Could not write preview.'];
}
function admin_clear_preview(): void { @unlink(SITE_BLOGS_DIR . '/' . ADMIN_PREVIEW_SLUG . '.php'); }

/* ===========================================================================
   REGISTRY (includes/blog-data.php) — parse source + regenerate in house style
=========================================================================== */
function admin_registry_tail(): string {
    return <<<'TAIL'
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

TAIL;
}

function admin_registry_head(): string {
    return "<?php\n"
        . "require_once __DIR__ . '/config.php';\n\n"
        . "/**\n"
        . " * Central blog index for EU Publishing House.\n"
        . " * Each entry's `slug` matches its filename in /blogs/<slug>.php\n"
        . " */\n"
        . "\$blog_posts = [\n";
}

/** Parse the current includes/blog-data.php into an ordered model (asset arg kept raw). */
function admin_registry_model(): array {
    static $cache = null;
    if ($cache !== null) return $cache;
    $cache = [];
    if (!is_file(SITE_BLOG_DATA)) return $cache;
    $src = (string)file_get_contents(SITE_BLOG_DATA);
    if (!preg_match('/\$blog_posts\s*=\s*\[(.*?)\n\];/s', $src, $m)) return $cache;
    $block = $m[1];
    if (!preg_match_all('/\[\s*(?:\'|")slug(?:\'|").*?\],/s', $block, $entries)) return $cache;
    foreach ($entries[0] as $e) {
        $rec = [
            'slug' => admin_reg_field($e, 'slug'),
            'title' => admin_reg_field($e, 'title'),
            'excerpt' => admin_reg_field($e, 'excerpt'),
            'date' => admin_reg_field($e, 'date'),
            'category' => admin_reg_field($e, 'category'),
            'image' => admin_reg_asset($e),
            'image_alt' => admin_reg_field($e, 'image_alt'),
            'author' => admin_reg_field($e, 'author'),
            'read' => admin_reg_field($e, 'read'),
        ];
        if ($rec['slug'] !== '') $cache[] = $rec;
    }
    return $cache;
}
function admin_registry_model_fresh(): array {
    // bypass static cache after a write
    $GLOBALS['__reg_bust'] = ($GLOBALS['__reg_bust'] ?? 0) + 1;
    $fn = 'admin_registry_model';
    // Re-read from disk directly (cache lives in function static; emulate by inlined copy).
    $out = [];
    if (!is_file(SITE_BLOG_DATA)) return $out;
    $src = (string)file_get_contents(SITE_BLOG_DATA);
    if (!preg_match('/\$blog_posts\s*=\s*\[(.*?)\n\];/s', $src, $m)) return $out;
    if (!preg_match_all('/\[\s*(?:\'|")slug(?:\'|").*?\],/s', $m[1], $entries)) return $out;
    foreach ($entries[0] as $e) {
        $rec = [
            'slug' => admin_reg_field($e, 'slug'), 'title' => admin_reg_field($e, 'title'),
            'excerpt' => admin_reg_field($e, 'excerpt'), 'date' => admin_reg_field($e, 'date'),
            'category' => admin_reg_field($e, 'category'), 'image' => admin_reg_asset($e),
            'image_alt' => admin_reg_field($e, 'image_alt'), 'author' => admin_reg_field($e, 'author'),
            'read' => admin_reg_field($e, 'read'),
        ];
        if ($rec['slug'] !== '') $out[] = $rec;
    }
    return $out;
}
function admin_reg_field(string $entry, string $key): string {
    if (preg_match('/[\'"]' . preg_quote($key, '/') . '[\'"]\s*=>\s*\'((?:[^\'\\\\]|\\\\.)*)\'/s', $entry, $m)) {
        return admin_unphp_sq($m[1]);
    }
    if (preg_match('/[\'"]' . preg_quote($key, '/') . '[\'"]\s*=>\s*"((?:[^"\\\\]|\\\\.)*)"/s', $entry, $m)) {
        return stripcslashes($m[1]);
    }
    return '';
}
function admin_reg_asset(string $entry): string {
    if (preg_match('/[\'"]image[\'"]\s*=>\s*asset\(\s*\'((?:[^\'\\\\]|\\\\.)*)\'\s*\)/s', $entry, $m)) {
        return admin_unphp_sq($m[1]);
    }
    if (preg_match('/[\'"]image[\'"]\s*=>\s*\'((?:[^\'\\\\]|\\\\.)*)\'/s', $entry, $m)) {
        return admin_unphp_sq($m[1]);
    }
    return 'images/og.webp';
}
function admin_unphp_sq(string $s): string { return str_replace(["\\'", "\\\\"], ["'", "\\"], $s); }

function admin_registry_render(array $model): string {
    $out = admin_registry_head();
    foreach ($model as $r) {
        $out .= "    [\n";
        $out .= admin_reg_line('slug', "'" . admin_php_sq($r['slug']) . "'");
        $out .= admin_reg_line('title', "'" . admin_php_sq($r['title']) . "'");
        $out .= admin_reg_line('excerpt', "'" . admin_php_sq($r['excerpt']) . "'");
        $out .= admin_reg_line('date', "'" . admin_php_sq($r['date']) . "'");
        $out .= admin_reg_line('category', "'" . admin_php_sq($r['category']) . "'");
        $out .= admin_reg_line('image', "asset('" . admin_php_sq($r['image']) . "')");
        $out .= admin_reg_line('image_alt', "'" . admin_php_sq($r['image_alt']) . "'");
        $out .= admin_reg_line('author', "'" . admin_php_sq($r['author']) . "'");
        $out .= admin_reg_line('read', "'" . admin_php_sq($r['read']) . "'");
        $out .= "    ],\n";
    }
    $out .= admin_registry_tail();
    return $out;
}
function admin_reg_line(string $key, string $value): string {
    return "        " . str_pad("'" . $key . "'", 11) . "=> " . $value . ",\n";
}

/** Insert/update a registry entry (preserving existing order; new posts appended). */
function admin_registry_upsert(array $entry): bool {
    $model = admin_registry_model_fresh();
    $found = false;
    foreach ($model as $i => $r) {
        if ($r['slug'] === $entry['slug']) { $model[$i] = $entry; $found = true; break; }
    }
    if (!$found) $model[] = $entry;
    return admin_registry_write($model);
}
function admin_registry_remove(string $slug): bool {
    $model = admin_registry_model_fresh();
    $model = array_values(array_filter($model, static function ($r) use ($slug) { return $r['slug'] !== $slug; }));
    return admin_registry_write($model);
}
function admin_registry_write(array $model): bool {
    $content = admin_registry_render($model);
    [$ok, $msg] = admin_php_lint($content);
    if (!$ok) { error_log('[post-store] registry lint failed: ' . $msg); return false; }
    return admin_replace_site_file(SITE_BLOG_DATA, $content);
}

/* ===========================================================================
   PUBLISH / UPDATE / UNPUBLISH / DELETE
=========================================================================== */
function admin_registry_from_source(array $data): array {
    $reg = $data['registry'] ?? [];
    return [
        'slug' => $data['slug'],
        'title' => $reg['title'] ?? '',
        'excerpt' => $reg['excerpt'] ?? '',
        'date' => $reg['date'] ?? date('Y-m-d'),
        'category' => $reg['category'] ?? 'Journal',
        'image' => $reg['image'] ?? 'images/og.webp',
        'image_alt' => $reg['image_alt'] ?? ($reg['title'] ?? ''),
        'author' => $reg['author'] ?? 'EU Publishing House',
        'read' => $reg['read'] ?? '5 min read',
    ];
}

/** @return array{0:bool,1:string} */
function admin_publish_post(array $data): array {
    if (empty($data['slug'])) return [false, 'Missing slug.'];
    $slug = admin_slugify($data['slug']);
    $data['slug'] = $slug;

    // 1. Generate file content + lint BEFORE touching the live file.
    $content = admin_build_post_file($data);
    [$ok, $msg] = admin_php_lint($content);
    if (!$ok) return [false, 'Generated post failed PHP lint: ' . $msg];

    // 2. Upsert registry (also linted) FIRST so blog_get_post() resolves on view.
    if (!admin_registry_upsert(admin_registry_from_source($data))) {
        return [false, 'Could not update the blog registry.'];
    }

    // 3. Write the post file (backed up).
    $path = SITE_BLOGS_DIR . '/' . $slug . '.php';
    if (!is_dir(SITE_BLOGS_DIR)) @mkdir(SITE_BLOGS_DIR, 0775, true);
    if (!admin_replace_site_file($path, $content)) return [false, 'Could not write the post file.'];

    // 4. Mark source published. (sitemap.xml is generated live from the registry.)
    $data['status'] = 'published';
    admin_post_save($data);
    admin_clear_preview();
    return [true, 'Published.'];
}

function admin_unpublish_post(string $slug): array {
    $slug = admin_slugify($slug);
    admin_registry_remove($slug);
    $path = SITE_BLOGS_DIR . '/' . $slug . '.php';
    if (is_file($path)) admin_trash_file($path);
    $data = admin_post_load($slug);
    if ($data) { $data['status'] = 'draft'; admin_post_save($data); }
    return [true, 'Unpublished and moved to trash.'];
}

function admin_delete_post(string $slug): array {
    $slug = admin_slugify($slug);
    admin_registry_remove($slug);
    $path = SITE_BLOGS_DIR . '/' . $slug . '.php';
    if (is_file($path)) admin_trash_file($path);
    admin_post_delete_source($slug);
    return [true, 'Deleted (post file moved to trash).'];
}

function admin_trash_file(string $path): void {
    if (!is_dir(SITE_TRASH_DIR)) { @mkdir(SITE_TRASH_DIR, 0775, true); admin_harden_upload_dir(SITE_TRASH_DIR); }
    $dest = SITE_TRASH_DIR . '/' . basename($path) . '.' . date('Ymd-His') . '.bak';
    if (!@rename($path, $dest)) { @copy($path, $dest); @unlink($path); }
}

/* ===========================================================================
   LEGACY IMPORT — parse an existing blogs/<slug>.php into a JSON source
=========================================================================== */
function admin_import_legacy(string $slug): ?array {
    $slug = admin_slugify($slug);
    $path = SITE_BLOGS_DIR . '/' . $slug . '.php';
    if (!is_file($path)) return null;
    $src = str_replace("\r\n", "\n", (string)file_get_contents($path));

    $get = function ($pattern) use ($src) {
        return preg_match($pattern, $src, $m) ? $m[1] : '';
    };
    $page_title = admin_unphp_sq($get("/\\\$page_title\s*=\s*'((?:[^'\\\\]|\\\\.)*)';/"));
    $page_desc  = admin_unphp_sq($get("/\\\$page_description\s*=\s*'((?:[^'\\\\]|\\\\.)*)';/"));
    $page_kw    = admin_unphp_sq($get("/\\\$page_keywords\s*=\s*'((?:[^'\\\\]|\\\\.)*)';/"));

    $b_crumb = $b_title = $b_sub = '';
    if (preg_match('/\$banner\s*=\s*\[(.*?)\];/s', $src, $bm)) {
        $b = $bm[1];
        $b_crumb = admin_unphp_sq(preg_match("/'crumb'\s*=>\s*'((?:[^'\\\\]|\\\\.)*)'/s", $b, $mm) ? $mm[1] : '');
        $b_title = admin_unphp_sq(preg_match("/'title'\s*=>\s*'((?:[^'\\\\]|\\\\.)*)'/s", $b, $mm) ? $mm[1] : '');
        $b_sub   = admin_unphp_sq(preg_match("/'sub'\s*=>\s*'((?:[^'\\\\]|\\\\.)*)'/s", $b, $mm) ? $mm[1] : '');
    }

    $cat_suffix = '';
    if (preg_match('/<span class="post-cat"><\?=\s*safe\(\$post\[\'category\'\]\)\s*\?>(.*?)<\/span>/s', $src, $cm)) {
        $cat_suffix = $cm[1];
    }

    $body = '';
    if (preg_match('/<\?=\s*safe\(\$post\[\'read\'\]\)\s*\?><\/span>\s*<\/div>\n\n(.*?)\n            <\/div>\n\n            <div class="blog-sidebar-col">/s', $src, $bm2)) {
        $body = $bm2[1];
    }

    $faqs_block = '';
    if (preg_match('/                    <\?php\n(.*?)\n                    foreach \(\$faqs as \$i => \$f\): \?>/s', $src, $fm)) {
        $faqs_block = $fm[1];
    }
    $faqs = admin_faqs_parse_block($faqs_block);

    $cta_href = 'ghostwriting.php'; $cta_label = 'Explore Our Services';
    if (preg_match('/<a href="<\?=\s*link_to\(\'([^\']*)\'\)\s*\?>" class="btn btn-cta">(.*?)\s*<i class="fa-solid fa-arrow-right">/s', $src, $cta)) {
        $cta_href = admin_unphp_sq($cta[1]);
        $cta_label = trim($cta[2]);
    }

    // Registry fields come from the central index (source of truth for image asset arg).
    $reg = null;
    foreach (admin_registry_model() as $r) { if ($r['slug'] === $slug) { $reg = $r; break; } }
    if (!$reg) {
        $reg = ['slug' => $slug, 'title' => $page_title, 'excerpt' => $page_desc, 'date' => date('Y-m-d'),
                'category' => 'Journal', 'image' => 'images/og.webp', 'image_alt' => $page_title,
                'author' => 'EU Publishing House', 'read' => '5 min read'];
    }

    $data = [
        'slug' => $slug,
        'status' => 'published',
        'registry' => [
            'title' => $reg['title'], 'excerpt' => $reg['excerpt'], 'date' => $reg['date'],
            'category' => $reg['category'], 'image' => $reg['image'], 'image_alt' => $reg['image_alt'],
            'author' => $reg['author'], 'read' => $reg['read'],
        ],
        'seo' => ['page_title' => $page_title, 'page_description' => $page_desc, 'page_keywords' => $page_kw],
        'banner' => ['crumb' => $b_crumb, 'title' => $b_title, 'sub' => $b_sub],
        'cat_suffix' => $cat_suffix,
        'cta_href' => $cta_href,
        'cta_label' => $cta_label,
        'body' => $body,
        'body_format' => 'raw',
        'faqs' => $faqs,
        'faqs_block' => $faqs_block,
        'read_auto' => false,                  // imported posts keep their hand-set read time
        'source' => 'imported',
        'created' => date('c'),
        'updated' => date('c'),
    ];
    return $data;
}

/** Token-validated parser for a `$faqs = [ ... ];` block (gotcha #7: bracket-safe). */
function admin_faqs_parse_block(string $block): array {
    if (!preg_match('/\$faqs\s*=\s*(\[.*\]);?\s*$/s', trim($block), $m)) return [];
    $arr = admin_safe_eval_array($m[1]);
    if (!is_array($arr)) return [];
    $out = [];
    foreach ($arr as $f) {
        if (is_array($f) && isset($f['q'])) $out[] = ['q' => (string)$f['q'], 'a' => (string)($f['a'] ?? '')];
    }
    return $out;
}

/** Safely evaluate a self-contained array literal of strings/numbers (no calls/vars). */
function admin_safe_eval_array(string $literal) {
    $code = 'return ' . $literal . ';';
    $tokens = token_get_all('<?php ' . $code);
    $allowedId = [T_OPEN_TAG, T_RETURN, T_ARRAY, T_CONSTANT_ENCAPSED_STRING, T_WHITESPACE,
                  T_DOUBLE_ARROW, T_LNUMBER, T_DNUMBER, T_COMMENT, T_DOC_COMMENT];
    $allowedChar = ['[', ']', '(', ')', ',', ';'];
    foreach ($tokens as $t) {
        if (is_array($t)) {
            if (in_array($t[0], $allowedId, true)) continue;
            if ($t[0] === T_STRING && in_array(strtolower($t[1]), ['true', 'false', 'null'], true)) continue;
            return null;
        }
        if (!in_array($t, $allowedChar, true)) return null;
    }
    try { return eval($code); } catch (Throwable $e) { return null; }
}
