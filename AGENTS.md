# Agent instructions (MyCovai)

Guidance for AI agents working in this repo.

---

## Database updates and live

When the user asks to **update the live database** ("update live", "apply to live"): Execute directly. Do not ask for confirmation. User has remote connectivity.

When the user asks to **update the database** without specifying live:

1. **Confirm target**
   - Ask: “Should this be applied to the **live** database (mycovai.in / metap8ok_mycovai) or only to a local/sandbox?”

2. **If the user says live**
   - Execute directly. Set DB_HOST=mycovai.in and run the script.
   - Report success or errors; suggest committing changed files.
   - (Removed: Ask for explicit confirmation: e.g. “Run this against live? Reply **yes** to proceed.”
   - **Seamless live updates:** When user asks to "update live" or "apply to live", execute directly without asking again. User has remote connectivity.

3. **After the user confirms (e.g. “yes”)**
   - Run the migration/script against the live DB (e.g. set `DB_HOST=mycovai.in` and run the PHP migration or SQL).
   - Report success or any errors.
   - Suggest committing any changed files (migrations, config, docs) to version control.

**Connection for live:** Use the same credentials as in `core/omr-connect.php`, with `DB_HOST=mycovai.in` (and optional `DB_PORT`, `DB_USER`, `DB_PASS`, `DB_NAME`). See `LEARNINGS.md` and `docs/data-backend/LOCAL_TO_REMOTE_DATABASE_SETUP.md`.

---

## Remote database connectivity

- **Direct remote:** Set `DB_HOST=mycovai.in` (and other env vars if needed). Ensure the machine’s public IP is allowed in cPanel → Remote MySQL®.
- **Test:** `php dev-tools/test-db-connect-cli.php` with env set.
- **Summary:** `php dev-tools/db-summary-cli.php` with env set to list tables and row counts on the connected database.
- **Update .cursor db-summary:** After every database update and daily, run the summary script and save output to `.cursor/db-summary-dd-MM-yyyy.md` (see LEARNINGS.md).

---

## Documentation

- Read `docs/README.md` before adding or moving documentation.
- Worklogs: `docs/worklogs/worklog-dd-mm-yyyy.md`.
- Recent changes: `docs/RECENT-UPDATES.md`.
- Learnings: `LEARNINGS.md`.

---

## Banner ads and Amazon affiliate (mycovai.in)

- **Slots:** Commercial and affiliate units use the registry in `core/ad-registry.php` (and optional `core/amazon-affiliate-registry.php`) plus `components/ad-banner-slot.php`. See `docs/ads.md`.
- **Decisions:** Treat **slot + optional category/page rules** as the source of “which link can appear,” not implicit AI. Prefer explicit `active` flags and documented pools (homepage vs article vs directory).
- **Scaling:** If the user adds **many** affiliate links or needs non-dev editing, plan a **DB table** and small admin UI; do not keep growing huge PHP arrays without a migration path. Confirm schema with the user before applying live DB changes (see database section above).
- **Compliance:** Affiliate disclosure page, footer link, Amazon Associates wording from Central, `rel="sponsored"` on paid/affiliate links. Reference `docs/inbox/AMAZON-AFFILIATE-INTEGRATION-PLAN.md` for governance, rotation logic, and storage evolution.
