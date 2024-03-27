<?php

//// Load back side wp-admin plugin CSS / Script files and library files that can be loaded when the plugin is active
function mysat_back_load_plugin_style_and_script(): void {

    // Get plugin dir url name
    $plugin_dir_url = my_style_anytime_directory_url();

    // Get plugin data
    $plugin_plugin_data = my_style_anytime_plugin_data();

    // Enqueue styles
    wp_enqueue_style('mysat-back', $plugin_dir_url . 'style.css', array(), esc_html($plugin_plugin_data['Version']) );

    wp_enqueue_style('fontawesome', $plugin_dir_url . 'assets/css/library/fontawesome-all.css', array(), '6.5.1' );

    // Enqueue scripts
    wp_enqueue_script('sweetalert2', $plugin_dir_url . 'assets/js/library/sweetalert2.all.js', array(), '11.4.8', true);

}

add_action('admin_enqueue_scripts', 'mysat_back_load_plugin_style_and_script');


//// There are plugin files JavaScript and CSS files that can be loaded only on the Editor page
function mysat_plugin_code_editor_page_script(): void {

	// Get plugin dir url name
	$plugin_dir_url = my_style_anytime_directory_url();

	// Check if we are on one of your plugin's pages
	$current_page = isset($_GET['page']) ? sanitize_text_field($_GET['page']) : '';

	// Add page URL slug from any page what have
	$allowed_pages = array(
		'mysat_editor_page',
	);

	if (in_array($current_page, $allowed_pages)) {

		// Enqueue Codemirror library and CSS for styling
		wp_enqueue_script('codemirror-library', $plugin_dir_url . 'assets/addons/codemirror/lib/codemirror.min.js', array(), '5.14.1', true);

		wp_enqueue_style('codemirror', $plugin_dir_url . 'assets/addons/codemirror/lib/codemirror.css', array(), '5.14.1' );

		// Load CodeMirror add-ons for autocompletion and CSS for styling
		wp_enqueue_script('codemirror-hint-js', $plugin_dir_url . 'assets/addons/codemirror/addon/hint/show-hint.js', array(), '5.14.1', true);

		wp_enqueue_style('codemirror-hint', $plugin_dir_url . 'assets/addons/codemirror/addon/hint/show-hint.css', array(), '5.14.1' );

		// Load CodeMirror add-on for autocompletion in CSS
		wp_enqueue_script('codemirror-hint-css-js', $plugin_dir_url . 'assets/addons/codemirror/addon/hint/css-hint.js', array(), '5.14.1', true);

		// Load CodeMirror CSS theme (you can choose a different theme)
		wp_enqueue_style('codemirror-theme', $plugin_dir_url . 'assets/addons/codemirror/theme/monokai.css', array(), '5.14.1' );

		// Load CodeMirror CSS mode
		wp_enqueue_script('codemirror-css-mode', $plugin_dir_url . 'assets/addons/codemirror/mode/css/css.js', array(), '5.14.1', true);


		// Localize the script with the AJAX URL and nonce
		wp_localize_script('codemirror-library', 'mysat_editor_script_vars', array(
			'ajaxurl'  => admin_url('admin-ajax.php'),
			'security' => wp_verify_nonce('mysat_nonce_action'),
		));
	}
}

add_action('admin_enqueue_scripts', 'mysat_plugin_code_editor_page_script');