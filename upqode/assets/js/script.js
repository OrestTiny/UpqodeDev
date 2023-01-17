;(function ($, window, document, undefined) {
    'use strict';

    if (typeof fitVids === 'function') {
        $('body').fitVids({ignore: '.vimeo-video, .youtube-simple-wrap iframe, .iframe-video.for-btn iframe, .post-media.video-container iframe'});
    }

    /*=================================*/
    /* PAGE CALCULATIONS */
    /*=================================*/

    if (typeof pageCalculations !== 'function') {

        var winW, winH, pageCalculations, onEvent = window.addEventListener;

        pageCalculations = function (func) {

            winW = window.innerWidth;
            winH = window.innerHeight;

            if (!func) return;

            onEvent('load', func, true); // window onload
            onEvent('resize', func, true); // window resize
            onEvent("orientationchange", func, false); // window orientationchange

        }; // end pageCalculations

        pageCalculations(function () {
            pageCalculations();
        });
    }

    $(window).on('load', function () {
        if ($('.upqode-preloader').length) {
            $('.upqode-preloader').fadeOut(400);
        }

        wpc_add_img_bg('.js-bg');
    });

    function calcPaddingMainWrapper() {

        if ($('.upqode-footer').length) {
            var footer = $('.upqode-footer');
            var paddValue = footer.outerHeight();

            footer.bind('heightChange', function () {
                $('body').css('padding-bottom', paddValue);

            });

            footer.trigger('heightChange');
        }
    }

    function blogIsotope() {
        if ($('.upqode-blog--isotope').length) {
            $('.upqode-blog--isotope').each(function () {
                var self = $(this);
                self.isotope({
                    itemSelector: '.upqode-blog--post',
                    layoutMode: 'masonry',
                    masonry: {
                        columnWidth: '.upqode-blog--post'
                    }
                });
            });
        }
    }

    function wpc_add_img_bg(img_sel, parent_sel) {
        if (!img_sel) {
            return false;
        }

        var $parent, $imgDataHidden, _this;
        $(img_sel).each(function () {
            _this = $(this);
            $imgDataHidden = _this.data('s-hidden');
            $parent = _this.closest(parent_sel);
            $parent = $parent.length ? $parent : _this.parent();
            $parent.css('background-image', 'url(' + this.src + ')').addClass('s-back-switch');
            if ($imgDataHidden) {
                _this.css('visibility', 'hidden');
                _this.show();
            }
            else {
                _this.hide();
            }
        });
    }

    function adminBarPositionFix() {
        if ($('#wpadminbar').length) {
            $('#wpadminbar').css('position', 'fixed');
        }
    }

    function errorPageHeight() {
        if ($('.upqode-error--wrap').length) {
            var footerH = $('.upqode-footer').length ? $('.upqode-footer').outerHeight() : 0,
                headerH = $('.upqode-header--wrap').length ? $('.upqode-header--wrap').outerHeight() : 0,
                errorH = $(window).height() - footerH - headerH;

            $('.upqode-error--wrap').outerHeight(errorH);
        }
    }


    $('.upqode-blog--single__comments-button').on('click', function () {

        $(this).toggleClass('active');
        if ($('.upqode-blog--single__comments').length) {
            $('.upqode-blog--single__comments').slideToggle();
        }
    });


    $(window).on('load resize orientationchange', function () {
        calcPaddingMainWrapper();
        setTimeout(blogIsotope, 200);
        adminBarPositionFix();
        errorPageHeight();
    });

})(jQuery, window, document);