<?php

class Picture extends ModelTable {

    const MAIN = 1;
    const ALBUM = 0;
    const UPLOAD_DIR = '/uploads/';
    const WATERMARK = 'watermark.png';
    const WATERMARK_400 = 'watermark_400.png';
    const NO_IMG = 'noimg.png';

    public static $table = 'picture';
    public $safe = array('id', 'name', 'alt', 'title', 'id_theme', 'is_main');
    protected $model = null;
    protected $files = array();
    public $path = '';

    public static function takePicture(Theme $model) {
        if(!$model){
            return false;
        }
        
        $app = App::gi();
        $modelTheme = ucfirst($app->theme->control);//dorabotat bu test i vse takoe
        if(!$modelTheme::model($model->id)){
            return false;
        }
        
        $picture = self::modelWhere('id_theme = ? AND is_main = ?', array($model->id, self::MAIN));
        if(!$picture){
            return false;
        }
        
        $picture->resizePath();
        
        return $picture;
    }

    public static function takeAlbum(ModelTable $model) {
        if (!$model) {
            return false;
        }

//        $pictures = self::modelsWhere('id_theme = ? AND is_main = ?', array($model->id, self::ALBUM));
        $pictures = self::modelsWhere('id_theme = ?', array($model->id));
        foreach ($pictures as $picture) {
            $picture->resizePath();
        }

//        debug($pictures, true);
        return $pictures;
    }

    public function path() {
        $this->path = self::UPLOAD_DIR . $this->id . '/' . $this->name;
    }
    
    public function waterPath() {
        return '/theme/watermark/'.$this->id.'.png';
    }
    
    public function resizePath() {
        $this->path = '/theme/resize/'.$this->id;
    }

    public static function water() {
        return self::UPLOAD_DIR . self::WATERMARK;
    }

    public static function water400() {
        return self::UPLOAD_DIR . self::WATERMARK_400;
    }

    public static function allExistObjects($id_theme) {
        return self::modelsWhere('id_theme = ?', array($id_theme));
    }

    public static function singleExistObject($id) {
        return self::model((int) $id);
    }
}
