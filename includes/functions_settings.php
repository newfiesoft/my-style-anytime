<?php
//includes/functions_settings.php

/***
All functions based on the page #Settings# configuration
 ***/

//// This function Disable Gutenberg style anywhere & Enable classic editor.
function mysat_disable_gutenberg(): void {

	$disable_gutenberg = get_option( 'mysat_disable_gutenberg' );

	if ( $disable_gutenberg ) {
		add_filter('use_block_editor_for_post', '__return_false' );
		add_filter('use_block_editor_for_post_type', '__return_false' );
		add_filter( 'use_widgets_block_editor', '__return_false' );
	}
}

add_action( 'init', 'mysat_disable_gutenberg', 999 );


//// Remove "WordPress" from the title on wp-login.php and in WordPress Dashboard. This function checks if the option to disable "WordPress" in titles is enabled. If enabled, it removes "WordPress" (and its translations) from various title formats.
function mysat_remove_wp_title( string $title): string {
	$disable_wp_title = get_option('mysat_remove_wp_title', false);

	if ($disable_wp_title) {
		// Array of "WordPress" translations in various languages.
		$wp_names = [
			__('WordPress', 'my-style-anytime'), // English
			__('ወርድፕረስ', 'my-style-anytime'), // Amharic
			__('ووردبريس', 'my-style-anytime'), // Arabic
			__('ওয়ার্ডপ্রেস', 'my-style-anytime'), // Bengali
			__('وۆردپرێس', 'my-style-anytime'), // Kurdish
			__('وردپرس ورود', 'my-style-anytime'), // Persian (Afghanistan)
			__('وردپرس', 'my-style-anytime'), // Persian
			__('વર્ડપ્રેસ', 'my-style-anytime'), // Gujarati
			__('וורדפרס', 'my-style-anytime'), // Hebrew
			__('वर्डप्रेस', 'my-style-anytime'), // Hindi
			__('ವರ್ಡ್ಪ್ರೆಸ್', 'my-style-anytime'), // Kannada
			__('워드프레스', 'my-style-anytime'), // Korean
			__('वर्डप्रेस', 'my-style-anytime'), // Marathi
			__('വേഡ്പ്രസ്സ്', 'my-style-anytime'), // Malayalam
			__('वर्डप्रेस', 'my-style-anytime'), // Nepali
			__('ورڈپریس', 'my-style-anytime'), // Saraiki
			__('ورڊپريس', 'my-style-anytime'), // Sindhi
			__('Вордпрес', 'my-style-anytime'), // Serbian
		];

		$to_replace = [];
		foreach ($wp_names as $wp_name) {
			$to_replace[] = " — " . $wp_name;
			$to_replace[] = " &#8211; " . $wp_name;
			$to_replace[] = " &#8212; " . $wp_name;
			$to_replace[] = " &mdash; " . $wp_name;
			$to_replace[] = " " . $wp_name;
			$to_replace[] = $wp_name . " &lsaquo; ";
			$to_replace[] = " &#8212;";
		}

		// Remove all instances of "WordPress" and its translations from the title.
		$title = str_replace($to_replace, '', $title);
	}
	return $title;
}

// Remove "WordPress" from the title on wp-login.php
add_filter('login_title', 'mysat_remove_wp_title');

// Remove "WordPress" from the admin title
add_filter('admin_title', 'mysat_remove_wp_title');


// Remove "category" slug if enabled
function mysat_check_remove_category_slug(): void {
	$remove_category_slug = get_option('mysat_remove_category_slug', false);
	if ($remove_category_slug) {
		add_filter( 'user_trailingslashit', 'mysat_remove_category_slug_filter', 100, 2 );
	}
}
add_action('init', 'mysat_check_remove_category_slug');

// The filter callback
function mysat_remove_category_slug_filter( $string, $type ) {
	if ( $type === 'category' && ( str_contains( $string, 'category' ) ) ) {
		$url_without_category = str_replace( "/category/", "/", $string );
		return trailingslashit( $url_without_category );
	}
	return $string;
}