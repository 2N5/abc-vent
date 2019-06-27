<?php
class Content extends ModelTable {
    
    const IMAGESDIR = '/uploads/images/';
    const NO_POPULAR = 0;
    const POPULAR = 1;
    const ARTICLES = 'catalog/list/10';
    const SPR = 'catalog/list';
    
    const IGNORE = array(
                            'catalog/list/10',
                            'news',
                        );
    
    public static $table = 'content';
    public $safe = array('id', 'title', 'url', 'content', 'price', 'id_category', 'id_type', 'sub_title', 'popular', 'name',
                        'meta_title', 'meta_keywords', 'meta_description', 'created', 'modified', 'published');
    
    public $picture = '';
    public $category = '';
    public $album = array();
    
    public static function allExistObjects(){        
        return self::modelsWhere('id ORDER BY id DESC');
    }
    
    public static function singleExistObject($id){
        return self::model((int)$id);
    }
    
    public function getType(){
        return Type::titleInfo($this->id_type);
    }
    
    public function typeInfo(){
        $type = Type::model($this->id_type);
        if($type)
        {
            $this->type = $type->title;
        }
    }
    
    public function pictureInfo(){
        $this->picture = Picture::takePicture($this);
    }
    
    public function categoryInfo(){
        $category = Category::model($this->id_category);
        if($category)
        {
            $this->category = $category->title;
        }
    }
    
    public function albumInfo(){
        $this->album = Picture::takeAlbum($this);
    }
        
    public function checkMainPicture()
    {
        if($this->picture != '')
        {
            return;
        }
        
        if(count($this->album))
        {
            $this->picture = $this->album[0];
        }
    }
}
