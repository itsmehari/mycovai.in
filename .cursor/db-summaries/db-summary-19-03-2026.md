# MyCovai database summary (live)

**Snapshot date:** 19-03-2026  
**Database:** `metap8ok_mycovai`  
**Host:** mycovai.in (cPanel)  
**Source:** `dev-tools/db-summary-cli.php` with `DB_HOST=mycovai.in`

---

## Overview

| Metric | Value |
|--------|--------|
| **Tables** | 50 |
| **Total rows** | 1,658 |

---

## Tables and row counts

| Table | Rows | Notes |
|-------|------|--------|
| List of Areas | 25 | Lookup/areas |
| admin_audit_log | 0 | Admin audit |
| admin_users | 0 | Admin accounts |
| articles | 24 | News/articles |
| businesses | 0 | Business listings |
| covai_atms | 160 | ATMs directory |
| covai_banks | 169 | Banks directory |
| covai_gov_offices | 162 | Government offices |
| covai_hospitals | 159 | Hospitals directory |
| covai_industries | 155 | Industries |
| covai_it_companies | 160 | IT companies |
| covai_it_companies_featured | 0 | Featured IT companies |
| covai_it_parks | 153 | IT parks |
| covai_it_parks_featured | 0 | Featured IT parks |
| covai_parks | 155 | Parks directory |
| covai_restaurants | 158 | Restaurants directory |
| covai_schools | 163 | Schools directory |
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

- **Directory (covai_*):** Schools (163), banks (169), ATMs (160), hospitals (159), gov offices (162), restaurants (158), IT companies (160), industries (155), parks (155), IT parks (153). All directory tables seeded (50+ each). Featured tables empty.
- **Content:** articles (24).
- **Lookups:** List of Areas (25), event_categories (5), job_categories (10).
- **Jobs / events / hostels / coworking / elections:** Schema present; most tables 0 rows (ready for use).

---

## Refresh instructions

Update this file on **every database update** and **daily**. From repo root:

```powershell
$env:DB_HOST='mycovai.in'; php dev-tools/db-summary-cli.php
```

Save output to `.cursor/db-summary-dd-MM-yyyy.md` (or overwrite this file and update the Snapshot date line).
