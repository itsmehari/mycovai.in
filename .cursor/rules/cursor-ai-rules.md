
# Cursor AI Development Ruleset for MyOMR.in

## 👤 Developer Persona

**Name**: Hari Krishnan  
**Role**: Senior Full-stack Developer, UI/UX Specialist  
**Environment**: VS Code, cPanel, phpMyAdmin  
**Stack**: HTML5, CSS3, Bootstrap 5, PHP (Procedural), MySQL

## 🧱 Tech Stack

| Layer      | Tech Used                              |
|------------|----------------------------------------|
| Frontend   | HTML5, CSS3, Bootstrap 5, Vanilla JS   |
| Backend    | Core PHP (Procedural)                  |
| Database   | MySQL (phpMyAdmin)                     |
| Deployment | cPanel Shared Hosting                  |
| Assets     | Self-hosted JS/CSS in /assets, jQuery (fallback)

## 🗂️ Folder Structure Highlights

- /admin/
- /assets/css/
- /components/
- /core/
- /events/
- /local-news/
- /omr-listings/
- /discover-myomr/
- /listings/

## ✍️ Cursor AI Directive Syntax

```php
// @cursor: paginate omr_schools table (9 per page) using mysqli
// @cursor: create SEO schema for NewsArticle using og tags and structured data
// @cursor: generate responsive card for event using Bootstrap
// @cursor: write contact form logic to send email + save in database
// @cursor: create admin dashboard table for restaurants with edit/delete
// @cursor: add form validation for event submission with client-side checks
// @cursor: inject responsive map iframe based on Perungudi coordinates
// @cursor: generate dynamic news list using LIMIT, OFFSET, and date DESC
// @cursor: create login session logic and protect /admin/ folder
// @cursor: refactor /components/nav-footer-styles.css into base-footer.css
```

## ✅ Global Development Rules

- Use kebab-case for files.
- Poppins font, max-width 1280px, mobile-first layout.
- `.htaccess` must include URL rewrite and Options -Indexes.
- All user input must be sanitized and validated.

## 🔒 Security Guidelines

- Validate all fields both client and server side.
- Use prepared statements.
- Protect /admin/ with session checks.

## 🧩 Reusable Components

- `/components/myomr-news-bulletin.php`
- `/components/main-nav.php`
- `/components/footer.php`
- `/components/social-icons.php`
- `/components/admin-breadcrumbs.php`

## 📄 Page-Specific Behaviors

Refer to the complete structure inside `/docs` for details on page-wise functions and access flows.

## 📈 SEO + Analytics

- Use `NewsArticle` schema for news.
- Canonical URL tag.
- Log warnings in `weblog/logfile.txt`

## 🗄️ Database updates and live

When the user asks to **update the database** (migrations, schema, data fixes):

1. **Confirm:** Ask if the change is for **live** (mycovai.in / metap8ok_mycovai) or local only.
2. **If live:** Do not run against live until the user explicitly confirms (e.g. “Run this on live? Reply yes to proceed.”).
3. **After confirmation:** Run with `DB_HOST=mycovai.in`, report result, suggest committing changes.

See root `AGENTS.md` and `LEARNINGS.md` for full workflow.
