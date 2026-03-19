# MyCovai directory seeds

Seed data for covai_* directory tables (50+ rows per category). Run only after user confirmation for live.

**Upsert behaviour:** Rows are matched by `slug` (or by `name` for covai_it_parks). If a row with that slug/name exists, it is **updated**; otherwise it is **inserted**. Re-running the script will not create duplicates.

**Run from repo root:**
```powershell
$env:DB_HOST='mycovai.in'; php database/seeds/run_covai_seeds.php
```

After running, update `.cursor/db-summary-dd-MM-yyyy.md` with the latest summary (e.g. run `dev-tools/update-db-summary.ps1`).
