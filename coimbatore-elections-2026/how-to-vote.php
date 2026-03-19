<?php
require_once __DIR__ . '/includes/bootstrap.php';

$base = ELECTIONS_2026_BASE_URL;
$canonical_url = $base . '/how-to-vote.php';
$page_title = 'How to Vote – Coimbatore Elections 2026 | ' . (defined('SITE_NAME') ? SITE_NAME : 'MyCovai');
$page_description = 'EPIC/ID, polling station, dos and don\'ts for voting in Tamil Nadu Assembly election 2026 in Coimbatore.';
$page_keywords = 'how to vote, EPIC, voter ID, polling station, EVM, VVPAT, Coimbatore vote 2026';
$og_title = $page_title;
$og_description = $page_description;
$og_url = $canonical_url;
$twitter_title = $page_title;
$twitter_description = $page_description;
$breadcrumbs = [
    [get_canonical_base() . '/', 'Home'],
    [$base . '/', 'Elections 2026'],
    [$canonical_url, 'How to vote'],
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
        '@type' => 'HowTo',
        'name' => 'How to vote in Tamil Nadu Assembly election 2026',
        'description' => $page_description,
        'step' => [
            ['@type' => 'HowToStep', 'name' => 'Check electoral roll', 'text' => 'Check your name on the electoral roll; use Know your constituency and CEO TN / erolls portal.'],
            ['@type' => 'HowToStep', 'name' => 'Carry valid ID', 'text' => 'Carry EPIC (voter ID), passport, driving licence, or other ECI-approved photo ID.'],
            ['@type' => 'HowToStep', 'name' => 'Know polling station', 'text' => 'Find your polling station from voter slip or electoral roll; contact BLO if unsure.'],
            ['@type' => 'HowToStep', 'name' => 'Poll day', 'text' => 'On poll day (23 Apr 2026) go to your polling station within polling hours.'],
            ['@type' => 'HowToStep', 'name' => 'Verify VVPAT', 'text' => 'After pressing the button on the EVM, verify the VVPAT slip to confirm your vote.'],
        ]
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?></script>
</head>
<body>
<a href="#main-content" class="visually-hidden-focusable skip-link">Skip to main content</a>
<?php include ROOT_PATH . '/components/main-nav.php'; ?>
<main id="main-content" class="container py-5">
    <h1>How to Vote</h1>
    <p class="lead">Steps to cast your vote in the Tamil Nadu Assembly election 2026.</p>
    <ol class="mb-4">
        <li><strong>Check your name on the electoral roll.</strong> Use <a href="<?php echo htmlspecialchars($base); ?>/know-your-constituency.php">Know your constituency</a> and the CEO TN / erolls portal.</li>
        <li><strong>Carry a valid ID.</strong> EPIC (voter ID), passport, driving licence, or other ECI-approved photo ID.</li>
        <li><strong>Know your polling station.</strong> Your polling station is on the voter slip or on the electoral roll. Contact your <a href="<?php echo htmlspecialchars($base); ?>/find-blo.php">BLO</a> if unsure.</li>
        <li><strong>On poll day (23 Apr 2026)</strong> go to your polling station within polling hours. Follow staff instructions.</li>
        <li><strong>Verify VVPAT.</strong> After pressing the button on the EVM, check the VVPAT slip to confirm your vote.</li>
    </ol>
    <h2 class="h5">Do's and don'ts</h2>
    <p>Do not carry mobile phones or cameras inside the polling booth. Do not take a photograph of the EVM or ballot. Follow the Model Code of Conduct.</p>
    <p><a href="<?php echo htmlspecialchars($base); ?>/quiz.php" class="btn btn-outline-primary">Quick quiz – Are you ready to vote?</a></p>
    <p><a href="<?php echo htmlspecialchars($base); ?>/">← Back to Elections 2026</a></p>
</main>
<?php include ROOT_PATH . '/components/footer.php'; ?>
</body>
</html>
