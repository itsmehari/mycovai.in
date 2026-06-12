# Implementation phase status (MyCovai)

**Live companion to:** `.cursor/plans/mycovai_php_security_audit_5e7e1e8e.plan.md`  
**Last updated:** 2026-05-29

---

## Security audit plan (Phases 1–6) — complete

| ID | Phase | Status |
|----|-------|--------|
| phase1-credentials-errors | DB creds, display_errors, block database/ | ✅ |
| phase1-employer-owner-auth | Magic-link employer/owner auth | ✅ |
| phase2-csrf-admin | CSRF, admin redirect, migrations lock | ✅ |
| phase2-content-consolidation | News/events IA, nav, noindex OMR | ✅ |
| phase2-logic-fixes | Jobs, counts, events admin | ✅ |
| phase3-admin-improvements | Pagination, role nav, error handler | ✅ |
| phase4-ui-branding | Logo, nav, CTAs | ✅ |
| phase5-legacy-news-cleanup | Static local-news removal | ✅ |
| phase5-legacy-landers-removal | listings/, pentahive/, BLO | ✅ |
| phase5-seo-performance | Cache, sitemap, job landers | ✅ |
| phase6-documentation | Deploy, playbook, E2E | ✅ |

---

## Legacy cleanup sprints — complete

| Sprint | Status | Doc |
|--------|--------|-----|
| P1 | info/events redirects, onboarding, 404/500, sitemaps, admin/hostels | `LEGACY-MYOMR-AUDIT.md` |
| P2 | Stale pages deleted, discover/events/restaurants, article-report, commonlogin | Same |
| P4 | Asset renames (job CSS/JS, news bulletin, events badge), audit CLI | Same |

---

## Post-audit backlog (P3 — ops & polish)

| Priority | Work | Doc |
|----------|------|-----|
| P3 | **Live deploy + E2E on production** | `docs/inbox/E2E-TEST-CHECKLIST.md` |
| P3 | **GSC sitemap resubmit** after deploy | `docs/inbox/SEO-MIGRATION-GSC.md` |
| P3 | Rotate production secrets | `docs/deployment/MYCOVAI-DEPLOYMENT-NOTES.md` |
| P3 | Hide legacy admin “News Bulletin” from non–super_admin | ✅ `navigation.php`, `dashboard.php`, `news-*.php` |
| P3 | GSC sitemap pre-flight CLI | ✅ `dev-tools/gsc-prep-sitemap-cli.php` |
| P3 | Rename `omr-connect.php` → covai alias in new code only | MYCOVAI-NEXT-STEPS-PLAN |
| P3 | Inner-page design refresh | MYCOVAI-NEXT-STEPS-PLAN |
| P3 | Delete `weblog/create-tables-remote.php` on server | Security |

---

## Other plans in `.cursor/plans/`

| Plan | Purpose | Status |
|------|---------|--------|
| `mycovai_php_security_audit_5e7e1e8e.plan.md` | Security + rebrand audit | Phases 1–6 done |
| `mycovai_cabinet_article_349c6d61.plan.md` | Cabinet article Covai | Content task |
| `job_visual_map_audit_3ba8ba33.plan.md` | Job system visual map | Reference |
