<?php
require __DIR__ . '/includes/auth.php';
admin_require_module('posts');
require_once __DIR__ . '/includes/post-store.php';
require_once __DIR__ . '/includes/content-store.php';
require_once __DIR__ . '/includes/layout.php';

$slug = isset($_GET['slug']) ? admin_slugify($_GET['slug']) : '';
$isNew = ($slug === '');
$data = null;

// Authors come from the Authors manager. A NEW post auto-picks the primary author
// (the one with the most posts, else the first saved author) so details are pre-filled.
$authorsData    = admin_authors_read();
$authorBios     = $authorsData['bios'];
$authorFallback = $authorsData['fallback'];
$authorCounts   = admin_author_post_counts();
$primaryAuthor  = 'EU Publishing House';
if ($authorCounts)     { arsort($authorCounts); $primaryAuthor = (string)array_key_first($authorCounts); }
elseif ($authorBios)   { $primaryAuthor = (string)array_key_first($authorBios); }

if (!$isNew) {
    $data = admin_post_load($slug);
    if (!$data) {
        // First edit of a hand-built (legacy) post: import it to a JSON source.
        $imported = admin_import_legacy($slug);
        if ($imported) { admin_post_save($imported); $data = $imported; }
    }
}
if (!$data) {
    $data = [
        'slug' => '', 'status' => 'draft',
        'registry' => ['title' => '', 'excerpt' => '', 'date' => date('Y-m-d'), 'category' => '', 'image' => '', 'image_alt' => '', 'author' => $primaryAuthor, 'read' => '5 min read'],
        'seo' => ['page_title' => '', 'page_description' => '', 'page_keywords' => ''],
        'banner' => ['crumb' => '', 'title' => '', 'sub' => ''],
        'cat_suffix' => '', 'cta_href' => 'ghostwriting.php', 'cta_label' => 'Explore Our Services',
        'faqs' => [], 'read_auto' => true, 'body_format' => 'html', 'body' => '', 'source' => 'admin',
    ];
}

$bodyHtml   = admin_body_for_editor($data);
$reg        = $data['registry'];
$seo        = $data['seo'];
$banner     = $data['banner'];
$published  = ($data['status'] ?? 'draft') === 'published';
$authors    = array_keys($authorBios);
$catList    = [];
foreach (admin_registry_model() as $r) { if ($r['category'] !== '') $catList[$r['category']] = true; }
$catList    = array_keys($catList);
$linkTargets = admin_internal_link_targets();
$assetBase  = function_exists('asset') ? asset('') : '/assets/';
$featuredUrl = !empty($reg['image']) ? (function_exists('asset') ? asset($reg['image']) : $reg['image']) : '';

admin_layout_head($isNew ? 'New post' : 'Edit post', ['head' => '<style>.adm-content{max-width:1340px}</style>']);
?>
<div class="adm-page-head">
  <div>
    <span class="adm-eyebrow"><?= $published ? 'Published' : ($isNew ? 'New' : 'Draft') ?></span>
    <h1><?= $isNew ? 'Write a new <span class="serif-italic">post</span>' : 'Edit <span class="serif-italic">post</span>' ?></h1>
  </div>
  <div class="adm-toolbar-actions">
    <a class="adm-btn adm-btn-ghost adm-btn-sm" href="posts.php"><i class="fa-solid fa-arrow-left"></i> Posts</a>
    <button class="adm-btn adm-btn-ghost adm-btn-sm" type="button" id="btnPreview"><i class="fa-regular fa-eye"></i> Preview</button>
    <button class="adm-btn adm-btn-ghost adm-btn-sm" type="button" id="btnSave"><i class="fa-regular fa-floppy-disk"></i> Save draft</button>
    <button class="adm-btn adm-btn-cta adm-btn-sm" type="button" id="btnPublish"><i class="fa-solid fa-cloud-arrow-up"></i> <?= $published ? 'Update' : 'Publish' ?></button>
  </div>
</div>

