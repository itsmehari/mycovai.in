<?php
/**
 * Banner ad registry for mycovai.in
 * Central list of slot IDs and ad records. No database; monetization-ready for future DB migration.
 *
 * @see components/ad-banner-slot.php
 * @see assets/css/ad-banners.css
 */

if (!defined('COVAI_AD_REGISTRY_LOADED')) {
    define('COVAI_AD_REGISTRY_LOADED', true);
}

// All slot IDs used site-wide (for reference and validation)
$covai_ad_slot_ids = [
    'homepage-top',
    'homepage-mid',
    'article-top',
    'article-mid',
    'article-bottom',
    'listing-top',
    'listing-mid',
    'detail-mid',
];

// Ad records: id, advertiser, url, slot_ids, sizes, design, headline, tagline, active
// Size 'card-row' = horizontal row of compact cards (4–5 per row); other keys are IAB sizes.
$covai_ads = [
    [
        'id'         => 'mycovai-test',
        'advertiser' => 'MyCovai',
        'url'        => 'https://mycovai.in',
        'slot_ids'   => ['homepage-top', 'homepage-mid', 'article-top', 'article-mid', 'article-bottom', 'listing-top', 'listing-mid', 'detail-mid'],
        'sizes'      => ['728x90', '336x280', '300x250', '320x50', 'card-row'],
        'design'     => 'mycovai',
        'headline'   => 'Explore Coimbatore',
        'tagline'    => 'Your local directory for Covai — schools, restaurants, jobs & more.',
        'active'     => true,
    ],
    [
        'id'         => 'colourchemist',
        'advertiser' => 'Colour Chemist Design Studio',
        'url'        => 'https://www.colourchemist.co.in/',
        'slot_ids'   => ['homepage-top'],
        'sizes'      => ['card-row'],
        'design'     => 'colourchemist',
        'headline'   => 'Colour Chemist Design Studio',
        'tagline'    => 'Coimbatore design studio — branding & design.',
        'active'     => true,
    ],
    [
        'id'         => 'edmasters',
        'advertiser' => 'EdMasters Institute',
        'url'        => 'https://edmasters.in/',
        'slot_ids'   => ['homepage-top'],
        'sizes'      => ['card-row'],
        'design'     => 'edmasters',
        'headline'   => 'EdMasters Institute',
        'tagline'    => 'Quality training in web design, Python, Android & placement.',
        'active'     => true,
    ],
    [
        'id'         => 'resumedoctor',
        'advertiser' => 'ResumeDoctor.in',
        'url'        => 'https://resumedoctor.in/',
        'slot_ids'   => ['homepage-top'],
        'sizes'      => ['card-row'],
        'design'     => 'resumedoctor',
        'headline'   => 'ResumeDoctor.in',
        'tagline'    => "India's #1 ATS resume builder — ready in minutes.",
        'active'     => true,
    ],
    [
        'id'         => 'myomr',
        'advertiser' => 'MyOMR.in',
        'url'        => 'https://myomr.in/',
        'slot_ids'   => ['homepage-top'],
        'sizes'      => ['card-row'],
        'design'     => 'myomr',
        'headline'   => 'MyOMR.in',
        'tagline'    => 'OMR Chennai directory — schools, jobs, events & more.',
        'active'     => true,
    ],
    [
        'id'         => 'akshayam',
        'advertiser' => 'Akshayam Travels',
        'url'        => 'https://www.akshayamtravels.com/',
        'slot_ids'   => ['homepage-top'],
        'sizes'      => ['card-row'],
        'design'     => 'akshayam',
        'headline'   => 'Akshayam Travels',
        'tagline'    => 'Shirdi Sai Baba temple tours & pilgrimage packages.',
        'active'     => true,
    ],
];
