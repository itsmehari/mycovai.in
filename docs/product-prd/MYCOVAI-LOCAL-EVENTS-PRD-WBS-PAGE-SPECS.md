# MyCovai local-events – implementation PRD, WBS, page specs

**Status:** Active (`docs/product-prd/`)  
**Module path:** `local-events/`  
**Build plan:** Cursor plan `mycovai_events_launch_61e846e1` — overview links here; PRD / WBS / page-spec sections are duplicated there for planning UI; **edit either and align the other** when details change.

This document consolidates **implementation PRD**, **work breakdown structure (WBS)**, and **per-page functional + code specifications** for the Coimbatore events feature. Detailed error strings and analytics event names remain in [local-events/EVENTS-FLOW-MATRIX.md](../../local-events/EVENTS-FLOW-MATRIX.md).

---

## Implementation PRD

**Problem:** Coimbatore residents and visitors need one trustworthy place to discover upcoming local events; organizers need a free submission path; editors need moderation control.

**Product goals**

1. Publish verified, structured event listings (date range, venue, locality, category, optional tickets).
2. SEO: indexable hubs and detail pages; `noindex` on noisy filter combinations; Event JSON-LD + sitemap.
3. Trust: human moderation; optional source/disclaimer for curated seeds.
4. Ops: admin approve/reject/pause/unapprove/delete; exports (ICS/CSV); share templates.

**Personas:** Visitor (browse/filter), Organizer (submit), Moderator (admin), Marketing (digest/share).

**In scope (launch):** Preserve existing PHP behaviour; Covai copy/branding; legacy URL 301s; verified seed content; QA per ops checklist.

**Out of scope:** In-app ticketing, unmoderated auto-import, native apps.

**Non-functional:** Prepared statements where used; CSRF + honeypot + rate limit on submit; admin gated by `requireAdmin()`; mobile-usable filters; cPanel (PHP/MySQL only).

**Success criteria:** 8–15 verified live listings (initial); Rich Results valid on sample detail; zero critical smoke failures per [QA-SMOKE-TESTS-EVENTS.md](../operations-deployment/QA-SMOKE-TESTS-EVENTS.md).

**Dependencies:** `core/omr-connect.php`, `core/mycovai-config.php`, `core/admin-auth.php`, tables `event_categories`, `event_submissions`, `event_listings`, root `.htaccess` rewrites.

---

## Work breakdown structure (WBS)

**1.0 Foundation (done / baseline)**

- 1.1 DB schema + categories seed (`database/seed-covai-event-job-categories.sql`)
- 1.2 Public routing (`/local-events/`, `/post/`, `/event/{slug}`, hubs)
- 1.3 Core helpers (`local-events/includes/event-functions-covai.php`)
- 1.4 Rename `*-omr.php` → `*-covai.php` + legacy 301s in `.htaccess`

**2.0 Go-live polish**

- 2.1 Legacy root `/events/` decision (301 vs retire)
- 2.2 Covai copy + placeholders (index, category, weekend links)
- 2.3 OG/meta from `SITE_*` constants where applicable
- 2.4 Poster `image_url` vs filesystem path fix

**3.0 Content**

- 3.1 Verify Mar–Apr 2026 seed rows on official sources
- 3.2 Author original descriptions; build `database/seed-covai-events-2026-q1-editorial.sql`
- 3.3 Apply to target DB (**live seed applied 2026-03-20** — do not re-run without deduping slugs)

**4.0 QA and SEO**

- 4.1 Smoke tests ([QA-SMOKE-TESTS-EVENTS.md](../operations-deployment/QA-SMOKE-TESTS-EVENTS.md))
- 4.2 Regenerate events sitemap; Search Console
- 4.3 GA + JSON-LD checks ([EVENTS-GA-AND-RICH-RESULTS-QA.md](../operations-deployment/EVENTS-GA-AND-RICH-RESULTS-QA.md))

**5.0 Backlog**

- 5.1 Structured locality — shipped
- 5.2 Multi-day display + ICS audit — shipped
- 5.3 Post-end status automation — shipped (`cron-archive-past-events.php`)
- 5.4 Duplicate warning on approve — shipped
- 5.5 Organizer status — partial (`manage-submission.php` token only)
- 5.6 Hub canonical discipline; news/home discovery strip — shipped

---

## Page and file specifications

Legend: **Func** = functional spec; **Code** = technical spec (deps, data, side effects).

### Public – browse and hubs

| File | URL / entry | Func | Code |
|------|-------------|------|------|
| `local-events/index.php` | `/local-events/` | Filterable paginated listing; date pills; CTA; empty state | `getEvents`, `getEventCount`, categories; `noindex` when query filters present |
| `local-events/today.php` | `/local-events/today` | Events starting today | Date-scoped listing |
| `local-events/weekend.php` | `/local-events/weekend` | Sat–Sun window | Same + internal news link where used |
| `local-events/month.php` | `/local-events/month` | Current month | Same |
| `local-events/category.php` | `/local-events/category/{slug}` | Category hub | `getCategoryBySlug` |
| `local-events/locality.php` | `/local-events/locality/{slug}` | Locality hub | Slug ↔ label helpers |
| `local-events/venue.php` | `/local-events/venue/{slug}` | Venue hub | Match on `location` |

