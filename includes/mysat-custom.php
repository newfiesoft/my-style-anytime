<?php

/***
This is part of #Customize# configuration
 ***/


add_action( 'admin_init', 'mysat_custom_page' );

function mysat_custom_page() {
	add_settings_section(
		'mysat_custom_section',
		'',
		'',
		'mysat_custom_page'
	);

	add_settings_field(
		'mysat_remove_wp_title',
		__('', 'my-style-anytime'), // Remove "WordPress" from title
		'mysat_remove_wp_title_callback',
		'mysat_custom_page',
		'mysat_custom_section'
	);

	register_setting( 'mysat_custom_group', 'mysat_remove_wp_title' );
}

/***
This remove WordPress in title on wp-login.php and in WordPress Dashboard
 ***/

// Remove on page wp-login.php
add_filter('login_title', function($title) {return mysat_remove_wp_title($title);});

// Remove on <title>
add_filter('admin_title', function($title) {return mysat_remove_wp_title($title);});

function mysat_remove_wp_title($title) {
	$disable_wp_title = get_option('mysat_remove_wp_title', false);
	if ($disable_wp_title) {
		$wp_names = [
			__('WordPress', 'default'), // English
			__('ወርድፕረስ', 'default'), // Amharic
			__('ووردبريس', 'default'), //Arabic
			__('ওয়ার্ডপ্রেস', 'default'), // Bengali
			__('وۆردپرێس', 'default'), // Kurdish
			__('وردپرس ورود', 'default'), // Persian (Afghanistan) ////
			__('وردپرس', 'default'), // Persian
			__('વર્ડપ્રેસ', 'default'), // Gujarati
			__('וורדפרס', 'default'), // Hebrew
			__('वर्डप्रेस', 'default'), // Hindi
			__('ವರ್ಡ್ಪ್ರೆಸ್', 'default'), // Kannada
			__('워드프레스', 'default'), // Korean
			__('वर्डप्रेस', 'default'), // Marathi
			__('वर्डप्रेस', 'default'), // Nepali
			__('ورڈپریس', 'default'), // Saraiki
			__('ورڊپريس', 'default'), // Sindhi
			__('Вордпрес', 'default'), // Serbian
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

function mysat_remove_wp_title_callback() {
	$remove_meta_gen = get_option( 'mysat_remove_wp_title', false );
	echo '<label for="mysat_remove_wp_title" class="function_name">';
	echo '<input type="checkbox" id="mysat_remove_wp_title" name="mysat_remove_wp_title" value="1" ' . checked( $remove_meta_gen, 1, false ) . ' />';
	echo __('Remove WordPress from the title', 'my-style-anytime');
	echo '</label><div class="function_description">';
	echo __('From the website title displayed in a browser tab and dashboard, and wp-login.php for enhanced branding and security.', 'my-style-anytime');
	echo '</div>';
}



function mysat_render_custom_page() {
	?>
    <div class="license-container">
        <h3 class="license-title" style="margin:0;"><i class="dashicons dashicons-info-outline"></i> <?php _e( 'Customization', 'my-style-anytime' ); ?></h3>
        <hr>
        <form action="options.php" method="post" class="page_mysat_custom_page">
			<?php
			settings_fields( 'mysat_custom_group' );
			do_settings_sections( 'mysat_custom_page' );
			submit_button( __( 'Save', 'my-style-anytime' ) );
			?>
        </form>
    </div>

    <div class="power-by-info"><?php _e( 'Premium Tools for WordPress made by', 'my-style-anytime' ); ?> <a href="https://www.newfiesoft.com" target="_blank">NewfieSoft</a>
		<?php _e( 'with', 'my-style-anytime' ); ?> <img draggable="false" role="img" class="emoji" alt="❤" src="https://s.w.org/images/core/emoji/14.0.0/svg/2764.svg">
		<?php _e( 'in Zürich, Switzerland', 'my-style-anytime' ); ?>.</div>
	<?php

}

add_action( 'admin_menu', 'mysat_active_admin_menu' );
