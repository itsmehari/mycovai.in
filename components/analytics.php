<?php
/**
 * Google Analytics – uses GA_MEASUREMENT_ID from config when set (Phase 2).
 * Include after core/omr-connect.php (or core/mycovai-config.php) to use MyCovai property.
 *
 * Do not add http:// third-party script tags here (mixed content on HTTPS).
 * If you see cdn.jsinit.directfwd.com in DevTools, it is not from this file — search the server
 * (cPanel File Manager, .user.ini, auto_prepend, GTM) and remove it.
 */
$ga_id = defined('GA_MEASUREMENT_ID') && GA_MEASUREMENT_ID !== '' ? GA_MEASUREMENT_ID : 'G-2FZCJC1JZH';
?>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo htmlspecialchars($ga_id); ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '<?php echo htmlspecialchars($ga_id); ?>');
</script>
<!-- End Google Analytics -->

<!-- Microsoft Clarity -->
<script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "vnpelcljv4");
</script>
<!-- End Microsoft Clarity -->
