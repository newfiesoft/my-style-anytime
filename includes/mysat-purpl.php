<?php

/****
 * =
 * # Create custom CSS Rules view for FrontEnd & BackEnd Wp-admin
 * =
 ****/

/* ############### Plugins Wordpress Users type roles ############### */


/*
Name: WooCommerce
URL: https://wordpress.org/plugins/woocommerce/
*/

///// WooCommerce Shop Manager CSS view Rules

function mysat_get_woocommerce_shop_manager_back(): void {

	// Get plugin dir url name
	$plugin_dir_url = get_my_style_anytime_directory_url();

	$roles = array('shop_manager');

	foreach ($roles as $role) {

		if (in_array($role, wp_get_current_user()->roles, true)) {

			wp_enqueue_style('woo-shop-manager-styles', $plugin_dir_url . 'styles/woo-shop-manager-style.css');

		}
	}
}
add_action('admin_enqueue_scripts', 'mysat_get_woocommerce_shop_manager_back');

////

function mysat_get_woocommerce_shop_manager_front(): void {

	// Get plugin dir url name
	$plugin_dir_url = get_my_style_anytime_directory_url();

	$roles = array('shop_manager');

	foreach ($roles as $role) {

		if (in_array($role, wp_get_current_user()->roles, true)) {

			wp_enqueue_style('woo-shop-manager-styles', $plugin_dir_url . 'styles/woo-shop-manager-style.css');

		}
	}
}
add_action('wp_enqueue_scripts', 'mysat_get_woocommerce_shop_manager_front');

////////////////////////////////////////////////////////////////////////////////////////


///// WooCommerce Customer CSS view Rules

function mysat_get_woocommerce_customer_back(): void {

	// Get plugin dir url name
	$plugin_dir_url = get_my_style_anytime_directory_url();

	$roles = array('customer');

	foreach ($roles as $role) {

		if (in_array($role, wp_get_current_user()->roles, true)) {

			wp_enqueue_style('woo-customer-styles', $plugin_dir_url . 'styles/woo-customer-style.css');

		}
	}
}
add_action('admin_enqueue_scripts', 'mysat_get_woocommerce_customer_back');

////

function mysat_get_woocommerce_customer_front(): void {

	// Get plugin dir url name
	$plugin_dir_url = get_my_style_anytime_directory_url();

	$roles = array('customer');

	foreach ($roles as $role) {

		if (in_array($role, wp_get_current_user()->roles, true)) {

			wp_enqueue_style('woo-customer-styles', $plugin_dir_url . 'styles/woo-customer-style.css');

		}
	}
}
add_action('wp_enqueue_scripts', 'mysat_get_woocommerce_customer_front');

////////////////////////////////////////////////////////////////////////////////////////

/*==== End Woocommerce plugin styles rules ====*/


/*
Name: Loco Translate
URL: https://wordpress.org/plugins/loco-translate/
*/

///// Loco Translate Translator CSS view Rules

function mysat_get_loco_translate_standard_back(): void {

	// Get plugin dir url name
	$plugin_dir_url = get_my_style_anytime_directory_url();

	$roles = array('translator');

	foreach ($roles as $role) {

		if (in_array($role, wp_get_current_user()->roles, true)) {

			wp_enqueue_style('loco-translator-styles', $plugin_dir_url . 'styles/loco-translator-style.css');

		}
	}
}
add_action('admin_enqueue_scripts', 'mysat_get_loco_translate_standard_back');

////

function mysat_get_loco_translate_standard_front(): void {

	// Get plugin dir url name
	$plugin_dir_url = get_my_style_anytime_directory_url();

	$roles = array('translator');

	foreach ($roles as $role) {

		if (in_array($role, wp_get_current_user()->roles, true)) {

			wp_enqueue_style('loco-translator-styles', $plugin_dir_url . 'styles/loco-translator-style.css');

		}
	}
}
add_action('wp_enqueue_scripts', 'mysat_get_loco_translate_standard_front');

////////////////////////////////////////////////////////////////////////////////////////

