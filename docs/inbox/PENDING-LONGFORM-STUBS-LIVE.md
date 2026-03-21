# Pending longform stubs (live DB snapshot)

**Updated:** 2026-03-19 (after District Collector monsoon preparedness longform publish on live)

**Heuristic:** `articles.status = 'published'`, slug not `%-tamil`, `CHAR_LENGTH(content) < 8000`, ordered by `published_date DESC` (same idea as `coimbatore-news.php`).

**Refresh:**

```bash
DB_HOST=mycovai.in php dev-tools/list-pending-longform-stubs.php 8000
```

---

**Live snapshot:** `(none under threshold)` — no published non-Tamil articles below **8000** characters in this check.

**Note:** The March 2026 Covai news stub queue at this threshold is **cleared**. New stubs may appear if shorter articles are added or if the threshold changes.
