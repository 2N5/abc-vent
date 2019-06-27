<?php

class CityController extends Controller {

    static $rules = array(
        'index' => array(
            'users' => array('*'),
            'redirect' => '/cp/authorize/login'
        ),
        'processing' => array(
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
    );
    public $citys = array();
    public $city = null;
    
    public function actionIndex($url = '', $param = '')
    {
        if ($param != '') {
            $this->error404();
        }
        
        $this->init(Contr::CITY);
        $this->citys = City::models();
        
        setlocale(LC_ALL, 'ru_RU.UTF-8');
        $this->render('index');
    }
    
    public function actionProcessing($url = '', $param = '')
    {
        if ($param != '') {
            $this->error404();
        }

        $citys = City::models();

        $this->takeObject($url);
        $this->city->albumInfo(true);

        $this->init($this->city);

        $reviews = Review::modelsWhere('(cheked = ? OR ip = ?) AND id_city = ?', array(Review::CONFIRMED, $_SERVER['REMOTE_ADDR'], $this->city->id));
        $summ = 0;
        $amount = 0;
        $rating = 0;
        foreach ($reviews as $review)
        {
            $amount++;
            $summ += $review->mark;
        }
        if($amount > 0)
        {
            $rating = round($summ/$amount, 2);
        }

        Controller::$lastCrumb = $this->city->title;

        $this->render('processing', array('reviews'=>$reviews, 'rating'=>$rating, 'amount'=>$amount, 'citys'=>$citys));
    }

    protected function takeObject($url) {
        $this->city = City::modelWhere('url = ?', array($url));
        if (!$this->city) {
            $this->error404();
        }
    }

    public function ActionResize ($id_img, $width=100){
        $picture = CityPicture::model($id_img);
        
        new ImageResize($_SERVER['DOCUMENT_ROOT'].CityPicture::UPLOAD_DIR.$picture->id.'/'.$picture->name, $width);
    }
    
    public function actionWatermark($id_pic) {
        $exploded = explode('.', $id_pic);
        $documentRoot = $_SERVER['DOCUMENT_ROOT'];
        $picture = CityPicture::model($exploded[0]);
        if (!$picture) {
            return false;
        }
        
        // Загрузка штампа и фото, для которого применяется водяной знак (называется штамп или печать)
        $stamp = imagecreatefrompng($documentRoot . '/' . CityPicture::water());
        switch($exploded[1])
        {
            case 'jpg' :
            case 'jpeg' :
                $im = imagecreatefromjpeg($documentRoot . '/' . $picture->path());
                break;
            default :
                $im = imagecreatefrompng($documentRoot . '/' . $picture->path());
        }
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
    
}