<form id="postForm" onsubmit="return false">
<div class="adm-editor">
  <div class="adm-editor-main">
    <div class="adm-card adm-mb">
      <div class="adm-field"><label class="adm-label">Post title</label><input class="adm-input" id="f_title" value="<?= htmlspecialchars($reg['title']) ?>" placeholder="What Is a Memoir? A Complete Writing Guide"></div>
      <div class="adm-row">
        <div class="adm-field"><label class="adm-label">URL slug <?= $published ? '<span class="adm-chip grey" title="Locked after publishing to protect SEO">locked</span>' : '' ?></label>
          <input class="adm-input" id="f_slug" value="<?= htmlspecialchars($data['slug']) ?>" <?= $published ? 'readonly' : '' ?> placeholder="what-is-a-memoir"></div>
        <div class="adm-field"><label class="adm-label">Category</label><input class="adm-input" id="f_category" list="catList" value="<?= htmlspecialchars($reg['category']) ?>"><datalist id="catList"><?php foreach ($catList as $c): ?><option value="<?= htmlspecialchars($c) ?>"><?php endforeach; ?></datalist></div>
      </div>
      <div class="adm-field"><label class="adm-label">Excerpt <span class="adm-counter" id="cnt_excerpt"></span></label><textarea class="adm-textarea" id="f_excerpt" rows="2" style="min-height:auto" placeholder="One or two sentences used on cards & meta description fallback."><?= htmlspecialchars($reg['excerpt']) ?></textarea></div>
    </div>

    <div class="adm-card adm-mb">
      <div class="adm-card-head"><h2>Article content</h2><span class="adm-muted" style="font-size:.8rem" id="readout">—</span></div>
      <div class="adm-toolbar" id="rteToolbar">
        <button type="button" class="adm-tool" data-cmd="formatBlock" data-val="h2" title="Heading 2"><b>H2</b></button>
        <button type="button" class="adm-tool" data-cmd="formatBlock" data-val="h3" title="Heading 3"><b>H3</b></button>
        <button type="button" class="adm-tool" data-cmd="formatBlock" data-val="h4" title="Heading 4"><b>H4</b></button>
        <button type="button" class="adm-tool" data-cmd="formatBlock" data-val="p" title="Paragraph">¶</button>
        <span class="adm-tool-sep"></span>
        <button type="button" class="adm-tool" data-cmd="bold" title="Bold"><i class="fa-solid fa-bold"></i></button>
        <button type="button" class="adm-tool" data-cmd="italic" title="Italic"><i class="fa-solid fa-italic"></i></button>
        <button type="button" class="adm-tool" data-cmd="underline" title="Underline"><i class="fa-solid fa-underline"></i></button>
        <span class="adm-tool-sep"></span>
        <button type="button" class="adm-tool" data-cmd="insertUnorderedList" title="Bulleted list"><i class="fa-solid fa-list-ul"></i></button>
        <button type="button" class="adm-tool" data-cmd="insertOrderedList" title="Numbered list"><i class="fa-solid fa-list-ol"></i></button>
        <button type="button" class="adm-tool" data-cmd="formatBlock" data-val="blockquote" title="Tip / quote"><i class="fa-solid fa-quote-left"></i></button>
        <span class="adm-tool-sep"></span>
        <button type="button" class="adm-tool" id="btnLink" title="Insert internal/external link"><i class="fa-solid fa-link"></i></button>
        <button type="button" class="adm-tool" id="btnTable" title="Insert table"><i class="fa-solid fa-table"></i></button>
        <button type="button" class="adm-tool" id="btnImage" title="Insert image"><i class="fa-regular fa-image"></i></button>
        <button type="button" class="adm-tool" data-cmd="insertHorizontalRule" title="Divider"><i class="fa-solid fa-minus"></i></button>
        <span class="adm-tool-sep"></span>
        <button type="button" class="adm-tool" data-cmd="undo" title="Undo"><i class="fa-solid fa-rotate-left"></i></button>
        <button type="button" class="adm-tool" data-cmd="redo" title="Redo"><i class="fa-solid fa-rotate-right"></i></button>
        <span class="adm-tool-sep"></span>
        <button type="button" class="adm-tool adm-tool-label" id="btnSource" title="Edit HTML"><i class="fa-solid fa-code"></i> HTML</button>
      </div>
      <div class="adm-rte" id="rte" contenteditable="true" data-placeholder="Start writing your article…"><?= $bodyHtml ?></div>
      <textarea class="adm-textarea adm-source" id="rteSource" style="display:none"></textarea>
      <input type="file" id="imgFile" accept="image/*" hidden>
    </div>

    <div class="adm-card">
      <div class="adm-card-head"><h2>FAQ <span class="serif-italic">section</span></h2><button type="button" class="adm-btn adm-btn-sm adm-btn-ghost" id="btnAddFaq"><i class="fa-solid fa-plus"></i> Add question</button></div>
      <div id="faqList"></div>
    </div>
  </div>

  <div class="adm-editor-side">
    <div class="adm-card">
      <div class="adm-card-head"><h3>SEO</h3><div class="adm-score"><svg viewBox="0 0 36 36"><circle class="adm-score-bg" cx="18" cy="18" r="15.9"></circle><circle class="adm-score-fg" id="scoreRing" cx="18" cy="18" r="15.9" stroke-dasharray="100 100" stroke-dashoffset="100"></circle></svg><span class="adm-score-num" id="scoreNum">0</span></div></div>
      <div class="adm-field"><label class="adm-label">Title tag <span class="adm-counter" id="cnt_title"></span></label><input class="adm-input" id="f_page_title" value="<?= htmlspecialchars($seo['page_title']) ?>" placeholder="≤ 60 chars ideal"></div>
      <div class="adm-field"><label class="adm-label">Meta description <span class="adm-counter" id="cnt_desc"></span></label><textarea class="adm-textarea" id="f_page_description" rows="3" style="min-height:auto" placeholder="≤ 160 chars ideal"><?= htmlspecialchars($seo['page_description']) ?></textarea></div>
      <div class="adm-field"><label class="adm-label">Keywords</label><input class="adm-input" id="f_page_keywords" value="<?= htmlspecialchars($seo['page_keywords']) ?>" placeholder="comma, separated"></div>
      <ul class="adm-checklist" id="seoChecklist"></ul>
    </div>

    <div class="adm-card">
      <div class="adm-card-head"><h3>Featured image</h3></div>
      <div class="adm-drop" id="featuredDrop">
        <i class="fa-regular fa-image"></i>
        <div>Drop an image or click to upload<br><span class="adm-muted" style="font-size:.78rem">Converted to WebP automatically</span></div>
        <div class="adm-drop-preview" id="featuredPreview" <?= $featuredUrl ? '' : 'hidden' ?>><img id="featuredImg" src="<?= htmlspecialchars($featuredUrl) ?>" alt=""></div>
      </div>
      <input type="file" id="featuredFile" accept="image/*" hidden>
      <input type="hidden" id="f_image" value="<?= htmlspecialchars($reg['image']) ?>">
      <div class="adm-field adm-mt"><label class="adm-label">Image alt text</label><input class="adm-input" id="f_image_alt" value="<?= htmlspecialchars($reg['image_alt']) ?>"></div>
    </div>

    <div class="adm-card">
      <div class="adm-card-head"><h3>Details</h3></div>
      <div class="adm-row">
        <div class="adm-field"><label class="adm-label">Author</label><input class="adm-input" id="f_author" list="authorList" value="<?= htmlspecialchars($reg['author']) ?>" autocomplete="off"><datalist id="authorList"><?php foreach ($authors as $a): ?><option value="<?= htmlspecialchars($a) ?>"><?php endforeach; ?></datalist><div class="adm-hint" id="authorBio"></div></div>
        <div class="adm-field"><label class="adm-label">Date</label><input class="adm-input" type="date" id="f_date" value="<?= htmlspecialchars($reg['date']) ?>"></div>
      </div>
      <div class="adm-field">
        <label class="adm-label">Read time</label>
        <div class="adm-flex"><input class="adm-input" id="f_read" value="<?= htmlspecialchars($reg['read']) ?>" style="max-width:150px" <?= !empty($data['read_auto']) ? 'readonly' : '' ?>>
          <label class="adm-switch"><input type="checkbox" id="f_read_auto" <?= !empty($data['read_auto']) ? 'checked' : '' ?>><span class="adm-track"></span>Auto</label>
        </div>
      </div>
      <div class="adm-field"><label class="adm-label">Category suffix <span class="adm-hint">e.g. “ · Memoir” shown after the category chip</span></label><input class="adm-input" id="f_cat_suffix" value="<?= htmlspecialchars($data['cat_suffix']) ?>"></div>
    </div>

    <div class="adm-card">
      <div class="adm-card-head"><h3>Hero &amp; CTA</h3></div>
      <div class="adm-field"><label class="adm-label">Breadcrumb label</label><input class="adm-input" id="f_crumb" value="<?= htmlspecialchars($banner['crumb']) ?>" placeholder="What Is a Memoir?"></div>
      <div class="adm-field"><label class="adm-label">Hero title <span class="adm-hint">HTML allowed (use &lt;em class="serif-italic"&gt;…&lt;/em&gt;)</span></label><input class="adm-input" id="f_banner_title" value="<?= htmlspecialchars($banner['title']) ?>"></div>
      <div class="adm-field"><label class="adm-label">Hero subtitle</label><textarea class="adm-textarea" id="f_banner_sub" rows="2" style="min-height:auto"><?= htmlspecialchars($banner['sub']) ?></textarea></div>
      <div class="adm-row">
        <div class="adm-field"><label class="adm-label">CTA target</label><select class="adm-select" id="f_cta_href">
          <?php foreach ($linkTargets as $t): if ($t['group'] !== 'Pages') continue; ?><option value="<?= htmlspecialchars($t['value']) ?>" <?= ($data['cta_href'] === $t['value']) ? 'selected' : '' ?>><?= htmlspecialchars($t['label']) ?></option><?php endforeach; ?>
        </select></div>
        <div class="adm-field"><label class="adm-label">CTA label</label><input class="adm-input" id="f_cta_label" value="<?= htmlspecialchars($data['cta_label']) ?>"></div>
      </div>
    </div>

    <?php if (!$isNew): ?>
    <div class="adm-card">
      <div class="adm-card-head"><h3>Danger zone</h3></div>
      <?php if ($published): ?><button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" id="btnUnpublish" style="width:100%;justify-content:center;margin-bottom:.5rem"><i class="fa-solid fa-eye-slash"></i> Unpublish (move to trash)</button><?php endif; ?>
      <button type="button" class="adm-btn adm-btn-danger adm-btn-sm" id="btnDelete" style="width:100%;justify-content:center"><i class="fa-regular fa-trash-can"></i> Delete post</button>
    </div>
    <?php endif; ?>
  </div>
</div>
</form>

<?php
$bootData = [
    'slug' => $data['slug'], 'status' => $data['status'] ?? 'draft', 'published' => $published,
    'faqs' => $data['faqs'] ?? [], 'read_auto' => !empty($data['read_auto']),
];
$inline = 'window.ADM_POST=' . json_encode($bootData, JSON_UNESCAPED_SLASHES) . ';'
    . 'window.ADM_ASSET_BASE=' . json_encode($assetBase) . ';'
    . 'window.ADM_LINK_TARGETS=' . json_encode($linkTargets, JSON_UNESCAPED_SLASHES) . ';'
    . 'window.ADM_AUTHORS=' . json_encode($authorBios, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . ';'
    . 'if(window.AdmEditor)AdmEditor.init();';
admin_layout_foot($inline);
