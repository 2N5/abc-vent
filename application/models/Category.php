<?php 
class Category extends ModelTable {

    const PARENT = 0;
    
    static $table = 'category';
    public $safe = array('id', 'id_controller', 'id_parent', 'title', 'content', 'url', 'seo_text', 'h1',
                            'description_short', 'meta_title', 'meta_keywords', 'meta_description');
    
    public $parent = '';
    public $childs = array();
    public $docs = array();
    
    public static function themeCats()
    {
        $parents = self::modelsWhere('id_parent = ? AND id_controller = ?', array(self::PARENT, App::gi()->theme->id));
        foreach($parents as $parent)
        {
            $parent->getChilds();
        }
        return $parents;
    }

    public static function themeParent()
    {
        $parents = self::modelsWhere('id_parent = ? AND id_controller = ?', array(self::PARENT, App::gi()->theme->id));
        return $parents;
    }
    
    public function getCerts()
    {
        $themeModel = Theme::ucFirstModel();
        $this->docs = $themeModel::modelsWhere('id_category = ?', array($this->id));
    }
    
    public function getChilds()
    {
        $this->childs = self::modelsWhere('id_parent = ?', array($this->id));
    }
    
    public static function allExistObjects(){
        return self::modelsWhere('id ORDER BY id DESC');
    }
    
    public static function singleExistObject($id){
        return self::model((int)$id);
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
        return self::modelsWhere('id <> ?', array($this->id));
    }
    
    public static function last()
    {
        $categories = self::models();
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