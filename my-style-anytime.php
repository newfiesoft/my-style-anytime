<?php

/**
Plugin Name: My Style Anytime
Plugin URI: https://newfiesoft.com/wp-plugins/my-style-anytime/

Description: This WordPress plugin helps you to create and customize Front-end <strong>(public view)</strong> and Back-end <strong>(wp-admin)</strong> style views using the user's type of rules. At the same time, you can do responsive design on the same CSS file rule. <strong>#Lite Version</strong> Now you can <strong>Disable Gutenberg style</strong> anywhere & Enable the classic editor. This function helps you to back your WordPress in a classic view in posts, pages, widgets

Version: 1.0.4
Author: NewfieSoft
Author URI: https://www.newfiesoft.com
Donate link: https://newfiesoft.com/donate

Text Domain: my-style-anytime
Domain Path: /languages/

License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

defined('ABSPATH') or exit();

if ( ! function_exists( 'is_plugin_active' ) ) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

// Load plugin Text Domain
add_action( 'plugins_loaded', 'mmysat_plugin_load_text_domain' );

function mmysat_plugin_load_text_domain() {
	load_plugin_textdomain( 'my-style-anytime', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
 //	 error_log( print_r( is_textdomain_loaded( 'my-style-anytime' ), true ) );
}


// This is plugin custom style.css
add_action('admin_enqueue_scripts', 'mysat_plugin_core_style');

function mysat_plugin_core_style()
{
    wp_enqueue_style('plugin-global', plugin_dir_url(__FILE__) . 'style.css');
}

// This configure menu name and sub names.
add_action('admin_menu', 'mysat_active_admin_menu');

function mysat_active_admin_menu()
{
    add_menu_page(
        'General',
	    __('My Style Anytime', 'my-style-anytime'), // Menu Title;
        'activate_plugins',
        'my-style-anytime', // ID
        'mysat_general_info_page',
        'dashicons-welcome-widgets-menus'
    );

    add_submenu_page( // General button
        'my-style-anytime', // ID
        'General',
	    __('General', 'my-style-anytime'), // Menu Title;
        'activate_plugins',
        'my-style-anytime', // Your menu URL slug
        'mysat_general_info_page' // echo function
    );

    add_submenu_page( // Manage Style button
        'my-style-anytime', // ID
        'Manage',
	    __('Manage Style', 'my-style-anytime'), // Menu Title;
        'activate_plugins',
        'plugin-editor.php?file=my-style-anytime%2Fstyles%2Fadministrator-style.css&plugin=my-style-anytime%2Fmy-style-anytime.php',
    // Your menu URL slug
    );

    add_submenu_page( // Settings button
        'my-style-anytime', // ID
        'Settings',
	    __('Settings', 'my-style-anytime'), // Menu Title;
        'activate_plugins',
        'mysat_settings_page', // Your menu URL slug
	    'mysat_render_settings_page' // callback function
    );

    add_submenu_page(  // Help button
        'my-style-anytime', // ID
        'Help',
	    __('Help', 'my-style-anytime'), // Menu Title;
        'activate_plugins',
        'help', // Your menu URL slug
        static function () { // callback function
            require "pages/mysat-help.php";
        }
    );
}

add_action('', 'mysat_general_info_page');
function mysat_general_info_page()
{

// Get My plugin version
	if ( is_admin() ) {
		if ( ! function_exists( 'get_plugin_data' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}
		$plugin_data = get_plugin_data( __FILE__ );
		printf( '<div class="version">%s %s</div>', __('Version: ', 'my-style-anytime'), $plugin_data['Version'] );
	}

    ?>
    <div class="license-container" style="margin-top: 2px;">
        <h3 class="license-title" style="margin:0;"><i class="dashicons dashicons-info-outline"></i> <?php _e( 'Welcome', 'my-style-anytime' ); ?></h3>
        <hr>
        <p style="padding-top:10px;"><?php _e( 'Hi,', 'my-style-anytime' ); ?></p>
        <p><?php _e( 'We are honored that you decided to use our plugin.', 'my-style-anytime' ); ?></p>
        <p><?php _e( 'This is', 'my-style-anytime' ); ?><strong class="lite">
           <?php _e( 'Lite Version,', 'my-style-anytime' ); ?></strong>
        <?php _e( 'and you have full WordPress default user rules support.', 'my-style-anytime' ); ?></p>
        <p><?php _e( 'If you like this plugin and you need other plugins user roles in plugins like as is WooCommerce or others who have user roles', 'my-style-anytime' ); ?>.</p>
        <p>
	        <?php _e( 'Visit our site for a premium offer', 'my-style-anytime' ); ?>
          <a href="https://newfiesoft.com/plugins/my-style-anytime/" target="_blank"><?php _e( 'here', 'my-style-anytime' ); ?></a>
      <?php _e( ', for a single or multi-site with one single license key', 'my-style-anytime' ); ?>.</p>
        <br>
	    <?php _e( 'Enjoy your work', 'my-style-anytime' ); ?>... 🥳
    </div>

    <div class="power-by-info"><?php _e( 'Premium Tools for WordPress made by', 'my-style-anytime' ); ?> <a href="https://www.newfiesoft.com" target="_blank">NewfieSoft</a>
        <?php _e( 'with', 'my-style-anytime' ); ?> <img draggable="false" role="img" class="emoji" alt="❤" src="https://s.w.org/images/core/emoji/14.0.0/svg/2764.svg">
        <?php _e( 'in Zürich, Switzerland', 'my-style-anytime' ); ?>.</div>

    <?php

}

foreach ( glob( plugin_dir_path( __FILE__ ) . "includes/*.php" ) as $file ) {
	require_once $file;
}


// This help to create additional button after Plugin it is activated Installed Plugins list
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'mysat_custom_link_options_plugin', 10, 2);

function mysat_custom_link_options_plugin($actions): array
{


 // Build URL Links
 $support_url = esc_url(add_query_arg('page', 'my-style-anytime', get_admin_url() . 'admin.php'));
 $getpro_url = esc_url(add_query_arg('', '', 'https://newfiesoft.com/wp-plugins/my-style-anytime/'));


 // Links name
 $support_name =__('Settings', 'my-style-anytime');
 $getpro_name =__('Get Premium', 'my-style-anytime');


 // Create buttons
 $settings_url = '<a href="' . $support_url . '">' . $support_name . '</a>';
 $site_link_premium = '<a href="' . $getpro_url . '" class="premium" target="_blank">' . $getpro_name . '</a>';


    // Organize buttons
    return array_merge(
        (array)$settings_url,
        (array)$site_link_premium,
        //      (array)$help_link,
        $actions,
    );

}

// This help to create additional custom meta links in the sequel after Version By .... Installed Plugins list
add_filter('plugin_row_meta', 'mysat_custom_link_action_plugin', 10, 4);

function mysat_custom_link_action_plugin($links_array, $mysat_plugin_name)
{
    $plugindir = plugin_basename(__FILE__);

    if ($mysat_plugin_name === $plugindir) {


 // Build URL Links
 $support_url = 'https://wordpress.org/support/plugin/my-style-anytime/';
 $faq_url = 'https://wordpress.org/plugins/my-style-anytime/#faq';
 $rating_url = 'https://wordpress.org/support/plugin/my-style-anytime/reviews/#new-post';


 // Links name
 $support_name =__('Community Support', 'my-style-anytime');
 $faq_name =__('FAQ', 'my-style-anytime');
 $rating_name =__('Ratings', 'my-style-anytime');


 // Create buttons
 $links_array[] = '<a href="' . $support_url . '" class="help-style" target="_blank">' . $support_name . '</a>';
 $links_array[] = '<a href="' . $faq_url . '" class="help-style" target="_blank">' . $faq_name . '</a>';
 $links_array[] = '<a href="' . $rating_url . '" class="help-style" target="_blank">' . $rating_name . '</a>';

    }
    return $links_array;

}

// This register hook who checks DISALLOW_FILE_EDIT and set it to true if need before deactivating the plugin
register_deactivation_hook( __FILE__, 'mysat_deactivate_plugin' );

function mysat_deactivate_plugin() {
	$config_file = ABSPATH . 'wp-config.php';
	$config = file_get_contents($config_file);

	$perms = fileperms($config_file) & 0777;

	// Check permission if it is 0640 if not change it to 0640
    if ($perms !== 0640) {
		chmod($config_file, 0640);
	}

	if (preg_match("/define\('DISALLOW_FILE_EDIT',\s*(false|'false')\);/i", $config)) {
		$config = preg_replace("/define\('DISALLOW_FILE_EDIT',\s*(false|'false')\);/i", "define('DISALLOW_FILE_EDIT', true);", $config);
	} elseif (!preg_match("/define\('DISALLOW_FILE_EDIT',/i", $config)) {
		file_put_contents($config_file, "\n\ndefine('DISALLOW_FILE_EDIT', true);", FILE_APPEND);
	}

	file_put_contents($config_file, $config);
}
