# MyCovai Project – Review, Intent & First Steps

**Purpose:** This folder is a copy of the myomr.in codebase. The goal is to create **MyCovai** using the same code infrastructure, then customize and improve it. This document reviews the code and intent, maps the project structure and links, and recommends what to do at the beginning.

**Last updated:** Feb 16, 2025

---

## 1. Intent of the Project

### MyOMR.in (source)

- **What it is:** A local news and community platform for **Old Mahabalipuram Road (OMR)**, Chennai.
- **Audience:** Residents, job seekers, businesses, and visitors along the OMR corridor.
- **Core value:** One hub for local news, events, jobs, directories (schools, banks, hospitals, restaurants, etc.), hostels/PGs, coworking spaces, and community engagement.

### MyCovai (target)

- **What it should be:** The same kind of platform, but for **Coimbatore (Covai)** instead of OMR.
- **Reuse:** Same PHP/MySQL/Bootstrap stack, folder structure, components, and feature set.
- **Customise:** Brand (MyCovai), geography (Coimbatore areas/localities), content, and later improvements.

So the intent is: **clone the platform, rebrand to Coimbatore, then iterate.**

---

## 2. Code Review Summary

### Tech stack (unchanged)

| Layer      | Technology                          |
|-----------|--------------------------------------|
| Frontend  | HTML5, CSS3, Bootstrap 4.6.1, Vanilla JS, jQuery |
| Backend   | PHP (procedural)                     |
| Database  | MySQL (phpMyAdmin)                   |
| Hosting   | cPanel shared hosting                |
| Assets    | Self-hosted in `/assets`, CDN for Bootstrap/Font Awesome |

### Root structure (high level)

```
_Root/
├── index.php              # Homepage
├── core/                  # DB connection, shared logic
│   └── omr-connect.php    # MySQL connection (must be reconfigured for MyCovai)
├── components/            # Reusable layout
│   ├── main-nav.php       # Primary + secondary nav, quick-action pills
│   ├── footer.php         # Footer with links, subscribe, legal
│   ├── meta.php, analytics.php, head-resources.php
│   └── ...
├── admin/                 # Admin CRUD (session-protected)
├── assets/css/            # main.css + others
├── discover-myomr/        # Discover section (overview, pricing, support, SDGs)
├── local-news/            # News highlights, gallery, articles
├── omr-listings/          # Directory hub: schools, banks, hospitals, restaurants, etc.
├── omr-local-job-listings/   # Job portal (browse, post, employer dashboard)
├── omr-local-events/      # Events (browse, post)
├── omr-hostels-pgs/       # Hostels & PGs
├── omr-coworking-spaces/   # Coworking spaces
├── listings/              # Forms: jobs, property, business ads
├── events/                # Legacy events
├── pentahive/             # Service/landing (e.g. website maintenance)
├── docs/                  # Documentation (this file lives here)
├── weblog/                # Logging, some includes
└── *.php                  # Root-level pages (contact, about, jobs-by-location, etc.)
```

### Important code points

1. **Branding and URLs**
   - Hardcoded **myomr.in** and **MyOMR** in many places: `index.php`, `components/`, `digital-marketing-landing.php`, meta/OG tags, schema, sitemap, footer.
   - Canonical URLs, OG URLs, and sitemap use `https://myomr.in/`.
   - For MyCovai you will need a **global find/replace strategy** (and/or config variables) for:
     - Site name: MyOMR → MyCovai
     - Domain: myomr.in → mycovai.in (or your chosen domain)
     - Geography: OMR / Old Mahabalipuram Road → Coimbatore / Covai

2. **Database**
   - `core/omr-connect.php`: DB name and user are MyOMR-specific (`metap8ok_myomr`, `metap8ok_myomr_admin`). MyCovai will need its own DB and credentials.
   - Tables are OMR-oriented (e.g. areas, schools, events, jobs). You’ll need a **MyCovai database** (copy or new schema) and update “List of Areas” and any area-dependent logic for Coimbatore localities.

