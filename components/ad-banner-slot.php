<?php
/**
 * Banner ad slot component for mycovai.in
 * Renders a single ad slot (random pick from eligible ads) or a row of slots.
 *
 * Usage: omr_ad_slot('article-top', '728x90'); or omr_ad_slot_row('homepage-mid', 2);
 * @see core/ad-registry.php
 * @see assets/css/ad-banners.css
 */

if (!function_exists('_omr_ad_icon')) {
    /**
     * Font Awesome icon class per design key.
     *
     * @param string $design Design key from ad record
     * @return string Font Awesome class (e.g. 'fas fa-building')
     */
    function _omr_ad_icon($design) {
        $icons = [
            'mycovai'        => 'fas fa-map-marker-alt',
            'default'        => 'fas fa-bullhorn',
            'resumedoctor'   => 'fas fa-file-alt',
            'colourchemist'  => 'fas fa-palette',
            'bseri'          => 'fas fa-building',
        ];
        return isset($icons[$design]) ? $icons[$design] : 'fas fa-bullhorn';
    }
}

if (!function_exists('omr_ad_slot')) {
    /**
     * Output a single ad slot. Loads registry, filters by slot + size, picks one ad at random.
     *
     * @param string $slot_id Slot ID (e.g. 'article-top', 'homepage-mid')
     * @param string $size    IAB size (e.g. '728x90', '336x280', '300x250', '320x50')
     */
    function omr_ad_slot($slot_id, $size) {
        $registry_path = dirname(__DIR__) . '/core/ad-registry.php';
        if (!is_file($registry_path)) {
            if (!empty($_GET['omr_ad_debug'])) {
                echo '<!-- omr_ad_slot: registry not found at ' . htmlspecialchars($registry_path) . ' -->';
            }
            return;
        }
        require_once $registry_path;

        if (!isset($omr_ads) || !is_array($omr_ads)) {
            if (!empty($_GET['omr_ad_debug'])) {
                echo '<!-- omr_ad_slot: $omr_ads not defined or not array -->';
            }
            return;
        }

        $eligible = [];
        foreach ($omr_ads as $ad) {
            if (empty($ad['active'])) {
                continue;
            }
            if (!isset($ad['slot_ids']) || !in_array($slot_id, (array) $ad['slot_ids'], true)) {
                continue;
            }
            if (!isset($ad['sizes']) || !in_array($size, (array) $ad['sizes'], true)) {
                continue;
            }
            $eligible[] = $ad;
        }

        if (empty($eligible)) {
            if (!empty($_GET['omr_ad_debug'])) {
                echo '<!-- omr_ad_slot: no eligible ad for slot_id=' . htmlspecialchars($slot_id) . ' size=' . htmlspecialchars($size) . ' -->';
            }
            return;
        }

        $ad = $eligible[array_rand($eligible)];
        $url = isset($ad['url']) ? $ad['url'] : '#';
        $design = isset($ad['design']) ? $ad['design'] : 'default';
        $headline = isset($ad['headline']) ? $ad['headline'] : 'Ad';
        $tagline = isset($ad['tagline']) ? $ad['tagline'] : '';
        $icon = _omr_ad_icon($design);

        // Inject ad CSS once per page
        if (!defined('OMR_AD_BANNERS_CSS_LOADED')) {
            define('OMR_AD_BANNERS_CSS_LOADED', true);
            echo '<link rel="stylesheet" href="/assets/css/ad-banners.css">' . "\n";
        }
        ?>
        <div class="omr-ad-zone" aria-label="Sponsored content">
            <span class="omr-ad-slot__label">Ad</span>
            <div class="omr-ad-slot">
                <a class="omr-ad-banner omr-ad-banner--<?php echo htmlspecialchars($size); ?> omr-ad-banner--<?php echo htmlspecialchars($design); ?>" href="<?php echo htmlspecialchars($url); ?>" rel="sponsored noopener noreferrer" target="_blank">
                    <span class="omr-ad-banner__icon"><i class="<?php echo htmlspecialchars($icon); ?>" aria-hidden="true"></i></span>
                    <span class="omr-ad-banner__headline"><?php echo htmlspecialchars($headline); ?></span>
                    <?php if ($tagline !== ''): ?>
                        <span class="omr-ad-banner__tagline"><?php echo htmlspecialchars($tagline); ?></span>
                    <?php endif; ?>
                    <span class="omr-ad-banner__cta">Learn more</span>
                </a>
            </div>
        </div>
        <?php
    }
}

if (!function_exists('omr_ad_slot_row')) {
    /**
     * Output a row of ad slots (same slot_id, same size repeated).
     *
     * @param string $slot_id Slot ID
     * @param int    $count   Number of slots in the row (default 2)
     * @param string $size    IAB size (default '336x280')
     */
    function omr_ad_slot_row($slot_id, $count = 2, $size = '336x280') {
        $count = max(1, min(4, (int) $count));
        echo '<div class="omr-ad-zone omr-ad-zone--row">';
        for ($i = 0; $i < $count; $i++) {
            omr_ad_slot($slot_id, $size);
        }
        echo '</div>';
    }
}
