<?php
/**
 * Job portal sitemap — web route: /jobs/sitemap.xml
 * CLI: php jobs/generate-sitemap.php (also writes jobs/sitemap.xml)
 */
require_once __DIR__ . '/../core/omr-connect.php';
require_once __DIR__ . '/../core/url-helpers.php';
require_once __DIR__ . '/includes/job-functions-covai.php';

$isCli = php_sapi_name() === 'cli';
if (!$isCli) {
    header('Content-Type: application/xml; charset=utf-8');
}

$result = $conn->query("SELECT id, title, updated_at FROM job_postings WHERE status = 'approved' ORDER BY updated_at DESC");
$jobs = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

$base_url = get_canonical_base();
$pages = [
    ['loc' => '/jobs/', 'priority' => '1.0', 'changefreq' => 'daily'],
    ['loc' => '/jobs/post-job-covai.php', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/jobs/employer-register-covai.php', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/post-your-jobs-coimbatore.html', 'priority' => '0.9', 'changefreq' => 'weekly'],
    ['loc' => '/jobs-in-coimbatore.php', 'priority' => '1.0', 'changefreq' => 'daily'],
    ['loc' => '/jobs-in-rs-puram.php', 'priority' => '0.9', 'changefreq' => 'daily'],
    ['loc' => '/jobs-in-gandhipuram.php', 'priority' => '0.9', 'changefreq' => 'daily'],
    ['loc' => '/jobs-in-peelamedu.php', 'priority' => '0.9', 'changefreq' => 'daily'],
    ['loc' => '/jobs-in-saravanampatti.php', 'priority' => '0.9', 'changefreq' => 'daily'],
    ['loc' => '/jobs-in-saibaba-colony.php', 'priority' => '0.9', 'changefreq' => 'daily'],
    ['loc' => '/it-jobs-coimbatore.php', 'priority' => '0.9', 'changefreq' => 'daily'],
];

$xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
$xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

foreach ($pages as $page) {
    $xml .= '  <url>' . "\n";
    $xml .= '    <loc>' . htmlspecialchars($base_url . $page['loc'], ENT_XML1) . '</loc>' . "\n";
    $xml .= '    <changefreq>' . $page['changefreq'] . '</changefreq>' . "\n";
    $xml .= '    <priority>' . $page['priority'] . '</priority>' . "\n";
    $xml .= '  </url>' . "\n";
}

foreach ($jobs as $job) {
    $xml .= '  <url>' . "\n";
    $xml .= '    <loc>' . htmlspecialchars($base_url . getJobDetailUrl($job['id'], $job['title'] ?? ''), ENT_XML1) . '</loc>' . "\n";
    $xml .= '    <lastmod>' . date('Y-m-d', strtotime($job['updated_at'])) . '</lastmod>' . "\n";
    $xml .= '    <changefreq>weekly</changefreq>' . "\n";
    $xml .= '    <priority>0.7</priority>' . "\n";
    $xml .= '  </url>' . "\n";
}

$xml .= '</urlset>';

if ($isCli) {
    file_put_contents(__DIR__ . '/sitemap.xml', $xml);
    echo 'Sitemap generated successfully! (' . count($jobs) . " jobs)\n";
    echo 'Location: ' . $base_url . "/jobs/sitemap.xml\n";
} else {
    echo $xml;
}
