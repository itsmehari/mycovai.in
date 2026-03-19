# Elections 2026 Subproject Record

**Subsite:** `/coimbatore-elections-2026/` on mycovai.in  
**Source of truth:** [docs/ELECTION-PLAN-FOR-MYCOVAI-REPLICATION.md](../../docs/ELECTION-PLAN-FOR-MYCOVAI-REPLICATION.md)

## What was done

### Phase 1 – Foundation
- **Bootstrap:** `includes/bootstrap.php` (ROOT_PATH, omr-connect, url-helpers, ELECTIONS_2026_PATH, ELECTIONS_2026_BASE_URL).
- **Hub:** `index.php` with meta, breadcrumbs, card grid to Key dates, Know your constituency, Find BLO, Constituencies, Candidates, How to vote, FAQ, News, Newsletter.
- **Core pages:** know-your-constituency, find-blo, dates, how-to-vote, faq, candidates, news, announcements, newsletter (with honeypot, source_page, file storage).
- **Constituency data:** `includes/constituency-data.php` with six Coimbatore ACs (Palladam, Sulur, Kavundampalayam, Coimbatore North/South, Singanallur).
- **Constituency pages:** `constituency/*.php` (palladam, sulur, kavundampalayam, coimbatore-north, coimbatore-south, singanallur) using `includes/constituency-template.php`; invalid slug → 404.
- **Sitemap:** `generate-sitemap.php`; .htaccess rule for `coimbatore-elections-2026/sitemap.xml`; entry in `weblog/generate-sitemap-index.php`.

### Visibility
- **Nav:** “Elections 2026” added to `components/main-nav.php` (secondary links).
- **Footer:** “Elections 2026” added to Useful Links and Explore in `components/footer-covai.php`.
- **Homepage:** Dedicated Elections section (heading, blurb, “View guide” button) in `index.php`.

### Phase 2 – Data & SEO
- **DB (optional):** `dev-tools/create-election-2026-tables.sql`, `dev-tools/seed-election-2026.sql`, `dev-tools/run-election-2026-migration.php`, `dev-tools/verify-election-tables-live.php`. Tables: `election_2026_candidates`, `election_2026_announcements`. candidates.php and announcements.php read from DB when tables exist.
- **Constituency data:** Filled with 2021 results where available.
- **Schema:** BreadcrumbList via meta.php; Place JSON-LD on each constituency page; FAQPage on faq.php.
- **ICS:** `dates-2026.ics.php` (poll + counting); link from dates.php “Add to calendar”.

### Phase 3 – Engagement & Bilingual
- **Countdown:** Hub shows “X days to poll” or “Poll was on…” with link to results.
- **Share CTA:** Hub and constituency pages – “Share this guide” (WhatsApp + Twitter).
- **Tamil hub:** `index-tamil.php` with lang="ta", hreflang en/ta/x-default, “Read in English” / “தமிழில்” links.
- **Quiz:** `quiz.php` – 4 questions (AC, ID, poll date, BLO); submit shows score and “You’re ready” or “Do this next” links.
- **Results:** `results-2026.php` – before 4 May: “Counting 4 May 2026” + ECI/CEO links; after: list of ACs with links to constituency pages.
- **Sitemap:** Includes index-tamil.php, quiz.php, results-2026.php.

### SEO pass
- **Meta/og/twitter:** Set on all pages.
- **Schema:** WebPage + 2× Event (Poll, Counting) on hub; 2× Event on dates.php; HowTo on how-to-vote.php; FAQPage on faq.php; Place on constituency pages.
- **Analytics:** `components/analytics.php` included on all subsite pages.

### Docs
- **Subproject record:** This file.

## Files touched (summary)

| Area | Files |
|------|--------|
| Subsite root | index.php, dates.php, how-to-vote.php, faq.php, candidates.php, news.php, announcements.php, newsletter.php, know-your-constituency.php, find-blo.php, generate-sitemap.php, dates-2026.ics.php, quiz.php, results-2026.php, index-tamil.php |
| includes/ | bootstrap.php, constituency-data.php, constituency-template.php |
| constituency/ | palladam.php, sulur.php, kavundampalayam.php, coimbatore-north.php, coimbatore-south.php, singanallur.php |
| docs/ | ELECTIONS-2026-SUBPROJECT-RECORD.md |
| Site-wide | .htaccess, weblog/generate-sitemap-index.php, components/main-nav.php, components/footer-covai.php, index.php (homepage) |
| dev-tools | create-election-2026-tables.sql, seed-election-2026.sql, run-election-2026-migration.php, verify-election-tables-live.php |

## Deployment layout (required for pages to load)

The elections subsite **depends on the full site layout**. The **document root** (or the directory that contains `core/` and `components/`) must be the **parent** of `coimbatore-elections-2026/`.

Required filesystem layout:

- `(document root)/core/omr-connect.php`, `mycovai-config.php`, `url-helpers.php`
- `(document root)/components/meta.php`, `main-nav.php`, `footer.php`, etc.
- `(document root)/coimbatore-elections-2026/index.php`, `includes/bootstrap.php`, and all other subsite files

If only `coimbatore-elections-2026/` is uploaded (e.g. to a subdomain or a folder with no parent `core/` and `components/`), the pages will not load. Either:

1. **Deploy the full repo** so the parent of `coimbatore-elections-2026/` is the app root (recommended), or
2. Add a standalone bootstrap and bring `core/` and `components/` into the elections subtree (copy/symlink); see plan for optional step 5.

**Diagnostic:** Run `https://your-domain/coimbatore-elections-2026/check-env.php` to see whether ROOT_PATH, core files, and DB connection are OK. Remove or restrict `check-env.php` after fixing the site.

### Required files (second-level and deep pages)

For the hub, second-level pages, and constituency pages to load, **all** of these must be present under `coimbatore-elections-2026/` on the server:

| Level | File(s) | URL path |
|-------|---------|----------|
| Hub | `index.php`, `index-tamil.php` | `/coimbatore-elections-2026/`, `…/index-tamil.php` |
| Second-level | `dates.php`, `know-your-constituency.php`, `find-blo.php`, `candidates.php`, `how-to-vote.php`, `faq.php`, `news.php`, `newsletter.php`, `quiz.php`, `results-2026.php`, `announcements.php`, `dates-2026.ics.php` | `/coimbatore-elections-2026/<file>.php` |
| Includes | `includes/bootstrap.php`, `includes/constituency-data.php`, `includes/constituency-template.php` | (loaded by PHP, not requested directly) |
| Deep (constituency) | `constituency/palladam.php`, `constituency/sulur.php`, `constituency/kavundampalayam.php`, `constituency/coimbatore-north.php`, `constituency/coimbatore-south.php`, `constituency/singanallur.php` | `/coimbatore-elections-2026/constituency/<slug>.php` |
| Config | `.htaccess` (DirectoryIndex index.php) | (ensures hub and subdir PHP work) |

If any of these are missing or not uploaded, the corresponding links will 404 or fail. After deployment, verify with the [Quick verification checklist (live)](ELECTIONS-2026-GAP-ANALYSIS.md#3-quick-verification-checklist-live) in ELECTIONS-2026-GAP-ANALYSIS.md.

## Remote DB

To run migration against live: set `DB_HOST=mycovai.in` (and DB_USER, DB_PASS, DB_NAME if needed); ensure cPanel Remote MySQL allows your IP. See AGENTS.md and docs/data-backend/LOCAL_TO_REMOTE_DATABASE_SETUP.md. Get explicit user confirmation before running against live.
