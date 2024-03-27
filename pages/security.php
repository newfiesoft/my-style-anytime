<?php

/***
This is part of #Security# configuration
 ***/

function mysat_security_page(): void {

	add_settings_section(
		'mysat_security_section',
		'',
		'',
		'mysat_security_page'
	);

	add_settings_field(
		'mysat_remove_meta_generator',
		__('Remove meta generator', 'my-style-anytime'), // Remove meta generator
		'mysat_remove_meta_generator_callback',
		'mysat_security_page',
		'mysat_security_section'
	);

	register_setting( 'mysat_security_group', 'mysat_remove_meta_generator' );
}

add_action( 'admin_init', 'mysat_security_page' );


/**********
Generate HTML code on this page
**********/

function mysat_render_security_page(): void {

	?>

    <div class="license-container">
        <h3 class="license-title" style="margin:0;"><i class="dashicons fa-solid fa-eye-slash"></i> <?php esc_html_e( 'Security', 'my-style-anytime' ); ?></h3>
        <hr>
        <form id="mysat-security-form" action="options.php" method="post" class="page_mysat_security_page">
		    <?php
		    settings_fields( 'mysat_security_group' );
		    do_settings_sections( 'mysat_security_page' );
		    ?>
            <button id="submit-mysat-security-form" class="button button-primary"><?php esc_html_e( 'Save', 'my-style-anytime' ); ?></button>
        </form>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('mysat-security-form');
                const submitButton = document.getElementById('submit-mysat-security-form');

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

//// Show the inside page how can see what the action to remove the meta generator
function mysat_remove_meta_generator_callback(): void {

	$remove_meta_gen = get_option( 'mysat_remove_meta_generator', false );
	echo '<label for="mysat_remove_meta_generator" class="function_name">';
	echo '<input type="checkbox" id="mysat_remove_meta_generator" name="mysat_remove_meta_generator" value="1" ' . checked( $remove_meta_gen, 1, false ) . ' />';
	echo '</label><div class="function_description">';
	echo esc_html__('Removing the meta generator, helps you to hide the version of WordPress that you are using from potential attackers.', 'my-style-anytime');
	echo '</div>';
}
