#!/usr/bin/env bash
# Run ON THE SERVER (SSH) after git/rsync deploy if error_log shows:
#   AH00529: ... .htaccess pcfg_openfile: unable to check htaccess file
#   ensure it is readable and that '.../mycovai.in/' is executable
#
# Usage:
#   bash fix-cpanel-docroot-permissions.sh
#   bash fix-cpanel-docroot-permissions.sh /home3/metap8ok/mycovai.in

set -euo pipefail
DOCROOT="${1:-${HOME}/mycovai.in}"

if [[ ! -d "$DOCROOT" ]]; then
  echo "Not a directory: $DOCROOT" >&2
  exit 1
fi

echo "Fixing permissions under: $DOCROOT"

# Apache must be able to traverse every path segment to the site root
chmod u=rwx,go=rx "$DOCROOT"

# .htaccess must be world-readable (644) on typical shared hosting
if [[ -f "$DOCROOT/.htaccess" ]]; then
  chmod 644 "$DOCROOT/.htaccess"
fi

# Subfolder .htaccess files (e.g. hostels-pgs, test-website)
find "$DOCROOT" -name '.htaccess' -type f -exec chmod 644 {} \;

# Directories: executable bit required for Apache to enter (755)
find "$DOCROOT" -type d -exec chmod 755 {} \;

# PHP/HTML and static files: readable (644)
find "$DOCROOT" -type f \( -name '*.php' -o -name '*.html' -o -name '*.css' -o -name '*.js' \) -exec chmod 644 {} \; 2>/dev/null || true

echo "Done. If errors persist, in cPanel set ownership to your account user (not root) on the docroot."
