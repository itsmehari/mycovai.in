# MyCovai.in — Deployment Notes

**Last updated:** May 2026  
**Audience:** Developers deploying security-audit and Phase 5–6 changes to cPanel production.

---

## Deploy sprint (2026 legacy + SEO)

### 1. Local pre-flight

```bash
php dev-tools/deploy-sprint-cli.php pre
php dev-tools/generate-all-sitemaps-cli.php   # optional; needs DB env
```

### 2. Push to production (cPanel Git)

This repo uses `.cpanel.yml` → `rsync` to `/home3/metap8ok/mycovai.in`. **Push `main` to GitHub**, then **Deploy HEAD** in cPanel Git™ (or wait for auto-deploy).

```bash
git push origin main
```

### 3. cPanel cleanup (required — rsync does not delete orphans)

SSH/Terminal on server:

```bash
bash dev-tools/post-deploy-cpanel-cleanup.sh
```

Removes: `pentahive/`, `listings/`, `events/`, `free-ads-chennai/`, `weblog/create-tables-remote.php`, retired info PHP files.

### 4. Post-deploy verification

```bash
php dev-tools/deploy-sprint-cli.php post
php dev-tools/gsc-prep-sitemap-cli.php --live
```

Then GSC: remove stale sitemaps (`pentahive`, `election-blo-details`), submit `sitemap.xml` — see `docs/inbox/SEO-MIGRATION-GSC.md`.

---

## Pre-deploy checklist

1. **Backup** — cPanel full backup + export `metap8ok_mycovai` database before any live migration.
2. **Env vars** (cPanel → PHP / `.htaccess` / `core/env.php`):
   - `MYCOVAI_ENV=production`
   - `DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME` (never commit credentials)
   - `ADMIN_PASSWORD_HASH` or rotated admin credentials per Phase 1
3. **Remote MySQL** — developer machine IP allowed if running CLI scripts against live.
4. **Writable dirs** — `logs/`, `logs/cache/` (homepage count cache), upload folders for articles/events.

---

## What to upload (typical security + Phase 5–6 deploy)

| Area | Paths |
|------|--------|
| Core | `core/omr-connect.php`, `core/mycovai-config.php`, `core/homepage-listing-counts.php`, `core/magic-link-auth.php` |
| Security | `database/.htaccess`, root `.htaccess` |
| Jobs | `jobs/` (Covai filenames), employer magic-link auth |
| News | `local-news/article.php`, `coimbatore-news.php`, retired stubs only |
| Admin | `admin/_bootstrap.php`, `admin/config/navigation.php`, manage-* pagination |
| Assets | `assets/img/mycovai-logo.svg` |
| SEO | `sitemap.xml`, `robots.txt`, `weblog/generate-sitemap-index.php` |
| Removed on server | `listings/*.php`, `pentahive/`, `info/find-blo-officer.php`, OMR `jobs-in-*-omr.php`, static `local-news/*.php` (except infra allowlist) |

---

## Post-deploy verification

```bash
# From repo (with DB env set for live)
php dev-tools/test-db-connect-cli.php
php dev-tools/verify-directory-tables-cli.php
php dev-tools/db-summary-cli.php

# No DB required
php dev-tools/test-phase4-branding-cli.php
php dev-tools/test-phase5-legacy-news-cli.php
php dev-tools/test-phase5-6-cli.php
```

**Browser smoke tests:**

- `https://mycovai.in/` — category counts load; no PHP errors
- `https://mycovai.in/coimbatore-news.php` — article list
- `https://mycovai.in/jobs/` — listings; pending job not visible on detail URL
- `https://mycovai.in/admin/` — login, CSRF on deletes
- Legacy URLs 301: `/listings/…`, `/pentahive/`, `/jobs-in-omr-chennai.php` → Covai targets

---

## Cache

Homepage directory counts cache: `logs/cache/homepage-listing-counts.json` (1 hour TTL).

After bulk directory import on live:

```bash
php dev-tools/clear-homepage-counts-cache-cli.php
```

---

## Sitemaps & Search Console

- **Root index:** `https://mycovai.in/sitemap.xml` (static hub URLs)
- **Dynamic index:** `weblog/generate-sitemap-index.php` → sub-sitemaps for jobs, directory, events, articles, elections
- **Cron (weekly):** hit module sitemap generators or run `php weblog/generate-sitemap-index.php` if wired to cron
- Resubmit sitemap in Google Search Console after OMR URL cleanup

---

## Production hardening (Phase 1)

- [ ] `display_errors` off on `index.php`, `coimbatore-news.php`, jobs error-reporting
- [ ] Rotate DB password; remove literals from `omr-connect.php`
- [ ] Block `admin/updatenewsform.php` (`.htaccess` rule in place)
- [ ] Test employer/owner magic-link email delivery
- [ ] Remove `test-website/` from production docroot if present

---

## Rollback

- Restore cPanel file backup and DB dump
- Re-enable old `.htaccess` only if redirects cause unexpected loops (unlikely)

**Reference:** `.cursor/plans/mycovai_php_security_audit_5e7e1e8e.plan.md`, `docs/data-backend/LOCAL_TO_REMOTE_DATABASE_SETUP.md`
