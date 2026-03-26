<?php
/**
 * Banner ad slot component for mycovai.in
 * Renders a single ad slot (random pick from eligible ads) or a row of slots.
 *
 * Usage: covai_ad_slot('article-top', '728x90'); or covai_ad_slot_row('homepage-mid', 2);
 * @see core/ad-registry.php
 * @see assets/css/ad-banners.css
 */

if (!function_exists('_covai_ad_icon')) {
    /**
     * Font Awesome icon class per design key.
     *
     * @param string $design Design key from ad record
     * @return string Font Awesome class (e.g. 'fas fa-building')
     */
    function _covai_ad_icon($design) {
        $icons = [
            'mycovai'        => 'fas fa-map-marker-alt',
            'default'        => 'fas fa-bullhorn',
            'resumedoctor'   => 'fas fa-file-alt',
            'colourchemist'  => 'fas fa-palette',
            'bseri'          => 'fas fa-building',
            'edmasters'      => 'fas fa-graduation-cap',
            'myomr'          => 'fas fa-list-ul',
            'akshayam'       => 'fas fa-umbrella-beach',
            'amazon'         => 'fab fa-amazon',
        ];
        return isset($icons[$design]) ? $icons[$design] : 'fas fa-bullhorn';
    }
}

if (!function_exists('_covai_ad_meta')) {
    /**
     * Resolve display metadata by monetization type.
     *
     * @param array $ad Ad record
     * @return array{zone_label:string,aria_label:string,rel:string,cta:string,disclosure:string}
     */
    function _covai_ad_meta($ad) {
        $type = isset($ad['monetization_type']) ? strtolower((string) $ad['monetization_type']) : 'sponsor';
        $zone_label = ($type === 'affiliate') ? 'Affiliate' : 'Ad';
        $aria_label = ($type === 'affiliate') ? 'Affiliate content' : 'Sponsored content';
        $rel = isset($ad['rel']) ? (string) $ad['rel'] : 'sponsored noopener noreferrer';
        $cta = isset($ad['cta']) ? (string) $ad['cta'] : 'Learn more';
        $disclosure = '';

        if ($type === 'affiliate') {
            $disclosure = defined('AMAZON_ASSOCIATE_DISCLOSURE_TEXT')
                ? AMAZON_ASSOCIATE_DISCLOSURE_TEXT
                : 'As an Amazon Associate, I earn from qualifying purchases.';
        }

        return [
            'zone_label' => $zone_label,
            'aria_label' => $aria_label,
            'rel' => $rel,
            'cta' => $cta,
            'disclosure' => $disclosure,
        ];
    }
}

if (!function_exists('_covai_weighted_random_pick')) {
    /**
     * Weighted random pick; default weight 100 when omitted.
     *
     * @param array<int,array<string,mixed>> $items
     * @return array<string,mixed>|null
     */
    function _covai_weighted_random_pick(array $items) {
        if ($items === []) {
            return null;
        }
        $total = 0;
        foreach ($items as $it) {
            $w = isset($it['weight']) ? (int) $it['weight'] : 100;
            if ($w < 1) {
                $w = 1;
            }
            if ($w > 1000) {
                $w = 1000;
            }
            $total += $w;
        }
        $r = mt_rand(1, $total);
        $c = 0;
        foreach ($items as $it) {
            $w = isset($it['weight']) ? (int) $it['weight'] : 100;
            if ($w < 1) {
                $w = 1;
            }
            if ($w > 1000) {
                $w = 1000;
            }
            $c += $w;
            if ($r <= $c) {
                return $it;
            }
        }
        return $items[array_key_last($items)];
    }
}

