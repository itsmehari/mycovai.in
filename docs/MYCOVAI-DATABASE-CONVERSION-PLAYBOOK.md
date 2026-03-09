# MyCovai Database Conversion Playbook

**Purpose:** Step-by-step conversion of MyOMR database → `metap8ok_mycovai` with table-by-table analysis, context understanding, and Coimbatore-focused starter data.

**DB setup (done):**
- Database: `metap8ok_mycovai`
- User: `metap8ok_myomr_admin` (all privileges)

---

## How This Exercise Will Run

1. **You provide** the MyOMR database export (full dump or table structure + sample).
2. **We document** every table: name, purpose, columns, relationships, OMR-specific vs generic.
3. **We decide** per table: copy as-is, rename (omr_* → covai_* or keep), transform data (e.g. areas/locations → Coimbatore localities), or create new seed data.
4. **We produce** SQL scripts: CREATE for `metap8ok_mycovai`, INSERT/UPDATE for Coimbatore starter data (areas, categories, sample content where appropriate).
5. **We use** the internet / research to gather Coimbatore-specific starter data (localities, landmarks, categories) and document sources.

---

## Table-by-Table Log (from metap8ok_myomr.sql)

| # | Table name | Purpose (context) | Conversion action | Notes / starter data |
|---|------------|-------------------|-------------------|----------------------|
| 1 | `admin_audit_log` | Admin action audit trail | **Copy schema + empty** | Generic; no OMR data to migrate. |
| 2 | `admin_users` | Admin login accounts | **Copy schema; migrate or create 1 admin** | Reuse same admin user for MyCovai or create new. |
| 3 | `articles` | Local news / editorial articles | **Copy schema; data optional** | OMR articles = Chennai; for Covai either leave empty or add Coimbatore articles later. |
| 4 | `businesses` | Generic business directory | **Copy schema + empty** | Seed with Coimbatore businesses when ready. |
| 5 | `coworking_spaces` | Coworking listings (owner, address, amenities) | **Copy schema; data replace** | OMR data Chennai-specific; replace with Covai coworking or leave empty. |
| 6 | `employers` | Job employers (company, contact) | **Copy schema + empty** | Seed with Covai employers as jobs are posted. |
| 7 | `events` | Legacy events (simpler schema) | **Copy schema; data optional** | May overlap with event_listings; decide which is canonical. |
| 8 | `event_attendees` | RSVP for events | **Copy schema + empty** | FK to event_listings. |
| 9 | `event_categories` | Event categories (Community, Education, etc.) | **Copy schema + data** | Region-agnostic; reuse categories. |
| 10 | `event_listings` | Published events | **Copy schema; data optional** | Replace with Coimbatore events or leave empty. |
| 11 | `event_submissions` | Pending event submissions | **Copy schema + empty** | |
| 12 | `gallery` | Image gallery | **Copy schema; data optional** | |
| 13 | `hostels_pgs` | Hostels & PGs (property_owner_id, locality, rent, etc.) | **Copy schema; data replace** | OMR addresses; for Covai seed new hostels/PGs in Coimbatore or leave empty. |
| 14 | `job_applications` | Job applications (job_id, applicant info) | **Copy schema + empty** | |
| 15 | `job_categories` | Job categories (IT, Healthcare, etc.) | **Copy schema + data** | Region-agnostic; reuse. |
| 16 | `job_postings` | Job posts (employer_id, category, location) | **Copy schema; data optional** | Location → Coimbatore areas. |
| 17 | **`List of Areas`** | **Dropdown/filter areas** | **Replace data with Coimbatore localities** | **Critical for Phase 5.1.** Seed: RS Puram, Gandhipuram, Peelamedu, Ukkadam, Saibaba Koil, etc. |
| 18 | `omrbankslist` | Banks on OMR (legacy naming) | **Schema → covai equivalent; seed Covai banks** | Rename to `covai_banks` or `banks`; seed Coimbatore bank branches. |
| 19 | `omrelections_civic_issues` | Civic issues (constituency, locality) | **Schema for Covai elections; new data** | Coimbatore constituencies/localities. |
| 20 | `omrelections_constituencies` | Parliamentary/Assembly constituencies | **Replace with Coimbatore constituencies** | e.g. Coimbatore Lok Sabha, Coimbatore North/South Assembly. |
| 21 | `omrelections_election_results` | Election results per constituency | **Schema + empty or Coimbatore results** | |
| 22 | `omrelections_localities` | Localities under constituencies | **Replace with Coimbatore localities** | |
| 23 | `omrelections_polling_stations` | Polling stations | **Schema + empty or Covai data** | |
| 24 | `omrelections_representatives` | MPs/MLAs | **Replace with Coimbatore representatives** | |
| 25 | `omrelections_voter_services` | Voter service links | **Schema + update URLs/labels** | |
| 26 | `omrhospitalslist` | Hospitals (legacy) | **Schema → covai_hospitals; seed Covai hospitals** | |
| 27 | `omrparkslist` | Parks (legacy) | **Schema → covai_parks; seed Covai parks** | |
| 28 | `omrschoolslist` | Schools (legacy) | **Schema → covai_schools or use `schools`; seed Covai** | Duplicate of `schools`/`omr_schools`; consolidate. |
| 29 | `omr_atms` | ATMs | **Schema → covai_atms; seed Covai ATMs** | |
| 30 | `omr_election_blo` | BLO (Booth Level Officer) data | **Copy schema; leave empty; add Covai BLO data later** | Same table in metap8ok_mycovai; no Chennai data. Import Coimbatore BLO when available. |
| 31 | `omr_gov_offices` | Government offices | **Schema → covai_gov_offices; seed Covai offices** | RTO, police, municipal, etc. in Coimbatore. |
| 32 | `omr_industries` | Industries / companies | **Schema → covai_industries; seed Covai industries** | |
| 33 | `omr_it_companies` | IT companies | **Schema → covai_it_companies; seed Covai IT** | Coimbatore has IT parks (e.g. Tidel, ELCOT equivalents). |
| 34 | `omr_it_companies_featured` | Featured IT companies | **Copy schema + empty** | |
| 35 | `omr_it_company_submissions` | User submissions for IT companies | **Copy schema + empty** | |
| 36 | `omr_it_parks` | IT parks (name, address, amenities) | **Schema → covai_it_parks; seed Covai IT parks** | |
| 37 | `omr_it_parks_featured` | Featured IT parks | **Copy schema + empty** | |
| 38 | `omr_restaurants` | Restaurants (locality, cuisine, geolocation) | **Schema → covai_restaurants; seed Covai restaurants** | |
| 39 | `omr_schools` | Schools (detailed: curriculum, fee, locality) | **Schema → covai_schools; seed Covai schools** | |
| 40 | `organizers` | Event organizers | **Copy schema + empty** | |
| 41 | `property_inquiries` | Hostel/PG inquiries | **Copy schema + empty** | |
| 42 | `property_owners` | Hostel/PG owners | **Copy schema + empty** | OMR owners; Covai = new signups. |
| 43 | `property_photos` | Hostel/PG photos | **Copy schema + empty** | |
| 44 | `property_reviews` | Hostel/PG reviews | **Copy schema + empty** | |
| 45 | `saved_properties` | User saved hostels/PGs | **Copy schema + empty** | |
| 46 | `saved_spaces` | User saved coworking spaces | **Copy schema + empty** | |
| 47 | `schools` | Schools (richer schema: curriculum, fee_range, area) | **Copy schema; seed Covai schools** | Same concept as omr_schools; use one schools table for Covai. |
| 48 | `space_inquiries` | Coworking inquiries | **Copy schema + empty** | |
| 49 | `space_owners` | Coworking space owners | **Copy schema + empty** | |
| 50 | `space_photos` | Coworking photos | **Copy schema + empty** | |
| 51 | `space_reviews` | Coworking reviews | **Copy schema + empty** | |

