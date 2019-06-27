<?php 
class Type extends ModelTable {
    
    const PAGE = 1;
    const PRODUCT = 2;
    const ARTICLE = 3;
    
    static $table = 'type';
    public $safe = array('id', 'title', 'alias');
    
    public static function titleInfo($id_content){        
        $model = self::model($id_content);
        if($model)
        {
            return $model->title;
        }
        
        return 'Тип отсутствует';
    }
    
    public static function allExistObjects(){        
        return self::modelsWhere('id ORDER BY id DESC');
    }
    
    public static function singleExistObject($id){
        return self::model((int)$id);
    }
}