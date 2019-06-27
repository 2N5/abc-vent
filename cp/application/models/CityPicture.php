<?php

class CityPicture extends ModelTable
{
    const MAIN = 1;
    const ALBUM = 0;
    const UPLOAD_DIR = '/uploads/city/';
    const NO_IMG = 'noimg.png';
    
    public static $table = 'city_picture';
    public $safe = array('id', 'name', 'alt', 'title', 'id_city', 'is_main');
    
    protected $model = null;
    protected $files = array();
    
    public $path = '';
    
    protected function initialize(ModelTable $model, array $files = array()){
        $this->model = $model;
        $this->files = $files;
    }
    
    public function savePicture($model, $files) {
        $this->initialize($model, $files);
//        debug($this->files, true);
        
        if (empty($this->files['name'])) {
            return false;
        }
        
        $finfo = finfo_open();
        $type = explode(' ', finfo_file($finfo, $this->files['tmp_name']))[0];
        
        $fileName = uniqid().'.'.strtolower($type);
        $this->name = $fileName;
        $this->id_city = $this->model->id;
        
        $pics = self::modelsWhere('id_city = ?', array($this->id_city));
        if(!count($pics))
        {
            $this->is_main = Picture::MAIN;
        }
//        debug($this, true);
        $this->save();
        
        $upload_dir = $_SERVER['DOCUMENT_ROOT'] . self::UPLOAD_DIR . $this->id . '/';
        if (!file_exists($upload_dir)) {
            if (!mkdir($upload_dir, 0777, true)) {
                die('Не удалось создать: ' . $upload_dir);
            }
        }
        
        move_uploaded_file($this->files['tmp_name'], $upload_dir . $fileName);
        
        return true;
    }
    //Метод возвращает путь к картинке, если таковая имеется... Есть возможность обойтись
    //без возврата значения, путем записи сразу в поле модели, но это сделает код менее понятным
    //с клиентской точки зрения, но позволит избавится от дублирования метода в моделях!
    public static function takePicture(ModelTable $model) {
        if(!$model){
            return false;
        }
        
        $picture = self::modelWhere('id_city = ? AND is_main = ?', array($model->id, self::MAIN));
        if(!$picture){
            return false;
        }
        
        $picture->path();
//        debug($picture, true);
        return $picture;
    }
    
    public static function takeAlbum(ModelTable $model) {
        if(!$model){
            return false;
        }
        
        $pictures = self::modelsWhere('id_city = ? AND is_main = ?', array($model->id, self::ALBUM));
//        $pictures = self::modelsWhere('id_city = ?', array($model->id));
        foreach($pictures as $picture)
        {
            $picture->path();
        }
        
//        debug($pictures, true);
        return $pictures;
    }
    
    public function path()
    {
        $this->path = self::UPLOAD_DIR.$this->id.'/'.$this->name;
    }
        
    public static function allExistObjects($id_cert){        
        return self::modelsWhere('id_city = ?', array($id_cert));
    }
    
    public static function singleExistObject($id){
        return self::model((int)$id);
    }
    
}
