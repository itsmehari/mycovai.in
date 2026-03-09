# MyCovai OMR→Coimbatore Cleansing Audit

**Purpose:** Track remaining OMR/Chennai/MyOMR references to cleanse for MyCovai.

## Completed
- [x] Database: covai_* tables, seed data
- [x] PHP table refs: covai_table() in directory pages
- [x] Locality folder: OMR localities removed, Coimbatore localities added
- [x] mycovai-config: COIMBATORE_LOCALITIES added

## Completed (this session)
- [x] Directory list pages: OMR→Coimbatore, meta, localities (COIMBATORE_LOCALITIES)
- [x] Directory detail pages: titles, descriptions, addressLocality
- [x] directory-config.php: intro_text, schema
- [x] it-parks-data.php: Coimbatore IT parks, covai_it_parks_all
- [x] detail-profile-blocks: localities, nearby transit (Coimbatore bus stops)
- [x] get-listed.php, restaurants-Black-Pearl, it-parks: meta, localities

## In Progress / To Do

### core/omr-road-database-list.php ✅
- Rebranded titles, meta, headings to Coimbatore/MyCovai

### components/footer.php ✅
- Job links: jobs-in-perungudi-omr → jobs-in-rs-puram (or /jobs?locality=RS Puram)

### Admin (admin/schools-list.php, etc.) ✅
- omrschoolslist → covai_schools (use covai_table)

### directory/data/it-parks-data.php ✅
- Replace Chennai IT parks with Coimbatore IT parks
- Keep omr_it_parks_get_by_id name for backward compat (or add covai alias)

### it-parks-in-omr.php ✅
- Now redirects 301 to /directory/it-parks.php

### omr-road-schools.php
- Meta/keywords updated to Coimbatore (uses different `schools` schema)

### digital-marketing-landing.php
- MyOMR/OMR/Chennai → MyCovai/Coimbatore (or assess if this page is MyOMR-specific)

### Other
- generate-listings-sitemap: $omr_it_parks_all → ensure uses DB or covai data
- homepage-listing-counts: fallbacks OK (only when covai_table missing)
