<?php
require_once __DIR__ . '/includes/bootstrap.php';

$base = ELECTIONS_2026_BASE_URL;
$canonical_url = $base . '/find-blo.php';
$page_title = 'Find BLO – Booth Level Officer | Coimbatore Elections 2026 | ' . (defined('SITE_NAME') ? SITE_NAME : 'MyCovai');
$page_description = 'Find your Booth Level Officer (BLO) for Coimbatore. Links to CEO Tamil Nadu BLO portal and erolls.tn.gov.in.';
$page_keywords = 'BLO, Booth Level Officer, Coimbatore BLO, CEO Tamil Nadu, erolls, electoral roll';
$og_title = $page_title;
$og_description = $page_description;
$og_url = $canonical_url;
$twitter_title = $page_title;
$twitter_description = $page_description;
$breadcrumbs = [
    [get_canonical_base() . '/', 'Home'],
    [$base . '/', 'Elections 2026'],
    [$canonical_url, 'Find BLO'],
];
$blo_portal = 'https://elections.tn.gov.in/BLO.aspx';
$erolls_blo = 'https://www.erolls.tn.gov.in/blo/';
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
    <h1>Find BLO (Booth Level Officer)</h1>
    <p class="lead">Your Booth Level Officer can help with electoral roll and polling station queries. Use the official Tamil Nadu portals below.</p>
    <div class="card mb-4">
        <div class="card-body">
            <h2 class="h5">CEO Tamil Nadu – BLO</h2>
            <p><a href="<?php echo htmlspecialchars($blo_portal); ?>" target="_blank" rel="noopener"><?php echo htmlspecialchars($blo_portal); ?></a></p>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <h2 class="h5">Tamil Nadu Electoral Roll – BLO</h2>
            <p><a href="<?php echo htmlspecialchars($erolls_blo); ?>" target="_blank" rel="noopener"><?php echo htmlspecialchars($erolls_blo); ?></a></p>
        </div>
    </div>
    <p><a href="<?php echo htmlspecialchars($base); ?>/">← Back to Elections 2026</a></p>
</main>
<?php include ROOT_PATH . '/components/footer.php'; ?>
</body>
</html>
