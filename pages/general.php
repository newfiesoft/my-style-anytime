<?php

/***
This is part of #General# configuration
 ***/

function mysat_general_page(): void {
	add_settings_section(
		'mysat_general_section',
		'',
		'',
		'my-style-anytime'
	);
}

add_action( 'admin_init', 'mysat_general_page' );


/**********
Generate HTML code on this page
**********/
function mysat_render_general_page(): void {

	?>
    <div class="license-container">
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

	<?php
}
