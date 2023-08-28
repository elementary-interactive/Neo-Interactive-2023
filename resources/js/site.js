var rowWidth = 1460;

// menu open

$(".menu-btn").click(function () {
    $('body').toggleClass("nav-active");
});

$(".nav-list-item a").click(function () {
    $('body').removeClass("nav-active");
});

$(window).resize(function () {
    if (window.innerWidth > rowWidth) {
        $('body').removeClass("nav-active");
    }
});

// popup

$(".open-popup").click(function (e) {
    e.preventDefault();
    $('body').addClass("popup-active");
});

$(".close-popup").click(function (e) {
    e.preventDefault();
    $('body').removeClass("popup-active");
});

// lang

$(".lang-open").click(function (e) {
    e.preventDefault();
    if ($('.search-box').hasClass('open')) {
        $('.search-box').toggleClass("open");
    }
    $('.lang-box').toggleClass("open");
});

$(".lang-close").click(function (e) {
    e.preventDefault();
    $('.lang-box').toggleClass("open");
});

// hide brand logo onscroll

let bandLogo = document.querySelector('.brand-logo')

document.addEventListener("scroll", (event) => {
    let lastKnownScrollPosition = window.scrollY;
  
    if (lastKnownScrollPosition > 40) {
        bandLogo.classList.add("hide");
    } else {
        bandLogo.classList.remove("hide");
    }
  });

// case studeis slider

var $swiperSelector = $('.swiper-container');

$swiperSelector.each(function(index) {
    var $this = $(this);
    $this.addClass('swiper-slider-' + index);

    var freeMode = $this.data('free-mode') ? $this.data('free-mode') : false;

    var swiper = new Swiper('.swiper-slider-' + index, {
      direction: 'horizontal',
      freeMode: freeMode,
      spaceBetween: 15,
      breakpoints: {
        1920: {
            spaceBetween: 27,
          slidesPerView: 3
        },
        1200: {
            spaceBetween: 27,
          slidesPerView: 3
        },
        768: {
            spaceBetween: 20,
           slidesPerView: 2
        }
      },
      scrollbar: {
        el: '.swiper-scrollbar',
        draggable: true,
      }
   });
});