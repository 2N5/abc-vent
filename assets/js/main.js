$(document).ready(function () {

  $('.navbar-toggler').on('click', function () {
    $('html').toggleClass('mobile-active');
  });

  $('.mobile-overlay').on('click', function () {
    $('html').removeClass('mobile-active');
  });

  $('.phone').mask('+38(099)999-99-99');

  $('[data-toggle="tab"], [data-toggle="pill"]').on('show.bs.tab', function (e) {
    const that = $(this);
    const thatWidth = that.outerWidth();
    const thatPositionLeft = that.position().left;
    const parent = that.parents('.nav-pills') || that.parents('.nav-tabs');
    const parentWidth = parent.outerWidth();
    const parentScrollLeft = parent.scrollLeft();

    if (thatPositionLeft < 0) {
      parent.animate({
        scrollLeft: "+=" + thatPositionLeft
      }, 200);
    } else if (thatPositionLeft + thatWidth > parentWidth) {
      parent.animate({
        scrollLeft: "+=" + ((thatPositionLeft + thatWidth) - parentWidth)
      }, 200);
    }
  });

  const instant = $('.img-lazy').Lazy({
    effect: 'fadeIn',
    effectTime: 200,
    visibleOnly: false,
    threshold: 0,
    chainable: false
  });

  const header = $('#page-header');
  const headerClone = header.clone().addClass('page-header-clone').attr('aria-hidden', true);

  let stickyElements = $('.sticky');
  let scrollPosition = 0;

  headerClone.removeAttr('id').find('[id]').removeAttr('id');
  headerClone.insertAfter(header);

  $(window).scroll(function (event) {

    const windowScrollTop = $(this).scrollTop();
    const headerCloneHeight = headerClone.offset().top + headerClone.outerHeight();

    if (scrollPosition > windowScrollTop && $('.page-header-sticky').length) {
      header.addClass('page-header-sticky-in');
      stickyElements.css('top', `calc(${header.outerHeight()}px + 1rem)`);
    } else {
      header.removeClass('page-header-sticky-in');
      stickyElements.css('top', '1rem');
    }

    if (windowScrollTop > headerCloneHeight * 2) {
      header.addClass('page-header-sticky');
      headerClone.addClass('relative');
    }

    if (windowScrollTop === 0) {
      header.removeClass('page-header-sticky');
      headerClone.removeClass('relative');
      header.removeClass('page-header-sticky-in');
    }

    scrollPosition = windowScrollTop;
  });

  $('.slider-banner').owlCarousel({
    loop: true,
    nav: false,
    dots: true,
    items: 1,
    autoHeight: true,
    dotsClass: 'owl-dots slider-dots slider-banner-dots',
    dotClass: 'owl-dot slider-dot slider-banner-dot',
    navClass: ['slider-arrow slider-banner-prev', 'slider-arrow slider-banner-next'],
    navText: ['<span class="icon icon-arrow-left"></span>', '<span class="icon icon-arrow-right"></span>'],
    responsive: {
      1330: {
        dots: false,
        nav: true,
      }
    }
  });

  $('.slider-cards').owlCarousel({
    loop: true,
    items: 1,
    dots: true,
    margin: 20,
    dotsClass: 'owl-dots slider-dots',
    dotClass: 'owl-dot slider-dot',
    stageClass: 'owl-stage slider-cards-stage',
    stageOuterClass: 'owl-stage-outer slider-cards-stage-outer',
    navClass: ['slider-arrow slider-prev', 'slider-arrow slider-next'],
    navText: ['<span class="icon icon-arrow-left"></span>', '<span class="icon icon-arrow-right"></span>'],
    responsive: {
      420: {
        items: 2,
        margin: 20,
        stagePadding: 0
      },
      576: {
        items: 2,
        margin: 20,
        stagePadding: 79
      },
      992: {
        items: 4,
        margin: 30,
        stagePadding: 0
      },
      1330: {
        items: 4,
        dots: false,
        nav: true,
        margin: 30,
        stagePadding: 0,
      }
    }
  });


  $('.slider-compare').owlCarousel({
    loop: false,
    nav: true,
    dots: false,
    items: 1,
    navContainer: '.slider-compare-nav',
    navClass: ['slider-arrow slider-compare-arrow slider-prev', 'slider-arrow slider-compare-arrow slider-next'],
    navText: ['<span class="icon icon-arrow-left"></span>', '<span class="icon icon-arrow-right"></span>'],
    responsive: {
      480: {
        items: 2,
      },
      640: {
        items: 3,
      },
      768: {
        items: 2,
      },
      992: {
        items: 4,
      },
      1140: {
        items: 5,
      },
      1330: {
        nav: false,
        items: 7,
      }
    }
  });

  $('.slider-works').owlCarousel({
    loop: true,
    dots: true,
    nav: false,
    items: 1,
    margin: 20,
    dotsClass: 'owl-dots slider-dots',
    dotClass: 'owl-dot slider-dot',
    navClass: ['slider-arrow slider-prev', 'slider-arrow slider-next'],
    navText: ['<span class="icon icon-arrow-left"></span>', '<span class="icon icon-arrow-right"></span>'],
    responsive: {
      576: {
        items: 2,
      },
      992: {
        items: 2,
        margin: 30,
      },
      1330: {
        dots: false,
        nav: true,
        items: 2,
        margin: 30,
        stagePadding: 0,
      }
    }
  });

  $('.slider-reviews').owlCarousel({
    loop: true,
    nav: false,
    dots: false,
    items: 1,
    navClass: ['slider-arrow slider-reviews-arrow slider-reviews-prev', 'slider-arrow slider-reviews-arrow slider-reviews-next'],
    navText: ['<span class="icon icon-arrow-left"></span>', '<span class="icon icon-arrow-right"></span>'],
    responsive: {
      576: {
        nav: true,
        navContainer: '.slider-reviews-nav',
      }
    }
  });

  $('.slider-articles').owlCarousel({
    loop: true,
    dots: true,
    nav: false,
    items: 1,
    margin: 20,
    dotsClass: 'owl-dots slider-dots',
    dotClass: 'owl-dot slider-dot',
    navClass: ['slider-arrow slider-prev', 'slider-arrow slider-next'],
    navText: ['<span class="icon icon-arrow-left"></span>', '<span class="icon icon-arrow-right"></span>'],
    responsive: {
      576: {
        items: 2,
      },
      992: {
        items: 3,
        margin: 30,
      },
      1330: {
        dots: false,
        nav: true,
        items: 3,
        margin: 30,
      }
    }
  });

  $('.slider-brands').owlCarousel({
    loop: true,
    dotsClass: 'owl-dots slider-dots',
    dotClass: 'owl-dot slider-dot',
    navClass: ['slider-arrow slider-prev', 'slider-arrow slider-next'],
    navText: ['<span class="icon icon-arrow-left"></span>', '<span class="icon icon-arrow-right"></span>'],
    responsive: {
      0: {
        dots: true,
        items: 1,
        margin: 20,
      },
      576: {
        dots: true,
        items: 2,
        margin: 20,
      },
      992: {
        items: 4,
        margin: 30,
        stagePadding: 0
      },
      1330: {
        items: 4,
        dots: false,
        nav: true,
        margin: 30,
        stagePadding: 0,
      }
    }
  });

});