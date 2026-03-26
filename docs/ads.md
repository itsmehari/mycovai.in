# Banner Ads (mycovai.in)

Banner ads are registry-driven, slot-based, with random selection per slot. No database; ads are defined in PHP.

## Files

| File | Purpose |
|------|--------|
| **core/ad-registry.php** | Slot IDs (`$covai_ad_slot_ids`) and ad records (`$covai_ads`). |
| **core/amazon-affiliate-registry.php** | Optional Amazon India affiliate records merged into `$covai_ads` when enabled and when `AMAZON_ASSOCIATE_STORE_ID` is configured. |
| **components/ad-banner-slot.php** | `covai_ad_slot($slot_id, $size)`, `covai_ad_slot_row($slot_id, $count)`, and `covai_ad_banner_row($slot_id, $size, $max)`. Loads registry, outputs HTML. Injects `ad-banners.css` once per page. |
| **assets/css/ad-banners.css** | Styles for `.covai-ad-zone`, `.covai-ad-slot`, `.covai-ad-banner`, size classes (728x90, 336x280, 300x250, 320x50, card-row), and design variants. |

## Usage

On any page that includes `components/head-resources.php` (or that loads the ad component), call:

```php
<?php covai_ad_slot('article-top', '728x90'); ?>
<?php covai_ad_slot('homepage-mid', '336x280'); ?>
```

Optional row of slots (each slot picks one ad at random; may show duplicates):

```php
<?php covai_ad_slot_row('homepage-mid', 2, '336x280'); ?>
```

**Distinct banner row** (one banner per advertiser, no duplicates; use for homepage-top):

```php
<?php covai_ad_banner_row('homepage-top', 'card-row', 6); ?>
```

- `card-row` is a layout size: compact cards in a responsive row (4–5 visible on desktop, wrap on smaller screens).
- Ads are shown in registry order, up to `$max` (default 5, max 10).

## Slot IDs (site-wide)

- `homepage-top`, `homepage-mid`
- `article-top`, `article-mid`
- `listing-top`, `listing-mid`
- `detail-mid`

## Adding a new advertiser

1. **Registry** — In `core/ad-registry.php`, add a new entry to `$covai_ads` with: `id`, `advertiser`, `url`, `slot_ids`, `sizes`, `design`, `headline`, `tagline`, `active`.
2. **Icon** — In `components/ad-banner-slot.php`, add a case in `_covai_ad_icon($design)` for the new `design` key (e.g. return `'fas fa-building'`).
3. **CSS** — In `assets/css/ad-banners.css`, add a design class `.covai-ad-banner--yourdesign` for layout/colors if needed.

Standard sizes: `728x90`, `336x280`, `300x250`, `320x50`. Layout size: `card-row` (flexible-width cards for a horizontal row of 4–5 banners). All ad links use `rel="sponsored noopener noreferrer"` and a visible “Ad” label.

Design keys with CSS variants: `mycovai`, `default`, `resumedoctor`, `colourchemist`, `bseri`, `edmasters`, `myomr`, `akshayam`.

## Amazon affiliate workflow

1. Configure `AMAZON_ASSOCIATE_STORE_ID` in `core/mycovai-config.php`.
2. Keep `COVAI_AMAZON_AFFILIATE_ENABLED` as `true` to allow Amazon entries.
3. `core/ad-registry.php` auto-loads `core/amazon-affiliate-registry.php`; if tag is empty, Amazon entries are skipped.
4. Use `monetization_type => 'affiliate'` for affiliate rows:
   - UI label changes from `Ad`/`Sponsored` to `Affiliate`.
   - Slot-level disclosure shows `AMAZON_ASSOCIATE_DISCLOSURE_TEXT`.
5. Use existing slot calls (`homepage-mid`, `article-mid`, `article-bottom`, `listing-mid`, `detail-mid`) to avoid template sprawl.

### Recommended ad record keys for affiliates

- `id`, `advertiser`, `url`, `slot_ids`, `sizes`, `design`, `headline`, `tagline`, `active`
- Optional: `monetization_type` (`affiliate` or `sponsor`), `cta`, `rel`, `weight` (1–1000; higher = more likely in random slot pick)

## Database-backed links (optional)

For many links or non-developer edits:

1. Run `dev-tools/sql/CREATE-covai-affiliate-links.sql` on the target database (confirm live vs local per project workflow).
2. Set `COVAI_AFFILIATE_LINKS_DB_ENABLED` to `true` in `core/mycovai-config.php`.
3. `core/covai-affiliate-links-db.php` merges active rows into `$covai_ads` after the PHP registry and Amazon merge.
4. Manage rows in **Admin → Affiliate Links** (`/admin/affiliate-links.php`).

## Debug

Append `?covai_ad_debug=1` to the URL to see HTML comments when no eligible ad is found or the registry is missing.
