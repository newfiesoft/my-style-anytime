<?php

/***
This is part of #Customization# configuration
 ***/

function mysat_custom_page(): void {

	add_settings_section(
		'mysat_custom_section',
		'',
		'',
		'mysat_custom_page'
	);

	add_settings_field(
		'mysat_remove_wp_title',
		__('Remove WordPress from the title', 'my-style-anytime'), // Remove "WordPress" from title
		'mysat_remove_wp_title_callback',
		'mysat_custom_page',
		'mysat_custom_section'
	);

	register_setting( 'mysat_custom_group', 'mysat_remove_wp_title' );
}

add_action( 'admin_init', 'mysat_custom_page' );


/**********
Generate HTML code on this page
**********/

function mysat_render_custom_page(): void {

	?>

    <div class="license-container">
        <h3 class="license-title" style="margin:0;"><i class="dashicons fa-solid fa-list-check"></i> <?php esc_html_e( 'Customization', 'my-style-anytime' ); ?></h3>
        <hr>
        <form id="mysat-custom-form" action="options.php" method="post" class="page_mysat_custom_page">
			<?php
			settings_fields( 'mysat_custom_group' );
			do_settings_sections( 'mysat_custom_page' );
			?>
            <button id="submit-mysat-custom-form" class="button button-primary"><?php esc_html_e( 'Save', 'my-style-anytime' ); ?></button>
        </form>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('mysat-custom-form');
                const submitButton = document.getElementById('submit-mysat-custom-form');

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

//// Show the inside page how can see what the action to remove the wordpress title
function mysat_remove_wp_title_callback(): void {

	$remove_meta_gen = get_option( 'mysat_remove_wp_title', false );
	echo '<label for="mysat_remove_wp_title" class="function_name">';
	echo '<input type="checkbox" id="mysat_remove_wp_title" name="mysat_remove_wp_title" value="1" ' . checked( $remove_meta_gen, 1, false ) . ' />';
	echo '</label><div class="function_description">';
	echo esc_html__('From the website title displayed in a browser tab and dashboard, and wp-login.php for enhanced branding and security.', 'my-style-anytime');
	echo '</div>';
}
