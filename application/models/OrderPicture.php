<?php

class OrderPicture extends ModelTable{

    const UPLOAD_DIR = '/uploads/order/';
    
    public static $table = 'order_picture';
    public $safe = array('id', 'name', 'id_order');
    
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
        $this->id_order = $this->model->id;
        
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
        
        $picture = self::modelWhere('id_order = ?', array($model->id));
        if(!$picture){
            return false;
        }
        
        $picture->path();
        
        return $picture;
    }
    
    public function path()
    {
        $this->path = self::UPLOAD_DIR.$this->id.'/'.$this->name;
    }
          
}
