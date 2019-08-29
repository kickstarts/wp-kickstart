<?php

/**
 * Enjoy
 */
function pxperfect($screen = 'bootstrap-grid', $opacity = 0.25) {
  $return = '';

  $return .= '
    <style>
    .overlay {
      background: #FFF url('.WP_IMAGE_URL.'/overlays/'.$screen.'.png);
      background-size: cover;
      height: 100vh;
      width: 1366px;
      margin: 0;
      padding: 0;
      opacity: '.$opacity.';
      z-index: 999;
      position: absolute;
      top: 0;
      left: 50%;
      transform: translate(-50%, 0);
      margin-left:                    
    }
    </style>
  ';

  return $return;
}
