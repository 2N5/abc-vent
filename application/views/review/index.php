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
      <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating" hidden>
        <?php $mark = 0; foreach ($this->reviews as $review){
          $mark += $review->mark;
        } ?>
        <meta itemprop="ratingValue" content="<?= count($this->reviews) ? round(($mark / count($this->reviews)), 2) : 0; ?>">
        <meta itemprop="reviewCount" content="<?= count($this->reviews); ?>">
      </div>
      <?php if (!$amount) {
        echo '<p>На данный момент нет отзывов</p>';
      } else { ?>
        <div class="mb-5" role="list">
          <?php foreach ($this->reviews as $review){ ?>
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
      <?php }
      if ($this->navigationPages > 1) { ?>
        <ul class="pagination mb-4" role="group" aria-label="page navigation">
          <?php for ($i = 0; $i < $this->navigationPages; $i++) {
            $class = $this->currentPage == $i ? 'active' : '';
            $value = $i + 1;
            $href = ($i == 0) ? '/'.Contr::printUrl(Contr::REVIEW) : '/'.Contr::printUrl(Contr::REVIEW).'/'.$value; ?>
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
            <h3 class="text-center">Оставить отзыв</h3>
            <div class="form-group">
              <label for="review-name">Имя:</label>
              <input type="text" name="review[name]" id="review-name" class="form-control" title="Только русские буквы" pattern="\s*[А-ЯЁа-яё]+[А-ЯЁа-яё\s-]*" required>
            </div>
            <div class="form-group">
              <label for="review-city">Город:</label>
              <input type="text" name="review[city-name]" id="review-city" class="form-control">
            </div>
            <div class="form-group">
              <label for="review-text">Сообщение:</label>
              <textarea name="review[text]" id="review-text" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <label class="form-mark-description">Оценка:</label>
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
