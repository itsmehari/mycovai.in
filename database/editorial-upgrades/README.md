# Editorial Upgrades: Batch SQL Updates

**Purpose:** Slug-wise `UPDATE` statements to upgrade existing `articles` to 2000+ word long-form content.

## Structure

```
database/editorial-upgrades/
├── README.md                    (this file)
├── batch-01-slugs.txt           (first batch slug list)
├── samples/                     (reference: one full 2000+ word article)
│   ├── multi-level-car-parking-kg-theatre-road-coimbatore.html
│   ├── multi-level-car-parking-kg-theatre-road-coimbatore.summary.txt
│   └── (generated SQL in generated/samples-update.sql)
├── batch-01/                    (create when content ready: .html + .summary.txt per slug)
└── generated/                   (output from generate-article-update-sql.php)
    ├── samples-update.sql
    └── batch-01-update.sql
```

## Workflow

1. **Produce content:** Write 2000+ word HTML per slug using [EDITORIAL-RUBRIC-LONGFORM-NEWS.md](../../docs/inbox/EDITORIAL-RUBRIC-LONGFORM-NEWS.md).
2. **Place HTML:** Save as `{slug}.html` in `batch-XX/` or `samples/`.
3. **Generate SQL:** Run `php dev-tools/generate-article-update-sql.php batch-01`.
4. **Review:** Inspect generated SQL for escaping and correctness.
5. **Execute:** Run in phpMyAdmin or via CLI. **Back up `articles` before running.**

## Slugs (from inventory)

See [docs/inbox/ARTICLES-EDITORIAL-AUDIT-INVENTORY.md](../../docs/inbox/ARTICLES-EDITORIAL-AUDIT-INVENTORY.md) for the full slug list and classification.