if (!function_exists('covai_ad_slot')) {
    /**
     * Output a single ad slot. Loads registry, filters by slot + size, picks one ad at random.
     *
     * @param string $slot_id Slot ID (e.g. 'article-top', 'homepage-mid')
     * @param string $size    IAB size (e.g. '728x90', '336x280', '300x250', '320x50')
     */
    function covai_ad_slot($slot_id, $size) {
        $registry_path = dirname(__DIR__) . '/core/ad-registry.php';
        if (!is_file($registry_path)) {
            if (!empty($_GET['covai_ad_debug'])) {
                echo '<!-- covai_ad_slot: registry not found at ' . htmlspecialchars($registry_path) . ' -->';
            }
            return;
        }
        require_once $registry_path;

        if (!isset($covai_ads) || !is_array($covai_ads)) {
            if (!empty($_GET['covai_ad_debug'])) {
                echo '<!-- covai_ad_slot: $covai_ads not defined or not array -->';
            }
            return;
        }

        $eligible = [];
        foreach ($covai_ads as $ad) {
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
            if (!empty($_GET['covai_ad_debug'])) {
                echo '<!-- covai_ad_slot: no eligible ad for slot_id=' . htmlspecialchars($slot_id) . ' size=' . htmlspecialchars($size) . ' -->';
            }
            return;
        }

        $ad = _covai_weighted_random_pick($eligible);
        $url = isset($ad['url']) ? $ad['url'] : '#';
        $design = isset($ad['design']) ? $ad['design'] : 'default';
        $headline = isset($ad['headline']) ? $ad['headline'] : 'Ad';
        $tagline = isset($ad['tagline']) ? $ad['tagline'] : '';
        $icon = _covai_ad_icon($design);
        $image_url = isset($ad['image_url']) ? trim($ad['image_url']) : '';
        $meta = _covai_ad_meta($ad);

        // Inject ad CSS once per page
        if (!defined('COVAI_AD_BANNERS_CSS_LOADED')) {
            define('COVAI_AD_BANNERS_CSS_LOADED', true);
            echo '<link rel="stylesheet" href="/assets/css/ad-banners.css">' . "\n";
        }
        ?>
        <div class="covai-ad-zone" aria-label="<?php echo htmlspecialchars($meta['aria_label']); ?>">
            <span class="covai-ad-slot__label"><?php echo htmlspecialchars($meta['zone_label']); ?></span>
            <div class="covai-ad-slot">
                <a class="covai-ad-banner covai-ad-banner--<?php echo htmlspecialchars($size); ?> covai-ad-banner--<?php echo htmlspecialchars($design); ?><?php echo $image_url !== '' ? ' covai-ad-banner--has-image' : ''; ?>" href="<?php echo htmlspecialchars($url); ?>" rel="<?php echo htmlspecialchars($meta['rel']); ?>" target="_blank">
                    <?php if ($image_url !== ''): ?>
                        <span class="covai-ad-banner__image"><img src="<?php echo htmlspecialchars($image_url); ?>" alt="" loading="lazy" width="320" height="120"></span>
                    <?php endif; ?>
                    <span class="covai-ad-banner__icon"><i class="<?php echo htmlspecialchars($icon); ?>" aria-hidden="true"></i></span>
                    <span class="covai-ad-banner__headline"><?php echo htmlspecialchars($headline); ?></span>
                    <?php if ($tagline !== ''): ?>
                        <span class="covai-ad-banner__tagline"><?php echo htmlspecialchars($tagline); ?></span>
                    <?php endif; ?>
                    <span class="covai-ad-banner__cta"><?php echo htmlspecialchars($meta['cta']); ?></span>
                </a>
            </div>
            <?php if ($meta['disclosure'] !== ''): ?>
                <p class="covai-ad-slot__disclosure"><?php echo htmlspecialchars($meta['disclosure']); ?></p>
            <?php endif; ?>
        </div>
        <?php
    }
}

if (!function_exists('covai_ad_slot_row')) {
    /**
     * Output a row of ad slots (same slot_id, same size repeated).
     *
     * @param string $slot_id Slot ID
     * @param int    $count   Number of slots in the row (default 2)
     * @param string $size    IAB size (default '336x280')
     */
    function covai_ad_slot_row($slot_id, $count = 2, $size = '336x280') {
        $count = max(1, min(4, (int) $count));
        echo '<div class="covai-ad-zone covai-ad-zone--row">';
        for ($i = 0; $i < $count; $i++) {
            covai_ad_slot($slot_id, $size);
        }
        echo '</div>';
    }
}

