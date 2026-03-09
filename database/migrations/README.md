# MyCovai Database Migrations

## Execution order

1. **000_drop_omr_directory_tables.sql** – Drop old `omr_*` directory tables
2. **001_create_covai_directory_tables.sql** – Create new `covai_*` tables
3. **../seed-covai-directory.sql** – Seed Coimbatore directory data

---

## 000_drop_omr_directory_tables.sql

Removes all `omr_*` directory tables before creating covai tables.

**Tables dropped:** omrbankslist, omrhospitalslist, omrparkslist, omrschoolslist, omr_atms, omr_gov_offices, omr_industries, omr_it_companies, omr_it_companies_featured, omr_it_parks, omr_it_parks_featured, omr_it_company_submissions, omr_restaurants, omr_schools, etc.

---

## 001_create_covai_directory_tables.sql

Creates the `covai_*` directory tables for MyCovai.in (Coimbatore local business directory).

**Tables created:**
- `covai_schools`
- `covai_banks`
- `covai_hospitals`
- `covai_restaurants`
- `covai_atms`
- `covai_parks`
- `covai_industries`
- `covai_it_companies`
- `covai_gov_offices`
- `covai_it_parks`
- `covai_it_companies_featured`
- `covai_it_parks_featured`

**How to run:**
1. Connect to `metap8ok_mycovai` via phpMyAdmin or MySQL CLI
2. Execute the SQL file: `mysql -u user -p metap8ok_mycovai < 001_create_covai_directory_tables.sql`
3. Or copy-paste contents into phpMyAdmin SQL tab

**Seed data:**
Run `database/seed-covai-directory.sql` for starter Coimbatore data (schools, banks, hospitals, restaurants, ATMs, parks, industries, IT companies, gov offices, IT parks).

For more verified data, use the ChatGPT Research prompt in `docs/CHATGPT-RESEARCH-PROMPT-MYCOVAI-DIRECTORY-DATA.md`.
