jQuery(document).ready(function($) {
    // Initialize color picker
    $('.my-color-field').wpColorPicker();

    function openMediaUploader(uploadButton, inputField, previewImage, removeButton, titleText = 'Choose Image', buttonText = 'Choose Image') {
        uploadButton.on('click', function(e) {
            e.preventDefault();
            var mediaUploader = wp.media({
                title: titleText,
                button: { text: buttonText },
                multiple: false
            });

            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                inputField.val(attachment.url);
                previewImage.attr('src', attachment.url).show();
                removeButton.show();
            });

            mediaUploader.open();
        });
    }

    // Handle Upload Logo
    openMediaUploader(
        $('#mysat_upload_logo_button'),
        $('#mysat_custom_login_logo'),
        $('#mysat-logo-preview'),
        $('#mysat_remove_logo_button'),
        'Choose Logo', 'Use this logo'
    );

    $('#mysat_remove_logo_button').on('click', function(e) {
        e.preventDefault();
        $('#mysat_custom_login_logo').val('');
        $('#mysat-logo-preview').attr('src', '').hide();
        $(this).hide();
    });

    // Handle Upload Background Image
    openMediaUploader(
        $('#mysat_upload_bg_button'),
        $('#mysat_custom_login_bg_image'),
        $('#mysat-bg-preview'),
        $('#mysat_remove_bg_button'),
        'Choose Background Image', 'Use this image'
    );

    $('#mysat_remove_bg_button').on('click', function(e) {
        e.preventDefault();
        $('#mysat_custom_login_bg_image').val('');
        $('#mysat-bg-preview').attr('src', '').hide();
        $(this).hide();
    });
});
