<?php
require_once __DIR__ . '/includes/bootstrap.php';
$constituencies = require __DIR__ . '/includes/constituency-data.php';

header('Content-Type: application/xml; charset=utf-8');

$base = ELECTIONS_2026_BASE_URL;

$urls = [
    $base . '/',
    $base . '/know-your-constituency.php',
    $base . '/find-blo.php',
    $base . '/dates.php',
    $base . '/how-to-vote.php',
    $base . '/faq.php',
    $base . '/candidates.php',
    $base . '/news.php',
    $base . '/announcements.php',
    $base . '/newsletter.php',
    $base . '/quiz.php',
    $base . '/results-2026.php',
    $base . '/index-tamil.php',
];
foreach ($constituencies as $slug => $ac) {
    $urls[] = $base . '/constituency/' . $slug . '.php';
}

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach ($urls as $loc) {
    echo '  <url><loc>' . htmlspecialchars($loc, ENT_XML1) . '</loc></url>' . "\n";
}
echo '</urlset>';
