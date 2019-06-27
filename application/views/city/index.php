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
      <div class="row <?php if($this->page->content || $this->page->seo_text){ echo " mb-4"; } ?>" role="list">
        <?php foreach($this->citys as $city){ ?>
          <div class="col-6 mb-3" role="listitem">
            <div class="list-group-item text-center">
              <a href="<?=$this->controllerUrl($city->url); ?>" class="list-group-item-link"><?= str_replace('&nbsp;', ' ', $city->title); ?></a>
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