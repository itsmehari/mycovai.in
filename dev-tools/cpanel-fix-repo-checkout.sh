#!/bin/bash
# Run on the server (cPanel → Terminal) to fix a partial Git working tree.
# Usage:
#   bash /home3/metap8ok/cpanel-fix-repo-checkout.sh
# Or after uploading this file to your home directory:
#   bash ~/cpanel-fix-repo-checkout.sh
#
# Default repo path matches cPanel Git™ for mycovai.in

set -e
REPO="${CPANEL_REPO_PATH:-/home3/metap8ok/repositories/mycovai.in}"

if [[ ! -d "$REPO/.git" ]]; then
  echo "ERROR: Not a git repo: $REPO"
  echo "Set CPANEL_REPO_PATH to your clone path, e.g. export CPANEL_REPO_PATH=/home3/metap8ok/repositories/mycovai.in"
  exit 1
fi

cd "$REPO"
echo "==> Repo: $REPO"
echo "==> Disabling sparse-checkout (ignore errors if not enabled)..."
git sparse-checkout disable 2>/dev/null || true
rm -f .git/info/sparse-checkout 2>/dev/null || true

echo "==> Fetching origin..."
git fetch origin

echo "==> Checking out main..."
git checkout main 2>/dev/null || git checkout -B main "origin/main"

echo "==> Resetting to origin/main..."
git reset --hard origin/main

echo "==> Top-level entries (first 40):"
ls -la | head -40

echo ""
echo "Done. Refresh cPanel File Manager on: $REPO"
echo "Then use Git deploy to sync to document root if you use .cpanel.yml."
