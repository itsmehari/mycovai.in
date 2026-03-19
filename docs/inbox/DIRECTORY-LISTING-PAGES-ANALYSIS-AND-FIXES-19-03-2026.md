# Directory Listing Pages – Analysis and Fixes (19-03-2026)

## Summary

Deep analysis was done on directory listing pages for (1) **header/footer consistency** with the main index page and (2) **remaining MyOMR/OMR/Chennai references** in copy, meta, and schema. Fixes were applied so all directory pages use the same header/footer pattern as the main site and all user-facing text and meta refer to Coimbatore/MyCovai.

---

## 1. Header and footer pattern (main index vs directory)

### Main index (`index.php`)

- **Header:** Inline `homepage-header` (MyCovai logo, “Coimbatore Directory & Listing”, nav: Home, About, Listing, Blog, Contact, Add Listing).
- **Footer:** `components/footer.php`.
- **CSS:** `assets/css/homepage-directone.css` (Fraunces + Poppins, header styles).

### Issues found on directory pages

- **Three different navs:** Some pages used `omr-listings-nav.php` (old OMR-style bar with wrong links), some only `directory-nav.php` (subnav only, no main header), some `main-nav.php` (green theme, different from homepage).
- **Missing main header:** Many list pages had no site header (no MyCovai logo / main nav), only a category subnav or the old OMR bar.
- **Duplicate skip-link:** Several pages included `skip-link.php` twice.
- **TradingView widget:** Present on several list pages (atms, parks, government-offices, industries, schools, hospitals, it-companies); not relevant to directory and removed for consistency.
- **Footer:** Most directory pages already used `components/footer.php`; no change needed.
- **WhatsApp link:** Some pages used an old group link; standardized to `https://wa.me/919445088028` (MyCovai contact) with `rel="noopener"` and `aria-label`.

### Fix: shared directory header

- **New component:** `components/directory-header.php` – includes `homepage-header.php` + `directory-nav.php`.
- **Directory subnav:** `components/directory-nav.php` updated to add **IT Parks** (`/directory/it-parks.php`).
- **List pages** now use:
  - In `<head>`: `head-resources.php` + `<link rel="stylesheet" href="/assets/css/homepage-directone.css">` where needed.
  - After `<body>`: one `skip-link.php`, WhatsApp float, then `directory-header.php`, then main content.
- **Removed:** `omr-listings-nav.php` from all directory list and detail pages that used it; TradingView widget blocks removed; duplicate `skip-link` removed; `footer.css` path fixed to `/directory/footer.css` where used.

### Pages updated for header/footer pattern

| Page | Change |
|------|--------|
| `directory/parks.php` | TradingView + `omr-listings-nav` → `directory-header`; one skip-link; WhatsApp link; `footer.css` path. |
| `directory/atms.php` | TradingView + `omr-listings-nav` → `directory-header`; meta + head-resources added; one skip-link; WhatsApp; `footer.css` path. |
| `directory/government-offices.php` | `directory-nav` only → `directory-header`; homepage-directone.css; TradingView removed; duplicate skip-link removed. |
| `directory/industries.php` | Same as government-offices. |
| `directory/schools.php` | TradingView + `directory-nav` → `directory-header`; skip-link + WhatsApp; intro copy already Coimbatore. |
| `directory/hospitals.php` | Same as schools. |
| `directory/it-companies.php` | TradingView + `directory-nav` → `directory-header`; one skip-link; WhatsApp; og/twitter image. |
| `directory/it-parks.php` | `omr-listings-nav` → `directory-header`; og/twitter image. |
| `directory/it-park.php` (detail) | `omr-listings-nav` → `directory-header`; homepage-directone.css; og:image with site/park image. |

---

## 2. OMR / MyOMR / Chennai references

### Copy and schema

