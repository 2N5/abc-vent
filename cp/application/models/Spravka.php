<?php
class Spravka extends ModelTable {
    
    static $table = 'spravka';
    public $safe = array('id', 'id_category', 'price', 'sub_title', 'title', 'url', 'h1', 'description',
                            'content', 'type', 'meta_title', 'meta_keywords', 'meta_description');

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