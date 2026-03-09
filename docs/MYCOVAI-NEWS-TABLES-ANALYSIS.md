# MyCovai: News-Related Tables Analysis

**Purpose:** Identify all news-related tables, their structure, and how to populate them with Covai (Coimbatore) content.

---

## 1. News-related table: `articles`

MyOMR/MyCovai has **one main news table**: **`articles`**. There is no separate "news" table.

### 1.1 Structure (`articles`)

| Column | Type | Purpose |
|--------|------|--------|
| `id` | int(11) | Primary key, auto-increment |
| `title` | varchar(255) | Headline |
| `slug` | varchar(255) | URL slug (unique), e.g. `multi-level-car-parking-kg-theatre-road-coimbatore` |
| `summary` | text | Short summary for cards and meta description |
| `content` | longtext | Full article body (HTML allowed) |
| `published_date` | datetime | Display and sort order |
| `author` | varchar(100) | Byline, e.g. "MyCovai Editorial Team" |
| `category` | varchar(100) | e.g. Infrastructure, Local News, Events |
| `tags` | varchar(255) | Comma-separated keywords for SEO |
| `image_path` | varchar(255) | Path to featured image (e.g. `/local-news/covai-news-images/...`) or NULL |
| `is_featured` | tinyint(1) | 0 or 1 for homepage highlight |
| `status` | enum('draft','published') | Only `published` articles are shown on site |
| `created_at` | timestamp | |
| `updated_at` | timestamp | |

### 1.2 Where it is used in code

| File | Use |
|------|-----|
| `weblog/home-page-news-cards.php` | Homepage news grid: `SELECT id, title, slug, summary, published_date, image_path FROM articles WHERE status = 'published' ORDER BY published_date DESC LIMIT 20` |
| `local-news/article.php` | Full article page by slug: `SELECT * FROM articles WHERE slug = ? AND status = 'published'` |
| `core/article-seo-meta.php` | SEO meta and JSON-LD for article pages |
| `weblog/ADD-NEW-ARTICLE.php` | Admin: insert new article |
| Sitemap generators | List published articles for sitemap |

### 1.3 URL and display flow

- **Listing:** Homepage includes `home-page-news-cards.php` → shows latest published articles.
- **Detail:** User clicks "Read More" → `/local-news/{slug}` → `.htaccess` → `local-news/article.php?slug={slug}`.
- **SEO:** Article page uses `article-seo-meta.php` (title, description, og:image, NewsArticle schema).

### 1.4 MyCovai adjustments

- **Author:** Use `MyCovai Editorial Team` (or update config if you add a constant).
- **Content:** Coimbatore/Covai-only; no Chennai/OMR references in new articles.
- **Slug:** Unique, lowercase, hyphenated; e.g. `ukkadam-bus-terminus-metro-rail-coimbatore`.
- **image_path:** NULL or path under e.g. `/local-news/covai-news-images/` when you add images.

---

## 2. Other tables that might reference “news”

- **`gallery`** – Can store images; not tied to articles by foreign key. Use for photo galleries; optional for news.
- **`event_listings`** / **`event_submissions`** – Events, not news articles. Populate separately with Covai events.

No other tables are used for the main news/article flow.

---

## 3. Seed data: Covai news articles

Seed file **`database/seed-covai-articles-news.sql`** inserts initial Coimbatore-focused articles based on:

- Multi-level car parking at KG Theatre Road (Coimbatore Corporation).
- Ukkadam bus terminus and Metro Rail plans.
- Noyyal river front development.
- RS Puram flower market and civic updates.
- E-permits for quarries in Coimbatore district.
- Gandhipuram bus stand redevelopment.

Sources (for attribution and follow-up): Times of India (Coimbatore), The Hindu (Coimbatore), New Indian Express (Tamil Nadu).

After running the seed, add or replace images in `/local-news/covai-news-images/` and update `image_path` in `articles` if needed.
