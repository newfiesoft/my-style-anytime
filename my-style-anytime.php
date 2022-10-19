<?php

/*

Plugin Name: My Style Anytime
Plugin URI: https://newfiesoft.com/wp-plugins/my-style-anytime/

Description: This WordPress plugin helps you to create and customize Front-end <strong>(public view)</strong> and Back-end <strong>(wp-admin)</strong> style views using the user's type of rules. At the same time, you can do responsive design on the same CSS file rule. <strong># Lite Version</strong>

Version: 1.0.2.9
Author: NewfieSoft
Author URI: https://www.newfiesoft.com
Donate link: https://newfiesoft.com/donate

Text Domain: my-style-anytime

License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/



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
        'My Style Anytime', // Menu Title
        'activate_plugins',
        'my-style-anytime', // ID
        'mysat_general_info_page',
        'dashicons-welcome-widgets-menus'
    );

    add_submenu_page( // General button
        'my-style-anytime', // ID
        'General',
        'General', // Menu Title
        'activate_plugins',
        'my-style-anytime', // Your menu URL slug
        'mysat_general_info_page' // echo function
    );

    add_submenu_page( // Manage Style button
        'my-style-anytime', // ID
        'Manage',
        'Manage Style', // Menu Title
        'activate_plugins',
        'plugin-editor.php?file=my-style-anytime%2Fstyles%2Fadministrator-style.css&plugin=my-style-anytime%2Fmy-style-anytime.php',
    // Your menu URL slug
    );

    add_submenu_page(  // Help button
        'my-style-anytime', // ID
        'Help',
        'Help', // Menu Title
        'activate_plugins',
        'help', // Your menu URL slug
        static function () { // callback function
            require "help/help.php";
        }
    );
}

function mysat_general_info_page()
{

    ?>

    <div class="license-container">
        <h3 class="license-title" style="margin:0;"><i class="dashicons dashicons-info-outline"></i> Information
        </h3>
        <hr>
        <p style="padding-top:10px;">Hi You,</p>
        <p>We are honored that you decided to use our plugin.</p>
        <p>This is <strong class="lite">Lite Version</strong>, and you have full WordPress rules support.</p>
        <p>If you like this plugin and you need other roles in plugins like as is WooCommerce or others who have user
            roles.</p>
        <p>
            Visit our site for a premium offer <a href="https://newfiesoft.com/plugins/my-style-anytime/"
                                                  target="_blank">here</a>, for
            a single or multi-site with one single license key.</p>
        <br>
        Enjoy your job... :)
    </div>

    <div class="power-by-info" style="width: 98%;text-align: right;">Premium Tools for WordPress made by <a
                href="https://www.newfiesoft.com" target="_blank">NewfieSoft</a> with <img draggable="false" role="img"
                                                                                           class="emoji" alt="❤"
                                                                                           src="https://s.w.org/images/core/emoji/14.0.0/svg/2764.svg">
        in Zürich, Switzerland.
    </div>

    <?php

}

require_once __DIR__ . '/includes/class-mysat-surpl.php';

// This help to create additional button after Plugin it is activated Installed Plugins list
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'mysat_custom_link_options_plugin', 10, 2);

function mysat_custom_link_options_plugin($actions): array
{

    // Build URL Links
    $settings = esc_url(add_query_arg('page', 'my-style-anytime', get_admin_url() . 'admin.php'));
    $getpro = esc_url(add_query_arg('', '', 'https://newfiesoft.com/wp-plugins/my-style-anytime/'));

    // Links name
    $support_name ='Settings';
    $getpro_name ='Get Premium';


    // Create buttons
    $settings_url = '<a href="' . $settings . '">' . $support_name . '</a>';
    $site_link_premium = '<a href="' . $getpro . '" class="premium" target="_blank">' . $getpro_name . '</a>';

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
 $plugin_faq_url = 'https://wordpress.org/plugins/my-style-anytime/#faq';

 // Links name
 $support_name ='Community Support';
 $plugin_faq_name ='FAQ';

 // Create buttons
 $links_array[] = '<a href="' . $support_url . '" class="help-style" target="_blank">' . $support_name . '</a>';
 $links_array[] = '<a href="' . $plugin_faq_url . '" class="help-style" target="_blank">' . $plugin_faq_name . '</a>';

    }

    return $links_array;
}

