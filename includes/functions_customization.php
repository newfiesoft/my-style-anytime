<?php
//includes/functions_customization.php

/***
All functions based on the page #Customization# configuration
 ***/

//// Custom login stylesheet
function mysat_custom_login_stylesheet(): void {

	// Ensure plugin data retrieval is possible
	if ( ! function_exists( 'get_plugin_data' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}

	// Get plugin dir URL
	$plugin_dir_url = plugin_dir_url( __DIR__ );

	// Get plugin data
	$plugin_plugin_data = get_plugin_data( plugin_dir_path( __DIR__ ) . 'my-style-anytime.php' );

	// Retrieve custom settings
	$custom_bg_color     = get_option( 'mysat_custom_bg_color', '#ffffff' );
	$custom_bg_image     = get_option( 'mysat_custom_login_bg_image', '' );
	$custom_logo         = get_option( 'mysat_custom_login_logo', '' );

	// Only enqueue styles if at least one setting is provided
	if ( ! empty( $custom_bg_color ) || ! empty( $custom_bg_image ) || ! empty( $custom_logo ) ) {

		// Enqueue the custom CSS file
		wp_enqueue_style( 'mysat-visitor-styles', $plugin_dir_url . 'assets/css/style-login.css', array(), esc_html( $plugin_plugin_data['Version'] ) );

		// Add custom background color via inline styles
		if ( ! empty( $custom_bg_color ) ) {
			$inline_css = "body.login { background-color: $custom_bg_color; }";
			wp_add_inline_style( 'mysat-visitor-styles', $inline_css );
		}

		// Add custom background image via inline styles
		if ( ! empty( $custom_bg_image ) ) {
			$bg_image_css = "
                body.login {
                    background-image: url('$custom_bg_image');
                    background-size: cover;
                    background-repeat: no-repeat;
                    background-position: center center;
                }
            ";
			wp_add_inline_style( 'mysat-visitor-styles', $bg_image_css );
		}

		// Replace the login logo if a custom logo URL is set
		if ( ! empty( $custom_logo ) ) {
			$logo_css = "
                #login h1 a {
                    background-image: url('$custom_logo');
                    background-size: contain;
                    width: 100%;
                    height: 80px;
                }
            ";
			wp_add_inline_style( 'mysat-visitor-styles', $logo_css );
		}
	}
}

add_action( 'login_enqueue_scripts', 'mysat_custom_login_stylesheet' );


//// Custom login url filter
function mysat_custom_login_url_filter(): string {
	$url = get_option( 'mysat_custom_login_url', '' );
	// If no custom URL set, fallback to home_url()
	if ( $url ) {
		return $url;
	}

	return home_url();
}

add_filter( 'login_headerurl', 'mysat_custom_login_url_filter' );


//// Custom login title filter
function mysat_custom_login_title_filter(): string {
	$title = get_option( 'mysat_custom_login_title', '' );
	// If no custom title set, fallback to the default WordPress title.
	if ( $title ) {
		return $title;
	}

	return get_bloginfo( 'name' );
}

add_filter( 'login_headertext', 'mysat_custom_login_title_filter' );

