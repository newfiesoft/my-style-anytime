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
        <h3 class="license-title" style="margin:0;"><i class="dashicons fa-solid fa-circle-info"></i> <?php esc_html_e( 'Welcome', 'my-style-anytime' ); ?></h3>
        <hr>
        <p style="padding-top:10px;"><?php esc_html_e( 'Hi,', 'my-style-anytime' ); ?></p>
        <p><?php esc_html_e( 'We are honored that you decided to use our plugin.', 'my-style-anytime' ); ?></p>
        <p><?php esc_html_e( 'As you read before installing and activating this plugin with him, you can create a custom CSS view using user roles.', 'my-style-anytime' ); ?></p>
        <p><?php esc_html_e( 'If you like this plugin it would be nice from your side to give us your rating and feedback.', 'my-style-anytime' ); ?>
            <a href="https://wordpress.org/support/plugin/my-style-anytime/reviews/#new-post" target="_blank" class="rate-star-filled">
                <i class="fa-regular fa-star"></i>
                <i class="fa-solid fa-star-half-stroke"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
            </a>
        </p>
        <p>
			<?php esc_html_e( 'For help, you have our ', 'my-style-anytime' ); ?>
            <a href="https://wordpress.org/plugins/my-style-anytime/#faq" target="_blank" class="faq-filled"><?php esc_html_e( 'FAQ', 'my-style-anytime' ); ?> <i class="fa-solid fa-comments"></i></a>
			<?php esc_html_e( 'part, or if that does not help you can write your question in the', 'my-style-anytime' ); ?>
            <a href="https://wordpress.org/support/plugin/my-style-anytime/" target="_blank" class="help-filled"><?php esc_html_e( 'support sections', 'my-style-anytime' ); ?> <i class="fa-regular fa-life-ring"></i></a> .
        </p>
        <p>
			<?php esc_html_e( 'We would be very pleased if you supported the advancement of this plugin with your ', 'my-style-anytime' ); ?>
            <a href="https://newfiesoft.com/donate/" target="_blank" class="donate-filled"><?php esc_html_e( 'donation', 'my-style-anytime' ); ?> <i class="fa-solid fa-hand-holding-dollar"></i></a> .
        </p>

        <br>
		<?php esc_html_e( 'Enjoy your work', 'my-style-anytime' ); ?>... <i class="fa-solid fa-handshake"></i>
    </div>

	<?php
}
