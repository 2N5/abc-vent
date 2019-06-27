<?php
$theme = Theme::ucFirstModel();
$products = $theme::models();
?>
<article itemscope itemtype="http://schema.org/Article">
  <div class="banner" style="background-image: url(/assets/img/bg-header.jpg);">
    <div class="container">
      <div class="banner-inner">
        <h1 itemprop="headline"><?= $this->article->title; ?></h1>
        <time itemprop="datePublished" class="d-block font-italic"><?= date('Y-m-d', $this->article->time); ?></time>
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
        <meta itemprop="author" content="<?= $_SERVER['SERVER_NAME']; ?>">
        <meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" itemid="<?= absoluteLink(); ?>" content="<?= absoluteLink(); ?>">
        <meta itemprop="dateModified" content="<?= date('Y-m-d', $this->article->time); ?>">
        <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization" hidden>
          <meta itemprop="name" content="<?= $_SERVER['SERVER_NAME'] ?>">
          <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
            <meta itemprop="streetAddress" content="<?= ADDRESS; ?>">
            <meta itemprop="postalCode" content="<?= PHONE; ?>">
            <meta itemprop="addressLocality" content="<?= ADDRESS; ?>">
            <meta itemprop="telephone" content="<?= ADDRESS; ?>">
            <meta itemprop="name" content="<?= absoluteLink(); ?>">
          </div>
          <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
            <img itemprop="url image" src="/assets/img/logo.png" alt="<?= absoluteLink(); ?>">
          </div>
        </div>
        <?php if (is_object($this->article->picture)) { ?>
          <img itemprop="image" src="<?= $this->article->picture->path; ?>" class="img-responsive float-md-left mr-md-4 mb-4" alt="<?=$this->article->picture->alt ? $this->article->picture->alt : $this->article->title; ?>" hidden>
        <?php } else { ?>
          <img itemprop="image" src="<?= Picture::UPLOAD_DIR . Picture::NO_IMG; ?>" class="img-responsive" alt="Нет фото" title="Нет фото" hidden>
        <?php } ?>
        <div itemprop="articleBody"><?= $this->article->content; ?></div>
      </div>
    </div>
  </div>
</article>