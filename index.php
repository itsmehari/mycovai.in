<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php
include 'weblog/log.php';
include 'core/omr-connect.php';

$sql = "SELECT `Areas` FROM `List of Areas`";
$result = $conn->query($sql);

require_once __DIR__ . '/core/url-helpers.php';
$canonical_url = get_canonical_base() . '/';

// Homepage meta from config (Phase 1 – single source for branding)
$page_title = defined('SITE_DEFAULT_TITLE') ? SITE_DEFAULT_TITLE : 'MyCovai – Coimbatore Directory & Listings | Explore Covai';
$page_description = defined('SITE_DEFAULT_DESCRIPTION') ? SITE_DEFAULT_DESCRIPTION : 'Your local directory for Coimbatore. Find schools, restaurants, jobs, events, hostels, coworking spaces and more in Covai.';
$page_keywords = defined('SITE_DEFAULT_KEYWORDS') ? SITE_DEFAULT_KEYWORDS : 'Coimbatore, Covai, MyCovai, directory, listings, local business, schools, jobs, events, hostels, coworking, RS Puram, Gandhipuram, Tamil Nadu';
$og_site_name = defined('SITE_OG_SITE_NAME') ? SITE_OG_SITE_NAME : 'MyCovai – Coimbatore Directory';

// Listing counts for category grid
$listing_counts = include __DIR__ . '/core/homepage-listing-counts.php';
if (!is_array($listing_counts)) {
    $listing_counts = [];
}

// Category config for homepage grid (key => [label, url, icon, highlight])
$home_categories = [
    'schools'            => ['Schools', '/directory/schools.php', 'fas fa-school', false],
    'best-schools'       => ['Best Schools', '/directory/best-schools.php', 'fas fa-star', false],
    'it-companies'       => ['IT Companies', '/directory/it-companies.php', 'fas fa-laptop-code', true],
    'industries'         => ['Industries', '/directory/industries.php', 'fas fa-industry', false],
    'restaurants'        => ['Restaurants', '/directory/restaurants.php', 'fas fa-utensils', false],
    'government-offices' => ['Government Offices', '/directory/government-offices.php', 'fas fa-building', false],
    'atms'               => ['ATMs', '/directory/atms.php', 'fas fa-credit-card', false],
    'parks'              => ['Parks', '/directory/parks.php', 'fas fa-tree', false],
    'banks'              => ['Banks', '/directory/banks.php', 'fas fa-university', false],
    'hospitals'          => ['Hospitals', '/directory/hospitals.php', 'fas fa-hospital', false],
    'hostels-pgs'        => ['Hostels & PGs', '/hostels-pgs/', 'fas fa-bed', false],
    'coworking-spaces'   => ['Coworking Spaces', '/coworking-spaces/', 'fas fa-building', false],
];
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

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Typography: Fraunces (display) + Poppins (body/UI) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;1,9..144,400&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/homepage-directone.css">
    <?php include 'components/analytics.php'; ?>
    <script type="application/ld+json"><?php
    $base = defined('SITE_CANONICAL_BASE') ? SITE_CANONICAL_BASE : 'https://mycovai.in';
    $name = defined('SITE_NAME') ? SITE_NAME : 'MyCovai';
    $desc = defined('SITE_DEFAULT_DESCRIPTION') ? SITE_DEFAULT_DESCRIPTION : 'Your local directory for Coimbatore. Find schools, restaurants, jobs, events and more in Covai.';
    echo json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => $name,
        'url' => $base . '/',
        'description' => $desc,
        'publisher' => [
            '@type' => 'Organization',
            'name' => $name,
            'url' => $base,
            'address' => ['@type' => 'PostalAddress', 'addressLocality' => 'Coimbatore', 'addressRegion' => 'Tamil Nadu', 'addressCountry' => 'IN']
        ]
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    ?></script>
</head>
<body style="background-color: #FAF8F5;">

<!-- Header -->
<header class="homepage-header">
    <div class="container-xl">
        <div class="homepage-header-inner">
            <a href="/" class="homepage-logo">
                <span class="logo-text">MyCovai</span>
                <span class="logo-tagline">Coimbatore Directory &amp; Listing</span>
            </a>
            <button type="button" class="homepage-menu-toggle" aria-label="Toggle menu" onclick="document.querySelector('.homepage-nav').classList.toggle('active')">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="homepage-nav">
                <li><a href="/">Home</a></li>
                <li><a href="/about.php">About</a></li>
                <li><a href="/directory/index.php">Listing</a></li>
                <li><a href="/local-news/news-highlights-from-omr-road.php">Blog</a></li>
                <li><a href="/contact.php">Contact</a></li>
            </ul>
            <a href="/jobs/employer-landing-omr.php" class="homepage-cta">
                <i class="fas fa-plus"></i> Add Listing
            </a>
        </div>
    </div>
</header>

