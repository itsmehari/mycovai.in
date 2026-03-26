<?php
/**
 * XML sitemap for database-driven news articles (English only; excludes *-tamil slugs).
 * Route: /local-news/sitemap.xml
 */
require_once __DIR__ . '/../core/omr-connect.php';
require_once __DIR__ . '/../core/url-helpers.php';

header('Content-Type: application/xml; charset=utf-8');

$base = get_canonical_base();

$sql = "SELECT slug, published_date, updated_at
        FROM articles
        WHERE status = 'published' AND slug NOT LIKE '%-tamil'
        ORDER BY published_date DESC";

$result = $conn->query($sql);

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

// Hub page
echo '  <url>' . "\n";
echo '    <loc>' . htmlspecialchars($base . '/coimbatore-news.php', ENT_XML1) . '</loc>' . "\n";
echo '    <changefreq>daily</changefreq>' . "\n";
echo '    <priority>0.9</priority>' . "\n";
echo '  </url>' . "\n";

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $slug = $row['slug'];
        $ts = !empty($row['updated_at']) ? strtotime($row['updated_at']) : strtotime($row['published_date']);
        $lastmod = $ts ? date('c', $ts) : date('c');
        $loc = $base . '/local-news/' . rawurlencode($slug);
        echo '  <url>' . "\n";
        echo '    <loc>' . htmlspecialchars($loc, ENT_XML1) . '</loc>' . "\n";
        echo '    <lastmod>' . htmlspecialchars($lastmod, ENT_XML1) . '</lastmod>' . "\n";
        echo '    <changefreq>weekly</changefreq>' . "\n";
        echo '    <priority>0.8</priority>' . "\n";
        echo '  </url>' . "\n";
    }
}

echo '</urlset>';
