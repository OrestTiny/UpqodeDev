'use strict';

const mobileMenuBreakpoint = 1024;
let winW = null;

['load', 'resize'].forEach((event) => {
  window.addEventListener(event, () => {
    calcWinSizes();
    resizeMenu();
  });
});

if (document.querySelector('.upqode-header') !== null) {
  const headerEl = document.querySelector('.upqode-header');
  const htmlEl = document.querySelector('html');

  if (document.querySelectorAll('.upqode-header .menu-item-has-children > a')) {
    const svgElement = document.createElement('span');
    svgElement.classList.add('dropdown-btn');
    svgElement.innerHTML =
      '<svg width="11" height="8" viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.1429 1.21436L5.57143 5.78578L1 1.21436" stroke="#fff" stroke-width="2"/></svg>';

    document.querySelectorAll('.upqode-header .menu-item-has-children > a').forEach((linkItem) => {
      linkItem.after(svgElement);
    });
  }

  if (headerEl.querySelectorAll('.menu-item-has-children .dropdown-btn')) {
    headerEl.querySelectorAll('.menu-item-has-children .dropdown-btn').forEach((arrowItem) => {
      arrowItem.addEventListener('click', function (e) {
        e.stopPropagation();
        const subMenu = this.nextElementSibling;
        console.log(this);
        console.log(subMenu);

        if (mobileMenuBreakpoint >= winW) {
          this.classList.toggle('active');

          if (subMenu !== null && subMenu.classList.contains('sub-menu')) {
            if (!subMenu.classList.contains('active')) {
              subMenu.classList.add('active');
              subMenu.style.height = 'auto';

              let height = subMenu.clientHeight + 'px';

              subMenu.style.height = '0px';

              setTimeout(function () {
                subMenu.style.height = height;
              }, 0);
            } else {
              subMenu.style.height = '0px';

              subMenu.addEventListener(
                'transitionend',
                function () {
                  subMenu.classList.remove('active');
                },
                {
                  once: true,
                }
              );
            }
          }
        }
      });
    });
  }

  if (document.querySelector('.upqode-header__burger') !== null) {
    document.querySelector('.upqode-header__burger').addEventListener('click', function (e) {
      e.preventDefault();

      this.classList.toggle('active');

      if (this.classList.contains('active')) {
        htmlEl.classList.add('no-scroll');
        headerEl.classList.add('menu-open');
      } else {
        htmlEl.classList.remove('no-scroll');
        headerEl.classList.remove('menu-open');
      }
    });
  }
}

function calcWinSizes() {
  winW = window.innerWidth;
}

function resizeMenu() {
  if (
    window.screen.width > mobileMenuBreakpoint &&
    document.querySelector('html').classList.contains('no-scroll') &&
    document.querySelector('.upqode-header__burger') !== null
  ) {
    document.querySelector('html').classList.remove('no-scroll');
    document.querySelector('.upqode-header__burger').classList.toggle('active');
  }
}
