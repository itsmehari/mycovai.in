<?php
/**
 * Article page ad banner wrapper.
 * Max width 1024px, responsive. Rotates ads from existing covai_ad_slot system.
 *
 * Usage: require with $slot_id and $size set, or use defaults.
 * @see core/ad-registry.php
 * @see components/ad-banner-slot.php
 */

if (!isset($slot_id)) {
    $slot_id = 'article-top';
}
if (!isset($size)) {
    $size = '728x90';
}
// On mobile, use smaller leaderboard for better fit
$size_mobile = ($size === '728x90') ? '320x50' : $size;
?>
<div class="article-ad-wrapper">
    <div class="article-ad-wrapper__desktop">
        <?php covai_ad_slot($slot_id, $size); ?>
    </div>
    <div class="article-ad-wrapper__mobile">
        <?php covai_ad_slot($slot_id, $size_mobile); ?>
    </div>
</div>
