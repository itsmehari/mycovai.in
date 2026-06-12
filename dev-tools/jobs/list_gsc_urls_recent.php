<?php
/**
 * List URLs for Google Search Console submission (last N days).
 *
 * Usage:
 *   php dev-tools/jobs/list_gsc_urls_recent.php [days]
 */
if (php_sapi_name() !== 'cli') {
    die("CLI only.\n");
}

$days = isset($argv[1]) ? max(1, (int) $argv[1]) : 20;
$since = (new DateTimeImmutable())->modify("-{$days} days")->format('Y-m-d 00:00:00');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli('mycovai.in:3306', 'metap8ok_myomr_admin', 'myomr@123', 'metap8ok_mycovai');
$conn->set_charset('utf8mb4');

require_once __DIR__ . '/../../jobs/includes/job-functions-covai.php';

$base = 'https://mycovai.in';
$urls = [];

// Approved jobs created or updated in window
$stmt = $conn->prepare("
    SELECT id, title, created_at, updated_at
    FROM job_postings
    WHERE LOWER(TRIM(status)) = 'approved'
      AND (created_at >= ? OR updated_at >= ?)
    ORDER BY GREATEST(created_at, updated_at) DESC
");
$stmt->bind_param('ss', $since, $since);
$stmt->execute();
$res = $stmt->get_result();
while ($row = $res->fetch_assoc()) {
    $urls[] = [
        'url' => $base . getJobDetailUrl((int) $row['id'], $row['title']),
        'type' => 'job',
        'updated' => $row['updated_at'],
    ];
}
$stmt->close();

// Static / landing pages touched in repo (approximate; paths relative to site root)
$staticCandidates = [
    '/jobs/',
    '/post-your-jobs-coimbatore.html',
    '/jobs-in-omr-chennai.php',
    '/directory/',
    '/local-events/',
    '/digital-marketing-landing.php',
];

echo "URLs to submit to Google Search Console (since {$since}, last {$days} days)\n";
echo str_repeat('=', 72) . "\n\n";

if ($urls === []) {
    echo "(No job detail URLs with created/updated in window.)\n\n";
} else {
    echo "Job detail pages (" . count($urls) . "):\n";
    foreach ($urls as $item) {
        echo "  {$item['url']}  [updated: {$item['updated']}]\n";
    }
    echo "\n";
}

echo "Sitemap index (submit once if not already):\n";
echo "  {$base}/sitemap.xml\n\n";
echo "Jobs module sitemap:\n";
echo "  {$base}/jobs/sitemap.xml\n\n";

echo "Other high-value portal URLs (always worth checking in GSC):\n";
foreach ($staticCandidates as $path) {
    echo "  {$base}{$path}\n";
}
