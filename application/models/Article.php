<?php 
class Article extends ModelTable
{
    
    const UPLOAD_DIR = '/uploads/blog/';
    
    static $table = 'article';
    public $safe = array('id', 'url', 'title', 'content', 'time', 'picture_id',
        'meta_title', 'meta_keywords', 'meta_description', 'description');
    
    public $picture = null;
    
    public function takePicture()
    {
        $this->picture = Picture::model($this->picture_id);
//        $this->path();
        $this->resizePath();
    }
    
    public function path()
    {
        if(is_object($this->picture))
        {
            $this->picture->path = self::UPLOAD_DIR.$this->picture->id.'/'.$this->picture->name;
        }
        
    }
    
    public function resizePath() {
        if(is_object($this->picture))
        {
            $this->picture->path = '/theme/blogresize/'.$this->picture->id;
        }
    }

    public static function allExistObjects()
    {        
        return self::modelsWhere('id ORDER BY id DESC');
    }
    
    public static function singleExistObject($id){
        return self::model((int)$id);
    }
}