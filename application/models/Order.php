<?php
class Order extends ModelTable
{    
    public static $table = 'order';
    public $safe = array('id', 'name', 'phone', 'time', 'document', 'option1', 'option2', 'option3', 
                        'option4', 'option5', 'option6', 'option7', 'option8', 'option9', 'id_picture');
    public $translate = array('name'=>'Имя', 'phone'=>'Телефон', 'time'=>'Время отправки', 'document'=>'Документ');
    
    public $picture = '';
    
    public static function allExistObjects(){        
        return self::modelsWhere('id ORDER BY id DESC');
    }
    
    public static function singleExistObject($id){
        return self::model((int)$id);
    }

    public function pictureInfo(){
        $this->picture = OrderPicture::takePicture($this);
    }
}