### Public – detail and calendar

| File | URL / entry | Func | Code |
|------|-------------|------|------|
| `local-events/event-detail-covai.php` | `/local-events/event/{slug}` | Detail; map/tickets/share; JSON-LD; 404 | `getEventBySlug` — use root-absolute asset and internal links (rewritten URL path is `/local-events/event/…`) |
| `local-events/event-ics.php` | Linked from detail | `.ics` download | UID `@mycovai.in` |

### Public – submit flow

| File | URL / entry | Func | Code |
|------|-------------|------|------|
| `local-events/post-event-covai.php` | `/local-events/post/` | Form; CSRF | POST → `process-event-covai.php` |
| `local-events/process-event-covai.php` | POST only | Validate; poster; insert submission; mail | Honeypot; rate limit; redirect success |
| `local-events/event-submitted-success-covai.php` | After submit | Confirmation | `id`, `t` query params |

### Public – organizer utilities

| File | Func | Code |
|------|------|------|
| `local-events/manage-submission.php` | Edit/manage submission | `organizer-manage.php` |
| `local-events/my-submitted-events.php` | List submissions | Helpers + DB |

### Public – misc

| File | Func | Code |
|------|------|------|
| `local-events/partners.php` | Partner page | Static + CTAs |
| `local-events/components/top-featured-events-widget.php` | Widget strip | Included from news |
| `local-events/components/newsletter-signup.php` | Form | POST → `process-newsletter-signup.php` |
| `local-events/process-newsletter-signup.php` | POST handler | Validate + store |
| `local-events/generate-events-sitemap.php` | `/local-events/sitemap.xml` | XML sitemap |

### Admin (`local-events/admin/`)

| File | Func | Code |
|------|------|------|
| `index.php` | Dashboard | `requireAdmin()` |
| `manage-events-covai.php` | Moderation queue | Approve/reject posts |
| `view-listings.php` | Live listings | Links to public detail |
| `process-approve-event.php` | Approve | `approveSubmissionToListing()` |
| `process-reject-event.php` | Reject | Updates `event_submissions` |
| `process-pause-listing.php` / `process-unapprove-listing.php` / `process-delete-listing.php` | Lifecycle | Status / delete |
| `export-events-csv.php` / `export-events-ics.php` / `calendar-export.php` | Exports | DB |
| `email-digest.php` | Digest | Listings |
| `share-playbook.php` | Social templates | Static + URLs |

### Shared library

| File | Func | Code |
|------|------|------|
| `includes/event-functions-covai.php` | Queries, validation, approve pipeline | `mysqli` `$conn` |
| `includes/organizer-manage.php` | Organizer ops | Included as needed |
| `includes/admin-audit.php` | Admin audit | Approve path |
| `includes/error-reporting.php` | Bootstrap | Early include |
| `includes/dev-diagnostics.php` | Dev diagnostics | Guarded |

---

## Related docs

- [events-workflow.md](../workflows-pipelines/events-workflow.md)
- [EVENTS-QUICK-START-ADMIN.md](../operations-deployment/EVENTS-QUICK-START-ADMIN.md)
- [EVENTS-GA-AND-RICH-RESULTS-QA.md](../operations-deployment/EVENTS-GA-AND-RICH-RESULTS-QA.md)
- [EVENTS-FLOW-MATRIX.md](../../local-events/EVENTS-FLOW-MATRIX.md)

---

## Implementation status (2026-03-21)

Delivered in repo (aligns with Cursor plan `mycovai_events_launch_61e846e1`):

- WBS 2.x: `/events/` → `/local-events/` redirects; Coimbatore copy on hubs + category; OG image from `SITE_LOGO_URL` / `eventsDefaultOgImageUrl()`; poster path fix; mobile filter collapse + `assets/css/events-covai.css`.
- WBS 3.x: [`database/seed-covai-events-2026-q1-editorial.sql`](../../database/seed-covai-events-2026-q1-editorial.sql) applied to **live** (2026-03-20).
- WBS 5.x: Structured locality; multi-day display + ICS; archive cron; duplicate gate on approve; hub canonical + `noindex` on polluted querystrings; “this week” strip on `coimbatore-news.php`.
- **Detail page hardening:** `event-detail-covai.php` uses **root-absolute** CSS, ICS, post CTA, back link, and `events-analytics.js` so clean URLs `/local-events/event/{slug}` do not break relative paths.
- Organizer self-service: `manage-submission.php` token link (no full passwordless “all my submissions” portal).

Remaining manual after each deploy: run [`dev-tools/check-live-events-ga-jsonld.php`](../../dev-tools/check-live-events-ga-jsonld.php), [Google Rich Results Test](https://search.google.com/test/rich-results) on one event URL, GA Realtime for filter/submit/detail smoke, sitemap ping / Search Console.