if (!function_exists('covai_ad_banner_row')) {
    /**
     * Output a row of distinct ads (one banner per advertiser, no random duplicate).
     *
     * @param string $slot_id Slot ID (e.g. 'homepage-top')
     * @param string $size    Size key (e.g. 'card-row')
     * @param int    $max     Max number of ads to show (default 5)
     */
    function covai_ad_banner_row($slot_id, $size = 'card-row', $max = 5) {
        $registry_path = dirname(__DIR__) . '/core/ad-registry.php';
        if (!is_file($registry_path)) {
            if (!empty($_GET['covai_ad_debug'])) {
                echo '<!-- covai_ad_banner_row: registry not found -->';
            }
            return;
        }
        require_once $registry_path;

        if (!isset($covai_ads) || !is_array($covai_ads)) {
            if (!empty($_GET['covai_ad_debug'])) {
                echo '<!-- covai_ad_banner_row: $covai_ads not defined or not array -->';
            }
            return;
        }

        $eligible = [];
        foreach ($covai_ads as $ad) {
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
            if (!empty($_GET['covai_ad_debug'])) {
                echo '<!-- covai_ad_banner_row: no eligible ads for slot_id=' . htmlspecialchars($slot_id) . ' size=' . htmlspecialchars($size) . ' -->';
            }
            return;
        }

        // Prioritize higher-weight campaigns in row layouts (homepage-top card-row),
        // so DB-managed affiliate rows can outrank low-priority defaults.
        usort($eligible, function ($a, $b) {
            $wa = isset($a['weight']) ? (int) $a['weight'] : 100;
            $wb = isset($b['weight']) ? (int) $b['weight'] : 100;
            if ($wa === $wb) {
                return 0;
            }
            return ($wa > $wb) ? -1 : 1;
        });

        $max = max(1, min(10, (int) $max));
        $selected = array_slice($eligible, 0, $max);
        $has_affiliate = false;
        foreach ($selected as $selected_ad) {
            if (isset($selected_ad['monetization_type']) && strtolower((string) $selected_ad['monetization_type']) === 'affiliate') {
                $has_affiliate = true;
                break;
            }
        }
        $row_label = $has_affiliate ? 'Affiliate' : 'Sponsored';
        $row_disclosure = '';
        if ($has_affiliate) {
            $row_disclosure = defined('AMAZON_ASSOCIATE_DISCLOSURE_TEXT')
                ? AMAZON_ASSOCIATE_DISCLOSURE_TEXT
                : 'As an Amazon Associate, I earn from qualifying purchases.';
        }

        if (!defined('COVAI_AD_BANNERS_CSS_LOADED')) {
            define('COVAI_AD_BANNERS_CSS_LOADED', true);
            echo '<link rel="stylesheet" href="/assets/css/ad-banners.css">' . "\n";
        }
        ?>
        <div class="covai-ad-zone covai-ad-zone--row" aria-label="<?php echo $has_affiliate ? 'Affiliate content' : 'Sponsored content'; ?>">
            <span class="covai-ad-slot__label"><?php echo htmlspecialchars($row_label); ?></span>
            <?php foreach ($selected as $ad): ?>
                <?php
                $url = isset($ad['url']) ? $ad['url'] : '#';
                $design = isset($ad['design']) ? $ad['design'] : 'default';
                $headline = isset($ad['headline']) ? $ad['headline'] : 'Ad';
                $tagline = isset($ad['tagline']) ? $ad['tagline'] : '';
                $icon = _covai_ad_icon($design);
                $image_url = isset($ad['image_url']) ? trim($ad['image_url']) : '';
                $meta = _covai_ad_meta($ad);
                ?>
                <div class="covai-ad-slot">
                    <a class="covai-ad-banner covai-ad-banner--<?php echo htmlspecialchars($size); ?> covai-ad-banner--<?php echo htmlspecialchars($design); ?><?php echo $image_url !== '' ? ' covai-ad-banner--has-image' : ''; ?>" href="<?php echo htmlspecialchars($url); ?>" rel="<?php echo htmlspecialchars($meta['rel']); ?>" target="_blank">
                        <?php if ($image_url !== ''): ?>
                            <span class="covai-ad-banner__image"><img src="<?php echo htmlspecialchars($image_url); ?>" alt="" loading="lazy" width="320" height="120"></span>
                        <?php endif; ?>
                        <span class="covai-ad-banner__icon"><i class="<?php echo htmlspecialchars($icon); ?>" aria-hidden="true"></i></span>
                        <span class="covai-ad-banner__headline"><?php echo htmlspecialchars($headline); ?></span>
                        <?php if ($tagline !== ''): ?>
                            <span class="covai-ad-banner__tagline"><?php echo htmlspecialchars($tagline); ?></span>
                        <?php endif; ?>
                        <span class="covai-ad-banner__cta"><?php echo htmlspecialchars($meta['cta']); ?></span>
                    </a>
                </div>
            <?php endforeach; ?>
            <?php if ($row_disclosure !== ''): ?>
                <p class="covai-ad-slot__disclosure covai-ad-slot__disclosure--row"><?php echo htmlspecialchars($row_disclosure); ?></p>
            <?php endif; ?>
        </div>
        <?php
    }
}
