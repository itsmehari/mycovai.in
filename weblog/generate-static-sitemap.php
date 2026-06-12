<?php
/**
 * Static hub pages sitemap (Coimbatore / MyCovai).
 * CLI: php weblog/generate-static-sitemap.php > sitemap.xml
 * Web: optional direct access for regeneration checks.
 */
if (!defined('MYCOVAI_CONFIG_LOADED')) {
    require_once __DIR__ . '/../core/mycovai-config.php';
}
require_once __DIR__ . '/../core/url-helpers.php';

if (php_sapi_name() !== 'cli') {
    header('Content-Type: application/xml; charset=utf-8');
}

$base = get_canonical_base();
$lastmod = date('Y-m-d');

$pages = [
    ['loc' => '/', 'priority' => '1.0', 'changefreq' => 'weekly'],
    ['loc' => '/about.php', 'priority' => '0.8', 'changefreq' => 'monthly'],
    ['loc' => '/contact.php', 'priority' => '0.8', 'changefreq' => 'monthly'],
    ['loc' => '/coimbatore-news.php', 'priority' => '0.9', 'changefreq' => 'daily'],
    ['loc' => '/coimbatore-elections-2026/', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/directory/', 'priority' => '0.9', 'changefreq' => 'weekly'],
    ['loc' => '/directory/get-listed.php', 'priority' => '0.8', 'changefreq' => 'monthly'],
    ['loc' => '/directory/emergency-civic-directory.php', 'priority' => '0.7', 'changefreq' => 'monthly'],
    ['loc' => '/schools', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/hospitals', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/banks', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/atms', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/restaurants', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/it-companies', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/it-parks', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/industries', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/parks', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/government-offices', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/jobs/', 'priority' => '0.9', 'changefreq' => 'daily'],
    ['loc' => '/jobs/employer-landing-covai.php', 'priority' => '0.8', 'changefreq' => 'monthly'],
    ['loc' => '/jobs-in-coimbatore.php', 'priority' => '0.9', 'changefreq' => 'weekly'],
    ['loc' => '/it-jobs-coimbatore.php', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/jobs-in-rs-puram.php', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/jobs-in-gandhipuram.php', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/jobs-in-peelamedu.php', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/jobs-in-saravanampatti.php', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/jobs-in-saibaba-colony.php', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/local-events/', 'priority' => '0.8', 'changefreq' => 'daily'],
    ['loc' => '/hostels-pgs/', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/coworking-spaces/', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/discover/getting-started.php', 'priority' => '0.7', 'changefreq' => 'monthly'],
    ['loc' => '/discover/features.php', 'priority' => '0.7', 'changefreq' => 'monthly'],
    ['loc' => '/discover/community.php', 'priority' => '0.7', 'changefreq' => 'monthly'],
    ['loc' => '/discover/support.php', 'priority' => '0.7', 'changefreq' => 'monthly'],
    ['loc' => '/discover/sustainable-development-goals.php', 'priority' => '0.6', 'changefreq' => 'yearly'],
    ['loc' => '/privacy-policy.php', 'priority' => '0.4', 'changefreq' => 'yearly'],
    ['loc' => '/terms-and-conditions.php', 'priority' => '0.4', 'changefreq' => 'yearly'],
];

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
echo "  <!-- Generated: {$lastmod} — MyCovai static hub pages -->\n";
foreach ($pages as $page) {
    $loc = rtrim($base, '/') . $page['loc'];
    echo "  <url>\n";
    echo '    <loc>' . htmlspecialchars($loc, ENT_XML1) . "</loc>\n";
    echo "    <lastmod>{$lastmod}</lastmod>\n";
    echo '    <changefreq>' . $page['changefreq'] . "</changefreq>\n";
    echo '    <priority>' . $page['priority'] . "</priority>\n";
    echo "  </url>\n";
}
echo "</urlset>\n";
