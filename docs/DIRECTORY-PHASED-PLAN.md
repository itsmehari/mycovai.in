# Directory Folder – Phased Alignment Plan

**Goal:** Align all directory pages with the main MyCovai index design, test functionalities, and fix bugs/glitches.

**Design Reference:** `index.php` + `homepage-directone.css` + `docs/HOMEPAGE-DESIGN-PLAN.md`

---

## Design System Summary (from Index)

| Element | Specification |
|--------|----------------|
| **Framework** | Bootstrap 5 |
| **Typography** | Fraunces (display), Poppins (body) |
| **Colors** | Primary `#B8522E`, bg `#FAF8F5`, text `#2C2825`, muted `#6B5B52` |
| **Header** | `.homepage-header` – white bar, logo, nav, Add Listing CTA |
| **Hero** | Dark gradient, search form |
| **Cards** | `.homepage-category-card` with icon, title, count |
| **Max width** | 1280px, `container-xl` |

---

## Directory Inventory

### Hub
- `directory/index.php` – category hub (Explore Covai)

### List pages (12)
- `schools.php`, `best-schools.php`, `hospitals.php`, `restaurants.php`
- `banks.php`, `atms.php`, `parks.php`, `industries.php`
- `it-companies.php`, `government-offices.php`, `it-parks-in-omr.php`
- `omr-road-schools.php` (legacy)

### Detail pages (10)
- `school.php`, `hospital.php`, `restaurant.php`, `bank.php`, `atm.php`
- `park.php`, `industry.php`, `it-company.php`, `it-park.php`, `government-office.php`

### Locality subpages (7)
- `locality/navalur.php`, `kandhanchavadi.php`, `karapakkam.php`, `sholinganallur.php`, `perungudi.php`, `siruseri.php`, `thoraipakkam.php`

### Other
- `get-listed.php`, `directory-template.php`, `directory-config.php`
- `*-new.php` variants (8 files)
- `components/`, `data/`

---

## Phase 1: Shared Layout Components ✅ COMPLETED

**Scope:** Create reusable header for directory pages; replace green `main-nav.php` with homepage-style header.

### Tasks
1. **Create `components/homepage-header.php`** (or extract from index) – shared header with:
   - Logo + tagline
   - Nav: Home, About, Listing, Blog, Contact
   - Add Listing CTA
   - Mobile menu toggle
2. **Update directory pages** to include `homepage-header.php` instead of `main-nav.php`.
3. **Standardize footer** – ensure `MYCOVAI_CONFIG_LOADED` is set so `footer-covai.php` is used.
4. **WhatsApp float** – change green to terracotta `#B8522E`.

### Files to touch
- `components/homepage-header.php` (new or extracted)
- `index.php` (use shared header if extracting)
- All directory `*.php` list and detail pages
- `components/footer.php` (verify MYCOVAI footer logic)

---

## Phase 2: Directory Index (`directory/index.php`) ✅ COMPLETED

**Scope:** Redesign hub to match homepage category grid and hero.

### ~~Current issues~~ (Resolved)
- ~~Tailwind CDN~~ → Bootstrap 5
- ~~Inter font~~ → Fraunces + Poppins
- ~~Green theme~~ → Terracotta (homepage-directone.css)
- ~~Different card layout~~ → `.homepage-category-grid` + `.homepage-category-card`

### Tasks (Done)
1. Remove Tailwind CDN.
2. Add Bootstrap 5 + `homepage-directone.css` + Fraunces/Poppins.
3. Use shared header (`homepage-header.php`).
4. Optionally add hero section (short version).
5. Replace category grid with `.homepage-category-grid` + `.homepage-category-card`.
6. Use `core/homepage-listing-counts.php` for counts.
7. Align categories with `index.php` home_categories.

---

## Phase 3: Directory List Pages ✅ COMPLETED

**Scope:** schools, hospitals, banks, atms, parks, industries, restaurants, government-offices, it-companies, best-schools, it-parks-in-omr, omr-road-schools.

