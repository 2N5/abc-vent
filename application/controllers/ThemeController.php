<?php

class ThemeController extends Controller {

  static $rules = array(
    'index' => array(
      'users' => array('*'),
      'redirect' => '/cp/authorize/login'
    ),
    'view' => array(
      'users' => array('*'),
      'redirect' => '/cp/authorize/login'
    ),
    'watermark' => array(
      'users' => array('*'),
      'redirect' => '/cp/authorize/login'
    ),
    'resize' => array(
      'users' => array('*'),
      'redirect' => '/cp/authorize/login'
    ),
    'blogresize' => array(
      'users' => array('*'),
      'redirect' => '/cp/authorize/login'
    ),
  );
  public $themeObjects = array();
  public $themeObject = null;

  public $breadCrumbs = '';
  public $links = array();

  public function actionIndex() {
    $this->error404();
  }

  public function actionView($url = '', $param = '') {

    if ($param != '') {
      $this->error404();
    }
    $this->takeObject($url);

    $this->init($this->themeObject);

    $this->themeObject->formInfo();
    $this->themeObject->pictureInfo();


//        if(App::gi()->theme->control == 'certificate'){
    $this->themeObject->albumInfo();
//        }

    $this->themeObject->checkMainPicture();
    $this->themeObject->siblings();
    Controller::$lastCrumb = $this->themeObject->title;

    $reviews = Review::modelsWhere('(cheked = ? OR ip = ?) AND id_theme = ?', array(Review::CONFIRMED, $_SERVER['REMOTE_ADDR'], $this->themeObject->id));
    $summ = 0;
    $amount = 0;
    $rating = 0;

    $citys = City::models();

    foreach ($reviews as $review)
    {
      $amount++;
      $summ += $review->mark;
    }

    if($amount > 0)
    {
      $rating = round($summ/$amount, 2);
    }

    $comments = Comment::themePost($this->themeObject->id);

    setlocale(LC_ALL, 'ru_RU.UTF-8');
    $this->render('view', array(
      'reviews'=>$reviews, 
      'comments'=>$comments, 
      'rating'=>$rating, 
      'amount'=>$amount,
      'citys'=>$citys
    ));
  }

  protected function meta($theme) {
    $this->meta_title = ($theme->meta_title != '') ? $theme->meta_title : $theme->title . ', цена ' . $theme->price . ' руб. в Москве и области';
    $this->meta_keywords = ($theme->meta_keywords != '') ? $theme->meta_keywords : $theme->title;
    $this->meta_description = ($theme->meta_description != '') ? $theme->meta_description : 'Купить ' . $theme->title . ', цена ' . $theme->price . ' руб. ✔ Быстрое и качественное изготовление удостоверений в Москве и области ✈ Бесплатная доставка';
  }

  protected function takeObject($url) {
    $this->themeObject = Theme::themeModel(0, 'url = ?', array($url));
    if (!$this->themeObject) {
      $this->error404();
    }
  }

  public function actionWatermark($id_pic) {
    $id_pic = explode('.', $id_pic)[0];
    $documentRoot = $_SERVER['DOCUMENT_ROOT'];
    $picture = Picture::model($id_pic);
    if (!$picture) {
      return false;
    }
    $picture->path();
        // Загрузка штампа и фото, для которого применяется водяной знак (называется штамп или печать)
    $stamp = imagecreatefrompng($documentRoot . '/' . Picture::water());
    $im = imagecreatefrompng($documentRoot . '/' . $picture->path);
        // Установка полей для штампа и получение высоты/ширины штампа
    $marge_right = 200;
    $marge_bottom = 10;
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);
    $zx = imagesx($im);
    $zy = imagesy($im);
        // Копирование изображения штампа на фотографию с помощью смещения края
        // и ширины фотографии для расчета позиционирования штампа.
    imagecopy($im, $stamp, $zx - $sx - $marge_right, $zy - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
    imagecopy($im, $stamp, $zx - $sx - $marge_right-900, $zy - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
        //Выключение альфа спряжения
    imagealphablending($im, false);
    imagealphablending($stamp, false);
        //Установка альфа флага
    imagesavealpha($im, true);
    imagesavealpha($stamp, true);
    header('Content-type: image/png');
    imagepng($im);
    imagedestroy($im);
    die();
  }

  public function ActionResize ($id_img, $width=500){
    $picture = Picture::model($id_img);

    new ImageResize($_SERVER['DOCUMENT_ROOT'].Picture::UPLOAD_DIR.$picture->id.'/'.$picture->name, $width);
  }

  public function ActionBlogresize ($id_img, $width=500){
    $picture = Picture::model($id_img);

    new ImageResize($_SERVER['DOCUMENT_ROOT']. Article::UPLOAD_DIR.$picture->id.'/'.$picture->name, $width);
  }
}
