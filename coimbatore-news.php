<?php
/**
 * Covai News – canonical Coimbatore news page.
 * Sections: hero, lead article + grid (Option B), quick links, featured events, subscribe, footer.
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include __DIR__ . '/weblog/log.php';
require_once __DIR__ . '/core/omr-connect.php';
require_once __DIR__ . '/core/url-helpers.php';

$canonical_url = get_canonical_base() . '/coimbatore-news.php';
$page_title = 'Covai News – Coimbatore Local News & Updates | ' . (defined('SITE_NAME') ? SITE_NAME : 'MyCovai');
$page_description = 'Stay updated with local news, events and stories from Coimbatore. Covai news, community updates and listings at ' . (defined('SITE_NAME') ? SITE_NAME : 'MyCovai') . '.';
$page_keywords = 'Coimbatore news, Covai news, local news Coimbatore, RS Puram, Gandhipuram, Peelamedu, Saibaba Colony, ' . (defined('SITE_NAME') ? SITE_NAME : 'MyCovai');
$og_site_name = defined('SITE_OG_SITE_NAME') ? SITE_OG_SITE_NAME : 'MyCovai – Coimbatore Directory';

// Articles: same query as home-page-news-cards, then split into lead + grid (Option B)
$tag_filter = isset($_GET['tag']) ? trim($_GET['tag']) : '';
$sql = "SELECT id, title, slug, summary, published_date, image_path 
        FROM articles 
        WHERE status = 'published' 
        AND slug NOT LIKE '%-tamil' ";
if ($tag_filter !== '') {
    $tag_escaped = $conn->real_escape_string($tag_filter);
    $sql .= "AND (tags LIKE '%" . $tag_escaped . "%' OR category LIKE '%" . $tag_escaped . "%') ";
}
$sql .= "ORDER BY published_date DESC LIMIT 21";
$articles_result = $conn->query($sql);
$lead_article = null;
$grid_articles = [];
if ($articles_result && $articles_result->num_rows > 0) {
    $lead_article = $articles_result->fetch_assoc();
    while ($row = $articles_result->fetch_assoc()) {
        $grid_articles[] = $row;
    }
}

function article_image_url($image_path) {
    $img = $image_path ?? '/My-OMR-Logo.jpg';
    return (strpos($img, 'http') === 0) ? $img : 'https://mycovai.in' . (strpos($img, '/') === 0 ? '' : '/') . $img;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($page_description); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($page_keywords); ?>">
    <link rel="canonical" href="<?php echo htmlspecialchars($canonical_url); ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($page_title); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($page_description); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($canonical_url); ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?php echo htmlspecialchars($og_site_name); ?>">
    <meta name="robots" content="index, follow">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;1,9..144,400&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/homepage-directone.css">
    <link rel="stylesheet" href="/assets/css/coimbatore-news.css">
    <link rel="stylesheet" href="/assets/css/events-covai.css">
    <?php include __DIR__ . '/components/analytics.php'; ?>
</head>
<body class="covai-news-page">

<?php require_once __DIR__ . '/components/homepage-header.php'; ?>

<!-- 1. Page header / hero strip -->
<section class="covai-news-hero">
    <div class="container-xl">
        <nav aria-label="Breadcrumb" class="covai-news-breadcrumb">
            <a href="/">Home</a>
            <span class="sep">→</span>
            <span>Covai News</span>
        </nav>
        <h1 class="covai-news-title">Covai News<?php if ($tag_filter !== ''): ?> — <?php echo htmlspecialchars($tag_filter); ?><?php endif; ?></h1>
        <p class="covai-news-tagline">Local updates, events and stories from Coimbatore.</p>
    </div>
</section>

<!-- 2. Latest articles: lead + grid (Option B) -->
<section class="covai-news-articles">
    <div class="container-xl">
        <h2 class="covai-news-section-heading">Latest from Covai</h2>

        <?php if ($lead_article): ?>
        <article class="covai-news-lead">
            <?php $img_url = article_image_url($lead_article['image_path']); ?>
            <a href="/local-news/<?php echo htmlspecialchars($lead_article['slug']); ?>" class="covai-news-lead-link">
                <div class="covai-news-lead-image-wrap">
                    <img src="<?php echo htmlspecialchars($img_url); ?>" alt="<?php echo htmlspecialchars($lead_article['title']); ?>">
                </div>
                <div class="covai-news-lead-body">
                    <time class="covai-news-date" datetime="<?php echo htmlspecialchars($lead_article['published_date']); ?>"><?php echo date('F j, Y', strtotime($lead_article['published_date'])); ?></time>
                    <h3 class="covai-news-lead-title"><?php echo htmlspecialchars($lead_article['title']); ?></h3>
                    <p class="covai-news-lead-summary"><?php echo htmlspecialchars($lead_article['summary']); ?></p>
                    <span class="covai-news-read-more">Read more</span>
                </div>
            </a>
        </article>
        <?php endif; ?>

        <?php if (!empty($grid_articles)): ?>
        <div class="covai-news-grid">
            <?php foreach ($grid_articles as $row): ?>
            <article class="covai-news-card">
                <?php $img_url = article_image_url($row['image_path']); ?>
                <a href="/local-news/<?php echo htmlspecialchars($row['slug']); ?>" class="covai-news-card-link">
                    <div class="covai-news-card-image">
                        <img src="<?php echo htmlspecialchars($img_url); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                    </div>
                    <div class="covai-news-card-body">
                        <time class="covai-news-date" datetime="<?php echo htmlspecialchars($row['published_date']); ?>"><?php echo date('M j, Y', strtotime($row['published_date'])); ?></time>
                        <h4 class="covai-news-card-title"><?php echo htmlspecialchars($row['title']); ?></h4>
                        <p class="covai-news-card-summary"><?php echo htmlspecialchars(mb_substr($row['summary'], 0, 120)); ?><?php echo mb_strlen($row['summary']) > 120 ? '…' : ''; ?></p>
                        <span class="covai-news-read-more">Read more</span>
                    </div>
                </a>
            </article>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (!$lead_article && empty($grid_articles)): ?>
        <p class="covai-news-empty">No news available at the moment.</p>
        <?php endif; ?>
    </div>
</section>

<!-- 3. Quick links CTAs -->
<section class="covai-news-ctas">
    <div class="container-xl">
        <div class="covai-news-ctas-inner">
            <a href="/local-events/" class="covai-news-cta-btn"><i class="fas fa-calendar-alt me-2"></i>Events in Covai</a>
            <a href="/jobs/" class="covai-news-cta-btn"><i class="fas fa-briefcase me-2"></i>Jobs</a>
            <a href="/directory/index.php" class="covai-news-cta-btn"><i class="fas fa-th-large me-2"></i>Directory</a>
            <a href="/coimbatore-elections-2026/" class="covai-news-cta-btn"><i class="fas fa-vote-yea me-2"></i>Elections 2026</a>
        </div>
    </div>
</section>

<!-- 4a. This week (upcoming, next 7 days) -->
<section class="covai-news-events-this-week py-4 border-top border-bottom">
    <div class="container-xl">
        <h2 class="covai-news-section-heading">Happening this week</h2>
        <?php include __DIR__ . '/local-events/components/events-this-week-strip.php'; ?>
    </div>
</section>

<!-- 4b. Featured events -->
<section class="covai-news-events">
    <div class="container-xl">
        <h2 class="covai-news-section-heading">Featured events in Coimbatore</h2>
        <?php include __DIR__ . '/local-events/components/top-featured-events-widget.php'; ?>
        <div class="text-center mt-3">
            <a href="/local-events/" class="btn btn-primary covai-news-btn">View all events</a>
        </div>
    </div>
</section>

<!-- 5. Subscribe -->
<section class="covai-news-subscribe">
    <div class="container-xl">
        <div class="covai-news-subscribe-inner">
            <span class="covai-news-subscribe-label">Newsletter</span>
            <h3 class="covai-news-subscribe-title">Get the latest from Covai</h3>
            <p class="covai-news-subscribe-text">Events, listings and local updates—once in a while, in your inbox.</p>
            <form class="covai-news-subscribe-form" action="<?php echo htmlspecialchars((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/core/subscribe.php'); ?>" method="POST">
                <input type="email" name="email" placeholder="you@email.com" required aria-label="Email address">
                <button type="submit">Subscribe</button>
            </form>
        </div>
    </div>
</section>

<!-- 6. Footer -->
<?php include __DIR__ . '/components/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
