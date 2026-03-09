# Phase 1 PRD: Shared Layout Components

## Product Requirements Document

### 1. Objective
Create shared layout components so all directory pages use the same header, footer, and floating elements as the main MyCovai index page, ensuring design consistency.

### 2. Scope

| In Scope | Out of Scope |
|----------|--------------|
| Extract/create `homepage-header.php` | Phase 2+ directory page content redesign |
| Create `directory-nav.php` (fixes 404) | Database/backend changes |
| Create `whatsapp-float.php` component | Locality pages (Phase 5) |
| Update `omr-listings-nav.php` styling | |
| Refactor index + directory pages to use shared components | |
| Ensure footer uses MyCovai variant when config loaded | |

### 3. User Stories

| ID | As a | I want | So that |
|----|------|--------|---------|
| US1 | Visitor | The same header on every page | I have consistent navigation and branding |
| US2 | Visitor | Terracotta-themed UI (not green) | The site feels cohesive |
| US3 | Developer | Reusable header/footer components | I don’t duplicate markup |
| US4 | Visitor | Working directory category links | I can navigate between Schools, Hospitals, etc. |

### 4. Functional Requirements

| ID | Requirement | Priority |
|----|-------------|----------|
| FR1 | `homepage-header.php` – logo, nav (Home, About, Listing, Blog, Contact), Add Listing CTA, mobile toggle | P0 |
| FR2 | `directory-nav.php` – category sub-nav with MyCovai styling; correct paths for `/directory/` | P0 |
| FR3 | `whatsapp-float.php` – fixed position, terracotta (#B8522E), WhatsApp link | P0 |
| FR4 | `omr-listings-nav.php` – use MyCovai colors (primary, not green) | P1 |
| FR5 | index.php uses `homepage-header.php` | P0 |
| FR6 | directory/index.php uses `homepage-header.php` instead of main-nav | P0 |
| FR7 | All directory pages that include nav get `homepage-header.php` before sub-nav | P0 |
| FR8 | Footer uses `footer-covai.php` when `MYCOVAI_CONFIG_LOADED` (via omr-connect) | P0 |

### 5. Non-Functional Requirements

- **Performance:** No extra HTTP requests; components are PHP includes.
- **Accessibility:** Focus states, ARIA labels, skip links where applicable.
- **Responsive:** Header and nav work on mobile.

### 6. Success Criteria

- [x] No 404 for `directory-nav.php` — created component
- [x] All directory pages show homepage-style header
- [x] Footer is MyCovai-branded (footer-covai) when config loaded via omr-connect
- [x] WhatsApp float uses terracotta (`whatsapp-float.php`)
- [x] Navigation links work correctly

### 7. Phase 1 Completion (Feb 2025)

**Deliverables created:**
- `components/homepage-header.php` — shared header with active-link detection
- `components/directory-nav.php` — MyCovai-styled directory category sub-nav (fixes 404)
- `components/whatsapp-float.php` — terracotta WhatsApp button
- `components/head-homepage-styles.php` — Fraunces + Poppins + homepage-directone.css
- `components/omr-listings-nav.php` — rewritten with MyCovai design tokens

**Pages updated:**
- `index.php` — uses shared header + whatsapp-float
- `directory/index.php` — Bootstrap 5, homepage-header, whatsapp-float
- `directory/schools.php`, `banks.php`, `hospitals.php`, `industries.php`, `it-companies.php`, `government-offices.php`, `best-schools.php` — header + directory-nav + whatsapp-float
- `directory/atms.php`, `parks.php`, `it-parks-in-omr.php`, `it-park.php` — header + omr-listings-nav + whatsapp-float
- `directory/restaurants.php`, `get-listed.php`, `directory-template.php` — header + whatsapp-float
