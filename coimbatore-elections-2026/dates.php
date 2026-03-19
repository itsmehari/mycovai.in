<?php
require_once __DIR__ . '/includes/bootstrap.php';

$base = ELECTIONS_2026_BASE_URL;
$canonical_url = $base . '/dates.php';
$page_title = 'Key Dates – Tamil Nadu Assembly Election 2026 | Coimbatore | ' . (defined('SITE_NAME') ? SITE_NAME : 'MyCovai');
$page_description = 'TN Assembly election 2026: Gazette 30 Mar, nominations by 6 Apr, scrutiny 7 Apr, withdrawal 9 Apr, poll 23 Apr, counting 4 May 2026.';
$page_keywords = 'election 2026 dates, Tamil Nadu poll date, counting date, nomination, Coimbatore election schedule';
$og_title = $page_title;
$og_description = $page_description;
$og_url = $canonical_url;
$twitter_title = $page_title;
$twitter_description = $page_description;
$breadcrumbs = [
    [get_canonical_base() . '/', 'Home'],
    [$base . '/', 'Elections 2026'],
    [$canonical_url, 'Key dates'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include ROOT_PATH . '/components/meta.php'; ?>
    <?php include ROOT_PATH . '/components/head-resources.php'; ?>
    <?php include ROOT_PATH . '/components/analytics.php'; ?>
    <script type="application/ld+json"><?php
    echo json_encode([
        '@context' => 'https://schema.org',
        '@graph' => [
            ['@type' => 'Event', 'name' => 'TN Assembly Election 2026 – Poll', 'startDate' => '2026-04-23', 'endDate' => '2026-04-24', 'location' => ['@type' => 'Place', 'name' => 'Tamil Nadu'], 'url' => $base . '/dates.php'],
            ['@type' => 'Event', 'name' => 'TN Assembly Election 2026 – Counting', 'startDate' => '2026-05-04', 'endDate' => '2026-05-05', 'location' => ['@type' => 'Place', 'name' => 'Tamil Nadu'], 'url' => $base . '/results-2026.php'],
        ]
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?></script>
</head>
<body>
<a href="#main-content" class="visually-hidden-focusable skip-link">Skip to main content</a>
<?php include ROOT_PATH . '/components/main-nav.php'; ?>
<main id="main-content" class="container py-5">
    <h1>Key Dates – Tamil Nadu Assembly Election 2026</h1>
    <p class="lead">Important dates for Coimbatore and Tamil Nadu.</p>
    <ul class="list-group list-group-flush mb-4">
        <li class="list-group-item"><strong>Gazette notification:</strong> 30 Mar 2026</li>
        <li class="list-group-item"><strong>Last date for nominations:</strong> 6 Apr 2026</li>
        <li class="list-group-item"><strong>Scrutiny:</strong> 7 Apr 2026</li>
        <li class="list-group-item"><strong>Withdrawal:</strong> 9 Apr 2026</li>
        <li class="list-group-item"><strong>Poll:</strong> 23 Apr 2026</li>
        <li class="list-group-item"><strong>Counting:</strong> 4 May 2026</li>
    </ul>
    <p><a href="<?php echo htmlspecialchars($base); ?>/dates-2026.ics.php" class="btn btn-outline-primary">Add to calendar (ICS)</a></p>
    <p><a href="<?php echo htmlspecialchars($base); ?>/">← Back to Elections 2026</a></p>
</main>
<?php include ROOT_PATH . '/components/footer.php'; ?>
</body>
</html>
