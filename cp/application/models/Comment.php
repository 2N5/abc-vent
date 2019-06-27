<?php
class Comment extends ModelTable {
    
    const CONFIRMED = 1;
    const ON_REVIEW = 0;
    
    public static $table = 'comment';
    public $safe = array('id', 'name', 'text', 'city', 'cheked', 'email', 'id_controller', 'time');

    
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
