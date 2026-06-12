#!/bin/bash
# Run on cPanel Terminal AFTER git deploy (rsync does not delete orphaned folders).
# Usage: bash dev-tools/post-deploy-cpanel-cleanup.sh
set -e
DOCROOT="${DEPLOYPATH:-/home3/metap8ok/mycovai.in}"

echo "==> Docroot: $DOCROOT"
cd "$DOCROOT"

remove_if_exists() {
  if [[ -e "$1" ]]; then
    echo "Removing $1"
    rm -rf "$1"
  fi
}

# Retired OMR microsites / folders (301 rules exist but folders may linger)
remove_if_exists pentahive
remove_if_exists listings
remove_if_exists events
remove_if_exists free-ads-chennai

# Security — dev one-off scripts
remove_if_exists weblog/create-tables-remote.php

# Retired OMR info pages (if rsync left copies)
remove_if_exists info/citizens-charter-old-mahabali-puram-road.php
remove_if_exists info/pallikaranai-marsh-ramsar-wetland.php
remove_if_exists info/report-civic-issue-omr.php
remove_if_exists discover/it-parks-in-omr.php

# Stale duplicate policy pages (301 to root legal pages)
remove_if_exists weblog/contact-my-omr-team.php
remove_if_exists weblog/general-data-policy-of-my-omr.php
remove_if_exists info/website-privacy-policy-of-my-omr.php

echo "==> Done. Verify: curl -sI https://mycovai.in/pentahive/ | head -3"
