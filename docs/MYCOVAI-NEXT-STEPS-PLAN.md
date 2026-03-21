# MyCovai – What to Do Next (Plan)

**Last updated:** Feb 2025

This plan picks up after the **homepage** is fully Covai (branding, design, footer). It lays out the next steps in order so the rest of the site and operations align with MyCovai.

---

## ✅ Done So Far

- Homepage redesigned (Directone-style, editorial-meets-local).
- Homepage content and meta 100% Covai (titles, hero, sections, subscribe).
- Homepage uses Covai footer (`footer-covai.php`).
- Design system in place (Fraunces + Poppins, warm palette, motion).
- Design plan doc: `docs/HOMEPAGE-DESIGN-PLAN.md`.
- Project review: `docs/MYCOVAI-PROJECT-REVIEW-AND-START.md`.

---

## Phase 1: One Place for Branding (Config) ✅ Done

**Goal:** Single source for site name, domain, contact, and region so every page can stay in sync.

| Task | Status | What was done |
|------|--------|----------------|
| 1.1 Add site config | ✅ | Created `core/mycovai-config.php` with `SITE_NAME`, `SITE_DOMAIN`, `SITE_REGION`, `CONTACT_EMAIL`, `CONTACT_PHONE`, social URLs, and default SEO constants. Config is loaded via `core/omr-connect.php`. |
| 1.2 Use config on homepage | ✅ | `index.php` uses `SITE_DEFAULT_TITLE`, `SITE_DEFAULT_DESCRIPTION`, `SITE_DEFAULT_KEYWORDS`, `SITE_OG_SITE_NAME`; canonical comes from `get_canonical_base()` (which uses `SITE_CANONICAL_BASE` from config). |
| 1.3 Document it | ✅ | Added `docs/BRANDING-CONFIG.md` with constants list and usage; new pages and components should use this config for branding. |

**Outcome:** Changing “MyCovai” or contact details happens in one file (`core/mycovai-config.php`).

---

## Phase 2: Shared Components (Nav, Meta, Footer) ✅ Done

**Goal:** When users go to other pages (About, Listing, etc.), they see MyCovai in the header and footer, not OMR.

| Task | Status | What was done |
|------|--------|----------------|
| 2.1 Meta & defaults | ✅ | `components/meta.php` uses config when `MYCOVAI_CONFIG_LOADED`: default title, description, keywords, og:*, twitter:*, schema Organization (name, logo, sameAs). Falls back to OMR defaults when config not loaded. |
| 2.2 Main nav | ✅ | `components/main-nav.php` is config-driven: when config loaded, logo uses `SITE_LOGO_URL` and `SITE_NAME`, contact uses `CONTACT_EMAIL` / `CONTACT_PHONE_FULL`, labels show “Explore Covai”, “About”, “Find Jobs in Covai”. Same links and structure. |
| 2.3 Footer | ✅ | `components/footer.php` checks `MYCOVAI_CONFIG_LOADED`; if set, includes `footer-covai.php` and returns. Homepage now includes `footer.php` so one include everywhere. |
| 2.4 Analytics | ✅ | `components/analytics.php` uses `GA_MEASUREMENT_ID` from config when defined; fallback to existing ID. `GA_MEASUREMENT_ID` added to `core/mycovai-config.php`. |

**Outcome:** Any page that includes `core/omr-connect.php` (and then meta, main-nav, footer, analytics) gets full MyCovai branding.

---

## Phase 3: Key Entry Pages (Copy & Titles) ✅ Done

**Goal:** First pages users hit after the homepage (directory, about, contact) are clearly Coimbatore/Covai.

| Task | Status | What was done |
|------|--------|----------------|
| 3.1 Directory hub | ✅ | `omr-listings/index.php`: Loads `omr-connect.php`, title “Explore Covai \| MyCovai”, H1 “Explore Coimbatore”, Coimbatore intro; uses `main-nav` and footer. Category links unchanged. |
| 3.2 About | ✅ | Root `about-myomr-omr-community-portal.php`: MyCovai vision/mission, What We Do, Areas (RS Puram, Gandhipuram, etc.), CTA and Get in Touch from config. Uses main-nav, footer, analytics. |
| 3.3 Contact | ✅ | Root `contact-my-omr-team.php`: Title “Contact MyCovai”, Coimbatore copy; email/phone from config; main-nav and footer. |
| 3.4 Legal | ✅ | Root copies with config-driven branding: `terms-and-conditions-my-omr.php`, `website-privacy-policy-of-my-omr.php`, `general-data-policy-of-my-omr.php`, `webmaster-contact-my-omr.php`. All use SITE_NAME, CONTACT_EMAIL, main-nav, footer. |

**Outcome:** Directory, About, Contact, and legal pages are clearly MyCovai. File names kept for existing links.

---

## Phase 4: Feature Modules (Jobs, Events, Hostels, Coworking) ✅ Done

**Goal:** Titles, headings, and key copy in each module say Covai/Coimbatore when config is loaded; links and behaviour unchanged.

