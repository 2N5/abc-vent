<div class="banner" style="background-image: url(/assets/img/bg-header.jpg);">
  <div class="container">
    <div class="banner-inner">
      <h1 class="mb-0"><?=($this->page->h1 !== '') ? $this->page->h1 : $this->page->title; ?></h1>
    </div>
  </div>
</div>
<?php echo BreadCrumb::links(); ?>
<div class="container">
  <div class="row">
    <div class="col-md-4 d-none d-md-block mb-5">
      <div class="contact-bg"></div>
    </div>
    <div class="col-md-8 mb-5">
      <form method="POST" class="card card-lg">
        <div class="card-body">
          <div class="h3 text-center">Обратная связь</div>
          <div class="form-group">
            <label for="page-callback-name">Имя:</label>
            <input type="text" name="callback[name]" id="page-callback-name" class="form-control" title="Только русские буквы" pattern="\s*[А-ЯЁа-яё]+[А-ЯЁа-яё\s-]*" required>
          </div>
          <div class="form-group">
            <label for="page-callback-phone">Телефон:</label>
            <input type="text" name="callback[phone]" id="page-callback-phone" class="form-control phone" required>
          </div>
          <div class="form-group">
            <label for="page-callback-text">Сообщение:</label>
            <textarea name="callback[text]" id="page-callback-text" class="form-control"></textarea>
          </div>
          <p class="form-disclaimer">Отправляя данную форму, вы подтверждаете согласие на обработку ваших персональных данных в соответствии с <a href="<?=absoluteLink(Contr::printUrl(Contr::PRIVACY)); ?>" target="_blank">Политикой конфиденциальности</a></p>
        </div>
        <button class="btn btn-lg btn-outline" type="submit">Заказать</button>
      </form>
    </div>
    <div class="col-md-4 d-none d-md-block">
      <?php echo Sidebar::printSidebar(); ?>
    </div>
    <div class="col-md-8">
      <?php if($this->page->content) { ?>
        <section class="page-content"><?php echo $this->page->content; ?></section>
      <?php } if($this->page->seo_text) { ?>
        <section class="page-seo-text"><?php echo $this->page->seo_text; ?></section>
      <?php } ?>
    </div>
  </div>
</div>