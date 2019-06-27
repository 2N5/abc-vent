<?php

class PageController extends Controller {

  static $rules = array(
    'about' => array(
      'users' => array('*'),
      'redirect' => '/cp/authorize/login'
    ),
    'contact' => array(
      'users' => array('*'),
      'redirect' => '/cp/authorize/login'
    ),
    'callback' => array(
      'users' => array('*'),
      'redirect' => '/cp/authorize/login'
    ),
    'delivery' => array(
      'users' => array('*'),
      'redirect' => '/cp/authorize/login'
    ),
    'price' => array(
      'users' => array('*'),
      'redirect' => '/cp/authorize/login'
    ),
    'privacy' => array(
      'users' => array('*'),
      'redirect' => '/cp/authorize/login'
    ),
    'sitemap' => array(
      'users' => array('*'),
      'redirect' => '/cp/authorize/login'
    ),
    'xml' => array(
      'users' => array('*'),
      'redirect' => '/cp/authorize/login'
    ),
  );

  protected $objects = array();
  protected $categories = array();

  public $other = array();
  public $navObjects = array();
  public $otherArticles = array();
  public $article = null;
  public $seoText = '';
  public $showCatalog = true;

  public $breadCrumbs = '';
  public $links = array();

  protected $themeObjects = array();
  protected $otherObjects = array();

  public function actionXML($param='') {
    if($param != '')
    {
      $this->error404();
    }
    $this->mainTemplate = 'clear';
    header('Content-type: xml');
    echo SiteMap::generateXML();
  }

  public function actionSiteMap($param='')
  {
    if($param != '')
    {
      $this->error404();
    }

    $this->init(Contr::MAP);

    $title = ($this->page->h1) ? $this->page->h1 : 'Карта сайта';

    echo '<div class="container px-0 px-lg-3"><h1>'.$title.'</h1></div>';
    echo SiteMap::generateHTML();
  }

  public function actionAbout($param='') {
    if($param != '')
    {
      $this->error404();
    }

    $this->init(Contr::ABOUT);
    $this->render('about');
  }

  public function actionContact($param='') {
    if($param != '')
    {
      $this->error404();
    }

    $this->init(Contr::CONTACT);
    $this->render('contact');
  }

  public function actionPrice($param='') {
    if($param != '')
    {
      $this->error404();
    }

    $this->init(Contr::PRICE);

    // $this->objects = Theme::themeModel();
    // $this->render('price');

    $this->takeCategoriesWithCerts();
    $theme = App::gi()->themeName;
    $this->otherObjects = $theme::withoutCategory();

    $this->render('pricecatalog');

  }

  public function actionCallback($param='') {
    if($param != '')
    {
      $this->error404();
    }

    $this->init(Contr::CALLBACK);
    $this->render('callback');
  }
  public function actionDelivery($param='') {
    if($param != '')
    {
      $this->error404();
    }

    $this->init(Contr::DELIVERY);
    $citys = City::models();

    $this->render('delivery', array('citys'=>$citys));
  }

  public function actionPrivacy($param='') {
    if($param != '')
    {
      $this->error404();
    }

    $this->init(Contr::PRIVACY);
    $this->render('privacy');
  }

  protected function takeExistObjects() {
    $this->objects = Theme::themeModel();
  }

  protected function takeCategoriesWithCerts()
  {
    $this->themeObjects = Category::themeParent();
    foreach($this->themeObjects as $parent)
    {
      $parent->getChilds();
      if(!count($parent->childs))
      {
        $parent->getCerts();
        $this->certsInfo($parent->docs);
        continue;
      }

      foreach($parent->childs as $child)
      {
        $child->getCerts();
        $this->certsInfo($child->docs);
      }
    }
  }

  protected function certsInfo(array $certs)
  {
    foreach($certs as $cert)
    {
      $cert->pictureInfo();
    }
  }

}
