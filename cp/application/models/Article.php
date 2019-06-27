<?php 
class Article extends ModelTable 
{
    const UPLOAD_DIR = '/uploads/blog/';
    
    static $table = 'article';
    public $safe = array('id', 'url', 'title', 'content', 'time', 'picture_id', 'h1',
                        'meta_title', 'meta_keywords', 'meta_description', 'description');
    
    public $picture = null;
    
    public function takePicture()
    {
        $this->picture = Picture::model($this->picture_id);
        $this->path();
    }
    
    public function path()
    {
        if(is_object($this->picture))
        {
            $this->picture->path = self::UPLOAD_DIR.$this->picture->id.'/'.$this->picture->name;
        }
        
    }
        
    public function savePicture($files)
    {
        $picture = new Picture();

        $finfo = finfo_open();
        $type = explode(' ', finfo_file($finfo, $files['tmp_name']))[0];

        $fileName = uniqid().'.'.strtolower($type);
        $picture->name = $fileName;

        $picture->save();

        $upload_dir = $_SERVER['DOCUMENT_ROOT'] . self::UPLOAD_DIR . $picture->id . '/';
        if (!file_exists($upload_dir)) {
            if (!mkdir($upload_dir, 0777, true)) {
                die('Не удалось создать: ' . $upload_dir);
            }
        }

        move_uploaded_file($files['tmp_name'], $upload_dir . $fileName);
        
        $this->picture_id = $picture->id;
        return true;
    }
    
    public static function allExistObjects(){        
        return self::modelsWhere('id ORDER BY id DESC');
    }
    
    public static function singleExistObject($id){
        return self::model((int)$id);
    }
}