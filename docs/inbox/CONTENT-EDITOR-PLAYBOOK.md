# MyCovai Content Editor Playbook

**Last updated:** May 2026  
**Purpose:** One guide for staff — which admin path to use for each content type.

---

## Quick reference

| Content type | Use this | Public URL | Do not use |
|--------------|----------|------------|------------|
| News articles (homepage cards, Covai news) | **Admin → News Articles** (`/admin/articles/`) | `/coimbatore-news.php`, `/local-news/{slug}` | News Bulletin (legacy `news_bulletin` table) |
| Events | **Events admin** (`/local-events/admin/manage-events-covai.php`) | `/local-events/{slug}` | `/admin/events/events-list.php` (legacy) |
| Jobs | **Jobs admin** (`/jobs/admin/`) | `/jobs/`, `/jobs/{slug}-{id}` | OMR job landers (removed) |
| Directory listings | **Admin directory modules** + `covai_*` tables | `/directory/`, pretty URLs `/schools`, etc. | `listings/` OMR pages (removed) |
| Hostels & PGs | `/hostels-pgs/admin/` | `/hostels-pgs/` | — |
| Coworking | `/coworking-spaces/admin/` | `/coworking-spaces/` | — |
| Elections 2026 | `/coimbatore-elections-2026/` content + admin as wired | `/coimbatore-elections-2026/` | Chennai BLO search (removed) |

---

## News articles (primary news system)

1. Log in: `https://mycovai.in/admin/`
2. **News Articles** → Add / Edit
3. Set **slug** (URL: `/local-news/your-slug`)
4. Upload image to `/local-news/covai-news-images/` or paste image path
5. Status: **published** when ready
6. Tamil pair: use matching slug pattern; hreflang banners appear on article pages automatically

**Homepage:** Cards pull from `articles` table via `weblog/home-page-news-cards.php`.

---

## Events

1. Public submit: `/local-events/post-event-covai.php`
2. Admin approve: `/local-events/admin/manage-events-covai.php`
3. Published events appear on `/local-events/` and event detail slugs

---

## Jobs

1. Employer registers: `/jobs/employer-register-covai.php`
2. Employer posts: `/jobs/post-job-covai.php` (magic-link auth)
3. Admin approves: `/jobs/admin/manage-jobs-covai.php`
4. Only **approved** jobs appear on `/jobs/` and job detail URLs

---

## Directory

- Category pages: `/directory/schools.php`, `hospitals.php`, etc.
- **Get listed:** `/directory/get-listed.php`
- Data lives in `covai_*` tables (not legacy `omr_*` listing tables)
- After bulk imports, clear homepage cache: `php dev-tools/clear-homepage-counts-cache-cli.php`

---

## Deprecated / retired

- **News Bulletin** (`/admin/news-list.php`) — legacy only
- **Static `local-news/*.php` files** — deleted; DB articles only
- **`listings/`, `pentahive/`, `info/find-blo-officer.php`** — removed; redirects in `.htaccess`
- **OMR job landing pages** — removed; use Covai landers (`jobs-in-coimbatore.php`, etc.)

---

## SEO checklist per publish

- [ ] Unique title + meta description
- [ ] Canonical slug (lowercase, hyphens)
- [ ] Image path under `/local-news/covai-news-images/` when possible
- [ ] Internal links to `/directory/`, `/jobs/`, or `/coimbatore-elections-2026/` where relevant
- [ ] No MyOMR / Chennai OMR copy in user-facing text

**Nav registry source of truth:** `admin/config/navigation.php`
