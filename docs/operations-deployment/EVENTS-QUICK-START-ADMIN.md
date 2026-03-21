## Events admin quick start (MyCovai)

Login

- Go to `/admin/login.php` → use configured admin credentials
- Open `/admin/` → use the Events / local-events admin entry (or go directly below)

Moderation

- Manage submissions: `/local-events/admin/manage-events-covai.php`
- Approve → publishes to listings with unique slug
- Pause/Resume → toggles `archived` ↔ `scheduled`
- Unapprove → moves back to submissions
- Delete → removes from listings

Content

- Weekend roundup (legacy filename): `/local-news/this-weekend-in-omr.php`
- Add recap photos under `/local-events/uploads/recaps/{event_slug}/` (if that folder is in use)

SEO / indexing

- Ensure `https://mycovai.in/sitemap.xml` is submitted (root index includes module sitemaps where configured)
- After deploy: [EVENTS-GA-AND-RICH-RESULTS-QA.md](EVENTS-GA-AND-RICH-RESULTS-QA.md) and `php dev-tools/check-live-events-ga-jsonld.php`

Logs

- See `/weblog/events-errors.log` for errors during the first week post-launch

Legacy URLs

- Old `*-omr.php` event scripts under `/local-events/` redirect with 301 to `*-covai.php` (see root `.htaccess`).

Cron (optional)

- Archive ended listings daily: `php local-events/cron-archive-past-events.php` (CLI only). Adds `archived` status when end time is past.

Moderation

- Possible duplicate live listings at the same venue and overlapping time block approval until the admin uses **Approve anyway (duplicate acknowledged)**.
