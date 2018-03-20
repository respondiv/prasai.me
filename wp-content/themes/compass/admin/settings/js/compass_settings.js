(function ($) {
    "use strict";
    
    $(document).ready(function() {
    	var custom_uploader, current;
     
        $('.upload_image_button').live('click',function(e) {
            e.preventDefault();
            
            current = $(this);

            //If the uploader object has already been created, reopen the dialog
            if (custom_uploader) {
                custom_uploader.open();
                return;
            }
     
            //Extend the wp.media object
            custom_uploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Choose Image'
                },
                multiple: false
            });
     
            //When a file is selected, grab the URL and set it as the text field's value
            custom_uploader.on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                
                current.parent().find('.upload_image').val(attachment.url);
            });
     
            //Open the uploader dialog
            custom_uploader.open();
     
        });

        $('.colorPicker').wpColorPicker();

        $('.schemaPicker').on('click', function () {
            if ($(this).val() === 'custom-color') {
                $('#custom_color').show();
            } else {
                $('#custom_color').hide();
            }
        });
    });
})(jQuery);