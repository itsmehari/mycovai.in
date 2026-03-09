# MyCovai branding config

**File:** `core/mycovai-config.php`

This file is the **single source** for site name, domain, region, contact, and default SEO. It is loaded automatically when you include `core/omr-connect.php`.

---

## What it defines

| Constant | Purpose | Example |
|----------|---------|--------|
| `SITE_NAME` | Brand name | `MyCovai` |
| `SITE_TAGLINE` | Short tagline | `Coimbatore Directory & Listings` |
| `SITE_REGION` | Full region name | `Coimbatore` |
| `SITE_REGION_SHORT` | Short name | `Covai` |
| `SITE_DOMAIN` | Base URL (no trailing slash) | `https://mycovai.in` |
| `SITE_CANONICAL_BASE` | Used by `url-helpers.php` for canonicals | Same as `SITE_DOMAIN` |
| `CONTACT_EMAIL` | Main contact email | `mycovai@gmail.com` |
| `CONTACT_PHONE` | Main phone (digits) | `9445088028` |
| `CONTACT_PHONE_FULL` | Formatted phone | `+91 94450 88028` |
| `SOCIAL_*` | Optional social URLs | e.g. `SOCIAL_WHATSAPP` |
| `SITE_DEFAULT_TITLE` | Default `<title>` when page doesn’t set one | — |
| `SITE_DEFAULT_DESCRIPTION` | Default meta description | — |
| `SITE_DEFAULT_KEYWORDS` | Default meta keywords | — |
| `SITE_OG_SITE_NAME` | Default `og:site_name` | — |
| `SITE_LOGO_URL` | Default logo path (e.g. for og:image, nav) | `/My-OMR-Logo.jpg` until MyCovai logo exists |
| `GA_MEASUREMENT_ID` | Google Analytics measurement ID | Used by `components/analytics.php` |
| `SITE_AREAS` | List of localities for dropdowns/filters (Phase 5.1) | Array: RS Puram, Gandhipuram, Peelamedu, etc. |

---

## How to use it

1. **New pages / components**  
   Include `core/omr-connect.php` (or ensure it’s already included). Then use the constants, e.g.:
   - `echo SITE_NAME;`
   - `$page_title = SITE_NAME . ' – Jobs in ' . SITE_REGION_SHORT;`
   - `CONTACT_EMAIL`, `CONTACT_PHONE` for contact blocks.

2. **Canonical URLs**  
   `core/url-helpers.php` uses `SITE_CANONICAL_BASE` (set in this config). Call `get_canonical_base()` or `get_canonical_url()` as usual.

3. **Changing branding**  
   Edit only `core/mycovai-config.php`. Do not scatter site name, domain, or contact across other files.

---

## Where it’s used (after Phase 1)

- **Homepage** (`index.php`): title, description, keywords, og:site_name from config.
- **URL helpers**: canonical base from config (via `omr-connect.php` load).
- **Other pages**: can use the same constants for titles and contact (Phase 2+).

---

**See also:** `docs/MYCOVAI-NEXT-STEPS-PLAN.md` (Phase 1 complete; Phase 2 uses this config in shared components).
