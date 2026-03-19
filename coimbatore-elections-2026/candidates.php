<?php
require_once __DIR__ . '/includes/bootstrap.php';
$constituencies = require __DIR__ . '/includes/constituency-data.php';

$base = ELECTIONS_2026_BASE_URL;
$canonical_url = $base . '/candidates.php';
$page_title = 'Candidates – Coimbatore Elections 2026 | ' . (defined('SITE_NAME') ? SITE_NAME : 'MyCovai');
$page_description = 'List of candidates by Assembly constituency for Coimbatore – Tamil Nadu Assembly election 2026.';
$page_keywords = 'election 2026 candidates, Coimbatore candidates, TN Assembly candidates';
$og_title = $page_title;
$og_description = $page_description;
$og_url = $canonical_url;
$twitter_title = $page_title;
$twitter_description = $page_description;
$breadcrumbs = [
    [get_canonical_base() . '/', 'Home'],
    [$base . '/', 'Elections 2026'],
    [$canonical_url, 'Candidates'],
];

$candidates_by_ac = [];
foreach ($constituencies as $slug => $ac) {
    $candidates_by_ac[$slug] = [
        'name' => $ac['name'],
        'ac_no' => $ac['ac_no'],
        'candidates' => [],
    ];
}

if (isset($conn)) {
    $check = @$conn->query("SELECT 1 FROM election_2026_candidates LIMIT 1");
    if ($check) {
        $check->free();
        $stmt = $conn->prepare("SELECT candidate_name, party FROM election_2026_candidates WHERE ac_slug = ? ORDER BY sort_order, id");
        if ($stmt) {
            foreach (array_keys($candidates_by_ac) as $slug) {
                $stmt->bind_param('s', $slug);
                $stmt->execute();
                $res = $stmt->get_result();
                while ($row = $res ? $res->fetch_assoc() : null) {
                    if ($row) {
                        $candidates_by_ac[$slug]['candidates'][] = ['name' => $row['candidate_name'], 'party' => $row['party'] ?? ''];
                    }
                }
                if ($res) $res->free();
            }
            $stmt->close();
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
    <h1>Candidates</h1>
    <p class="lead">Candidates by Assembly constituency for Coimbatore. List will be updated when nominations are finalised.</p>
    <?php foreach ($candidates_by_ac as $slug => $data): ?>
    <div class="card mb-3">
        <div class="card-body">
            <h2 class="h5"><?php echo htmlspecialchars($data['name']); ?> (AC <?php echo (int) $data['ac_no']; ?>)</h2>
            <?php if (!empty($data['candidates'])): ?>
            <ul class="mb-0">
                <?php foreach ($data['candidates'] as $c): ?>
                <li><?php echo htmlspecialchars($c['name'] ?? $c); ?> <?php if (!empty($c['party'])): ?> – <?php echo htmlspecialchars($c['party']); endif; ?></li>
                <?php endforeach; ?>
            </ul>
            <?php else: ?>
            <p class="mb-0 text-muted">Candidates will be listed after nomination process. <a href="<?php echo htmlspecialchars($base); ?>/constituency/<?php echo htmlspecialchars($slug); ?>.php">View constituency</a>.</p>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
    <p><a href="<?php echo htmlspecialchars($base); ?>/">← Back to Elections 2026</a></p>
</main>
<?php include ROOT_PATH . '/components/footer.php'; ?>
</body>
</html>
