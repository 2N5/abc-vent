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
    <div class="col-md-4 offset-md-2 d-none d-md-block">
      <div class="contact-bg"></div>
    </div>
    <div class="col-md-6">
      <dl class="contact-list">
        <dt>Телефон:</dt>
        <dd><a href="tel:<?= TEL; ?>"><?= PHONE; ?></a></dd>
        <dt>Режим работы call-центра:</dt>
        <dd>08:00 - 21:00 пн. - пт.</dd>
        <?php if (EMAIL != '') { ?>
          <dt>E-mail:</dt>
        <?php } ?>
        <?php if (EMAIL != '') { ?>
          <dd><a href="mailto:<?= EMAIL; ?>"><?= EMAIL; ?></a></dd>
        <?php } ?>
        <dt>Адрес:</dt>
        <dd><address>Москва, ул. Петровского, 27</address></dd>
      </dl>
    </div>
  </div>
</div>