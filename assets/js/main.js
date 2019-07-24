$(document).ready(function () {

  $('.navbar-toggler').on('click', function () {
    $('html').toggleClass('mobile-active');
  });

  $('.mobile-overlay').on('click', function () {
    $('html').removeClass('mobile-active');
  });

  $('.phone').mask('+7(999)999-99-99');

  $('[data-toggle="tab"], [data-toggle="pill"]').on('show.bs.tab', function (e) {
    const that = $(this);
    const thatWidth = that.outerWidth();
    const thatPositionLeft = that.position().left;

    const parent = that.parents('.nav-tabs').length ? that.parents('.nav-tabs')
                : that.parents('.nav-pills').length ? that.parents('.nav-pills') : [];

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

  const instance = $('.img-lazy').Lazy({
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
    navClass: ['slider-arrow slider-prev slider-banner-prev', 'slider-arrow slider-next slider-banner-next'],
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
    stageOuterClass: 'owl-stage-outer slider-cards-stage-outer',
    stageClass: 'owl-stage slider-cards-stage slider-stage-flex',
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
    nav: true,
    dots: false,
    items: 1,
    navContainer: '.slider-compare-nav',
    navClass: ['slider-arrow slider-prev slider-compare-arrow', 'slider-arrow slider-next slider-compare-arrow'],
    navText: ['<span class="icon icon-arrow-left"></span>', '<span class="icon icon-arrow-right"></span>'],
    responsive: {
      480: {
        items: 2,
      },
      640: {
        items: 3,
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
        item: 2,
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
    navClass: ['slider-arrow slider-prev slider-reviews-arrow slider-reviews-prev', 'slider-arrow slider-next slider-reviews-arrow slider-reviews-next'],
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
    stageClass: 'owl-stage slider-stage-flex',
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

  $('.slider-view-controls').owlCarousel({
    nav: true,
    dots: false,
    items: 2,
    margin: 20,
    itemElement: 'li',
    stageElement: 'ul',
    stageClass: 'owl-stage slider-view-controls-stage nav nav-tabs border-0',
    navClass: ['slider-arrow slider-prev slider-view-controls-arrow slider-view-controls-prev', 'slider-arrow slider-next slider-view-controls-arrow slider-view-controls-next'],
    navText: ['<span class="icon icon-arrow-left"></span>', '<span class="icon icon-arrow-right"></span>'],
    responsive: {
      480: {
        items: 3,
      },
      768: {
        items: 4,
      },
      992: {
        items: 5,
      },
      1200: {
        nav: false,
        items: 7
      }
    }
  });

  $('.slider-form').owlCarousel({
    nav: true,
    dots: false,
    items: 1,
    margin: 20,
    touchDrag: false,
    mouseDrag: false,
    pullDrag: false,
    freeDrag: false,
    navContainer: '.slider-form-nav',
    navClass: ['page-link', 'page-link'],
    navText: ['<span class="icon-angle-left align-middle mr-sm-2"></span><span class="d-none d-sm-inline align-middle">Назад</span>', '  <span class="d-none d-sm-inline align-middle mr-sm-2">Далее</span><span class="icon-angle-right align-middle"></span>']
  });

  const sliderThumbnails = $('.slider-thumbnails').owlCarousel({
    lazyLoad: true,
    dots: false,
    items: 4
  });

  const sliderImgs = $('.slider-imgs').owlCarousel({
    nav: true,
    dots: false,
    items: 1,
    URLhashListener: true,
    navClass: ['slider-arrow slider-prev slider-imgs-prev', 'slider-arrow slider-next slider-imgs-next'],
    navText: ['<span class="icon icon-arrow-left"></span>', '<span class="icon icon-arrow-right"></span>'],
    onChanged: function (event) {
      const currentItemId = $($(this.$stage).children()[this._current]).find('[data-href]').data('href');
      const currentItem = $('.slider-thumbnails [data-id=' + currentItemId + ']');

      $('.slider-thumbnail').removeClass('active');
      currentItem.addClass('active');
      sliderThumbnails.trigger('to.owl.carousel', currentItem.parent().index());
    }
  });

  $('.slider-projects').owlCarousel({
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

  $('.owl-carousel').each(function () {
    $(this).on('changed.owl.carousel', function (event) {
      instance.addItems('.img-lazy');
      instance.force(instance.getItems());
      instance.destroy();
    });
    $(this).find('.slider-next').each(function (index) {
      $(this).attr('aria-label', 'Следующий слайд');
    });
    $(this).find('.slider-prev').each(function (index) {
      $(this).attr('aria-label', 'Предыдущий слайд');
    });
    $(this).find('.owl-dot').each(function (index) {
      $(this).attr('aria-label', index + 1);
    });
  });

  // ymaps.ready(init);

  function init() {
    const myMap = new ymaps.Map("map", {
      center: [55.76, 37.64],
      zoom: 15
    });
    const myPlacemark = new ymaps.Placemark([55.76, 37.64], {
      hintContent: 'Наш адрес'
    });

    myMap.behaviors.disable('scrollZoom');
    myMap.geoObjects.add(myPlacemark);
  }

  function appendCopyText() {
    const istS = 'Источник:';
    const copyR = '©';
    const body_element = document.getElementsByTagName('body')[0];
    const choose = window.getSelection();
    const myLink = document.location.href;
    const authorLink = "" + istS + ' ' + " " + myLink + " " + copyR;
    const copytext = ((choose + '').length > 100) ? (choose + " " + authorLink) : choose;
    const addDiv = document.createElement('div');
    addDiv.style.position = 'absolute';
    addDiv.style.left = '-99999px';
    body_element.appendChild(addDiv);
    addDiv.innerHTML = copytext;
    choose.selectAllChildren(addDiv);
    window.setTimeout(function () {
      body_element.removeChild(addDiv);
    }, 0);
  }

  document.oncopy = appendCopyText;

});