### Current issues
- Bootstrap 4 (from head-resources)
- Green/blue (#0583D2, #04AA6D, #CCFF33) inline styles
- OMR/MyOMR branding in meta (should be MyCovai / Coimbatore)
- Inconsistent nav (ul/li #333, #04AA6D active)
- `head-resources.php` loads different CSS stack

### Tasks
1. Replace `head-resources.php` output with Bootstrap 5 + `homepage-directone.css` for directory pages.
2. Use shared header.
3. Redesign list hero – warm palette, Fraunces + Poppins.
4. Update listing cards – use design tokens, remove green hover.
5. Fix meta/SEO – Coimbatore, MyCovai, correct canonical.
6. Remove legacy OMR references where appropriate.
7. Decide on `-new.php` vs main files – consolidate or align both.

---

## Phase 4: Directory Detail Pages ✅ COMPLETED

**Scope:** school, hospital, restaurant, bank, atm, park, industry, it-company, it-park, government-office.

### Tasks (Done)
1. Same header + CSS as list pages – all detail pages use `head-directory-list.php`, `homepage-header.php`, `directory-content`.
2. Update `directory/components/detail-profile-blocks.php` – optional; design tokens in buttons applied inline for now.
3. Update `directory/components/related-cards.php` – optional; kept existing.
4. Fix buttons/CTAs – primary `#B8522E` (var(--mycovai-primary)) applied.
5. Breadcrumbs updated to `/directory/[category].php`, meta Coimbatore/MyCovai, canonical correct.
6. Duplicate templates removed from hospital.php, park.php, industry.php.
7. WhatsApp float and Bootstrap 5 JS added to all detail pages.

---

## Phase 5: Testing, Bugs & Polish ✅ IN PROGRESS

**Scope:** Functional testing, bug fixes, locality pages, get-listed, footer.

### Phase 5 Completed (main parts)
- Replaced OMR/MyOMR/Chennai with MyCovai/Coimbatore across directory
- Updated localities from Chennai (Perungudi etc) to Coimbatore (RS Puram, Gandhipuram, etc)
- Fixed homepage-listing-counts table names (omr_industries, omr_gov_offices, omr_atms)
- Added COIMBATORE_LOCALITIES to mycovai-config.php
- Created rs-puram.php locality hub
- Updated detail-profile-blocks transit and news link for Coimbatore
- Created corrected MyCovai ChatGPT research prompt (docs/CHATGPT-RESEARCH-PROMPT-MYCOVAI-DIRECTORY-DATA.md)

### Testing checklist (per page type)
- [ ] Header nav links work (Home, About, Listing, Blog, Contact)
- [ ] Add Listing CTA works
- [ ] Search (if any) works
- [ ] Category links work
- [ ] List pagination works (if applicable)
- [ ] Detail page loads from list
- [ ] Breadcrumbs correct
- [ ] Mobile menu works
- [ ] WhatsApp float works
- [ ] No console errors
- [ ] No mixed content (http/https)
- [ ] Canonical URLs correct

### Known issues to verify
1. **schools.php** – OMR/MyOMR in meta; wrong region copy.
2. **footer.css** – inline link in schools (should use shared assets).
3. **social-style.css** – possibly missing or wrong path.
4. **directory-nav.php** – referenced but may not exist.
5. **$conn** – ensure omr-connect works for Coimbatore data (table names may be OMR-specific).

### Locality pages
- Apply same header + CSS.
- Align with design system.

### get-listed.php
- Form styling, validation, thank-you flow.

---

## Execution Order

| Phase | Focus | Estimated files |
|-------|-------|-----------------|
| 1 | Shared header, footer, nav | ~5 components |
| 2 | directory/index.php | 1 |
| 3 | List pages (12) | 12 |
| 4 | Detail pages (10) | 12 (incl. components) |
| 5 | Testing, locality, get-listed, polish | ~15 |

---

## Quick Reference Paths

| Asset | Path |
|-------|------|
| Homepage CSS | `/assets/css/homepage-directone.css` |
| Design plan | `/docs/HOMEPAGE-DESIGN-PLAN.md` |
| Listing counts | `/core/homepage-listing-counts.php` |
| Directory config | `/directory/directory-config.php` |
| Footer (MyCovai) | `/components/footer-covai.php` |
