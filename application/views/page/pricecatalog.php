<?php
$c = CategoryController::gi();
$c->modelClassName();
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
      <?php echo Sidebar::printSidebar(); ?>
    </div>
    <div class="col-md-8">
      <?php foreach($this->themeObjects as $parent) { ?>
        <section class="mb-2">
          <h2><a href="<?= absoluteLink($c->controllerUrl('', array($parent->url))); ?>"><?=$parent->title; ?></a></h2>
          <?php if (count($parent->docs)) { ?>
            <div class="list-group mb-4" role="list">
              <?php foreach($parent->docs as $object) { ?>
                <div class="list-group-item list-group-item-price" role="listitem">
                  <a href="<?=$this->controllerUrl('view', array($object->url), true); ?>" class="list-group-item-link list-group-item-link-price">
                    <span class="list-group-item-link-price-text"><?=$object->title; ?></span>
                    <div class="object-price-wrap">
                      <span class="object-price"><?=$object->price; ?> р.</span>
                      <span class="object-price-old"><?=$object->price; ?> р.</span>
                    </div>
                  </a>
                  <button class="btn" data-target="#order-modal" data-toggle="modal" data-name="<?=$object->title;?>" data-id="<?=$object->id; ?>" data-price="<?=$object->price;?>">Заказать</button>
                </div>
              <?php } ?>
            </div>
          <?php } if (count($parent->childs)) {
            foreach($parent->childs as $child) { ?>
              <section class="mb-2">
                <h3><a href="<?= absoluteLink($c->controllerUrl('', array($child->url))); ?>"><?=$child->title; ?></a></h3>
                <div class="list-group mb-4" role="list">
                  <?php foreach($child->docs as $object) { ?>
                    <div class="list-group-item list-group-item-price" role="listitem">
                      <a href="<?=$this->controllerUrl('view', array($object->url), true); ?>" class="list-group-item-link list-group-item-link-price">
                        <span class="list-group-item-link-price-text"><?=$object->title; ?></span>
                        <div class="object-price-wrap">
                          <span class="object-price"><?=$object->price; ?> р.</span>
                          <span class="object-price-old"><?=$object->price; ?> р.</span>
                        </div>
                      </a>
                      <button class="btn" data-target="#order-modal" data-toggle="modal" data-name="<?=$object->title;?>" data-id="<?=$object->id; ?>" data-price="<?=$object->price;?>">Заказать</button>
                    </div>
                  <?php } ?>
                </div>
              </section>
            <?php }
          } ?>
        </section>
      <?php } if(count($this->otherObjects)) { ?>
        <h2>Другие</h2>
        <div class="list-group <?php if($this->page->content || $this->page->seo_text){ echo 'mb-4'; } ?>" role="list">
          <?php foreach($this->otherObjects as $object) { ?>
            <div class="list-group-item list-group-item-price" role="listitem">
              <a href="<?=$this->controllerUrl('view', array($object->url), true); ?>" class="list-group-item-link list-group-item-link-price">
                <span class="list-group-item-link-price-text"><?=$object->title; ?></span>
                <div class="object-price-wrap">
                  <span class="object-price"><?=$object->price; ?> р.</span>
                  <span class="object-price-old"><?=$object->price; ?> р.</span>
                </div>
              </a>
              <button class="btn" data-target="#order-modal" data-toggle="modal" data-name="<?=$object->title;?>" data-id="<?=$object->id; ?>" data-price="<?=$object->price;?>">Заказать</button>
            </div>
          <?php } ?>
        </div>
      <?php } if($this->page->content) { ?>
        <section class="page-content"><?php echo $this->page->content; ?></section>
      <?php } if($this->page->seo_text) { ?>
        <section class="page-seo-text"><?php echo $this->page->seo_text; ?></section>
      <?php } ?>
    </div>
  </div>
</div>