<?php
$pages = Contr::sections();
$controller = App::gi()->uri->controller;
$theme = App::gi()->themeName;
$categories = Category::themeCats();
?>
<div id="page-wrapper" class="page-wrapper">
  <header id="page-header" class="page-header">
    <div class="mobile-controls">
      <nav class="container px-0">
        <ul class="row mx-0 row mx-0 nav mobile-controls-list">
          <li class="col px-0 mobile-controls-list-item">
            <button class="navbar-toggler mobile-control" type="button" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Открыть главное меню"><span class="icon-bars"></span></button>
          </li>
          <li class="col px-0 mobile-controls-list-item"><a href="#" class="mobile-control" aria-label="Позвонить нам"><span class="icon-call-ring"></span></a></li>
          <li class="col px-0 mobile-controls-list-item"><a href="#" class="mobile-control" aria-label="Перейти в корзину"><span class="icon-cart"></span></a></li>
          <li class="col px-0 mobile-controls-list-item">
            <form class="search search-mobile">
              <input type="text" name="search" placeholder="Поиск" class="search-input form-control mobile-control" aria-label="Поиск" required>
              <button type="button" class="btn search-btn mobile-control" aria-label="Кнопка для поиска"><span class="icon-search"></span></button>
              <button type="reset" class="btn search-reset mobile-control" aria-label="Кнопка для очистки поля поиска"><span class="icon-times"></span></button>
            </form>
          </li>
        </ul>
      </nav>
    </div>
    <div class="bar-main">
      <div class="container d-flex justify-content-between">
        <div class="small mr-3">
          <span>Продажа и монтаж бризеров в</span>
          <div class="d-inline-block dropdown align-top">
            <button data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-link link-light link-dashed">Москве и МО</button>
            <ul class="dropdown-menu">
              <li>
                <a href="#" class="dropdown-item">Санкт-Петербурге</a>
              </li>
              <li>
                <a href="#" class="dropdown-item">Воронеже</a>
              </li>
              <li>
                <a href="#" class="dropdown-item">Белгороде</a>
              </li>
            </ul>
          </div>
        </div>
        <ul class="nav flex-nowrap align-items-center">
          <li class="mr-3"><a href="#" class="link-light d-flex"><span class="icon-facebook"></span></a></li>
          <li class="mr-3"><a href="#" class="link-light d-flex"><span class="icon-instagram"></span></a></li>
          <li><a href="#" class="link-light d-flex"><span class="icon-youtube"></span></a></li>
        </ul>
      </div>
    </div>
    <div class="container page-header-content-inner">
      <div class="row align-items-center justify-content-center justify-content-md-between">
        <div class="col-auto">
          <?php if ($controller === '' or $controller === 'index') { ?>
          <span class="logo">
            <img src="/assets/img/svg/logo.svg" alt="" class="img-responsive logo-img mx-auto">
          </span>
          <?php } else { ?>
          <a href="<?= absoluteLink(); ?>" class="logo">
            <img src="/assets/img/svg/logo.svg" alt="" class="img-responsive logo-img mx-auto">
          </a>
          <?php } ?>
        </div>
        <div class="col-auto d-none d-md-block">
          <ul class="nav nav-contacts">
            <li class="nav-item">
              <a href="tel:88005002712" class="link-truncate link-dark h3 h3-lg mb-0">8 800 500 27 12</a>
              <a href="#modal-callback" class="small" data-toggle="modal">Звонок бесплатный</a>
            </li>
            <li class="nav-item">
              <a href="tel:+74991106343" class="link-truncate link-dark h3 h3-lg mb-0">+7 (499) 110 63 43</a>
              <div class="small">Москва</div>
            </li>
          </ul>
        </div>
        <div class="col-auto d-none d-lg-block">
          <button class="btn-link link-dark cart-opener-btn" data-toggle="modal" data-target="#modal-cart">
            <span class="icon-cart cart-opener-icon mr-3"></span>
            <span class="cart-opener-text">
              <span>Ваша корзина</span>
              <br>
              <span class="cart-check-digits">0</span>
              <span class="cart-check-currency">&#8381;</span>
            </span>
          </button>
        </div>
      </div>
    </div>
    <div class="navbar-expand-lg navbar p-0 menu-wrap">
      <div class="container d-block">
        <div id="menu" class="menu-content">
          <button class="navbar-toggler close" type="button" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Закрыть главное меню">
            <span class="icon-times"></span>
          </button>
          <div class="d-lg-none mb-4">
            <span>Продажа и монтаж бризеров в</span>
            <div class="d-inline-block dropdown align-top">
              <button data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-link link">Москве и МО</button>
              <ul class="dropdown-menu">
                <li>
                  <a href="#" class="dropdown-item">Санкт-Петербурге</a>
                </li>
                <li>
                  <a href="#" class="dropdown-item">Воронеже</a>
                </li>
                <li>
                  <a href="#" class="dropdown-item">Белгороде</a>
                </li>
              </ul>
            </div>
          </div>
          <ul class="menu mb-4 mb-lg-0">
            <li class="menu-item"><a href="/" class="menu-link">Проветриватели</a></li>
            <li class="menu-item"><a href="/" class="menu-link">Монтаж</a></li>
            <li class="menu-item"><a href="/" class="menu-link">Акции</a></li>
            <li class="menu-item"><a href="/" class="menu-link">Отзывы</a></li>
            <li class="menu-item"><a href="/" class="menu-link">Наши проекты</a></li>
            <li class="menu-item"><a href="/" class="menu-link">Контакты</a></li>
          </ul>
          <ul class="nav flex-column d-lg-none">
            <li class="nav-item mb-3">
              <a href="tel:88005002712" class="link-truncate link-dark h3 h3-lg mb-0">8 800 500 27 12</a>
              <div class="small">Звонок бесплатный</div>
            </li>
            <li class="nav-item">
              <a href="tel:+74991106343" class="link-truncate link-dark h3 h3-lg mb-0">+7 (499) 110 63 43</a>
              <div class="small">Москва</div>
            </li>
          </ul>
          <form class="search d-none d-lg-block">
            <input type="text" name="search" placeholder="Поиск" class="search-input form-control" aria-label="Поиск" required>
            <button type="button" class="search-btn btn" aria-label="Кнопка для поиска"><span class="icon-search"></span></button>
            <button type="reset" class="search-reset btn" aria-label="Кнопка для очистки поля поиска"><span class="icon-times"></span></button>
          </form>
        </div>
        <button type="button" class="mobile-overlay" aria-label="Закрыть меню"></button>
      </div>
    </div>
  </header>
  <main id="page-main" class="page-main">
    <?php echo BreadCrumb::links(); ?>
    <?php echo $content; ?>
  </main>
  <footer id="page-footer" class="page-footer">
    <div class="container">
      <div class="row justify-content-between align-items-center text-center text-sm-left">
        <div class="col-sm-auto mb-3 mb-sm-0">
          <span>&copy;</span>
          <a href="<?= absoluteLink(); ?>" class="link-dark">ABC Vent</a>
          <span class="mr-1"><?= date('Y', time()); ?></span>
          <a href="#" class="link-dark">Политика конфиденциальности</a>
        </div>
        <div class="col-sm-auto">WebCanape — разработка сайтов и маркетинг</div>
      </div>
    </div>
  </footer>
</div>

<div id="modal-callback" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header d-block">
        <h3 class="modal-title mb-0">Обратный звонок</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть окно с каталогом">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST">
          <div class="form-group">
            <input type="text" id="modal-callback-name" class="form-control" name="callback[name]" required>
            <label for="modal-callback-name" class="form-control-placeholder">Ваше имя</label>
          </div>
          <div class="form-group">
            <input type="text" id="modal-callback-phone" class="form-control phone" name="callback[phone]" required="required">
            <label for="modal-callback-phone" class="form-control-placeholder">Телефон</label>
          </div>
          <div class="text-center">
            <button class="btn btn-lg btn-outline-main d-inline-flex align-items-center justify-content-between w-100" aria-label="Отправить заявку">
              <span>Отправить заявку</span>
              <span class="icon-angle-right"></span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>