<?php

/***
This is part of #Editor# configuration
 ***/

function mysat_editor_page(): void {

	add_settings_section(
		'mysat_editor_section',
		'',
		'',
		'mysat_editor_page'
	);

	register_setting('mysat_editor_group', '');
}

add_action('admin_init', 'mysat_editor_page');


//// Get CSS file content inside dir styles
function mysat_get_css_file_content(): void {

	// Check nonce
	check_ajax_referer('mysat_nonce_action', 'security');

	// Get plugin dir name
	$plugin_dir_path = my_style_anytime_plugin_dir_path();

	$file = sanitize_text_field($_POST['file']);
	$file_path = $plugin_dir_path . '/styles/' . $file;

	// Check if the file exists before attempting to read its content
	if (file_exists($file_path) && is_file($file_path)) {

		// Use WordPress file functions to get the content
		$file_content = implode('', file($file_path));

		// Output the cleaned file content
		echo esc_html($file_content);
		die();
	}

	// Handle the case where the file doesn't exist
	echo esc_html__('The CSS file was not found because it does not exist, you can generate it by clicking on the paint roller icon.', 'my-style-anytime');
	die();
}

add_action('wp_ajax_mysat_get_css_file_content', 'mysat_get_css_file_content');


//// Update CSS file content
function mysat_update_css_file_content(): void {

	// Check nonce
	check_ajax_referer('mysat_nonce_action', 'security');

	// Get plugin dir name
	$plugin_dir_path = my_style_anytime_plugin_dir_path();

	$file = sanitize_text_field($_POST['file']);
	$file_path = $plugin_dir_path . '/styles/' . $file;

	// Update the file content using WP_Filesystem
	if (function_exists('wp_filesystem')) {
		global $wp_filesystem;

		// Initialize the WordPress filesystem
		WP_Filesystem();

		// Check if the filesystem is initialized successfully
		if ($wp_filesystem) {
			$content = stripslashes($_POST['content']); // Unescape backslashes

			// Use WP_Filesystem method to write to the file
			$wp_filesystem->put_contents($file_path, $content, FS_CHMOD_FILE);

			// Output success response
			wp_send_json_success();
		}
	}

	// If we reach this point, something went wrong
	wp_send_json_error('Failed to update the file.');
}

add_action('wp_ajax_mysat_update_css_file_content', 'mysat_update_css_file_content');


/**********
Generate HTML code on this page
 **********/

