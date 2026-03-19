# Coimbatore Elections 2026 – Link Audit

**Date:** 2026-03-19  
**Scope:** All internal links (within the subsite) in `coimbatore-elections-2026/`. Every linked target has been verified to exist.

---

## Internal link targets (all under `/coimbatore-elections-2026/`)

| Target | File on disk | Status |
|--------|--------------|--------|
| Hub (/) | `index.php` | OK |
| Tamil hub | `index-tamil.php` | OK |
| Key dates | `dates.php` | OK |
| Know your constituency | `know-your-constituency.php` | OK |
| Find BLO | `find-blo.php` | OK |
| Candidates | `candidates.php` | OK |
| How to vote | `how-to-vote.php` | OK |
| FAQ | `faq.php` | OK |
| News | `news.php` | OK |
| Newsletter | `newsletter.php` | OK |
| Quiz | `quiz.php` | OK |
| Results 2026 | `results-2026.php` | OK |
| Announcements | `announcements.php` | OK |
| ICS calendar | `dates-2026.ics.php` | OK |
| Diagnostic | `check-env.php` | OK |
| Constituency: Palladam | `constituency/palladam.php` | OK |
| Constituency: Sulur | `constituency/sulur.php` | OK |
| Constituency: Kavundampalayam | `constituency/kavundampalayam.php` | OK |
| Constituency: Coimbatore North | `constituency/coimbatore-north.php` | OK |
| Constituency: Coimbatore South | `constituency/coimbatore-south.php` | OK |
| Constituency: Singanallur | `constituency/singanallur.php` | OK |

---

## Where each link appears

| Source file(s) | Links to |
|----------------|----------|
| `index.php` | Hub (/), index-tamil.php, dates, know-your-constituency, find-blo, candidates, how-to-vote, faq, news, newsletter, quiz, results-2026 |
| `index-tamil.php` | Hub (/), dates, know-your-constituency, find-blo, how-to-vote, faq, results-2026 |
| `know-your-constituency.php` | Hub (/), constituency/{slug}.php (all 6) |
| `candidates.php` | Hub (/), constituency/{slug}.php (all 6) |
| `results-2026.php` | Hub (/), ECI/CEO (external), constituency/{slug}.php (all 6) |
| `dates.php` | Hub (/), dates-2026.ics.php |
| `how-to-vote.php` | Hub (/), know-your-constituency, find-blo, quiz |
| `quiz.php` | Hub (/), quiz (self), know-your-constituency, how-to-vote, dates, find-blo, faq |
| `includes/constituency-template.php` | Hub (/), know-your-constituency |
| `includes/bootstrap.php` (error page) | check-env.php |
| `generate-sitemap.php` | All of the above (URL list for sitemap) |

---

## Constituency slugs vs files

Slugs in `includes/constituency-data.php` match the constituency PHP filenames:

| Slug | File |
|------|------|
| palladam | constituency/palladam.php |
| sulur | constituency/sulur.php |
| kavundampalayam | constituency/kavundampalayam.php |
| coimbatore-north | constituency/coimbatore-north.php |
| coimbatore-south | constituency/coimbatore-south.php |
| singanallur | constituency/singanallur.php |

---

## External links (not audited for file existence)

- ECI: https://eci.gov.in
- CEO Tamil Nadu: https://elections.tn.gov.in
- BLO portal: https://elections.tn.gov.in/BLO.aspx
- erolls BLO: https://www.erolls.tn.gov.in/blo/
- WhatsApp / Twitter share (built from current page URL)

---

## Result

**All internal election links have a corresponding file in the repo.** Nothing is missing. If a link fails on the live site, the cause is likely deployment (file not uploaded) or server config (see ELECTIONS-2026-SUBPROJECT-RECORD.md deployment section and check-env.php).

---

## Live URL check (mycovai.in)

Checked by fetching each URL. **Date:** 2026-03-19.

### Pages that load when using correct URL

| URL | Status |
|-----|--------|
| https://mycovai.in/coimbatore-elections-2026/ | OK (hub) |
| https://mycovai.in/coimbatore-elections-2026/index-tamil.php | OK |
| https://mycovai.in/coimbatore-elections-2026/dates.php | OK |
| https://mycovai.in/coimbatore-elections-2026/know-your-constituency.php | OK |
| https://mycovai.in/coimbatore-elections-2026/find-blo.php | OK |
| https://mycovai.in/coimbatore-elections-2026/candidates.php | OK |
| https://mycovai.in/coimbatore-elections-2026/how-to-vote.php | OK |
| https://mycovai.in/coimbatore-elections-2026/faq.php | OK |
| https://mycovai.in/coimbatore-elections-2026/news.php | OK |
| https://mycovai.in/coimbatore-elections-2026/newsletter.php | OK |
| https://mycovai.in/coimbatore-elections-2026/quiz.php | OK |
| https://mycovai.in/coimbatore-elections-2026/results-2026.php | OK |
| https://mycovai.in/coimbatore-elections-2026/constituency/palladam.php | OK |

### Root URLs (what the hub currently links to on live) – 404

| URL | Status |
|-----|--------|
| https://mycovai.in/dates.php | **404 Not Found** |
| https://mycovai.in/constituency/palladam.php | **404 Not Found** |

### Issue on live

On the live site, **all internal links from the hub and other election pages point to the site root** (e.g. `https://mycovai.in/dates.php`, `https://mycovai.in/candidates.php`) instead of the subsite (`https://mycovai.in/coimbatore-elections-2026/dates.php`). So when users click “View timeline”, “View candidates”, “View ACs”, etc., they get **404** because those files exist only under `/coimbatore-elections-2026/`.

**Cause:** The server is likely running an older `includes/bootstrap.php` that sets `ELECTIONS_2026_BASE_URL` to the site root instead of `.../coimbatore-elections-2026`. The repo version correctly sets `$base . '/coimbatore-elections-2026'`.

**Fix:** Redeploy the full `coimbatore-elections-2026/` folder (especially `includes/bootstrap.php`) so that `ELECTIONS_2026_BASE_URL` is `https://mycovai.in/coimbatore-elections-2026`. After that, all hub and in-page links will point to the correct URLs and will load.
