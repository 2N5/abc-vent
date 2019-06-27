<?php
$theme = Theme::ucFirstModel();
$products = $theme::models();
?>
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
    <div class="col-md-4 d-none d-md-block">
      <aside id="page-sidebar" class="page-sidebar sticky sticky-sidebar">
        <form method="POST" class="card">
          <div class="card-body">
            <div class="h2 text-center font-weight-normal">Сделать заказ</div>
            <div class="form-group">
              <label for="order-document">Документ:</label>
              <select name="order[doc]" id="order-document" class="custom-select form-control" required>
                <option label="Выберите удостоверение" disabled hidden selected></option>
                <?php foreach($products as $object){ ?>
                  <option value="<?= $object->id; ?>"><?= $object->title; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="order-name">Имя:</label>
              <input type="text" name="order[name]" id="order-name" class="form-control" title="Только русские буквы" pattern="\s*[А-ЯЁа-яё]+[А-ЯЁа-яё\s-]*" required>
            </div>
            <div class="form-group">
              <label for="order-phone">Телефон:</label>
              <input type="text" name="order[phone]" id="order-phone" class="form-control phone" required>
            </div>
            <p class="form-disclaimer">Отправляя данную форму, вы подтверждаете согласие на обработку ваших персональных данных в соответствии с <a href="<?=absoluteLink(Contr::printUrl(Contr::PRIVACY)); ?>" target="_blank">Политикой конфиденциальности</a></p>
          </div>
          <button class="btn btn-lg w-100" type="submit">Заказать</button>
        </form>
      </aside>
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