/*==== End Loco Translate plugin styles rules ====*/


/*
Name: Yoast SEO
URL: https://wordpress.org/plugins/wordpress-seo/
*/

///// Yoast SEO Manager CSS view Rules

function mysat_get_yoast_seo_manager_back(): void {

	// Get plugin dir url name
	$plugin_dir_url = get_my_style_anytime_directory_url();

	$roles = array('wpseo_manager');

	foreach ($roles as $role) {

		if (in_array($role, wp_get_current_user()->roles, true)) {

			wp_enqueue_style('yoast-seo-manager-styles', $plugin_dir_url . 'styles/yoast-seo-manager-style.css');

		}
	}
}
add_action('admin_enqueue_scripts', 'mysat_get_yoast_seo_manager_back');

////

function mysat_get_yoast_seo_manager_front(): void {

	// Get plugin dir url name
	$plugin_dir_url = get_my_style_anytime_directory_url();

	$roles = array('wpseo_manager');

	foreach ($roles as $role) {

		if (in_array($role, wp_get_current_user()->roles, true)) {

			wp_enqueue_style('yoast-seo-manager-styles', $plugin_dir_url . 'styles/yoast-seo-manager-style.css');

		}
	}
}
add_action('wp_enqueue_scripts', 'mysat_get_yoast_seo_manager_front');

////////////////////////////////////////////////////////////////////////////////////////


///// Yoast SEO Editor CSS view Rules

function mysat_get_yoast_seo_editor_back(): void {

	// Get plugin dir url name
	$plugin_dir_url = get_my_style_anytime_directory_url();

	$roles = array('wpseo_editor');

	foreach ($roles as $role) {

		if (in_array($role, wp_get_current_user()->roles, true)) {

			wp_enqueue_style('yoast-seo-editor-styles', $plugin_dir_url . 'styles/yoast-seo-editor-style.css');

		}
	}
}
add_action('admin_enqueue_scripts', 'mysat_get_yoast_seo_editor_back');

////

function mysat_get_yoast_seo_editor_front(): void {

	// Get plugin dir url name
	$plugin_dir_url = get_my_style_anytime_directory_url();

	$roles = array('wpseo_editor');

	foreach ($roles as $role) {

		if (in_array($role, wp_get_current_user()->roles, true)) {

			wp_enqueue_style('yoast-seo-manager-styles', $plugin_dir_url . 'styles/yoast-seo-editor-style.css');

		}
	}
}
add_action('wp_enqueue_scripts', 'mysat_get_yoast_seo_editor_front');

////////////////////////////////////////////////////////////////////////////////////////

/*==== End Yoast SEO plugin styles rules ====*/


/*
Name: YITH WooCommerce Affiliates
URL: https://wordpress.org/plugins/yith-woocommerce-affiliates/
*/

///// YITH Affiliates CSS view Rules

function mysat_get_yith_affiliates_back(): void {

	// Get plugin dir url name
	$plugin_dir_url = get_my_style_anytime_directory_url();

	$roles = array('yith_affiliate');

	foreach ($roles as $role) {

		if (in_array($role, wp_get_current_user()->roles, true)) {

			wp_enqueue_style('yith-affiliates-styles', $plugin_dir_url . 'styles/yith-affiliates.css');

		}
	}
}
add_action('admin_enqueue_scripts', 'mysat_get_yith_affiliates_back');

////

function mysat_get_yith_affiliates_front(): void {

	// Get plugin dir url name
	$plugin_dir_url = get_my_style_anytime_directory_url();

	$roles = array('yith_affiliate');

	foreach ($roles as $role) {

		if (in_array($role, wp_get_current_user()->roles, true)) {

			wp_enqueue_style('yith-affiliates-styles', $plugin_dir_url . 'styles/yith-affiliates.css');

		}
	}
}
add_action('wp_enqueue_scripts', 'mysat_get_yith_affiliates_front');

////////////////////////////////////////////////////////////////////////////////////////

/*==== End YITH WooCommerce Affiliates plugin styles rules ====*/