<?php

/***
This is part of #Security# configuration
 ***/


add_action( 'admin_init', 'mysat_security_page' );

function mysat_security_page() {
	add_settings_section(
		'mysat_security_section',
		'',
		'',
		'mysat_security_page'
	);

	add_settings_field(
		'mysat_remove_meta_generator',
		__('', 'my-style-anytime'), // Remove meta generator
		'mysat_remove_meta_generator_callback',
		'mysat_security_page',
		'mysat_security_section'
	);

	register_setting( 'mysat_security_group', 'mysat_remove_meta_generator' );
}

/***
This remove WordPress in title on wp-login.php and in WordPress Dashboard
 ***/


// Remove meta generator content on the code side of website
add_action('init', 'mysat_remove_meta_generator');

function mysat_remove_meta_generator() {
	$remove_meta_gen = get_option( 'mysat_remove_meta_generator', false );
	if ( $remove_meta_gen ) {
		remove_action('wp_head', 'wp_generator');
	}
}

function mysat_remove_meta_generator_callback() {
	$remove_meta_gen = get_option( 'mysat_remove_meta_generator', false );
	echo '<label for="mysat_remove_meta_generator" class="function_name">';
	echo '<input type="checkbox" id="mysat_remove_meta_generator" name="mysat_remove_meta_generator" value="1" ' . checked( $remove_meta_gen, 1, false ) . ' />';
	echo __('Remove meta generator', 'my-style-anytime');
	echo '</label><div class="function_description">';
	echo __('Removing the meta generator, helps you to hide the version of WordPress that you are using from potential attackers.', 'my-style-anytime');
	echo '</div>';
}


function mysat_render_security_page() {
	?>
    <div class="license-container">
        <h3 class="license-title" style="margin:0;"><i class="dashicons dashicons-info-outline"></i> <?php _e( 'Security', 'my-style-anytime' ); ?></h3>
        <hr>
        <form action="options.php" method="post" class="page_mysat_security_page">
		    <?php
		    settings_fields( 'mysat_security_group' );
		    do_settings_sections( 'mysat_security_page' );
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
