<?php
require __DIR__ . '/includes/auth.php';
admin_require_module('submissions');
require_once __DIR__ . '/includes/leads-db.php';

/* ---------- AJAX: read / star ---------- */
if (($_GET['ajax'] ?? '') === '1') {
    header('Content-Type: application/json');
    admin_send_security_headers();
    if (!admin_verify_csrf()) { echo json_encode(['ok' => false, 'error' => 'CSRF']); exit; }
    $id = (int)($_POST['id'] ?? 0);
    $act = $_POST['act'] ?? '';
    if ($act === 'read') { admin_lead_mark_read($id, true); echo json_encode(['ok' => true]); exit; }
    if ($act === 'star') { $on = admin_lead_toggle_star($id); echo json_encode(['ok' => true, 'star' => $on]); exit; }
    echo json_encode(['ok' => false]); exit;
}

$q  = trim((string)($_GET['q'] ?? ''));
$ft = trim((string)($_GET['ft'] ?? ''));
$available = admin_leads_available() && admin_leads_table_exists();
$rows = $available ? admin_leads_query(['search' => $q, 'form_type' => $ft, 'limit' => 500]) : [];

/* ---------- CSV export ---------- */
if (($_GET['export'] ?? '') === 'csv' && $available) {
    $csv = admin_leads_csv($rows);
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="leads-' . date('Ymd-His') . '.csv"');
    echo $csv;
    exit;
}

$types = $available ? admin_leads_form_types() : [];
require_once __DIR__ . '/includes/layout.php';
admin_layout_head('Submissions');
?>
<div class="adm-page-head">
  <div><span class="adm-eyebrow">Inbox</span><h1>Form <span class="serif-italic">submissions</span></h1><p>Read-only view of your <span class="adm-mono">leads</span> table.</p></div>
  <?php if ($available): ?><a class="adm-btn adm-btn-ghost" href="?export=csv&amp;q=<?= urlencode($q) ?>&amp;ft=<?= urlencode($ft) ?>"><i class="fa-solid fa-file-csv"></i> Export CSV</a><?php endif; ?>
</div>

<?php if (!$available): ?>
  <div class="adm-card"><div class="adm-alert info" style="margin:0"><i class="fa-solid fa-circle-info"></i><span>The <span class="adm-mono">leads</span> database isn&rsquo;t reachable from here (this is normal on localhost — the site key & DB are configured for the live host). On the live server this inbox works automatically.</span></div></div>
