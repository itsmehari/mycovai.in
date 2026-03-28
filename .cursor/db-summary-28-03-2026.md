# DB summary (live) — 28-03-2026

Host: `mycovai.in` · Database: `metap8ok_mycovai` · Tables: 51

## Directory tables (row counts)

| Table | Rows |
|-------|------|
| covai_it_companies | 160 |
| covai_industries | 155 |
| covai_schools | 163 |
| covai_hospitals | 159 |
| covai_banks | 169 |
| covai_atms | 160 |
| covai_parks | 155 |
| covai_gov_offices | 162 |
| covai_restaurants | 158 |
| covai_it_parks | 153 |
| hostels_pgs | 16 |
| property_owners | 1 |

## Notes

- Full table list: `php dev-tools/db-summary-cli.php` with `DB_HOST=mycovai.in`.
- Duplicate analysis: [`docs/data-backend/DIRECTORY-AUDIT-LIVE-2026-03-28.md`](../docs/data-backend/DIRECTORY-AUDIT-LIVE-2026-03-28.md).
- Hostels/PGs: 16 rows (after removing 6 off-scope). All **active** + **verified** for public `/hostels-pgs/`. CSV: `dev-tools/data/maps-leads-hostels-pgs.csv`. SQL: `DELETE-hostels-pgs-off-scope-leads.sql`, `ACTIVATE-hostels-pgs-directory-import.sql`.
