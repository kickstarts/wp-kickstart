<?php

/**
 * Excerpt Limit
 */
function fv_excerpt_limit( $type = 'excerpt', $limit = 40 ) {
	$limit = (int) $limit;

	switch ( $type ) {
		case 'title':
			$excerpt = get_the_title();
			break;

		default :
			$excerpt = get_the_excerpt();
			break;
	}

	return wp_trim_words( $excerpt, $limit );
}
