<?php
require __DIR__ . '/includes/auth.php';
admin_require_module('authors');
require_once __DIR__ . '/includes/content-store.php';
require_once __DIR__ . '/includes/layout.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!admin_verify_csrf()) { admin_flash('err', 'Session expired. Try again.'); header('Location: authors.php'); exit; }
    $names = $_POST['name'] ?? [];
    $bios  = $_POST['bio'] ?? [];
    $map = [];
    foreach ($names as $i => $n) {
        $n = trim((string)$n);
        if ($n === '') continue;
        $map[$n] = trim((string)($bios[$i] ?? ''));
    }
    $fallback = trim((string)($_POST['fallback'] ?? ''));
    [$ok, $msg] = admin_authors_write($map, $fallback);
    admin_flash($ok ? 'ok' : 'err', $ok ? 'Authors saved.' : $msg);
    header('Location: authors.php');
    exit;
}

$authors = admin_authors_read();
$counts  = admin_author_post_counts();
admin_layout_head('Authors');
?>
<div class="adm-page-head">
  <div><span class="adm-eyebrow">Bios</span><h1>Authors</h1><p>Drives the “About the Author” box on every blog post.</p></div>
</div>

<form method="post">
  <?= admin_csrf_field() ?>
  <div class="adm-card">
    <div class="adm-card-head"><h2>Author bios</h2><button type="button" class="adm-btn adm-btn-sm adm-btn-ghost" id="addAuthor"><i class="fa-solid fa-plus"></i> Add author</button></div>
    <div id="authorList">
      <?php if (!$authors['bios']): ?><p class="adm-muted" id="emptyNote">No authors yet. Add one to override the default bio.</p><?php endif; ?>
      <?php foreach ($authors['bios'] as $name => $bio): $c = $counts[$name] ?? 0; ?>
      <div class="adm-repeat-item">
        <div class="adm-repeat-head"><span class="adm-grip"><i class="fa-solid fa-user-pen"></i> Author <?= $c ? '<span class="adm-chip grey">' . (int)$c . ' post' . ($c === 1 ? '' : 's') . '</span>' : '' ?></span><button type="button" class="adm-btn adm-btn-icon adm-btn-ghost adm-rm" title="Remove"><i class="fa-solid fa-xmark"></i></button></div>
        <div class="adm-field"><label class="adm-label">Name</label><input class="adm-input" name="name[]" value="<?= htmlspecialchars($name) ?>"></div>
        <div class="adm-field" style="margin-bottom:0"><label class="adm-label">Bio</label><textarea class="adm-textarea" name="bio[]" rows="3"><?= htmlspecialchars($bio) ?></textarea></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="adm-card adm-mt">
    <div class="adm-card-head"><h3>Fallback bio</h3></div>
    <div class="adm-field" style="margin-bottom:0"><label class="adm-label">Used when a post&rsquo;s author has no specific bio</label><textarea class="adm-textarea" name="fallback" rows="3"><?= htmlspecialchars($authors['fallback']) ?></textarea></div>
  </div>

  <div class="adm-mt"><button class="adm-btn adm-btn-cta" type="submit"><i class="fa-regular fa-floppy-disk"></i> Save authors</button></div>
</form>

<template id="authorTpl">
  <div class="adm-repeat-item">
    <div class="adm-repeat-head"><span class="adm-grip"><i class="fa-solid fa-user-pen"></i> Author</span><button type="button" class="adm-btn adm-btn-icon adm-btn-ghost adm-rm" title="Remove"><i class="fa-solid fa-xmark"></i></button></div>
    <div class="adm-field"><label class="adm-label">Name</label><input class="adm-input" name="name[]" value=""></div>
    <div class="adm-field" style="margin-bottom:0"><label class="adm-label">Bio</label><textarea class="adm-textarea" name="bio[]" rows="3"></textarea></div>
  </div>
</template>

<?php
admin_layout_foot(<<<JS
(function(){
  var list=document.getElementById('authorList'),tpl=document.getElementById('authorTpl');
  document.getElementById('addAuthor').addEventListener('click',function(){
    var n=document.getElementById('emptyNote'); if(n)n.remove();
    var node=tpl.content.cloneNode(true).firstElementChild;
    list.insertBefore(node, list.firstChild);   // new row goes to the TOP
    var f=node.querySelector('input:not([type=file]):not([type=hidden]),textarea'); if(f)f.focus();
    node.scrollIntoView({behavior:'smooth',block:'center'});
  });
  list.addEventListener('click',function(e){var b=e.target.closest('.adm-rm');if(b)b.closest('.adm-repeat-item').remove();});
})();
JS);