**Summary:** 44 tables in dump. **Generic (copy schema ± data):** admin_*, articles, businesses, employers, events, event_*, gallery, job_*, organizers, property_*, saved_*, space_*. **Region-specific (schema copy + Coimbatore seed):** List of Areas, omr* → covai* (banks, hospitals, parks, schools, ATMs, gov_offices, industries, it_companies, it_parks, restaurants, schools). **Elections:** omrelections_* → covai equivalents with Coimbatore constituencies/localities. **Large/special:** omr_election_blo (Chennai BLO data) → drop or replace with Coimbatore BLO if needed.

---

## Region / Naming Conventions

| MyOMR (source) | MyCovai (target) |
|----------------|------------------|
| OMR (Chennai)  | Covai / Coimbatore |
| Areas: Perungudi, Sholinganallur, etc. | Areas: RS Puram, Gandhipuram, Peelamedu, Ukkadam, Saibaba Koil, etc. |
| omr_* table prefix (optional) | Keep or rename to covai_* per table |

---

## Coimbatore Starter Data (researched and to be inserted)

- **List of Areas** – Seed script: `database/seed-covai-list-of-areas.sql`. Localities: RS Puram, Gandhipuram, Peelamedu, Ukkadam, Saibaba Koil, Townhall, Rathinapuri, Tatabad, Ramnagar, Singanallur, Saravanampatti, Kalapatti, Podanur, Sivananda Colony, Race Course, Gopalapuram, Sidhapudur, Kottaimedu, Selvapuram, Avarampalayam (source: Wikipedia “List of neighbourhoods of Coimbatore”, MagicBricks localities).
- **Categories** – Event and job categories are region-agnostic; reuse from MyOMR.
- **Sample content** – Add Coimbatore events, jobs, schools, restaurants, etc. in later steps.

---

## Output Artifacts (we will create)

1. **Conversion log** – This doc, with every table analyzed.
2. **SQL scripts** – In `dev-tools/database/` or `dev-tools/migrations/`:
   - Schema creation for `metap8ok_mycovai` (from cleaned MyOMR structure).
   - Seed data: areas, categories, and any starter rows.
3. **Update to `core/omr-connect.php`** – Switch `$database` to `metap8ok_mycovai` when you’re ready to go live on the new DB.

---

## Status

- [x] MyOMR database dump received and reviewed (`database/metap8ok_myomr.sql`)
- [x] All tables listed and context documented (44 tables)
- [ ] Conversion and seed scripts written (List of Areas seed done; full schema clone pending)
- [x] Coimbatore starter data researched (areas list; others TBD)
- [ ] Connection config updated (when you decide to switch)

---

## Next Steps (suggested order)

1. **Create empty DB schema** – Run a structure-only import of `metap8ok_myomr.sql` into `metap8ok_mycovai`, then run seed scripts.
2. **Or** – Build a single “conversion” SQL that creates all tables (no data) for `metap8ok_mycovai`, then run `seed-covai-list-of-areas.sql` and any other seeds.
3. **List of Areas** – Run `database/seed-covai-list-of-areas.sql` against `metap8ok_mycovai` (after table exists).
4. **Rename omr_* → covai_*** (optional) – Do when generating the final schema so PHP/code can be updated to new table names in one go.
5. **Switch app** – Point `core/omr-connect.php` to `metap8ok_mycovai` when ready to go live.
