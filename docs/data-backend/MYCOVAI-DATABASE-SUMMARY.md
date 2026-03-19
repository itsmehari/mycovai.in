# MyCovai database summary (live)

**Database:** `metap8ok_mycovai`  
**Host:** mycovai.in (cPanel)  
**Snapshot:** 2026-03-19 (from `dev-tools/db-summary-cli.php` with `DB_HOST=mycovai.in`)

---

## Overview

| Metric | Value |
|--------|--------|
| **Tables** | 50 |
| **Total rows** | 134 |

---

## Tables and row counts

| Table | Rows | Notes |
|-------|------|--------|
| List of Areas | 25 | Lookup/areas |
| admin_audit_log | 0 | Admin audit |
| admin_users | 0 | Admin accounts |
| articles | 24 | News/articles |
| businesses | 0 | Business listings |
| covai_atms | 10 | ATMs directory |
| covai_banks | 10 | Banks directory |
| covai_gov_offices | 6 | Government offices |
| covai_hospitals | 6 | Hospitals directory |
| covai_industries | 5 | Industries |
| covai_it_companies | 7 | IT companies |
| covai_it_companies_featured | 0 | Featured IT companies |
| covai_it_parks | 3 | IT parks |
| covai_it_parks_featured | 0 | Featured IT parks |
| covai_parks | 5 | Parks directory |
| covai_restaurants | 8 | Restaurants directory |
| covai_schools | 10 | Schools directory |
| coworking_spaces | 0 | Coworking listings |
| employers | 0 | Job portal employers |
| event_attendees | 0 | Events |
| event_categories | 5 | Event categories |
| event_listings | 0 | Event listings |
| event_submissions | 0 | Event submissions |
| events | 0 | Legacy events |
| gallery | 0 | Gallery |
| hostels_pgs | 0 | Hostels / PGs |
| job_applications | 0 | Job applications |
| job_categories | 10 | Job categories |
| job_postings | 0 | Job postings |
| omr_election_blo | 0 | BLO / elections |
| omr_it_companies_featured | 0 | Legacy featured IT |
| omrelections_civic_issues | 0 | Elections |
| omrelections_constituencies | 0 | Elections |
| omrelections_election_results | 0 | Elections |
| omrelections_localities | 0 | Elections |
| omrelections_polling_stations | 0 | Elections |
| omrelections_representatives | 0 | Elections |
| omrelections_voter_services | 0 | Elections |
| organizers | 0 | Event organizers |
| property_inquiries | 0 | Hostels/PG inquiries |
| property_owners | 0 | Property owners |
| property_photos | 0 | Property photos |
| property_reviews | 0 | Property reviews |
| saved_properties | 0 | Saved properties |
| saved_spaces | 0 | Saved coworking spaces |
| schools | 0 | Legacy schools |
| space_inquiries | 0 | Coworking inquiries |
| space_owners | 0 | Space owners |
| space_photos | 0 | Space photos |
| space_reviews | 0 | Space reviews |

---

## Summary by area

- **Directory (covai_*):** Schools (10), banks (10), ATMs (10), hospitals (6), gov offices (6), restaurants (8), IT companies (7), industries (5), parks (5), IT parks (3). Featured tables and several directory tables are empty.
- **Content:** articles (24).
- **Lookups:** List of Areas (25), event_categories (5), job_categories (10).
- **Jobs / events / hostels / coworking / elections:** Schema present; most tables 0 rows (ready for use).

To refresh this summary run (from repo root):

```powershell
$env:DB_HOST='mycovai.in'; php dev-tools/db-summary-cli.php
```
