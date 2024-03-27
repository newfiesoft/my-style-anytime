<?php

/**
Plugin Name: My Style Anytime
Plugin URI: https://newfiesoft.com/wp-plugins/my-style-anytime/

Description: Customize public frontend or admin backend wp-admin with responsive using the same CSS stylesheets file based on user roles type

Version: 1.5.0
Author: NewfieSoft
Author URI: https://www.newfiesoft.com
Donate link: https://newfiesoft.com/donate

Text Domain: my-style-anytime
Domain Path: /languages

License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


defined('ABSPATH') or exit();

if ( ! function_exists( 'is_plugin_active' ) ) {
require_once ABSPATH . 'wp-admin/includes/plugin.php';
}


//// Get plugin dirname basename how can just call this short in all current and future functions
if (!function_exists('my_style_anytime_directory_name')) {
function my_style_anytime_directory_name(): string {
	return dirname(plugin_basename(__FILE__));
	}
}

$plugin_dirname = my_style_anytime_directory_name();
//echo $plugin_dirname . "\n"; //==> result is my-style-anytime


//// Get plugin basename how can just call this short in all current and future functions
if (!function_exists('my_style_anytime_directory')) {
function my_style_anytime_directory(): string {
	return plugin_basename(__FILE__);
	}
}

$plugin_basename = my_style_anytime_directory();
//echo $plugin_basename . "\n"; //==> result is my-style-anytime/my-style-anytime.php


//// Get plugin dir name how can just call this short in all current and future functions
if (!function_exists('my_style_anytime_plugin_dir_path')) {
function my_style_anytime_plugin_dir_path(): string {
	return plugin_dir_path( __FILE__ );
	}
}

$plugin_dir_path = my_style_anytime_plugin_dir_path();
//echo $plugin_dir_path . "\n"; //==> /home/username/public_html/wp-content/plugins/my-style-anytime/


//// Get plugin dir url name how can just call this short in all current and future functions
if (!function_exists('my_style_anytime_directory_url')) {
function my_style_anytime_directory_url(): string {
	return plugin_dir_url(__FILE__);
	}
}

$plugin_dir_url = my_style_anytime_directory_url();
//echo $plugin_dir_url . "\n"; //==> result is https://newfiesoft.com/wp-content/plugins/my-style-anytime/


//// Get plugin data how can just call this short in all current and future functions
if (!function_exists('my_style_anytime_plugin_data')) {
function my_style_anytime_plugin_data(): array {

	$plugin_main_file = my_style_anytime_plugin_dir_path() . 'my-style-anytime.php';

	return get_plugin_data($plugin_main_file);
	}
}

$plugin_plugin_data = my_style_anytime_plugin_data();
//var_dump($plugin_plugin_data); //==> sho plugin informations like Name, PluginURI, Version and many more


/////////////////////////////////////////////////////////////////////////////////////////////////////////


//// Load plugin Text Domain for multi-language support
function mmysat_plugin_load_text_domain(): void {

// Get plugin dirname basename
$plugin_dirname = my_style_anytime_directory_name();

// Load the plugin text domain
load_plugin_textdomain('my-style-anytime', false, $plugin_dirname . '/languages');
}

add_action('plugins_loaded', 'mmysat_plugin_load_text_domain');


//// This configures menu name and sub names.
function mysat_active_admin_menu(): void {

add_menu_page(
	'General',
	__('My Style Anytime', 'my-style-anytime'), // Menu Title;
	'activate_plugins',
	'my-style-anytime', // ID
	'mysat_render_general_page',
	'my-style-anytime', // Make sure this icon slug matches your custom icon's registration.
	999
);

add_submenu_page( // General button
	'my-style-anytime', // ID
	'General',
	__('General', 'my-style-anytime'), // Menu Title;
	'activate_plugins',
	'my-style-anytime', // Your menu URL slug
	'mysat_render_general_page' // echo function
);

add_submenu_page( // Manage Style button
	'my-style-anytime', // ID
	'Manage',
	__('Manage Style', 'my-style-anytime'), // Menu Title;
	'activate_plugins',
	'mysat_editor_page', // Your menu URL slug
	'mysat_render_editor_page' // callback function
);

add_submenu_page( // Customization button
	'my-style-anytime', // ID
	'Custom',
	__('Customization', 'my-style-anytime'), // Menu Title;
	'activate_plugins',
	'mysat_custom_page', // Your menu URL slug
	'mysat_render_custom_page' // callback function
);

add_submenu_page( // Security button
	'my-style-anytime', // ID
	'Security',
	__('Security', 'my-style-anytime'), // Menu Title;
	'activate_plugins',
	'mysat_security_page', // Your menu URL slug
	'mysat_render_security_page' // callback function
);

add_submenu_page( // Settings button
	'my-style-anytime', // ID
	'Settings',
	__('Settings', 'my-style-anytime'), // Menu Title;
	'activate_plugins',
	'mysat_settings_page', // Your menu URL slug
	'mysat_render_settings_page' // callback function
);

add_submenu_page( // BackUp button
	'my-style-anytime', // ID
	'Backup',
	__('Backup', 'my-style-anytime'), // Menu Title;
	'activate_plugins',
	'mysat_backup_page', // Your menu URL slug
	'mysat_render_backup_page' // callback function
);

}

add_action('admin_menu', 'mysat_active_admin_menu', 999);


// Load functions on both admin and front-end
$common_function_files = glob($plugin_dir_path . "includes/functions_*.php");
	foreach ($common_function_files as $file) {
	if (is_file($file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
		require_once $file;
	}
}

// Load functions for the back side that displays inside the admin panels. Example /wp-admin/
if (is_admin()) {
	// Load admin-specific functions
	$admin_function_files = glob($plugin_dir_path . "includes/back/back_*.php");
	foreach ($admin_function_files as $file) {
		if (is_file($file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
			require_once $file;
		}
	}

// Load plugin pages for the admin
	$allowed_page_back_files = glob($plugin_dir_path . "pages/*.php");
	foreach ($allowed_page_back_files as $file) {
		if (is_file($file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
			require_once $file;
		}
	}
}

// Load functions for front-side displays outside the admin panels. Example domain.com/
else {
	$front_function_files = glob($plugin_dir_path . "includes/front/front_*.php");
	foreach ($front_function_files as $file) {
		if (is_file($file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
			require_once $file;
		}
	}
}


//// This help to create additional button after Plugin it is activated Installed Plugins list
function mysat_custom_link_options_plugin( $actions ): array {

	// Build URL Links
	$support_url = esc_url( add_query_arg( 'page', 'my-style-anytime', get_admin_url() . 'admin.php' ) );

	// Links name
	$support_name = __( 'General', 'my-style-anytime' );

	// Create buttons
	$settings_url = '<a href="' . $support_url . '">' . $support_name . '</a>';

	// Organize buttons
	return array_merge(
		(array) $settings_url,
		$actions,
	);
}

add_filter( 'plugin_action_links_' . $plugin_basename, 'mysat_custom_link_options_plugin', 10, 2 );


//// This help to create additional custom meta links in the sequel after Version By .... Installed Plugins list
function mysat_custom_link_action_plugin( $links_array, $mysat_plugin_name ) {

	// Get plugin basename
	$plugin_basename = my_style_anytime_directory();

	if ( $mysat_plugin_name === $plugin_basename ) {

		// Build URL Links
		$support_url = 'https://wordpress.org/support/plugin/my-style-anytime/';
		$faq_url     = 'https://wordpress.org/plugins/my-style-anytime/#faq';
		$rating_url  = 'https://wordpress.org/support/plugin/my-style-anytime/reviews/#new-post';

		// Links name
		$support_name = __( 'Community Support', 'my-style-anytime' );
		$faq_name     = __( 'FAQ', 'my-style-anytime' );
		$rating_name  = __( 'Ratings', 'my-style-anytime' );

		// Create buttons
		$links_array[] = '<a href="' . $support_url . '" class="help-style" target="_blank">' . $support_name . '</a>';
		$links_array[] = '<a href="' . $faq_url . '" class="help-style" target="_blank">' . $faq_name . '</a>';
		$links_array[] = '<a href="' . $rating_url . '" class="help-style" target="_blank">' . $rating_name . '</a>';

	}

	return $links_array;

}

add_filter( 'plugin_row_meta', 'mysat_custom_link_action_plugin', 10, 4 );


//// Create custom footer only inside plugin pages
function mysat_customize_admin_footer_script(): void {

	// Get plugin dir url name
	$plugin_dir_url = my_style_anytime_directory_url();

	// Get plugin data
	$plugin_plugin_data = my_style_anytime_plugin_data();

	// Get My plugin version
	if ( ! function_exists( 'get_plugin_data' ) ) {
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	}

	$plugin_data = $plugin_plugin_data;

	// Check if we are on one of your plugin's pages
	$current_page = isset($_GET['page']) ? sanitize_text_field($_GET['page']) : '';

	// Verify nonce if it exists and is not empty
	if (!empty($_REQUEST['_wpnonce'])) {
		$nonce = sanitize_text_field(wp_unslash($_REQUEST['_wpnonce']));

		// Verify the nonce
		wp_verify_nonce($nonce, 'mysat_nonce_action');
	}

	// Add page URL slug from any page what have
	$allowed_pages = array(
		'my-style-anytime',
		'mysat_editor_page',
		'mysat_custom_page',
		'mysat_security_page',
		'mysat_settings_page',
		'mysat_backup_page',
	);

	if ( in_array( $current_page, $allowed_pages ) ) {
		echo '<script type="text/javascript">';
		echo 'document.addEventListener("DOMContentLoaded", function() {';

		// Modify content inside "footer-thankyou" // Content Left //
		echo '   var footerThankYou = document.getElementById("footer-thankyou");';
		echo '   if (footerThankYou) {';
		echo '       footerThankYou.innerHTML = "<div class=\'power-by-info\'>' .
		     esc_html__( 'Premium Tools for WordPress made by', 'my-style-anytime' ) .
		     ' <a href=\'https://www.newfiesoft.com\' target=\'_blank\'>NewfieSoft</a> ' .
		     esc_html__( 'with', 'my-style-anytime' ) .
		     ' <i class=\"fa-solid fa-heart\"></i> ' . // FontAwesome heart icon
		     esc_html__( 'in Zürich, Switzerland', 'my-style-anytime' ) . '</div>";';
		echo '   }';

		// Remove content inside "footer-upgrade" // Content Right //
		echo '   var footerUpgrade = document.getElementById("footer-upgrade");';
		echo '   if (footerUpgrade) {';
		echo 'footerUpgrade.innerHTML = "<div class=\'version\'>' . esc_html__( 'Version', 'my-style-anytime' ) . ': ' . esc_html( $plugin_data['Version'] ) . '</div>";';
		echo '   }';

		echo '});';
		echo '</script>';
	}
}

add_action( 'admin_footer', 'mysat_customize_admin_footer_script' );