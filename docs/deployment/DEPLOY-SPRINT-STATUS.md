# Deploy sprint — status

**Commit:** `201f7e9` on `main` (pushed to GitHub)  
**Date:** 2026-06-07

---

## Done locally

- Pre-flight: `php dev-tools/deploy-sprint-cli.php pre` — **PASSED**
- Git push: `origin/main` updated

---

## Required on cPanel (manual — not automatic from push alone)

Git push does **not** update the live docroot until you deploy in cPanel.

### Step 1 — Deploy HEAD

1. cPanel → **Git Version Control**
2. Open repo `mycovai.in` (path like `/home3/metap8ok/repositories/mycovai.in`)
3. Click **Pull or Deploy** → **Deploy HEAD Commit**
4. Confirm docroot: `/home3/metap8ok/mycovai.in` (see `.cpanel.yml`)

### Step 2 — Orphan cleanup (automatic on deploy)

`.cpanel.yml` now runs `dev-tools/post-deploy-cpanel-cleanup.sh` after rsync. On manual deploy you can also run:

```bash
cd /home3/metap8ok/mycovai.in
bash dev-tools/post-deploy-cpanel-cleanup.sh
```

Removes `pentahive/`, `listings/`, `events/`, `free-ads-chennai/`, `election-blo-details/`, `test-website/`, and retired PHP files still on disk.

### Step 3 — Verify from your PC

```bash
php dev-tools/deploy-sprint-cli.php post
php dev-tools/gsc-prep-sitemap-cli.php --live
```

Expected after success:

- `/pentahive/` → 301 home
- `/jobs-in-omr-chennai.php` → 301 coimbatore
- `/thank-you.php`, `/404.php` → 200 / 404
- `/sitemap.xml` index includes `pages-sitemap.xml`, **no** pentahive/BLO
- `/weblog/create-tables-remote.php` → 404

### Step 4 — Google Search Console

See `docs/inbox/SEO-MIGRATION-GSC.md`:

1. Remove stale sitemaps: `pentahive/sitemap.xml`, `election-blo-details/sitemap.xml`
2. Submit `https://mycovai.in/sitemap.xml`
3. Request indexing: `/`, `/directory/`, `/jobs/`, `/coimbatore-news.php`

---

## Live status at last check (before cPanel deploy)

| Check | Status |
|-------|--------|
| GitHub `main` | ✅ `201f7e9` |
| Live docroot synced | ❌ still old sitemap |
| `thank-you.php` | ❌ 404 |
| `pentahive/` | ❌ 200 (needs cleanup script) |

---

## Rollback

cPanel → Git → deploy previous commit `e229e9c`, or restore file backup.
