<?php
require_once __DIR__ . '/includes/bootstrap.php';
$constituencies = require __DIR__ . '/includes/constituency-data.php';

$base = ELECTIONS_2026_BASE_URL;
$canonical_url = $base . '/know-your-constituency.php';
$page_title = 'Know Your Constituency – Coimbatore Elections 2026 | ' . (defined('SITE_NAME') ? SITE_NAME : 'MyCovai');
$page_description = 'Find which Assembly constituency you belong to in Coimbatore: Palladam, Sulur, Kavundampalayam, Coimbatore North & South, Singanallur.';
$page_keywords = 'Coimbatore constituency, Assembly constituency, AC 115, AC 116, Coimbatore North, Coimbatore South, Singanallur, Palladam, Sulur, Kavundampalayam';
$og_title = $page_title;
$og_description = $page_description;
$og_url = $canonical_url;
$twitter_title = $page_title;
$twitter_description = $page_description;
$breadcrumbs = [
    [get_canonical_base() . '/', 'Home'],
    [$base . '/', 'Elections 2026'],
    [$canonical_url, 'Know your constituency'],
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
    <h1>Know Your Constituency</h1>
    <p class="lead">Six Assembly constituencies in the Coimbatore Lok Sabha segment.</p>
    <ul class="list-group list-group-flush mb-4">
        <?php foreach ($constituencies as $slug => $ac): ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span><strong><?php echo htmlspecialchars($ac['name']); ?></strong> (AC <?php echo (int) $ac['ac_no']; ?>) – <?php echo htmlspecialchars($ac['district']); ?></span>
            <a href="<?php echo htmlspecialchars($base); ?>/constituency/<?php echo htmlspecialchars($slug); ?>.php" class="btn btn-sm btn-outline-primary">View</a>
        </li>
        <?php endforeach; ?>
    </ul>
    <p><a href="<?php echo htmlspecialchars($base); ?>/">← Back to Elections 2026</a></p>
</main>
<?php include ROOT_PATH . '/components/footer.php'; ?>
</body>
</html>
