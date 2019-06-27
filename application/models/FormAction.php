<?php
class FormAction extends ModelTable {
    
    const CALLBACK = 0;
    const ORDER = 1;
    
    public static $table = 'form_action';
    public $safe = array('id', 'name', 'comment', 'phone', 'time', 'type');
    public $standart = array('name', 'comment', 'phone');
    
    public $translate = array('comment'=>'Комментарий', 'name'=>'Имя', 'phone'=>'Телефон', 'time'=>'Время отправки');
    
    public static function allExistObjects(){        
        return self::modelsWhere('id ORDER BY id DESC');
    }
    
    public static function singleExistObject($id){
        return self::model((int)$id);
    }
}
