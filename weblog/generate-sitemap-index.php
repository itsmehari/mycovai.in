<?php
// Root sitemap index – uses canonical base for Search Console (Phase 5.2: config so domain is correct)
if (!defined('MYCOVAI_CONFIG_LOADED')) {
    require_once __DIR__ . '/../core/mycovai-config.php';
}
require_once __DIR__ . '/../core/url-helpers.php';
header('Content-Type: application/xml; charset=utf-8');

$base = get_canonical_base();

$sitemaps = [
  $base . '/local-events/sitemap.xml',
  $base . '/directory/sitemap.xml',
  $base . '/jobs/sitemap.xml',
  $base . '/hostels-pgs/sitemap.xml',
  $base . '/coworking-spaces/sitemap.xml',
  $base . '/pentahive/sitemap.xml',
  $base . '/election-blo-details/sitemap.xml',
  $base . '/coimbatore-elections-2026/sitemap.xml',
  // Add more module sitemaps as they come online:
  // $base . '/local-news/sitemap.xml',
];

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
echo "<sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
foreach ($sitemaps as $s) {
  echo "  <sitemap><loc>" . htmlspecialchars($s, ENT_XML1) . "</loc></sitemap>\n";
}
echo "</sitemapindex>\n";


