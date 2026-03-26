<?php
/**
 * SEO Meta Tags Generator for Articles
 * Include this file in article.php to auto-generate SEO tags
 */

if (!isset($article)) {
    // If article is not set, try to get from database
    $slug = isset($_GET['slug']) ? $_GET['slug'] : '';
    if (empty($slug)) {
        http_response_code(404);
        exit;
    }
    
    require_once '../core/omr-connect.php';
    $stmt = $conn->prepare("SELECT * FROM articles WHERE slug = ? AND status = 'published'");
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $result = $stmt->get_result();
    $article = $result->fetch_assoc();
    $stmt->close();
}

require_once __DIR__ . '/article-i18n-helpers.php';
if (empty($article_hreflang_loaded) && !empty($article['slug']) && isset($conn) && $conn instanceof mysqli) {
    $href_pair = covai_article_resolve_hreflang_urls($conn, $article['slug']);
    $article_hreflang_en = $href_pair['en'];
    $article_hreflang_ta = $href_pair['ta'];
}

// Get article data
$article_title = htmlspecialchars($article['title']);
$article_desc = htmlspecialchars($article['summary']);
$article_content = strip_tags(htmlspecialchars($article['content']));
// Use clean URL format for SEO (matches .htaccess rewrite rule)
$article_url = 'https://mycovai.in/local-news/' . $article['slug'];
$raw_image = $article['image_path'] ?? '/My-OMR-Logo.jpg';
$article_image = (strpos($raw_image, 'http://') === 0 || strpos($raw_image, 'https://') === 0)
    ? $raw_image
    : 'https://mycovai.in' . (strpos($raw_image, '/') === 0 ? '' : '/') . $raw_image;
$article_date = $article['published_date'];
$article_author = htmlspecialchars($article['author'] ?? 'MyCovai Editorial Team');
$article_category = htmlspecialchars($article['category'] ?? 'Local News');
$article_tags = !empty($article['tags']) ? explode(',', $article['tags']) : [];

$article_seo_is_ta = covai_article_slug_is_tamil($article['slug'] ?? '');
$article_seo_meta_language = $article_seo_is_ta ? 'Tamil' : 'English';
$article_seo_og_locale = $article_seo_is_ta ? 'ta_IN' : 'en_IN';
$article_seo_schema_inlang = $article_seo_is_ta ? 'ta-IN' : 'en-IN';
?>

<!-- Primary SEO Meta Tags -->
<title><?php echo $article_title; ?> | MyCovai Coimbatore</title>
<meta name="description" content="<?php echo substr($article_desc, 0, 155); ?>">
<meta name="keywords" content="<?php echo htmlspecialchars($article['tags'] ?? 'Coimbatore, Covai news'); ?>">
<meta name="author" content="<?php echo $article_author; ?>">
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<meta name="language" content="<?php echo htmlspecialchars($article_seo_meta_language); ?>">
<meta name="revisit-after" content="7 days">

<!-- Canonical URL -->
<link rel="canonical" href="<?php echo $article_url; ?>">
<?php if (!empty($article_hreflang_en) && !empty($article_hreflang_ta)) : ?>
<link rel="alternate" hreflang="en" href="<?php echo htmlspecialchars($article_hreflang_en, ENT_QUOTES, 'UTF-8'); ?>">
<link rel="alternate" hreflang="ta" href="<?php echo htmlspecialchars($article_hreflang_ta, ENT_QUOTES, 'UTF-8'); ?>">
<link rel="alternate" hreflang="x-default" href="<?php echo htmlspecialchars($article_hreflang_en, ENT_QUOTES, 'UTF-8'); ?>">
<?php endif; ?>

