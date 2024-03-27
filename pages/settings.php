<?php

/***
This is part of #Settings# configuration
 ***/

function mysat_settings_page(): void {

	add_settings_section(
		'mysat_settings_section',
		'',
		'',
		'mysat_settings_page'
	);

	add_settings_field(
		'mysat_disable_gutenberg',
		__('Disable Gutenberg Editor', 'my-style-anytime'), // Disable Gutenberg Editor
		'mysat_disable_gutenberg_callback',
		'mysat_settings_page',
		'mysat_settings_section'
	);
	
	register_setting( 'mysat_settings_group', 'mysat_disable_gutenberg' );
}

add_action( 'admin_init', 'mysat_settings_page' );


/**********
Generate HTML code on this page
**********/

function mysat_render_settings_page(): void {

	?>

    <div class="license-container">
        <h3 class="license-title" style="margin:0;"><i class="dashicons fa-solid fa-sliders"></i> <?php esc_html_e( 'Settings', 'my-style-anytime' ); ?></h3>
        <hr>
        <form id="mysat-settings-form" action="options.php" method="post" class="page_mysat_settings_page">
			<?php
			settings_fields( 'mysat_settings_group' );
			do_settings_sections( 'mysat_settings_page' );
			?>
            <button id="submit-mysat-settings-form" class="button button-primary"><?php esc_html_e( 'Save', 'my-style-anytime' ); ?></button>
        </form>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('mysat-settings-form');
                const submitButton = document.getElementById('submit-mysat-settings-form');

                submitButton.addEventListener('click', async function (event) {
                    event.preventDefault();

                    // Display SweetAlert confirmation dialog
                    const confirmed = await Swal.fire({
                        title: '<?php esc_html_e("Save Changes?", "my-style-anytime"); ?>',
                        text: '<?php esc_html_e("Are you sure you want to save changes?", "my-style-anytime"); ?>',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#2271b1',
                        cancelButtonColor: '#d33',
                        confirmButtonText: '<?php esc_html_e("Yes", "my-style-anytime"); ?>',
                        cancelButtonText: '<?php esc_html_e("Cancel", "my-style-anytime"); ?>',
                    }).then((result) => result.isConfirmed);

                    if (confirmed) {
                        // If user confirms, submit the form
                        form.submit();
                    }
                });
            });
        </script>
    </div>

	<?php
}

//// Show the inside page how can see what the action to disable Gutenberg
function mysat_disable_gutenberg_callback(): void {

	$remove_meta_gen = get_option( 'mysat_disable_gutenberg', false );
	echo '<label for="mysat_disable_gutenberg" class="function_name">';
	echo '<input type="checkbox" id="mysat_disable_gutenberg" name="mysat_disable_gutenberg" value="1" ' . checked( $remove_meta_gen, 1, false ) . ' />';
	echo '</label><div class="function_description">';
	echo esc_html__('With this, you Disable Gutenberg on your site and back to the classic editor, no matter where you are.', 'my-style-anytime');
	echo '</div>';
}
