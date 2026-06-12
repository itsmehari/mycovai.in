<?php
/**
 * Global environment flags. Production is the default unless MYCOVAI_ENV=development.
 */

function omr_env(): string {
    if (isset($_SERVER['MYCOVAI_ENV']) && $_SERVER['MYCOVAI_ENV'] !== '') {
        return (string) $_SERVER['MYCOVAI_ENV'];
    }
    if (getenv('MYCOVAI_ENV')) {
        return (string) getenv('MYCOVAI_ENV');
    }
    if (isset($_SERVER['MYOMR_ENV']) && $_SERVER['MYOMR_ENV'] !== '') {
        return (string) $_SERVER['MYOMR_ENV'];
    }
    if (getenv('MYOMR_ENV')) {
        return (string) getenv('MYOMR_ENV');
    }
    return 'production';
}

function omr_is_production(): bool {
    return omr_env() === 'production';
}

function omr_is_development(): bool {
    return omr_env() !== 'production';
}

/**
 * Read config from getenv() or $_SERVER (cPanel env vars).
 */
function omr_env_var(string $key, ?string $default = null): ?string {
    $val = getenv($key);
    if ($val !== false && $val !== '') {
        return (string) $val;
    }
    if (isset($_SERVER[$key]) && $_SERVER[$key] !== '') {
        return (string) $_SERVER[$key];
    }
    return $default;
}

if (!defined('DEVELOPMENT_MODE')) {
    define('DEVELOPMENT_MODE', omr_is_development());
}
