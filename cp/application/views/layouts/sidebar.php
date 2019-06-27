<div class="sidebar relative">
    <div class="logo">
        <p class="hello">Вы вошли как: <a href="/cp/admin"><?= app::gi()->user->login; ?></a></p>
    </div>
    <div class="menu">
        <h3>Контент</h3>
        <ul class="sidebar_menu">
            <li><a href="/cp/">Главная</a></li>
            <li><a href="/cp/spravki/create">Добавить справку</a></li>
            <li><a href="/cp/spravki/createdublicate">Добавить справку ДУБЛИКАТ</a></li>
            <li><a href="/cp/post/qa">Добавить вопрос-ответ</a></li>
            <li><a href="/cp/post/review">Добавить отзыв</a></li>
            <li><a href="/cp/post/mi">Добавить пост мединфо</a></li>
            <li><a href="/cp/post/viewallqa">Редактировать посты вопрос-ответ</a></li>
            <li><a href="/cp/post/viewallreview">Редактировать посты отзывы</a></li>
            <li><a href="/cp/post/viewallmi">Редактировать посты мединфо</a></li>
            <!--<li><a href="/cp/content/create">Добавить статью</a></li>-->
            <!--<li><a href="/cp/content/faq">Добавить Вопрос-Ответ</a></li>-->
            <!--<li><a href="/cp/category">Категории</a></li>-->
            <li><a href="/cp/spravki">Справки</a></li>
            <li><a href="/cp/spravki/viewdublicate">ДУБЛИКАТЫ</a></li>
            <!--<li><a href="/cp/content/list">Статьи</a></li>-->
        </ul>
        <h3>Страницы сайта</h3>
        <ul class="sidebar_menu">
<!--            <li><a href="/cp/page/main">Главная</a></li>
            <li><a href="/cp/page/about">О компании</a></li>
            <li><a href="/cp/page/article">Статьи</a></li>
            <li><a href="/cp/page/pay">Оплата</a></li>
            <li><a href="/cp/page/delivery">Доставка</a></li>
            <li><a href="/cp/page/contacts">Контакты</a></li>
            <li><a href="/cp/page/faq">Вопрос - Ответ</a></li>-->
            <!--<li><a href="/cp/spravki/price">Просмотерть все справки с ценами</a></li>-->
            <li><a href="/cp/page/static">Добавить статическую страницу</a></li>
            <li><a href="/cp/page/qamain">Добавить категорию для страниц вопрос-ответ</a></li>
            <li><a href="/cp/page/qapage">Добавить страницу вопрос-ответ</a></li>
            <li><a href="/cp/page/reviewpage">Добавить страницу отзывов</a></li>
            <li><a href="/cp/page/mipage">Добавить страницу мединфо</a></li>
            <li><a href="/cp/page/viewstatic">Редактировать статическую страницу</a></li>
            <li><a href="/cp/page/viewqamain">Редактировать категорию для страниц вопрос-ответ</a></li>
            <li><a href="/cp/page/viewqa">Редактировать страницу вопрос-ответ</a></li>
            <li><a href="/cp/page/viewreview">Редактировать страницу отзывов</a></li>
            <li><a href="/cp/page/viewmi">Редактировать страницу мединфо</a></li>
        </ul>
    </div>
</div>
<div class="content">
    <div class="smallrow">
        <a href="#"></a>
        <div class="linkgroup">
            <a href="#"></a>
            <a href="#"></a>
            <a href="#"></a>
            <a href="#"></a>
        </div>
    </div>
    <div class="main">
        <?= $content; ?>
    </div>
    <div class="smallrow">
        <div class="linkgroup">
            <a href="#" class="large">Hello, admin!</a>
            <a href="#"></a>
            <a href="#"></a>
        </div>
    </div>
</div>