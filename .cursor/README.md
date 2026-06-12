# `.cursor/` — AI & maintenance hub (MyCovai)

**Start here for agents and ongoing maintenance.**

| File / folder | Purpose | Update when |
|---------------|---------|-------------|
| **[LIVE-SYSTEM-MAP.md](LIVE-SYSTEM-MAP.md)** | **10x master live doc** — modules, URLs, DB, config, tests, doc hierarchy | Any architecture, route, or module change |
| [maintenance/](maintenance/) | Runbooks, phase status, legacy MyOMR audit | After each cleanup sprint or deploy |
| [db-summaries/](db-summaries/) | Date-stamped live DB table/row snapshots | Daily + after every live DB change |
| [plans/](plans/) | Cursor implementation plans (security audit, articles, etc.) | When starting/finishing a planned initiative |
| [project-understanding/](project-understanding/) | Short onboarding pointer → LIVE-SYSTEM-MAP | Rarely |
| [rules/](rules/) | Cursor coding rules (ads, AI conventions) | When conventions change |
| [skills/](skills/) | Agent skills (e.g. frontend-design) | When adding skills |
| [mcp.json](mcp.json) | MCP server config for Cursor | When MCP setup changes |

## Quick links (repo root)

- `AGENTS.md` — agent rules (DB live updates, docs)
- `LEARNINGS.md` — gotchas and workflows
- `docs/README.md` — deep documentation library
- `docs/inbox/E2E-TEST-CHECKLIST.md` — pre-deploy flows
- `docs/inbox/CONTENT-EDITOR-PLAYBOOK.md` — which admin for what

## 10x documentation rule

1. **Change code** → update the relevant row/section in `LIVE-SYSTEM-MAP.md` (or linked maintenance doc).
2. **Finish a task** → note in `docs/RECENT-UPDATES.md` + worklog if substantial.
3. **Touch live DB** → new file in `db-summaries/db-summary-dd-MM-yyyy.md`.
4. **Retire legacy** → update `maintenance/LEGACY-MYOMR-AUDIT.md`.

Do not create duplicate maps in `docs/` without linking back to `LIVE-SYSTEM-MAP.md`.
