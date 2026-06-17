<?php
require __DIR__ . '/includes/auth.php';
admin_require_module('posts');
require_once __DIR__ . '/includes/post-store.php';
require_once __DIR__ . '/includes/layout.php';

$posts = admin_list_posts();
$cats = [];
foreach ($posts as $p) { if ($p['category'] !== '') $cats[$p['category']] = true; }
$cats = array_keys($cats);
sort($cats);

admin_layout_head('Blog Posts');
?>
<div class="adm-page-head">
  <div>
    <span class="adm-eyebrow">Journal</span>
    <h1>Blog <span class="serif-italic">posts</span></h1>
    <p>Write, edit and publish SEO-safe articles. Imported posts stay byte-identical until you change them.</p>
  </div>
  <a class="adm-btn adm-btn-cta" href="post-edit.php"><i class="fa-solid fa-plus"></i> New post</a>
</div>

<div class="adm-card">
  <div class="adm-toolbar-actions adm-mb">
    <div class="adm-search"><i class="fa-solid fa-magnifying-glass"></i><input class="adm-input" id="postSearch" type="search" placeholder="Search posts by title…" autocomplete="off"></div>
    <select class="adm-select" id="postCat" style="max-width:200px">
      <option value="">All categories</option>
      <?php foreach ($cats as $c): ?><option value="<?= htmlspecialchars(strtolower($c)) ?>"><?= htmlspecialchars($c) ?></option><?php endforeach; ?>
    </select>
    <select class="adm-select" id="postStatus" style="max-width:170px">
      <option value="">All statuses</option>
      <option value="published">Published</option>
      <option value="draft">Draft</option>
    </select>
  </div>

  <div class="adm-table-wrap">
    <table class="adm-table" id="postsTable">
      <thead><tr><th></th><th>Title</th><th>Category</th><th>Date</th><th>Status</th><th style="text-align:right">Actions</th></tr></thead>
      <tbody>
      <?php if (!$posts): ?>
        <tr><td colspan="6"><div class="adm-empty"><i class="fa-regular fa-newspaper"></i>No posts yet. <a href="post-edit.php">Write your first one</a>.</div></td></tr>
      <?php else: foreach ($posts as $p): ?>
        <tr data-title="<?= htmlspecialchars(strtolower($p['title'])) ?>" data-cat="<?= htmlspecialchars(strtolower($p['category'])) ?>" data-status="<?= htmlspecialchars($p['status']) ?>">
          <td style="width:64px"><?php if ($p['image']): ?><img class="adm-thumb" src="<?= htmlspecialchars($p['image']) ?>" alt="" loading="lazy"><?php endif; ?></td>
          <td><strong><?= htmlspecialchars($p['title']) ?></strong><br><span class="adm-muted adm-mono" style="font-size:.75rem">/blogs/<?= htmlspecialchars($p['slug']) ?>/</span></td>
          <td><?= htmlspecialchars($p['category']) ?></td>
          <td class="adm-muted" style="font-size:.85rem"><?= htmlspecialchars($p['date']) ?></td>
          <td><span class="adm-chip <?= $p['status'] === 'published' ? 'green' : 'amber' ?>"><?= htmlspecialchars(ucfirst($p['status'])) ?></span><?php if ($p['status'] === 'published' && !$p['has_source']): ?> <span class="adm-chip grey" title="Hand-built — import to edit">legacy</span><?php endif; ?></td>
          <td style="text-align:right;white-space:nowrap">
            <a class="adm-btn adm-btn-sm adm-btn-ghost" href="post-edit.php?slug=<?= urlencode($p['slug']) ?>"><i class="fa-solid fa-pen"></i> Edit</a>
            <?php if ($p['status'] === 'published'): ?>
              <a class="adm-btn adm-btn-sm adm-btn-ghost" href="<?= htmlspecialchars(link_to('blogs/' . $p['slug'] . '.php')) ?>" target="_blank" rel="noopener" title="View"><i class="fa-solid fa-up-right-from-square"></i></a>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php
admin_layout_foot(<<<JS
(function(){
  var q=document.getElementById('postSearch'),c=document.getElementById('postCat'),s=document.getElementById('postStatus');
  var rows=[].slice.call(document.querySelectorAll('#postsTable tbody tr[data-title]'));
  function apply(){
    var qt=(q.value||'').toLowerCase(),ct=c.value,st=s.value;
    rows.forEach(function(r){
      var ok=(!qt||r.dataset.title.indexOf(qt)>-1)&&(!ct||r.dataset.cat===ct)&&(!st||r.dataset.status===st);
      r.style.display=ok?'':'none';
    });
  }
  [q,c,s].forEach(function(el){el&&el.addEventListener('input',apply);el&&el.addEventListener('change',apply);});
})();
JS);
