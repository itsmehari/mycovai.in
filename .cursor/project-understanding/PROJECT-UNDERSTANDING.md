# MyCovai.in – Project Understanding

> **Purpose:** A place for everything, and everything in its place.  
> **Use this file** when onboarding, planning changes, or reviewing the codebase.

---

## 1. Project Identity

| Property | Value |
|----------|-------|
| **Current project** | MyCovai – Coimbatore directory & listings |
| **Site** | mycovai.in |
| **Region** | Coimbatore, Tamil Nadu (Covai) |
| **Legacy origin** | Copied/forked from **MyOMR.in** (OMR, Chennai) |

**Important:** The codebase still has file names, constants, and content traces from MyOMR.in. These are legacy and should not be treated as Covai content.

---

## 2. Deployment Flow

```
Local (Windows)  →  Git push  →  cPanel shared hosting (Linux) via Git sync
```

- **Development environment:** Local directory on your computer
- **Production:** cPanel Linux shared hosting
- **Sync mechanism:** Git (push from local, pull on server)
- **Principle:** Only production-relevant files should be committed and reach the server

---

## 3. What Must Never Reach Git / Server

| Category | Examples | Reason |
|----------|----------|--------|
| Credentials & secrets | `.env`, `*local.php`, DB dumps | Security |
| Backups | `/backups/`, `_Root.zip` | Redundant, large |
| Dev-only tools output | `dev-tools/backups/`, `exports/`, `logs/` | Development artifacts |
| IDE config | `.vscode/` (FTP/SFTP) | Personal setup |
| Archives & staging | `_archive/`, `dev-tools/staging/` | Planning, audit, removed files |
| Personal notes | `LEARNINGS*.md`, `TODO.local.md` | Local use only |
| Unrelated to Covai | OMR-only content, orphaned MyOMR files | Not part of live site |

---

## 4. What Can Stay Locally (Not Pushed)

- **Development:** Scripts in `/dev-tools/`, migrations, deploy helpers
- **Planning:** PRDs, worklogs, architecture notes in `/docs/`
- **Archives:** `_archive/`, `docs/archive/`, `dev-tools/staging/`
- **Staging/audit:** Old files under review, pre-removal backups
- **Cursor config:** `.cursor/rules`, `.cursor/skills` (if desired; can be shared or ignored)

These may be committed for team use or kept only locally via `.gitignore`.

---

## 5. Project Goals (Maintenance)

1. **Neat structure** – Everything in its place, no stray files
2. **Clean Git** – No unwanted files reach the server
3. **Covai focus** – No content or naming that is purely OMR/MyOMR unless needed for live site
4. **Legacy cleanup** – Gradually remove or rename traces of MyOMR.in

---

## 6. Legacy Traces (MyOMR.in Origin)

### File naming
- `omr-connect.php` – use `covai-connect.php` for new code (wrapper exists)
- `covai-directory-list.php` – replaced omr-road-database-list
- `news-old-mahabalipuram-road` – archived
- `*-omr*.php` in listings, local-news, info – legacy URLs still in use

### Constants (migrated to MYCOVAI_*)
- `MYCOVAI_*` now primary; `MYOMR_*` kept as aliases for compatibility
- `X-Covai-Cache` header (was X-OMR-Cache)

### Content / paths
- OMR localities (Perungudi, Thoraipakkam, etc.) vs Covai localities (RS Puram, Gandhipuram, etc.)
- `news-old-mahabalipuram-road-omr/` links in components
- OMR-specific listing URLs (rent-house-omr.php, etc.)

**Strategy:** Keep functional files that serve Covai; over time, rename and refactor for Covai branding. Remove orphaned or purely OMR content.

---

## 7. Folder Roles (Quick Reference)

| Folder | Purpose | Push to Git? |
|--------|---------|--------------|
| `/admin/` | Admin CRUD | Yes |
| `/assets/` | Global CSS, JS, images | Yes |
| `/components/` | Reusable layout | Yes |
| `/core/` | DB, config, helpers | Yes |
| `/database/` | Migrations, seeds | Yes (schema, not dumps) |
| `/directory/` | Listings (schools, banks, etc.) | Yes |
| `/discover/` | Discover pages | Yes |
| `/jobs/`, `/hostels-pgs/`, `/coworking-spaces/` | Feature modules | Yes |
| `/local-events/`, `/local-news/` | Events & news | Yes |
| `/weblog/` | Sitemap, shared logic | Yes |
| `/docs/` | Worklogs, PRDs, architecture | Optional |
| `/dev-tools/` | Deploy, migrations, helpers | Scripts yes, output no |
| `/_archive/` | Removed/old files | No |
| `/dev-tools/staging/` | Audit, staging | No |

---

## 8. Key References

- `.gitignore` – Patterns for files to never commit
- `docs/PROJECT-STRUCTURE.md` – Detailed structure and cleanup history
- `core/mycovai-config.php` – Site branding, region, tables
- Cursor rules: `.cursor/rules/` for coding conventions

---

*Last updated: 2025-03-09*
