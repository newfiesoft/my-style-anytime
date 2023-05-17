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
        <p><?php _e( 'This is', 'my-style-anytime' ); ?><strong class="lite">
				<?php _e( 'Lite Version,', 'my-style-anytime' ); ?></strong>
			<?php _e( 'and you have full WordPress default user rules support.', 'my-style-anytime' ); ?></p>
        <p><?php _e( 'If you like this plugin and you need other plugins user roles in plugins like as is WooCommerce or others who have user roles', 'my-style-anytime' ); ?>.</p>
        <p>
			<?php _e( 'Visit our site for a premium offer', 'my-style-anytime' ); ?>
            <a href="https://newfiesoft.com/plugins/my-style-anytime/" target="_blank"><?php _e( 'here', 'my-style-anytime' ); ?></a>
			<?php _e( ', for a single or multi-site with one single license key', 'my-style-anytime' ); ?>.</p>
        <br>
		<?php _e( 'Enjoy your work', 'my-style-anytime' ); ?>... 🥳
    </div>

    <div class="power-by-info"><?php _e( 'Premium Tools for WordPress made by', 'my-style-anytime' ); ?> <a href="https://www.newfiesoft.com" target="_blank">NewfieSoft</a>
		<?php _e( 'with', 'my-style-anytime' ); ?> <img draggable="false" role="img" class="emoji" alt="❤" src="https://s.w.org/images/core/emoji/14.0.0/svg/2764.svg">
		<?php _e( 'in Zürich, Switzerland', 'my-style-anytime' ); ?>.</div>
	<?php

}

add_action( 'admin_menu', 'mysat_active_admin_menu' );
