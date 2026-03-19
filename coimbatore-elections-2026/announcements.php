<?php
require_once __DIR__ . '/includes/bootstrap.php';

$base = ELECTIONS_2026_BASE_URL;
$canonical_url = $base . '/announcements.php';
$page_title = 'Announcements – Coimbatore Elections 2026 | ' . (defined('SITE_NAME') ? SITE_NAME : 'MyCovai');
$page_description = 'ECI and party announcements for Tamil Nadu Assembly election 2026 – Coimbatore.';
$page_keywords = 'election announcements, ECI, TN election 2026';
$og_title = $page_title;
$og_description = $page_description;
$og_url = $canonical_url;
$twitter_title = $page_title;
$twitter_description = $page_description;
$breadcrumbs = [
    [get_canonical_base() . '/', 'Home'],
    [$base . '/', 'Elections 2026'],
    [$canonical_url, 'Announcements'],
];

$announcements = [];
if (isset($conn)) {
    $check = @$conn->query("SELECT 1 FROM election_2026_announcements LIMIT 1");
    if ($check) {
        $check->free();
        $res = $conn->query("SELECT announcement_date AS date, title, source, summary AS body FROM election_2026_announcements ORDER BY announcement_date DESC");
        if ($res) {
            while ($row = $res->fetch_assoc()) {
                $announcements[] = $row;
            }
            $res->free();
        }
    }
}
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
    <h1>Announcements</h1>
    <p class="lead">Official announcements from ECI and CEO Tamil Nadu for the 2026 Assembly election.</p>
    <?php if (empty($announcements)): ?>
    <p>Announcements will be listed here as they are published. Check <a href="https://eci.gov.in" target="_blank" rel="noopener">ECI</a> and <a href="https://elections.tn.gov.in" target="_blank" rel="noopener">CEO Tamil Nadu</a> for the latest.</p>
    <?php else: ?>
    <ul class="list-group list-group-flush">
        <?php foreach ($announcements as $a): ?>
        <li class="list-group-item">
            <strong><?php echo htmlspecialchars($a['title'] ?? ''); ?></strong>
            <span class="text-muted"><?php echo htmlspecialchars($a['date'] ?? ''); ?></span>
            <p class="mb-0"><?php echo nl2br(htmlspecialchars($a['body'] ?? '')); ?></p>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <p><a href="<?php echo htmlspecialchars($base); ?>/">← Back to Elections 2026</a></p>
</main>
<?php include ROOT_PATH . '/components/footer.php'; ?>
</body>
</html>
