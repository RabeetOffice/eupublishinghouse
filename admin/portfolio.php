<?php
require __DIR__ . '/includes/auth.php';
admin_require_module('portfolio');
require_once __DIR__ . '/includes/content-store.php';
require_once __DIR__ . '/includes/layout.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!admin_verify_csrf()) { admin_flash('err', 'Session expired. Try again.'); header('Location: portfolio.php'); exit; }
    $cat = $_POST['category'] ?? []; $auth = $_POST['author'] ?? [];
    $title = $_POST['title'] ?? []; $link = $_POST['amazon_link'] ?? [];
    $coverEx = $_POST['cover_existing'] ?? []; $clear = $_POST['clear_cover'] ?? [];
    $items = [];
    foreach ($title as $i => $t) {
        $t = trim((string)$t);
        $a_link = trim((string)($link[$i] ?? ''));
        if ($t === '' && $a_link === '') continue;
        $cover = trim((string)($coverEx[$i] ?? ''));
        if (isset($clear[$i]) && $clear[$i] === '1') $cover = '';
        // Only ever accept a safe in-assets relative path (no traversal / scheme).
        if ($cover !== '' && (strpos($cover, '..') !== false || !preg_match('#^images/[A-Za-z0-9._/-]+$#', $cover))) $cover = '';
        // New uploaded cover for this row?
        if (!empty($_FILES['cover']['name'][$i]) && (int)($_FILES['cover']['error'][$i] ?? 4) === UPLOAD_ERR_OK) {
            $file = [
                'name' => $_FILES['cover']['name'][$i], 'type' => $_FILES['cover']['type'][$i],
                'tmp_name' => $_FILES['cover']['tmp_name'][$i], 'error' => $_FILES['cover']['error'][$i],
                'size' => $_FILES['cover']['size'][$i],
            ];
            [$ok, $res] = admin_upload_image_webp($file, 'assets/images/portfolio', $t ?: 'cover');
            if ($ok) $cover = preg_replace('#^assets/#', '', $res);   // store as asset() arg
            else { admin_flash('err', 'Cover upload failed: ' . $res); header('Location: portfolio.php'); exit; }
        }
        $item = ['category' => trim((string)($cat[$i] ?? '')), 'author' => trim((string)($auth[$i] ?? '')), 'title' => $t, 'amazon_link' => $a_link];
        if ($cover !== '') $item['cover'] = $cover;
        $items[] = $item;
    }
    [$ok, $msg] = admin_portfolio_write($items);
    admin_flash($ok ? 'ok' : 'err', $ok ? 'Portfolio saved.' : $msg);
    header('Location: portfolio.php');
    exit;
}

$items = admin_portfolio_read();
admin_layout_head('Portfolio');
?>
<div class="adm-page-head">
  <div><span class="adm-eyebrow">Published work</span><h1>Portfolio</h1><p>Each book shows its uploaded cover if you add one, otherwise the Amazon cover from the link.</p></div>
</div>

