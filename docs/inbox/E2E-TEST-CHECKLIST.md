# MyCovai E2E Test Checklist

**Last updated:** May 2026  
**Run before major deploys and after security-audit phases.**

Mark each item **Pass / Fail / N/A** with date and tester initials.

---

## Environment

- [ ] `MYCOVAI_ENV=production` on live; no PHP notices on homepage or news
- [ ] `php dev-tools/test-phase4-branding-cli.php` — ALL PASSED
- [ ] `php dev-tools/test-phase5-legacy-news-cli.php` — ALL PASSED
- [ ] `php dev-tools/test-phase5-6-cli.php` — ALL PASSED
- [ ] `php dev-tools/audit-sitemap-cli.php` — no OMR URLs in sitemap

---

## Security (Phase 1–2)

- [ ] `/database/` returns 403
- [ ] `/admin/updatenewsform.php` blocked
- [ ] Admin login open redirect blocked
- [ ] CSRF token required on admin POST deletes
- [ ] Pending job **not** visible at public job-detail URL
- [ ] Employer login requires magic link (no auto-create on email alone)
- [ ] `coimbatore-news.php?tag=…` handles special characters safely

---

## Flow A — Directory

1. [ ] Homepage → category tile (e.g. Schools) → list page loads
2. [ ] Open a listing detail (if data exists)
3. [ ] Search/filter on directory hub works
4. [ ] Homepage counts match approximate DB totals (or refresh cache after import)

---

## Flow B — News

1. [ ] `/coimbatore-news.php` lists published articles
2. [ ] Click article → `/local-news/{slug}` renders
3. [ ] Tamil/English language banner works when pair exists
4. [ ] Retired static OMR news URL → 301 to `/coimbatore-news.php`

---

## Flow C — Job apply

1. [ ] `/jobs/` shows approved jobs only
2. [ ] Job detail page loads for approved job
3. [ ] Apply form submits → confirmation page
4. [ ] Application visible in employer dashboard / admin

---

## Flow D — Job post (employer)

1. [ ] `/jobs/employer-register-covai.php` → register
2. [ ] Magic-link login works
3. [ ] `/jobs/post-job-covai.php` → submit job (pending)
4. [ ] Admin approve in `/jobs/admin/manage-jobs-covai.php`
5. [ ] Job appears on `/jobs/` index

---

## Flow E — Events

1. [ ] `/local-events/post-event-covai.php` → submit event
2. [ ] Admin approve in `/local-events/admin/manage-events-covai.php`
3. [ ] Event visible on `/local-events/` and detail slug

---

## Flow F — Article (admin CMS)

1. [ ] `/admin/articles/add.php` → create draft
2. [ ] Publish → appears on homepage news cards
3. [ ] Public URL `/local-news/{slug}` works
4. [ ] Sitemap includes slug via `/local-news/sitemap.xml`

---

## Flow G — Hostels (optional)

1. [ ] Owner register / magic link
2. [ ] Add property → admin approve
3. [ ] Public listing on `/hostels-pgs/`

---

## Legacy redirects (Phase 5)

- [ ] `/jobs-in-omr-chennai.php` → `/jobs-in-coimbatore.php`
- [ ] `/listings/any-page.php` → `/directory/`
- [ ] `/pentahive/` → `/`
- [ ] `/info/find-blo-officer.php` → `/coimbatore-elections-2026/`
- [ ] `/omr-listings/schools.php` → `/directory/schools.php` (or pretty `/schools`)

---

## SEO & analytics

- [ ] Root `sitemap.xml` has Covai URLs only (no `omr-listings`, `pentahive`, BLO)
- [ ] `robots.txt` points to `https://mycovai.in/sitemap.xml`
- [ ] GA events fire on job apply / newsletter (if configured)
- [ ] Organization schema shows MyCovai + Coimbatore on key pages

---

## Sign-off

| Role | Name | Date | Notes |
|------|------|------|-------|
| Dev | | | |
| Editor | | | |
| Owner | | | |

**Related:** `docs/inbox/JOB-POSTING-SYSTEM-END-TO-END-VISUAL-MAP.md`, `docs/deployment/MYCOVAI-DEPLOYMENT-NOTES.md`
