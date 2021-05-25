<?php

/**
 * ACF Google Maps API Key
 */

// NOTE: in version 5.4 we must apply this filter to load Google Maps
// using some Api Key. Google Maps will not load since user provides
// some key (it is required for every request).

function fv_gmaps_admin( $api ) {
	$api['key'] = GOOGLE_API_KEY;
	return $api;
}
// add_filter('acf/fields/google_map/api', 'fv_gmaps_admin');
