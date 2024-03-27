<?php

/***
Load functions for front-side displays outside the admin panels. Example domain.com/
 ***/


//// Check the current user roles type and if matches return with user roles CSS file on the front side like domain.com
function mysat_front_get_current_user_roles_style(): void {

	// Get the current user
	$current_user = wp_get_current_user();

	// Check if the current user is not null
	if ($current_user !== null) {
		// Get the roles of the current user
		$roles = $current_user->roles;

		// Get plugin dir URL
		$plugin_dir_url = my_style_anytime_directory_url();

		// Get plugin data
		$plugin_plugin_data = my_style_anytime_plugin_data();

		foreach ($roles as $role) {
			if (in_array($role, $roles, true)) {
				// Replace underscores with hyphens in the role name
				$role_slug = str_replace('_', '-', $role);

				wp_enqueue_style('mysat-' . $role_slug . '-styles', $plugin_dir_url . 'styles/' . $role_slug . '-style.css', array(), esc_html($plugin_plugin_data['Version']) );
			}
		}
	}
}

add_action('wp_enqueue_scripts', 'mysat_front_get_current_user_roles_style');


//// If there are no user roles to detect, use this to show the visitor CSS file
function mysat_get_visitor_style(): void {

	// Get plugin dir URL
	$plugin_dir_url = my_style_anytime_directory_url();

	// Get plugin data
	$plugin_plugin_data = my_style_anytime_plugin_data();

	global $current_user;

	wp_get_current_user();

	if ($current_user->ID === 0) {
		wp_enqueue_style('mysat-visitor-styles', $plugin_dir_url . 'styles/visitor-style.css', array(), esc_html($plugin_plugin_data['Version']) );
	}
}

add_action('wp_enqueue_scripts', 'mysat_get_visitor_style');

