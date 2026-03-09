# MyOMR → MyCovai URL & Branding Cleanup — Complete

**Completed:** 2025-02-25

## Summary

All primary URLs, internal links, and core branding have been migrated from MyOMR/OMR references to MyCovai/Covai.

---

## 1. New Canonical Pages (Root)

| Old URL | New URL |
|---------|---------|
| `/about-myomr-omr-community-portal.php` | `/about.php` |
| `/contact-my-omr-team.php` | `/contact.php` |
| `/webmaster-contact-my-omr.php` | `/webmaster-contact.php` |
| `/terms-and-conditions-my-omr.php` | `/terms-and-conditions.php` |
| `/website-privacy-policy-of-my-omr.php` | `/privacy-policy.php` |
| `/general-data-policy-of-my-omr.php` | `/data-policy.php` |

## 2. 301 Redirects (.htaccess)

Permanent redirects are in place for:

- `about-myomr-omr-community-portal.php` → `/about.php`
- `contact-my-omr-team.php` → `/contact.php`
- `webmaster-contact-my-omr.php` → `/webmaster-contact.php`
- `terms-and-conditions-my-omr.php` → `/terms-and-conditions.php`
- `website-privacy-policy-of-my-omr.php` → `/privacy-policy.php`
- `general-data-policy-of-my-omr.php` → `/data-policy.php`
- `info/website-privacy-policy-of-my-omr.php` → `/privacy-policy.php`

## 3. Updated Internal Links

- **Components:** main-nav.php, footer.php, footer-covai.php, navbar.php, discover-nav.php, sidebar.php
- **Pages:** index.php, about.php, discover/* (sdg-education-schools, sustainable-development-goals, support, community, overview, features, getting-started)
- **Directory:** school.php, restaurant.php, hospital.php, industry.php, it-company.php, it-companies.php, it-park.php, it-parks-in-omr.php
- **Listings:** search-and-post-jobs, digital-marketing-junior-job-vacancy, tutions-classes, sell-rent-property, add-space (coworking), add-property (hostels), post-job-omr
- **Local news:** all article pages updated to `/contact.php`, `/terms-and-conditions.php`, `/privacy-policy.php`, `/data-policy.php`, `/webmaster-contact.php`
- **Other:** info/pallikaranai-marsh-ramsar-wetland.php, local-events/admin/email-digest.php

## 4. Branding Updates

- **Admin:** `MyOMR Admin` → `MyCovai Admin` (admin/layout/header.php)
- **Admin auth:** Comment updated in core/admin-auth.php
- **Article SEO:** Fallbacks `MyOMR Editorial Team`, `MyOMR Chennai` → `MyCovai Editorial Team`, `MyCovai Coimbatore`; schema/social `MyOMR` → `MyCovai`; Twitter @MyomrNews → @MyCovai
- **News bulletin:** `MyOMR News Bulletin` → `MyCovai News Bulletin` in components/myomr-news-bulletin.php
- **Events digest:** `MyOMR Events` → `MyCovai Events` in local-events/admin/email-digest.php
- **SDG pages:** `MyOMR` → `MyCovai` in discover/sdg-education-schools.php
- **Environment:** `SetEnv MYOMR_ENV` → `SetEnv MYCOVAI_ENV` in .htaccess

## 5. Sitemap

- sitemap.xml: domain `myomr.in` → `mycovai.in`, old paths → new paths, `discover-myomr` → `discover`

## 6. Old Files Removed

- about-myomr-omr-community-portal.php
- contact-my-omr-team.php
- webmaster-contact-my-omr.php
- terms-and-conditions-my-omr.php
- website-privacy-policy-of-my-omr.php
- general-data-policy-of-my-omr.php

## 7. Not Changed (Intentionally)

- **Admin constants:** `MYOMR_ADMIN_*`, `MYOMR_EDITOR_*` in core/admin-config.php (env/config override would be needed)
- **Component filenames:** `myomr-news-bulletin.php`, `myomr-news-bulletin.css`, `myomr-news-bulletin.js` (content updated; filenames kept for compatibility)
- **weblog/contact-my-omr-team.php:** Legacy page; consider redirecting or replacing later
- **Backups, @tocheck, docs:** Left as-is; can be cleaned up separately

---

## Testing Checklist

- [ ] Visit `/about.php` and confirm content renders
- [ ] Visit `/contact.php` and confirm content renders
- [ ] Visit `/about-myomr-omr-community-portal.php` and confirm 301 to `/about.php`
- [ ] Visit `/contact-my-omr-team.php` and confirm 301 to `/contact.php`
- [ ] Confirm nav links point to new URLs
- [ ] Confirm footer links (Terms, Privacy, Policy, Webmaster) use new URLs
- [ ] Run site in browser and check console/network for broken links
