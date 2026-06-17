<?php
require __DIR__ . '/includes/auth.php';
admin_require_admin();
require_once __DIR__ . '/includes/layout.php';

$modules = admin_modules();

function admin_super_count(): int {
    $n = 0;
    foreach (admin_get_users() as $u) { if (admin_role_is_super(admin_role($u['role'] ?? ''))) $n++; }
    return $n;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!admin_verify_csrf()) { admin_flash('err', 'Session expired.'); header('Location: users.php'); exit; }
    $action = $_POST['action'] ?? '';
    $me = admin_current_user()['username'] ?? '';

    /* ---------------- ROLES ---------------- */
    if ($action === 'role_save') {
        $orig = trim((string)($_POST['orig'] ?? ''));
        $label = trim((string)($_POST['label'] ?? ''));
        $name = $orig !== '' ? $orig : admin_slugify((string)($_POST['name'] ?? $label));
        $roles = admin_get_roles();
        $existing = admin_role($orig);
        if ($existing && !empty($existing['locked'])) { admin_flash('err', 'The super-admin role is locked.'); header('Location: users.php'); exit; }
        if ($label === '') { admin_flash('err', 'Role label is required.'); header('Location: users.php'); exit; }
        // Modules ONLY from checkboxes intersected with the real registry — never accept '*'.
        $mods = array_values(array_intersect((array)($_POST['modules'] ?? []), admin_module_keys()));
        $rec = ['name' => $name, 'label' => $label, 'modules' => $mods];
        $found = false;
        foreach ($roles as $i => $r) { if (($r['name'] ?? '') === $name) { if (!empty($r['locked'])) { admin_flash('err', 'Locked role.'); header('Location: users.php'); exit; } $roles[$i] = $rec; $found = true; break; } }
        if (!$found) $roles[] = $rec;
        admin_save_roles($roles);
        admin_flash('ok', 'Role saved.');
        header('Location: users.php'); exit;
    }
    if ($action === 'role_delete') {
        $name = trim((string)($_POST['name'] ?? ''));
        $r = admin_role($name);
        if (!$r || !empty($r['locked'])) { admin_flash('err', 'That role cannot be deleted.'); header('Location: users.php'); exit; }
        foreach (admin_get_users() as $u) { if (($u['role'] ?? '') === $name) { admin_flash('err', 'Reassign its users before deleting this role.'); header('Location: users.php'); exit; } }
        admin_save_roles(array_values(array_filter(admin_get_roles(), static fn($x) => ($x['name'] ?? '') !== $name)));
        admin_flash('ok', 'Role deleted.');
        header('Location: users.php'); exit;
    }

    /* ---------------- USERS ---------------- */
    if ($action === 'user_save') {
        $orig = trim((string)($_POST['orig'] ?? ''));
        $username = $orig !== '' ? $orig : admin_slugify((string)($_POST['username'] ?? ''));
        $name = trim((string)($_POST['name'] ?? '')) ?: $username;
        $role = (string)($_POST['role'] ?? '');
        $pw = (string)($_POST['password'] ?? '');
        if ($username === '') { admin_flash('err', 'Username required.'); header('Location: users.php'); exit; }
        if (!admin_role($role)) { admin_flash('err', 'Pick a valid role.'); header('Location: users.php'); exit; }
        $existing = admin_find_user($username);
        // Guard: don't demote the last super-admin.
        if ($existing && admin_role_is_super(admin_role($existing['role'] ?? '')) && !admin_role_is_super(admin_role($role)) && admin_super_count() <= 1) {
            admin_flash('err', 'You cannot demote the last super admin.'); header('Location: users.php'); exit;
        }
        if (!$existing) {
            if (strlen($pw) < 8) { admin_flash('err', 'New users need a password of at least 8 characters.'); header('Location: users.php'); exit; }
            $rec = admin_new_user_record($username, $name, $pw, $role);
        } else {
            $rec = $existing;
            $rec['name'] = $name;
            $rec['role'] = $role;
            if ($pw !== '') { if (strlen($pw) < 8) { admin_flash('err', 'Password too short.'); header('Location: users.php'); exit; } $rec['password'] = password_hash($pw, PASSWORD_BCRYPT); }
        }
        admin_upsert_user($rec);
        admin_flash('ok', 'User saved.');
        header('Location: users.php'); exit;
    }
    if ($action === 'user_delete') {
        $username = trim((string)($_POST['username'] ?? ''));
        if ($username === $me) { admin_flash('err', 'You cannot delete your own account.'); header('Location: users.php'); exit; }
        $u = admin_find_user($username);
        if ($u && admin_role_is_super(admin_role($u['role'] ?? '')) && admin_super_count() <= 1) { admin_flash('err', 'You cannot delete the last super admin.'); header('Location: users.php'); exit; }
        admin_save_users(array_values(array_filter(admin_get_users(), static fn($x) => strcasecmp($x['username'] ?? '', $username) !== 0)));
        admin_flash('ok', 'User deleted.');
        header('Location: users.php'); exit;
    }
    if ($action === 'user_resetpw') {
        $username = trim((string)($_POST['username'] ?? ''));
        $u = admin_find_user($username);
        if ($u) { $new = admin_random_password(); $u['password'] = password_hash($new, PASSWORD_BCRYPT); admin_upsert_user($u); admin_flash('ok', "New password for {$username}: {$new}  (copy it now)"); }
        header('Location: users.php'); exit;
    }
    if ($action === 'user_reset2fa') {
        $username = trim((string)($_POST['username'] ?? ''));
        $u = admin_find_user($username);
        if ($u) { $u['totp_enabled'] = false; $u['totp_secret'] = null; $u['backup_codes'] = []; admin_upsert_user($u); admin_flash('ok', "2FA reset for {$username}."); }
        header('Location: users.php'); exit;
    }
}

