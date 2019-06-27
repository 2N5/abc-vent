<?php

class Sidebar {

  public static function printSidebar() {

    $theme = App::gi()->themeName;
    $categories = Category::themeCats();
    $other = $theme::withoutCategory();
    $articles = Article::modelsWhere('id ORDER BY time DESC LIMIT 0, 9');
    $c = CategoryController::gi();
    $b = BlogController::gi();
    $c->modelClassName();
    $b->modelClassName();

    $sidebar = '<aside id="page-sidebar" class="page-sidebar">';

    $widgetCatalog = '<div class="widget">';
    $widgetCatalog .= '<button class="widget-title widget-collapse-toggler" type="button" data-toggle="collapse" aria-label="Открыть / Закрыть" data-target="#widget-collapse-catalog"><span class="widget-collapse-toggler-text">Категории</span><span class="widget-collapse-toggler-icon"></span></button>';
    $widgetCatalog .= '<div id="widget-collapse-catalog" class="widget-collapse collapse">';
    if (count($categories) || count($other)) {
      $widgetCatalog .= '<ul id="widget-catalog-list" class="widget-list">';
      $i = 1;
      foreach ($categories as $parent) {
        $parent->getCerts();
        $widgetCatalog .= '<li class="widget-list-item">';
        $widgetCatalog .= '<a href="' . absoluteLink($c->controllerUrl('', array($parent->url))) . '" class="widget-link">' . $parent->title . '</a>';
        if (count($parent->childs)) {
          $widgetCatalog .= '<button class="widget-collapse-toggler" type="button" data-toggle="collapse" aria-label="Открыть / Закрыть" data-target="#widget-catalog-collapse-'.$i.'" aria-expanded="false"';
          $widgetCatalog .= '" aria-controls="widget-catalog-collapse-'.$i.'"><span class="widget-collapse-toggler-icon"></span></button>';
          $widgetCatalog .= '<div id="widget-catalog-collapse-'.$i.'" class="widget-collapse collapse" data-parent="#widget-catalog-list">';
          $widgetCatalog .= '<ul id="widget-catalog-list-secondary" class="widget-list">';
          $j = 1;
          foreach ($parent->childs as $child) {
            $child->getCerts();
            $widgetCatalog .= '<li class="widget-list-item">';
            $widgetCatalog .= '<a href="' . absoluteLink($c->controllerUrl('', array($child->url))) . '" class="widget-link">' . $child->title . '</a>';
            if (count($child->docs)) {
              $widgetCatalog .= '<button class="widget-collapse-toggler" type="button" data-toggle="collapse" aria-label="Открыть / Закрыть" data-target="#widget-catalog-collapse-'.$i.'-'.$j.'" aria-expanded="false" aria-controls="widget-catalog-collapse-'.$i.'-'.$j.'"><span class="widget-collapse-toggler-icon"></span></button>';
              $widgetCatalog .= '<div id="widget-catalog-collapse-'.$i.'-'.$j.'" class="widget-collapse collapse" data-parent="#widget-catalog-list-secondary">';
              $widgetCatalog .= '<ul class="widget-list">';
              foreach ($child->docs as $object) {
                $widgetCatalog .= '<li class="widget-list-item">';
                $widgetCatalog .= '<a class="widget-link widget-product-link" href="' . $c->controllerUrl('view', array($object->url), true) . '">' . $object->title . '</a>';
                $widgetCatalog .= '</li>';
              }
              $widgetCatalog .= '</ul>';
              $widgetCatalog .= '</div>';
            }
            $widgetCatalog .= '</li>';
            $j += 1;
          }
          $widgetCatalog .= '</ul>';
          $widgetCatalog .= '</div>';
          $i += 1;
        }
        if (count($parent->docs)) {
          $widgetCatalog .= '<button class="widget-collapse-toggler" type="button" data-toggle="collapse" aria-label="Открыть / Закрыть" data-target="#widget-catalog-collapse-'.$i.'" aria-expanded="false"';
          $widgetCatalog .= '" aria-controls="widget-catalog-collapse-'.$i.'"><span class="widget-collapse-toggler-icon"></span></button>';
          $widgetCatalog .= '<div id="widget-catalog-collapse-'.$i.'" class="widget-collapse collapse" data-parent="#widget-catalog-list">';
          $widgetCatalog .= '<ul class="widget-list">';
          foreach ($parent->docs as $object) {
            $widgetCatalog .= '<li class="widget-list-item">';
            $widgetCatalog .= '<a class="widget-link widget-product-link" href="' . $c->controllerUrl('view', array($object->url), true) . '">' . $object->title . '</a>';
            $widgetCatalog .= '</li>';
          }
          $widgetCatalog .= '</ul>';
          $widgetCatalog .= '</div>';
          $i += 1;
        }
        $widgetCatalog .= '</li>';
      }
      if (count($other)) {
        $widgetCatalog .= '<li class="widget-list-item">Другие';
        $widgetCatalog .= '<ul class="widget-list">';
        foreach ($other as $object) {
          $widgetCatalog .= '<li class="widget-list-item">';
          $widgetCatalog .= '<a class="object-title" href="' . $c->controllerUrl('view', array($object->url), true) . '">' . $object->title . '</a>';
          $widgetCatalog .= '</li>';
        }
        $widgetCatalog .= '</ul>';
        $widgetCatalog .= '</li>';
      }
      $widgetCatalog .= '</ul>';
    } else {
      $widgetCatalog .= '<div class="widget-body"><p>Категорий нет..</p></div>';
    }
    $widgetCatalog .= '</div>';
    $widgetCatalog .= '</div>';


    $widgetBlog = '<div class="widget">';
    $widgetBlog .= '<div class="widget-title"><a href="" class="widget-link">Последние новости</a><button class="widget-collapse-toggler" type="button" data-toggle="collapse" aria-label="Открыть / Закрыть" data-target="#widget-collapse-blog"><span class="widget-collapse-toggler-icon"></span></button></div>';
    if (count($articles)) {
      $widgetBlog .= '<div id="widget-collapse-blog" class="widget-collapse collapse">';
      $widgetBlog .= '<ul class="widget-list">';
      foreach ($articles as $article) {
        $widgetBlog .= '<li class="widget-list-item"><a href="'. $b->controllerUrl($article->url) .'" class="widget-link">' . $article->title . '</a></li>';
      }
      $widgetBlog .= '</ul>';
      $widgetBlog .= '</div>';
    }
    $widgetBlog .= '</div>';

    $widgetBlog2 = '<div class="widget">';
    $widgetBlog2 .= '<div class="widget-title"><span class="widget-title-text">Последние новости</span></div>';
    if (count($articles)) {
      $widgetBlog2 .= '<div id="widget-collapse-blog" class="widget-collapse collapse">';
      $widgetBlog2 .= '<ul class="widget-list">';
      foreach ($articles as $article) {
        $widgetBlog2 .= '<li class="widget-list-item"><a href="'. $b->controllerUrl($article->url) .'" class="widget-link">' . $article->title . '</a></li>';
      }
      $widgetBlog2 .= '</ul>';
      $widgetBlog2 .= '</div>';
    }
    $widgetBlog2 .= '</div>';

    $sidebar .= $widgetCatalog;
    $sidebar .= $widgetBlog;
    $sidebar .= $widgetBlog2;

    $sidebar .= '</aside>';

    return $sidebar;
  }

}
