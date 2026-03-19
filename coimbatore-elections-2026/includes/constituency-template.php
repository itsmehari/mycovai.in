<?php
// Expects $slug set by caller (e.g. constituency/palladam.php). ROOT_PATH, ELECTIONS_2026_BASE_URL from bootstrap.
$constituency_data = require ELECTIONS_2026_PATH . '/includes/constituency-data.php';
if (!isset($constituency_data[$slug])) {
    http_response_code(404);
    header('Content-Type: text/html; charset=utf-8');
    echo '<!DOCTYPE html><html><head><title>Not found</title></head><body><h1>Constituency not found</h1></body></html>';
    exit;
}
$ac = $constituency_data[$slug];
$base = ELECTIONS_2026_BASE_URL;
$canonical_url = $base . '/constituency/' . $slug . '.php';
$page_title = $ac['name'] . ' – Coimbatore Elections 2026 | ' . (defined('SITE_NAME') ? SITE_NAME : 'MyCovai');
$page_description = $ac['name'] . ' Assembly constituency (AC ' . $ac['ac_no'] . '), ' . $ac['district'] . '. Areas, 2021 result.';
$page_keywords = $ac['name'] . ', AC ' . $ac['ac_no'] . ', Coimbatore constituency, election 2026';
$og_title = $page_title;
$og_description = $page_description;
$og_url = $canonical_url;
$twitter_title = $page_title;
$twitter_description = $page_description;
$breadcrumbs = [
    [get_canonical_base() . '/', 'Home'],
    [$base . '/', 'Elections 2026'],
    [$base . '/know-your-constituency.php', 'Know your constituency'],
    [$canonical_url, $ac['name']],
];
$place_schema = [
    '@context' => 'https://schema.org',
    '@type' => 'Place',
    'name' => $ac['name'] . ' Assembly Constituency',
    'description' => $page_description,
    'url' => $canonical_url,
    'containedInPlace' => ['@type' => 'Place', 'name' => 'Coimbatore', 'addressRegion' => 'Tamil Nadu'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include ROOT_PATH . '/components/meta.php'; ?>
    <?php include ROOT_PATH . '/components/head-resources.php'; ?>
    <?php include ROOT_PATH . '/components/analytics.php'; ?>
    <script type="application/ld+json"><?php echo json_encode($place_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?></script>
</head>
<body>
<a href="#main-content" class="visually-hidden-focusable skip-link">Skip to main content</a>
<?php include ROOT_PATH . '/components/main-nav.php'; ?>
<main id="main-content" class="container py-5">
    <h1><?php echo htmlspecialchars($ac['name']); ?> (AC <?php echo (int) $ac['ac_no']; ?>)</h1>
    <p class="lead"><?php echo htmlspecialchars($ac['district']); ?> district.</p>
    <h2 class="h5">Areas</h2>
    <p><?php echo is_array($ac['areas']) ? htmlspecialchars(implode(', ', $ac['areas'])) : htmlspecialchars($ac['areas']); ?></p>
    <?php if (!empty($ac['winner_2021'])): ?>
    <h2 class="h5">2021 result</h2>
    <p>Winner: <strong><?php echo htmlspecialchars($ac['winner_2021']); ?></strong> (<?php echo htmlspecialchars($ac['winner_party_2021'] ?? ''); ?>)<?php if (!empty($ac['winner_votes_2021'])): ?> – <?php echo number_format($ac['winner_votes_2021']); ?> votes<?php endif; ?>.</p>
    <?php if (!empty($ac['runner_up_2021'])): ?>
    <p>Runner-up: <?php echo htmlspecialchars($ac['runner_up_2021']); ?> (<?php echo htmlspecialchars($ac['runner_party_2021'] ?? ''); ?>)<?php if (!empty($ac['runner_votes_2021'])): ?> – <?php echo number_format($ac['runner_votes_2021']); ?> votes<?php endif; ?>.</p>
    <?php endif; ?>
    <?php if (!empty($ac['margin_2021'])): ?>
    <p>Margin: <?php echo number_format($ac['margin_2021']); ?>.</p>
    <?php endif; ?>
    <?php endif; ?>
    <p class="mb-2">Share this guide:</p>
    <a href="https://wa.me/?text=<?php echo rawurlencode($ac['name'] . ' – Coimbatore Elections 2026 ' . $canonical_url); ?>" class="btn btn-success btn-sm me-2" target="_blank" rel="noopener" aria-label="Share on WhatsApp"><i class="fab fa-whatsapp me-1"></i> WhatsApp</a>
    <a href="https://twitter.com/intent/tweet?text=<?php echo rawurlencode($ac['name'] . ' – Coimbatore Elections 2026'); ?>&url=<?php echo rawurlencode($canonical_url); ?>" class="btn btn-primary btn-sm" target="_blank" rel="noopener" aria-label="Share on Twitter">Twitter</a>
    <p class="mt-3"><a href="<?php echo htmlspecialchars($base); ?>/know-your-constituency.php">← All constituencies</a> · <a href="<?php echo htmlspecialchars($base); ?>/">Elections 2026</a></p>
</main>
<?php include ROOT_PATH . '/components/footer.php'; ?>
</body>
</html>
