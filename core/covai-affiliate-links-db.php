<?php
/**
 * Load active affiliate/sponsor rows from MySQL into $covai_ads (same shape as ad-registry).
 *
 * @param array $covai_ads Ads array (passed by reference)
 * @see core/ad-registry.php
 * @see docs/ads.md
 */

if (!function_exists('covai_merge_affiliate_links_from_db')) {
    function covai_merge_affiliate_links_from_db(array &$covai_ads) {
        if (!defined('COVAI_AFFILIATE_LINKS_DB_ENABLED') || !COVAI_AFFILIATE_LINKS_DB_ENABLED) {
            return;
        }

        $conn_path = __DIR__ . '/omr-connect.php';
        if (!is_file($conn_path)) {
            return;
        }
        require_once $conn_path;

        if (!isset($conn) || !($conn instanceof mysqli)) {
            return;
        }

        $sql = 'SELECT id, monetization_type, advertiser, url, slot_ids, sizes, design, headline, tagline, cta, weight, active
                FROM covai_affiliate_links WHERE active = 1';
        $res = $conn->query($sql);
        if ($res === false) {
            if (!empty($_GET['covai_ad_debug'])) {
                echo '<!-- covai_merge_affiliate_links_from_db: ' . htmlspecialchars($conn->error) . ' -->';
            }
            return;
        }

        while ($row = $res->fetch_assoc()) {
            $slot_raw = isset($row['slot_ids']) ? trim((string) $row['slot_ids']) : '';
            if ($slot_raw === '') {
                continue;
            }
            $slots = array_filter(array_map('trim', preg_split('/[\s,]+/', $slot_raw)));
            if ($slots === []) {
                continue;
            }

            $size_raw = isset($row['sizes']) ? trim((string) $row['sizes']) : '';
            if ($size_raw === '') {
                $size_raw = '728x90,336x280,300x250,320x50';
            }
            $sizes = array_filter(array_map('trim', preg_split('/[\s,]+/', $size_raw)));

            $url = isset($row['url']) ? trim((string) $row['url']) : '';
            if ($url === '' || !preg_match('#^https?://#i', $url)) {
                continue;
            }

            $w = isset($row['weight']) ? (int) $row['weight'] : 100;
            if ($w < 1) {
                $w = 1;
            }
            if ($w > 1000) {
                $w = 1000;
            }

            $type = isset($row['monetization_type']) ? strtolower((string) $row['monetization_type']) : 'affiliate';
            if ($type !== 'affiliate' && $type !== 'sponsor') {
                $type = 'affiliate';
            }

            $covai_ads[] = [
                'id'                 => 'db-' . (int) $row['id'],
                'advertiser'         => isset($row['advertiser']) ? (string) $row['advertiser'] : '',
                'monetization_type'  => $type,
                'url'                => $url,
                'slot_ids'           => $slots,
                'sizes'              => $sizes,
                'design'             => isset($row['design']) && trim((string) $row['design']) !== '' ? trim((string) $row['design']) : 'default',
                'headline'           => isset($row['headline']) ? (string) $row['headline'] : '',
                'tagline'            => isset($row['tagline']) ? (string) $row['tagline'] : '',
                'cta'                => isset($row['cta']) && trim((string) $row['cta']) !== '' ? trim((string) $row['cta']) : 'Learn more',
                'weight'             => $w,
                'active'             => true,
            ];
        }
        $res->free();
    }
}
