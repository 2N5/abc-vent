<?php
class AdditionalPhone extends ModelTable {

    public static $table = 'additional_phone';
    public $safe = array('id', 'title', 'usage', 'time');
    
    public static function allExistObjects(){        
        return self::modelsWhere('id ORDER BY id DESC');
    }
    
    public static function singleExistObject($id){
        return self::model((int)$id);
    }
    
    public function beforeSave() {
        if(parent::beforeSave()){
            $this->title = $this->mb_ucfirst($this->title);
            
            return true;
        }
        
        return false;
    }
}