$roles = admin_get_roles();
$users = admin_get_users();
$roleUsers = [];
foreach ($users as $u) { $roleUsers[$u['role'] ?? ''] = ($roleUsers[$u['role'] ?? ''] ?? 0) + 1; }
admin_layout_head('Roles & Users');
?>
<div class="adm-page-head"><div><span class="adm-eyebrow">Access control</span><h1>Roles &amp; <span class="serif-italic">users</span></h1><p>Create roles from module permissions, then assign people to them.</p></div></div>

<div class="adm-card">
  <div class="adm-card-head"><h2>Roles</h2><button class="adm-btn adm-btn-sm adm-btn-cta" type="button" onclick="roleModal()"><i class="fa-solid fa-plus"></i> New role</button></div>
  <div class="adm-table-wrap"><table class="adm-table"><thead><tr><th>Role</th><th>Modules</th><th>Users</th><th style="text-align:right"></th></tr></thead><tbody>
  <?php foreach ($roles as $r): $locked = !empty($r['locked']); $mods = $r['modules'] ?? []; ?>
    <tr>
      <td><strong><?= htmlspecialchars($r['label'] ?? $r['name']) ?></strong> <?= $locked ? '<span class="adm-chip gold">locked</span>' : '' ?><br><span class="adm-mono adm-muted" style="font-size:.75rem"><?= htmlspecialchars($r['name']) ?></span></td>
      <td><?php if (in_array('*', $mods, true)): ?><span class="adm-chip green">All modules</span><?php else: foreach ($mods as $m): ?><span class="adm-tag"><?= htmlspecialchars($modules[$m]['label'] ?? $m) ?></span><?php endforeach; endif; ?></td>
      <td><?= (int)($roleUsers[$r['name']] ?? 0) ?></td>
      <td style="text-align:right;white-space:nowrap">
        <?php if (!$locked): ?>
          <button class="adm-btn adm-btn-sm adm-btn-ghost" type="button" onclick='roleModal(<?= htmlspecialchars(json_encode($r), ENT_QUOTES) ?>)'>Edit</button>
          <form method="post" style="display:inline" onsubmit="return confirm('Delete this role?')"><?= admin_csrf_field() ?><input type="hidden" name="action" value="role_delete"><input type="hidden" name="name" value="<?= htmlspecialchars($r['name']) ?>"><button class="adm-btn adm-btn-sm adm-btn-danger">Delete</button></form>
        <?php else: ?><span class="adm-muted" style="font-size:.8rem">—</span><?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody></table></div>
