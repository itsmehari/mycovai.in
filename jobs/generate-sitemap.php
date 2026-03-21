<?php
/**
 * Generate Sitemap for Job Portal – uses canonical base for Search Console
 */
require_once __DIR__ . '/../core/omr-connect.php';
require_once __DIR__ . '/../core/url-helpers.php';

// Get all approved jobs
$result = $conn->query("SELECT id, title, updated_at FROM job_postings WHERE status = 'approved' ORDER BY updated_at DESC");
$jobs = $result->fetch_all(MYSQLI_ASSOC);

// Generate sitemap XML
$xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
$xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

// Base pages – canonical domain from core/url-helpers.php
$base_url = get_canonical_base();
$pages = [
    // Main job portal pages
    ['loc' => '/jobs/', 'priority' => '1.0', 'changefreq' => 'daily'],
    ['loc' => '/jobs/post-job-omr.php', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/jobs/employer-register-omr.php', 'priority' => '0.8', 'changefreq' => 'weekly'],
    // Coimbatore employer landing (SEO, geo, AEO)
    ['loc' => '/post-your-jobs-coimbatore.html', 'priority' => '0.9', 'changefreq' => 'weekly'],
    // Primary landing page
    ['loc' => '/jobs-in-omr-chennai.php', 'priority' => '1.0', 'changefreq' => 'daily'],
    // Location-specific landing pages
    ['loc' => '/jobs-in-perungudi-omr.php', 'priority' => '0.9', 'changefreq' => 'daily'],
    ['loc' => '/jobs-in-sholinganallur-omr.php', 'priority' => '0.9', 'changefreq' => 'daily'],
    ['loc' => '/jobs-in-navalur-omr.php', 'priority' => '0.9', 'changefreq' => 'daily'],
    ['loc' => '/jobs-in-thoraipakkam-omr.php', 'priority' => '0.9', 'changefreq' => 'daily'],
    ['loc' => '/jobs-in-kelambakkam-omr.php', 'priority' => '0.9', 'changefreq' => 'daily'],
    // Industry-specific landing pages
    ['loc' => '/it-jobs-omr-chennai.php', 'priority' => '0.9', 'changefreq' => 'daily'],
    ['loc' => '/retail-jobs-omr-chennai.php', 'priority' => '0.9', 'changefreq' => 'daily'],
    ['loc' => '/hospitality-jobs-omr-chennai.php', 'priority' => '0.9', 'changefreq' => 'daily'],
    ['loc' => '/teaching-jobs-omr-chennai.php', 'priority' => '0.9', 'changefreq' => 'daily'],
    ['loc' => '/healthcare-jobs-omr-chennai.php', 'priority' => '0.9', 'changefreq' => 'daily'],
    // Experience-level landing pages
    ['loc' => '/fresher-jobs-omr-chennai.php', 'priority' => '0.9', 'changefreq' => 'daily'],
    ['loc' => '/experienced-jobs-omr-chennai.php', 'priority' => '0.9', 'changefreq' => 'daily'],
    // Job-type landing pages
    ['loc' => '/part-time-jobs-omr-chennai.php', 'priority' => '0.9', 'changefreq' => 'daily'],
    ['loc' => '/work-from-home-jobs-omr.php', 'priority' => '0.9', 'changefreq' => 'daily'],
];

// Add base pages
foreach ($pages as $page) {
    $xml .= '  <url>' . "\n";
    $xml .= '    <loc>' . htmlspecialchars($base_url . $page['loc']) . '</loc>' . "\n";
    $xml .= '    <changefreq>' . $page['changefreq'] . '</changefreq>' . "\n";
    $xml .= '    <priority>' . $page['priority'] . '</priority>' . "\n";
    $xml .= '  </url>' . "\n";
}

// Add job detail pages
foreach ($jobs as $job) {
    $xml .= '  <url>' . "\n";
    $xml .= '    <loc>' . htmlspecialchars($base_url . '/jobs/job-detail-omr.php?id=' . $job['id']) . '</loc>' . "\n";
    $xml .= '    <lastmod>' . date('Y-m-d', strtotime($job['updated_at'])) . '</lastmod>' . "\n";
    $xml .= '    <changefreq>weekly</changefreq>' . "\n";
    $xml .= '    <priority>0.7</priority>' . "\n";
    $xml .= '  </url>' . "\n";
}

$xml .= '</urlset>';

// Write to file
file_put_contents(__DIR__ . '/sitemap.xml', $xml);

echo "Sitemap generated successfully! (" . count($jobs) . " jobs)\n";
echo "Location: " . $base_url . "sitemap.xml\n";

