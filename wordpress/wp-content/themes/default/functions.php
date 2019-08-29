<?php

/**
 * Initialize all the things.
 */

@ini_set( 'upload_max_size' , '8M' );
@ini_set( 'post_max_size', '8M');
@ini_set( 'max_execution_time', '300' ); // 5 minutes
@ini_set( 'memory_limit', '100M' );

// ini_set('php_value max_input_vars', 3000); // 3000 vars
ini_set('display_errors', 'On');

header("Content-Type: text/html; charset=UTF-8");

require get_template_directory() . '/core/config.php';
require get_template_directory() . '/core/init.php';
