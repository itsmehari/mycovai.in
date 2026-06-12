<?php
/**
 * XML sitemap for Coworking Spaces module.
 * Route: /coworking-spaces/sitemap.xml
 */
require_once __DIR__ . '/../core/omr-connect.php';
require_once __DIR__ . '/../core/url-helpers.php';

if (php_sapi_name() !== 'cli') {
    header('Content-Type: application/xml; charset=utf-8');
}

$base = get_canonical_base();
$urls = [
    $base . '/coworking-spaces/',
    $base . '/coworking-spaces/add-space.php',
    $base . '/coworking-spaces/owner-register.php',
];

try {
    if (isset($conn) && $conn && !$conn->connect_error) {
        $res = $conn->query("SELECT id, updated_at FROM coworking_spaces WHERE status = 'approved' ORDER BY updated_at DESC LIMIT 2000");
        if ($res) {
            while ($row = $res->fetch_assoc()) {
                $urls[] = $base . '/coworking-spaces/space/' . (int) $row['id'];
            }
        }
    }
} catch (Throwable $e) {
    error_log('Coworking sitemap: ' . $e->getMessage());
}

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach ($urls as $loc) {
    echo '  <url><loc>' . htmlspecialchars($loc, ENT_XML1) . '</loc></url>' . "\n";
}
echo '</urlset>';
