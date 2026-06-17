# EU Publishing House — Admin

A self-contained, file-based admin dashboard + SEO-safe blog publisher for
`eupublishinghouse.com`. No database is required for the CMS itself (the only DB
use is **reading** the existing `leads` table). It is re-skinned to the brand's
forest-green / leaf / gold editorial theme and lives entirely under `/admin/`.

Log in at **`/admin/`**.

---

## 1. What each section does & which files it touches

| Admin page | Module key | Writes / reads | Public consumer |
|---|---|---|---|
| `dashboard.php` | `dashboard` | reads everything (stats) | — |
| `posts.php` + `post-edit.php` + `post-actions.php` | `posts` | writes `blogs/<slug>.php`, upserts `includes/blog-data.php`, writes source `admin/data/posts/<slug>.json`, uploads to `assets/images/blog/` | `blog.php` (listing), `blogs/<slug>.php` (post), `sitemap.php` (auto), homepage recent-posts |
| `submissions.php` | `submissions` | **reads only** the `leads` MySQL table; read/star flags in `admin/data/leads-state.json` | the brand's existing `form-submission.php` writes the leads |
| `portfolio.php` | `portfolio` | regenerates `includes/portfolio-data.php`, uploads covers to `assets/images/portfolio/` | `index.php` hero/grid, `portfolios.php`, `includes/books*.php` |
| `testimonials.php` | `testimonials` | regenerates `includes/testimonials-data.php` | `includes/testimonials.php` (home marquee) + `testimonial.php` (page) |
| `authors.php` | `authors` | regenerates `includes/authors-data.php` | `includes/blog-author.php` (post author box) |
| `settings.php` | `settings` | surgically edits `includes/config.php` (contact / social / lead recipients) | every page (brand constants) |
| `users.php` | super-admin only | `admin/data/roles.json`, `admin/data/users.json` | — |
| `account.php` | any logged-in user | own row in `admin/data/users.json` (password + 2FA) | — |

**Homepage data sources to know:** the home page (`index.php`) pulls book covers
from `includes/portfolio-data.php` and the testimonial marquee from
`includes/testimonials.php` → `includes/testimonials-data.php`. Editing Portfolio
or Testimonials in the admin updates the home page automatically.

### The blog publish pipeline (the heart)
1. **Generate** `blogs/<slug>.php` from a template that is **byte-identical** to
   the brand's hand-built posts (proven against `what-is-a-memoir.php`), so the
   title tag, meta description, canonical, JSON-LD `BlogPosting` + `FAQPage`
   schema, breadcrumb, table of contents, internal links and author box are
   never degraded.