3. **Navigation and links**
   - **Primary nav** (`components/main-nav.php`): Home, Explore Places, About, News Highlights, Gallery, Services (dropdown), Discover (dropdown), Contact.
   - **Secondary bar:** Jobs, Events, Hostels & PGs, Coworking Spaces (+ Home, Phone, Email).
   - **Quick actions:** List a Job, List an Event, List a Property.
   - Links are a mix of absolute path (e.g. `/omr-local-job-listings/`) and `$baseUrl` in footer. For MyCovai you may keep paths and later add a base-url config if the domain or folder changes.

4. **Sub-sections with own nav**
   - e.g. `omr-listings/index.php` uses a simpler nav: Home, About, Features, Pricing, Community, Support, Contact (Discover-style). So some sections are self-contained; rebranding should include their titles/links where they say “MyOMR” or “OMR”.

5. **Security**
   - Admin: `$_SESSION['admin_logged_in']` (or similar) must remain; only credentials and any “OMR” labels in admin need to be reviewed for MyCovai.
   - DB credentials and any secrets must not be committed; use a separate config or env for MyCovai.

6. **SEO and analytics**
   - `components/meta.php`, `analytics.php`, schema in `index.php`, `sitemap.xml`, `robots.txt` all reference myomr.in and OMR. These need to be switched to MyCovai branding and domains.

---

## 3. Page and Link Structure (from code + live traverse)

### Entry points (user-facing)

- **Home:** `/` or `/index.php`
- **Explore Places (directory hub):** `/omr-listings/index.php`  
  → Schools, Best Schools, IT Companies, Industries, Restaurants, Government Offices, ATMs, Parks, Banks, Hospitals
- **Jobs:** `/omr-local-job-listings/` (browse), `/jobs-in-omr-chennai.php` and location/industry landing pages (e.g. `jobs-in-perungudi-omr.php`, `it-jobs-omr-chennai.php`)
- **Events:** `/omr-local-events/`, post event: `/omr-local-events/post-event-omr.php`
- **Hostels & PGs:** `/omr-hostels-pgs/`, owner: `/omr-hostels-pgs/owner-login.php`
- **Coworking:** `/omr-coworking-spaces/`
- **About:** `/about-myomr-omr-community-portal.php`
- **News:** `/local-news/news-highlights-from-omr-road.php`, gallery: `/local-news/image-video-gallery-old-mahabalipuram-road-news.php`
- **Discover:** `/discover-myomr/` (overview, getting-started, features, pricing, community, support, sustainable-development-goals)
- **Contact:** `/contact-my-omr-team.php`
- **Legal:** Terms, Privacy, Policy, Webmaster contact (footer)
- **Listings:** Jobs, property, business ad forms under `/listings/` and feature-specific folders

### Link flow (simplified)

- Homepage → secondary nav (Jobs, Events, Hostels, Coworking) and main nav (Explore Places, About, News, Gallery, Services, Discover, Contact).
- Homepage → quick actions (List Job, List Event, List Property).
- Homepage → job landing links (by location and industry), news cards, events, CTA modals.
- Explore Places → one page per directory type (schools, restaurants, banks, etc.).
- Footer: Home, OMR Database, Contact, Latest News; Jobs by location/industry; Subscribe; Terms, Privacy, Policy, Webmaster.

For MyCovai you will eventually rename or reconfigure:
- “OMR Database” → “Covai Database” or “Explore Coimbatore”
- File names can stay as-is initially (e.g. `omr-listings`) and only visible labels/URLs changed via config, or you can do a gradual rename of key entry points.

---

## 4. What to Do at the Beginning (recommended order)

Do these **before** heavy customisation so the codebase is clearly “MyCovai” and runnable.

### Phase 1 – Configuration and branding (foundation)

1. **Create a single config for MyCovai**
   - Add e.g. `core/mycovai-config.php` (or extend `omr-connect.php`) with:
     - `SITE_NAME` = 'MyCovai'
     - `SITE_DOMAIN` = 'https://mycovai.in' (or your URL)
     - `SITE_REGION` = 'Coimbatore' / 'Covai'
     - Contact email, phone, social URLs
   - Include this in a bootstrap file or in `omr-connect.php` so every page can use constants/variables.

