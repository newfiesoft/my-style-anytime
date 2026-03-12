<?php
//pages/customization.php

defined('ABSPATH') or exit();

function mysat_render_custom_page(): void {

	// Check user capabilities
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_safe_redirect( admin_url() );
		exit;
	}

	$settings_saved = false;

	// Handle form submissions for updating settings
	if ( isset( $_POST['mysat_login_settings_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['mysat_login_settings_nonce'] ) ), 'mysat_login_settings_action' ) ) {

		// Use temporary variables to store submitted values
		$new_custom_logo     = isset($_POST['mysat_custom_login_logo']) ? esc_url_raw( wp_unslash( $_POST['mysat_custom_login_logo'] ) ) : '';
		$new_custom_bg_color = isset($_POST['mysat_custom_bg_color']) ? sanitize_hex_color( wp_unslash( $_POST['mysat_custom_bg_color'] ) ) : '#ffffff';
		$new_custom_bg_image = isset($_POST['mysat_custom_login_bg_image']) ? esc_url_raw( wp_unslash( $_POST['mysat_custom_login_bg_image'] ) ) : '';

		// New options for login URL and title
		$new_custom_login_url   = isset($_POST['mysat_custom_login_url']) ? esc_url_raw( wp_unslash($_POST['mysat_custom_login_url']) ) : '';
		$new_custom_login_title = isset($_POST['mysat_custom_login_title']) ? sanitize_text_field( wp_unslash($_POST['mysat_custom_login_title']) ) : '';

		// Update options using the temporary variables
		update_option( 'mysat_custom_login_logo', $new_custom_logo );
		update_option( 'mysat_custom_bg_color', $new_custom_bg_color );
		update_option( 'mysat_custom_login_bg_image', $new_custom_bg_image );

		update_option( 'mysat_custom_login_url', $new_custom_login_url );
		update_option( 'mysat_custom_login_title', $new_custom_login_title );

		// Flag that settings have been saved
		$settings_saved = true;
	}

	// Retrieve existing settings after handling form submissions
	$custom_logo          = get_option( 'mysat_custom_login_logo', '' );
	$custom_bg_color      = get_option( 'mysat_custom_bg_color', '#ffffff' );
	$custom_bg_image      = get_option( 'mysat_custom_login_bg_image', '' );
	$custom_login_url     = get_option( 'mysat_custom_login_url', '' );
	$custom_login_title   = get_option( 'mysat_custom_login_title', '' );
	?>

    <div class="license-container">
        <h3 class="license-title" style="margin:0;"><i class="dashicons fa-solid fa-list-check"></i> <?php esc_html_e( 'Customization', 'my-style-anytime' ); ?></h3>
        <hr>
        <form method="post" action="" id="mysat-customization-form">
			<?php
			// Security nonce
			wp_nonce_field( 'mysat_login_settings_action', 'mysat_login_settings_nonce' );
			?>

            <table class="form-table">
                <!-- Existing fields for Logo, Background Image, Color -->
                <tr>
                    <th scope="row"><?php esc_html_e( 'Custom Login Logo', 'my-style-anytime' ); ?></th>
                    <td>
                        <div class="custom-logo-container">
                            <img id="mysat-logo-preview"
                                 src="<?php echo esc_url( $custom_logo ); ?>"
                                 alt="<?php esc_attr_e( 'Custom Login Logo', 'my-style-anytime' ); ?>"
                                 style="max-width: 200px; <?php echo empty( $custom_logo ) ? 'display: none;' : ''; ?>" />
                            <br />
                            <input type="hidden" name="mysat_custom_login_logo" id="mysat_custom_login_logo" value="<?php echo esc_attr( $custom_logo ); ?>" />
                            <button type="button" class="button" id="mysat_upload_logo_button"><?php esc_html_e( 'Upload Logo', 'my-style-anytime' ); ?></button>
                            <button type="button" class="button" id="mysat_remove_logo_button" <?php echo empty( $custom_logo ) ? 'style="display:none;"' : ''; ?>>
								<?php esc_html_e( 'Remove Logo', 'my-style-anytime' ); ?>
                            </button>
                        </div>
                        <p class="description"><?php esc_html_e( 'Upload or select an image from the Media Library to use as your custom login logo.', 'my-style-anytime' ); ?></p>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><?php esc_html_e( 'Custom Background Image', 'my-style-anytime' ); ?></th>
                    <td>
                        <div class="custom-bg-container">
                            <img id="mysat-bg-preview"
                                 src="<?php echo esc_url( $custom_bg_image ); ?>"
                                 alt="<?php esc_attr_e( 'Custom Background Image', 'my-style-anytime' ); ?>"
                                 style="max-width: 200px; <?php echo empty( $custom_bg_image ) ? 'display: none;' : ''; ?>" />
                            <br />
                            <input type="hidden" name="mysat_custom_login_bg_image" id="mysat_custom_login_bg_image" value="<?php echo esc_attr( $custom_bg_image ); ?>" />
                            <button type="button" class="button" id="mysat_upload_bg_button"><?php esc_html_e( 'Upload Background Image', 'my-style-anytime' ); ?></button>
                            <button type="button" class="button" id="mysat_remove_bg_button" <?php echo empty( $custom_bg_image ) ? 'style="display:none;"' : ''; ?>>
								<?php esc_html_e( 'Remove Background Image', 'my-style-anytime' ); ?>
                            </button>
                        </div>
                        <p class="description"><?php esc_html_e( 'Upload or select an image from the Media Library to use as your custom login background.', 'my-style-anytime' ); ?></p>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label for="mysat_custom_bg_color"><?php esc_html_e( 'Custom Background Color', 'my-style-anytime' ); ?></label></th>
                    <td>
                        <input type="text" name="mysat_custom_bg_color" id="mysat_custom_bg_color" value="<?php echo esc_attr( $custom_bg_color ); ?>" class="regular-text my-color-field" data-default-color="#ffffff" />
                        <p class="description"><?php esc_html_e( 'Select a background color for the login page.', 'my-style-anytime' ); ?></p>
                    </td>
                </tr>

                <!-- New fields for Login URL and Title -->
                <tr>
                    <th scope="row"><label for="mysat_custom_login_url"><?php esc_html_e( 'Custom Login URL', 'my-style-anytime' ); ?></label></th>
                    <td>
                        <input type="url" name="mysat_custom_login_url" id="mysat_custom_login_url" value="<?php echo esc_url( $custom_login_url ); ?>" class="regular-text" />
                        <p class="description"><?php esc_html_e( 'Set the URL the login logo should link to.', 'my-style-anytime' ); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="mysat_custom_login_title"><?php esc_html_e( 'Custom Login Title', 'my-style-anytime' ); ?></label></th>
                    <td>
                        <input type="text" name="mysat_custom_login_title" id="mysat_custom_login_title" value="<?php echo esc_attr( $custom_login_title ); ?>" class="regular-text" />
                        <p class="description"><?php esc_html_e( 'Set the title tooltip for the login logo.', 'my-style-anytime' ); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php esc_html_e( 'Custom CSS Style', 'my-style-anytime' ); ?></th>
                    <td><?php esc_html_e( 'If you want to additionally customize with css file you can use which is located in.', 'my-style-anytime' ); ?> <b>/assets/css/style-login.css</b>
                    </td>
                </tr>
            </table>

			<?php submit_button( __( 'Save', 'my-style-anytime' ), 'primary', 'submit-mysat-settings-form' ); ?>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('mysat-customization-form');
            const submitButton = document.getElementById('submit-mysat-settings-form');

            if (submitButton && typeof Swal !== 'undefined') {
                submitButton.addEventListener('click', function (event) {
                    event.preventDefault();
                    Swal.fire({
                        title: '<?php esc_html_e("Save Changes?", "my-style-anytime"); ?>',
                        text: '<?php esc_html_e("Are you sure you want to save changes?", "my-style-anytime"); ?>',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#2271b1',
                        cancelButtonColor: '#d33',
                        confirmButtonText: '<?php esc_html_e("Yes", "my-style-anytime"); ?>',
                        cancelButtonText: '<?php esc_html_e("Cancel", "my-style-anytime"); ?>',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            }
        });
    </script>

	<?php if ( $settings_saved ) : ?>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        confirmButtonColor: '#2271b1',
                        title: '<?php esc_html_e("Success", "my-style-anytime"); ?>',
                        text: '<?php esc_html_e("Settings saved successfully.", "my-style-anytime"); ?>',
                        confirmButtonText: '<?php esc_html_e("OK", "my-style-anytime"); ?>'
                    });
                }
            });
        </script>
	<?php endif; ?>

	<?php
}
