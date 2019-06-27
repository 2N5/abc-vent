<?php
$theme = Theme::ucFirstModel();
$products = $theme::models();
?>
<div class="banner" style="background-image: url(/assets/img/bg-header.jpg);">
  <div class="container">
    <div class="banner-inner">
      <h1 class="mb-0"><?=($this->city->h1 !== '') ? $this->city->h1 : $this->city->title; ?></h1>
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
            <div class="form-group">
              <label for="order-city">Город:</label>
              <input type="text" name="order[city-name]" id="order-city" class="form-control" value="<?= $this->city->title; ?>" disabled>
              <input type="text" name="order[city]" class="form-control" value="<?= $this->city->title; ?>" hidden>
              <input type="text" name="order[id_city]" value="<?= $this->city->id; ?>" hidden>
            </div>
            <p class="form-disclaimer">Отправляя данную форму, вы подтверждаете согласие на обработку ваших персональных данных в соответствии с <a href="<?=absoluteLink(Contr::printUrl(Contr::PRIVACY)); ?>" target="_blank">Политикой конфиденциальности</a></p>
          </div>
          <button class="btn btn-lg w-100" type="submit">Заказать</button>
        </form>
      </aside>
    </div>
    <div class="col-md-8 mb-4">
      <?php if ($this->city->album) { ?>
        <div class="row mb-4" role="list">
          <?php foreach($this->city->album as $photo){ ?>
            <div class="col-6 col-sm-4 col-md-3 mb-3" role="listitem">
              <figure class="card mb-0">
                <a href="<?= $photo->path.'/800'; ?>" class="img-proportion square card-img-overlay" data-fancybox="1">
                  <span class="img-proportion-inner">
                    <img class="img-responsive w-100 h-100 object-cover" src="<?= $photo->path.'/500'; ?>" alt="<?= $this->city->title; ?>">
                  </span>
                </a>
              </figure>
            </div>
          <?php } ?>
        </div>
      <?php } if($this->city->content) { ?>
        <section class="page-content"><?php echo $this->city->content; ?></section>
      <?php } if($this->city->seo_text) { ?>
        <section class="page-seo-text"><?php echo $this->city->seo_text; ?></section>
      <?php } ?>
      <section>
        <h2>Отзывы</h2>
        <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating" hidden>
          <?php $mark = 0; foreach ($reviews as $review){
            $mark += $review->mark;
          } ?>
          <meta itemprop="ratingValue" content="<?= count($reviews) ? round(($mark / count($reviews)), 2) : 0; ?>">
          <meta itemprop="reviewCount" content="<?= count($reviews); ?>">
        </div>
        <?php if($amount) { ?>
          <div role="list">
            <?php foreach ($reviews as $review){ ?>
              <blockquote itemprop="review" itemscope itemtype="http://schema.org/Review" class="card mb-3" role="listitem">
                <div class="card-body">
                  <h4 itemprop="author" class="mb-1"><?=$review->name; ?></h4>
                  <cite class="<?php if($review->text) { echo "d-block mb-2"; } ?>">
                    <?php if ($review->city): ?>
                      <span itemprop="itemReviewed" role="note" class="d-block mb-1 font-normal"><?=$review->city; ?></span>
                    <?php endif ?>
                    <span itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" role="note" class="text-btn d-block">
                      <meta itemprop="worstRating" content="0">
                      <meta itemprop="bestRating" content="5">
                      <meta itemprop="ratingValue" content="<?=$review->mark; ?>">
                      <?php for ($i=0; $i < $review->mark; $i++) { ?>
                        <i class="icon-star"></i>
                      <?php } ?>
                    </span>
                    <time itemprop="datePublished" class="small"><?=strftime('%Y-%m-%d', $review->time); ?></time>
                  </cite>
                  <?php if ($review->text) { ?>
                    <q itemprop="description" class="card-text"><?=str_replace('&nbsp;' , ' ', $review->text); ?></q>
                  <?php } ?>
                </div>
              </blockquote>
            <?php } ?>
          </div>
        <?php } else {
          echo '<p>Пока что нет отзывов</p>';
        } ?>
      </section>
    </div>
    <div class="col-md-4">
      <div class="form-bg"></div>
    </div>
    <div class="col-md-8">
      <section>
        <form method="POST" class="card card-lg">
          <div class="card-body">
            <h3 class="text-center">Оставить отзыв</h3>
            <div class="form-group">
              <label for="review-name">Имя:</label>
              <input type="text" name="review[name]" id="review-name" class="form-control" title="Только русские буквы" pattern="\s*[А-ЯЁа-яё]+[А-ЯЁа-яё\s-]*" required>
            </div>
            <div class="form-group">
              <label for="review-city">Город:</label>
              <input type="text" name="review[city-name]" id="review-city" class="form-control" value="<?= $this->city->title; ?>" disabled>
              <input type="text" name="review[city]" class="form-control" value="<?= $this->city->title; ?>" hidden>
              <input type="text" name="review[id_city]" value="<?= $this->city->id; ?>" hidden>
            </div>
            <div class="form-group">
              <label for="review-text">Сообщение:</label>
              <textarea name="review[text]" id="review-text" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <label class="form-mark-description">Оценка: </label>
              <div class="form-mark-wrap">
                <div class="form-mark">
                  <label for="form-mark-input-1" class="form-mark-label"><i class="icon-star"></i></label>
                  <input type="radio" id="form-mark-input-1" name="review[mark]" class="form-mark-input" value="1" required>
                  <label for="form-mark-input-2" class="form-mark-label"><i class="icon-star"></i></label>
                  <input type="radio" id="form-mark-input-2" name="review[mark]" class="form-mark-input" value="2" required>
                  <label for="form-mark-input-3" class="form-mark-label"><i class="icon-star"></i></label>
                  <input type="radio" id="form-mark-input-3" name="review[mark]" class="form-mark-input" value="3" required>
                  <label for="form-mark-input-4" class="form-mark-label"><i class="icon-star"></i></label>
                  <input type="radio" id="form-mark-input-4" name="review[mark]" class="form-mark-input" value="4" required>
                  <label for="form-mark-input-5" class="form-mark-label"><i class="icon-star"></i></label>
                  <input type="radio" id="form-mark-input-5" name="review[mark]" class="form-mark-input" value="5" required checked>
                </div>
              </div>
            </div>
            <p class="form-disclaimer">Отправляя данную форму, вы подтверждаете согласие на обработку ваших персональных данных в соответствии с <a href="<?=absoluteLink(Contr::printUrl(Contr::PRIVACY)); ?>" target="_blank">Политикой конфиденциальности</a></p>
          </div>
          <button type="submit" class="btn btn-lg btn-outline">Отправить</button>
        </form>
      </section>
    </div>
  </div>
</div>
