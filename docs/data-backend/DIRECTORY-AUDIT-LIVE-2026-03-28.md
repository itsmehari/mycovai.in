# Live directory audit snapshot (2026-03-28)

Generated against **metap8ok_mycovai** on host **mycovai.in** using:

```bash
set DB_HOST=mycovai.in
php dev-tools/directory-duplicate-report.php
```

## Row counts (matches public list totals when unfiltered)

| Table | Rows |
|-------|------|
| covai_it_companies | **160** |
| covai_industries | 155 |
| covai_schools | 163 |
| covai_hospitals | 159 |
| covai_banks | 169 |
| covai_atms | 160 |
| covai_parks | 155 |
| covai_gov_offices | 162 |
| covai_restaurants | 158 |

The IT companies line **“Showing 1–9 of 160 results”** is consistent with **`COUNT(*) = 160`** on `covai_it_companies`.

## Duplicate pattern (live evidence)

### IT companies (`covai_it_companies`)

- **Same name + same address** groups almost always have **`cnt = 3`** with three `slno` values (e.g. Amazon: **18, 69, 120**).
- Same pattern for Bank of America, Bosch, Cognizant, TCS, Wipro, and many **“IT company coimbatore N”** seed rows.
- **HCL Technologies** has **4** rows on **name-only** grouping: `slnos` **2, 9, 60, 111** (one row differs by address).

**Interpretation:** The UI is faithfully listing the DB; duplicates are **data-level** (likely **triple import/seed**). Cleanup = keep one `slno` per logical listing and delete or merge the other two (after checking detail URLs / inbound links).

### Industries, schools, banks

The duplicate report shows the **same triplicate pattern** for many `covai_industries`, `covai_schools`, and `covai_banks` rows (groups with `cnt = 3`).

### Near-duplicates (manual review)

Examples like **“Lakshmi Machine Works”** vs **“Lakshmi Machine Works Limited”** are separate `slno` rows; merging is a **business/editorial** decision, not automatic SQL.

## UI numbering (post-redesign)

- **# on the page** = rank within the current result set (1…per page).
- **ID** = database `slno` (unique per row). Multiple rows for the same brand therefore show **different IDs** and the same **#** range only applies to positions on that page.

## Next steps

1. Re-run: `php dev-tools/directory-duplicate-report.php` with `DB_HOST=mycovai.in` after any cleanup.
2. Follow [`DIRECTORY-DEDUPE-POLICY.md`](DIRECTORY-DEDUPE-POLICY.md) for merge/delete workflow.
