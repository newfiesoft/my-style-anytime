<?php

/****
 * =
 * # Create custom CSS Rules view for FrontEnd & BackEnd Wp-admin
 * =
 ****/


/* ############### Standard Wordpress Users type roles ############### */


///// Administrator CSS view Rules

function mysat_get_administrator_back(): void {

	// Get plugin dir url name
	$plugin_dir_url = get_my_style_anytime_directory_url();

    $roles = array('administrator');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('admin-msyt-styles', $plugin_dir_url . 'styles/administrator-style.css');

        }
    }
}
add_action('admin_enqueue_scripts', 'mysat_get_administrator_back');

////

function mysat_get_administrator_front(): void {

	// Get plugin dir url name
	$plugin_dir_url = get_my_style_anytime_directory_url();

    $roles = array('administrator');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('admin-msyt-styles', $plugin_dir_url . 'styles/administrator-style.css');

        }
    }

}
add_action('wp_enqueue_scripts', 'mysat_get_administrator_front');

////////////////////////////////////////////////////////////////////////////////////////


///// Editor CSS view Rules

function mysat_get_editor_back(): void {

	// Get plugin dir url name
	$plugin_dir_url = get_my_style_anytime_directory_url();

    $roles = array('editor');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('editor-msyt-styles', $plugin_dir_url . 'styles/editor-style.css');

        }
    }
}
add_action('admin_enqueue_scripts', 'mysat_get_editor_back');

////

function mysat_get_editor_front(): void {

	// Get plugin dir url name
	$plugin_dir_url = get_my_style_anytime_directory_url();

    $roles = array('editor');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('editor-msyt-styles', $plugin_dir_url . 'styles/editor-style.css');

        }
    }
}
add_action('wp_enqueue_scripts', 'mysat_get_editor_front');

////////////////////////////////////////////////////////////////////////////////////////


///// Author CSS view Rules

function mysat_get_author_back(): void {

	// Get plugin dir url name
	$plugin_dir_url = get_my_style_anytime_directory_url();

    $roles = array('author');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('author-msyt-styles', $plugin_dir_url . 'styles/author-style.css');

        }
    }
}
add_action('admin_enqueue_scripts', 'mysat_get_author_back');

////

function mysat_get_author_front(): void {

	// Get plugin dir url name
	$plugin_dir_url = get_my_style_anytime_directory_url();

    $roles = array('author');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('author-msyt-styles', $plugin_dir_url . 'styles/author-style.css');

        }
    }
}
add_action('wp_enqueue_scripts', 'mysat_get_author_front');

////////////////////////////////////////////////////////////////////////////////////////


///// Contributor CSS view Rules

function mysat_get_contributor_back(): void {

	// Get plugin dir url name
	$plugin_dir_url = get_my_style_anytime_directory_url();

    $roles = array('contributor');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('contributor-msyt-styles', $plugin_dir_url . 'styles/contributor-style.css');

        }
    }
}
add_action('admin_enqueue_scripts', 'mysat_get_contributor_back');

////

function mysat_get_contributor_front(): void {

	// Get plugin dir url name
	$plugin_dir_url = get_my_style_anytime_directory_url();

    $roles = array('contributor');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('contributor-msyt-styles', $plugin_dir_url . 'styles/contributor-style.css');

        }
    }
}
add_action('wp_enqueue_scripts', 'mysat_get_contributor_front');

////////////////////////////////////////////////////////////////////////////////////////


///// Subscriber CSS view Rules

function mysat_get_subscriber_back(): void {

	// Get plugin dir url name
	$plugin_dir_url = get_my_style_anytime_directory_url();

    $roles = array('subscriber');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('subscriber-msyt-styles', $plugin_dir_url . 'styles/subscriber-style.css');

        }
    }
}
add_action('admin_enqueue_scripts', 'mysat_get_subscriber_back');

////

function mysat_get_subscriber_front(): void {

	// Get plugin dir url name
	$plugin_dir_url = get_my_style_anytime_directory_url();

    $roles = array('subscriber');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('subscriber-msyt-styles', $plugin_dir_url . 'styles/subscriber-style.css');

        }
    }
}
add_action('wp_enqueue_scripts', 'mysat_get_subscriber_front');

////////////////////////////////////////////////////////////////////////////////////////


///// Visitor CSS view Rules

function mysat_get_visitor_style(): void {

	// Get plugin dir url name
	$plugin_dir_url = get_my_style_anytime_directory_url();

    global $current_user;

    wp_get_current_user();

    if ( $current_user->ID === 0 ) {

        wp_enqueue_style('visitor-msyt-styles', $plugin_dir_url . 'styles/visitor-style.css');

    }
}
add_action('wp_enqueue_scripts', 'mysat_get_visitor_style');