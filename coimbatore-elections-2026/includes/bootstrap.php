<?php
/**
 * Elections 2026 subsite bootstrap – Coimbatore / mycovai.in
 * Do not use include-path.php or page-bootstrap.php (they do not exist in mycovai).
 */
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(__DIR__, 2));
}

$core_omr = ROOT_PATH . '/core/omr-connect.php';
if (!is_file($core_omr)) {
    header('Content-Type: text/html; charset=utf-8');
    http_response_code(503);
    echo '<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><title>Elections 2026 – Setup</title></head><body>';
    echo '<h1>Elections 2026: core files not found</h1>';
    echo '<p>Ensure the site is deployed so that the <strong>parent</strong> of <code>coimbatore-elections-2026/</code> contains <code>core/</code> and <code>components/</code>.</p>';
    echo '<p>Run <a href="../check-env.php">check-env.php</a> for a full diagnostic.</p>';
    echo '</body></html>';
    exit;
}

require_once $core_omr;
require_once ROOT_PATH . '/core/url-helpers.php';

$base = get_canonical_base();
define('ELECTIONS_2026_PATH', __DIR__ . '/..');
// CRITICAL: base URL must include /coimbatore-elections-2026 or hub/second-level links will 404 (they point to site root).
$elections_base = $base . '/coimbatore-elections-2026';
define('ELECTIONS_2026_BASE_URL', $elections_base);
