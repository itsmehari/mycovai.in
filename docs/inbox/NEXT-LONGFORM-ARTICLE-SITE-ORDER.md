# Next longform article — aligned to site order

**Purpose:** Pick the **next** Covai news article for the Hindu-style longform + `dev-tools/update-*-live.php` pipeline using the **same ordering as the public news page**, not the order rows appear in seed SQL files.

## Source of truth (code)

`coimbatore-news.php` loads articles with:

```sql
SELECT id, title, slug, summary, published_date, image_path
FROM articles
WHERE status = 'published'
AND slug NOT LIKE '%-tamil'
ORDER BY published_date DESC
LIMIT 21;
```

Any “next article” choice should follow **`ORDER BY published_date DESC`** (newest first).

## Refresh the ordered list (live DB)

From project root:

```bash
DB_HOST=mycovai.in php dev-tools/list-articles-by-site-order.php 35
```

Output is numbered **1 = newest** on site. Use **`content_chars`** as a rough stub vs longform signal: longform updates are typically **~12k–15k+** characters; stubs are often **&lt; ~500–2000**.

## Aligned “next slug” (snapshot)

**Last checked:** 2026-03-19 (after District Collector monsoon preparedness live publish; **stub queue cleared** at 8000-char threshold). **Pending queue file:** `docs/inbox/PENDING-LONGFORM-STUBS-LIVE.md` (update after each publish).

**Done:** `multi-level-car-parking-kg-theatre-road-coimbatore` — `dev-tools/update-kg-theatre-parking-article-live.php`  
**Done:** `tamil-nadu-mous-investment-jobs-coimbatore` — `dev-tools/update-tn-mous-investment-article-live.php`  
**Done:** `noyyal-river-front-development-coimbatore-202-crore` — `dev-tools/update-noyyal-river-front-article-live.php`  
**Done:** `gandhipuram-bus-stand-rebuild-coimbatore-30-crore` — `dev-tools/update-gandhipuram-bus-stand-article-live.php`  
**Done:** `ukkadam-bus-terminus-metro-rail-coimbatore` — `dev-tools/update-ukkadam-bus-terminus-article-live.php`  
**Done:** `e-permits-quarries-coimbatore-district-taluks` — `dev-tools/update-e-permits-quarries-article-live.php`  
**Done:** `rs-puram-flower-market-operations-rent-hike-coimbatore` — `dev-tools/update-rs-puram-flower-market-article-live.php`  
**Done:** `coimbatore-metro-rail-phase-1-ukkadam-gandhipuram` — `dev-tools/update-coimbatore-metro-phase1-article-live.php`  
**Done:** `psg-hospitals-cardiac-care-wing-peelamedu-coimbatore` — `dev-tools/update-psg-hospitals-cardiac-wing-article-live.php`  
**Done:** `smart-city-info-boards-rs-puram-coimbatore-maintenance` — `dev-tools/update-smart-city-info-boards-rs-puram-article-live.php`  
**Done:** `tidel-park-coimbatore-expansion-2026` — `dev-tools/update-tidel-park-expansion-article-live.php`  
**Done:** `valparai-tourism-eco-friendly-nilgiri-tahr-coimbatore-district` — `dev-tools/update-valparai-tourism-tahr-article-live.php`  
**Done:** `pollachi-coconut-jaggery-festival-2025-coimbatore` — `dev-tools/update-pollachi-coconut-jaggery-festival-article-live.php`  
**Done:** `coimbatore-textile-export-surge-gsp-revival` — `dev-tools/update-coimbatore-textile-gsp-export-article-live.php`  
**Done:** `race-course-walking-track-solar-lighting-coimbatore` — `dev-tools/update-race-course-solar-lighting-article-live.php`  
**Done:** `coimbatore-airport-passenger-traffic-3-million` — `dev-tools/update-coimbatore-airport-3m-passengers-article-live.php`  
**Done:** `kg-hospital-telemedicine-rural-coimbatore` — `dev-tools/update-kg-hospital-telemedicine-rural-article-live.php`  
**Done:** `perur-temple-annual-festival-coimbatore-2025` — `dev-tools/update-perur-temple-festival-article-live.php`  
**Done:** `coimbatore-startup-incubator-tidel-elcot` — `dev-tools/update-coimbatore-startup-incubator-tidel-elcot-article-live.php` (~2010 words dry-run)  
**Done:** `isha-yoga-center-mahashivaratri-coimbatore-2025` — `dev-tools/update-isha-yoga-mahashivaratri-article-live.php` (2000 words dry-run)  
**Done:** `singanallur-lake-biodiversity-birds-coimbatore` — `dev-tools/update-singanallur-lake-biodiversity-article-live.php` (2002 words dry-run)  
**Done:** `nilgiri-mountain-railway-mettupalayam-ooty-summer-2025` — `dev-tools/update-nilgiri-mountain-railway-summer-article-live.php` (2000 words dry-run)  
**Done:** `brookefields-mall-food-court-expansion-coimbatore` — `dev-tools/update-brookefields-food-court-expansion-article-live.php` (2002 words dry-run)  
**Done:** `coimbatore-district-collector-monsoon-preparedness-2025` — `dev-tools/update-coimbatore-collector-monsoon-preparedness-article-live.php` (2000 words dry-run)

**Next longform (8000-char stub queue):** *none* — re-run `DB_HOST=mycovai.in php dev-tools/list-pending-longform-stubs.php 8000` after new short articles are seeded or threshold changes.

**Live URL (completed):** `https://mycovai.in/local-news/coimbatore-district-collector-monsoon-preparedness-2025`

## When this doc becomes stale

- Re-run `list-articles-by-site-order.php` after new inserts or after publishing articles with newer `published_date`.
- Update the table above or replace with “see script output” only.

## Related

- March 2026 seed list: `dev-tools/insert-march-2026-news.php`
- Broader Covai stub pack: `database/replace-articles-with-covai-news.sql` (does **not** define homepage order; dates do.)