<?php else: ?>
<div class="adm-card">
  <form method="get" class="adm-toolbar-actions adm-mb">
    <div class="adm-search"><i class="fa-solid fa-magnifying-glass"></i><input class="adm-input" name="q" value="<?= htmlspecialchars($q) ?>" placeholder="Search name, email, phone, message…"></div>
    <select class="adm-select" name="ft" style="max-width:220px" onchange="this.form.submit()">
      <option value="">All forms</option>
      <?php foreach ($types as $t => $c): ?><option value="<?= htmlspecialchars($t) ?>" <?= $ft === $t ? 'selected' : '' ?>><?= htmlspecialchars(admin_lead_label($t)) ?> (<?= (int)$c ?>)</option><?php endforeach; ?>
    </select>
    <button class="adm-btn adm-btn-ghost" type="submit">Filter</button>
    <?php if ($q !== '' || $ft !== ''): ?><a class="adm-btn adm-btn-ghost" href="submissions.php">Clear</a><?php endif; ?>
    <span class="adm-right adm-muted" style="font-size:.85rem"><?= count($rows) ?> result<?= count($rows) === 1 ? '' : 's' ?></span>
  </form>

  <div class="adm-table-wrap">
    <table class="adm-table">
      <thead><tr><th style="width:36px"></th><th>Name</th><th>Form</th><th>Email / phone</th><th>Received</th><th style="text-align:right"></th></tr></thead>
      <tbody>
      <?php if (!$rows): ?>
        <tr><td colspan="6"><div class="adm-empty"><i class="fa-regular fa-envelope-open"></i>No submissions match.</div></td></tr>
      <?php else: foreach ($rows as $l): $id = (int)$l['id']; ?>
        <tr class="<?= admin_lead_is_read($id) ? '' : 'adm-lead-unread' ?>" id="lead<?= $id ?>">
          <td><button class="adm-star <?= admin_lead_is_starred($id) ? 'is-on' : '' ?>" data-star="<?= $id ?>" title="Star"><i class="fa-solid fa-star"></i></button></td>
          <td><strong><?= htmlspecialchars($l['name'] ?: '—') ?></strong><?php if (!empty($l['book_title'])): ?><br><span class="adm-muted" style="font-size:.78rem"><?= htmlspecialchars($l['book_title']) ?></span><?php endif; ?></td>
          <td><span class="adm-chip grey"><?= htmlspecialchars(admin_lead_label($l['form_type'] ?? '')) ?></span></td>
          <td style="font-size:.85rem"><?= htmlspecialchars($l['email'] ?? '') ?><?php if (!empty($l['phone'])): ?><br><span class="adm-muted"><?= htmlspecialchars($l['phone']) ?></span><?php endif; ?></td>
          <td class="adm-muted" style="font-size:.82rem"><?= htmlspecialchars(substr((string)($l['created_at'] ?? ''), 0, 16)) ?></td>
          <td style="text-align:right"><button class="adm-btn adm-btn-sm adm-btn-ghost" data-view='<?= htmlspecialchars(json_encode($l, JSON_UNESCAPED_UNICODE | JSON_HEX_APOS | JSON_HEX_QUOT), ENT_QUOTES) ?>'>View</button></td>
        </tr>
      <?php endforeach; endif; ?>
      </tbody>
    </table>
  </div>
</div>

<div class="adm-modal-overlay" id="leadModal"><div class="adm-modal"><div class="adm-flex-between"><h3 id="lmTitle">Submission</h3><button class="adm-btn adm-btn-icon adm-btn-ghost" data-close><i class="fa-solid fa-xmark"></i></button></div><dl class="adm-detail-grid" id="lmBody"></dl></div></div>
<?php endif; ?>

<?php
admin_layout_foot(<<<'JS'
(function(){
  var labels={form_type:'Form',name:'Name',email:'Email',phone:'Phone',country:'Country',book_title:'Book title',genre:'Genre',service:'Service',source:'Source',message:'Message',manuscript_file:'Manuscript',page_url:'Page',ip_address:'IP',user_agent:'User agent',created_at:'Received'};
  function esc(s){var d=document.createElement('div');d.textContent=(s==null?'':String(s));return d.innerHTML;}
  var modal=document.getElementById('leadModal');
  function post(act,id){return fetch('submissions.php?ajax=1',{method:'POST',headers:{'Content-Type':'application/x-www-form-urlencoded','X-CSRF-Token':window.ADM_CSRF},body:'act='+act+'&id='+id+'&csrf='+encodeURIComponent(window.ADM_CSRF)});}
  document.addEventListener('click',function(e){
    var v=e.target.closest('[data-view]');
    if(v){
      var d=JSON.parse(v.getAttribute('data-view'));
      var body=document.getElementById('lmBody');body.innerHTML='';
      Object.keys(labels).forEach(function(k){ if(d[k]!==undefined&&d[k]!==null&&d[k]!==''){ body.innerHTML+='<dt>'+labels[k]+'</dt><dd>'+esc(d[k])+'</dd>'; }});
      document.getElementById('lmTitle').textContent=d.name||'Submission';
      modal.classList.add('is-open');
      var row=document.getElementById('lead'+d.id); if(row){row.classList.remove('adm-lead-unread');} post('read',d.id);
      return;
    }
    if(e.target.closest('[data-close]')||e.target===modal){modal&&modal.classList.remove('is-open');}
    var st=e.target.closest('[data-star]');
    if(st){var id=st.getAttribute('data-star');post('star',id).then(function(r){return r.json();}).then(function(j){if(j&&j.ok)st.classList.toggle('is-on',j.star);});}
  });
})();
JS);