<form method="post" enctype="multipart/form-data">
  <?= admin_csrf_field() ?>
  <div class="adm-card">
    <div class="adm-card-head"><h2>Books <span class="adm-muted" style="font-size:.85rem">(drag to reorder)</span></h2><button type="button" class="adm-btn adm-btn-sm adm-btn-ghost" id="addBook"><i class="fa-solid fa-plus"></i> Add book</button></div>
    <div id="bookList">
      <?php foreach ($items as $it): $cover = admin_portfolio_cover($it); ?>
      <div class="adm-repeat-item" draggable="true">
        <div class="adm-repeat-head"><span class="adm-handle" title="Drag to reorder"><i class="fa-solid fa-grip-vertical"></i></span><button type="button" class="adm-btn adm-btn-icon adm-btn-ghost adm-rm" title="Remove"><i class="fa-solid fa-xmark"></i></button></div>
        <div class="adm-flex" style="align-items:flex-start;gap:1rem">
          <div style="flex:0 0 92px;text-align:center">
            <img class="adm-thumb book" style="width:80px;height:118px" src="<?= htmlspecialchars($cover) ?>" alt="" loading="lazy" onerror="this.style.opacity=.25">
            <label class="adm-btn adm-btn-sm adm-btn-ghost" style="margin-top:.4rem;cursor:pointer"><i class="fa-solid fa-upload"></i> Cover<input type="file" name="cover[]" accept="image/*" hidden></label>
            <?php if (!empty($it['cover'])): ?><label class="adm-check" style="font-size:.74rem;margin-top:.3rem"><input type="checkbox" name="clear_cover[<?= count($items) ?>]" value="1" class="clearCover">Use Amazon</label><?php endif; ?>
          </div>
          <div style="flex:1">
            <input type="hidden" name="cover_existing[]" value="<?= htmlspecialchars($it['cover'] ?? '') ?>">
            <div class="adm-row">
              <div class="adm-field"><label class="adm-label">Title</label><input class="adm-input" name="title[]" value="<?= htmlspecialchars($it['title']) ?>"></div>
              <div class="adm-field"><label class="adm-label">Author</label><input class="adm-input" name="author[]" value="<?= htmlspecialchars($it['author']) ?>"></div>
              <div class="adm-field" style="max-width:170px;flex:0 0 170px"><label class="adm-label">Category</label><input class="adm-input" name="category[]" value="<?= htmlspecialchars($it['category']) ?>"></div>
            </div>
            <div class="adm-field" style="margin-bottom:0"><label class="adm-label">Amazon link</label><input class="adm-input" name="amazon_link[]" value="<?= htmlspecialchars($it['amazon_link']) ?>" placeholder="https://www.amazon.com/.../dp/ASIN"></div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="adm-mt"><button class="adm-btn adm-btn-cta" type="submit"><i class="fa-regular fa-floppy-disk"></i> Save portfolio</button></div>
</form>

<template id="bookTpl">
  <div class="adm-repeat-item" draggable="true">
    <div class="adm-repeat-head"><span class="adm-handle" title="Drag to reorder"><i class="fa-solid fa-grip-vertical"></i></span><button type="button" class="adm-btn adm-btn-icon adm-btn-ghost adm-rm" title="Remove"><i class="fa-solid fa-xmark"></i></button></div>
    <div class="adm-flex" style="align-items:flex-start;gap:1rem">
      <div style="flex:0 0 92px;text-align:center">
        <img class="adm-thumb book" style="width:80px;height:118px;opacity:.25" src="" alt="">
        <label class="adm-btn adm-btn-sm adm-btn-ghost" style="margin-top:.4rem;cursor:pointer"><i class="fa-solid fa-upload"></i> Cover<input type="file" name="cover[]" accept="image/*" hidden></label>
      </div>
      <div style="flex:1">
        <input type="hidden" name="cover_existing[]" value="">
        <div class="adm-row">
          <div class="adm-field"><label class="adm-label">Title</label><input class="adm-input" name="title[]"></div>
          <div class="adm-field"><label class="adm-label">Author</label><input class="adm-input" name="author[]"></div>
          <div class="adm-field" style="max-width:170px;flex:0 0 170px"><label class="adm-label">Category</label><input class="adm-input" name="category[]"></div>
        </div>
        <div class="adm-field" style="margin-bottom:0"><label class="adm-label">Amazon link</label><input class="adm-input" name="amazon_link[]" placeholder="https://www.amazon.com/.../dp/ASIN"></div>
      </div>
    </div>
  </div>
</template>

<?php
admin_layout_foot(<<<JS
(function(){
  var list=document.getElementById('bookList'),tpl=document.getElementById('bookTpl');
  document.getElementById('addBook').addEventListener('click',function(){
    var node=tpl.content.cloneNode(true).firstElementChild;
    list.insertBefore(node, list.firstChild);   // new book goes to the TOP
    var f=node.querySelector('input:not([type=file]):not([type=hidden]),textarea'); if(f)f.focus();
    node.scrollIntoView({behavior:'smooth',block:'center'});
  });
  list.addEventListener('click',function(e){var b=e.target.closest('.adm-rm');if(b)b.closest('.adm-repeat-item').remove();});
  list.addEventListener('change',function(e){
    var f=e.target.closest('input[type=file]');
    if(f&&f.files&&f.files[0]){var img=f.closest('.adm-repeat-item').querySelector('img');var r=new FileReader();r.onload=function(){img.src=r.result;img.style.opacity=1;};r.readAsDataURL(f.files[0]);}
  });
  if(window.AdmDrag)AdmDrag(list,'.adm-repeat-item','.adm-handle');
})();
JS);
