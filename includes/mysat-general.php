<?php

/***
This is part of #General# configuration
 ***/


add_action( 'admin_init', 'mysat_general_page' );

function mysat_general_page() {
	add_settings_section(
		'mysat_general_section',
		'',
		'',
		'my-style-anytime'
	);
}

add_action( '', 'mysat_render_general_page' );
function mysat_render_general_page() {

// Get My plugin version
	if ( ! function_exists( 'get_plugin_data' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}
   $plugin_data = get_plugin_data( __DIR__ . '/../my-style-anytime.php' );
   printf( '<div class="version">%s %s</div>', __( 'Version: ', 'my-style-anytime' ), $plugin_data['Version'] );

	?>
    <div class="license-container" style="margin-top: 2px;">
        <h3 class="license-title" style="margin:0;"><i class="dashicons dashicons-info-outline"></i> <?php _e( 'Welcome', 'my-style-anytime' ); ?></h3>
        <hr>
        <p style="padding-top:10px;"><?php _e( 'Hi,', 'my-style-anytime' ); ?></p>
        <p><?php _e( 'We are honored that you decided to use our plugin.', 'my-style-anytime' ); ?></p>
        <p><?php _e( 'As you read before installing and activating this plugin with him, you have the possibility to create a custom CSS view using user rules.', 'my-style-anytime' ); ?></p>
        <p><?php _e( 'If you like this plugin it would be nice from your side to give us your rating and feedback.', 'my-style-anytime' ); ?>
 <a href="https://wordpress.org/support/plugin/my-style-anytime/reviews/#new-post" target="_blank" class="rate-star-filled">
    <span class="dashicons dashicons-star-empty"></span>
    <span class="dashicons dashicons-star-half"></span>
    <span class="dashicons dashicons-star-filled"></span>
    <span class="dashicons dashicons-star-filled"></span>
    <span class="dashicons dashicons-star-filled"></span>
 </a>
        </p>
        <p>
			<?php _e( 'For help, you have our ', 'my-style-anytime' ); ?>
            <a href="https://wordpress.org/plugins/my-style-anytime/#faq" target="_blank" class="faq-filled"><?php _e( 'FAQ', 'my-style-anytime' ); ?> <span class="dashicons dashicons-format-chat"></span></a>
			<?php _e( 'part, or if that does not help you can write your question in the', 'my-style-anytime' ); ?>
            <a href="https://wordpress.org/support/plugin/my-style-anytime/" target="_blank" class="help-filled"><?php _e( 'support sections.', 'my-style-anytime' ); ?> <span class="dashicons dashicons-sos"></span></a>.
        </p>
        <p>
	    <?php _e( 'We would be very pleased if you supported the advancement of this plugin with your ', 'my-style-anytime' ); ?>
        <a href="https://newfiesoft.com/donate/" target="_blank" class="donate-filled"><?php _e( 'donation', 'my-style-anytime' ); ?><span class="dashicons dashicons-heart"></span></a>.
        </p>

        <br>
		<?php _e( 'Enjoy your work', 'my-style-anytime' ); ?>... 🥳
    </div>

    <div class="power-by-info"><?php _e( 'Premium Tools for WordPress made by', 'my-style-anytime' ); ?> <a href="https://www.newfiesoft.com" target="_blank">NewfieSoft</a>
		<?php _e( 'with', 'my-style-anytime' ); ?> <img draggable="false" role="img" class="emoji" alt="❤" src="https://s.w.org/images/core/emoji/14.0.0/svg/2764.svg">
		<?php _e( 'in Zürich, Switzerland', 'my-style-anytime' ); ?>.</div>
	<?php

}

add_action( 'admin_menu', 'mysat_active_admin_menu' );
