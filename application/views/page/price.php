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
      <div class="list-group <?php if($this->page->content || $this->page->seo_text){ echo 'mb-4'; } ?>" role="list">
        <?php foreach ($this->objects as $object){ ?>
          <div class="list-group-item list-group-item-price" role="listitem">
            <a href="<?=$this->controllerUrl('view', array($object->url), true); ?>" class="list-group-item-link list-group-item-link-price h5 mb-0"><?=$object->title; ?></a>
            <div class="list-group-item-price-order">
              <div class="object-price-wrap object-price-wrap-second">
                <span class="object-price"><?=$object->price; ?> р.</span>
                <span class="object-price-old"><?=$object->price; ?> р.</span>
              </div>
              <button class="btn btn-lg list-group-item-price-btn" data-target="#order-modal" data-toggle="modal" data-name="<?=$object->title;?>" data-id="<?=$object->id; ?>" data-price="<?=$object->price;?>">Заказать</button>
            </div>
          </div>
        <?php } ?>
      </div>
      <?php if($this->page->content) { ?>
        <section class="page-content"><?php echo $this->page->content; ?></section>
      <?php } if($this->page->seo_text) { ?>
        <section class="page-seo-text"><?php echo $this->page->seo_text; ?></section>
      <?php } ?>
    </div>
  </div>
</div>