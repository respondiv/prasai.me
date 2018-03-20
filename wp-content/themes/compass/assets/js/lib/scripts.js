var Compass;

(function ($) {
    "use strict";

    Compass = (function () {
        var triggers = [], loaded = [],
            compass_base_path = compass_base_url.replace(window.location.protocol+'//'+window.location.hostname, '') + '/',
            not_accepted = '[href$=".jpg"],[href$=".jpeg"],[href$=".png"],[href$=".gif"],[href$=".pdf"],[href$=".doc"],[href$=".ppt"],[href$=".pptx"],[href$=".pps"],[href$=".ppsx"],[href$=".odt"],[href$=".xls"],[href$=".xlsx"],[href$=".mp3"],[href$=".m4a"],[href$=".ogg"],[href$=".wav"],[href$=".mp4"],[href$=".m4v"],[href$=".mov"],[href$=".wmv"],[href$=".avi"],[href$=".mpg"],[href$=".ogv"],[href$=".3gp"],[href$=".3g2"]';

        function loader (mode) {
            if (mode === 'start') {
                $('.loader').addClass('show');

                return;
            }

            if (mode === 'stop') {
                $('.loader').removeClass('show');

                return;
            }
        }

        function page (url, mode) {
            if (mode === 'show') {
                $('#swipebox-close').trigger('click');
                $('.pages').hide();

                $('.pages[id="'+ url +'"]:first').show();
                $('.page_window').addClass('show');
                $('.main').addClass('hide');

                document.title = $('.pages[id="'+ url +'"]:first').data('title');

                $('.page_window').scrollTop(0);
                
                loader('stop');

                return;
            }

            if (mode === 'hide') {
                $('#swipebox-close').trigger('click');

                document.title = $('body').data('title');

                $('.page_window').removeClass('show');
                $('.main').removeClass('hide');

                loader('stop');
                
                setTimeout(function () {
                    $('.pages').hide();
                    loader('stop');
                }, 300);

                return;
            }
        }

        function linkFix ($page) {
            $page.find('a[href^="'+compass_base_url+'"]:not(.swipebox-item):not('+ not_accepted +'):not([target="_blank"]):not([href*="wp-admin"]), a:not([href^="http://"]):not([href^="https://"]):not([href*="wp-admin"])').each(function (i) {
                $(this).address(function (e) {
                    return $(this).attr('href').replace(compass_base_url, '').replace(/^#/, '');
                });
            });
        }

        function scriptEnque ($page) {
            if ($page.find('.swipebox-item').length) {
                $page.find('.swipebox-item').swipebox();
            }

            if ($page.find('div.wpcf7 > form').length) {
                $page.find('div.wpcf7 > form').wpcf7InitForm();
            }

            if ($page.find('.prettySocial').length) {
                $page.find('.prettySocial').prettySocial();
            }
        }

        function loadPage (url, callback) {
            if ($('.pages[id="'+ url +'"]').length) {
                return true;
            }

            $.get(compass_base_url + url, function (data) {
                var $page = $('<div />', { 'class': 'pages', 'id': url }).hide().html(data);
                    $page.data('title', $page.find('span.meta_title').data('title'));
                    $page.find('span.meta_title').remove();

                $('.page_window .content').append($page);

                loaded.push(url);

                linkFix($page);
                scriptEnque($page);

                callback();
            });
        }

        function triggerArrange () {
            var total = $('.triggers li').size();
            var degree = 360/total;

            if ("TransitionEvent" in window || "WebKitTransitionEvent" in window || "OTransitionEvent" in window) {
                $('.triggers li').each(function (i) {
                    var animate = i+1;
                    var trigger_rotate = degree*i;
                    var icon_rotate = 45-trigger_rotate;

                    var trigger_css = {
                        'transform': 'rotate('+ trigger_rotate +'deg) translate(0, -160px)',
                        'animation-delay': '1.'+ animate +'s'
                    };

                    var icon_css = {
                        'transform': 'rotate('+ icon_rotate +'deg)'
                    };

                    $(this).css(trigger_css);
                    $(this).find('i, img').css(icon_css);
                });
            } else {
                var radius = 175;
                var angle = 0;
                var step = (2*Math.PI) / $('.triggers li').length;

                $('.triggers li').each(function (i) {
                    var x = Math.round(200/2 + radius * Math.cos(angle) - $(this).width()/2);
                    var y = Math.round(200/2 + radius * Math.sin(angle) - $(this).height()/2);
                    
                    $(this).css({
                        left: x + 'px',
                        top: y + 'px'
                    });

                    angle += step;
                });

                $('.triggers').css({ 'margin-left': '-100px', 'margin-top': '-150px' })
                $('.triggers li').css('opacity', '1');
            }

            $('.main').addClass('animate');
        }

        (function initialize () {
            loader('start');

            triggerArrange();

            $('.triggers li').hover(
                function () {
                    var title = $('a', this).data('title');

                    $('.description').show().html(title);
                },
                function () {
                    $('.description').hide().html('');
                }
            );

            $(document).ready(function() {
                if ($('.swipebox-item').length) {
                    $('.swipebox-item').swipebox();
                }

                if ($('div.wpcf7 > form').length) {
                    $('div.wpcf7 > form').wpcf7InitForm();
                }

                if ($('.prettySocial').length) {
                    $('.prettySocial').prettySocial();
                }
            });

            // Trigger click
            $('.triggers li a').on('click', function () {
                var type = $(this).data('type');
            });

            // Page close
            $('.close-page').on('click', function () {
                $('.page_window').removeClass('show');
                $('.main').removeClass('hide');
                
                setTimeout(function () {
                    $('.pages').hide();
                }, 300);
            });

            $('.triggers li a[href^="'+compass_base_url+'"]').each(function (i) {
                var url = $(this).attr('href').replace(compass_base_url, '');

                loadPage(url, function () {
                    triggers.push(url);
                });
            });


            $.address.state(compass_base_path).init(function(event) {
                $('a[href^="'+compass_base_url+'"]:not(.swipebox-item):not('+ not_accepted +'):not([target="_blank"]):not([href*="wp-admin"]), a:not([href^="http://"],[href^="https://"])').address(function(e) {
                    return $(this).attr('href').replace(compass_base_url, '').replace(/^#/, '');
                });
            }).change(function(event) {
                var url = event.value.replace(compass_base_url, '').replace(compass_base_path, '/');

                loader('start');

                if (url === '/#menu') {
                    loader('stop');

                    page(null, 'hide');

                    return;
                }

                if (url === '/' && compass_frontpage) {
                    loader('stop');

                    page(null, 'hide');

                    return;
                }

                if ($('.pages[id="'+ url +'"]').length) {
                    loader('stop');

                    page(url, 'show');
                } else {
                    loadPage(url, function () {
                        loader('stop');

                        page(url, 'show');
                    });
                }
            });

            var ready = setInterval(function () {
                var error = 0;

                $('.triggers li a[href^="'+compass_base_url+'"]').each(function () {
                    var url = $(this).attr('href').replace(compass_base_url, '');

                    if (!$('.pages[id="'+ url +'"]').length) {
                        error += 1;
                    }
                });

                if (!error) {
                    $.event.trigger({
                        type: 'Compass'
                    });

                    clearInterval(ready);
                }
            }, 500);

            loader('stop');
        })();

        return {
            loader: loader
        };
    })();
})(jQuery);