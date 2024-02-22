<?php

/***
This is part of #Backup# configuration
 ***/

function mysat_backup_page(): void {

	add_settings_section(
		'mysat_backup_section',
		'',
		'',
		'mysat_backup_page'
	);

	register_setting('mysat_backup_group', '');
}

add_action('admin_init', 'mysat_backup_page');


//// The main trigger for all case scenarios is what needs to happen on this page
function mysat_backup_restore_actions(): void {

	if (isset($_POST['_wpnonce'], $_POST['action'])) {
		$wpnonce = $_POST['_wpnonce'];
		$action = $_POST['action'];

		if (wp_verify_nonce($wpnonce, 'mysat_backup_nonce') && $action === 'mysat_backup') {
			// Backup logic
			$backupPath = mysat_create_backup();
			if ($backupPath) {
				// Trigger SweetAlert2 notification for successful backup
				?>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                icon: 'success',
                confirmButtonColor: '#2271b1',
                title: '<?php esc_html_e("Backup Successful", "my-style-anytime"); ?>',
                text: '<?php esc_html_e("Styles successfully backed up.", "my-style-anytime"); ?>',
                confirmButtonText: '<?php esc_html_e("OK", "my-style-anytime"); ?>',
                    });
                });
            </script>
				<?php
			} else {
				echo '<div class="notice notice-error"><p>' . esc_html__('Failed to create a backup.', 'my-style-anytime') . '</p></div>';
			}
		}

        elseif (wp_verify_nonce($wpnonce, 'mysat_restore_nonce') && $action === 'mysat_restore') {
			// Restore logic
			$backupFile = sanitize_file_name($_POST['backup_file']);
			$restoreResult = mysat_restore_backup($backupFile);
			// Trigger SweetAlert2 notification based on restore result
			?>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                <?php if ($restoreResult): ?>
                Swal.fire({
                icon: 'success',
                confirmButtonColor: '#2271b1',
                title: '<?php esc_html_e("Restore Successful", "my-style-anytime"); ?>',
                text: '<?php esc_html_e("Styles successfully restored.", "my-style-anytime"); ?>',
                confirmButtonText: '<?php esc_html_e("OK", "my-style-anytime"); ?>',
                    });
			        <?php else: ?>
                Swal.fire({
                icon: 'error',
                confirmButtonColor: '#2271b1',
                title: '<?php esc_html_e("Restore Failed", "my-style-anytime"); ?>',
                text: '<?php esc_html_e("Failed to restore styles.", "my-style-anytime"); ?>',
                confirmButtonText: '<?php esc_html_e("OK", "my-style-anytime"); ?>',
                    });
			        <?php endif; ?>
                });
            </script>
			<?php
		}

        elseif (wp_verify_nonce($wpnonce, 'mysat_delete_nonce') || $action === 'mysat_delete') {
			// Delete logic
			$backupFile = sanitize_file_name($_POST['backup_file']);
			$deleteResult = mysat_delete_backup($backupFile);
			// Trigger SweetAlert2 notification based on delete result
			?>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
					<?php if ($deleteResult): ?>
                Swal.fire({
                icon: 'success',
                confirmButtonColor: '#2271b1',
                title: '<?php esc_html_e("Delete Successful", "my-style-anytime"); ?>',
                text: '<?php esc_html_e("The backup file was successfully deleted.", "my-style-anytime"); ?>',
                confirmButtonText: '<?php esc_html_e("OK", "my-style-anytime"); ?>',
                    });
                    }).then(function () {
                        // Reload the page after deletion
                        location.reload();
                    });
					<?php else: ?>
                Swal.fire({
                icon: 'error',
                confirmButtonColor: '#2271b1',
                title: '<?php esc_html_e("Delete Failed", "my-style-anytime"); ?>',
                text: '<?php esc_html_e("Failed to delete backup file.", "my-style-anytime"); ?>',
                confirmButtonText: '<?php esc_html_e("OK", "my-style-anytime"); ?>',
                    });
					<?php endif; ?>
            </script>
			<?php
		}
	}
}

add_action('admin_init', 'mysat_backup_restore_actions');


