#!/bin/bash
# Run on cPanel Terminal AFTER git deploy (rsync does not delete orphaned folders).
# Also invoked automatically from .cpanel.yml after rsync.
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
remove_if_exists election-blo-details
remove_if_exists omr-election-blo
remove_if_exists test-website

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

# Retired OMR job landers (301 to Coimbatore pages)
for f in \
  jobs-in-omr-chennai.php \
  jobs-in-perungudi-omr.php \
  jobs-in-sholinganallur-omr.php \
  jobs-in-navalur-omr.php \
  jobs-in-thoraipakkam-omr.php \
  jobs-in-kelambakkam-omr.php \
  it-jobs-omr-chennai.php \
  weblog/experienced-jobs-omr-chennai.php \
  weblog/healthcare-jobs-omr-chennai.php \
  weblog/hospitality-jobs-omr-chennai.php
do
  remove_if_exists "$f"
done

echo "==> Done. Verify: curl -sI https://mycovai.in/pentahive/ | head -3"
