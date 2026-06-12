<?php
if (!defined('MYCOVAI_CONFIG_LOADED') && is_file(__DIR__ . '/../core/mycovai-config.php')) {
    require_once __DIR__ . '/../core/mycovai-config.php';
}
$links = [];
if (defined('SOCIAL_FACEBOOK') && SOCIAL_FACEBOOK !== '') {
    $links[] = ['url' => SOCIAL_FACEBOOK, 'icon' => 'https://cdn3.iconfinder.com/data/icons/social-media-2169/24/social_media_social_media_logo_facebook-128.png', 'label' => 'Facebook'];
}
if (defined('SOCIAL_INSTAGRAM') && SOCIAL_INSTAGRAM !== '') {
    $links[] = ['url' => SOCIAL_INSTAGRAM, 'icon' => 'https://cdn2.iconfinder.com/data/icons/social-media-applications/64/social_media_applications_3-instagram-128.png', 'label' => 'Instagram'];
}
if (defined('SOCIAL_WHATSAPP') && SOCIAL_WHATSAPP !== '') {
    $links[] = ['url' => SOCIAL_WHATSAPP, 'icon' => 'https://cdn2.iconfinder.com/data/icons/social-media-2285/512/1_Whatsapp2_colored_svg-512.png', 'label' => 'WhatsApp'];
}
if (defined('SOCIAL_YOUTUBE') && SOCIAL_YOUTUBE !== '') {
    $links[] = ['url' => SOCIAL_YOUTUBE, 'icon' => 'https://cdn1.iconfinder.com/data/icons/logotypes/32/youtube-128.png', 'label' => 'YouTube'];
}
if (empty($links)) {
    return;
}
?>
<div class="social-icons">
<?php foreach ($links as $link): ?>
  <a href="<?php echo htmlspecialchars($link['url']); ?>" class="fa" target="_blank" rel="noopener noreferrer" aria-label="<?php echo htmlspecialchars($link['label']); ?>">
    <img src="<?php echo htmlspecialchars($link['icon']); ?>" width="30" height="30" alt="">
  </a>
<?php endforeach; ?>
</div>
