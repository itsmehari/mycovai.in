# Coimbatore Elections 2026 – Page Check & Gap Analysis

**Date:** 2026-03-19  
**Scope:** All election-related pages under `/coimbatore-elections-2026/` on mycovai.in.

---

## 1. Page inventory and status

| # | Page | File | Purpose | Status |
|---|------|------|--------|--------|
| 1 | Hub | `index.php` | Main Elections 2026 hub, 9 cards + Quiz/Results buttons | ✅ Present |
| 2 | Key dates | `dates.php` | Timeline (Gazette, nominations, poll 23 Apr, counting 4 May) | ✅ Present |
| 3 | Know your constituency | `know-your-constituency.php` | List of 6 ACs with links to constituency pages | ✅ Present |
| 4 | Find BLO | `find-blo.php` | Links to CEO TN & erolls.tn.gov.in (external) | ✅ Present |
| 5 | Constituencies (View ACs) | Same as #3 | Card links to `know-your-constituency.php` | ✅ Present |
| 6 | Candidates | `candidates.php` | List by AC; reads from `election_2026_candidates` if table exists | ✅ Present |
| 7 | How to vote | `how-to-vote.php` | EPIC/ID, polling station, steps | ✅ Present |
| 8 | FAQ | `faq.php` | Dates, ID, EVM, MCC, etc. | ✅ Present |
| 9 | News | `news.php` | Placeholder + links to ECI/CEO TN | ✅ Present |
| 10 | Newsletter | `newsletter.php` | Subscribe form → `weblog/subscribers-elections-2026.txt` | ✅ Present |
| 11 | Quiz | `quiz.php` | “Are you ready to vote?” 4-question form | ✅ Present |
| 12 | Results 2026 | `results-2026.php` | Placeholder until 4 May 2026; then list ACs with “View” | ✅ Present |
| 13 | Announcements | `announcements.php` | Reads from `election_2026_announcements` if table exists | ✅ Present |
| 14 | Tamil hub | `index-tamil.php` | Tamil version of hub (hreflang) | ✅ Present |
| 15 | ICS calendar | `dates-2026.ics.php` | Add to calendar | ✅ Referenced from dates.php |
| 16 | Constituency detail | `constituency/{slug}.php` | palladam, sulur, kavundampalayam, coimbatore-north, coimbatore-south, singanallur | ✅ All 6 present |

All linked pages exist in the repo. No 404s expected from internal links.

---

## 2. Gaps and recommendations

### 2.1 URL and routing

- **No clean URLs:** All links use `.php` (e.g. `/coimbatore-elections-2026/dates.php`). There are no `.htaccess` rewrite rules for this subsite (only `sitemap.xml` is rewritten). Acceptable; optional improvement: add rewrites for cleaner URLs (e.g. `/coimbatore-elections-2026/dates` → `dates.php`).
- **Directory index:** `/coimbatore-elections-2026/` relies on server `DirectoryIndex` (e.g. `index.php`). No local `.htaccess` in the folder. If the server ever skips `index.php`, the hub could break; consider adding a minimal `.htaccess` with `DirectoryIndex index.php` inside `coimbatore-elections-2026/` if needed on your host.

### 2.2 Content and data

- **Candidates:** `candidates.php` shows “Candidates will be listed after nomination process” per AC when `election_2026_candidates` is missing or empty. Ensure migration has been run on live if you want DB-driven candidates (`dev-tools/run-election-2026-migration.php` / `create-election-2026-tables.sql` + `seed-election-2026.sql`).
- **Announcements:** Same pattern; empty until `election_2026_announcements` is populated. Intentional; no bug.
- **News:** `news.php` is a placeholder with links to ECI/CEO TN. No internal “election news” feed or tagged articles yet. **Gap:** Consider linking to local-news articles tagged for election/2026 when that taxonomy exists, or add a simple list of curated links.

### 2.3 Functionality and ops

- **Newsletter:** Submissions append to `weblog/subscribers-elections-2026.txt`. **Gap:** Ensure `weblog/` is writable on live; otherwise subscription will fail with a generic error. No duplicate check or confirmation email.
- **Find BLO:** Correctly points to external CEO Tamil Nadu and erolls portals (no internal BLO search for Coimbatore). Matches card copy (“CEO Tamil Nadu portal”).
- **Results 2026:** Logic is correct: before 4 May 2026 shows “Counting on 4 May…” and ECI/CEO links; after that date shows AC list with links to `constituency/{slug}.php`. Post-counting, you may want to add result figures (from DB or static) on results page and/or constituency pages.

### 2.4 UX and SEO

- **Two cards, one target:** “Know your constituency” and “Constituencies (View ACs)” both link to `know-your-constituency.php`. Intentional (same list of ACs). No change needed unless you want a separate “Constituencies” landing page.
- **Tamil:** Only the hub has a Tamil version (`index-tamil.php`). Other pages (dates, FAQ, how-to-vote, etc.) are English-only. **Gap:** If Tamil traffic is important, consider Tamil versions or at least key pages (e.g. dates, how-to-vote).
- **Sitemap:** `generate-sitemap.php` includes all subsite URLs plus constituency slugs; `.htaccess` serves `coimbatore-elections-2026/sitemap.xml`. Sitemap index references it. No gap.

### 2.5 Database and environment

- **DB dependency:** `candidates.php` and `announcements.php` use `isset($conn)` and table checks; they degrade gracefully when tables are missing. Safe.
- **Connection:** Bootstrap uses `ROOT_PATH` and `core/omr-connect.php` (mycovai DB). No conflict with MyOMR codebase.

### 2.6 Possible bugs / edge cases

- **Bootstrap ROOT_PATH:** `dirname(__DIR__, 2)` from `includes/bootstrap.php` assumes repo root is two levels up from `includes/` (i.e. `coimbatore-elections-2026/includes/` → repo root). Correct for current structure; only a concern if the folder is moved deeper.
- **Newsletter honeypot:** Form uses a “website” honeypot and `FILTER_SANITIZE_EMAIL` + `FILTER_VALIDATE_EMAIL`. Adequate for basic spam reduction; consider rate limiting or CAPTCHA if abuse appears.

---

## 3. Quick verification checklist (live)

1. Open `https://mycovai.in/coimbatore-elections-2026/` → hub loads.
2. Click each of the 9 card buttons → correct pages load (dates, know-your-constituency, find-blo, candidates, how-to-vote, faq, news, newsletter).
3. Click “Are you ready to vote? Quiz” and “Results 2026” → quiz and results pages load.
4. From “Know your constituency” / “View ACs”, click “View” for each AC → all 6 constituency pages load (palladam, sulur, kavundampalayam, coimbatore-north, coimbatore-south, singanallur).
5. Submit newsletter with valid email → success message; check `weblog/subscribers-elections-2026.txt` (or equivalent on server) for new line.
6. Optional: Run `dev-tools/verify-election-tables-live.php` (or DB check) to confirm `election_2026_candidates` and `election_2026_announcements` exist if you use DB content.

---

## 4. Summary

- **Working:** All election-related pages and links are present and correctly wired; no broken internal links found in code. Results, BLO, newsletter, quiz, and DB-driven candidates/announcements behave as designed.
- **Gaps:** (1) News page is placeholder only; (2) Newsletter depends on writable `weblog/` and has no double opt-in; (3) Tamil only on hub; (4) Optional: clean URLs and explicit `DirectoryIndex` in subsite.
- **Post–4 May 2026:** Plan to add actual result figures to results page and/or constituency pages when data is available.
