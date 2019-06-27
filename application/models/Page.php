<?php
class Page extends ModelTable {
    
    public static $table = 'page';
    public $safe = array('id', 'title', 'url', 'h1', 'content', 'meta_title', 'seo_text',
                        'meta_keywords', 'meta_description', 'controll');
    
    public $category = '';
    public $picture = '';
    
    public static function pages()
    {
        $pages = array();
        $contrs = Contr::modelsWhere('active = ? AND control <> ? AND control <> ?', array(Contr::ACTIVE, Contr::MAIN, Contr::PRIVACY));
        if(!count($contrs)){
            return $pages;
        }
        
        foreach ($contrs as $contr){
            $page = self::modelWhere('id_controller = ?', array($contr->id));
            if($page){
                $pages[] = $page;
            }
        }
        
        return $pages;
    }
    
    public static function contrPage($control)
    {
        $controller = Contr::modelWhere('control = ?', array($control));
        if($controller){
            return self::modelWhere('id_controller = ?', array($controller->id));
        }
    }
    
    public static function allExistObjects(){        
        return self::modelsWhere('id ORDER BY id DESC');
    }
    
    public static function singleExistObject($id){
        return self::model((int)$id);
    }
}
