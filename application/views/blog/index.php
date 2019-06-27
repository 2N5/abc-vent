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
    <div class="col-md-8">
      <?php if(count($this->articles)) { ?>
        <div class="mb-5" role="list">
          <?php foreach ($this->articles as $article) { $article->takePicture(); ?>
            <article itemscope itemtype="http://schema.org/Article" class="card mb-3">
              <meta itemprop="author" content="<?= $_SERVER['SERVER_NAME']; ?>">
              <meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" itemid="<?= absoluteLink(); ?>" content="<?= absoluteLink(); ?>">
              <meta itemprop="dateModified" content="<?= date('Y-m-d', $article->time); ?>">
              <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization" hidden>
                <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                  <meta itemprop="streetAddress" content="<?= ADDRESS; ?>">
                  <meta itemprop="postalCode" content="<?= PHONE; ?>">
                  <meta itemprop="addressLocality" content="<?= ADDRESS; ?>">
                  <meta itemprop="telephone" content="<?= ADDRESS; ?>">
                  <meta itemprop="name" content="<?= absoluteLink(); ?>">
                </div>
                <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                  <img itemprop="url image" src="/assets/img/logo.png" alt="<?= absoluteLink(); ?>" hidden>
                </div>
                <meta itemprop="name" content="<?= $_SERVER['SERVER_NAME'] ?>">
              </div>
              <?php if (is_object($article->picture)) { ?>
                <img itemprop="image" src="<?= $article->picture->path; ?>" class="img-responsive" alt="<?= $article->picture->alt ? $article->picture->alt : $article->title; ?>" hidden>
              <?php } else { ?>
                <img itemprop="image" src="<?= Picture::UPLOAD_DIR . Picture::NO_IMG; ?>" alt="Нет фото" title="Нет фото" hidden>
              <?php } ?>
              <div class="card-body">
                <h5><a itemprop="headline" href="<?= $this->controllerUrl($article->url); ?>"><?= $article->title; ?></a></h5>
                <p itemprop="articleBody" class="card-text"><?= substr(str_replace('&nbsp;', ' ', strip_tags($article->description)), 0, 200); ?></p>
              </div>
              <div class="card-footer d-flex justify-content-between align-items-center">
                <time itemprop="datePublished" class="text-muted font-italic"><?= date('Y-m-d', $article->time); ?></time>
                <a href="<?= $this->controllerUrl($article->url); ?>" class="flex-grow-0">Подробнее</a>
              </div>
            </article>
          <?php } ?>
        </div>
      <?php } else {
        echo '<p>Пока что нет новостей</p>';
      }
      if($this->navigationPages > 1){ ?>
        <ul class="pagination <?php if($this->page->content || $this->page->seo_text){ echo "mb-4"; } ?>" role="group" aria-label="page navigation">
          <?php for ($i = 0; $i < $this->navigationPages; $i++) {
            $class = $this->currentPage == $i ? 'active' : '';
            $value = $i + 1;
            $href = ($i == 0) ? '/'.Contr::printUrl(Contr::BLOG) : '/'.Contr::printUrl(Contr::BLOG).'/'.$value; ?>
            <li class="page-item <?= $class; ?>"><a class="page-link" href="<?= $href; ?>"><?= $value; ?></a></li>
          <?php } ?>
        </ul>
      <?php } ?>
      <?php if($this->page->content || $this->page->seo_text){ ?>
        <div class="page-section">
          <?php if($this->page->content) { ?>
            <section class="page-content"><?php echo $this->page->content; ?></section>
          <?php }
          if($this->page->seo_text) { ?>
            <section class="page-seo-text"><?php echo $this->page->seo_text; ?></section>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
  </div>
</div>