function mysat_render_editor_page(): void {

	?>

    <div class="license-container">
        <h3 class="license-title" style="margin:0;"><i class="dashicons fa-solid fa-paint-roller"></i> <?php esc_html_e('Code Editor', 'my-style-anytime'); ?></h3>
        <hr>
        <div class="code-editor-description-page"><?php esc_html_e('Select below the CSS file who want to edit, and after complete just click on the button to submit the change.', 'my-style-anytime'); ?></div>

	    <?php

	    global $wp_roles;

	    // Get plugin dir name
	    $plugin_dir_path = my_style_anytime_plugin_dir_path();

	    // Specify the directory path
	    $cssDirectory = $plugin_dir_path . '/styles/';

	    // Fetch the list of files from the directory
	    $files = scandir($cssDirectory);

	    // Remove "." and ".." from the list
	    $files = array_diff($files, array('.', '..'));

	    // Filter files based on the ".css" extension
	    $cssFiles = array_filter($files, static function ($file) {
		    return pathinfo($file, PATHINFO_EXTENSION) === 'css';
	    });

	    // Check if there are any CSS files
	    echo '<ul class="list-css-files">';

	    // Flag to check if any CSS file is selected
	    $isCssFileSelected = false;

	    // Loop through each role and display information
	    foreach ($wp_roles->roles as $role_key => $role_data) {
		    // Check if 'name' key exists in role_data
		    if (isset($role_data['name'])) {
			    // Replace underscores with hyphens in the role name
			    $role_slug = str_replace('_', '-', $role_key);

			    // Check if there is a corresponding CSS file for the current role
			    $expectedFileName = $role_slug . '-style.css';
			    $file = in_array($expectedFileName, $cssFiles, true) ? $expectedFileName : ''; // Default value if not found

			    // Display 'OK' or 'NO' based on matching files
			    echo '<li class="select-css-file-item" data-file="' . esc_attr($file) . '"><a href="#" class="edit-link">' . esc_html($role_data['name']);
			    if (empty($file)) {
				    // File doesn't exist, show the link to generate the file
				    $tooltip = esc_attr__('Generate CSS File for', 'my-style-anytime');
				    $nonce_url = wp_nonce_url(admin_url('admin.php?page=mysat_editor_page&generate_file=' . esc_attr($role_slug)), 'generate_file_nonce');
				    echo ' <i class="fa-solid fa-circle-xmark"></i><a href="' . esc_url($nonce_url) . '" title="' . esc_attr($tooltip) . ' ' . esc_html($role_data['name']) . '"><i class="fa-solid fa-paint-roller"></i></a>';
			    } else {
				    // File exists, show the checkmark
				    echo ' <i class="fa-solid fa-circle-check"></i>';
				    // Set the flag as a CSS file is selected
				    $isCssFileSelected = true;
			    }
			    echo '</a></li>';
		    } else {
			    echo 'Name not available';
		    }
	    }

	    // Include the visitor-style.css explicitly in the list
	    $visitorFileName = 'visitor';
	    $expectedFileName = $visitorFileName . '-style.css';
	    $file = in_array($expectedFileName, $cssFiles, true) ? $expectedFileName : ''; // Default value if not found
	    $visitorFileExists = in_array($file, $cssFiles, true);
	    echo '<li class="select-css-file-item" data-file="' . esc_attr($file) . '"><a href="#" class="edit-link">' . esc_html__('Visitor Style', 'my-style-anytime');
	    if (!$visitorFileExists) {
        // File doesn't exist, show the link to generate the file only if it's not the initial page load
        $tooltip = esc_attr__('Generate Visitor CSS File', 'my-style-anytime');
        $nonce_url = wp_nonce_url(admin_url('admin.php?page=mysat_editor_page&generate_file=' . esc_attr($visitorFileName)), 'generate_file_nonce');
        echo ' <i class="fa-solid fa-circle-xmark"></i>';
        if (
            ! isset( $_GET['generate_file'], $_GET['_wpnonce'] )
            || $_GET['generate_file'] !== $visitorFileName ||
            ! wp_verify_nonce( $_GET['_wpnonce'], 'generate_file_nonce' ) )
        {
        // Display the link to generate the file only if it's not the initial page load and not already generated
		echo '<a href="' . esc_url($nonce_url) . '" title="' . esc_attr($tooltip) . ' ' . esc_html__('Visitor Style', 'my-style-anytime') . '"><i class="fa-solid fa-paint-roller"></i></a>';
		    }
	    }
        else {
		    // File exists, show the checkmark
		    echo ' <i class="fa-solid fa-circle-check"></i>';
		    // Set the flag as a CSS file is selected
		    $isCssFileSelected = true;
	    }
	    echo '</a></li>';

	    echo '</ul>';

	    // Container for CodeMirror
	    echo '<div id="codemirror-container"></div>';

	    // Display the "Save Changes" button only if a CSS file is selected
	    if ($isCssFileSelected) {
		    echo '<br><button id="submit-css-changes" class="button button-primary">' . esc_html__('Save Changes', 'my-style-anytime') . '</button><br>';
	    }

	    ?>

    </div>

    <script type="text/javascript">

        jQuery(document).ready(function ($) {
            let codemirror;
            let currentFileName = '';
            let selectedFile = ''; // Initialize without a default value

            let mysat_editor_script_vars = {
                ajaxurl: '<?php echo esc_url(admin_url('admin-ajax.php')); ?>',
                security: '<?php echo esc_attr(wp_create_nonce('mysat_nonce_action')); ?>'
            };

            $('.edit-link').on('click', function (e) {
                e.preventDefault();
                const fileName = $(this).parent().data('file');

                // Set the current file name
                currentFileName = fileName;

                // Set the selected file only if it's not an empty string (non-existent file)
                if (fileName.trim() !== '') {
                    selectedFile = fileName;
                }
                else {
                    selectedFile = ''; // Reset selectedFile when no valid file is selected
                }

                $.ajax({
                    url: mysat_editor_script_vars.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'mysat_get_css_file_content',
                        file: fileName,
                        security: mysat_editor_script_vars.security,
                    },
                    success: function (response) {
                        // Initialize CodeMirror if not already initialized
                        if (!codemirror) {
                            codemirror = CodeMirror(document.getElementById('codemirror-container'), {
                                lineNumbers: true,
                                theme: 'monokai',
                                readOnly: false,
                                editable: true,
                                autoCloseTags: true,
                                autoCloseBrackets: true,
                                mode: 'css',
                                extraKeys: { "Ctrl-Space": "autocomplete" },
                            });

                            // Enable autocompletion
                            codemirror.showHint({
                                hint: CodeMirror.hint.css,
                                completeSingle: true,
                            });

                            // Add event listener for the submit button
                            $('#submit-css-changes').on('click', function () {
                                const cssContent = codemirror.getValue();
                                updateCSSFile(currentFileName, cssContent);
                            });
                        }

                        // Set the response content to CodeMirror
                        codemirror.setValue(response);

                        // Show or hide the "Save Changes" button based on CSS content
                        toggleSaveChangesButton(response !== 'false');
                    },
                });
            });

            function toggleSaveChangesButton(shouldShowButton) {

                const saveChangesButton = $('#submit-css-changes');

                // Check if any CSS file is selected and it exists
                if (shouldShowButton && selectedFile.trim() !== '') {
                    saveChangesButton.prop('disabled', false).show();
                }
                else {
                    saveChangesButton.prop('disabled', true).hide();
                }
            }

            // Initial check to hide the button on page load
            toggleSaveChangesButton(false);

            function updateCSSFile(fileName, cssContent) {
                // Decode the content before sending it to the server
                const decodedContent = decodeURIComponent(cssContent);

                $.ajax({
                    url: mysat_editor_script_vars.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'mysat_update_css_file_content',
                        file: fileName,
                        content: decodedContent,
                        security: mysat_editor_script_vars.security,
                    },
                    success: function () {
                        // Display SweetAlert2 success message
                        Swal.fire({
                            icon: 'success',
                            confirmButtonColor: '#2271b1',
                            title: '<?php esc_html_e("Success", "my-style-anytime"); ?>',
                            text: '<?php esc_html_e("The file was updated successfully!", "my-style-anytime"); ?>',
                            confirmButtonText: '<?php esc_html_e("OK", "my-style-anytime"); ?>',
                        }).then(() => {
                            // Refresh the page
                            location.reload();
                        });
                    },
                    error: function (error) {
                        // Display SweetAlert2 error message
                        Swal.fire({
                            icon: 'error',
                            confirmButtonColor: '#2271b1',
                            title: '<?php esc_html_e("Error", "my-style-anytime"); ?>',
                            text: '<?php esc_html_e("Error updating file: ", "my-style-anytime"); ?>' + error.responseText,
                            confirmButtonText: '<?php esc_html_e("OK", "my-style-anytime"); ?>',
                        });
                    },
                });
            }
        });

    </script>

	<?php
}