<?php
/**
 * EU Publishing House — read-only reader for the brand's `leads` table.
 * Columns mirror form-submission.php exactly:
 *   id, form_type, name, email, phone, country, book_title, genre, service,
 *   source, message, manuscript_file, page_url, ip_address, user_agent, created_at
 * The admin never writes to `leads`; read/star flags live in admin/data/leads-state.json.
 * Degrades gracefully when the DB is unreachable (e.g. on localhost).
 */

require_once __DIR__ . '/helpers.php';

define('ADMIN_LEADS_STATE', ADMIN_DATA . '/leads-state.json');

function admin_leads_columns(): array {
    return ['id','form_type','name','email','phone','country','book_title','genre',
            'service','source','message','manuscript_file','page_url','ip_address','user_agent','created_at'];
}

/** @return PDO|null */
function admin_leads_pdo() {
    static $pdo = false;
    if ($pdo !== false) return $pdo;
    global $DB;
    $db = $DB ?? ($GLOBALS['DB'] ?? null);
    if (!is_array($db) || empty($db['host']) || empty($db['name'])) { $pdo = null; return $pdo; }
    try {
        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', $db['host'], $db['name'], $db['charset'] ?? 'utf8mb4');
        $pdo = new PDO($dsn, $db['user'] ?? '', $db['pass'] ?? '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_TIMEOUT => 4,
        ]);
    } catch (Throwable $e) {
        error_log('[leads-db] ' . $e->getMessage());
        $pdo = null;
    }
    return $pdo;
}

function admin_leads_available(): bool { return admin_leads_pdo() instanceof PDO; }

function admin_leads_table_exists(): bool {
    $pdo = admin_leads_pdo();
    if (!$pdo) return false;
    try {
        $stmt = $pdo->query("SHOW TABLES LIKE 'leads'");
        return $stmt && $stmt->fetch() !== false;
    } catch (Throwable $e) { return false; }
}

/**
 * Query leads newest-first with optional search + form-type filter.
 * @param array $opts ['search'=>'', 'form_type'=>'', 'limit'=>200, 'offset'=>0]
 */
function admin_leads_query(array $opts = []): array {
    $pdo = admin_leads_pdo();
    if (!$pdo || !admin_leads_table_exists()) return [];
    $where = [];
    $params = [];
    $search = trim((string)($opts['search'] ?? ''));
    if ($search !== '') {
        $where[] = '(name LIKE :q OR email LIKE :q OR phone LIKE :q OR book_title LIKE :q OR message LIKE :q OR service LIKE :q)';
        $params[':q'] = '%' . $search . '%';
    }
    $ft = trim((string)($opts['form_type'] ?? ''));
    if ($ft !== '') { $where[] = 'form_type = :ft'; $params[':ft'] = $ft; }
    $sql = 'SELECT * FROM leads';
    if ($where) $sql .= ' WHERE ' . implode(' AND ', $where);
    $sql .= ' ORDER BY created_at DESC, id DESC';
    $limit = max(1, min(2000, (int)($opts['limit'] ?? 300)));
    $offset = max(0, (int)($opts['offset'] ?? 0));
    $sql .= " LIMIT {$limit} OFFSET {$offset}";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    } catch (Throwable $e) { error_log('[leads-db] ' . $e->getMessage()); return []; }
}

function admin_leads_get(int $id): ?array {
    $pdo = admin_leads_pdo();
    if (!$pdo) return null;
    try {
        $stmt = $pdo->prepare('SELECT * FROM leads WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    } catch (Throwable $e) { return null; }
}

/** Distinct form_type values present (for the filter chips). */
function admin_leads_form_types(): array {
    $pdo = admin_leads_pdo();
    if (!$pdo || !admin_leads_table_exists()) return [];
    try {
        $stmt = $pdo->query('SELECT form_type, COUNT(*) c FROM leads GROUP BY form_type ORDER BY c DESC');
        $out = [];
        foreach ($stmt->fetchAll() as $r) { if (($r['form_type'] ?? '') !== '') $out[$r['form_type']] = (int)$r['c']; }
        return $out;
    } catch (Throwable $e) { return []; }
}

/** Dashboard counts: total, last 7 days, last 30 days. */
function admin_leads_counts(): array {
    $pdo = admin_leads_pdo();
    $zero = ['total' => 0, 'd7' => 0, 'd30' => 0, 'available' => false];
    if (!$pdo || !admin_leads_table_exists()) return $zero;
    try {
        $total = (int)$pdo->query('SELECT COUNT(*) FROM leads')->fetchColumn();
        $d7  = (int)$pdo->query('SELECT COUNT(*) FROM leads WHERE created_at >= (NOW() - INTERVAL 7 DAY)')->fetchColumn();
        $d30 = (int)$pdo->query('SELECT COUNT(*) FROM leads WHERE created_at >= (NOW() - INTERVAL 30 DAY)')->fetchColumn();
        return ['total' => $total, 'd7' => $d7, 'd30' => $d30, 'available' => true];
    } catch (Throwable $e) { return $zero; }
}

/* ---------- admin-side read/star state (never touches the leads table) ------ */
function admin_lead_state(): array { return admin_json_read(ADMIN_LEADS_STATE, []); }
function admin_lead_state_save(array $s): bool { return admin_json_write(ADMIN_LEADS_STATE, $s); }
function admin_lead_is_read(int $id): bool { $s = admin_lead_state(); return !empty($s[(string)$id]['read']); }
function admin_lead_is_starred(int $id): bool { $s = admin_lead_state(); return !empty($s[(string)$id]['star']); }
function admin_lead_mark_read(int $id, bool $read = true): void {
    $s = admin_lead_state(); $s[(string)$id]['read'] = $read; admin_lead_state_save($s);
}
function admin_lead_toggle_star(int $id): bool {
    $s = admin_lead_state(); $on = !($s[(string)$id]['star'] ?? false);
    $s[(string)$id]['star'] = $on; admin_lead_state_save($s); return $on;
}
function admin_leads_unread_count(array $rows): int {
    $s = admin_lead_state(); $n = 0;
    foreach ($rows as $r) { if (empty($s[(string)($r['id'] ?? 0)]['read'])) $n++; }
    return $n;
}

/** CSV of the given rows (all columns), returned as a string. */
function admin_leads_csv(array $rows): string {
    $cols = admin_leads_columns();
    $fh = fopen('php://temp', 'r+');
    fputcsv($fh, $cols);
    foreach ($rows as $r) {
        $line = [];
        foreach ($cols as $c) { $line[] = $r[$c] ?? ''; }
        fputcsv($fh, $line);
    }
    rewind($fh);
    $csv = stream_get_contents($fh);
    fclose($fh);
    return $csv;
}

function admin_lead_label(string $formType): string {
    $map = [
        'popup' => 'Manuscript Popup', 'manuscript' => 'Manuscript Submission', 'contact' => 'Contact Page',
        'quote_card' => 'Quote Card', 'newsletter' => 'Newsletter Signup', 'footer' => 'Footer Form', 'website' => 'Website',
    ];
    return $map[$formType] ?? ucwords(str_replace('_', ' ', $formType ?: 'Website'));
}
