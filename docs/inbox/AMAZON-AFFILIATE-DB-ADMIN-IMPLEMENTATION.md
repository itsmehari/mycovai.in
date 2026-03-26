# Amazon affiliate: DB table + admin CRUD (implementation packet)

**Status:** Ready to apply. The IDE may block non-markdown writes while **Plan mode** is on—switch to **Agent mode** and ask to “apply `AMAZON-AFFILIATE-DB-ADMIN-IMPLEMENTATION.md`” or copy files below.

## 1. SQL migration

**File:** `dev-tools/sql/CREATE-covai-affiliate-links.sql`

```sql
-- Affiliate / sponsored banner rows merged into core/ad-registry.php at runtime.
-- Run against metap8ok_mycovai (or local) when ready. See docs/ads.md.

CREATE TABLE IF NOT EXISTS `covai_affiliate_links` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `monetization_type` enum('affiliate','sponsor') NOT NULL DEFAULT 'affiliate',
  `advertiser` varchar(190) NOT NULL DEFAULT '',
  `url` text NOT NULL,
  `slot_ids` varchar(500) NOT NULL DEFAULT '',
  `sizes` varchar(200) NOT NULL DEFAULT '728x90,336x280,300x250,320x50',
  `design` varchar(64) NOT NULL DEFAULT 'amazon',
  `headline` varchar(255) NOT NULL DEFAULT '',
  `tagline` varchar(500) NOT NULL DEFAULT '',
  `cta` varchar(64) NOT NULL DEFAULT 'Learn more',
  `weight` int(10) UNSIGNED NOT NULL DEFAULT 100,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_active` (`active`),
  KEY `idx_weight` (`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

## 2. Config

**File:** `core/mycovai-config.php` — add after `AMAZON_ASSOCIATE_DISCLOSURE_TEXT` block:

```php
    /** When true, merge rows from table covai_affiliate_links into banner registry (requires migration). */
    define('COVAI_AFFILIATE_LINKS_DB_ENABLED', true);
```

## 3. DB merge helper

**File:** `core/covai-affiliate-links-db.php` (new)

See Agent apply step; merges `covai_affiliate_links` rows into `$covai_ads` with `weight` support.

## 4. Registry hook

**File:** `core/ad-registry.php` — after `amazon-affiliate-registry.php` require:

```php
if (is_file(__DIR__ . '/covai-affiliate-links-db.php')) {
    require_once __DIR__ . '/covai-affiliate-links-db.php';
    if (function_exists('covai_merge_affiliate_links_from_db')) {
        covai_merge_affiliate_links_from_db($covai_ads);
    }
}
```

## 5. Weighted random pick

**File:** `components/ad-banner-slot.php` — add `_covai_weighted_random_pick()` and use it instead of `array_rand` in `covai_ad_slot()` so `weight` on any ad row (registry or DB) affects selection.

## 6. Admin

- `admin/affiliate-links.php` — list + delete  
- `admin/affiliate-links-edit.php` — add/edit (POST, prepared statements)  
- `admin/config/navigation.php` — module entry under Operations  

**Note:** Full PHP source is applied automatically in Agent mode (too long to duplicate here without risk of drift).

## 7. Run migration

Confirm **live vs local**; then run SQL (phpMyAdmin or `dev-tools/run-sql-file.php` if applicable).
