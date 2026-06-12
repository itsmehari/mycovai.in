# MyCovai.in — Project understanding (short)

> **Full live documentation:** [../LIVE-SYSTEM-MAP.md](../LIVE-SYSTEM-MAP.md)  
> **10x maintenance:** [../maintenance/MAINTENANCE-RUNBOOK.md](../maintenance/MAINTENANCE-RUNBOOK.md)

## Identity

- **Product:** MyCovai — Coimbatore directory, news, jobs, events, hostels, coworking  
- **Domain:** mycovai.in  
- **Origin:** Forked from MyOMR.in (Chennai OMR); legacy cleanup ongoing  

## Deploy flow

Local (Windows) → Git → cPanel (Linux) via Git sync.

## Principles

1. Covai-focused user-facing content  
2. Single sources: `core/mycovai-config.php`, `LIVE-SYSTEM-MAP.md`  
3. No secrets in git; env vars on server  
4. Update live map when routes/modules change  

## Legacy

See [../maintenance/LEGACY-MYOMR-AUDIT.md](../maintenance/LEGACY-MYOMR-AUDIT.md).

*Last updated: 2026-05-29*