//// This catch-all *.css from dir styles and creates a backup *.zip file inside wp-content/mysat_backup
function mysat_create_backup(): string {

	// Include the WordPress Filesystem API
	include_once ABSPATH . 'wp-admin/includes/file.php';
	WP_Filesystem();

	// Get plugin dir name
	$plugin_dir_path = get_my_style_anytime_plugin_dir_path();

	$stylesFolderPath = $plugin_dir_path . 'styles';

	// Use WP_CONTENT_DIR to get the content directory path
	$content_dir = WP_CONTENT_DIR;
	$backupDir = $content_dir . '/mysat_backup/';

	// Get date and time format settings from WordPress options
	$date_format = get_option('date_format');
	$time_format = get_option('time_format');

	// Generate backup file name based on date and time format
	$backupFileName = 'styles_full_' . sanitize_file_name(date_i18n($date_format . '_' . $time_format)) . '.zip';
	$backupPath = $backupDir . $backupFileName;

	if (!file_exists($stylesFolderPath) || !is_dir($stylesFolderPath)) {
		throw new RuntimeException(sprintf('Directory "%s" does not exist', esc_html($stylesFolderPath)));
	}

	if (wp_mkdir_p($backupDir) === false) {
		// Handle the error, log, or throw an exception as needed
		throw new RuntimeException('Failed to create backup directory.');
	}

	// Generate a temporary backup file name
	$tempBackupPath = $backupDir . 'temp_' . uniqid('', true) . '.zip';

	$zip = new ZipArchive();

	if ($zip->open($tempBackupPath, ZipArchive::CREATE) === true) {
		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($stylesFolderPath));

		foreach ($iterator as $file) {
			$file = realpath($file);
			$relativePath = str_replace($stylesFolderPath . '/', '', $file);

			if (is_file($file) && pathinfo($file, PATHINFO_EXTENSION) === 'css') {
				// Use the WordPress Filesystem API to get file contents
				global $wp_filesystem;

				if (!$wp_filesystem->is_readable($file)) {
					// Handle the error, log, or throw an exception as needed
					throw new RuntimeException('Failed to read file contents. File is not readable: ' . esc_html($file));
				}

				$file_content = $wp_filesystem->get_contents($file);

				if ($file_content !== false) {
					$zip->addFromString($relativePath, $file_content);
				} else {
					// Handle the error, log, or throw an exception as needed
					throw new RuntimeException('Failed to get file contents.');
				}
			}
		}

		$zip->close();
	}

	// Rename the temporary backup file to the final name
	if (wp_mkdir_p(dirname($backupPath)) === false) {
		// Handle the error, log, or throw an exception as needed
		throw new RuntimeException('Failed to create backup directory.');
	}

	if (!copy($tempBackupPath, $backupPath)) {
		// Handle the error, log, or throw an exception as needed
		throw new RuntimeException('Failed to move the backup file.');
	}

	// Delete the temporary backup file
	if (file_exists($tempBackupPath)) {
		wp_delete_file($tempBackupPath);
	}

	return $backupPath;
}


//// This catch-all *.css from .zip and restore file inside wp-content/plugins/my-style-anytime/styles
function mysat_restore_backup(string $backupFile): bool {

	// Get plugin dir name
	$plugin_dir_path = get_my_style_anytime_plugin_dir_path();

	$stylesFolderPath = $plugin_dir_path . 'styles';

	$backupDir = WP_CONTENT_DIR . '/mysat_backup/';

	$backupPath = $backupDir . $backupFile;

	// Ensure the backup file exists
	if (!file_exists($backupPath)) {
		return false;
	}

	$zip = new ZipArchive();

	// Open the backup file
	if ($zip->open($backupPath) === true) {
		// Extract all CSS files directly to the styles directory
		for ($i = 0; $i < $zip->numFiles; $i++) {
			$filename = $zip->getNameIndex($i);

			// Check if the file is a CSS file
			if (pathinfo($filename, PATHINFO_EXTENSION) === 'css') {
				$zip->extractTo($stylesFolderPath, $filename);
			}
		}

		// Close the zip file
		$zip->close();

		return true;
	}

	return false;
}