</div>

<div class="adm-card adm-mt">
  <div class="adm-card-head"><h2>Users</h2><button class="adm-btn adm-btn-sm adm-btn-cta" type="button" onclick="userModal()"><i class="fa-solid fa-plus"></i> New user</button></div>
  <div class="adm-table-wrap"><table class="adm-table"><thead><tr><th>User</th><th>Role</th><th>2FA</th><th style="text-align:right"></th></tr></thead><tbody>
  <?php foreach ($users as $u): $roleLabel = ''; foreach ($roles as $r) { if (($r['name'] ?? '') === ($u['role'] ?? '')) { $roleLabel = $r['label'] ?? $r['name']; break; } } ?>
    <tr>
      <td><strong><?= htmlspecialchars($u['name'] ?? $u['username']) ?></strong><br><span class="adm-mono adm-muted" style="font-size:.75rem"><?= htmlspecialchars($u['username']) ?></span></td>
      <td><?= $roleLabel ? htmlspecialchars($roleLabel) : '<span class="adm-chip red">no role</span>' ?></td>
      <td><?= !empty($u['totp_enabled']) ? '<span class="adm-chip green">on</span>' : '<span class="adm-chip grey">off</span>' ?></td>
      <td style="text-align:right;white-space:nowrap">
        <button class="adm-btn adm-btn-sm adm-btn-ghost" type="button" onclick='userModal(<?= htmlspecialchars(json_encode(['username'=>$u['username'],'name'=>$u['name']??'','role'=>$u['role']??'']), ENT_QUOTES) ?>)'>Edit</button>
        <form method="post" style="display:inline"><?= admin_csrf_field() ?><input type="hidden" name="action" value="user_resetpw"><input type="hidden" name="username" value="<?= htmlspecialchars($u['username']) ?>"><button class="adm-btn adm-btn-sm adm-btn-ghost" onclick="return confirm('Reset password for this user?')">Reset PW</button></form>
        <?php if (!empty($u['totp_enabled'])): ?><form method="post" style="display:inline"><?= admin_csrf_field() ?><input type="hidden" name="action" value="user_reset2fa"><input type="hidden" name="username" value="<?= htmlspecialchars($u['username']) ?>"><button class="adm-btn adm-btn-sm adm-btn-ghost" onclick="return confirm('Reset 2FA for this user?')">Reset 2FA</button></form><?php endif; ?>
        <form method="post" style="display:inline" onsubmit="return confirm('Delete this user?')"><?= admin_csrf_field() ?><input type="hidden" name="action" value="user_delete"><input type="hidden" name="username" value="<?= htmlspecialchars($u['username']) ?>"><button class="adm-btn adm-btn-sm adm-btn-danger">Delete</button></form>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody></table></div>
</div>

