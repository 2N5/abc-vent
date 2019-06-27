<?php
class Popular extends ModelTable {

    const REGULAR = 0;
    const POPULAR = 1;
    
    public static $table = 'popular';
    public $safe = array('id_theme');
    
    public static function allExistObjects(){        
        return self::modelsWhere('id ORDER BY id DESC');
    }
    
    public static function singleExistObject($id){
        return self::model((int)$id);
    }
}
