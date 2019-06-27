<?php 
class Anchor extends ModelTable
{
    static $table = 'anchor';
    public $safe = array('id', 'id_content', 'id_category', 'title', 'id_href');
    
    public static function allExistObjects(){        
        return self::modelsWhere('id ORDER BY id DESC');
    }
    
    public static function singleExistObject($id){
        return self::model((int)$id);
    }
}