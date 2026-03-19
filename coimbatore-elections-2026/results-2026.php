<?php
require_once __DIR__ . '/includes/bootstrap.php';
$constituencies = require __DIR__ . '/includes/constituency-data.php';

$base = ELECTIONS_2026_BASE_URL;
$canonical_url = $base . '/results-2026.php';
$page_title = 'Results 2026 – Coimbatore Elections | ' . (defined('SITE_NAME') ? SITE_NAME : 'MyCovai');
$page_description = 'Tamil Nadu Assembly election 2026 results for Coimbatore constituencies. Counting 4 May 2026.';
$page_keywords = 'election results 2026, Coimbatore results, TN Assembly results';
$og_title = $page_title;
$og_description = $page_description;
$og_url = $canonical_url;
$twitter_title = $page_title;
$twitter_description = $page_description;
$breadcrumbs = [
    [get_canonical_base() . '/', 'Home'],
    [$base . '/', 'Elections 2026'],
    [$canonical_url, 'Results 2026'],
];

$counting_date = new DateTime('2026-05-04');
$today = new DateTime('now');
$counting_done = $today >= $counting_date;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include ROOT_PATH . '/components/meta.php'; ?>
    <?php include ROOT_PATH . '/components/head-resources.php'; ?>
    <?php include ROOT_PATH . '/components/analytics.php'; ?>
</head>
<body>
<a href="#main-content" class="visually-hidden-focusable skip-link">Skip to main content</a>
<?php include ROOT_PATH . '/components/main-nav.php'; ?>
<main id="main-content" class="container py-5">
    <h1>Results 2026</h1>
    <?php if (!$counting_done): ?>
    <p class="lead">Counting on 4 May 2026. Results will be updated here and on the ECI / CEO Tamil Nadu portals.</p>
    <p>
        <a href="https://eci.gov.in" target="_blank" rel="noopener">Election Commission of India</a> ·
        <a href="https://elections.tn.gov.in" target="_blank" rel="noopener">CEO Tamil Nadu</a>
    </p>
    <?php else: ?>
    <p class="lead">Results for Coimbatore Assembly constituencies.</p>
    <p>Official results: <a href="https://eci.gov.in" target="_blank" rel="noopener">ECI</a> · <a href="https://elections.tn.gov.in" target="_blank" rel="noopener">CEO Tamil Nadu</a>.</p>
    <ul class="list-group list-group-flush">
        <?php foreach ($constituencies as $slug => $ac): ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <strong><?php echo htmlspecialchars($ac['name']); ?></strong> (AC <?php echo (int) $ac['ac_no']; ?>)
            <a href="<?php echo htmlspecialchars($base); ?>/constituency/<?php echo htmlspecialchars($slug); ?>.php">View</a>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <p class="mt-4"><a href="<?php echo htmlspecialchars($base); ?>/">← Elections 2026</a></p>
</main>
<?php include ROOT_PATH . '/components/footer.php'; ?>
</body>
</html>
