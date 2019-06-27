<?php
class Page extends ModelTable {
    
    public static $table = 'page';
    public $safe = array('id', 'title', 'url', 'h1', 'content', 'meta_title', 'seo_text',
                            'meta_keywords', 'meta_description', 'controll', 'id_controller');
    
    public $category = '';
    public $picture = '';
    
    public static function allAllowObjects(){    
        $controllers = Contr::modelsWhere('active = ? AND static = ?', array(Contr::ACTIVE, Contr::STATICAL));
        $allowObjects = array();
        
        foreach($controllers as $contr){
            $model = self::modelWhere('id_controller = ?', array($contr->id));
            if($model){
                $allowObjects[] = $model;
            }
        }
        
        $main = self::contrPage(Contr::MAIN);
        $allowObjects[] = $main;
        
        return $allowObjects;
    }
    
    public static function contrPage($control)
    {
        $controller = Contr::modelWhere('control = ?', array($control));
        if($controller){
            return self::modelWhere('id_controller = ?', array($controller->id));
        }
    }
    
    public static function singleControlObject($contr){
        $control = Contr::modelWhere('control = ?', array($contr));
        return self::modelWhere('url = ?', array($control->url));
    }
    
    public static function singleAllowObject($id){
        return self::model($id);
    }
    
    public static function pages()
    {
        return self::modelsWhere('url <> ?', array(self::MAIN));
    }
}
