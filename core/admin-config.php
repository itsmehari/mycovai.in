<?php
// Central admin config: username + hashed password
// Uses PHP password_hash at runtime for the provided static password.
// MyCovai branding – previously MYOMR_* (legacy)

if (!defined('MYCOVAI_ADMIN_USERNAME')) {
    define('MYCOVAI_ADMIN_USERNAME', 'admin');
}
if (!defined('MYOMR_ADMIN_USERNAME')) { define('MYOMR_ADMIN_USERNAME', MYCOVAI_ADMIN_USERNAME); }

if (!defined('MYCOVAI_ADMIN_PASSWORD_HASH')) {
    define('MYCOVAI_ADMIN_PASSWORD_HASH', password_hash('password', PASSWORD_DEFAULT));
}
if (!defined('MYOMR_ADMIN_PASSWORD_HASH')) { define('MYOMR_ADMIN_PASSWORD_HASH', MYCOVAI_ADMIN_PASSWORD_HASH); }

if (!defined('MYCOVAI_ADMIN_DEFAULT_ROLE')) {
    define('MYCOVAI_ADMIN_DEFAULT_ROLE', 'super_admin');
}
if (!defined('MYOMR_ADMIN_DEFAULT_ROLE')) { define('MYOMR_ADMIN_DEFAULT_ROLE', MYCOVAI_ADMIN_DEFAULT_ROLE); }

if (!defined('MYCOVAI_EDITOR_USERNAME')) {
    define('MYCOVAI_EDITOR_USERNAME', 'events');
}
if (!defined('MYOMR_EDITOR_USERNAME')) { define('MYOMR_EDITOR_USERNAME', MYCOVAI_EDITOR_USERNAME); }
if (!defined('MYCOVAI_EDITOR_PASSWORD_HASH')) {
    define('MYCOVAI_EDITOR_PASSWORD_HASH', password_hash('password', PASSWORD_DEFAULT));
}
if (!defined('MYOMR_EDITOR_PASSWORD_HASH')) { define('MYOMR_EDITOR_PASSWORD_HASH', MYCOVAI_EDITOR_PASSWORD_HASH); }


