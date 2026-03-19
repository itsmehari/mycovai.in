# Agent instructions (MyCovai)

Guidance for AI agents working in this repo.

---

## Database updates and live

When the user (or a task) asks to **update the database** (e.g. run a migration, change schema, fix data):

1. **Confirm target**
   - Ask: “Should this be applied to the **live** database (mycovai.in / metap8ok_mycovai) or only to a local/sandbox?”

2. **If the user says live**
   - Describe exactly what will be run (e.g. which migration file or SQL).
   - Ask for explicit confirmation: e.g. “Run this against live? Reply **yes** to proceed.”
   - Do **not** execute against live until the user confirms.

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
