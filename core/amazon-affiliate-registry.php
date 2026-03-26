<?php
/**
 * Amazon India affiliate entries merged into $covai_ads when enabled and tagged.
 *
 * @see core/ad-registry.php
 * @see components/ad-banner-slot.php
 */

if (!defined('COVAI_AD_REGISTRY_LOADED')) {
    return;
}

require_once __DIR__ . '/mycovai-config.php';

if (!defined('COVAI_AMAZON_AFFILIATE_ENABLED') || !COVAI_AMAZON_AFFILIATE_ENABLED) {
    return;
}

$tag = trim((string) (defined('AMAZON_ASSOCIATE_STORE_ID') ? AMAZON_ASSOCIATE_STORE_ID : ''));
if ($tag === '') {
    return;
}

if (!function_exists('covai_amazon_in_affiliate_url')) {
    /**
     * Build an amazon.in URL with the Associate tag. Use official link tools for product URLs when possible.
     *
     * @param string $path Absolute path on amazon.in (e.g. 'gp/bestsellers/') or empty for homepage.
     */
    function covai_amazon_in_affiliate_url($path = '') {
        $tag = trim((string) (defined('AMAZON_ASSOCIATE_STORE_ID') ? AMAZON_ASSOCIATE_STORE_ID : ''));
        if ($tag === '') {
            return 'https://www.amazon.in/';
        }
        $path = trim((string) $path);
        if ($path === '') {
            return 'https://www.amazon.in/?tag=' . rawurlencode($tag);
        }
        $path = ltrim($path, '/');
        $base = 'https://www.amazon.in/' . $path;
        $sep = (strpos($base, '?') !== false) ? '&' : '?';
        return $base . $sep . 'tag=' . rawurlencode($tag);
    }
}

$covai_amazon_affiliate_ads = [
    [
        'id'                 => 'amazon-in-home',
        'advertiser'         => 'Amazon.in',
        'monetization_type'  => 'affiliate',
        'url'                => covai_amazon_in_affiliate_url(''),
        'slot_ids'           => ['homepage-top', 'homepage-mid', 'article-mid', 'article-bottom', 'listing-mid', 'detail-mid'],
        'sizes'              => ['728x90', '336x280', '300x250', '320x50', 'card-row'],
        'design'             => 'amazon',
        'headline'           => 'Shop on Amazon.in',
        'tagline'            => 'Books, electronics, home essentials and more — delivered in India.',
        'cta'                => 'Shop now',
        'active'             => true,
    ],
    [
        'id'                 => 'amazon-in-bestsellers',
        'advertiser'         => 'Amazon.in',
        'monetization_type'  => 'affiliate',
        'url'                => covai_amazon_in_affiliate_url('gp/bestsellers/'),
        'slot_ids'           => ['homepage-top', 'homepage-mid', 'article-mid', 'article-bottom', 'listing-mid', 'detail-mid'],
        'sizes'              => ['728x90', '336x280', '300x250', '320x50', 'card-row'],
        'design'             => 'amazon',
        'headline'           => 'Popular on Amazon.in',
        'tagline'            => 'Browse bestsellers and top deals.',
        'cta'                => 'See deals',
        'active'             => true,
    ],
];

$covai_ads = array_merge($covai_ads, $covai_amazon_affiliate_ads);
