# Covai Emergency & Civic Directory – Integration Plan

**Source:** `covai-directory.html` (standalone HTML)  
**Target:** MyCovai website (mycovai.in)  
**Date:** March 2026

---

## 1. Placement & File Naming

| Decision | Value | Rationale |
|----------|-------|-----------|
| **Folder** | `directory/` | Matches existing directory structure (schools, hospitals, government-offices, etc.) |
| **File name** | `emergency-civic-directory.php` | Clear, SEO-friendly; distinguishes from `government-offices.php` (which lists offices from DB) |
| **URL** | `/directory/emergency-civic-directory.php` or `/emergency-civic-directory` | Clean path; consider `.htaccess` rewrite for pretty URL |

**Alternative names considered:**
- `government-directory.php` – original suggestion in HTML comments; but `government-offices.php` already exists
- `emergency-directory.php` – shorter; "civic" adds context for CCMC, Collector, etc.

---

## 2. Branding & Layout Adaptations

### 2.1 Header & Footer
- **Replace** the standalone `<nav>` with `components/directory-header.php` (homepage-header + directory-nav)
- **Replace** the standalone `<footer>` with `components/footer.php` (which loads `footer-covai.php` when `MYCOVAI_CONFIG_LOADED`)

### 2.2 Configuration
- **Require** `core/omr-connect.php` (loads `mycovai-config.php`) so `MYCOVAI_CONFIG_LOADED` is set
- This ensures footer-covai, correct base URLs, and MyCovai branding

### 2.3 Meta & SEO
- Use `get_canonical_base()` for canonical URL
- Add meta description, keywords, og:*, twitter:*
- Page title: `Emergency & Civic Directory – Coimbatore | MyCovai`

### 2.4 In-Page Jump Links
The original nav had anchor links: #police, #district, #fire, #civic, #emergency, #sources.  
**Solution:** Add a compact "On this page" / quick-jump bar below the emergency banner so users can jump to sections on this long page.

### 2.5 Design Consistency
- **Keep** the page’s own CSS (Playfair Display, DM Sans, design tokens) – it’s polished and fits the emergency/civic theme
- **Align** accent colours with MyCovai green (`#2E6B3E`) – already present in the HTML
- **Extract** page CSS to `assets/css/emergency-civic-directory.css` for maintainability

---

## 3. Navigation Updates

### 3.1 Directory Subnav
Add to `components/directory-nav.php`:
```php
['Emergency & Civic', '/directory/emergency-civic-directory.php'],
```

### 3.2 Footer Links (footer-covai.php)
Add under Useful Links or Explore:
```html
<li><a href="<?php echo $baseUrl; ?>directory/emergency-civic-directory.php">Emergency Directory</a></li>
```

---

## 4. .htaccess (Optional Pretty URL)
```apache
RewriteRule ^emergency-civic-directory$ /directory/emergency-civic-directory.php [L,NC]
```

---

## 5. File Structure After Integration

```
directory/
├── emergency-civic-directory.php   ← New (converted from covai-directory.html)
├── government-offices.php
├── schools.php
└── ...

assets/css/
├── emergency-civic-directory.css   ← New (extracted from inline styles)
└── ...
```

---

## 6. Content Notes
- The page covers: City Police (4 zones), All-Women PS, District Police, Fire & Rescue, Civic offices (CCMC, Collector, etc.), Emergency helplines, Sources
- One internal link in Sources points to `mycovai.in/directory/government-offices.php` – already correct
- All phone links use `tel:`; all external links use `target="_blank"` – keep as is

---

## 7. Checklist
- [ ] Create `directory/emergency-civic-directory.php` with header/footer includes
- [ ] Extract CSS to `assets/css/emergency-civic-directory.css`
- [ ] Add "Emergency & Civic" to directory-nav.php
- [ ] Add "Emergency Directory" link to footer-covai.php
- [ ] (Optional) Add .htaccess rewrite for `/emergency-civic-directory`
- [ ] Test on mycovai.in – header, footer, mobile, zone filter JS
