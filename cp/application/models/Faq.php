<?php 
class Faq extends ModelTable {
    
    const CONFIRMED = 1;
    const ON_REVIEW = 0;
    
    static $table = 'quest_answ';
    public $safe = array('id', 'name', 'question', 'answer', 'time', 'cheked', 'ip');
    
    public static function allExistObjects(){        
        return self::modelsWhere('id ORDER BY id DESC');
    }
    
    public static function allConfirmObjects(){        
        return self::modelsWhere('cheked = ? ORDER BY id DESC', array(self::CONFIRMED));
    }
    
    public static function allOnReviewObjects(){        
        return self::modelsWhere('cheked = ? ORDER BY id DESC', array(self::ON_REVIEW));
    }
    
    public static function singleExistObject($id){
        return self::model((int)$id);
    }
}