| Task | Status | What was done |
|------|--------|----------------|
| 4.1 Jobs | ✅ | `omr-local-job-listings/index.php`: config-aware title, description, H1, placeholder, CTA, schema. `post-job-omr.php`, `employer-landing-omr.php`, `job-detail-omr.php`: SITE_NAME / SITE_REGION in titles and copy. `includes/seo-helper.php`: og:site_name from config. |
| 4.2 Events | ✅ | `omr-local-events/index.php`: “Events in Covai”, Coimbatore SEO and header. `post-event-covai.php`, `event-detail-covai.php`: titles and subtitles from config; event schema addressLocality uses region. |
| 4.3 Hostels & PGs | ✅ | `omr-hostels-pgs/index.php`: config-aware title, description, H1, subtitle, CTA, schema; localities dropdown shows Coimbatore areas when MYCOVAI_CONFIG_LOADED. |
| 4.4 Coworking | ✅ | `omr-coworking-spaces/index.php`: same pattern as hostels; Covai titles, intro, localities, CTA. |
| 4.5 Discover | ✅ | `discover-myomr/overview.php`, `features.php`, `pricing.php`, `getting-started.php`: load omr-connect; titles and body copy use SITE_NAME, SITE_REGION_SHORT, SITE_REGION; “Discover MyCovai” when config loaded. |

**Outcome:** When `core/omr-connect.php` (and thus `mycovai-config.php`) is loaded, every major feature shows Covai/Coimbatore in titles and copy. URLs and logic unchanged.

---

## Phase 5: Data & SEO ✅ Done

**Goal:** Site is wired for Coimbatore in data and search.

| Task | Status | What was done |
|------|--------|----------------|
| 5.1 List of Areas | ✅ | Added `SITE_AREAS` array in `core/mycovai-config.php` (RS Puram, Gandhipuram, Saibaba Colony, Peelamedu, Race Course, Ukkadam, Saravanampatti, Kovaipudur, Tatabad, Avinashi Road, Trichy Road, Sitra, Kuniyamuthur). Hostels and Coworking index pages use `SITE_AREAS` for locality dropdown when config loaded. |
| 5.2 Sitemap | ✅ | `weblog/generate-sitemap-index.php` loads `mycovai-config.php` before url-helpers so `get_canonical_base()` uses `SITE_CANONICAL_BASE` (MyCovai domain). Sitemap URLs use correct domain. |
| 5.3 Robots | ✅ | Root `robots.txt` updated: single block, sitemap `https://mycovai.in/sitemap.xml`, disallow admin/dev-tools/weblog/backups/cgi-bin. Removed duplicate blocks and crawl-delay. |
| 5.4 Schema | ✅ | `components/organization-schema.php`: when `MYCOVAI_CONFIG_LOADED`, uses `SITE_NAME`, `SITE_LOGO_URL`, config social URLs for `sameAs`; adds `address` (addressLocality Coimbatore, addressRegion Tamil Nadu, addressCountry IN). Falls back to MyOMR when config not loaded. |

**Outcome:** Search and dropdowns reflect Coimbatore; sitemap and robots point to MyCovai domain; Organization schema shows MyCovai and Coimbatore.

---

## Phase 6: URL / Folder Renames ✅ Done

| Old path | New path |
|----------|----------|
| `omr-listings` | **directory** |
| `omr-local-job-listings` | **jobs** |
| `omr-local-events` | **local-events** |
| `omr-hostels-pgs` | **hostels-pgs** |
| `omr-coworking-spaces` | **coworking-spaces** |
| `discover-myomr` | **discover** |

Root `.htaccess` 301 redirects, RewriteRules, folder renames, sitemap, robots.txt, and all PHP link references updated site-wide. Module `.htaccess` (hostels-pgs, coworking-spaces) use new base paths. Component `components/omr-listings-nav.php` unchanged. Backups and `@tocheck` not modified.

---

## Phase 6 (remaining): Optional / Later

| Task | Notes |
|------|--------|
| New Coimbatore pages | e.g. “Areas we cover” with RS Puram, Gandhipuram, etc. |
| Design refresh of inner pages | Apply homepage design system (Fraunces, warm palette) to directory, jobs, events. |
| Pentahive / other services | Rebrand or remove if not relevant to MyCovai. |
| Admin labels | Replace “OMR” in admin UI with “Covai” where it’s user-facing. |

---

## Suggested Order (If Doing Step by Step)

1. **Phase 1** (config) – foundation for the rest.
2. **Phase 2** (meta + nav + footer) – so every page you touch next already looks Covai.
3. **Phase 3** (directory, about, contact, legal) – biggest impact for “is this Covai?”.
4. **Phase 4** (jobs, events, hostels, coworking, discover) – full feature rebrand.
5. **Phase 5** (areas, sitemap, robots, schema) – data and SEO.
6. **Phase 6** URL renames done; optional items (design refresh, admin labels, Pentahive) as needed.

---

## Quick Reference: Files to Touch First

| Phase | Files / areas |
|-------|----------------|
| 1 | `core/mycovai-config.php` (new), optionally `core/omr-connect.php` or `core/url-helpers.php` |
| 2 | `components/meta.php`, `components/main-nav.php` or new `main-nav-covai.php`, `components/footer.php` or use `footer-covai.php` everywhere, `components/analytics.php` |
| 3 | `directory/index.php` (was omr-listings), `about-myomr-omr-community-portal.php`, `contact-my-omr-team.php`, terms/privacy/webmaster pages |
| 4 | `jobs/index.php`, `local-events/index.php`, `hostels-pgs/index.php`, `coworking-spaces/index.php`, `discover/*.php` |
| 5 | DB “List of Areas”, `sitemap.xml`, `robots.txt`, `components/organization-schema.php` or equivalent |

You can stop after Phase 3 for a “good enough” Covai site, and do Phases 4–5 when you’re ready to rebrand all features and data.
