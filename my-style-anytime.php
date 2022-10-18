<?php

/*

Plugin Name: My Style Anytime
Plugin URI: https://newfiesoft.com/wp-plugins/my-style-anytime/

Description: This WordPress plugin helps you to create and customize Front-end <strong>(public view)</strong> and Back-end <strong>(wp-admin)</strong> style views using the user's type of rules. At the same time, you can do responsive design on the same CSS file rule. <strong># Lite Version</strong>

Version: 1.0.1
Author: NewfieSoft
Author URI: https://www.newfiesoft.com
Donate link: https://newfiesoft.com/donate

License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

add_action('admin_enqueue_scripts', 'mysat_plugin_core_style');

add_action('admin_menu', 'mysat_active_admin_menu');


function mysat_plugin_core_style()
{
    wp_enqueue_style('plugin-global', plugin_dir_url(__FILE__) . 'style.css');
}

// This configure menu name and sub names.
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

    add_submenu_page(
        'my-style-anytime', // ID
        'General',
        'General', // Menu Title
        'activate_plugins',
        'my-style-anytime', // Your menu URL slug
        'mysat_general_info_page' // echo function
    );

    add_submenu_page(
        'my-style-anytime', // ID
        'Manage',
        'Manage Style', // Menu Title
        'activate_plugins',
        'plugin-editor.php?file=my-style-anytime%2Fstyles%2Fadministrator-style.css&plugin=my-style-anytime%2Fmy-style-anytime.php',
    // Your menu URL slug
    );

    add_submenu_page(
        'my-style-anytime', // ID
        'Help',
        'Help', // Menu Title
        'activate_plugins',
        'help', // Your menu URL slug
        static function () { // callback function
            include "help/help.php";
        }
    );
}

function mysat_general_info_page()
{

    ?>

    <div class="el-license-container">
        <h3 class="el-license-title" style="margin:0;"><i class="dashicons dashicons-info-outline"></i> Information
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
                                                                                           class="emoji"
                                                                                           alt="❤️"
                                                                                           src="https://s.w.org/images/core/emoji/14.0.0/svg/2764.svg">
        in Zürich, Switzerland.
    </div>

    <?php

}

require_once __DIR__ . '/includes/class-mysat-global.php';



