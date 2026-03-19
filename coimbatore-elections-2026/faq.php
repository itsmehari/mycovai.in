<?php
require_once __DIR__ . '/includes/bootstrap.php';

$base = ELECTIONS_2026_BASE_URL;
$canonical_url = $base . '/faq.php';

$faqs = [
    ['q' => 'When is the poll in Tamil Nadu 2026?', 'a' => 'Poll date is 23 April 2026. Counting is on 4 May 2026.'],
    ['q' => 'What ID do I need to vote?', 'a' => 'EPIC (voter ID), passport, driving licence, or any other ECI-approved photo identity document.'],
    ['q' => 'How do I find my polling station?', 'a' => 'Check your voter slip or the electoral roll on the CEO Tamil Nadu / erolls.tn.gov.in website. You can also contact your BLO – see Find BLO on this site.'],
    ['q' => 'What is VVPAT?', 'a' => 'Voter Verifiable Paper Audit Trail. After you press the button on the EVM, a paper slip is generated so you can verify your vote.'],
    ['q' => 'Can I use postal ballot?', 'a' => 'Postal ballot is available for eligible categories (e.g. senior citizens, PwD, COVID protocol as per ECI). Check with the Returning Officer or ECI guidelines.'],
    ['q' => 'What is the Model Code of Conduct (MCC)?', 'a' => 'The MCC is a set of guidelines for parties and candidates during elections. It applies from the announcement of the election schedule until the process is over.'],
    ['q' => 'Which constituencies are in Coimbatore?', 'a' => 'Six ACs in the Coimbatore Lok Sabha segment: Palladam (115), Sulur (116), Kavundampalayam (117), Coimbatore North (118), Coimbatore South (120), Singanallur (121).'],
    ['q' => 'Where do I find the official election schedule?', 'a' => 'The Election Commission of India (eci.gov.in) and CEO Tamil Nadu (elections.tn.gov.in) publish the final schedule.'],
];

$page_title = 'FAQ – Coimbatore Elections 2026 | ' . (defined('SITE_NAME') ? SITE_NAME : 'MyCovai');
$page_description = 'Frequently asked questions about Tamil Nadu Assembly election 2026: dates, ID, EVM, VVPAT, postal ballot, MCC, Coimbatore constituencies.';
$page_keywords = 'election 2026 FAQ, vote FAQ, EVM, VVPAT, Coimbatore election';
$og_title = $page_title;
$og_description = $page_description;
$og_url = $canonical_url;
$twitter_title = $page_title;
$twitter_description = $page_description;
$breadcrumbs = [
    [get_canonical_base() . '/', 'Home'],
    [$base . '/', 'Elections 2026'],
    [$canonical_url, 'FAQ'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include ROOT_PATH . '/components/meta.php'; ?>
    <?php include ROOT_PATH . '/components/head-resources.php'; ?>
    <?php include ROOT_PATH . '/components/analytics.php'; ?>
    <?php
    $faq_ld = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [],
    ];
    foreach ($faqs as $faq) {
        $faq_ld['mainEntity'][] = [
            '@type' => 'Question',
            'name' => $faq['q'],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['a']],
        ];
    }
    ?>
    <script type="application/ld+json"><?php echo json_encode($faq_ld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?></script>
</head>
<body>
<a href="#main-content" class="visually-hidden-focusable skip-link">Skip to main content</a>
<?php include ROOT_PATH . '/components/main-nav.php'; ?>
<main id="main-content" class="container py-5">
    <h1>FAQ</h1>
    <p class="lead">Common questions about the Tamil Nadu Assembly election 2026.</p>
    <div class="accordion mb-4" id="faq-accordion">
        <?php foreach ($faqs as $i => $faq): ?>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button <?php echo $i === 0 ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#faq-<?php echo $i; ?>" aria-expanded="<?php echo $i === 0 ? 'true' : 'false'; ?>" aria-controls="faq-<?php echo $i; ?>"><?php echo htmlspecialchars($faq['q']); ?></button>
            </h2>
            <div id="faq-<?php echo $i; ?>" class="accordion-collapse collapse <?php echo $i === 0 ? 'show' : ''; ?>" data-bs-parent="#faq-accordion">
                <div class="accordion-body"><?php echo nl2br(htmlspecialchars($faq['a'])); ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <p><a href="<?php echo htmlspecialchars($base); ?>/">← Back to Elections 2026</a></p>
</main>
<?php include ROOT_PATH . '/components/footer.php'; ?>
</body>
</html>
