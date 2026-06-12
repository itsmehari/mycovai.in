# SEO migration & Search Console — minimise visitor loss



After the MyOMR → MyCovai rebrand and URL retirements, expect temporary GSC noise (404s, redirect chains, coverage drops). This runbook minimises traffic loss.



## Execution status (2026-05-29)



| Step | Status | Notes |

|------|--------|-------|

| Local sitemap audit | ✅ Done | `php dev-tools/gsc-prep-sitemap-cli.php` passes |

| Internal links → `/discover/*` | ✅ Done | navbar, discover pages, info/onboarding 301 stubs |

| Static hub sitemap includes discover/overview | ✅ Done | `weblog/generate-static-sitemap.php` |

| `info/sitemap.xml` canonical URLs | ✅ Done | points to `/discover/*` |

| Live `--live` pre-flight | ⏳ Blocked | needs cPanel deploy (`/sitemap.xml` still 404 on live) |

| GSC submit sitemap | 👤 Manual | Search Console MCP unavailable — see below |

| GSC remove stale sitemaps | 👤 Manual | pentahive, election-blo-details |

| GSC request indexing | 👤 Manual | `/`, `/directory/`, `/jobs/`, `/coimbatore-news.php` |



**After cPanel deploy:** run `php dev-tools/gsc-prep-sitemap-cli.php --live` — all checks must pass before GSC submit.

## Troubleshooting: GSC shows "Success" but 0 discovered pages

Google read the **sitemap index** but could not count URLs from **child sitemaps**.

**Live diagnosis (Jun 12, 2026):**

| Issue | Effect |
|-------|--------|
| Stale index lists `pentahive`, `election-blo-details` | Dead children → 404/500 |
| Missing `pages-sitemap.xml` | ~38 hub URLs not in index |
| `directory` / `jobs` / `local-news` sitemaps → **500** | Main URL sets missing (DB) |
| Homepage → **500** | Crawlers blocked until DB fixed |
| `robots.txt` → **404** | Sitemap line not served |

**Fix order:**

1. Create `core/db-secrets.local.php` on server (from `core/db-secrets.local.php.example`) **or** set DB env vars in cPanel.
2. Deploy latest `main` + run `post-deploy-cpanel-cleanup.sh`.
3. `php dev-tools/gsc-prep-sitemap-cli.php --live` — expect 1500+ URLs in children.
4. GSC → Sitemaps — discovered count may take hours; re-open `sitemap.xml` row tomorrow.

Probe: `php dev-tools/probe-live-urls-cli.php`

---



## What we did (technical)



| Change | Mitigation |

|--------|------------|

| Deleted OMR `info/*`, `events/`, `discover/it-parks-in-omr.php` | **301** rules in root `.htaccess` to Covai equivalents |

| Renamed job/event paths `*-omr.php` → `*-covai.php` | **301** per file in `.htaccess` |

| `omr-listings`, `pentahive`, BLO search | **301** to `/directory/`, `/`, elections hub |

| Custom **404.php** / **500.php** | Helpful links to directory, jobs, news — keeps users on site |

| Fresh **sitemap.xml** + module sitemaps | Only canonical MyCovai URLs; no OMR legacy URLs |

| `info/sitemap.xml` | Replaced with Covai discover URLs only |



## Pre-flight (run before GSC submit)



```bash

php dev-tools/gsc-prep-sitemap-cli.php          # local generator checks

php dev-tools/gsc-prep-sitemap-cli.php --live   # also probe mycovai.in (after deploy)

```



The `--live` run also checks **301 redirects** on retired OMR URLs and confirms priority pages return 200.



**Live issue (Jun 2026):** Production sitemap index may still list removed modules (`pentahive`, `election-blo-details`) until `weblog/generate-sitemap-index.php` and `.htaccess` (`pages-sitemap.xml`) are deployed. GSC will report sub-sitemap 404s until fixed.



## GSC actions (do within 48h of deploy)



1. **Deploy** updated `weblog/generate-sitemap-index.php`, `weblog/generate-static-sitemap.php`, root `.htaccess`, `robots.txt`

2. **Pre-flight** — `php dev-tools/gsc-prep-sitemap-cli.php --live` must pass all sub-sitemap 200 checks

3. **Submit sitemap** — [Search Console Sitemaps](https://search.google.com/search-console/sitemaps) → add `sitemap.xml` (full URL: `https://mycovai.in/sitemap.xml`)

4. **Remove stale entries** in GSC if previously submitted: `pentahive/sitemap.xml`, `election-blo-details/sitemap.xml`

5. **Inspect key redirects** — URL Inspection on 5–10 retired OMR URLs; confirm **301** to Covai target (or rely on `--live` redirect checks)

6. **Do not use "Remove URLs"** for pages that have 301 redirects

7. **Monitor** Coverage → "Not found (404)" and "Page with redirect" for 2–4 weeks

8. **Request indexing** for `/`, `/directory/`, `/jobs/`, `/coimbatore-news.php`



### GSC manual checklist (copy into Search Console)



```

Property: https://mycovai.in/



Sitemaps → Remove (if listed):

  - https://mycovai.in/pentahive/sitemap.xml

  - https://mycovai.in/election-blo-details/sitemap.xml



Sitemaps → Add:

  - sitemap.xml



URL Inspection → Request indexing:

  - https://mycovai.in/

  - https://mycovai.in/directory/

  - https://mycovai.in/jobs/

  - https://mycovai.in/coimbatore-news.php

```



## Redirect priority



- **Always prefer 301** over 404 when a sensible Covai page exists

- **410** only for spam/duplicate with no audience (rare)

- **404** only when no topical match — our custom 404 recovers users via nav links



## Sitemap hygiene



```bash

# Static hub (no DB):

php weblog/generate-static-sitemap.php > sitemap.xml



# All modules (needs DB — use live host for production parity):

DB_HOST=mycovai.in php dev-tools/generate-all-sitemaps-cli.php

php dev-tools/audit-sitemap-cli.php

```



Regenerate after bulk URL changes. Production serves `/sitemap.xml` as a **sitemap index** (sub-sitemaps per module). The repo `sitemap.xml` is the static hub URL list used by the audit CLI.



## Content & internal links



- Internal links use `/discover/*` not `/info/onboarding/*` (legacy paths 301 to discover)

- Job schema uses Coimbatore localities (`getCovaiPostalMap()`)

- Social icons use config (`SOCIAL_*` in `core/mycovai-config.php`) — no hardcoded MyOMR profiles



## Expected GSC timeline



| Week | What you'll see |

|------|-----------------|

| 1 | Spike in "Page with redirect"; some 404s on obscure OMR URLs |

| 2–4 | Redirect URLs drop from index; Covai URLs replace rankings |

| 4+ | Stabilised coverage; monitor impressions on `/jobs-in-coimbatore.php`, directory hubs |



## Fail-safe pages



| URL | Purpose |

|-----|---------|

| `/404.php` | Custom not-found with Covai nav |

| `/500.php` | Server error + contact email |

| `/thank-you.php` | Newsletter subscribe confirmation |



## Optional follow-ups



- Add `SOCIAL_FACEBOOK` / `SOCIAL_INSTAGRAM` when Covai profiles are live

- Rename CSS files with `omr` in filename (cosmetic; no SEO impact)

- Archive grep-driven doc updates under `docs/archive/`

