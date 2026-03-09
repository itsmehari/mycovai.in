# Phase 1 WBS: Shared Layout Components

## Work Breakdown Structure

```
Phase 1: Shared Layout Components
├── 1.1 Create homepage-header.php
│   ├── 1.1.1 Extract header markup from index.php
│   ├── 1.1.2 Add optional active-link detection
│   └── 1.1.3 Ensure mobile menu toggle works
├── 1.2 Create directory-nav.php
│   ├── 1.2.1 Define category links (schools, hospitals, banks, etc.)
│   ├── 1.2.2 Apply MyCovai design tokens (terracotta)
│   └── 1.2.3 Fix paths for /directory/ context
├── 1.3 Create whatsapp-float.php
│   ├── 1.3.1 Terracotta background (#B8522E)
│   └── 1.3.2 Reuse SOCIAL_WHATSAPP from config
├── 1.4 Update omr-listings-nav.php
│   ├── 1.4.1 Replace #333/#04AA6D with MyCovai tokens
│   └── 1.4.2 Fix href paths for directory context
├── 1.5 Refactor index.php
│   └── 1.5.1 Replace inline header with include homepage-header.php
├── 1.6 Update directory pages
│   ├── 1.6.1 directory/index.php → homepage-header
│   ├── 1.6.2 Pages with directory-nav → add homepage-header, fix include
│   ├── 1.6.3 Pages with main-nav only → homepage-header
│   └── 1.6.4 Pages with omr-listings-nav → add homepage-header if missing
└── 1.7 Footer & WhatsApp
    ├── 1.7.1 Verify footer.php uses footer-covai when config loaded
    └── 1.7.2 Add whatsapp-float.php to directory pages (or global)
```

## Task Dependency

1.1 → 1.5, 1.6  
1.2 → 1.6 (directory-nav pages)  
1.3 → 1.7  
1.4 → 1.6 (omr-listings-nav pages)  
1.5 independent  
1.6 depends on 1.1, 1.2, 1.4  
1.7 depends on 1.3  

## Deliverables

| # | Deliverable | File(s) |
|---|-------------|---------|
| D1 | Shared header component | `components/homepage-header.php` |
| D2 | Directory category sub-nav | `components/directory-nav.php` |
| D3 | WhatsApp float component | `components/whatsapp-float.php` |
| D4 | Updated listings nav | `components/omr-listings-nav.php` |
| D5 | Refactored index | `index.php` |
| D6 | Updated directory hub | `directory/index.php` |
| D7 | Updated directory list/detail pages | Multiple `directory/*.php` |