<!-- Hero with search -->
<section class="homepage-hero">
    <div class="homepage-hero-overlay"></div>
    <div class="homepage-hero-content">
        <h1 class="hero-title">Explore Coimbatore</h1>
        <p class="hero-subtitle">Your local directory for Covai — find businesses, places and events, or add your own listing.</p>
        <div class="homepage-search-wrap">
        <form class="homepage-search" action="/directory/index.php" method="get" role="search">
            <input type="text" name="q" placeholder="What are you looking for?" aria-label="Search query">
            <input type="text" name="location" placeholder="Area in Coimbatore" aria-label="Location in Coimbatore">
            <select name="category" aria-label="Category">
                <option value="">All Categories</option>
                <?php foreach ($home_categories as $slug => $info): ?>
                    <option value="<?php echo htmlspecialchars($slug); ?>"><?php echo htmlspecialchars($info[0]); ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="search-btn">Search</button>
        </form>
        </div>
    </div>
</section>

<!-- OUR LISTING - Category grid -->
<section class="homepage-listings">
    <div class="container-xl">
        <p class="section-label">Explore Covai</p>
        <div class="homepage-category-grid">
            <?php foreach ($home_categories as $key => $info):
                $label = $info[0];
                $url = $info[1];
                $icon = $info[2];
                $highlight = !empty($info[3]);
                $count = isset($listing_counts[$key]) ? (int) $listing_counts[$key] : 0;
            ?>
            <a href="<?php echo htmlspecialchars($url); ?>" class="homepage-category-card <?php echo $highlight ? 'card-highlight' : ''; ?>">
                <span class="card-icon"><i class="<?php echo htmlspecialchars($icon); ?>" aria-hidden="true"></i></span>
                <span class="card-title"><?php echo htmlspecialchars($label); ?></span>
                <span class="card-count"><?php echo $count; ?> listings</span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php if (!function_exists('covai_ad_banner_row')) { require_once __DIR__ . '/components/ad-banner-slot.php'; } ?>
<!-- Banner ad: homepage-top (row of 4–6 distinct ads) -->
<div class="container-xl py-3">
    <?php covai_ad_banner_row('homepage-top', 'card-row', 6); ?>
</div>

<!-- Elections 2026 -->
<section class="homepage-section-block" style="background: linear-gradient(135deg, #1a365d 0%, #2c5282 100%); color: #fff;">
    <div class="container text-center">
        <h2 class="homepage-section-title" style="color: #fff;">Elections 2026</h2>
        <p class="homepage-section-subtitle" style="color: rgba(255,255,255,0.9);">Tamil Nadu Assembly election guide for Coimbatore. Key dates, constituencies, how to vote, BLO and more.</p>
        <a href="/coimbatore-elections-2026/" class="btn btn-light btn-lg mt-2">View guide</a>
    </div>
</section>

<!-- Featured Events -->
<section class="homepage-section-block">
    <div class="container text-center">
        <h2 class="homepage-section-title">Featured Events</h2>
        <p class="homepage-section-subtitle">What's happening in Covai</p>
        <?php include __DIR__ . '/local-events/components/top-featured-events-widget.php'; ?>
        <div class="mt-4">
            <a class="btn btn-outline-danger btn-sm" href="/local-events/">Browse all events in Covai</a>
        </div>
    </div>
</section>

<!-- Latest News -->
<section class="homepage-section-block" style="background: var(--mycovai-bg-alt, #F5F1EC);">
    <div class="container text-center">
        <h2 class="homepage-section-title">Latest News</h2>
        <p class="homepage-section-subtitle">Stories and updates from Coimbatore</p>
        <?php include 'weblog/home-page-news-cards.php'; ?>
    </div>
</section>

<!-- Banner ad: homepage-mid -->
<div class="container-xl py-3">
    <?php covai_ad_slot('homepage-mid', '336x280'); ?>
</div>

<!-- Subscribe -->
<section class="homepage-section-block" id="subscribe">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border-0 shadow-sm p-4 p-md-5 text-center" style="background: var(--mycovai-white); border-radius: 12px;">
                    <h2 class="homepage-section-title mb-2">Subscribe to Our Newsletter</h2>
                    <p class="homepage-section-subtitle mb-4">Get the latest news, events and listings from Covai in your inbox.</p>
                    <form action="core/subscribe.php" method="POST" class="d-flex flex-wrap justify-content-center gap-2">
                        <label for="email-subscribe" class="visually-hidden">Email</label>
                        <input type="email" id="email-subscribe" name="email" class="form-control" style="max-width: 280px;" placeholder="you@email.com" required>
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<?php include 'components/footer.php'; ?>

<!-- WhatsApp float -->
<a href="https://wa.me/919445088028" class="position-fixed bottom-0 end-0 m-3 p-3 bg-success text-white rounded-circle shadow" style="z-index: 1000;" target="_blank" rel="noopener" aria-label="Chat with MyCovai on WhatsApp">
    <i class="fab fa-whatsapp fa-lg"></i>
</a>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
