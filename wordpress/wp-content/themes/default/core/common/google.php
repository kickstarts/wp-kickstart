<?php
/**
 * Google Functions and definitions
 *
 * @package Wordpress Kickstart
 */

 /*
  * Google Analytics.
  */
function wp_kickstart_google_analytics() { ?>
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?=GOOGLE_ANALYTICS_UA?>"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '<?=GOOGLE_ANALYTICS_UA?>');
  </script> <?php
}
add_action('wp_head', 'wp_kickstart_google_analytics');
