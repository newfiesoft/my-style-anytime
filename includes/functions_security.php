<?php

/***
All functions based on the page #Security# configuration
 ***/

//// Remove meta generator content on the code side of the website
function mysat_remove_meta_generator(): void {

	$remove_meta_gen = get_option( 'mysat_remove_meta_generator', false );

	if ( $remove_meta_gen ) {
		remove_action('wp_head', 'wp_generator');
	}
}

add_action('init', 'mysat_remove_meta_generator');

