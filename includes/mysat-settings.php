<?php

/***
This is part of #Settings# configuration
 ***/


add_action( 'admin_init', 'mysat_settings_page' );

function mysat_settings_page() {
	add_settings_section(
		'mysat_settings_section',
		'',
		'',
		'mysat_settings_page'
	);

	add_settings_field(
		'mysat_disable_gutenberg',
		__('', 'my-style-anytime'), // Disable Gutenberg Editor
		'mysat_disable_gutenberg_callback',
		'mysat_settings_page',
		'mysat_settings_section'
	);

	add_settings_field(
		'mysat_disallow_file_edit',
		__('', 'my-style-anytime'), // Allow File Code Editor
		'mysat_disallow_file_edit_callback',
		'mysat_settings_page',
		'mysat_settings_section'
	);

	register_setting( 'mysat_settings_group', 'mysat_disable_gutenberg' );
	register_setting( 'mysat_settings_group', 'mysat_disallow_file_edit' );
}


/***
This function Disable Gutenberg style anywhere & Enable classic editor. Help you to back your WordPress in view
mode in post, pages, widgets.
 ***/

add_action( 'init', 'mysat_disable_gutenberg' );

function mysat_disable_gutenberg() {
	$disable_gutenberg = get_option( 'mysat_disable_gutenberg' );
	if ( $disable_gutenberg ) {
		add_filter('use_block_editor_for_post', '__return_false', 10);
		add_filter('use_block_editor_for_post_type', '__return_false', 10);
		add_filter( 'use_widgets_block_editor', '__return_false' );
	}
}

function mysat_disable_gutenberg_callback() {
	$remove_meta_gen = get_option( 'mysat_disable_gutenberg', false );
	echo '<label for="mysat_disable_gutenberg" class="function_name">';
	echo '<input type="checkbox" id="mysat_disable_gutenberg" name="mysat_disable_gutenberg" value="1" ' . checked( $remove_meta_gen, 1, false ) . ' />';
	echo __('Disable Gutenberg Editor', 'my-style-anytime');
	echo '</label><div class="function_description">';
	echo __('With this, you Disable Gutenberg on your site and back to the classic editor, not meather where you are.', 'my-style-anytime');
	echo '</div>';
}


/***
This function helps to check the status of DISALLOW_FILE_EDIT is it true or false.
 ***/

add_action( 'init', 'mysat_disallow_file_edit' );

function mysat_disallow_file_edit() {
	$disallow_file_edit = get_option( 'mysat_disallow_file_edit' );
	$config_file = ABSPATH . 'wp-config.php';
	$config = file_get_contents( $config_file );

	if (!$disallow_file_edit && preg_match("/define\('DISALLOW_FILE_EDIT',\s*(false|'false')\);/i", $config)) {
		$config = preg_replace("/define\('DISALLOW_FILE_EDIT',\s*(false|'false')\);/i", "define('DISALLOW_FILE_EDIT', true);", $config);
		file_put_contents($config_file, $config);

		// Change file permissions to 600
		chmod($config_file, 0600);

	} elseif ($disallow_file_edit && preg_match("/define\('DISALLOW_FILE_EDIT',\s*(true|'true')\);/i", $config)) {
		$config = preg_replace("/define\('DISALLOW_FILE_EDIT',\s*(true|'true')\);/i", "define('DISALLOW_FILE_EDIT', false);", $config);
		file_put_contents($config_file, $config);

		// Change file permissions to 600
		chmod($config_file, 0600);

	} elseif (!preg_match("/define\('DISALLOW_FILE_EDIT',/i", $config)) {
		if ($disallow_file_edit) {
			file_put_contents($config_file, "\n\ndefine('DISALLOW_FILE_EDIT', true);", FILE_APPEND);

		} else {
			file_put_contents($config_file, "\n\ndefine('DISALLOW_FILE_EDIT', false);", FILE_APPEND);

		}
		// Change file permissions to 600
		chmod($config_file, 0600);
	}
}

function mysat_disallow_file_edit_callback() {
	$remove_meta_gen = get_option( 'mysat_disallow_file_edit', false );
	echo '<label for="mysat_disallow_file_edit" class="function_name">';
	echo '<input type="checkbox" id="mysat_disallow_file_edit" name="mysat_disallow_file_edit" value="1" ' . checked( $remove_meta_gen, 1, false ) . ' />';
	echo __('Allow File Code Editor', 'my-style-anytime');
	echo '</label><div class="function_description">';
	echo __('This allows you can working with style here end enable file editing in WordPress Dashboard.', 'my-style-anytime');
	echo '</div>';
}

// Generate HTML form

function mysat_render_settings_page() {
	?>
    <div class="license-container">
        <h3 class="license-title" style="margin:0;"><i class="dashicons dashicons-info-outline"></i> <?php _e( 'Settings', 'my-style-anytime' ); ?></h3>
        <hr>
        <form action="options.php" method="post">
			<?php
			settings_fields( 'mysat_settings_group' );
			do_settings_sections( 'mysat_settings_page' );
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
