<?php
require_once __DIR__ . '/includes/bootstrap.php';

$base = ELECTIONS_2026_BASE_URL;
$canonical_url = $base . '/news.php';
$page_title = 'Election News – Coimbatore Elections 2026 | ' . (defined('SITE_NAME') ? SITE_NAME : 'MyCovai');
$page_description = 'Election-related news and updates for Coimbatore and Tamil Nadu Assembly election 2026.';
$page_keywords = 'election news, Coimbatore election 2026, TN election updates';
$og_title = $page_title;
$og_description = $page_description;
$og_url = $canonical_url;
$twitter_title = $page_title;
$twitter_description = $page_description;
$breadcrumbs = [
    [get_canonical_base() . '/', 'Home'],
    [$base . '/', 'Elections 2026'],
    [$canonical_url, 'News'],
];
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
    <h1>Election News</h1>
    <p class="lead">News and updates related to the Tamil Nadu Assembly election 2026 in Coimbatore.</p>
    <p>We will link to local news tagged with election / 2026 when available. For now, follow official sources: <a href="https://eci.gov.in" target="_blank" rel="noopener">ECI</a>, <a href="https://elections.tn.gov.in" target="_blank" rel="noopener">CEO Tamil Nadu</a>.</p>
    <p><a href="<?php echo htmlspecialchars($base); ?>/">← Back to Elections 2026</a></p>
</main>
<?php include ROOT_PATH . '/components/footer.php'; ?>
</body>
</html>