//// This delete select *.zip file from wp-content/mysat_backup
function mysat_delete_backup(string $backupFile): bool {

	$backupDir = WP_CONTENT_DIR . '/mysat_backup/';
	$backupPath = $backupDir . $backupFile;

	// Ensure the backup file exists
	if (file_exists($backupPath)) {
		// Attempt to delete the file using wp_delete_file
		global $wp_filesystem;
		WP_Filesystem(); // Initialize the WP filesystem

		if ($wp_filesystem->delete($backupPath)) {
			return true; // File deletion successful
		}

	}

	return false; // File does not exist
}


/**********
Generate HTML code on this page
 **********/

function mysat_render_backup_page(): void {

	?>

    <div class="license-container">
        <h3 class="license-title" style="margin:0;"><i class="dashicons fa-solid fa-box-archive"></i> <?php esc_html_e('Backup / Restore', 'my-style-anytime'); ?></h3>
        <hr>
        <div class="backup-description-page"><?php esc_html_e('Here you can create a backup anytime for all styles that you create and restore, all archive files have been storage inside', 'my-style-anytime'); ?> <b>/wp-content/mysat_backup</b></div>

        <div class="backup-buttom-content">
            <form method="post" action="">
				<?php wp_nonce_field('mysat_backup_nonce'); ?>
                <input type="hidden" name="action" value="mysat_backup">
                <button type="submit" class="button button-primary"><?php esc_html_e('Backup Styles', 'my-style-anytime'); ?></button>
            </form>
        </div>

		<?php

		// Check if there are backup files in the first directory
		$backupDir = WP_CONTENT_DIR . '/mysat_backup/';
		$backupFiles = glob($backupDir . 'styles_full_*.zip');

		// Display backup lists and "Restore Styles" and "Delete" buttons
		if (!empty($backupFiles)) {
			?>
            <div class="backup-list">
                <h4><?php esc_html_e('List Backup zip files', 'my-style-anytime'); ?></h4>
	            <?php
	            foreach ($backupFiles as $backupFile) {
		            $backupFileName = basename($backupFile);
		            ?>
                    <div class="backup-item">
                    <span><?php echo esc_html($backupFileName); ?></span>
                        <form method="post" action="" class="restore-button">
							<?php wp_nonce_field('mysat_restore_nonce'); ?>
                            <input type="hidden" name="action" value="mysat_restore">
                            <input type="hidden" name="backup_file" value="<?php echo esc_attr($backupFileName); ?>">
                            <button type="submit" class="button button-primary"><?php esc_html_e('Restore Styles', 'my-style-anytime'); ?></button>
                        </form>

                        <form method="post" action="" class="delete-button" onsubmit="return confirmDelete('<?php echo esc_js($backupFileName); ?>')">
							<?php wp_nonce_field('mysat_delete_nonce'); ?>
                            <input type="hidden" name="action" value="mysat_delete">
                            <input type="hidden" name="backup_file" value="<?php echo esc_attr($backupFileName); ?>">
                            <button type="button" class="button button-secondary delete-button" data-backup-file-name="<?php echo esc_attr($backupFileName); ?>" onclick="confirmDelete('<?php echo esc_js($backupFileName); ?>')"><?php esc_html_e('Delete', 'my-style-anytime'); ?></button>

                        </form>
                    </div>
					<?php
				}
				?>
            </div>
			<?php
		}

		?>

    </div>

    <script>
        function confirmDelete() {
            return new Promise((resolve) => {
                Swal.fire({
                    title: '<?php esc_html_e("Are you sure?", "my-style-anytime"); ?>',
                    text: '<?php esc_html_e("After deleting you are not able to revert this file!", "my-style-anytime"); ?>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2271b1',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '<?php esc_html_e("Yes, delete it!", "my-style-anytime"); ?>',
                    cancelButtonText: '<?php esc_html_e("Cancel", "my-style-anytime"); ?>',
                }).then((result) => {
                    resolve(result.isConfirmed);
                });
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach((button) => {
                button.addEventListener('click', async function (event) {
                    event.preventDefault();
                    const confirmed = await confirmDelete();

                    if (confirmed) {
                        button.closest('form').submit();
                    }
                });
            });
        });
    </script>

	<?php
}