<?php
require __DIR__ . '/includes/auth.php';
admin_require_module('testimonials');
require_once __DIR__ . '/includes/content-store.php';
require_once __DIR__ . '/includes/layout.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!admin_verify_csrf()) { admin_flash('err', 'Session expired. Try again.'); header('Location: testimonials.php'); exit; }
    $names = $_POST['name'] ?? []; $roles = $_POST['role'] ?? [];
    $ratings = $_POST['rating'] ?? []; $texts = $_POST['text'] ?? [];
    $reviews = [];
    foreach ($names as $i => $n) {
        $n = trim((string)$n); $t = trim((string)($texts[$i] ?? ''));
        if ($n === '' && $t === '') continue;
        $reviews[] = ['name' => $n, 'role' => trim((string)($roles[$i] ?? '')), 'rating' => (int)($ratings[$i] ?? 5), 'text' => $t];
    }
    [$ok, $msg] = admin_testimonials_write($reviews);
    admin_flash($ok ? 'ok' : 'err', $ok ? 'Testimonials saved.' : $msg);
    header('Location: testimonials.php');
    exit;
}

$reviews = admin_testimonials_read();
admin_layout_head('Testimonials');
?>
<div class="adm-page-head">
  <div><span class="adm-eyebrow">Social proof</span><h1>Testimonials</h1><p>One source of truth, shown on the home marquee and the Testimonials page.</p></div>
</div>

<form method="post">
  <?= admin_csrf_field() ?>
  <div class="adm-card">
    <div class="adm-card-head"><h2>Reviews <span class="adm-muted" style="font-size:.85rem">(drag to reorder)</span></h2><button type="button" class="adm-btn adm-btn-sm adm-btn-ghost" id="addRev"><i class="fa-solid fa-plus"></i> Add review</button></div>
    <div id="revList">
      <?php foreach ($reviews as $r): ?>
      <div class="adm-repeat-item" draggable="true">
        <div class="adm-repeat-head"><span class="adm-handle" title="Drag to reorder"><i class="fa-solid fa-grip-vertical"></i></span><button type="button" class="adm-btn adm-btn-icon adm-btn-ghost adm-rm" title="Remove"><i class="fa-solid fa-xmark"></i></button></div>
        <div class="adm-row">
          <div class="adm-field"><label class="adm-label">Name</label><input class="adm-input" name="name[]" value="<?= htmlspecialchars($r['name']) ?>"></div>
          <div class="adm-field"><label class="adm-label">Role</label><input class="adm-input" name="role[]" value="<?= htmlspecialchars($r['role']) ?>"></div>
          <div class="adm-field" style="max-width:120px;flex:0 0 120px"><label class="adm-label">Rating</label>
            <select class="adm-select" name="rating[]"><?php for ($s = 5; $s >= 1; $s--): ?><option value="<?= $s ?>" <?= (int)$r['rating'] === $s ? 'selected' : '' ?>><?= $s ?> ★</option><?php endfor; ?></select></div>
        </div>
        <div class="adm-field" style="margin-bottom:0"><label class="adm-label">Quote</label><textarea class="adm-textarea" name="text[]" rows="2" style="min-height:auto"><?= htmlspecialchars($r['text']) ?></textarea></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="adm-mt"><button class="adm-btn adm-btn-cta" type="submit"><i class="fa-regular fa-floppy-disk"></i> Save testimonials</button></div>
</form>

<template id="revTpl">
  <div class="adm-repeat-item" draggable="true">
    <div class="adm-repeat-head"><span class="adm-handle" title="Drag to reorder"><i class="fa-solid fa-grip-vertical"></i></span><button type="button" class="adm-btn adm-btn-icon adm-btn-ghost adm-rm" title="Remove"><i class="fa-solid fa-xmark"></i></button></div>
    <div class="adm-row">
      <div class="adm-field"><label class="adm-label">Name</label><input class="adm-input" name="name[]"></div>
      <div class="adm-field"><label class="adm-label">Role</label><input class="adm-input" name="role[]"></div>
      <div class="adm-field" style="max-width:120px;flex:0 0 120px"><label class="adm-label">Rating</label><select class="adm-select" name="rating[]"><option value="5">5 ★</option><option value="4">4 ★</option><option value="3">3 ★</option><option value="2">2 ★</option><option value="1">1 ★</option></select></div>
    </div>
    <div class="adm-field" style="margin-bottom:0"><label class="adm-label">Quote</label><textarea class="adm-textarea" name="text[]" rows="2" style="min-height:auto"></textarea></div>
  </div>
</template>

<?php
admin_layout_foot(<<<JS
(function(){
  var list=document.getElementById('revList'),tpl=document.getElementById('revTpl');
  document.getElementById('addRev').addEventListener('click',function(){
    var node=tpl.content.cloneNode(true).firstElementChild;
    list.insertBefore(node, list.firstChild);   // new review goes to the TOP
    var f=node.querySelector('input:not([type=file]):not([type=hidden]),textarea'); if(f)f.focus();
    node.scrollIntoView({behavior:'smooth',block:'center'});
  });
  list.addEventListener('click',function(e){var b=e.target.closest('.adm-rm');if(b)b.closest('.adm-repeat-item').remove();});
  if(window.AdmDrag)AdmDrag(list,'.adm-repeat-item','.adm-handle');
})();
JS);
