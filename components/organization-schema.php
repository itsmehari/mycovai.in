<?php
// Organization JSON-LD schema – uses config when loaded (Phase 5.4: MyCovai, Coimbatore)
if (!function_exists('get_canonical_base')) {
    require_once __DIR__ . '/../core/url-helpers.php';
}
$base = get_canonical_base();
if (!function_exists('covai_site_name')) {
    require_once __DIR__ . '/../core/mycovai-config.php';
}
$orgName = covai_site_name();
$orgLogo = $base . covai_logo_url();
$sameAs = [];
if (defined('MYCOVAI_CONFIG_LOADED')) {
    if (defined('SOCIAL_FACEBOOK') && SOCIAL_FACEBOOK !== '') $sameAs[] = SOCIAL_FACEBOOK;
    if (defined('SOCIAL_INSTAGRAM') && SOCIAL_INSTAGRAM !== '') $sameAs[] = SOCIAL_INSTAGRAM;
    if (defined('SOCIAL_TWITTER') && SOCIAL_TWITTER !== '') $sameAs[] = SOCIAL_TWITTER;
    if (defined('SOCIAL_YOUTUBE') && SOCIAL_YOUTUBE !== '') $sameAs[] = SOCIAL_YOUTUBE;
    if (defined('SOCIAL_WHATSAPP') && SOCIAL_WHATSAPP !== '') $sameAs[] = SOCIAL_WHATSAPP;
}
if (empty($sameAs) && defined('SOCIAL_WHATSAPP') && SOCIAL_WHATSAPP !== '') {
    $sameAs = [SOCIAL_WHATSAPP];
}
$org = [
  '@context' => 'https://schema.org',
  '@type' => 'Organization',
  'name' => $orgName,
  'url' => $base . '/',
  'logo' => $orgLogo,
  'sameAs' => array_values($sameAs)
];
if (defined('MYCOVAI_CONFIG_LOADED') && defined('SITE_REGION') && SITE_REGION !== '') {
  $org['address'] = [
    '@type' => 'PostalAddress',
    'addressLocality' => SITE_REGION,
    'addressRegion' => 'Tamil Nadu',
    'addressCountry' => 'IN'
  ];
}
?>
<script type="application/ld+json"><?php echo json_encode($org, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?></script>


