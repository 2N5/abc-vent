<?php 
class QA extends ModelTable {
    static $table = 'quest_answ';
    public $safe = array('id', 'question', 'answer','time');
    
    public static function allExistObjects(){        
        return self::modelsWhere('id ORDER BY id DESC');
    }
    
    public static function singleExistObject($id){
        return self::model((int)$id);
    }
}