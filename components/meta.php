<!-- Meta/SEO Tags Component -->
<?php
if (!function_exists('get_canonical_url')) {
    require_once __DIR__ . '/../core/url-helpers.php';
}
$canonical_url = isset($canonical_url) ? $canonical_url : get_canonical_url();

// Use config defaults when MyCovai config is loaded (Phase 2)
$default_title = defined('MYCOVAI_CONFIG_LOADED') && defined('SITE_DEFAULT_TITLE')
    ? SITE_DEFAULT_TITLE
    : 'My OMR - Old Mahabalipuram Road News, Events, Images, Happenings, Search, Business Website';
$default_description = defined('MYCOVAI_CONFIG_LOADED') && defined('SITE_DEFAULT_DESCRIPTION')
    ? SITE_DEFAULT_DESCRIPTION
    : 'News, Events, Happenings in and around Old Mahabalipuram Road, Chennai.';
$default_keywords = defined('MYCOVAI_CONFIG_LOADED') && defined('SITE_DEFAULT_KEYWORDS')
    ? SITE_DEFAULT_KEYWORDS
    : 'Old Mahabalipuram Road, OMR Road, OMR News, My OMR, Perungudi, SRP Tools, Kandhanchavadi, Thuraipakkam, Karapakkam, Mettukuppam, Dollar Stop, Sholinganallur, Navalur, Kelambakkam.';
$default_og_title = defined('MYCOVAI_CONFIG_LOADED') && defined('SITE_OG_SITE_NAME')
    ? SITE_OG_SITE_NAME
    : 'Old Mahabalipuram Road news, Search, Events, Happenings, Photographs';
$default_og_description = defined('MYCOVAI_CONFIG_LOADED') && defined('SITE_DEFAULT_DESCRIPTION')
    ? SITE_DEFAULT_DESCRIPTION
    : 'home page of old mahabalipuram road, OMR website, which hosts several features for its user base, especially from chennai, Tamilnadu.';
$default_og_site_name = defined('MYCOVAI_CONFIG_LOADED') && defined('SITE_OG_SITE_NAME')
    ? SITE_OG_SITE_NAME
    : 'My OMR Old Mahabalipuram Road.';
$base = get_canonical_base();
$default_og_image = defined('MYCOVAI_CONFIG_LOADED') && defined('SITE_LOGO_URL') && SITE_LOGO_URL !== ''
    ? $base . SITE_LOGO_URL
    : $base . '/My-OMR-Logo.jpg';
?>
<title><?php echo isset($page_title) ? htmlspecialchars($page_title) : $default_title; ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php echo isset($page_description) ? htmlspecialchars($page_description) : $default_description; ?>">
<meta name="keywords" content="<?php echo isset($page_keywords) ? htmlspecialchars($page_keywords) : $default_keywords; ?>">
<meta name="author" content="Krishnan">
<link rel="canonical" href="<?php echo htmlspecialchars($canonical_url); ?>">
<meta property="og:type" content="article" />
<meta property="og:title" content="<?php echo isset($og_title) ? htmlspecialchars($og_title) : $default_og_title; ?>" />
<meta property="og:description" content="<?php echo isset($og_description) ? htmlspecialchars($og_description) : $default_og_description; ?>" />
<meta property="og:image" content="<?php echo isset($og_image) ? htmlspecialchars($og_image) : $default_og_image; ?>" />
<meta property="og:url" content="<?php echo isset($og_url) ? htmlspecialchars($og_url) : $canonical_url; ?>" />
<meta property="og:site_name" content="<?php echo $default_og_site_name; ?>" />
<meta property="og:locale" content="en_US" />
<meta property="og:locale:alternate" content="ta_IN" />
<meta name="twitter:title" content="<?php echo isset($twitter_title) ? htmlspecialchars($twitter_title) : $default_title; ?>">
<meta name="twitter:description" content="<?php echo isset($twitter_description) ? htmlspecialchars($twitter_description) : $default_og_description; ?>">
<meta name="twitter:image" content="<?php echo isset($twitter_image) ? htmlspecialchars($twitter_image) : $default_og_image; ?>">
<meta name="twitter:site" content="<?php echo defined('MYCOVAI_CONFIG_LOADED') ? '@MyCovai' : '@MyomrNews'; ?>">
<meta name="twitter:creator" content="<?php echo defined('MYCOVAI_CONFIG_LOADED') ? '@MyCovai' : '@MyomrNews'; ?>">
<!-- End Meta/SEO Tags -->
<script type="application/ld+json">
<?php
$org_name = defined('MYCOVAI_CONFIG_LOADED') && defined('SITE_NAME') ? SITE_NAME : 'My OMR';
$org_url = $base . '/';
$org_logo = isset($og_image) ? $og_image : $default_og_image;
$same_as = [];
if (defined('MYCOVAI_CONFIG_LOADED')) {
    if (defined('SOCIAL_FACEBOOK') && SOCIAL_FACEBOOK !== '') $same_as[] = SOCIAL_FACEBOOK;
    if (defined('SOCIAL_INSTAGRAM') && SOCIAL_INSTAGRAM !== '') $same_as[] = SOCIAL_INSTAGRAM;
    if (defined('SOCIAL_TWITTER') && SOCIAL_TWITTER !== '') $same_as[] = SOCIAL_TWITTER;
}
if (empty($same_as)) {
    $same_as = ['https://www.facebook.com/MyOMR.in', 'https://www.instagram.com/myomr.in', 'https://x.com/MyomrNews'];
}
$org = [
  '@context' => 'https://schema.org',
  '@type' => 'Organization',
  'name' => $org_name,
  'url' => $org_url,
  'logo' => $org_logo,
  'sameAs' => $same_as
];
echo json_encode($org, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
?>
</script>
<?php if (!empty($breadcrumbs) && is_array($breadcrumbs)): ?>
<script type="application/ld+json">
<?php
$items = [];
$pos = 1;
foreach ($breadcrumbs as $crumb) {
  if (is_array($crumb)) {
    if (isset($crumb['@id']) && isset($crumb['name'])) {
      $items[] = ['@type'=>'ListItem','position'=>$pos++,'item'=>['@id'=>$crumb['@id'],'name'=>$crumb['name']]];
    } elseif (isset($crumb[0]) && isset($crumb[1])) {
      $items[] = ['@type'=>'ListItem','position'=>$pos++,'item'=>['@id'=>$crumb[0],'name'=>$crumb[1]]];
    }
  }
}
if (!empty($items)) {
  $crumbs = [
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => $items
  ];
  echo json_encode($crumbs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
}
?>
</script>
<?php endif; ?>
