<?php
class AdditionalHow extends ModelTable {

    public static $table = 'additional_how';
    public $safe = array('id', 'title', 'usage', 'time');
    
    public static function allExistObjects(){        
        return self::modelsWhere('id ORDER BY id DESC');
    }
    
    public static function singleExistObject($id){
        return self::model((int)$id);
    }
}
