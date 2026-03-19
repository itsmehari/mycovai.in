<?php
/**
 * Elections 2026 subsite bootstrap – Coimbatore / mycovai.in
 * Do not use include-path.php or page-bootstrap.php (they do not exist in mycovai).
 */
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(__DIR__, 2));
}
require_once ROOT_PATH . '/core/omr-connect.php';
require_once ROOT_PATH . '/core/url-helpers.php';

$base = get_canonical_base();
define('ELECTIONS_2026_PATH', __DIR__ . '/..');
define('ELECTIONS_2026_BASE_URL', $base . '/coimbatore-elections-2026');
