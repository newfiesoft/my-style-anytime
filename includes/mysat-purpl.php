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
add_action('admin_enqueue_scripts', 'mysat_get_woocommerce_shop_manager_back');

function mysat_get_woocommerce_shop_manager_back()
{

    $roles = array('shop_manager');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('woo-shop-manager-styles', plugin_dir_url(__FILE__) . '../styles/woo-shop-manager-style.css');

        }
    }
}

add_action('wp_enqueue_scripts', 'mysat_get_woocommerce_shop_manager_front');

function mysat_get_woocommerce_shop_manager_front()
{

    $roles = array('shop_manager');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('woo-shop-manager-styles', plugin_dir_url(__FILE__) . '../styles/woo-shop-manager-style.css');

        }
    }
}

////////////////////////////////////////////


///// WooCommerce Customer CSS view Rules
add_action('admin_enqueue_scripts', 'mysat_get_woocommerce_customer_back');

function mysat_get_woocommerce_customer_back()
{

    $roles = array('customer');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('woo-customer-styles', plugin_dir_url(__FILE__) . '../styles/woo-customer-style.css');

        }
    }
}

add_action('wp_enqueue_scripts', 'mysat_get_woocommerce_customer_front');

function mysat_get_woocommerce_customer_front()
{

    $roles = array('customer');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('woo-customer-styles', plugin_dir_url(__FILE__) . '../styles/woo-customer-style.css');

        }
    }
}

////////////////////////////////////////////

/*==== End Woocommerce plugin styles rules ====*/


/*
Name: Loco Translate
URL: https://wordpress.org/plugins/loco-translate/
*/

///// Loco Translate Translator CSS view Rules
add_action('admin_enqueue_scripts', 'mysat_get_loco_translate_standard_back');

function mysat_get_loco_translate_standard_back()
{

    $roles = array('translator');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('loco-translator-styles', plugin_dir_url(__FILE__) . '../styles/loco-translator-style.css');

        }
    }
}

add_action('wp_enqueue_scripts', 'mysat_get_loco_translate_standard_front');

function mysat_get_loco_translate_standard_front()
{

    $roles = array('translator');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('loco-translator-styles', plugin_dir_url(__FILE__) . '../styles/loco-translator-style.css');

        }
    }
}

////////////////////////////////////////////

/*==== End Loco Translate plugin styles rules ====*/


/*
Name: Yoast SEO
URL: https://wordpress.org/plugins/wordpress-seo/
*/

///// Yoast SEO Manager CSS view Rules
add_action('admin_enqueue_scripts', 'mysat_get_yoast_seo_manager_back');

function mysat_get_yoast_seo_manager_back()
{

    $roles = array('wpseo_manager');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('yoast-seo-manager-styles', plugin_dir_url(__FILE__) . '../styles/yoast-seo-manager-style.css');

        }
    }
}

add_action('wp_enqueue_scripts', 'mysat_get_yoast_seo_manager_front');

function mysat_get_yoast_seo_manager_front()
{

    $roles = array('wpseo_manager');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('yoast-seo-manager-styles', plugin_dir_url(__FILE__) . '../styles/yoast-seo-manager-style.css');

        }
    }
}

////////////////////////////////////////////


///// Yoast SEO Editor CSS view Rules
add_action('admin_enqueue_scripts', 'mysat_get_yoast_seo_editor_back');

function mysat_get_yoast_seo_editor_back()
{

    $roles = array('wpseo_editor');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('yoast-seo-editor-styles', plugin_dir_url(__FILE__) . '../styles/yoast-seo-editor-style.css');

        }
    }
}

add_action('wp_enqueue_scripts', 'mysat_get_yoast_seo_editor_front');

function mysat_get_yoast_seo_editor_front()
{

    $roles = array('wpseo_editor');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('yoast-seo-manager-styles', plugin_dir_url(__FILE__) . '../styles/yoast-seo-editor-style.css');

        }
    }
}

////////////////////////////////////////////

/*==== End Yoast SEO plugin styles rules ====*/


/*
Name: YITH WooCommerce Affiliates
URL: https://wordpress.org/plugins/yith-woocommerce-affiliates/
*/

///// YITH Affiliates CSS view Rules
add_action('admin_enqueue_scripts', 'mysat_get_yith_affiliates_back');

function mysat_get_yith_affiliates_back()
{

    $roles = array('yith_affiliate');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('yith-affiliates-styles', plugin_dir_url(__FILE__) . '../styles/yith-affiliates.css');

        }
    }
}

add_action('wp_enqueue_scripts', 'mysat_get_yith_affiliates_front');

function mysat_get_yith_affiliates_front()
{

    $roles = array('yith_affiliate');

    foreach ($roles as $role) {

        if (in_array($role, wp_get_current_user()->roles, true)) {

            wp_enqueue_style('yith-affiliates-styles', plugin_dir_url(__FILE__) . '../styles/yith-affiliates.css');

        }
    }
}

////////////////////////////////////////////

/*==== End YITH WooCommerce Affiliates plugin styles rules ====*/