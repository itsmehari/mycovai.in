# MyCovai Database: Upload Instructions

**Target database:** `metap8ok_mycovai`  
**User:** `metap8ok_myomr_admin`

---

## Is the database file ready for upload?

**Yes.** Use the files in this folder as follows.

---

## Main database file (recommended – one import)

**`metap8ok_mycovai-main.sql`** is the **main MyCovai database file** built from the MyOMR → MyCovai conversion plan:

- **Structure only:** All 51 tables (CREATE + indexes + constraints), no Chennai/OMR data.
- **Coimbatore seed:** “List of Areas” is filled with 25 Coimbatore localities (RS Puram, Gandhipuram, etc.).
- **omr_election_blo:** Table created empty; add Coimbatore BLO data later when available.

**Steps:**

1. In **phpMyAdmin**, select database **metap8ok_mycovai**.
2. **Import** → choose **`metap8ok_mycovai-main.sql`**.
3. Click **Go**.

Result: full Covai schema + Coimbatore areas in one go. No second script needed.

*(To regenerate this file, run `php build-mycovai-structure-only.php` in the `database` folder.)*

---

## Option A: Structure-only from original dump

If your host (cPanel/phpMyAdmin) lets you import **structure only** (no data):

1. Open **phpMyAdmin** → select database **metap8ok_mycovai**.
2. **Import** → choose file: **`metap8ok_myomr.sql`**.
3. In import options, enable **“Structure only”** / **“Do not import data”** (wording may vary).
4. Run **Go** → all 51 tables will be created **empty**.
5. Then run the areas seed: open the **SQL** tab, paste the contents of **`seed-covai-list-of-areas.sql`**, and execute.

Result: empty Covai schema + Coimbatore “List of Areas”.

---

## Option B: Full import, then clear data and seed

If you can only do a **full** import (structure + data):

1. **Import** **`metap8ok_myomr.sql`** into **metap8ok_mycovai** (full import).
2. Run **`truncate-all-tables-mycovai.sql`** in the SQL tab (clears all table data; keeps structure).
3. Run **`seed-covai-list-of-areas.sql`** in the SQL tab (inserts Coimbatore areas).

Result: same as Option A (empty tables + Coimbatore areas).

---

## Files in this folder

| File | Purpose |
|------|--------|
| **metap8ok_mycovai-main.sql** | **Main MyCovai DB file.** Structure only + Coimbatore “List of Areas”. Import this once. |
| **metap8ok_myomr.sql** | Original MyOMR dump (for Option A/B if you don’t use the main file). |
| **seed-covai-list-of-areas.sql** | Coimbatore areas only. Use if you imported structure without the main file. |
| **02-option-b-truncate-then-seed-mycovai.sql** | Option B: truncate all + seed areas (run after full import of metap8ok_myomr.sql). |
| **truncate-all-tables-mycovai.sql** | Truncate all tables only (no seed). |
| **build-mycovai-structure-only.php** | Script to regenerate metap8ok_mycovai-main.sql from metap8ok_myomr.sql. |
| **seed-covai-articles-news.sql** | Inserts 8 Coimbatore news articles into `articles` (run after main import). |
| **seed-covai-event-job-categories.sql** | Event categories (5) + job categories (10). Run once after main import. |
| **seed-covai-banks.sql** | Coimbatore bank branches (`omrbankslist`). |
| **seed-covai-hospitals.sql** | Coimbatore hospitals (`omrhospitalslist`). |
| **seed-covai-parks.sql** | Coimbatore parks (`omrparkslist`). |
| **seed-covai-gov-offices.sql** | Coimbatore gov offices – RTO, Corporation, Police, etc. (`omr_gov_offices`). |
| **seed-covai-restaurants.sql** | Coimbatore restaurants (`omr_restaurants`). |
| **seed-covai-schools.sql** | Coimbatore schools (`omr_schools`). |
| **seed-covai-it-parks.sql** | Coimbatore IT parks (`omr_it_parks`). |
| **seed-covai-all.sql** | **Single file:** all Coimbatore seeds above in one script. Easiest option. |
| **README-MYCOVAI-UPLOAD.md** | This file. |

---

## Recommended seed (after main import)

- **Preferred:** Import **seed-covai-all.sql** once. It contains List of Areas, event/job categories, articles, banks, hospitals, parks, gov offices, restaurants, schools, and IT parks in the correct order.
- **Alternatively:** Run the individual seed files in this order: **seed-covai-event-job-categories.sql** → **seed-covai-articles-news.sql** → then banks, hospitals, parks, gov-offices, restaurants, schools, it-parks (any order).

---

## After upload

- Point the site to **metap8ok_mycovai** by setting `$database = 'metap8ok_mycovai';` in **core/omr-connect.php** when you are ready to go live on MyCovai.
- Coimbatore seed data for categories, articles, banks, hospitals, parks, gov offices, restaurants, schools, and IT parks is provided; run the seed files above as needed.
