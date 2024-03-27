<?php

/***
All functions based on the page #Settings# configuration
 ***/

//// This function Disable Gutenberg style anywhere & Enable classic editor.
function mysat_disable_gutenberg(): void {

	$disable_gutenberg = get_option( 'mysat_disable_gutenberg' );

	if ( $disable_gutenberg ) {
		add_filter('use_block_editor_for_post', '__return_false' );
		add_filter('use_block_editor_for_post_type', '__return_false' );
		add_filter( 'use_widgets_block_editor', '__return_false' );
	}
}

add_action( 'init', 'mysat_disable_gutenberg' );