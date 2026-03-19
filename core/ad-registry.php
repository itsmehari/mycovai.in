<?php
/**
 * Banner ad registry for mycovai.in
 * Central list of slot IDs and ad records. No database; monetization-ready for future DB migration.
 *
 * @see components/ad-banner-slot.php
 * @see assets/css/ad-banners.css
 */

if (!defined('OMR_AD_REGISTRY_LOADED')) {
    define('OMR_AD_REGISTRY_LOADED', true);
}

// All slot IDs used site-wide (for reference and validation)
$omr_ad_slot_ids = [
    'homepage-top',
    'homepage-mid',
    'article-top',
    'article-mid',
    'listing-top',
    'listing-mid',
    'detail-mid',
];

// Ad records: id, advertiser, url, slot_ids, sizes, design, headline, tagline, active
$omr_ads = [
    [
        'id'         => 'mycovai-test',
        'advertiser' => 'MyCovai',
        'url'        => 'https://mycovai.in',
        'slot_ids'   => ['homepage-top', 'homepage-mid', 'article-top', 'article-mid', 'listing-top', 'listing-mid', 'detail-mid'],
        'sizes'      => ['728x90', '336x280', '300x250', '320x50'],
        'design'     => 'mycovai',
        'headline'   => 'Explore Coimbatore',
        'tagline'    => 'Your local directory for Covai — schools, restaurants, jobs & more.',
        'active'     => true,
    ],
];