- **parks.php:** JSON-LD `ItemList` had `'name' => 'Parks on OMR, Chennai'` → changed to **`'Parks in Coimbatore'`**.
- **it-companies.php:** “Nearby IT Parks” linked to `/directory/it-parks-in-omr.php` and `/it-parks` → changed to **`/directory/it-parks.php`** (it-parks-in-omr.php is a 301 redirect to it-parks.php).
- **schools.php:** Duplicate/conflicting meta (generic “Coimbatore news, Search, Events…”) and hardcoded `My-OMR-Logo.jpg` in second og/twitter set → removed overrides; kept schools-specific title/description and SITE_LOGO_URL for images; fixed “Coimbatore (Coimbatore” typo to “Coimbatore (Covai)”.

### Meta and og:image / twitter:image

- Replaced all **hardcoded** `My-OMR-Logo.jpg` or `My-OMR-Idhu-Namma-OMR-Logo.jpg` in directory with:
  - `https://mycovai.in<?php echo defined('SITE_LOGO_URL') ? SITE_LOGO_URL : '/My-OMR-Logo.jpg'; ?>`
  so the logo comes from config (single source).
- **Pages adjusted:** schools.php, hospitals.php, best-schools.php, government-offices.php, industries.php, atms.php, parks.php, it-companies.php, it-parks.php, it-park.php, it-company.php, directory-template.php, omr-road-schools.php.
- **related-cards.php:** Default `$fallbackImage` when not set is now `SITE_LOGO_URL` if defined, else `/My-OMR-Logo.jpg`.

### CSS class names

- Classes like `.text-primary-omr`, `.bg-primary-omr`, `.bg-secondary-omr` are still used; they are styled in `assets/css/directory-list.css` and `assets/css/components.css` with `--mycovai-primary` (and similar) so **visual branding is already MyCovai**. No change made to class names to avoid layout/script breakage.

---

## 3. Per-page fix summary

| File | Header/nav | OMR/copy/schema | Meta/og/image | Other |
|------|------------|------------------|----------------|-------|
| parks.php | directory-header, TradingView removed, 1 skip-link | Schema: “Parks in Coimbatore” | og/twitter already SITE_LOGO_URL | footer.css path |
| atms.php | directory-header, meta+head-resources, TradingView removed | — | — | footer.css path |
| government-offices.php | directory-header, TradingView removed | — | — | — |
| industries.php | directory-header, duplicate nav removed | — | — | — |
| schools.php | directory-header, TradingView removed, skip-link + WhatsApp | Duplicate meta removed; Coimbatore (Covai) | og/twitter SITE_LOGO_URL; duplicate og/twitter removed | — |
| hospitals.php | directory-header, TradingView removed, WhatsApp | — | og/twitter SITE_LOGO_URL | — |
| it-companies.php | directory-header, TradingView removed | Link it-parks-in-omr → it-parks.php | og/twitter absolute URL + SITE_LOGO_URL | — |
| it-parks.php | omr-listings-nav → directory-header | — | og/twitter SITE_LOGO_URL | — |
| it-park.php | omr-listings-nav → directory-header, homepage-directone.css | — | og:image full URL (park image or SITE_LOGO_URL) | — |
| directory-template.php | Already main-nav | — | og/twitter SITE_LOGO_URL | — |
| omr-road-schools.php | — | — | og/twitter SITE_LOGO_URL | — |
| best-schools.php | — | — | Already SITE_LOGO_URL | — |
| it-company.php | — | — | og:image absolute + SITE_LOGO_URL | — |
| components/related-cards.php | — | — | Default fallbackImage uses SITE_LOGO_URL | — |
| components/directory-nav.php | — | — | — | IT Parks link added |

---

## 4. Files left as-is (intentional)

- **core/omr-connect.php** – Filename kept for compatibility; it loads `mycovai-config.php` and is the DB connection used by the site.
- **directory-config.php** – Fallback table names still mention `omr*` for legacy; `covai_table()` is used when available.
- **get-listed.php** – Table `omr_it_company_submissions` unchanged (DB schema); copy and nav already MyCovai.
- **generate-it-parks-sitemap.php** / **data/it-parks-data.php** – Still reference `omr_it_parks_*` in variable/function names for compatibility with existing includes; data is covai_* in DB.
- **it-parks-in-omr.php** – Kept as 301 redirect to `/directory/it-parks.php` for backward compatibility.
- **Locality pages** under `directory/locality/` – Still `require omr-connect.php`; no user-facing OMR text found in quick scan; can be standardized in a later pass.

---

## 5. How to verify

1. **Header/footer:** Open main index and any directory list page (e.g. `/directory/schools.php`, `/directory/parks.php`). Same MyCovai header (logo + “Coimbatore Directory & Listing”) and same category subnav; same footer.
2. **No OMR in copy:** Search directory for “OMR”, “MyOMR”, “Chennai” in user-facing strings; only legacy config/redirect/DB names should remain.
3. **Meta:** View source on a few directory pages; og:image and twitter:image should be `https://mycovai.in` + SITE_LOGO_URL (or park/listing image for detail pages).
4. **Links:** “IT Parks” in subnav and “Nearby IT Parks” on it-companies go to `/directory/it-parks.php`.

---

## 6. Suggested follow-ups

- **directory/index.php** – Currently uses `main-nav.php`; consider switching to `directory-header.php` (homepage-header + directory-nav) so the directory hub matches list pages.
- **Banks list** – `directory/banks.php` uses `directory-nav`; add `directory-header` + homepage-directone.css for full consistency.
- **Restaurants** – Already uses `main-nav`; consider `directory-header` for consistency.
- **Detail pages** (school, bank, hospital, industry, atm, restaurant, government-office, park) – Several still pass `$fallbackImage = '/My-OMR-Logo.jpg'` to related-cards; with the new default in `related-cards.php` (SITE_LOGO_URL), they can omit setting `$fallbackImage` or set it to `SITE_LOGO_URL` for clarity.
- **docs/README.md** – Project name and intro still say “MyOMR.in” and “OMR corridor”; update to MyCovai/Coimbatore when rebranding docs.
