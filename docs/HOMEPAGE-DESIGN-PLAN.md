# MyCovai Homepage – Design Plan & Architecture

**Role:** Front-end designer & project architect  
**Skill reference:** `.cursor/skills/frontend-design/SKILL.md`  
**Goal:** Redesign the first page with a bold, distinctive aesthetic that fits a local directory for Coimbatore and avoids generic AI aesthetics.

---

## 1. Design Thinking

### Purpose
- **What:** One-stop local directory and community platform for Coimbatore (Covai).
- **Who:** Residents, job seekers, businesses, students, and visitors looking for places, jobs, events, hostels, and coworking spaces.
- **Problem solved:** “Find what you need in Coimbatore” and “Share your listing” with trust and clarity.

### Tone & Aesthetic Direction
**Chosen direction: Editorial-meets-local**

- **Editorial:** Confident typography, clear hierarchy, sectioned layout, “guide” feel rather than generic SaaS.
- **Local:** Warm, grounded, place-first – Coimbatore as textile city, education hub, greener and less “tech cold” than a typical metro directory.
- **Avoid:** Purple gradients on white, Inter/Roboto, flat generic cards, cold blue-grey only.

**One-line:** *A warm, editorial local guide that feels made for Coimbatore.*

### Constraints
- HTML/CSS/JS + PHP; Bootstrap 5; max container 1280px.
- User rule: Poppins as primary font (we use it for UI/body; add a distinctive display font for hero and headings).
- Accessibility: focus states, semantic HTML, ARIA where needed.
- Performance: CSS-only motion where possible; minimal JS.

### Differentiation – “The one thing they remember”
**“This feels like a real local guide for Coimbatore, not a template.”**

- Strong **display typography** for hero and section titles.
- **Warm, place-based palette** (terracotta/rust or deep teal + warm neutrals), not generic red or purple.
- **Staggered load motion** so the page feels composed and intentional.
- **Atmosphere** in the hero (gradient + optional grain) and one section with subtle texture or pattern.

---

## 2. Frontend Aesthetics – Concrete Choices

### Typography
| Role        | Font choice           | Use case                          |
|------------|------------------------|-----------------------------------|
| Display    | **Fraunces** or **DM Serif Display** | Hero headline, “Our Listing” label |
| Body / UI  | **Poppins** (required)| Nav, buttons, card text, search   |

- Pairing: One serif for identity and one sans for clarity; avoids “Inter everywhere” and stays readable.

### Color & theme (CSS variables)
- **Primary accent:** Terracotta/rust `#B8522E` (warm, local, not tech-red).
- **Primary dark:** `#8B3D24` (hover/active).
- **Neutral base:** Warm off-white `#FAF8F5`, warm grey `#6B5B52` for muted text.
- **Text:** Charcoal `#2C2825` for body; headings can use same or primary for emphasis.
- **Backgrounds:** Section alternation – warm white vs. very light warm grey `#F5F1EC`; one section can use a subtle pattern.

### Motion
- **Hero:**  
  - Headline: fade-in + translateY, ~0.4s.  
  - Subtitle: same, delay 0.1s.  
  - Search bar: fade-in + slight scale, delay 0.25s.
- **Category grid:**  
  - Each card: fade-in + translateY; `animation-delay` staggered (e.g. 0.05s × index).  
  - Hover: translateY(-4px), box-shadow transition.
- **Section labels:** Optional short fade-in when in view (could be scroll-triggered later; for now on-load is enough).

### Spatial composition
- **Hero:** Centered content; optional soft diagonal or blob shape behind copy for depth (CSS gradient or pseudo-element).
- **Our Listing:** 6-column grid (responsive to 4 → 2 → 1); generous gap; one card can be “featured” (slightly larger or different background) to break symmetry.
- **Sections:** Clear spacing; “Our Listing” label small, uppercase, letter-spaced (editorial).

### Backgrounds & visual detail
- **Hero:** Gradient (warm dusk: deep rust → warm navy or deep teal) + overlay; optional `filter: grain` or very low-opacity noise for texture.
- **Body:** `background-color: var(--warm-bg)`.
- **Cards:** Light border + soft shadow; hover: stronger shadow, no harsh outlines.
- **Decorative:** Thin rule or dot under “Our Listing”; no heavy illustration unless we add a single asset later.

---

## 3. Component-Level Plan

| Section      | Design treatment |
|-------------|-------------------|
| Header      | Warm white bar; logo (display font for “MyCovai”); nav and “Add Listing” CTA in primary color; sticky. |
| Hero        | Full-width gradient + overlay; display font for “Let’s Explore Coimbatore”; search bar as one strip (inputs + dropdown + button) with clear focus states. |
| Our Listing | Uppercase label “Our Listing”; 12 category cards in grid; staggered reveal; one highlighted card (e.g. Restaurants or IT Companies); icons + label + count. |
| Events      | Compact block; “Featured Events” in display or Poppins bold; same warm palette. |
| News        | “Latest News” same style; reuse existing news cards with warm card styling. |
| Subscribe   | Simple card; primary CTA button; same typography and colors. |
| Footer      | Existing component; ensure link/button colors use primary variables. |

---

## 4. Implementation Order

1. **CSS variables** – New palette and fonts in `homepage-directone.css` (or renamed `homepage-mycovai.css`).
2. **Typography** – Add Fraunces (or DM Serif Display) for display; keep Poppins for body/UI; apply to hero and section titles.
3. **Hero** – Gradient, overlay, headline/subtitle/search with motion classes.
4. **Category grid** – Staggered animation, hover states, one featured card.
5. **Sections** – Events, News, Subscribe: spacing and type alignment with design system.
6. **Polish** – Focus states, optional grain on hero, any final spacing/tweaks.

---

## 5. Out of Scope (for this pass)

- Full search logic (form still posts to listing index).
- Changing backend or listing counts.
- New imagery (hero can stay gradient-only until assets exist).
- Dark mode (can be added later using same variables).

This plan is the single source of truth for the homepage redesign and aligns with the frontend-design skill: bold direction, distinctive typography and color, motion, and spatial composition with a clear “editorial local guide” identity for MyCovai.
