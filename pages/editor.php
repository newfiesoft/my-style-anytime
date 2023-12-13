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


//// This is Editor plugin files JavaScript and CSS files load only on this page

function mysat_plugin_code_editor_page_script(): void {

	// Get plugin dir url name
	$plugin_dir_url = get_my_style_anytime_directory_url();

	// Check if we are on one of your plugin's pages
	$current_page = isset($_GET['page']) ? sanitize_text_field($_GET['page']) : '';

	// Add page URL slug from any page what have
	$allowed_pages = array(
		'mysat_editor_page',
	);

	if (in_array($current_page, $allowed_pages)) {

		// Enqueue Codemirror library and CSS for styling
		wp_enqueue_script('codemirror-library', $plugin_dir_url . 'assets/addons/codemirror/lib/codemirror.min.js', array('jquery'), null, true);

		wp_enqueue_style('codemirror', $plugin_dir_url . 'assets/addons/codemirror/lib/codemirror.css');

		// Load CodeMirror add-ons for autocompletion and CSS for styling
		wp_enqueue_script('codemirror-hint-js', $plugin_dir_url . 'assets/addons/codemirror/addon/hint/show-hint.js', array('codemirror-library'), null, true);

		wp_enqueue_style('codemirror-hint', $plugin_dir_url . 'assets/addons/codemirror/addon/hint/show-hint.css');

		// Load CodeMirror add-on for autocompletion in CSS
		wp_enqueue_script('codemirror-hint-css-js', $plugin_dir_url . 'assets/addons/codemirror/addon/hint/css-hint.js', array('codemirror-hint-js'), null, true);

		// Load CodeMirror CSS theme (you can choose a different theme)
		wp_enqueue_style('codemirror-theme', $plugin_dir_url . 'assets/addons/codemirror/theme/monokai.css');

		// Load CodeMirror CSS mode
		wp_enqueue_script('codemirror-css-mode', $plugin_dir_url . 'assets/addons/codemirror/mode/css/css.js', array('codemirror-library'), null, true);


		// Localize the script with the AJAX URL and nonce
		wp_localize_script('codemirror-library', 'mysat_editor_script_vars', array(
			'ajaxurl'  => admin_url('admin-ajax.php'),
			'security' => wp_create_nonce('my_nonce_action'),
		));
	}
}

add_action('admin_enqueue_scripts', 'mysat_plugin_code_editor_page_script');


//// Get CSS file content inside dir styles

function mysat_get_css_file_content(): void {

	// Set the correct MIME type
	header('Content-Type: text/css');

	// Get plugin dir name
	$plugin_dir_path = get_my_style_anytime_plugin_dir_path();

	$file = sanitize_text_field($_POST['file']);
	$file_path = $plugin_dir_path . '/styles/' . $file;

	// Read file content and remove any extra characters
	$file_content = file_get_contents($file_path);
	$file_content = trim($file_content);

	// Output the cleaned file content
	echo $file_content;
	die(); // or wp_die() if you prefer
}

add_action('wp_ajax_mysat_get_css_file_content', 'mysat_get_css_file_content');


//// Update CSS file content

function mysat_update_css_file_content(): void {
	check_ajax_referer('my_nonce_action', 'security');

	// Get plugin dir name
	$plugin_dir_path = get_my_style_anytime_plugin_dir_path();

	$file = sanitize_text_field($_POST['file']);
	$file_path = $plugin_dir_path . '/styles/' . $file;

	// Update the file content
	$content = stripslashes($_POST['content']); // Unescape backslashes
	file_put_contents($file_path, $content);

	die(); // or wp_die() if you prefer
}

add_action('wp_ajax_mysat_update_css_file_content', 'mysat_update_css_file_content');


/**********
 Generate HTML code on this page
**********/

function mysat_render_editor_page(): void {

	// Get plugin dir name
	$plugin_dir_path = get_my_style_anytime_plugin_dir_path();

	?>

    <div class="license-container">
        <h3 class="license-title" style="margin:0;"><i class="dashicons dashicons-info-outline"></i> <?php _e('Code Editor', 'my-style-anytime'); ?></h3>
        <hr>
        <div class="code-editor-description"><?php _e('Select below the CSS file who want to edit, and after complete just click on the button to submit the change.', 'my-style-anytime'); ?></div>
		<?php
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
		if (count($cssFiles) > 0) {
			// Create an unordered list to display the CSS files
			echo '<ul class="list-css-files">';
			foreach ($cssFiles as $file) {
				echo '<li class="select-css-file-item" data-file="' . $file . '"><a href="#" class="edit-link">' . $file . '</a></li>';
			}
			echo '</ul>';

			// Container for CodeMirror
			echo '<div id="codemirror-container"></div>';
		} else {
			// Display a message if no CSS files are found
			echo '<p>No CSS files found in the directory.</p>';
		}
		?>
        <br><button id="submit-css-changes" class="button button-primary"><?php _e('Save Changes', 'my-style-anytime'); ?></button><br>
    </div>

    <script type="text/javascript">

        jQuery(document).ready(function ($) {
            let codemirror;
            let currentFileName = '';

            let mysat_editor_script_vars = {
                ajaxurl: '<?php echo admin_url('admin-ajax.php'); ?>',
                security: '<?php echo wp_create_nonce('my_nonce_action'); ?>'
            };

            $('.edit-link').on('click', function (e) {
                e.preventDefault();
                const fileName = $(this).parent().data('file');

                // Set the current file name
                currentFileName = fileName;

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
                    },
                });
            });

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
                            title: '<?php _e('Success', 'my-style-anytime'); ?>',
                            text: '<?php _e('File updated successfully!', 'my-style-anytime'); ?>',
                            confirmButtonText: 'OK',
                        }).then(() => {
                            // Refresh the page
                            location.reload();
                        });
                    },
                    error: function (error) {
                        // Display SweetAlert2 error message
                        Swal.fire({
                            icon: 'error',
                            title: '<?php _e('Error', 'my-style-anytime'); ?>',
                            text: '<?php _e('Error updating file:', 'my-style-anytime'); ?> ' + error.responseText,
                            confirmButtonText: 'OK',
                        });
                    },
                });
            }
        });

    </script>

	<?php
}