<!-- Open Graph / Facebook -->
<meta property="og:type" content="article">
<meta property="og:title" content="<?php echo $article_title; ?>">
<meta property="og:description" content="<?php echo substr($article_desc, 0, 200); ?>">
<meta property="og:image" content="<?php echo $article_image; ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="<?php echo $article_title; ?>">
<meta property="og:url" content="<?php echo $article_url; ?>">
<meta property="og:site_name" content="MyCovai">
<meta property="og:locale" content="<?php echo htmlspecialchars($article_seo_og_locale); ?>">
<?php if (!empty($article_hreflang_en) && !empty($article_hreflang_ta)) : ?>
<?php if ($article_seo_is_ta) : ?>
<meta property="og:locale:alternate" content="en_IN">
<?php else : ?>
<meta property="og:locale:alternate" content="ta_IN">
<?php endif; ?>
<?php endif; ?>
<meta property="article:published_time" content="<?php echo date('c', strtotime($article_date)); ?>">
<meta property="article:modified_time" content="<?php echo isset($article['updated_at']) ? date('c', strtotime($article['updated_at'])) : date('c', strtotime($article_date)); ?>">
<meta property="article:author" content="<?php echo $article_author; ?>">
<meta property="article:section" content="<?php echo $article_category; ?>">
<?php if (!empty($article_tags)): ?>
<?php foreach ($article_tags as $tag): ?>
<meta property="article:tag" content="<?php echo htmlspecialchars(trim($tag)); ?>">
<?php endforeach; ?>
<?php endif; ?>

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo $article_title; ?>">
<meta name="twitter:description" content="<?php echo substr($article_desc, 0, 200); ?>">
<meta name="twitter:image" content="<?php echo $article_image; ?>">
<meta name="twitter:image:alt" content="<?php echo $article_title; ?>">
<meta name="twitter:site" content="@MyCovai">
<meta name="twitter:creator" content="@MyCovai">
<meta name="twitter:url" content="<?php echo $article_url; ?>">

<!-- Additional SEO -->
<meta name="news_keywords" content="<?php echo htmlspecialchars($article['tags'] ?? ''); ?>">
<meta name="article:tag" content="<?php echo htmlspecialchars($article['tags'] ?? ''); ?>">
<link rel="alternate" type="application/rss+xml" href="https://mycovai.in/rss.xml">

<!-- Structured Data (JSON-LD) for Rich Snippets -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "NewsArticle",
  "headline": "<?php echo addslashes($article_title); ?>",
  "description": "<?php echo addslashes(substr($article_desc, 0, 200)); ?>",
  "image": {
    "@type": "ImageObject",
    "url": "<?php echo $article_image; ?>",
    "width": 1200,
    "height": 630
  },
  "datePublished": "<?php echo date('c', strtotime($article_date)); ?>",
  "dateModified": "<?php echo isset($article['updated_at']) ? date('c', strtotime($article['updated_at'])) : date('c', strtotime($article_date)); ?>",
  "author": {
    "@type": "Organization",
    "name": "<?php echo addslashes($article_author); ?>",
    "url": "https://mycovai.in"
  },
  "publisher": {
    "@type": "Organization",
    "name": "MyCovai",
    "logo": {
      "@type": "ImageObject",
      "url": "https://mycovai.in/My-OMR-Logo.jpg",
      "width": 600,
      "height": 60
    }
  },
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "<?php echo $article_url; ?>"
  },
  "articleSection": "<?php echo addslashes($article_category); ?>",
  "keywords": "<?php echo !empty($article['tags']) ? addslashes($article['tags']) : 'Coimbatore, Covai news'; ?>",
  "articleBody": "<?php echo addslashes(substr($article_content, 0, 500)); ?>",
  "inLanguage": "<?php echo $article_seo_schema_inlang; ?>",
  "copyrightYear": "<?php echo date('Y', strtotime($article_date)); ?>",
  "copyrightHolder": {
    "@type": "Organization",
    "name": "MyCovai"
  }
}
</script>

<!-- Breadcrumb Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [{
    "@type": "ListItem",
    "position": 1,
    "name": "Home",
    "item": "https://mycovai.in"
  }, {
    "@type": "ListItem",
    "position": 2,
    "name": "Local News",
    "item": "https://mycovai.in/local-news"
  }, {
    "@type": "ListItem",
    "position": 3,
    "name": "<?php echo addslashes($article_title); ?>",
    "item": "<?php echo $article_url; ?>"
  }]
}
</script>

<!-- Bing Verification (optional) -->
<meta name="msvalidate.01" content="">
<!-- Google Search Console Verification (add your code) -->
<meta name="google-site-verification" content="0Z9Td8zvnhZsgWaItiaCGgpQ3M3SsOr_oiAIkCcDmqE">