2. **Upsert** the registry entry in `includes/blog-data.php` (regenerated in the
   brand's house style, **PHP-linted before** it replaces the live file).
3. **Sitemap** — `sitemap.xml` is generated live by `sitemap.php` from the
   registry, so new posts appear automatically (no separate sitemap write).
4. **Mark** the JSON source published.
- **Unpublish** reverses 2–4 and moves the post file to `/trash` (never deletes).
- **Slug is locked once published** (changing it would break inbound links/SEO).
- **Legacy import:** the first time you edit a hand-built post, it is parsed into
  an editable JSON source. Imported posts stay byte-identical until you change
  them (`read_auto=false`, so their hand-set read time is preserved).

---

## 2. Files written at runtime — PHP needs write permission to:

- `blogs/` and `blogs/images/` (generated posts; legacy `assets/images/blog/` for featured/inline images)
- `assets/images/blog/`, `assets/images/portfolio/` (uploaded images → WebP)
- `includes/` (regenerated `blog-data.php`, `portfolio-data.php`, `testimonials-data.php`, `authors-data.php`, and `config.php` for Settings)
- `admin/data/` (sources, roles, users, state, **backups**)
- `trash/` (unpublished posts)

Every write to a live site file is **backed up first** to `admin/data/backups/`
(last 20 kept) and generated PHP is **`php -l` linted before** it can replace the
live file, so a bad write can never take the site down. If `exec()` is disabled
on the host, linting degrades to "trust" (output is template-controlled).

**GD note:** image uploads are MIME-sniffed (not by extension), size-capped
(~8 MB), and — when the **GD** extension with `imagewebp` is available —
downscaled to ≤1920px and re-encoded to WebP (which also destroys any payload
hidden in a valid image). Without GD the original bytes are kept but the filename
is forced to a safe image extension. Every upload directory gets a `.htaccess`
that disables script execution.

---

## 3. Upload / deploy checklist

Upload these (new or changed):

**New — the admin itself**
- `admin/**` (all pages, `includes/`, `assets/admin.css`, `assets/admin.js`, this README)
- `admin/data/.htaccess` (must be present — blocks web access to the data store)

**New — unified data sources**
- `includes/testimonials-data.php`
- `includes/authors-data.php`

**Changed — site integration**
- `.htaccess` (added the `/admin` passthrough so admin URLs aren't pretty-URL-rewritten)
- `robots.txt` (disallows `/admin/` and the preview file)
- `includes/testimonials.php`, `testimonial.php` (now read the unified testimonials source)
- `includes/blog-author.php` (now reads the unified authors source)

`admin/data/` is created automatically on first run; ensure its parent is writable.

---

## 4. Default accounts (CHANGE ON FIRST LOGIN)

On the very first request, the admin seeds two accounts with **random** strong
passwords and writes them once to `admin/data/INITIAL-LOGIN.txt` (which is
web-blocked). Read that file, log in, change both passwords (My Account), then
**delete `INITIAL-LOGIN.txt`**.

- **Super Admin** — username `admin` — full access (all modules + Roles & Users).
- **Blog Editor** — username `editor` — sees **only** the Blog Posts pages (for
  whoever uploads articles).

> On this build the seed already ran; the current credentials are in
> `admin/data/INITIAL-LOGIN.txt`. If you'd rather start fresh on the live server,
> delete `admin/data/users.json` before/after upload and it will re-seed there.

---

## 5. Security model (what protects this)

- **Passwords:** bcrypt (`password_hash`/`password_verify`), stored in
  `admin/data/users.json` (web-blocked by `admin/data/.htaccess`).
- **Sessions:** dedicated cookie, `HttpOnly`, `SameSite=Lax`, `Secure` on HTTPS,
  `session_regenerate_id(true)` on login.
- **CSRF:** per-session token, `hash_equals` on every state-changing POST (form
  field or `X-CSRF-Token` header) → 419 on mismatch. Logout is token-protected.
- **Login throttle:** 5 failed attempts per (IP + username) → 15-minute lockout,
  with a separate counter for the 2FA code step.
- **reCAPTCHA v3** on login (reuses the brand's keys, action `admin_login`). The
  captcha skip for local dev is gated on the **real peer IP** (`REMOTE_ADDR`
  loopback), never the spoofable `Host` header.
- **2FA (TOTP, RFC 6238):** optional per user, enrolled in My Account (QR + manual
  key), with 8 single-use bcrypt-hashed backup codes. Verified against the RFC
  6238 published test vectors. Admins can reset another user's 2FA.
- **RBAC:** every section is a *module*; each page calls
  `admin_require_module()` / `admin_require_admin()` / `admin_require_login()` at
  the very top (enforced server-side, not just hidden in nav). The super-admin
  role is locked; custom roles can never be granted `*`; you can't delete/demote
  the last super-admin, delete your own account, or delete a role that still has
  users; a user whose role no longer exists gets **zero** modules (fail-closed).
- **Content can't become code:** the article body is sanitised through a
  DOMDocument whitelist that **drops PHP processing-instruction nodes**, plus an
  up-front and final `ukph_strip_php()` pass; the hero title/subtitle, category
  suffix and CTA label are run through an inline-HTML sanitiser; every per-post
  value placed into a PHP string literal is escaped; and every generated file is
  linted before replacing the live one. This is the property that makes a
  file-writing CMS safe.
- **Uploads:** MIME-sniffed, re-encoded to WebP, script execution disabled in
  every upload dir.
- **Leads viewer is read-only** and uses bound PDO parameters (no SQL injection).

---

## 6. Extra hardening (do these on the live host)

1. **Turn on 2FA for every admin** (My Account → Enable 2FA).
2. **cPanel "Directory Privacy" on `/admin`** — a second HTTP-auth wall in front
   of PHP:
   - cPanel → *Files* → **Directory Privacy**.
   - Browse to `public_html/.../admin` and open it.
   - Tick **"Password protect this directory"**, give it a name, **Save**.
   - Create a user + password under **"Create User"**, **Save**.
   - Now `/admin` prompts for HTTP auth before any PHP runs.
3. **Optional IP allow-list on `/admin`** — add to a `.htaccess` inside `admin/`:
   ```apache
   <IfModule mod_authz_core.c>
     Require ip 203.0.113.0/24   # your office/VPN IP(s)
   </IfModule>
   ```
4. **Move committed secrets out of `config.php`.** SMTP password, DB password and
   the reCAPTCHA secret are currently in `includes/config.php`. Move them into a
   gitignored file (e.g. `includes/secrets.php` returning/overriding those
   values) and add `includes/secrets.php` + `admin/data/` to `.gitignore`.

---

## 7. Confirm on live

- Visit `https://eupublishinghouse.com/admin/data/users.json` → must return **403**.
- Visit `https://eupublishinghouse.com/blogs/admin-preview/` (when no preview is
  active) → **404**.
- Submit one real contact form on the live site → check the lead arrives in the
  inbox (`/admin/` → Submissions) and in `error_log` for any mailer notes. Email
  delivery depends on the host allowing outbound SMTP; the DB log + admin inbox
  work regardless.

---

## 8. How it was verified

Automated checks run during the build (PHP 8.2, GD/PDO/fileinfo/exec present):
byte-identical regeneration of the newest post (36,413 bytes) + registry; an
RCE/XSS probe (PHP tags, short tags, nested-in-blockquote, event handlers,
`javascript:` URLs, and a live execution check on a published page); the TOTP
implementation against all six RFC 6238 test vectors plus single-use backup
codes and a full two-step HTTP login; the leads reader against the brand's exact
`leads` schema (search/filter/CSV/unicode); content round-trips for
portfolio/testimonials/authors; read-time parity; RBAC 403s; preview
admin-only/404-for-public; CSRF 419; login lockout; and responsive layout at
375px (no overflow, sidebar → hamburger). All passed.
