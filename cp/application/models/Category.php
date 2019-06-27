<?php 
class Category extends ModelTable {
    
    const PARENT = 0;
    
    static $table = 'category';
    public $safe = array('id', 'id_parent', 'title', 'url', 'description_short', 'description_up', 'descriptin_down',
                       'meta_title', 'meta_keywords', 'meta_description', 'id_controller', 'h1', 'seo_text');
    
    public $parent = '';
    public $childs = array();
    public $docs = array();
    
    
    public static function allExistObjects(){        
        return self::modelsWhere('id_controller = ? ORDER BY id DESC', array(App::gi()->theme->id));
    }
    
    public static function singleExistObject($id){
        return self::model((int)$id);
    }
        
    public function  removeall(){
        $this->getChilds();
        
        foreach($this->childs as $child)
        {
            $child->getCerts();
            $child->discardProducts();
            self::delete($child->id);
        }
        
        $this->getCerts();
        $this->discardProducts();
        self::delete($this->id);
    }
    
    public function discardProducts()
    {
        foreach($this->docs as $document){
            $document->id_category = 0;
            $document->save();
        }
    }
    
    public function getCerts()
    {
        $themeModel = ucfirst(Contr::theme()->control);
        $this->docs = $themeModel::modelsWhere('id_category = ?', array($this->id));
    }
    
    public function getChilds()
    {
        $this->childs = self::modelsWhere('id_parent = ?', array($this->id));
    }
    
    public function getParent()
    {
        $parent = self::modelWhere('id = ?', array($this->id_parent));
        if($parent)
        {
            $this->parent = $parent->title;
        }
    }
        
    public function otherCategories()
    {
        return self::modelsWhere('id <> ? AND id_parent <> ? AND id_controller = ? ORDER BY BINARY(title)', array($this->id, $this->id, App::gi()->theme->id));
    }
    
    public static function last()
    {
        $categories = self::modelsWhere('id_controller = ?', array(App::gi()->theme->id));
        $last = array();
        
        foreach($categories as $cat)
        {
            if(Category::modelWhere('id_parent = ?', array($cat->id)))
            {
                continue;
            }
            
            $last[] = $cat;
        }
        
        return $last;
    }
}