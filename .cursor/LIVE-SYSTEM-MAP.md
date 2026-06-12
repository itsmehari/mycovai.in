# MyCovai.in — Live System Map (10x documentation)

> **Single live source of truth** for architecture, routing, modules, maintenance, and legacy status.  
> **Last updated:** 2026-05-29 · **Maintainer:** update this file when code paths, modules, or deploy process change.

---

## 1. Project identity

| Item | Value |
|------|--------|
| **Product** | MyCovai — Coimbatore directory, news, jobs, events, hostels, coworking |
| **Domain** | https://mycovai.in |
| **Region** | Coimbatore (Covai), Tamil Nadu |
| **Stack** | PHP 8.2, MySQLi, Bootstrap 5, cPanel shared hosting |
| **Legacy origin** | Forked from **MyOMR.in** (Chennai OMR) — cleanup in progress |
| **Sister site** | https://myomr.in (intentional cross-links only in cabinet articles + inactive ad slot) |

---

## 2. 10x documentation layers

| Layer | Location | Role | Refresh cadence |
|-------|----------|------|-----------------|
| **0 — Live map** | `.cursor/LIVE-SYSTEM-MAP.md` (this file) | What exists now; where to change things | Every meaningful code change |
| **1 — Runbooks** | `.cursor/maintenance/` | Phases, legacy audit, deploy/test cadence | After sprints / deploys |
| **2 — Operations** | `docs/deployment/`, `docs/inbox/` | Deploy notes, E2E checklist, editor playbook | When process changes |
| **3 — Deep reference** | `docs/` categories | PRDs, SEO, analytics, worklogs | As needed; link from Layer 0 |
| **4 — Snapshots** | `.cursor/db-summaries/`, `docs/worklogs/` | DB state, daily work history | DB: daily; worklog: per session |

**Rule:** If it's not in Layer 0 and it affects maintenance, add a one-line pointer here.

---

## 3. Module map (public + admin)

| Module | Public entry | Admin | DB tables (primary) | Sitemap |
|--------|--------------|-------|---------------------|---------|
| **Homepage** | `/index.php` | — | `List of Areas`, category counts via `covai_*` | Root `sitemap.xml` |
| **Directory** | `/directory/`, pretty `/schools`, `/hospitals`, … | `/admin/` list pages | `covai_schools`, `covai_hospitals`, … | `/directory/sitemap.xml` |
| **News** | `/coimbatore-news.php`, `/local-news/{slug}` | `/admin/articles/` | `articles` | `/local-news/sitemap.xml` |
| **Jobs** | `/jobs/` | `/jobs/admin/` | `job_postings`, `employers`, … | `/jobs/sitemap.xml` |
| **Events** | `/local-events/` | `/local-events/admin/manage-events-covai.php` | `event_listings` | `/local-events/sitemap.xml` |
| **Hostels** | `/hostels-pgs/` | `/hostels-pgs/admin/` | `hostels_pgs` | `/hostels-pgs/sitemap.xml` |
| **Coworking** | `/coworking-spaces/` | `/coworking-spaces/admin/` | `coworking_spaces` | `/coworking-spaces/sitemap.xml` |
| **Elections** | `/coimbatore-elections-2026/` | (content in tree) | — | `/coimbatore-elections-2026/sitemap.xml` |

**Deprecated (do not extend):** `news_bulletin` admin (`/admin/news-list.php`), legacy `/events/` (OMR HTML), `/admin/events/events-list.php`.

---

## 4. Config & branding (single sources)

| Concern | File | Notes |
|---------|------|-------|
| Site name, region, social | `core/mycovai-config.php` | Loaded via `core/omr-connect.php` |
| Logo helper | `core/site-branding.php` | `covai_logo_url()`, `covai_site_name()` |
| Homepage categories | `core/homepage-directory-categories.php` | Keys sync with `directory-hub-redirect.php` |
| Homepage counts | `core/homepage-listing-counts.php` | Cached 1h → `logs/cache/homepage-listing-counts.json` |
| Admin nav registry | `admin/config/navigation.php` | Role-based sidebar |
| Ads / affiliate | `core/ad-registry.php`, `core/amazon-affiliate-registry.php` | MyOMR slot `active: false` |
| DB connection | `core/omr-connect.php` | Env: `DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME` |

---

## 5. URL redirects (legacy → Covai)

Handled in root `.htaccess` (non-exhaustive; see file for full list):

| Legacy pattern | Target |
|----------------|--------|
| `/omr-listings/*` | `/directory/*` |
| `/omr-local-job-listings/*` | `/jobs/*` |
| `/omr-local-events/*` | `/local-events/*` |
| `/discover-myomr/*` | `/discover/*` |
| `/listings/*` | `/directory/` |
| `/pentahive/*` | `/` |
| `/local-news/*.php` (non-infra) | `/coimbatore-news.php` |
| `/jobs-in-*-omr.php`, `/it-jobs-omr-chennai.php` | Covai job landers |
| `/info/find-blo-officer.php` | `/coimbatore-elections-2026/` |
| `*-my-omr*.php`, `about-myomr-*` | Canonical about/contact/privacy |

**local-news infra allowlist:** `article.php`, `event-recap.php`, `generate-sitemap.php`, `article-sports-seo-enhancement.php`, `news-highlights.php`, `news-highlights-from-omr-road.php`.

