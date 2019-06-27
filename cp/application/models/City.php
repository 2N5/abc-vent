<?php
class City extends ModelTable
{    
    public static $table = 'city';
    public $safe = array('id', 'title', 'url', 'h1', 'content', 'seo_text',
                        'meta_title', 'meta_keywords', 'meta_description');
    
    public $picture = '';
    public $album = array();
    
    public static function allExistObjects(){        
        return self::modelsWhere('id ORDER BY id DESC');
    }
    
    public static function singleExistObject($id){
        return self::model((int)$id);
    }
     
    public function pictureInfo(){
        $this->picture = CityPicture::takePicture($this);
    }
    
    public function albumInfo(){
        $this->album = CityPicture::takeAlbum($this);
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
