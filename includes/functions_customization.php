<?php

/***
All functions based on the page #Customization# configuration
 ***/

//// This remove WordPress in title on wp-login.php and in WordPress Dashboard
function mysat_remove_wp_title($title) {

	$disable_wp_title = get_option('mysat_remove_wp_title', false);

	if ($disable_wp_title) {
		$wp_names = [
			__('WordPress' ), // English
			__('ወርድፕረስ' ), // Amharic
			__('ووردبريس' ), //Arabic
			__('ওয়ার্ডপ্রেস' ), // Bengali
			__('وۆردپرێس' ), // Kurdish
			__('وردپرس ورود' ), // Persian (Afghanistan) ////
			__('وردپرس' ), // Persian
			__('વર્ડપ્રેસ' ), // Gujarati
			__('וורדפרס' ), // Hebrew
			__('वर्डप्रेस' ), // Hindi
			__('ವರ್ಡ್ಪ್ರೆಸ್' ), // Kannada
			__('워드프레스' ), // Korean
			__('वर्डप्रेस' ), // Marathi
			__('വേഡ്പ്രസ്സ്' ), // Malayalam
			__('वर्डप्रेस' ), // Nepali
			__('ورڈپریس' ), // Saraiki
			__('ورڊپريس' ), // Sindhi
			__('Вордпрес' ), // Serbian
		];

		$to_replace = [];
		foreach($wp_names as $wp_name) {
			$to_replace[] = " — " . $wp_name;
			$to_replace[] = " &#8211; " . $wp_name;
			$to_replace[] = " &#8212; " . $wp_name;
			$to_replace[] = " &mdash; " . $wp_name;
			$to_replace[] = " " . $wp_name;
			$to_replace[] = $wp_name . " &lsaquo; ";
			$to_replace[] = " &#8212;";
		}

		$title = str_replace($to_replace, '', $title);
	}
	return $title;
}

// Remove on page wp-login.php
add_filter('login_title', static function($title) {return mysat_remove_wp_title($title);});

// Remove on <title>
add_filter('admin_title', static function($title) {return mysat_remove_wp_title($title);});
