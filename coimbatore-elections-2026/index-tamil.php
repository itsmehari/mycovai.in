<?php
require_once __DIR__ . '/includes/bootstrap.php';

$base = ELECTIONS_2026_BASE_URL;
$canonical_url = $base . '/index-tamil.php';

$page_title = 'தேர்தல் 2026 – கோவை மற்றும் சுற்றுப்புறம் | ' . (defined('SITE_NAME') ? SITE_NAME : 'MyCovai');
$page_description = 'தமிழ்நாடு சட்டமன்ற தேர்தல் 2026 வழிகாட்டி – முக்கிய தேதிகள், உங்கள் தொகுதி, BLO, வாக்களிப்பது எப்படி. வாக்கு 23 ஏப்ரல், எண்ணிக்கை 4 மே 2026.';
$page_keywords = 'கோவை தேர்தல் 2026, தமிழ்நாடு சட்டமன்ற தேர்தல், கோவை தொகுதி';
$og_title = $page_title;
$og_description = $page_description;
$og_url = $canonical_url;
$twitter_title = $page_title;
$twitter_description = $page_description;
$breadcrumbs = [
    [get_canonical_base() . '/', 'முகப்பு'],
    [$canonical_url, 'தேர்தல் 2026'],
];
?>
<!DOCTYPE html>
<html lang="ta">
<head>
    <link rel="alternate" hreflang="en" href="<?php echo htmlspecialchars($base); ?>/">
    <link rel="alternate" hreflang="x-default" href="<?php echo htmlspecialchars($base); ?>/">
    <?php include ROOT_PATH . '/components/meta.php'; ?>
    <?php include ROOT_PATH . '/components/head-resources.php'; ?>
    <?php include ROOT_PATH . '/components/analytics.php'; ?>
</head>
<body>
<a href="#main-content" class="visually-hidden-focusable skip-link">Skip to main content</a>
<?php include ROOT_PATH . '/components/main-nav.php'; ?>
<main id="main-content" class="container py-5">
    <p class="text-end"><a href="<?php echo htmlspecialchars($base); ?>/">Read in English</a></p>
    <h1>தேர்தல் 2026 – கோவை மற்றும் சுற்றுப்புறம்</h1>
    <p class="lead">தமிழ்நாடு சட்டமன்ற தேர்தல் 2026 – முக்கிய தேதிகள், வாக்கு 23 ஏப்ரல், எண்ணிக்கை 4 மே 2026.</p>
    <div class="row g-4 py-4">
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h5 card-title">முக்கிய தேதிகள்</h2>
                    <a href="<?php echo htmlspecialchars($base); ?>/dates.php" class="btn btn-primary">தேதிகள்</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h5 card-title">உங்கள் தொகுதி</h2>
                    <a href="<?php echo htmlspecialchars($base); ?>/know-your-constituency.php" class="btn btn-primary">தொகுதி பார்க்க</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h5 card-title">BLO கண்டுபிடி</h2>
                    <a href="<?php echo htmlspecialchars($base); ?>/find-blo.php" class="btn btn-primary">BLO</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h5 card-title">வாக்களிப்பது எப்படி</h2>
                    <a href="<?php echo htmlspecialchars($base); ?>/how-to-vote.php" class="btn btn-primary">வழிகாட்டி</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h5 card-title">கேள்வி பதில்</h2>
                    <a href="<?php echo htmlspecialchars($base); ?>/faq.php" class="btn btn-primary">FAQ</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h5 card-title">முடிவுகள் 2026</h2>
                    <a href="<?php echo htmlspecialchars($base); ?>/results-2026.php" class="btn btn-primary">முடிவுகள்</a>
                </div>
            </div>
        </div>
    </div>
    <p><a href="<?php echo htmlspecialchars($base); ?>/">← தேர்தல் 2026 (English)</a></p>
</main>
<?php include ROOT_PATH . '/components/footer.php'; ?>
</body>
</html>
