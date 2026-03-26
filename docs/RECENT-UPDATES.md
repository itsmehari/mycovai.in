# Recent updates (MyCovai)

Short log of notable changes. For full worklogs see `docs/worklogs/` (e.g. `worklog-dd-mm-yyyy.md`).

---

## 2026-03-19

**Remote database connectivity and docs**

- **Remote DB:** `core/omr-connect.php` now supports env vars (`DB_HOST`, `DB_PORT`, `DB_USER`, `DB_PASS`, `DB_NAME`). Use `DB_HOST=mycovai.in` to connect to live from local.
- **Server name:** All MyCovai DB/docs use **mycovai.in**; password default from _myomr.in repository.
- **Test:** Direct remote connection to mycovai.in tested and working. CLI test: `dev-tools/test-db-connect-cli.php` with env set.
- **LEARNINGS.md** created at root (remote DB + “confirm before live DB update” workflow).
- **Cursor rules & AGENTS.md:** When you ask to “update the database”, the AI will ask whether the change is for **live** and will only run on live after your explicit confirmation, then suggest committing.
- **Live DB summary:** 50 tables, 134 rows (see `docs/data-backend/MYCOVAI-DATABASE-SUMMARY.md`).

---

## 2026-03-26

**Election manifesto article rollout + multilingual/news SEO updates**

- **4 manifesto analysis articles added and published** in `articles`:
  - AIADMK welfare vs structural gap
  - DMK continuity vs structural shift
  - TVK youth appeal vs governance depth
  - NTK five-capital model analysis
- **Live DB updates executed** (insert + publish + image_path updates) using remote host flow (`DB_HOST=mycovai.in`).
- **Article hero images updated** for all four manifesto pieces with external image URLs.
- **English/Tamil pairing hardened** for article pages:
  - Added helper: `core/article-i18n-helpers.php`
  - Added reusable banner component: `components/article-language-banner.php`
  - `local-news/article.php` now resolves pair links once and renders EN/TA switch with clean URLs.
- **SEO improvements for bilingual articles** in `core/article-seo-meta.php`:
  - Dynamic language metadata (`English`/`Tamil`)
  - Dynamic Open Graph locale (`en_IN`/`ta_IN`)
  - Dynamic JSON-LD `inLanguage`
  - `hreflang` alternates (`en`, `ta`, `x-default`) when both versions are present.
- **Listings hygiene:** `components/featured-news-links.php` now excludes Tamil suffix slugs (`NOT LIKE '%-tamil'`), aligning with home/news listing behavior.
- **News sitemap support implemented in codebase:**
  - New generator: `local-news/generate-sitemap.php`
  - Added route in `.htaccess`: `/local-news/sitemap.xml`
  - Added to root sitemap index list in `weblog/generate-sitemap-index.php`.
- **Cross-project content prep:** created `MYCHENNAI-MANIFESTO-NEWS-RAW.md` with fully reframed Chennai-audience raw copy for the same 4 items.
