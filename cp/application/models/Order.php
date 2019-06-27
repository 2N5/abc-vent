<?php 
class Order extends ModelTable
{
    const CALLBACK = 0;
    const ORDER = 1;
    
    static $table = 'form_action';
    public $safe = array('id', 'name', 'phone', 'comment', 'time', 'type');
    
    public static function allExistObjects(){        
        return self::modelsWhere('id ORDER BY id DESC');
    }
    public static function allOrders(){        
        return self::modelsWhere('type = ? ORDER BY id DESC', array(self::ORDER));
    }
    
    public static function allCallbacks(){        
        return self::modelsWhere('type = ? ORDER BY id DESC', array(self::CALLBACK));
    }
    
    public static function singleExistObject($id){
        return self::model((int)$id);
    }
}