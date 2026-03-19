<?php
require_once __DIR__ . '/includes/bootstrap.php';

$base = ELECTIONS_2026_BASE_URL;
$canonical_url = $base . '/quiz.php';
$page_title = 'Quiz – Are you ready to vote? | Coimbatore Elections 2026 | ' . (defined('SITE_NAME') ? SITE_NAME : 'MyCovai');
$page_description = 'Quick quiz: know your constituency, ID, poll date, BLO. See if you\'re ready to vote in Tamil Nadu Assembly election 2026.';
$page_keywords = 'vote quiz, election 2026, Coimbatore vote';
$og_title = $page_title;
$og_description = $page_description;
$og_url = $canonical_url;
$twitter_title = $page_title;
$twitter_description = $page_description;
$breadcrumbs = [
    [get_canonical_base() . '/', 'Home'],
    [$base . '/', 'Elections 2026'],
    [$canonical_url, 'Quiz'],
];

$questions = [
    ['q' => 'Do you know which Assembly constituency you belong to?', 'key' => 'ac'],
    ['q' => 'Will you carry a valid photo ID (EPIC, passport, etc.) on poll day?', 'key' => 'id'],
    ['q' => 'Do you know the poll date for Tamil Nadu 2026?', 'key' => 'poll'],
    ['q' => 'Do you know how to find your BLO (Booth Level Officer)?', 'key' => 'blo'],
];
$correct = ['ac' => true, 'id' => true, 'poll' => '23 Apr 2026', 'blo' => true];

$submitted = isset($_POST['quiz_submit']);
$score = 0;
$total = count($questions);
if ($submitted) {
    foreach ($questions as $q) {
        $k = $q['key'];
        $v = isset($_POST[$k]) ? trim($_POST[$k]) : '';
        if ($k === 'poll') {
            if (stripos($v, '23') !== false && (stripos($v, 'apr') !== false || stripos($v, 'april') !== false)) $score++;
        } elseif ($v === 'yes' || $v === '1') {
            $score++;
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
    <h1>Are you ready to vote?</h1>
    <?php if (!$submitted): ?>
    <p class="lead">Quick check: 4 questions.</p>
    <form method="post" action="">
        <?php foreach ($questions as $i => $q): ?>
        <div class="mb-4">
            <label class="form-label fw-bold"><?php echo ($i + 1); ?>. <?php echo htmlspecialchars($q['q']); ?></label>
            <?php if ($q['key'] === 'poll'): ?>
            <input type="text" name="poll" class="form-control" placeholder="e.g. 23 Apr 2026">
            <?php else: ?>
            <div>
                <label class="me-3"><input type="radio" name="<?php echo htmlspecialchars($q['key']); ?>" value="yes"> Yes</label>
                <label><input type="radio" name="<?php echo htmlspecialchars($q['key']); ?>" value="no"> No</label>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
        <button type="submit" name="quiz_submit" class="btn btn-primary">Submit</button>
    </form>
    <?php else: ?>
    <p class="lead">You got <?php echo $score; ?> out of <?php echo $total; ?>.</p>
    <?php if ($score >= 3): ?>
    <div class="alert alert-success">You're ready! Don't forget to vote on 23 Apr 2026.</div>
    <?php else: ?>
    <div class="alert alert-warning">Do this next:</div>
    <ul>
        <li><a href="<?php echo htmlspecialchars($base); ?>/know-your-constituency.php">Know your constituency</a></li>
        <li><a href="<?php echo htmlspecialchars($base); ?>/how-to-vote.php">How to vote</a></li>
        <li><a href="<?php echo htmlspecialchars($base); ?>/dates.php">Key dates</a></li>
        <li><a href="<?php echo htmlspecialchars($base); ?>/find-blo.php">Find BLO</a></li>
        <li><a href="<?php echo htmlspecialchars($base); ?>/faq.php">FAQ</a></li>
    </ul>
    <?php endif; ?>
    <p><a href="<?php echo htmlspecialchars($base); ?>/quiz.php">Try again</a> · <a href="<?php echo htmlspecialchars($base); ?>/">Elections 2026</a></p>
    <?php endif; ?>
</main>
<?php include ROOT_PATH . '/components/footer.php'; ?>
</body>
</html>
