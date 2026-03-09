# MyCovai / MyOMR – Project Structure

> Folder organization aligned with live website requirements.  
> Last updated: 2025-03-09

---

## Production (Live) Folders

| Folder | Purpose | Notes |
|--------|---------|-------|
| `/admin/` | Admin CRUD | Schools, banks, restaurants, hospitals, IT parks, etc. |
| `/assets/` | Global CSS, JS, images | main.css, footer.css, homepage-directone.css, core.js |
| `/components/` | Reusable layout | main-nav.php, footer.php, footer-covai.php, analytics.php, subscribe.php |
| `/core/` | DB, auth, helpers | omr-connect.php, mycovai-config.php, url-helpers.php, subscribe.php, modal.js |
| `/database/` | Migrations, seeds | Schema and seed data |
| `/directory/` | Listings | Schools, banks, hospitals, restaurants, IT parks, parks, ATMs |
| `/discover/` | Discover pages | Overview, sustainable-development-goals |
| `/events/` | Legacy events | Uses navbar.php |
| `/local-events/` | Phase 6 events | Primary events module |
| `/local-news/` | News & articles | News highlights, OMR road content |
| `/jobs/` | Job portal | Employer dashboard, landing pages |
| `/hostels-pgs/` | Hostels & PGs | Hostel/PG listings |
| `/coworking-spaces/` | Coworking module | Coworking listings |
| `/pentahive/` | Pentahive landing | Marketing pages |
| `/weblog/` | Sitemap, shared logic | log.php, sitemap |
| `/listings/` | Listings forms | Job, property, business ads |
| `/info/` | Info pages | Citizens charter, BLO subscription |
| `/election-blo-details/` | Election BLO | Election feature |
| `/omr-election-blo/` | Election BLO setup | SQL, import, deployment |

---

## Development & Tools

| Folder | Purpose | Git |
|--------|---------|-----|
| `/dev-tools/` | Migrations, deploy scripts, SSH tunnel | Scripts committed |
| `/dev-tools/staging/` | Audit/staging (formerly @tocheck) | Ignored |
| `/docs/` | Worklogs, PRDs, architecture | Committed |
| `/docs/archive/` | Archived docs, LEARNINGS | Committed |
| `/.cursor/` | Cursor rules, skills | Committed |
| `/.vscode/` | FTP/SFTP config | Ignored |

---

## Ignored (Not for Live / Not in Repo)

| Pattern | Reason |
|---------|--------|
| `/backups/` | Full site backups |
| `/_archive/` | Removed files archive |
| `*-Black-Pearl*` | Alternate theme (unused) |
| `/dev-tools/staging/` | Audit/staging area |
| `md-archives/` | Merged into docs/archive |
| `LEARNINGS*.md` | Personal notes |
| `.env`, `*.sql` | Credentials, DB dumps |
| `node_modules/`, `vendor/` | Dependencies |

---

## Key Files (Root)

| File | Purpose |
|------|---------|
| `index.php` | Homepage |
| `jobs-in-omr-chennai.php` | Jobs landing |
| `digital-marketing-landing.php` | Marketing page |
| `.htaccess` | Routing, clean URLs |
| `robots.txt`, `sitemap.xml` | SEO |

---

## Cleanup History (2025-03-09)

- **Removed:** 40 Black-Pearl theme variants, `-Black-Pearl.htaccess`
- **Moved:** `@tocheck` → `dev-tools/staging/tocheck`
- **Moved:** `md-archives/` → `docs/archive/`
- **Moved:** `LEARNINGS*.md` → `docs/archive/`
- **Moved:** `backups/`, `_Root.zip`, CSV → `_archive/removed-20250309/`
- **Moved:** `core/pricing.*`, `search-services.html`, `script.js`, `action-links.js` → `_archive/.../core-legacy/`
- **Deleted:** `.htaccess.phpupgrader*`, `.processed_property_names.txt`
