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
      <?php foreach($this->themeObjects as $parent) { ?>
        <section class="mb-4">
          <h2><a href="<?= absoluteLink($this->controllerUrl('', array($parent->url))); ?>"><?=$parent->title; ?></a></h2>
          <?php if (count($parent->docs)) { ?>
            <div class="row mb-2">
              <?php foreach($parent->docs as $object) { ?>
                <div class="col-6 col-sm-4 mb-3">
                  <div class="object-card card h-100">
                    <a class="object-img-wrap card-img-overlay img-proportion rectangle-1x2" href="<?=$this->controllerUrl('view', array($object->url), true); ?>">
                      <span class="img-proportion-inner">
                        <?php if ($object->picture) { ?>
                          <img src="<?= Picture::UPLOAD_DIR . Picture::NO_IMG; ?>" data-src="<?=$object->picture->path.'/500'; ?>" class="img-responsive img-lazy" alt="<?=$object->picture->alt ? $object->picture->alt : $object->title; ?>"
                          title="<?= $object->picture->title; ?>">
                        <?php } else { ?>
                          <img src="<?= Picture::UPLOAD_DIR . Picture::NO_IMG; ?>" class="img-responsive" alt="Нет фото" title="Нет фото">
                        <?php } ?>
                      </span>
                    </a>
                    <div class="object-body">
                      <a href="<?=$this->controllerUrl('view', array($object->url), true); ?>" class="object-title"><?=$object->title; ?></a>
                      <div class="object-price-wrap">
                        <span class="object-price"><?=$object->price; ?> р.</span>
                        <span class="object-price-old"><?=$object->price; ?> р.</span>
                      </div>
                    </div>
                    <button class="btn" data-target="#order-modal" data-toggle="modal" data-name="<?=$object->title;?>" data-id="<?=$object->id; ?>" data-price="<?=$object->price;?>">Заказать</button>
                  </div>
                </div>
              <?php } ?>
            </div>
          <?php } if (count($parent->childs)) {
            foreach($parent->childs as $child) { ?>
              <section class="mb-4">
                <h3><a href="<?= absoluteLink($this->controllerUrl('', array($child->url))); ?>"><?=$child->title; ?></a></h3>
                <div class="row">
                  <?php foreach($child->docs as $object) { ?>
                    <div class="col-6 col-sm-4 mb-3">
                      <div class="object-card card h-100">
                        <a class="object-img-wrap card-img-overlay img-proportion rectangle-1x2" href="<?=$this->controllerUrl('view', array($object->url), true); ?>">
                          <span class="img-proportion-inner">
                            <?php if ($object->picture) { ?>
                              <img src="<?= Picture::UPLOAD_DIR . Picture::NO_IMG; ?>" data-src="<?=$object->picture->path.'/500'; ?>" class="img-responsive img-lazy" alt="<?=$object->picture->alt ? $object->picture->alt : $object->title; ?>"
                              title="<?= $object->picture->title; ?>">
                            <?php } else { ?>
                              <img src="<?= Picture::UPLOAD_DIR . Picture::NO_IMG; ?>" class="img-responsive" alt="Нет фото" title="Нет фото">
                            <?php } ?>
                          </span>
                        </a>
                        <div class="object-body">
                          <a href="<?=$this->controllerUrl('view', array($object->url), true); ?>" class="object-title"><?=$object->title; ?></a>
                          <div class="object-price-wrap">
                            <span class="object-price"><?=$object->price; ?> р.</span>
                            <span class="object-price-old"><?=$object->price; ?> р.</span>
                          </div>
                        </div>
                        <button class="btn" data-target="#order-modal" data-toggle="modal" data-name="<?=$object->title;?>" data-id="<?=$object->id; ?>" data-price="<?=$object->price;?>">Заказать</button>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </section>
            <?php }
          } ?>
        </section>
      <?php } if(count($this->otherObjects)) { ?>
        <section class="<?php if($this->page->content || $this->page->seo_text){ echo "mb-4"; } ?>">
          <h2>Другие</h2>
          <div class="row">
            <?php foreach($this->otherObjects as $object) { ?>
              <div class="col-6 col-sm-4 mb-3">
                <div class="object-card card h-100">
                  <a class="object-img-wrap card-img-overlay img-proportion rectangle-1x2" href="<?=$this->controllerUrl('view', array($object->url), true); ?>">
                    <span class="img-proportion-inner">
                      <?php if ($object->picture) { ?>
                        <img src="<?= Picture::UPLOAD_DIR . Picture::NO_IMG; ?>" data-src="<?=$object->picture->path.'/500'; ?>" class="img-responsive img-lazy" alt="<?=$object->picture->alt ? $object->picture->alt : $object->title; ?>"
                        title="<?= $object->picture->title; ?>">
                      <?php } else { ?>
                        <img src="<?= Picture::UPLOAD_DIR . Picture::NO_IMG; ?>" class="img-responsive" alt="Нет фото" title="Нет фото">
                      <?php } ?>
                    </span>
                  </a>
                  <div class="object-body">
                    <a href="<?=$this->controllerUrl('view', array($object->url), true); ?>" class="object-title"><?=$object->title; ?></a>
                    <div class="object-price-wrap">
                      <span class="object-price"><?=$object->price; ?> р.</span>
                      <span class="object-price-old"><?=$object->price; ?> р.</span>
                    </div>
                  </div>
                  <button class="btn" data-target="#order-modal" data-toggle="modal" data-name="<?=$object->title;?>" data-id="<?=$object->id; ?>" data-price="<?=$object->price;?>">Заказать</button>
                </div>
              </div>
            <?php } ?>
          </div>
        </section>
      <?php } if($this->page->content) { ?>
        <section class="page-content"><?php echo $this->page->content; ?></section>
      <?php } if($this->page->seo_text) { ?>
        <section class="page-seo-text"><?php echo $this->page->seo_text; ?></section>
      <?php } ?>
    </div>
  </div>
</div>