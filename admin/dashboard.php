<?php
require __DIR__ . '/includes/auth.php';
admin_require_module('dashboard');
require_once __DIR__ . '/includes/post-store.php';
require_once __DIR__ . '/includes/content-store.php';
require_once __DIR__ . '/includes/leads-db.php';
require_once __DIR__ . '/includes/layout.php';

$posts      = admin_list_posts();
$published  = array_filter($posts, static fn($p) => $p['status'] === 'published');
$drafts     = array_filter($posts, static fn($p) => $p['status'] !== 'published');
$leadCounts = admin_leads_counts();
$portfolio  = admin_portfolio_read();
$reviews    = admin_testimonials_read();
$authors    = admin_authors_read();
$latest     = array_slice($posts, 0, 5);
$freshLeads = admin_can('submissions') ? admin_leads_query(['limit' => 6]) : [];

admin_layout_head('Dashboard');
?>
<div class="adm-page-head">
  <div>
    <span class="adm-eyebrow">Overview</span>
    <h1>Good to see you<?= isset($_SESSION['admin_user']) ? ', ' . htmlspecialchars(explode(' ', (admin_current_user()['name'] ?? ''))[0] ?: '') : '' ?>.</h1>
    <p>A snapshot of everything you manage on <?= htmlspecialchars(BRAND_NAME) ?>.</p>
  </div>
  <a class="adm-btn adm-btn-cta" href="post-edit.php"><i class="fa-solid fa-plus"></i> New post</a>
</div>

<div class="adm-grid cols-4">
  <div class="adm-stat"><span class="adm-stat-ico"><i class="fa-solid fa-feather"></i></span><div><div class="adm-stat-num"><?= count($published) ?></div><div class="adm-stat-lbl">Published posts</div></div></div>
  <div class="adm-stat"><span class="adm-stat-ico gold"><i class="fa-regular fa-pen-to-square"></i></span><div><div class="adm-stat-num"><?= count($drafts) ?></div><div class="adm-stat-lbl">Drafts</div></div></div>
  <?php if (admin_can('submissions')): ?>
  <div class="adm-stat"><span class="adm-stat-ico leaf"><i class="fa-solid fa-inbox"></i></span><div><div class="adm-stat-num"><?= $leadCounts['available'] ? (int)$leadCounts['d7'] : '—' ?></div><div class="adm-stat-lbl">Leads · last 7 days</div></div></div>
  <div class="adm-stat"><span class="adm-stat-ico leaf"><i class="fa-solid fa-envelope-open-text"></i></span><div><div class="adm-stat-num"><?= $leadCounts['available'] ? (int)$leadCounts['d30'] : '—' ?></div><div class="adm-stat-lbl">Leads · last 30 days</div></div></div>
  <?php endif; ?>
  <?php if (admin_can('portfolio')): ?>
  <div class="adm-stat"><span class="adm-stat-ico"><i class="fa-solid fa-book-open"></i></span><div><div class="adm-stat-num"><?= count($portfolio) ?></div><div class="adm-stat-lbl">Portfolio books</div></div></div>
  <?php endif; ?>
  <?php if (admin_can('testimonials')): ?>
  <div class="adm-stat"><span class="adm-stat-ico gold"><i class="fa-solid fa-quote-right"></i></span><div><div class="adm-stat-num"><?= count($reviews) ?></div><div class="adm-stat-lbl">Testimonials</div></div></div>
  <?php endif; ?>
  <?php if (admin_can('authors')): ?>
  <div class="adm-stat"><span class="adm-stat-ico"><i class="fa-solid fa-user-pen"></i></span><div><div class="adm-stat-num"><?= count($authors['bios']) ?></div><div class="adm-stat-lbl">Authors</div></div></div>
  <?php endif; ?>
</div>

<div class="adm-grid cols-2 adm-mt2">
  <div class="adm-card">
    <div class="adm-card-head"><h2>Latest posts</h2><a class="adm-btn adm-btn-sm adm-btn-ghost" href="posts.php">All posts</a></div>
    <?php if (!$latest): ?>
      <div class="adm-empty"><i class="fa-regular fa-newspaper"></i>No posts yet. <a href="post-edit.php">Write your first one</a>.</div>
    <?php else: ?>
      <div class="adm-table-wrap">
        <table class="adm-table">
          <tbody>
          <?php foreach ($latest as $p): ?>
            <tr>
              <td style="width:70px"><?php if ($p['image']): ?><img class="adm-thumb" src="<?= htmlspecialchars($p['image']) ?>" alt="" loading="lazy"><?php endif; ?></td>
              <td>
                <strong><?= htmlspecialchars($p['title']) ?></strong><br>
                <span class="adm-muted" style="font-size:.8rem"><?= htmlspecialchars($p['category']) ?> · <?= htmlspecialchars($p['date']) ?></span>
              </td>
              <td><span class="adm-chip <?= $p['status'] === 'published' ? 'green' : 'amber' ?>"><?= htmlspecialchars(ucfirst($p['status'])) ?></span></td>
              <td style="text-align:right"><a class="adm-btn adm-btn-sm adm-btn-ghost" href="post-edit.php?slug=<?= urlencode($p['slug']) ?>">Edit</a></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>

  <?php if (admin_can('submissions')): ?>
  <div class="adm-card">
    <div class="adm-card-head"><h2>Fresh submissions</h2><a class="adm-btn adm-btn-sm adm-btn-ghost" href="submissions.php">Inbox</a></div>
    <?php if (!$leadCounts['available']): ?>
      <div class="adm-alert info"><i class="fa-solid fa-circle-info"></i><span>The leads database isn&rsquo;t reachable from here. On the live server the inbox works normally.</span></div>
    <?php elseif (!$freshLeads): ?>
      <div class="adm-empty"><i class="fa-regular fa-envelope"></i>No submissions yet.</div>
    <?php else: ?>
      <div class="adm-table-wrap">
        <table class="adm-table">
          <tbody>
          <?php foreach ($freshLeads as $l): ?>
            <tr class="<?= admin_lead_is_read((int)$l['id']) ? '' : 'adm-lead-unread' ?>">
              <td><strong><?= htmlspecialchars($l['name'] ?: '—') ?></strong><br><span class="adm-muted" style="font-size:.8rem"><?= htmlspecialchars($l['email'] ?? '') ?></span></td>
              <td><span class="adm-chip grey"><?= htmlspecialchars(admin_lead_label($l['form_type'] ?? '')) ?></span></td>
              <td style="text-align:right;font-size:.78rem" class="adm-muted"><?= htmlspecialchars(substr((string)($l['created_at'] ?? ''), 0, 16)) ?></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>
  <?php endif; ?>
</div>
<?php
admin_layout_foot();