---

## 6. CLI verification suite (run locally)

```bash
php dev-tools/test-phase4-branding-cli.php
php dev-tools/test-phase5-legacy-news-cli.php
php dev-tools/test-phase5-6-cli.php
php dev-tools/audit-sitemap-cli.php
php dev-tools/verify-directory-tables-cli.php   # needs DB
php dev-tools/clear-homepage-counts-cache-cli.php
```

With live DB: `DB_HOST=mycovai.in php dev-tools/db-summary-cli.php` → save to `.cursor/db-summaries/db-summary-dd-MM-yyyy.md`.

---

## 7. Security audit — phase status

| Phase | Scope | Status |
|-------|--------|--------|
| 1 | Credentials, display_errors, DB folder block, magic-link auth | ✅ Done |
| 2 | CSRF, admin redirect, content IA, logic fixes | ✅ Done |
| 3 | Admin pagination, role nav, error handler | ✅ Done |
| 4 | Nav, CTAs, MyCovai branding, logo | ✅ Done |
| 5a | Legacy news + landers removal | ✅ Done |
| 5 | SEO cache, sitemap, OMR job landers | ✅ Done |
| 6 | Deploy notes, editor playbook, E2E checklist | ✅ Done |

**Not in security plan (backlog):** see [maintenance/LEGACY-MYOMR-AUDIT.md](maintenance/LEGACY-MYOMR-AUDIT.md).

---

## 8. Legacy MyOMR / cross-site — summary

**Removed / redirected (P1–P2):** `listings/`, `pentahive/`, BLO, static OMR news, OMR job landers, `events/`, OMR info pages, stale `weblog/contact-my-omr-team.php`, `free-ads-chennai/`.

**Rebranded (P2–P4):** onboarding, discover overview, SDG CSS vars, admin titles, hostels/coworking emails, `covai-jobs-unified-design.css`, `job-listings-covai.css`, `mycovai-news-bulletin.*`, `404.php` / `500.php`, sitemap generators.

**Intentional cross-site:** `dev-tools/sql/cabinet-article-*` sister link to myomr.in; `core/ad-registry.php` inactive sister-site slot.

**P3 backlog:** live deploy, E2E, secret rotation — [maintenance/LEGACY-MYOMR-AUDIT.md](maintenance/LEGACY-MYOMR-AUDIT.md).

**GSC:** Run `php dev-tools/gsc-prep-sitemap-cli.php --live` after deploy. Production (Jun 2026) still serves old sitemap index with `pentahive` / `election-blo-details` until `weblog/generate-sitemap-index.php` is uploaded.

---

## 9. Documentation index (deep dive)

| Topic | Path |
|-------|------|
| Deploy | `docs/deployment/MYCOVAI-DEPLOYMENT-NOTES.md` |
| E2E tests | `docs/inbox/E2E-TEST-CHECKLIST.md` |
| Editor paths | `docs/inbox/CONTENT-EDITOR-PLAYBOOK.md` |
| Job flows map | `docs/inbox/JOB-POSTING-SYSTEM-END-TO-END-VISUAL-MAP.md` |
| Remote DB | `docs/data-backend/LOCAL_TO_REMOTE_DATABASE_SETUP.md` |
| Rebrand plan | `docs/MYCOVAI-NEXT-STEPS-PLAN.md` |
| Security audit plan | `.cursor/plans/mycovai_php_security_audit_5e7e1e8e.plan.md` |
| Agent rules | `AGENTS.md`, `LEARNINGS.md` |

---

## 10. Maintenance cadence

| Task | Frequency | Owner action |
|------|-----------|--------------|
| Update LIVE-SYSTEM-MAP | When modules/routes change | Dev |
| DB summary snapshot | Daily + after live DB change | Dev / agent |
| Run CLI test suite | Before deploy | Dev |
| Legacy audit review | Monthly | Dev |
| `docs/RECENT-UPDATES.md` | Notable releases | Dev |
| Worklog | Active dev days | `docs/worklogs/worklog-dd-mm-yyyy.md` |
| Sitemap GSC resubmit | After URL cleanup | SEO |

See [maintenance/MAINTENANCE-RUNBOOK.md](maintenance/MAINTENANCE-RUNBOOK.md).

---

## 11. Folder map (repo root)

```
mycovai_Root/
├── admin/           CMS (articles, directory CRUD)
├── components/      Layout, meta, nav, footer, analytics
├── core/            DB, config, helpers, cache
├── directory/       Covai listings
├── discover/        Marketing / SDG pages (some legacy OMR copy)
├── docs/            Deep documentation library
├── dev-tools/       CLI scripts, migrations (not web-exposed)
├── jobs/            Job portal (Covai)
├── local-events/    Events module
├── local-news/      Article router + infra only
├── hostels-pgs/     Hostels module
├── coworking-spaces/
├── coimbatore-elections-2026/
├── info/            Info pages (several OMR legacy)
├── events/          Legacy OMR events HTML/PHP
├── weblog/          Sitemap index, some legacy PHP
├── logs/cache/      Homepage count cache
├── .cursor/         ← This hub
└── index.php        Homepage
```

---

*When in doubt: update this file first, then link from `docs/RECENT-UPDATES.md`.*
