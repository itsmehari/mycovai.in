# SEO migration & Search Console — minimise visitor loss

After the MyOMR → MyCovai rebrand and URL retirements, expect temporary GSC noise (404s, redirect chains, coverage drops). This runbook minimises traffic loss.

## What we did (technical)

| Change | Mitigation |
|--------|------------|
| Deleted OMR `info/*`, `events/`, `discover/it-parks-in-omr.php` | **301** rules in root `.htaccess` to Covai equivalents |
| Renamed job/event paths `*-omr.php` → `*-covai.php` | **301** per file in `.htaccess` |
| `omr-listings`, `pentahive`, BLO search | **301** to `/directory/`, `/`, elections hub |
| Custom **404.php** / **500.php** | Helpful links to directory, jobs, news — keeps users on site |
| Fresh **sitemap.xml** + module sitemaps | Only canonical MyCovai URLs; no OMR legacy URLs |
| `info/sitemap.xml` | Replaced with Covai info URLs only |

## Pre-flight (run before GSC submit)

```bash
php dev-tools/gsc-prep-sitemap-cli.php          # local generator checks
php dev-tools/gsc-prep-sitemap-cli.php --live   # also probe mycovai.in (after deploy)
```

**Live issue (Jun 2026):** Production sitemap index may still list removed modules (`pentahive`, `election-blo-details`) until `weblog/generate-sitemap-index.php` and `.htaccess` (`pages-sitemap.xml`) are deployed. GSC will report sub-sitemap 404s until fixed.

## GSC actions (do within 48h of deploy)

1. **Deploy** updated `weblog/generate-sitemap-index.php`, `weblog/generate-static-sitemap.php`, root `.htaccess`, `robots.txt`
2. **Pre-flight** — `php dev-tools/gsc-prep-sitemap-cli.php --live` must pass all sub-sitemap 200 checks
3. **Submit sitemap** — [Search Console Sitemaps](https://search.google.com/search-console/sitemaps) → add `sitemap.xml` (full URL: `https://mycovai.in/sitemap.xml`)
4. **Remove stale entries** in GSC if previously submitted: `pentahive/sitemap.xml`, `election-blo-details/sitemap.xml`
5. **Inspect key redirects** — URL Inspection on 5–10 retired OMR URLs; confirm **301** to Covai target
6. **Do not use "Remove URLs"** for pages that have 301 redirects
7. **Monitor** Coverage → "Not found (404)" and "Page with redirect" for 2–4 weeks
8. **Request indexing** for `/`, `/directory/`, `/jobs/`, `/coimbatore-news.php`

## Redirect priority

- **Always prefer 301** over 404 when a sensible Covai page exists
- **410** only for spam/duplicate with no audience (rare)
- **404** only when no topical match — our custom 404 recovers users via nav links

## Sitemap hygiene

```bash
php dev-tools/generate-all-sitemaps-cli.php
php dev-tools/audit-sitemap-cli.php
```

Regenerate after bulk URL changes. Production serves `/sitemap.xml` as a **sitemap index** (sub-sitemaps per module). The repo `sitemap.xml` is the static hub URL list used by the audit CLI.

## Content & internal links

- Update internal links to `/discover/*` not `/info/onboarding/*` (redirects exist but direct links are faster for users and crawlers)
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
