# Update .cursor/db-summary with current date. Run from repo root.
# Requires: DB_HOST=mycovai.in (set in env or edit below)
$ErrorActionPreference = "Stop"
$root = Split-Path -Parent (Split-Path -Parent $MyInvocation.MyCommand.Path)
Set-Location $root
$date = Get-Date -Format "dd-MM-yyyy"
$outFile = Join-Path $root ".cursor\db-summary-$date.md"
$env:DB_HOST = "mycovai.in"
$header = "# MyCovai database summary (live)`n`n**Snapshot date:** $date`n**Database:** metap8ok_mycovai`n**Host:** mycovai.in (cPanel)`n**Source:** dev-tools/db-summary-cli.php`n`n---`n`n"
$output = & php dev-tools/db-summary-cli.php 2>&1
if ($LASTEXITCODE -ne 0) { Write-Error "db-summary-cli.php failed"; exit 1 }
$header + $output | Set-Content -Path $outFile -Encoding UTF8
Write-Host "Written: $outFile"
