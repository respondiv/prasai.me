(function ($) {
    "use strict";
    
    $(document).ready(function() {
    	$('.add_section').on('click', function (e) {
    		e.preventDefault();

            var nums = $('.postbox').map(function () {
                return $(this).data('id');
            });

            var num = (nums.length) ? Math.max.apply(Math, nums) + 1 : 0,
                html = $('#tmpl-section').html(),
                template = html.replace(new RegExp('{{key}}', 'g'), num);

            $('.metabox-holder').append(template);

            $('.metabox-holder .compass_resume_items').sortable({
                handle: '.drag_experience'
            });
    	});

    	$('.metabox-holder').on('click', '.remove_section', function (e) {
    		e.preventDefault();

    		$(this).parents('.postbox').remove();
    	});

    	$('.metabox-holder').on('click', '.add_experience', function (e) {
    		e.preventDefault();

            var is = $(this).parents('.postbox').find('.compass_resume_items li').map(function () {
                return $(this).data('id');
            });


            var i = (is.length) ? Math.max.apply(Math, is) + 1 : 0,
    			num = $(this).parents('.postbox').data('id'),
                html = $('#tmpl-experience').html();
                
            var template = html.replace(new RegExp('{{key}}', 'g'), num).replace(new RegExp('{{i}}', 'g'), i);

            $(this).parents('.postbox').find('.compass_resume_items').append(template);
    	});

        $('.metabox-holder').on('click', '.add_scale', function (e) {
            e.preventDefault();

            var i = $(this).parents('.postbox').find('.compass_resume_items li').length,
                num = $(this).parents('.postbox').index(),
                html = $('#tmpl-scale').html();

            var template = html.replace(new RegExp('{{key}}', 'g'), num).replace(new RegExp('{{i}}', 'g'), i);

            $(this).parents('.postbox').find('.compass_resume_items').append(template);
        });

    	$('.metabox-holder').on('click', '.remove_experience', function (e) {
    		e.preventDefault();

    		$(this).parents('li').remove();
    	});

        $('.metabox-holder').sortable({
            handle: '.drag_section'
        });
    });
})(jQuery);