# Banner Ads (mycovai.in)

Banner ads are registry-driven, slot-based, with random selection per slot. No database; ads are defined in PHP.

## Files

| File | Purpose |
|------|--------|
| **core/ad-registry.php** | Slot IDs (`$omr_ad_slot_ids`) and ad records (`$omr_ads`). |
| **components/ad-banner-slot.php** | `omr_ad_slot($slot_id, $size)` and `omr_ad_slot_row($slot_id, $count)`. Loads registry, picks one ad, outputs HTML. Injects `ad-banners.css` once per page. |
| **assets/css/ad-banners.css** | Styles for `.omr-ad-zone`, `.omr-ad-slot`, `.omr-ad-banner`, size classes (728x90, 336x280, 300x250, 320x50), and design variants. |

## Usage

On any page that includes `components/head-resources.php` (or that loads the ad component), call:

```php
<?php omr_ad_slot('article-top', '728x90'); ?>
<?php omr_ad_slot('homepage-mid', '336x280'); ?>
```

Optional row of slots:

```php
<?php omr_ad_slot_row('homepage-mid', 2, '336x280'); ?>
```

## Slot IDs (site-wide)

- `homepage-top`, `homepage-mid`
- `article-top`, `article-mid`
- `listing-top`, `listing-mid`
- `detail-mid`

## Adding a new advertiser

1. **Registry** — In `core/ad-registry.php`, add a new entry to `$omr_ads` with: `id`, `advertiser`, `url`, `slot_ids`, `sizes`, `design`, `headline`, `tagline`, `active`.
2. **Icon** — In `components/ad-banner-slot.php`, add a case in `_omr_ad_icon($design)` for the new `design` key (e.g. return `'fas fa-building'`).
3. **CSS** — In `assets/css/ad-banners.css`, add a design class `.omr-ad-banner--yourdesign` for layout/colors if needed.

Standard sizes: `728x90`, `336x280`, `300x250`, `320x50`. All ad links use `rel="sponsored noopener noreferrer"` and a visible “Ad” label.

## Debug

Append `?omr_ad_debug=1` to the URL to see HTML comments when no eligible ad is found or the registry is missing.
