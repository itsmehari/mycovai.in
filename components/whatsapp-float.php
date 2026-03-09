<?php
/**
 * WhatsApp floating button – MyCovai terracotta theme
 */
$wa_url = defined('SOCIAL_WHATSAPP') && SOCIAL_WHATSAPP !== '' ? SOCIAL_WHATSAPP : 'https://wa.me/919445088028';
?>
<a href="<?php echo htmlspecialchars($wa_url); ?>" class="whatsapp-float" target="_blank" rel="noopener" aria-label="Chat with MyCovai on WhatsApp">
    <i class="fab fa-whatsapp fa-lg"></i>
</a>
<style>
.whatsapp-float { position: fixed; bottom: 1.5rem; right: 1.5rem; width: 56px; height: 56px; display: flex; align-items: center; justify-content: center; background: var(--mycovai-primary, #B8522E); color: #fff !important; border-radius: 50%; box-shadow: 0 4px 16px rgba(184,82,46,0.35); z-index: 1000; transition: background 0.2s, transform 0.2s, box-shadow 0.2s; }
.whatsapp-float:hover { background: var(--mycovai-primary-dark, #8B3D24); color: #fff; transform: scale(1.08); box-shadow: 0 6px 20px rgba(184,82,46,0.4); }
</style>
