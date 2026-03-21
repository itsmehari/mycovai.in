## Events – Device/Browser Smoke Tests

Devices: Desktop (Chrome/Edge), iPhone Safari, Android Chrome

**Canonical paths:** `/local-events/`, `/local-events/event/{slug}`, `/local-events/post/`. Legacy `/omr-local-events/` should 301 to `/local-events/`.

Checklist

- Listing (`/local-events/`)
  - Filters (search/category/locality/date range) apply and clear
  - Pagination works and preserves filters
  - Quick pills (Today/Weekend/Month) load
- Detail (`/local-events/event/{slug}`)
  - Map link opens; share buttons use clean event URL (not `event-detail-omr.php`)
  - **ICS** link targets `/local-events/event-ics.php?slug=…` (not under `/local-events/event/…`)
  - **Back to Events** goes to `/local-events/`; **List your event** goes to `/local-events/post/`
  - Stylesheets load (`/jobs/…`, `/assets/css/events-covai.css`); `events-analytics.js` loads from `/local-events/assets/…`
  - OG/Twitter show correct title/description/image
- Submission (`/local-events/post/`)
  - Form validation on empty required fields
  - Poster upload type/size limits enforced
  - Success page shows submission ID and manage links
- Admin (`/local-events/admin/`)
  - Approve → listing appears; Pause/Resume; Unapprove; Delete (super_admin only)
- Accessibility
  - Visible focus outline; headings are semantic; color contrast acceptable

**GA and structured data:** After deploy, run `php dev-tools/check-live-events-ga-jsonld.php` and follow [EVENTS-GA-AND-RICH-RESULTS-QA.md](EVENTS-GA-AND-RICH-RESULTS-QA.md).

