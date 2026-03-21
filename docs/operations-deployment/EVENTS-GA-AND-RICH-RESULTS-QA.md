# Events – GA smoke & Rich Results QA

Use after deploying `local-events/` and `components/analytics.php` to production.

## 1. Automated fetch check (repo)

From project root:

```bash
# Defaults: sample detail URL + listing URL
php dev-tools/check-live-events-ga-jsonld.php

# Optional: detail URL first, listing URL second
php dev-tools/check-live-events-ga-jsonld.php \
  "https://mycovai.in/local-events/event/your-slug" \
  "https://mycovai.in/local-events/"
```

The script reports:

- Presence of `googletagmanager.com/gtag` / `gtag(` (GA tag)
- At least one `application/ld+json` block with `"@type":"Event"`
- Core Event fields: `name`, `startDate`, `location`, `url`

It does **not** replace Google’s validator (see below).

## 2. Google Rich Results Test (manual)

1. Open [Rich Results Test](https://search.google.com/test/rich-results).
2. Enter a live URL, e.g. `https://mycovai.in/local-events/event/vihansa-2026-sri-ramakrishna-institute-of-technology`.
3. Confirm **Event** structured data is detected; fix any reported errors (e.g. invalid `offers.price` if price is non-numeric text).

## 3. GA quick smoke (Realtime)

Prerequisite: `GA_MEASUREMENT_ID` set in config when you want a property other than the default in `components/analytics.php`.

In GA4 **Realtime**:

| Step | Action | Expect |
|------|--------|--------|
| Listing | Open `/local-events/`, submit filter form | `events_filter` (if gtag receives custom events from `events-analytics.js`) |
| Detail | Open an event detail, click map / ticket (if present) | `event_map` / `event_ticket` |
| Share | Click a share button | `event_share` |
| Submit | Open `/local-events/post/`, interact with form | `event_submit_start`; on submit attempt `event_submit_attempt`; after success page `event_submit_success` |

Custom events are sent via `gtag('event', ...)` in [`local-events/assets/events-analytics.js`](../../local-events/assets/events-analytics.js). If Realtime shows only `page_view`, verify the events script loads (see §1 — detail page must load `/local-events/assets/events-analytics.js`).

## 4. Related

- [QA-SMOKE-TESTS-EVENTS.md](QA-SMOKE-TESTS-EVENTS.md) — browser checklist
- [EVENTS-DEPLOYMENT-CHECKLIST.md](EVENTS-DEPLOYMENT-CHECKLIST.md) — deploy steps
- [MYCOVAI-LOCAL-EVENTS-PRD-WBS-PAGE-SPECS.md](../product-prd/MYCOVAI-LOCAL-EVENTS-PRD-WBS-PAGE-SPECS.md) — product spec
