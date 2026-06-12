# MyCovai maintenance runbook

**10x Layer 1** — operational procedures. Master map: [LIVE-SYSTEM-MAP.md](../LIVE-SYSTEM-MAP.md).

---

## Daily (if touching DB or content)

1. If live DB changed:  
   `DB_HOST=mycovai.in php dev-tools/db-summary-cli.php`  
   → save as `.cursor/db-summaries/db-summary-dd-MM-yyyy.md`
2. Skim `docs/RECENT-UPDATES.md` — add one line if you shipped something user-visible.

---

## Before every deploy

```bash
php dev-tools/test-phase4-branding-cli.php
php dev-tools/test-phase5-legacy-news-cli.php
php dev-tools/test-phase5-6-cli.php
php dev-tools/audit-sitemap-cli.php
php dev-tools/audit-legacy-myomr-cli.php
```

With DB access:

```bash
DB_HOST=mycovai.in php dev-tools/verify-directory-tables-cli.php
```

Checklist: `docs/inbox/E2E-TEST-CHECKLIST.md`

Deploy steps: `docs/deployment/MYCOVAI-DEPLOYMENT-NOTES.md`

---

## After directory bulk import

```bash
php dev-tools/clear-homepage-counts-cache-cli.php
```

---

## After URL or module change

1. Update `.cursor/LIVE-SYSTEM-MAP.md` (module table, redirects, or folder map).
2. Update `sitemap.xml` or module sitemap generator if public URL added/removed.
3. Run `php dev-tools/audit-sitemap-cli.php`.

---

## After legacy MyOMR cleanup

1. Update `.cursor/maintenance/LEGACY-MYOMR-AUDIT.md` (mark files done).
2. Add `.htaccess` 301 if removing a public path.
3. Run `php dev-tools/audit-legacy-myomr-cli.php`.

---

## Weekly

- Refresh DB summary (even if no schema change — row counts drift).
- Review Search Console for OMR URL impressions; confirm 301s.
- Cron: module sitemaps if configured on cPanel.

---

## Monthly

- Full pass of `LEGACY-MYOMR-AUDIT.md` backlog.
- Review `admin/config/navigation.php` for dead links.
- Confirm `robots.txt` and `sitemap.xml` on live match repo.

---

## Documentation hygiene (10x method)

| You changed… | Update… |
|--------------|---------|
| New public route | LIVE-SYSTEM-MAP §3–5 |
| New admin path | LIVE-SYSTEM-MAP §3 + CONTENT-EDITOR-PLAYBOOK |
| New env var | DEPLOYMENT-NOTES + LEARNINGS.md |
| Completed phase | PHASE-STATUS.md |
| Notable release | docs/RECENT-UPDATES.md + worklog |

**Do not** add a second architecture doc without linking from LIVE-SYSTEM-MAP.
