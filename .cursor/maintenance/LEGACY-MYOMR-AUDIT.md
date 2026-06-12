# Legacy MyOMR & cross-site audit

**Last updated:** 2026-05-29 (P1 + P2 + P4 sprints complete)  
**Scope:** Live PHP/HTML (excludes `_archive/`, `docs/`, `dev-tools/`)  
**Verify:** `php dev-tools/audit-legacy-myomr-cli.php` → **0 actionable files** (allowlisted infra only)

---

## Sprint summary

| Sprint | Done |
|--------|------|
| **P1** | info/events redirects, onboarding rebrand, 404/500, sitemaps, admin/hostels sweep |
| **P2** | Deleted stale policy/contact pages; discover/SDG CSS vars; events analytics; article-report email; restaurants meta; admin commonlogin |
| **P4** | Renamed job CSS/JS (`covai-jobs-unified-design.css`, `job-listings-covai.css`, `job-search-covai.js`); news bulletin + events badge assets; audit CLI allowlist |

---

## Intentional allowlist (not bugs)

| File | Why |
|------|-----|
| `core/ad-registry.php` | Inactive sister-site slot linking to myomr.in |
| `core/admin-config.php`, `app-secrets.php`, `env.php` | `MYOMR_*` backward-compat aliases for cPanel env |
| `core/omr-connect.php` | Legacy DB username prefix `metap8ok_myomr_admin` |
| `local-news/article-sports-seo-enhancement.php` | Factual Chennai/OMR in athlete JSON-LD |
| `weblog/create-tables-remote.php` | Dev one-off — delete on server after use |

---

## Deleted (301 in `.htaccess`)

- `weblog/contact-my-omr-team.php` → `/contact.php`
- `weblog/general-data-policy-of-my-omr.php` → `/data-policy.php`
- `info/website-privacy-policy-of-my-omr.php` → `/privacy-policy.php`
- `free-ads-chennai/` → `/`
- P1: OMR info pages, `events/`, `discover/it-parks-in-omr.php`

---

## Remaining P3 (optional / ops)

| Item | Notes |
|------|-------|
| Rename `core/omr-connect.php` | New code uses `covai-connect` alias when added |
| Hide legacy admin “News Bulletin” nav | `admin/config/navigation.php` |
| **Live deploy + E2E** | `docs/inbox/E2E-TEST-CHECKLIST.md` |
| **Rotate production secrets** | `docs/deployment/MYCOVAI-DEPLOYMENT-NOTES.md` |
| GSC resubmit sitemap | `docs/inbox/SEO-MIGRATION-GSC.md` |
| Inner-page design refresh | MYCOVAI-NEXT-STEPS-PLAN |
| Delete `weblog/create-tables-remote.php` on production | Security |

---

## Verification

```bash
php dev-tools/audit-legacy-myomr-cli.php
php dev-tools/test-phase4-branding-cli.php
php dev-tools/audit-sitemap-cli.php
php dev-tools/generate-all-sitemaps-cli.php   # needs DB env
```
