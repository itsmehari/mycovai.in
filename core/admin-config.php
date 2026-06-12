<?php
/**
 * Admin credentials — use environment variables on production.
 * Set MYCOVAI_ADMIN_PASSWORD_HASH to a bcrypt hash from:
 *   php -r "echo password_hash('your-strong-password', PASSWORD_DEFAULT);"
 */

require_once __DIR__ . '/env.php';

/** Dev-only fallback bcrypt for password "password" — never use in production. */
const MYCOVAI_DEV_PASSWORD_BCRYPT = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';

if (!defined('MYCOVAI_ADMIN_USERNAME')) {
    define('MYCOVAI_ADMIN_USERNAME', omr_env_var('MYCOVAI_ADMIN_USERNAME', 'admin') ?? 'admin');
}
if (!defined('MYOMR_ADMIN_USERNAME')) {
    define('MYOMR_ADMIN_USERNAME', MYCOVAI_ADMIN_USERNAME);
}

if (!defined('MYCOVAI_ADMIN_PASSWORD_HASH')) {
    $hash = omr_env_var('MYCOVAI_ADMIN_PASSWORD_HASH');
    if ($hash === null || $hash === '') {
        $hash = omr_is_production() ? '' : MYCOVAI_DEV_PASSWORD_BCRYPT;
    }
    define('MYCOVAI_ADMIN_PASSWORD_HASH', $hash);
}
if (!defined('MYOMR_ADMIN_PASSWORD_HASH')) {
    define('MYOMR_ADMIN_PASSWORD_HASH', MYCOVAI_ADMIN_PASSWORD_HASH);
}

if (!defined('MYCOVAI_ADMIN_DEFAULT_ROLE')) {
    define('MYCOVAI_ADMIN_DEFAULT_ROLE', 'super_admin');
}
if (!defined('MYOMR_ADMIN_DEFAULT_ROLE')) {
    define('MYOMR_ADMIN_DEFAULT_ROLE', MYCOVAI_ADMIN_DEFAULT_ROLE);
}

if (!defined('MYCOVAI_EDITOR_USERNAME')) {
    define('MYCOVAI_EDITOR_USERNAME', omr_env_var('MYCOVAI_EDITOR_USERNAME', 'events') ?? 'events');
}
if (!defined('MYOMR_EDITOR_USERNAME')) {
    define('MYOMR_EDITOR_USERNAME', MYCOVAI_EDITOR_USERNAME);
}

if (!defined('MYCOVAI_EDITOR_PASSWORD_HASH')) {
    $editorHash = omr_env_var('MYCOVAI_EDITOR_PASSWORD_HASH');
    if ($editorHash === null || $editorHash === '') {
        $editorHash = omr_is_production() ? '' : MYCOVAI_DEV_PASSWORD_BCRYPT;
    }
    define('MYCOVAI_EDITOR_PASSWORD_HASH', $editorHash);
}
if (!defined('MYOMR_EDITOR_PASSWORD_HASH')) {
    define('MYOMR_EDITOR_PASSWORD_HASH', MYCOVAI_EDITOR_PASSWORD_HASH);
}
