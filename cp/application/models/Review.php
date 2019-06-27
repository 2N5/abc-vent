<?php
class Review extends ModelTable {
    
    const CONFIRMED = 1;
    const ON_REVIEW = 0;
    
    const NO_CERT = 0;
    const NO_CITY = 0;
    
    public static $table = 'review';
    public $safe = array('id', 'name', 'text', 'time', 'cheked', 'picture', 'position', 'city',
                        'id_city', 'id_theme', 'mark', 'ip');

    
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