<!-- Role modal -->
<div class="adm-modal-overlay" id="roleOverlay"><div class="adm-modal"><form method="post"><?= admin_csrf_field() ?><input type="hidden" name="action" value="role_save"><input type="hidden" name="orig" id="r_orig">
  <div class="adm-flex-between"><h3 id="r_heading">New role</h3><button class="adm-btn adm-btn-icon adm-btn-ghost" type="button" data-close-role><i class="fa-solid fa-xmark"></i></button></div>
  <div class="adm-field"><label class="adm-label">Role name (label)</label><input class="adm-input" name="label" id="r_label" required></div>
  <div class="adm-field" id="r_name_field"><label class="adm-label">Key</label><input class="adm-input" name="name" id="r_name" placeholder="e.g. publisher"></div>
  <div class="adm-field"><label class="adm-label">Modules this role can access</label>
    <div class="adm-modgrid"><?php foreach ($modules as $k => $m): ?><label><input type="checkbox" name="modules[]" value="<?= $k ?>" class="r_mod"> <?= htmlspecialchars($m['label']) ?></label><?php endforeach; ?></div>
  </div>
  <div class="adm-modal-foot"><button class="adm-btn adm-btn-ghost" type="button" data-close-role>Cancel</button><button class="adm-btn adm-btn-cta" type="submit">Save role</button></div>
</form></div></div>

<!-- User modal -->
<div class="adm-modal-overlay" id="userOverlay"><div class="adm-modal"><form method="post"><?= admin_csrf_field() ?><input type="hidden" name="action" value="user_save"><input type="hidden" name="orig" id="u_orig">
  <div class="adm-flex-between"><h3 id="u_heading">New user</h3><button class="adm-btn adm-btn-icon adm-btn-ghost" type="button" data-close-user><i class="fa-solid fa-xmark"></i></button></div>
  <div class="adm-row"><div class="adm-field"><label class="adm-label">Name</label><input class="adm-input" name="name" id="u_name"></div>
  <div class="adm-field" id="u_username_field"><label class="adm-label">Username</label><input class="adm-input" name="username" id="u_username"></div></div>
  <div class="adm-field"><label class="adm-label">Role</label><select class="adm-select" name="role" id="u_role"><?php foreach ($roles as $r): ?><option value="<?= htmlspecialchars($r['name']) ?>"><?= htmlspecialchars($r['label'] ?? $r['name']) ?></option><?php endforeach; ?></select></div>
  <div class="adm-field"><label class="adm-label">Password <span class="adm-hint" id="u_pwhint">(leave blank to keep current)</span></label><input class="adm-input" type="text" name="password" id="u_password" autocomplete="new-password"></div>
  <div class="adm-modal-foot"><button class="adm-btn adm-btn-ghost" type="button" data-close-user>Cancel</button><button class="adm-btn adm-btn-cta" type="submit">Save user</button></div>
</form></div></div>

<?php
admin_layout_foot(<<<'JS'
function roleModal(r){
  var ov=document.getElementById('roleOverlay');
  document.getElementById('r_orig').value=r?r.name:'';
  document.getElementById('r_label').value=r?(r.label||''):'';
  document.getElementById('r_name').value=r?r.name:'';
  document.getElementById('r_heading').textContent=r?'Edit role':'New role';
  document.getElementById('r_name_field').style.display=r?'none':'';
  var mods=(r&&r.modules)||[];
  document.querySelectorAll('.r_mod').forEach(function(c){c.checked=mods.indexOf(c.value)>-1;});
  ov.classList.add('is-open');
}
function userModal(u){
  var ov=document.getElementById('userOverlay');
  document.getElementById('u_orig').value=u?u.username:'';
  document.getElementById('u_name').value=u?(u.name||''):'';
  document.getElementById('u_username').value=u?u.username:'';
  document.getElementById('u_username_field').style.display=u?'none':'';
  if(u)document.getElementById('u_role').value=u.role;
  document.getElementById('u_pwhint').textContent=u?'(leave blank to keep current)':'(required, min 8 chars)';
  document.getElementById('u_password').value='';
  ov.classList.add('is-open');
}
document.addEventListener('click',function(e){
  if(e.target.closest('[data-close-role]')||e.target.id==='roleOverlay')document.getElementById('roleOverlay').classList.remove('is-open');
  if(e.target.closest('[data-close-user]')||e.target.id==='userOverlay')document.getElementById('userOverlay').classList.remove('is-open');
});
JS);
