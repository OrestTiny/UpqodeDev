(function ($, window, document, undefined) {
  'use strict';

  const mobileMenuBreakpoint = 1024;
  let winW = null;

  $(window).on('load resize orientationchange', function () {
    calcWinSizes();
    resizeMenu();
  });

  if ($('.upqode-header').length) {
    $('.upqode-header .menu-item-has-children > a').after(
      '<span class="dropdown-btn"><svg width="11" height="8" viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.1429 1.21436L5.57143 5.78578L1 1.21436" stroke="#fff" stroke-width="2"/></svg></span>'
    );

    $('.upqode-header')
      .find('.menu-item-has-children .dropdown-btn')
      .on('click', function (e) {
        e.stopPropagation();

        if (mobileMenuBreakpoint >= winW) {
          $(this).toggleClass('active');
          $(this).next('.sub-menu').slideToggle();
        }
      });
  }

  $('.upqode-header__burger').on('click', function (e) {
    e.preventDefault();

    $(this).toggleClass('active');

    if ($(this).hasClass('active')) {
      $('html').addClass('no-scroll');
      $('.upqode-header').addClass('menu-open');
    } else {
      $('html').removeClass('no-scroll');
      $('.upqode-header').removeClass('menu-open');
    }
  });

  function calcWinSizes() {
    winW = window.innerWidth;
  }

  function resizeMenu() {
    if ($(window).width() > mobileMenuBreakpoint && $('html').hasClass('no-scroll')) {
      $('html').removeClass('no-scroll').height('auto');
      $('.upqode-header__burger').toggleClass('active');
    }
  }
})(jQuery, window, document);
