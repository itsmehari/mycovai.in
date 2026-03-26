# Amazon Affiliate Links for mycovai.in — Implementation Plan (extended)

**Status:** Living document. **Location:** Triage in `docs/inbox/` until moved to `docs/product-prd/` or `docs/operations-deployment/` as appropriate.

This file extends the original Cursor plan with **governance**, **rotation logic**, **relevance tiers**, and **storage evolution** (registry vs database).

---

## Goals and constraints

- Earn commissions on qualifying purchases via [Amazon India Associates](https://affiliate-program.amazon.in/).
- Preserve UX: affiliate units as optional bands, not competing with hero search, category grid, or article reading flow.
- Stay compliant: Operating Agreement, disclosure rules, `rel="sponsored"` on commercial links (see `components/ad-banner-slot.php`).

---

## Who decides which link shows where?

| Layer | Role |
|--------|------|
| **Owner / editor** | Approves which campaigns exist, which are `active`, and high-level rules (e.g. exclude certain article types). |
| **Encoded rules** | Code + data map **slots**, optional **category**, optional **page context** (`home`, `article`, `directory`) to eligible link rows. |
| **Automation (optional, later)** | Keyword/category matching or external APIs—not required for v1. |

Default for this stack: **owner + explicit rules**; avoid full “AI relevance” until affiliate revenue justifies the complexity.

---

## Relevance: phased approach (not mandatory ML)

| Phase | Mechanism | Notes |
|-------|-----------|--------|
| **1 — Slot pools** | Same as today: eligible ads per `slot_id` (`homepage-mid`, `article-mid`, …); random pick among rows. | Simple; weak contextual relevance unless pools are manually split. |
| **2 — Category / page-type** | Articles already have `category` (or similar). Affiliate rows store `allowed_categories` and/or `page_types`. Filter before random/weighted pick. | **Best ROI** for news: explainable, testable. |
| **3 — Keyword / tag match (careful)** | Match product tags to title/body keywords | Risk of false positives; tune if used. |
| **4 — ML / embeddings** | Only if affiliate becomes a core product. | High cost; out of scope for initial implementation. |

**Logic in one line:** Filter to **eligible** rows for this page context (slot + optional category/type), then **rotate** (random, weighted, or time-boxed).

---

## Rotation: different plans per surface

Yes—**different pools per context** is normal:

- **Homepage:** Broader offers (deals, bestsellers, generic store)—high impressions, low specificity.
- **Articles:** Tighter pool; optional **category filter** so placements feel less random.
- **Directory / listings:** Optional third pool (e.g. travel, local guides) if you add themed links.

**Rotation algorithms (choose per deployment):**

- Uniform random among eligible rows (simplest).
- **Weighted random** (`weight` column) for hero campaigns.
- **Round-robin or day-based** — requires persisted counters or dates.
- **Campaign windows** — `starts_at` / `ends_at` for seasonal promos.

Implementation: separate **eligible sets** per slot and/or `context`, not one global bag.

---

## Storage: many links — registry vs database

| Stage | Storage | When |
|--------|---------|------|
| **Now / small sets** | PHP registry: `core/ad-registry.php`, optional `core/amazon-affiliate-registry.php` | Tens of rows; changes via deploy. |
| **Scale / frequent edits** | MySQL table (e.g. `affiliate_links` or `covai_affiliate_links`) + optional simple admin CRUD | Many links, non-developer updates, scheduling. |

**Suggested table fields (future):** `id`, `label`, `destination_url` (with Associate tag), `active`, `weight`, `slot_ids` (JSON or relation), optional `categories` / `page_types`, optional `starts_at`, `ends_at`, `notes`, `created_at`.

**Hybrid:** Keep defaults in config; override or bulk rows from DB when ready.

---

## Existing codebase leverage

| Mechanism | Location |
|-----------|----------|
| Slot IDs | `core/ad-registry.php` — `homepage-top`, `homepage-mid`, `article-top`, `article-mid`, `article-bottom`, `listing-top`, `listing-mid`, `detail-mid` |
| Rendering | `components/ad-banner-slot.php` — `covai_ad_slot()`, `covai_ad_banner_row()` |
| Docs | `docs/ads.md` |

Add Amazon (or affiliates) as registry rows or DB-backed rows targeting slots—not raw URLs scattered in templates.

---

## Key pages (priority)

**Tier 1:** `index.php` (mid-page), `local-news/article.php` (mid/bottom), directory list/detail (`directory/*`, `listing-mid`, `detail-mid`).

**Tier 2:** `coimbatore-elections-2026/`, `local-events/`, `jobs/` — single discrete block per page type if slots exist.

**Tier 3:** Curated resource pages where affiliate links are the editorial purpose.

**Avoid:** Admin, forms, checkout-adjacent CTAs; newsletters only with Amazon off-site rules reviewed.

---

## Compliance (non-negotiable)

- India program + Store ID on `amazon.in` links.
- Site-level **Affiliate disclosure** page + footer link (`components/footer-covai.php`); mirror **exact** required wording from Associates Central when live.
- `rel="sponsored noopener noreferrer"`; no disguised editorial links.
- Privacy policy: third-party retailer cookies when users leave the site.

---

## Technical phases (summary)

- **A:** Associates signup; Store ID in config (`core/mycovai-config.php` pattern).
- **B:** Registry merge + disclosure page + affiliate labeling in `ad-banner-slot.php`.
- **C:** Reuse existing `covai_ad_slot` calls on homepage, articles, directory.
- **D:** Link types: custom links, SiteStripe, Idea Lists, optional Native Shopping Ads (performance review).
- **E:** Analytics on outbound clicks where policy allows.
- **F:** `docs/ads.md` + this plan maintained.

---

## Success criteria

- Affiliate units on agreed Tier 1 surfaces via slot machinery.
- Clear **Affiliate** labeling + disclosure page in footer.
- Single switch to disable all Amazon rows (`active` / config flag).
- Path documented to **DB + optional admin** when link count and edit frequency grow.

---

## Related files

- `docs/ads.md` — Banner slot usage.
- `core/ad-registry.php`, `core/amazon-affiliate-registry.php` (if present).
- `LEARNINGS.md` — Short pointer to governance.
- `AGENTS.md` — Agent behavior for ads/affiliate and DB evolution.
