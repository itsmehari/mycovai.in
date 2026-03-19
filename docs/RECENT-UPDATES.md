# Recent updates (MyCovai)

Short log of notable changes. For full worklogs see `docs/worklogs/` (e.g. `worklog-dd-mm-yyyy.md`).

---

## 2026-03-19

**Remote database connectivity and docs**

- **Remote DB:** `core/omr-connect.php` now supports env vars (`DB_HOST`, `DB_PORT`, `DB_USER`, `DB_PASS`, `DB_NAME`). Use `DB_HOST=mycovai.in` to connect to live from local.
- **Server name:** All MyCovai DB/docs use **mycovai.in**; password default from _myomr.in repository.
- **Test:** Direct remote connection to mycovai.in tested and working. CLI test: `dev-tools/test-db-connect-cli.php` with env set.
- **LEARNINGS.md** created at root (remote DB + “confirm before live DB update” workflow).
- **Cursor rules & AGENTS.md:** When you ask to “update the database”, the AI will ask whether the change is for **live** and will only run on live after your explicit confirmation, then suggest committing.
- **Live DB summary:** 50 tables, 134 rows (see `docs/data-backend/MYCOVAI-DATABASE-SUMMARY.md`).
