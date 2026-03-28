# Directory listings: duplicate detection and cleanup policy

## Audit tool

Run (read-only):

```bash
php dev-tools/directory-duplicate-report.php
```

Against live MySQL (after Remote MySQL access is allowed):

```bash
set DB_HOST=mycovai.in
php dev-tools/directory-duplicate-report.php
```

The script prints **row counts** per directory table and **duplicate groups** (same normalized name, or same name + address) with `slnos` for each group.

## Policy

- **UI** lists one row per database row. Duplicate rows in the DB appear as duplicate cards; fixing that is **data work**, not hidden SQL `DISTINCT`, unless product explicitly chooses a dedupe rule.
- **Cleanup** options (choose per case in admin or phpMyAdmin):
  1. **Delete** redundant `slno` rows after confirming they are true duplicates.
  2. **Merge** content into a single canonical row, then delete extras (preserve the lowest `slno` or the row with the richest fields if redirects exist).
  3. **Leave** near-duplicates (e.g. “Lakshmi Machine Works” vs “Lakshmi Machine Works Limited”) if they are legally distinct listings; improve titles in the DB instead of merging.
- **No automated DELETE** is shipped in application code; use the report output and manual/admin review.

## Related code

- List queries: [`directory/components/generic-list-renderer.php`](../../directory/components/generic-list-renderer.php)
- Table names: [`core/mycovai-config.php`](../../core/mycovai-config.php) `COVAI_TABLES` / `covai_table()`
