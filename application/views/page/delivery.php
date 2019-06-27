      <h1><?=($this->page->h1 !== '') ? $this->page->h1 : $this->page->title; ?></h1>
      <div class="row">
        <!-- <?php echo Sidebar::printSidebar(); ?> -->
        <aside id="page-sidebar" class="page-sidebar col-lg-3">
          <div class="widget">
            <button class="widget-title widget-collapse-toggler" type="button" data-toggle="collapse" aria-label="Открыть / Закрыть" data-target="#widget-collapse-catalog" aria-expanded="true">
              <span class="widget-collapse-toggler-text">Категории</span>
              <span class="widget-collapse-toggler-icon"></span>
            </button>
            <div id="widget-collapse-catalog" class="widget-collapse collapse show">
              <ul class="widget-list">
                <li class="widget-list-item">
                  <div id="widget-range" class="widget-item">
                    <span class="rangeValues"></span>
                    <div class="form-row">
                      <div class="form-group col-6">
                        <label for="widget-range-start" class="small">От</label>
                        <input id="widget-range-start" type="number" name="widget-range-start" class="form-control">
                      </div>
                      <div class="form-group col-6">
                        <label for="widget-range-end" class="small">До</label>
                        <input id="widget-range-end" type="number" name="widget-range-end" class="form-control">
                      </div>
                    </div>
                    <div id="widget-range-slider" class="custom-range-slider"></div>
                  </div>
                </li>
                <li class="widget-list-item">
                  <div class="widget-item">
                    <div class="custom-control custom-checkbox custom-control-badged">
                      <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                      <label class="custom-control-label" for="customControlAutosizing">
                        Remember my preference
                        <span class="badge badge-dark badge-floated" title="12">12</span>
                      </label>
                    </div>
                  </div>
                </li>
                <li class="widget-list-item">
                  <div class="widget-item">
                    <div class="custom-control custom-checkbox custom-control-badged">
                      <input type="checkbox" class="custom-control-input" id="custom" disabled>
                      <label class="custom-control-label" for="custom">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        <span class="badge badge-dark badge-floated" title="12123">121</span>
                      </label>
                    </div>
                  </div>
                </li>
                <li class="widget-list-item">
                  <div class="widget-item">
                    <div class="custom-control custom-radio custom-control-badged">
                      <input type="radio" name="name" class="custom-control-input" id="custom-radio-1">
                      <label class="custom-control-label" for="custom-radio-1">
                        Lorem ipsum dolor
                        <span class="badge badge-dark badge-floated" title="312">321</span>
                      </label>
                    </div>
                  </div>
                </li>
                <li class="widget-list-item">
                  <div class="widget-item">
                    <div class="custom-control custom-radio custom-control-badged">
                      <input type="radio" name="name" class="custom-control-input" id="custom-radio-2">
                      <label class="custom-control-label" for="custom-radio-2">
                        Lorem ipsum dolor sit amet consectetur
                        <span class="badge badge-dark badge-floated" title="312">321</span>
                      </label>
                    </div>
                  </div>
                </li>
                <li class="widget-list-item">
                  <div class="widget-item">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="customSwitch1">
                      <label class="custom-control-label" for="customSwitch1">Toggle this switch element</label>
                    </div>
                  </div>
                </li>
                <li class="widget-list-item">
                  <div class="widget-item">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" disabled id="customSwitch2">
                      <label class="custom-control-label" for="customSwitch2">Disabled switch element</label>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <div class="widget">
            <div class="widget-title">
              <a href="/" class="widget-link mb-0">Последние новости</a>
              <button class="widget-collapse-toggler" type="button" data-toggle="collapse" aria-label="Открыть / Закрыть" data-target="#widget-collapse-blog">
                <span class="widget-collapse-toggler-icon"></span>
              </button>
            </div>
            <div id="widget-collapse-blog" class="widget-collapse collapse">
              <ul class="widget-list">
                <li class="widget-list-item"><a href="/stati/kupit-meditsinskuyu-kartu-rebenka-forma-026u" class="widget-link">Купить медицинскую карту ребенка (форма 026у)</a></li>
                <li class="widget-list-item"><a href="/stati/kupit-med-knizhku-za-1000-rublei-v-moskve-srochno" class="widget-link">Купить мед книжку за 1000 рублей в Москве срочно</a></li>
                <li class="widget-list-item"><a href="/stati/kupit-vypisku-iz-bolnitsy-v-moskve" class="widget-link">Купить выписку из больницы в Москве</a></li>
                <li class="widget-list-item"><a href="/stati/kupit-bolnichnyi-list-zadnim-chislom-v-moskve" class="widget-link">Купить больничный лист задним числом в Москве</a></li>
                <li class="widget-list-item"><a href="/stati/zaklyuchenie-kek-kliniko-ekspertnoi-komissii" class="widget-link">Заключение КЭК (клинико-экспертной комиссии)</a></li>
                <li class="widget-list-item"><a href="/stati/kupit-spravku-na-gossluzhbu-forma-001gsu" class="widget-link">Купить справку на госслужбу (форма 001ГСу)</a></li>
                <li class="widget-list-item"><a href="/stati/spravka-po-forme-73-dlya-vzroslogo-i-rebenka" class="widget-link">ССправка по форме 73 для взрослого и ребенка</a></li>
              </ul>
            </div>
          </div>
        </aside>
        <button type="button" class="mobile-sidebar-overlay" aria-label="Закрыть фильтры"></button>
        <div class="col">
          <div class="page-section">
            <div class="row grid-list">
              <div class="col-6 col-sm-4 col-lg-3">
                <a href="http://tech-store.octemplates.net/bytovaya-tehnika-dlya-doma/klimaticheskaya-tehnika/ventilyatory/" title="Вентиляторы" class="grid-item h-100">
                  <img class="img-responsive grid-item-img" src="http://tech-store.octemplates.net/image/cache/data/categories/97-100x100.jpg" alt="Вентиляторы">
                  <span class="grid-item-title">Вентиляторы</span>
                </a>
              </div>
              <div class="col-6 col-sm-4 col-lg-3">
                <a href="http://tech-store.octemplates.net/bytovaya-tehnika-dlya-doma/klimaticheskaya-tehnika/vodonagrevateli/" title="Водонагреватели" class="grid-item h-100">
                  <img class="img-responsive grid-item-img" src="http://tech-store.octemplates.net/image/cache/data/categories/99-100x100.jpg" alt="Водонагреватели">
                  <span class="grid-item-title">Водонагреватели</span>
                </a>
              </div>
              <div class="col-6 col-sm-4 col-lg-3">
                <a href="http://tech-store.octemplates.net/bytovaya-tehnika-dlya-doma/klimaticheskaya-tehnika/kondicionery/" title="Кондиционеры" class="grid-item h-100">
                  <img class="img-responsive grid-item-img" src="http://tech-store.octemplates.net/image/cache/data/categories/93-100x100.jpg" alt="Кондиционеры">
                  <span class="grid-item-title">Кондиционеры</span>
                </a>
              </div>
              <div class="col-6 col-sm-4 col-lg-3">
                <a href="http://tech-store.octemplates.net/bytovaya-tehnika-dlya-doma/klimaticheskaya-tehnika/napolnye-mobilnye-kondicionery/" title="Напольные мобильные кондиционеры" class="grid-item h-100">
                  <img class="img-responsive grid-item-img" src="http://tech-store.octemplates.net/image/cache/data/categories/96-100x100.jpg" alt="Напольные мобильные кондиционеры">
                  <span class="grid-item-title">Напольные мобильные кондиционеры</span>
                </a>
              </div>
              <div class="col-6 col-sm-4 col-lg-3">
                <a href="http://tech-store.octemplates.net/bytovaya-tehnika-dlya-doma/klimaticheskaya-tehnika/obogrevatelnye-pribory/" title="Обогревательные приборы" class="grid-item h-100">
                  <img class="img-responsive grid-item-img" src="http://tech-store.octemplates.net/image/cache/data/categories/100-100x100.jpg" alt="Обогревательные приборы">
                  <span class="grid-item-title">Обогревательные приборы</span>
                </a>
              </div>
              <div class="col-6 col-sm-4 col-lg-3">
                <a href="http://tech-store.octemplates.net/bytovaya-tehnika-dlya-doma/klimaticheskaya-tehnika/split-sistemy/" title="Сплит-системы" class="grid-item h-100">
                  <img class="img-responsive grid-item-img" src="http://tech-store.octemplates.net/image/cache/data/categories/94-100x100.jpg" alt="Сплит-системы">
                  <span class="grid-item-title">Сплит-системы</span>
                </a>
              </div>
              <div class="col-6 col-sm-4 col-lg-3">
                <a href="http://tech-store.octemplates.net/bytovaya-tehnika-dlya-doma/klimaticheskaya-tehnika/uvlazhniteli-i-ochistiteli-vozduha/" title="Увлажнители и очистители воздуха" class="grid-item h-100">
                  <img class="img-responsive grid-item-img" src="http://tech-store.octemplates.net/image/cache/data/categories/98-100x100.jpg" alt="Увлажнители и очистители воздуха">
                  <span class="grid-item-title">Увлажнители и очистители воздуха</span>
                </a>
              </div>
            </div>
          </div>
          <div class="page-section">
            <div class="sorting-row mb-4">
              <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-auto flex-shrink-1">
                  <form action="" class="form-inline">
                    <label for="sort" class="d-none d-sm-inline mr-2">Сортировать:</label>
                    <select id="sort" class="custom-select form-control">
                      <option value="&amp;sort=p.viewed&amp;order=desc">Просмотры, по убыванию</option>
                      <option value="&amp;sort=pd.name&amp;order=asc">Название, порядок (А - Я)</option>
                      <option value="&amp;sort=pd.name&amp;order=desc">Название, порядок (Я - А)</option>
                      <option value="&amp;sort=p.price&amp;order=asc">Цена, по возрастанию</option>
                      <option value="&amp;sort=p.price&amp;order=desc">Цена, по убыванию</option>
                      <option value="&amp;sort=rating&amp;order=asc">Рейтинг, по возрастанию</option>
                      <option value="&amp;sort=rating&amp;order=desc">Рейтинг, по убыванию</option>
                    </select>
                  </form>
                </div>
                <div class="col-auto text-right">
                  <button class="btn btn-system sidebar-toggler d-lg-none" type="button" data-target="#page-sidebar" aria-controls="menu" aria-expanded="false" aria-label="Открыть фильтры">
                    <span class="fal fa-filter"></span>
                    <span>Фильтровать</span>
                  </button>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6 col-sm-4 col-md-3 mb-4">
                <div class="list-item-product-wrap">
                  <div class="list-item list-item-product">
                    <div class="item-part item-img-wrap item-img-wrap-product">
                      <span class="item-overlay">
                        <button type="button" class="btn btn-sm btn-second" data-toggle="modal" data-target="#modal-product-quick-view"><span class="fal fa-search-plus"></span> Быстрый просмотр</button>
                      </span>
                      <a href="#" class="d-block h-100" aria-label="Наушники накладные Beats BT ON MIXR Wh (MH6N2ZM/A)">
                        <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="http://tech-store.octemplates.net/image/cache/data/products/beats/7605_1-200x200.jpg" class="img-responsive img-lazy mx-auto" alt="">
                      </a>
                    </div>
                    <a href="#" class="item-part item-title link-dark">Наушники накладные Beats BT ON MIXR Наушники накладные Beats BT ON MIXR Wh (MH6N2ZM/A)</a>
                    <div class="item-part small">
                      <span class="item-rating mr-2">
                        <span class="fas fa-star"></span>
                        <span class="fas fa-star"></span>
                        <span class="fas fa-star"></span>
                        <span class="far fa-star"></span>
                        <span class="far fa-star"></span>
                      </span>
                      <span>
                        <span class="fa fa-comment" aria-hidden="true"></span>
                        <span class="product-reviews-count">0</span>
                      </span>
                    </div>
                    <div class="item-part item-price">5 817 грн.</div>
                    <div class="item-actions">
                      <div class="row flex-nowrap mx-0">
                        <button class="btn btn-outline col mr-2" aria-label="Купить в один клик">
                          <span class="fal fa-hand-pointer"></span>
                          <span class="d-none d-sm-inline">Купить</span>
                        </button>
                        <button class="btn btn-second-outline col-auto mr-2" aria-label="Добавить в избранное"><span class="fal fa-heart"></span></button>
                        <button class="btn btn-second-outline col-auto" aria-label="Добавить в корзину">
                          <span class="fal fa-shopping-basket"></span>
                          <!-- <span class="d-none d-sm-inline">В корзину</span> -->
                        </button>
                      </div>
                    </div>
                    <div class="item-part item-hidden-info">
                      <span class="item-part text-muted">Код товара: <span>art395404</span></span>
                      <p class="item-part">Apple iPad Pro - планшет, превосходящий по возможностям многие ноутбуки и даже стационарные ..Apple iPad Pro - планшет, превосходящий по возможностям многие ноутбуки и даже стационарные ..Apple iPad Pro - планшет, превосходящий по возможностям многие ноутбуки и даже стационарные ..</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="page-section">
            <div class="row grid-list">
              <div class="col-sm-6 col-md-4">
                <div class="list-item grid-item text-left">
                  <a href="#" class="item-part item-img-wrap img-proportion rectangle-1x2" aria-label="Наушники накладные Beats BT ON MIXR Wh (MH6N2ZM/A)">
                    <span class="img-proportion-inner">
                      <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="http://tech-store.octemplates.net/image/cache/catalog/6825866abf6ddc014340326b35addd51_xl-400x300.jpg" class="img-responsive img-lazy object object-cover" alt="">
                    </span>
                  </a>
                  <a href="#" class="item-part link-dark">Наушники накладные Beats BT ON MIXR Наушники накладные Beats BT ON MIXR Wh (MH6N2ZM/A)</a>
                  <p class="item-part">Apple iPad Pro - планшет, превосходящий по возможностям многие ноутбуки и даже стационарные ..Apple iPad Pro - планшет, превосходящий по возможностям многие ноутбуки и даже стационарные ..Apple iPad Pro - планшет, превосходящий по возможностям многие ноутбуки и даже стационарные ..</p>
                  <div class="item-part">
                    <div class="d-flex justify-content-between text-muted small">
                      <span class="mr-3">
                        <span class="fa fa-comment text-main" aria-hidden="true"></span>
                        <span class="article-reviews-count">0</span>
                      </span>
                      <span>
                        <span class="mr-3">
                          <span class="fa fa-calendar-alt text-main" aria-hidden="true"></span>
                          <time class="article-time">2019-11-01</time>
                        </span>
                        <span>
                          <span class="fa fa-eye text-main" aria-hidden="true"></span>
                          <span class="article-watchers-count">123412</span>
                        </span>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="page-section">
            <h1>ПОЧЕМУ ПРОИСХОДИТ ВИБРАЦИЯ ГИРОСКУТЕРА</h1>
            <div class="d-flex justify-content-between mb-4 text-muted small">
              <span class="mr-3">
                <span class="fa fa-comment text-main" aria-hidden="true"></span>
                <span class="article-reviews-count">0</span>
              </span>
              <span>
                <span class="mr-3">
                  <span class="fa fa-calendar-alt text-main" aria-hidden="true"></span>
                  <time class="article-time">2019-11-01</time>
                </span>
                <span>
                  <span class="fa fa-eye text-main" aria-hidden="true"></span>
                  <span class="article-watchers-count">123412</span>
                </span>
              </span>
            </div>
            <img src="http://tech-store.octemplates.net/image/cache/catalog/1011811_original-400x300.jpg" title="Почему происходит вибрация гироскутера" alt="Почему происходит вибрация гироскутера" class="img-responsive img-lazy float-md-left mr-md-3 mb-3">
            <p>Почему трясётся гироскутер? С этим вопросом часто сталкиваются новички, которые только-только начинают знакомиться с мини-сегвеем. Итак, если Ваш гироскутер вибрирует, это может быть вызвано… Хотя нет, давайте для начала разберёмся с тем, откуда вообще берётся эта вибрация. Вы когда-нибудь задумывались над тем, почему гироскутер не падает? Всего два колеса, никакой третьей точки опоры, а ведь платформа уверенно стоит в горизонтальном положении. Как так получается?</p>
            <p>Всё дело в гироскопах: стабилизиторах, которые постоянно вращаются и, <a href="http://tech-store.octemplates.net/news-blog/">согласно законам физики</a>, стараются сохранить направление своих колебаний. Именно эти пять вибрационных гироскопов, контролируемые микропроцессорами, и удерживают гироскутер в правильном положении. Иными словами, именно гироскопы вибрируют, и именно поэтому гироскутер трясётся. Но почему эта вибрация присутствует не всегда? Почему гироскутер не вибрирует при правильном использовании? Когда на гироскутер встаёт человек – пользователь – система моментально учитывает это, и сигналы, поступающие гироскопическим стабилизаторам, меняются. Меняются и частота вибрации, и её амплитуда, соответственно, корпус перестаёт трястись, и можно ехать с полным комфортом. Как он узнает, что на него встал человек? В большинстве моделей за это отвечают специальные кнопки – нажимные элементы, расположенные на платформе, прямо под накладкой. Встал на мини-сигвей, зажал кнопку, едешь.</p>
            <p>Почему трясётся гироскутер, если на нём уже стоит водитель? Если Вы стоите на платформе, а он всё ещё продолжает вибрировать с выраженной амплитудой, есть два наиболее вероятных варианта: Недостаточно веса. Гироскутер зависит от веса ездока, именно поэтому в характеристиках любого мини-сигвея указано такое требование, как минимальный вес пользователя. Если на гироскутере пытается прокатиться ребёнок, ему просто не хватит «килограммов», устройство будет вибрировать. Если Вы поставили на платформу только одну ногу, тот же результат. Решение: Для детей рекомендуем покупать специальные детские гироскутеры, с низким порогом минимального веса. Для взрослых: просто вставайте на платформу двумя ногами, основательно; Ошибочная постановка ног. Если Вы ставите ноги слишком близко друг к другу или к краю платформы, датчики не смогут корректно работать. В результате, гироскутер будет «думать», что пользователя на платформе в данный момент нет, отсюда и вибрации. Решение: Соблюдайте все данные производителем гироскутера рекомендации – в том числе и те, которые касаются постановки ног или положения корпуса при катании на гироскутере. В таком случае, подобных проблем у Вас не возникнет.</p>
            <p>Ребенок на детском гироскутере Я всё делаю правильно, почему гироскутер дрожит!? Если у Вас хватает веса, и Вы уверены, что ноги ставите правильно, а мини-сигвей всё равно вибрирует – это плохой признак. Скорее всего, то-то случилось с датчиками или кнопками: они вышли из строя, а значит, вибрации никуда не денутся. В этом случае мы настоятельно рекомендуем Вам обратиться в сервис. Избежать подобных проблем можно ещё на стадии выбора гироскутера: просто следите за тем, чтобы приглянувшаяся Вам модель была выпущена известной фирмой (речь о фирменных гироскутерах: Ecodrift, Ruswheel, Wmotion, Hoverbot, Smart Balance – не о китайских no-name и подделках!). Не берите китайские безымянные, именно они дрожат без видимой причины. Надеемся, эта статья была Вам полезной. Вибрация гироскутера – всего лишь особенность конструкции этого транспортного средства, которая при правильном использовании мини-сигвея абсолютно не мешает.</p>
            <p><img class="img-responsive" src="http://tech-store.octemplates.net/image/catalog/bg_artcoolstylist_2016_feature_04_moodledlighting_d.jpg" class="img-responsive img-lazy"></p>
          </div>
          <div class="page-section">
            <h1>Контакты</h1>
            <div class="row">
              <div class="col-sm-6 mb-4">
                <form action="">
                  <div class="form-group">
                    <label for="callback-name">Имя <span class="text-danger">*</span></label>
                    <input type="text" name="callback[name]" id="callback-name" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="callback-phone">Телефон <span class="text-danger">*</span></label>
                    <input type="text" name="callback[phone]" id="callback-phone" class="form-control phone" required>
                  </div>
                  <div class="form-group">
                    <label for="callback-email">Email <span class="text-danger">*</span></label>
                    <input type="email" name="callback[email]" id="callback-email" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="callback-comment">Комментарий</label>
                    <textarea name="callback[comment]" id="callback-comment" class="form-control"></textarea>
                  </div>
                  <button type="submit" class="btn">Отправить</button>
                </form>
              </div>
              <div class="col-sm-6 mb-4">
                <h2>Контактная информация</h2>
                <ul>
                  <li class="mb-4">
                    <h4>У вас общий вопрос?</h4>
                    <p>Напишите или позвоните нам — всё расскажем.</p>
                    <p>E-mail:&nbsp;<a href="mailto:contact@shopstore.com">contact@tore.com</a><br>Телефон: 0 (800) 777-10-20<br>Служба клиентской поддержки работает с 8:00 до 22:00, без выходных.</p>
                  </li>
                  <li>
                    <h4>Есть замечания или предложения как нам работать лучше?</h4>
                    <p>E-mail:&nbsp;<a href="mailto:contact@shopstore.com">contact@shopstore.com</a></p>
                  </li>
                </ul>
                <h2>Наш адрес</h2>
                <p>Россия, г. Москва. Большая Пироговская ул. 17, третий этаж, офис 315</p>
              </div>
              <div class="col">
                <div id="map" class="map"></div>
              </div>
            </div>
          </div>
          <div class="page-section">
            <section class="page-section">
              <h2>Ваша корзина</h2>
              <ul class="cart-box">
                <li class="cart-box-item">
                  <a href="/" class="cart-box-item-img-wrap img-proportion square"><span class="img-proportion-inner"><img src="http://tech-store.octemplates.net/image/cache/data/products/beats/7605_1-70x95.jpg" class="img-responsive mx-auto" alt="Наушники накладные Beats BT ON MIXR Wh (MH6N2ZM/A)"></span></a>
                  <a href="/" class="cart-box-item-title">Наушники накладные Beats BT ON MIXR Wh (MH6N2ZM/A)</a>
                  <div class="input-group input-quantity cart-box-item-input-quantity">
                    <div class="input-group-prepend">
                      <button class="btn btn-system btn-action btn-action-reduce" onclick="$(this).parent().next()[0].stepDown();$(this).next().trigger('input');" aria-label="Убрать один товар">
                        <svg viewBox="0 0 19 19" xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem">
                          <path d="M.806 8.75h17.48c.56 0 .713.336.713.75s-.197.75-.72.75H.81c-.668 0-.81-.336-.81-.75s.142-.75.806-.75z"></path>
                        </svg>
                      </button>
                    </div>
                    <input type="number" class="form-control input-quantity-field" step="1" min="1" max="20" value="1">
                    <div class="input-group-append">
                      <button class="btn btn-system btn-action btn-action-increase" onclick="$(this).parent().prev()[0].stepUp();$(this).prev().trigger('input');" aria-label="Добавить один товар">
                        <svg viewBox="0 0 19 19" xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem">
                          <path d="M10 9h8.5a.5.5 0 0 1 0 1H10v8.5a.5.5 0 1 1-1 0V10H.5a.5.5 0 1 1 0-1H9V.5a.5.5 0 0 1 1 0V9z" fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                      </button>
                    </div>
                  </div>
                  <div class="cart-box-item-price-wrap"><span class="cart-box-item-price">2345</span><span class="cart-box-item-price-currency"> грн.</span></div>
                  <button class="btn-action btn-action-remove" aria-label="Убрать товар из корзины"><span aria-hidden="true">&times;</span></button>
                </li>
              </ul>
            </section>
            <hr>
            <section class="page-section">
              <h2>Ваши данные</h2>
              <form action="">
                <div class="form-group">
                  <label for="order-name">Имя <span class="text-danger">*</span></label>
                  <input type="text" name="order[name]" id="order-name" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="order-phone">Телефон <span class="text-danger">*</span></label>
                  <input type="text" name="order[phone]" id="order-phone" class="form-control phone" required>
                </div>
                <div class="form-group">
                  <label for="order-comment">Комментарий</label>
                  <textarea name="order[comment]" id="order-comment" class="form-control"></textarea>
                </div>
              </form>
            </section>
            <hr>
            <div class="row justify-content-between align-items-end">
              <div class="col-sm-6 d-none d-sm-block m-0 pb-3"><button type="button" class="btn btn-system" data-dismiss="modal">Прододжить покупки</button></div>
              <div class="col-sm-6 m-0">
                <div class="cart-check">
                  <div class="d-flex align-items-center justify-content-between mb-3"><span class="cart-check-label">Сумма к оплате:</span> <span><span class="cart-check-digits cart-check-digits">41234</span> <span class="cart-check-currency cart-check-currency">грн.</span></span></div>
                  <button type="submit" class="btn d-block w-100">Оформить заказ</button>
                </div>
              </div>
            </div>
          </div>
          <?php if($this->page->content) { ?>
          <section class="page-content"><?php echo $this->page->content; ?></section>
          <?php } if($this->page->seo_text) { ?>
          <section class="page-seo-text"><?php echo $this->page->seo_text; ?></section>
          <?php } ?>
        </div>
      </div>