<?php
/**
 * Google Functions and definitions
 *
 * @package Festival de Verão
 */

 /*
  * Google Analytics.
  */
function fv_google_analytics() { ?>
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?=GOOGLE_ANALYTICS_UA?>"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '<?=GOOGLE_ANALYTICS_UA?>');
  </script> <?php
}
add_action('wp_head', 'fv_google_analytics');
