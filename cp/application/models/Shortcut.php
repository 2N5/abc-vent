<?php
class Shortcut extends ModelTable {

    const SKIP = 0;
    const CONVERTING = 1;
    
    public static $table = 'shortcut';
    public $safe = array('id', 'title', 'value', 'converting');
    
    public static function allExistObjects(){        
        return self::modelsWhere('id ORDER BY id DESC');
    }
    
    public static function singleExistObject($id){
        return self::model((int)$id);
    }
}
