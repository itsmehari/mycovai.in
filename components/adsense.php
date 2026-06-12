<?php
/**
 * Central Google AdSense rendering for mycovai.in
 *
 * @see core/adsense-placement.php
 * @see core/mycovai-config.php ADSENSE_*
 */

require_once dirname(__DIR__) . '/core/adsense-placement.php';

if (!function_exists('_covai_adsense_page_unit_count')) {
    function &_covai_adsense_page_unit_count() {
        static $count = 0;
        return $count;
    }
}

if (!function_exists('covai_adsense_units_rendered')) {
    function covai_adsense_units_rendered() {
        return _covai_adsense_page_unit_count();
    }
}

if (!function_exists('covai_adsense_load_script_once')) {
    function covai_adsense_load_script_once() {
        if (!covai_adsense_allowed()) {
            return;
        }
        if (defined('COVAI_ADSENSE_SCRIPT_LOADED')) {
            return;
        }
        define('COVAI_ADSENSE_SCRIPT_LOADED', true);
        $client = htmlspecialchars(ADSENSE_CLIENT_ID, ENT_QUOTES, 'UTF-8');
        echo '<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client='
            . $client . '" crossorigin="anonymous"></script>' . "\n";
    }
}

if (!function_exists('covai_adsense_size_styles')) {
    /**
     * @return array{minHeight:string,format:string}
     */
    function covai_adsense_size_styles($size) {
        $map = [
            '728x90'  => ['minHeight' => '90px', 'format' => 'horizontal'],
            '336x280' => ['minHeight' => '280px', 'format' => 'rectangle'],
            '300x250' => ['minHeight' => '250px', 'format' => 'rectangle'],
            '320x50'  => ['minHeight' => '50px', 'format' => 'horizontal'],
        ];
        return $map[$size] ?? ['minHeight' => '250px', 'format' => 'auto'];
    }
}

if (!function_exists('covai_adsense_unit')) {
    /**
     * Render one AdSense unit for a registry slot ID.
     *
     * @param string $slot_id Site slot (e.g. article-mid)
     * @param string $size    IAB size hint for layout reservation
     */
    function covai_adsense_unit($slot_id, $size = '336x280') {
        if (!covai_adsense_allowed(['slot_id' => $slot_id])) {
            return false;
        }

        $max = defined('ADSENSE_MAX_UNITS_PER_PAGE') ? (int) ADSENSE_MAX_UNITS_PER_PAGE : 3;
        if (covai_adsense_units_rendered() >= $max) {
            return false;
        }

        if (!defined('ADSENSE_SLOT_UNITS') || !is_array(ADSENSE_SLOT_UNITS)) {
            return false;
        }
        $ad_slot = isset(ADSENSE_SLOT_UNITS[$slot_id]) ? trim((string) ADSENSE_SLOT_UNITS[$slot_id]) : '';
        if ($ad_slot === '') {
            return false;
        }

        $unit_count = &_covai_adsense_page_unit_count();
        $unit_count++;
        covai_adsense_load_script_once();

        if (!defined('COVAI_AD_BANNERS_CSS_LOADED')) {
            define('COVAI_AD_BANNERS_CSS_LOADED', true);
            echo '<link rel="stylesheet" href="/assets/css/ad-banners.css">' . "\n";
        }

        $styles = covai_adsense_size_styles($size);
        $client = htmlspecialchars(ADSENSE_CLIENT_ID, ENT_QUOTES, 'UTF-8');
        $unit = htmlspecialchars($ad_slot, ENT_QUOTES, 'UTF-8');
        $slot_attr = htmlspecialchars($slot_id, ENT_QUOTES, 'UTF-8');
        ?>
        <div class="covai-adsense-zone" data-slot="<?php echo $slot_attr; ?>" style="min-height:<?php echo $styles['minHeight']; ?>">
            <span class="covai-adsense-zone__label">Advertisement</span>
            <ins class="adsbygoogle covai-adsense-unit"
                 style="display:block"
                 data-ad-client="<?php echo $client; ?>"
                 data-ad-slot="<?php echo $unit; ?>"
                 data-ad-format="<?php echo htmlspecialchars($styles['format'], ENT_QUOTES, 'UTF-8'); ?>"
                 data-full-width-responsive="true"></ins>
        </div>
        <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
        <?php
        return true;
    }
}
