# SQL Commands for phpMyAdmin (MyCovai / cPanel)

Run these in **phpMyAdmin** on your cPanel server, against database `metap8ok_mycovai` (or your actual DB name).

---

## Order of execution

1. **Database & user** – Create in cPanel → MySQL Databases (not SQL)
2. **Drop old OMR tables** – Only if you have `omr_*` tables to replace
3. **Create covai_* tables** – Run migration 001
4. **Create List of Areas** – If not exists (used by homepage/directory)
5. **Seed data** – Run seed files for Coimbatore data

---

## 1. Database & user (cPanel, not SQL)

Create in **cPanel → MySQL Databases**:

- **Database:** `metap8ok_mycovai` (or `yourcpanel_mycovai`)
- **User:** `metap8ok_myomr_admin` (or your DB user)
- **Password:** (secure password)
- **Privileges:** All (ALTER, CREATE, DELETE, DROP, INDEX, INSERT, SELECT, UPDATE)

Then update `core/omr-connect.php` with the correct DB name, user, and password.

---

## 2. Drop OMR tables (only if replacing omr_*)

Run if your DB has old `omr_*` directory tables:

```sql
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `omr_it_companies_featured`;
DROP TABLE IF EXISTS `omr_it_parks_featured`;
DROP TABLE IF EXISTS `omr_it_company_submissions`;
DROP TABLE IF EXISTS `omr_it_parks`;
DROP TABLE IF EXISTS `omr_it_companies`;
DROP TABLE IF EXISTS `omr_restaurants`;
DROP TABLE IF EXISTS `omr_industries`;
DROP TABLE IF EXISTS `omr_gov_offices`;
DROP TABLE IF EXISTS `omr_atms`;
DROP TABLE IF EXISTS `omrparkslist`;
DROP TABLE IF EXISTS `omr_schools`;
DROP TABLE IF EXISTS `omrschoolslist`;
DROP TABLE IF EXISTS `omrhospitalslist`;
DROP TABLE IF EXISTS `omrbankslist`;
DROP TABLE IF EXISTS `omrgovernmentofficeslist`;
DROP TABLE IF EXISTS `omrindustrieslist`;
DROP TABLE IF EXISTS `omratmslist`;

SET FOREIGN_KEY_CHECKS = 1;
```

**Source:** `database/migrations/000_drop_omr_directory_tables.sql`

---

## 3. Create covai_* tables

Run this migration (or import `database/migrations/001_create_covai_directory_tables.sql`):

```sql
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET NAMES utf8mb4;

-- Full script: database/migrations/001_create_covai_directory_tables.sql
-- Creates: covai_schools, covai_banks, covai_hospitals, covai_restaurants,
--          covai_atms, covai_parks, covai_industries, covai_it_companies,
--          covai_gov_offices, covai_it_parks, covai_it_companies_featured,
--          covai_it_parks_featured
```

**Best:** Use **phpMyAdmin → Import** and select `database/migrations/001_create_covai_directory_tables.sql`.

---

## 4. Create List of Areas (if missing)

Homepage and some directory pages use `List of Areas` for localities:

```sql
CREATE TABLE IF NOT EXISTS `List of Areas` (
  `Sl No` int(10) NOT NULL AUTO_INCREMENT,
  `Areas` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Sl No`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `List of Areas` (`Sl No`, `Areas`) VALUES
(1, 'RS Puram'),
(2, 'Gandhipuram'),
(3, 'Peelamedu'),
(4, 'Ukkadam'),
(5, 'Saibaba Koil'),
(6, 'Townhall'),
(7, 'Rathinapuri'),
(8, 'Tatabad'),
(9, 'Ramnagar'),
(10, 'Singanallur'),
(11, 'Saravanampatti'),
(12, 'Kalapatti'),
(13, 'Podanur'),
(14, 'Sivananda Colony'),
(15, 'Race Course'),
(16, 'Gopalapuram'),
(17, 'Sidhapudur'),
(18, 'Kottaimedu'),
(19, 'Selvapuram'),
(20, 'Avarampalayam'),
(21, 'Sukrawarpettai'),
(22, 'Ramanathapuram'),
(23, 'Vadavalli'),
(24, 'Thudiyalur'),
(25, 'Kuniyamuthur');
```

**Source:** `database/seed-covai-list-of-areas.sql`

---

## 5. Seed Coimbatore data

After tables exist, run one of these:

| File | Use |
|------|-----|
| `database/seed-covai-directory.sql` | Full Coimbatore directory seed |
| `database/run-mycovai-directory-setup.sql` | Tables + sample seed in one file |
| `database/seed-covai-schools.sql` | Schools only |
| `database/seed-covai-banks.sql` | Banks only |
| (etc.) | Per-entity seeds |

**Best:** Import `database/seed-covai-directory.sql` via phpMyAdmin.

---

## Quick checklist

| Step | Action | File |
|------|--------|------|
| 1 | Create DB + user in cPanel | — |
| 2 | Import 001_create_covai_directory_tables | `migrations/001_create_covai_directory_tables.sql` |
| 3 | Import List of Areas | `seed-covai-list-of-areas.sql` |
| 4 | Import directory seed | `seed-covai-directory.sql` |
| 5 | Update DB creds in `core/omr-connect.php` | — |

---

## Verify

```sql
-- Check covai_* tables
SHOW TABLES LIKE 'covai_%';

-- Check List of Areas
SELECT * FROM `List of Areas` LIMIT 10;

-- Check schools count
SELECT COUNT(*) FROM covai_schools;
```
