<?php
class Check extends Theme {
    
    const NO_ISOMETRY = 0;
    const ISOMETRY = 1;
    
    public static $table = 'check';
    public $safe = array('id', 'title', 'url', 'description', 'price', 'isometry', 'content',
                        'meta_title', 'meta_keywords', 'meta_description', 'text');
    
    public $isometry = '';
    
    public static function allIsometryObjects(){        
        return self::modelsWhere('isometry = ? ORDER BY id DESC', array(self::ISOMETRY));
    }
    
    public function isometryInfo(){
        $this->isometry = Picture::takeIsometry($this);
    }
    
}
