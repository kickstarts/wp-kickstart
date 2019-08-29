<?php
/**
 * Debug variables.
 *
 * @param mixed $variable Object or Array for debug.
 *
 * @return string Human-readable information.
 */
function sc_debug( $variable ) {
	echo '<pre>' . print_r( $variable, true ) . '</pre>';
	exit;
}