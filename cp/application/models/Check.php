<?php
class Check extends ModelTable {
    
    const NO_ISOMETRY = 0;
    const ISOMETRY = 1;
    
    public static $table = 'check';
    public $safe = array('id', 'title', 'url', 'description', 'content', 'price', 'isometry', 'h1',
                        'meta_title', 'meta_keywords', 'meta_description', 'text');
    
    public $picture = '';
    public $category = '';
    public $album = array();
    
    public static function allExistObjects(){        
        return self::modelsWhere('id ORDER BY id DESC');
    }
    
    public static function singleExistObject($id){
        return self::model((int)$id);
    }
    
    public function pictureInfo(){
        $this->picture = Picture::takePicture($this);
    }
    
    public function albumInfo(){
        $this->album = Picture::takeAlbum($this);
    }
    
    public function categoryInfo(){
        $category = Category::model($this->id_category);
        if($category)
        {
            $this->category = $category->title;
        }
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