2. **Database**
   - Create a new MySQL database and user for MyCovai (e.g. `mycovai_db`).
   - Copy schema from MyOMR (or export/import structure); replace or add a “List of Areas” (or equivalent) with Coimbatore localities.
   - Update `core/omr-connect.php` to use MyCovai DB credentials (or move credentials to `core/mycovai-config.php` and keep one connect file that reads from config).

3. **Global branding pass**
   - Replace visible “MyOMR” / “My OMR” with config-driven “MyCovai” (nav, footer, titles, meta).
   - Replace “OMR” / “Old Mahabalipuram Road” with “Coimbatore” / “Covai” in taglines and descriptions (again, prefer config so one place to change).
   - Update `components/main-nav.php`, `footer.php`, and any other component that shows site name or region.

4. **Canonical and SEO**
   - In `components/meta.php` and any page-level meta, set canonical and OG URLs to `SITE_DOMAIN`.
   - Update `sitemap.xml` (and any sitemap generator) to use MyCovai domain and paths.
   - Update `robots.txt` if it contains myomr.in.

5. **Analytics and third-party**
   - Create a new Google Analytics property for MyCovai and update `components/analytics.php`.
   - Replace Facebook/WhatsApp/other IDs and links with MyCovai’s (or remove until you have them).

### Phase 2 – Content and copy (first pass)

6. **Homepage**
   - `index.php`: Title, meta description, H1, intro text, and any “OMR” CTAs to Coimbatore/Covai.
   - Keep the same layout and sections; only copy and region change.

7. **Key static pages**
   - About, Contact, Terms, Privacy, Policy, Webmaster: replace OMR/MyOMR with MyCovai/Coimbatore and update contact details from config.

8. **Discover section**
   - Rename “discover-myomr” in labels (and optionally in URL) to “discover-mycovai”; update overview, pricing, support, SDG text for Coimbatore.

### Phase 3 – Directories and features (data + labels)

9. **List of Areas**
   - Populate “List of Areas” (or equivalent table) with Coimbatore areas so dropdowns and filters show Covai localities.

10. **Directory and listing modules**
    - Keep `omr-listings`, `omr-local-job-listings`, etc. as folder names if you prefer minimal file renames; only ensure page titles, headings, and breadcrumbs say “Coimbatore” / “Covai” and use the new areas.
    - Job landing pages: either duplicate and rename (e.g. `jobs-in-rs-puram-covai.php`) or make one template that takes area/industry from config or DB.

11. **Admin**
    - Ensure admin login and CRUD work with the new DB; replace any “OMR” labels in admin UI with “Covai”.

### Phase 4 – Optional structural renames (later)

12. **URL and folder renames**
    - If you want clean URLs like `/covai-listings/` or `/coimbatore-jobs/`, plan a gradual rename of folders and update all internal links, sitemap, and .htaccess. This can follow after the site is stable on MyCovai branding.

---

## 5. Files to Touch First (checklist)

- `core/omr-connect.php` or new `core/mycovai-config.php` – DB and site config
- `components/main-nav.php` – logo text, site name
- `components/footer.php` – site name, contact, links
- `components/meta.php` – default canonical/OG
- `components/analytics.php` – GA (and other) IDs
- `index.php` – title, meta, H1, schema, OG, any “OMR” copy
- `sitemap.xml` – domain and paths
- `robots.txt` – domain if present
- About, Contact, Terms, Privacy, Webmaster pages – copy and contact info
- Discover section – overview, pricing, support, SDG text

---

## 6. Summary

- **Intent:** Reuse MyOMR’s codebase as the foundation for **MyCovai** (Coimbatore), then customize and improve.
- **Structure:** One homepage, directory hub (Explore Places), jobs/events/hostels/coworking/listings, discover section, news/gallery, admin; many internal links and a few different nav patterns.
- **First steps:** Add MyCovai config and DB, then do a global branding and SEO pass (site name, domain, region, canonical/OG/sitemap/analytics), then update homepage and static/discover copy, then areas and directory/job labels. Optional folder/URL renames can come later.

Once this foundation is in place, you can safely iterate on design, new features, and content specifically for Coimbatore.
