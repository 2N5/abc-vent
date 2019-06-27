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
      <?php echo Sidebar::printSidebar(); ?>
    </div>
    <div class="col-md-8 mb-5">
      <div class="mb-5" itemscope itemtype="http://schema.org/Question" role="list">
        <?php foreach ($this->faqs as $faq) { ?>
          <div class="card mb-3" role="listitem">
            <div class="card-body">
              <div class="d-flex align-items-start justify-content-between">
                <div class="mb-3">
                  <span class="card-definition">Вопрос:</span>
                  <h5 class="mb-0" itemprop="name"><?= str_replace('&nbsp;', ' ', $faq->question); ?>?</h5>
                </div>
                <div class="text-right d-none d-sm-block">
                  <span class="mb-1 font-weight-bold"><?= $faq->name; ?></span>
                  <time itemprop="datePublished" class="d-block small font-italic text-muted"><?=strftime('%Y-%m-%d ', $faq->time); ?></time>
                </div>
              </div>
              <span class="card-definition">Ответ:</span>
              <q itemprop="text" class="d-block"><?= ($faq->answer) ? str_replace('&nbsp;', ' ', $faq->answer) : 'На вопрос еще не ответили..'; ?></q>
            </div>
          </div>
        <?php } ?>
      </div>
      <?php if ($this->navigationPages > 1) { ?>
        <ul class="pagination mb-4" role="group" aria-label="page navigation">
          <?php for ($i = 0; $i < $this->navigationPages; $i++) {
            $class = $this->currentPage == $i ? 'active' : '';
            $value = $i + 1;
            $href = ($i == 0) ? '/'.Contr::printUrl(Contr::FAQ) : '/'.Contr::printUrl(Contr::FAQ).'/'.$value; ?>
            <li class="page-item <?= $class; ?>"><a class="page-link" href="<?= $href; ?>"><?= $value; ?></a></li>
          <?php } ?>
        </ul>
      <?php } ?>
      <?php if($this->page->content) { ?>
        <section class="page-content"><?php echo $this->page->content; ?></section>
      <?php } if($this->page->seo_text) { ?>
        <section class="page-seo-text"><?php echo $this->page->seo_text; ?></section>
      <?php } ?>
    </div>
    <div class="col-md-4">
      <div class="form-bg"></div>
    </div>
    <div class="col-md-8">
      <section>
        <form method="POST" class="card card-lg">
          <div class="card-body">
            <h3 class="text-center">Задать вопрос</h3>
            <div class="form-group">
              <label for="faq-name">Имя:</label>
              <input type="text" name="faq[name]" id="faq-name" class="form-control" title="Только русские буквы" pattern="\s*[А-ЯЁа-яё]+[А-ЯЁа-яё\s-]*" required>
            </div>
            <div class="form-group">
              <label for="faq-question">Вопрос:</label>
              <textarea name="faq[question]" id="faq-question" class="form-control" required></textarea>
            </div>
            <p class="form-disclaimer">Отправляя данную форму, вы подтверждаете согласие на обработку ваших персональных данных в соответствии с <a href="<?=absoluteLink(Contr::printUrl(Contr::PRIVACY)); ?>" target="_blank">Политикой конфиденциальности</a></p>
          </div>
          <button class="btn btn-lg btn-outline" type="submit">Отправить</button>
        </form>
      </section>
    </div>
  </div>
</div>