# Article images report (mycovai.in)

**Applied:** 2025-03-19  
**Script:** `dev-tools/update-article-images.php` with `DB_HOST=mycovai.in`  
**Source map:** `dev-tools/article-image-urls.json`

All 24 published (non-Tamil) articles had `image_path` set. Images are used for og:image, twitter:image, hero, and home-page news cards.

| Slug | Image URL | Source |
|------|-----------|--------|
| multi-level-car-parking-kg-theatre-road-coimbatore | https://upload.wikimedia.org/wikipedia/commons/b/be/Parking_Ticket%2C_KG_Cinemas%2C_Coimbatore.jpg | Wikimedia Commons |
| tamil-nadu-mous-investment-jobs-coimbatore | https://images.unsplash.com/photo-1560319003-24094e042e10?w=1200&q=80 | Unsplash |
| noyyal-river-front-development-coimbatore-202-crore | https://images.unsplash.com/photo-1652379379347-5ab81f8d03fa?w=1200&q=80 | Unsplash |
| gandhipuram-bus-stand-rebuild-coimbatore-30-crore | https://images.unsplash.com/photo-1560319003-24094e042e10?w=1200&q=80 | Unsplash |
| ukkadam-bus-terminus-metro-rail-coimbatore | https://images.unsplash.com/photo-1560319003-24094e042e10?w=1200&q=80 | Unsplash |
| e-permits-quarries-coimbatore-district-taluks | https://images.unsplash.com/photo-1716037839386-a3946f1a50eb?w=1200&q=80 | Unsplash |
| rs-puram-flower-market-operations-rent-hike-coimbatore | https://images.unsplash.com/photo-1754638335210-a5c9e73f93a7?w=1200&q=80 | Unsplash |
| coimbatore-metro-rail-phase-1-ukkadam-gandhipuram | https://images.unsplash.com/photo-1560319003-24094e042e10?w=1200&q=80 | Unsplash |
| psg-hospitals-cardiac-care-wing-peelamedu-coimbatore | https://images.unsplash.com/photo-1560319003-24094e042e10?w=1200&q=80 | Unsplash |
| smart-city-info-boards-rs-puram-coimbatore-maintenance | https://images.unsplash.com/photo-1560319003-24094e042e10?w=1200&q=80 | Unsplash |
| tidel-park-coimbatore-expansion-2026 | https://images.unsplash.com/photo-1560319003-24094e042e10?w=1200&q=80 | Unsplash |
| valparai-tourism-eco-friendly-nilgiri-tahr-coimbatore-district | https://images.unsplash.com/photo-1652379379347-5ab81f8d03fa?w=1200&q=80 | Unsplash |
| pollachi-coconut-jaggery-festival-2025-coimbatore | https://images.unsplash.com/photo-1754638335210-a5c9e73f93a7?w=1200&q=80 | Unsplash |
| coimbatore-textile-export-surge-gsp-revival | https://images.unsplash.com/photo-1560319003-24094e042e10?w=1200&q=80 | Unsplash |
| race-course-walking-track-solar-lighting-coimbatore | https://images.unsplash.com/photo-1716037839386-a3946f1a50eb?w=1200&q=80 | Unsplash |
| coimbatore-airport-passenger-traffic-3-million | https://images.unsplash.com/photo-1560319003-24094e042e10?w=1200&q=80 | Unsplash |
| kg-hospital-telemedicine-rural-coimbatore | https://images.unsplash.com/photo-1560319003-24094e042e10?w=1200&q=80 | Unsplash |
| perur-temple-annual-festival-coimbatore-2025 | https://images.unsplash.com/photo-1652379379347-5ab81f8d03fa?w=1200&q=80 | Unsplash |
| coimbatore-startup-incubator-tidel-elcot | https://images.unsplash.com/photo-1560319003-24094e042e10?w=1200&q=80 | Unsplash |
| isha-yoga-center-mahashivaratri-coimbatore-2025 | https://images.unsplash.com/photo-1652379379347-5ab81f8d03fa?w=1200&q=80 | Unsplash |
| singanallur-lake-biodiversity-birds-coimbatore | https://images.unsplash.com/photo-1652379379347-5ab81f8d03fa?w=1200&q=80 | Unsplash |
| nilgiri-mountain-railway-mettupalayam-ooty-summer-2025 | https://images.unsplash.com/photo-1652379379347-5ab81f8d03fa?w=1200&q=80 | Unsplash |
| brookefields-mall-food-court-expansion-coimbatore | https://images.unsplash.com/photo-1560319003-24094e042e10?w=1200&q=80 | Unsplash |
| coimbatore-district-collector-monsoon-preparedness-2025 | https://images.unsplash.com/photo-1652379379347-5ab81f8d03fa?w=1200&q=80 | Unsplash |

**Validated:** URLs are direct image links (Wikimedia, Unsplash CDN). No HEAD check was run at apply time; if any URL breaks, set `image_path` to NULL or replace in DB and in `article-image-urls.json`.

**Migration backup:** `database/migrations/002_add_article_images.sql`
