<?php

/***
Load functions for the back side that display inside the admin panels. Example /wp-admin/
 ***/


//// Check the current user roles type and if it matches return with the user roles CSS file on the back side like /wp-admin/
function mysat_back_get_current_user_roles_style(): void {

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

add_action('admin_enqueue_scripts', 'mysat_back_get_current_user_roles_style');


//// Generate css file for the user roles type who does not have or user roles are new inside wp_user_roles
function mysat_back_get_generate_css_file($role_slug, $role_name): void {

	// Your file generation logic here
	$plugin_dir_path = my_style_anytime_plugin_dir_path();
	$template_directory = $plugin_dir_path . '/assets/template/';
	$styles_directory = $plugin_dir_path . '/styles/';

	// Initialize the WordPress filesystem
	WP_Filesystem();

	global $wp_filesystem;

	// Check if the filesystem is initialized successfully
	if ($wp_filesystem) {
		// Make sure the directory exists, if not, create it
		if (!$wp_filesystem->is_dir($styles_directory) && !$wp_filesystem->mkdir($styles_directory, 0755)) {
			throw new RuntimeException(sprintf('Directory "%s" was not created', esc_html($styles_directory)));
		}

		// Construct the file path for the template user role style
		$template_file_path_role = $template_directory . 'role-template.css';

		// Construct the file path for the template visitor style
		$template_file_path_visitor = $template_directory . 'visitor-template.css';

		// Construct the file path for the generated CSS file
		$full_css_file_path = $styles_directory . $role_slug . '-style.css';

		// Get the content of the template file for role style
		$template_content_role = $wp_filesystem->get_contents($template_file_path_role);

		// Get the content of the template file for visitor style
		$template_content_visitor = $wp_filesystem->get_contents($template_file_path_visitor);

		// Special case for the visitor-style.css
		if ($role_slug === 'visitor') {
			// Replace both occurrences directly for visitors
			$template_content_visitor = str_replace( array(
				'This is the style for roles {$name}',
				'@Roles: {$name}'
			), array( 'This is the style for roles Visitor', '@Roles: Visitor' ), $template_content_visitor );

			// Write content to the file for visitor style
			$wp_filesystem->put_contents($full_css_file_path, $template_content_visitor, FS_CHMOD_FILE);
		} else {
			// Replace {$name} with $role_name in the template content for role style
			$template_content_role = str_replace('{$name}', $role_name, $template_content_role);

			// Write content to the file for role style
			$wp_filesystem->put_contents($full_css_file_path, $template_content_role, FS_CHMOD_FILE);
		}
	}
}


//// This handles the generation css process in the background
function mysat_back_get_handle_file_generation(): void {

	global $wp_roles;

	if (isset($_GET['generate_file'], $_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'], 'generate_file_nonce')) {

		// Handle file generation logic here
		$role_slug = sanitize_text_field($_GET['generate_file']);

		// Get the role name from the $wp_roles global
		$roles = $wp_roles->roles;
		$role_name = $roles[ $role_slug ]['name'] ?? '';

		// Call the function
		mysat_back_get_generate_css_file($role_slug, $role_name);

		// Redirect back to the original page
		wp_safe_redirect(admin_url('admin.php?page=mysat_editor_page'));
		exit();
	}
}

add_action('admin_init', 'mysat_back_get_handle_file_generation');


