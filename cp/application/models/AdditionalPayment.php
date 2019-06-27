<?php
class AdditionalPayment extends ModelTable {

    public static $table = 'additional_payment';
    public $safe = array('id', 'title', 'usage', 'time');
    
    public static function allExistObjects(){        
        return self::modelsWhere('id ORDER BY id DESC');
    }
    
    public static function singleExistObject($id){
        return self::model((int)$id);
    }
}
