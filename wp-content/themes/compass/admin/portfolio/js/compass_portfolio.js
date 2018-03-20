(function ($) {
    "use strict";
    
    $(document).ready(function() {
    	var custom_uploader, current;
     
        $('.compass_portfolio_items').on('click', '.upload_image_button', function(e) { 
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

        $('#add_item').on('click', function (e) {
            e.preventDefault();

            var nums = $('.compass_portfolio_items li').map(function () {
                return $(this).data('id');
            });

            var num = (nums.length) ? Math.max.apply(Math, nums) + 1 : 0,
                html = $('#tmpl-portfolio-item-template').html();
                
            var template = html.replace(new RegExp('{{key}}', 'g'), num);

            $('.compass_portfolio_items').append(template);
        });

        $('.compass_portfolio_items').on('click', '.remove', function (e) {
            e.preventDefault();
            
            $(this).parents('li').remove();
        });

        $('.compass_portfolio_items').sortable({
            handle: '.drag'
        });

        $('.compass_portfolio_items').on('change', '.portfolio_type', function() {
            var value = $(this).val();

            if (value === 'image') {
                $(this).parents('li').find('.portfolio_video').hide();
                $(this).parents('li').find('.portfolio_video input[type="text"]').val('');

                $(this).parents('li').find('.portfolio_image').show();
            } else {
                $(this).parents('li').find('.portfolio_image').hide();
                $(this).parents('li').find('.portfolio_image input[type="text"]').val('');

                $(this).parents('li').find('.portfolio_video').show();
            }
        });
    });
})(jQuery);