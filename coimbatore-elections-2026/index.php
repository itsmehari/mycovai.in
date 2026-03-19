<?php
require_once __DIR__ . '/includes/bootstrap.php';

$base = ELECTIONS_2026_BASE_URL;
$canonical_url = $base . '/';

$page_title = 'Elections 2026 – Covai & Vicinity | ' . (defined('SITE_NAME') ? SITE_NAME : 'MyCovai');
$page_description = 'Tamil Nadu Assembly election 2026 guide for Coimbatore: key dates, find your constituency, BLO, how to vote, candidates, FAQ. Poll 23 Apr, counting 4 May.';
$page_keywords = 'Coimbatore election 2026, Tamil Nadu Assembly election, Covai elections, Coimbatore constituency, BLO, vote 2026';

$og_title = $page_title;
$og_description = $page_description;
$og_url = $canonical_url;
$twitter_title = $page_title;
$twitter_description = $page_description;

$breadcrumbs = [
    [get_canonical_base() . '/', 'Home'],
    [$canonical_url, 'Elections 2026'],
];

// Countdown: poll 23 Apr 2026
$poll_date = new DateTime('2026-04-23');
$today = new DateTime('now');
$days_to_poll = $today->diff($poll_date)->days;
$poll_passed = $today > $poll_date;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="alternate" hreflang="ta" href="<?php echo htmlspecialchars($base); ?>/index-tamil.php">
    <link rel="alternate" hreflang="x-default" href="<?php echo htmlspecialchars($canonical_url); ?>">
    <?php include ROOT_PATH . '/components/meta.php'; ?>
    <?php include ROOT_PATH . '/components/head-resources.php'; ?>
    <?php include ROOT_PATH . '/components/analytics.php'; ?>
    <script type="application/ld+json"><?php
    $baseUrl = $base . '/';
    echo json_encode([
        '@context' => 'https://schema.org',
        '@graph' => [
            ['@type' => 'WebPage', 'name' => $page_title, 'url' => $canonical_url, 'description' => $page_description],
            ['@type' => 'Event', 'name' => 'Tamil Nadu Assembly Election 2026 – Poll', 'startDate' => '2026-04-23', 'endDate' => '2026-04-24', 'location' => ['@type' => 'Place', 'name' => 'Tamil Nadu'], 'url' => $baseUrl . 'dates.php'],
            ['@type' => 'Event', 'name' => 'Tamil Nadu Assembly Election 2026 – Counting', 'startDate' => '2026-05-04', 'endDate' => '2026-05-05', 'location' => ['@type' => 'Place', 'name' => 'Tamil Nadu'], 'url' => $baseUrl . 'results-2026.php'],
        ]
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?></script>
</head>
<body>
<a href="#main-content" class="visually-hidden-focusable skip-link">Skip to main content</a>
<?php include ROOT_PATH . '/components/main-nav.php'; ?>

<main id="main-content" class="container py-5">
    <h1>Elections 2026 – Covai &amp; Vicinity</h1>
    <?php if ($poll_passed): ?>
    <p class="lead">Poll was on 23 Apr 2026. <a href="<?php echo htmlspecialchars($base); ?>/results-2026.php">View results</a>.</p>
    <?php else: ?>
    <p class="lead"><?php echo (int) $days_to_poll; ?> days to poll (23 Apr 2026). Counting on 4 May 2026.</p>
    <?php endif; ?>

    <div class="mb-4">
        <p class="mb-2">Share this guide:</p>
        <a href="https://wa.me/?text=<?php echo rawurlencode($page_title . ' ' . $canonical_url); ?>" class="btn btn-success me-2" target="_blank" rel="noopener" aria-label="Share on WhatsApp"><i class="fab fa-whatsapp me-1"></i> WhatsApp</a>
        <a href="https://twitter.com/intent/tweet?text=<?php echo rawurlencode($page_title); ?>&url=<?php echo rawurlencode($canonical_url); ?>" class="btn btn-primary" target="_blank" rel="noopener" aria-label="Share on Twitter">Twitter</a>
    </div>
    <div class="mb-4">
        <a href="<?php echo htmlspecialchars($base); ?>/quiz.php" class="btn btn-outline-secondary me-2">Are you ready to vote? Quiz</a>
        <a href="<?php echo htmlspecialchars($base); ?>/results-2026.php" class="btn btn-outline-secondary">Results 2026</a>
    </div>

    <div class="row g-4 py-4">
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h5 card-title"><i class="fas fa-calendar-alt me-2"></i>Key dates</h2>
                    <p class="card-text">Gazette 30 Mar, nominations by 6 Apr, poll 23 Apr, counting 4 May 2026.</p>
                    <a href="<?php echo htmlspecialchars($base); ?>/dates.php" class="btn btn-primary">View timeline</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h5 card-title"><i class="fas fa-map-marker-alt me-2"></i>Know your constituency</h2>
                    <p class="card-text">Find which Assembly constituency you belong to in Coimbatore.</p>
                    <a href="<?php echo htmlspecialchars($base); ?>/know-your-constituency.php" class="btn btn-primary">Check</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h5 card-title"><i class="fas fa-user-tie me-2"></i>Find BLO</h2>
                    <p class="card-text">Booth Level Officer contact – CEO Tamil Nadu portal.</p>
                    <a href="<?php echo htmlspecialchars($base); ?>/find-blo.php" class="btn btn-primary">Find BLO</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h5 card-title"><i class="fas fa-landmark me-2"></i>Constituencies</h2>
                    <p class="card-text">Palladam, Sulur, Kavundampalayam, Coimbatore North/South, Singanallur.</p>
                    <a href="<?php echo htmlspecialchars($base); ?>/know-your-constituency.php" class="btn btn-primary">View ACs</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h5 card-title"><i class="fas fa-users me-2"></i>Candidates</h2>
                    <p class="card-text">List of candidates by Assembly constituency.</p>
                    <a href="<?php echo htmlspecialchars($base); ?>/candidates.php" class="btn btn-primary">View candidates</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h5 card-title"><i class="fas fa-vote-yea me-2"></i>How to vote</h2>
                    <p class="card-text">EPIC/ID, polling station, dos and don'ts.</p>
                    <a href="<?php echo htmlspecialchars($base); ?>/how-to-vote.php" class="btn btn-primary">Read guide</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h5 card-title"><i class="fas fa-question-circle me-2"></i>FAQ</h2>
                    <p class="card-text">Common questions on dates, ID, EVM, postal ballot, MCC.</p>
                    <a href="<?php echo htmlspecialchars($base); ?>/faq.php" class="btn btn-primary">View FAQ</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h5 card-title"><i class="fas fa-newspaper me-2"></i>News</h2>
                    <p class="card-text">Election-related news and updates.</p>
                    <a href="<?php echo htmlspecialchars($base); ?>/news.php" class="btn btn-primary">News</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h5 card-title"><i class="fas fa-envelope me-2"></i>Newsletter</h2>
                    <p class="card-text">Get election reminders and updates.</p>
                    <a href="<?php echo htmlspecialchars($base); ?>/newsletter.php" class="btn btn-primary">Subscribe</a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include ROOT_PATH . '/components/footer.php'; ?>
</body>
</html>
