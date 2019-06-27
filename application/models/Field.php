<?php 
class Field extends ModelTable
{
    const TEXT = 0;
    const FILE = 1;
    const DATE = 2;
    
    static $table = 'field';
    public $safe = array('id', 'id_theme', 'title', 'name', 'type');
    
    public static function allExistObjects(){        
        return self::modelsWhere('id ORDER BY id DESC');
    }
    
    public static function singleExistObject($id){
        return self::model((int)$id);
    }
    
    public static function takeForm(ModelTable $cert)
    {
        if (!$cert)
        {
            return false;
        }
        return self::modelsWhere('id_theme = ?', array($cert->id));
    }

}