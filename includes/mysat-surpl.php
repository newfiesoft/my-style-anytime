<?php

/****
 * =
 * # Create custom CSS Rules view for FrontEnd & BackEnd Wp-admin
 * =
 ****/


/* ############### Standard Wordpress Users type roles ############### */


///// Administrator CSS view Rules
add_action('admin_enqueue_scripts', 'mysat_get_administrator_back');

function mysat_get_administrator_back()
{

    $roles = array('administrator');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('admin-msyt-styles', plugin_dir_url(__FILE__) . '../styles/administrator-style.css');

        }
    }
}

add_action('wp_enqueue_scripts', 'mysat_get_administrator_front');

function mysat_get_administrator_front()
{

    $roles = array('administrator');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('admin-msyt-styles', plugin_dir_url(__FILE__) . '../styles/administrator-style.css');

        }
    }

}

////////////////////////////////////////////


///// Editor CSS view Rules
add_action('admin_enqueue_scripts', 'mysat_get_editor_back');

function mysat_get_editor_back()
{

    $roles = array('editor');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('editor-msyt-styles', plugin_dir_url(__FILE__) . '../styles/editor-style.css');

        }
    }
}

add_action('wp_enqueue_scripts', 'mysat_get_editor_front');

function mysat_get_editor_front()
{

    $roles = array('editor');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('editor-msyt-styles', plugin_dir_url(__FILE__) . '../styles/editor-style.css');

        }
    }
}

////////////////////////////////////////////


///// Author CSS view Rules
add_action('admin_enqueue_scripts', 'mysat_get_author_back');

function mysat_get_author_back()
{

    $roles = array('author');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('author-msyt-styles', plugin_dir_url(__FILE__) . '../styles/author-style.css');

        }
    }
}

add_action('wp_enqueue_scripts', 'mysat_get_author_front');

function mysat_get_author_front()
{

    $roles = array('author');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('author-msyt-styles', plugin_dir_url(__FILE__) . '../styles/author-style.css');

        }
    }
}

////////////////////////////////////////////


///// Contributor CSS view Rules
add_action('admin_enqueue_scripts', 'mysat_get_contributor_back');

function mysat_get_contributor_back()
{

    $roles = array('contributor');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('contributor-msyt-styles', plugin_dir_url(__FILE__) . '../styles/contributor-style.css');

        }
    }
}

add_action('wp_enqueue_scripts', 'mysat_get_contributor_front');

function mysat_get_contributor_front()
{

    $roles = array('contributor');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('contributor-msyt-styles', plugin_dir_url(__FILE__) . '../styles/contributor-style.css');

        }
    }
}

////////////////////////////////////////////


///// Subscriber CSS view Rules
add_action('admin_enqueue_scripts', 'mysat_get_subscriber_back');

function mysat_get_subscriber_back()
{

    $roles = array('subscriber');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('subscriber-msyt-styles', plugin_dir_url(__FILE__) . '../styles/subscriber-style.css');

        }
    }
}

add_action('wp_enqueue_scripts', 'mysat_get_subscriber_front');

function mysat_get_subscriber_front()
{

    $roles = array('subscriber');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('subscriber-msyt-styles', plugin_dir_url(__FILE__) . '../styles/subscriber-style.css');

        }
    }
}

////////////////////////////////////////////


///// Visitor CSS view Rules
add_action('wp_enqueue_scripts', 'mysat_get_visitor_style');

function mysat_get_visitor_style()
{

    global $current_user;

    wp_get_current_user();

    if (0 === $current_user->ID) {

        wp_enqueue_style('visitor-msyt-styles', plugin_dir_url(__FILE__) . '../styles/visitor-style.css');

    }

}
