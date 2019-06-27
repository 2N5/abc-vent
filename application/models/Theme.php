<?php
abstract class Theme extends ModelTable {
    
    public $theme = null;
    
    const NO_CATEGORY = 0;
    
    public $formEnctype = '';
    public $form = array();
    
    public $picture = '';
    public $category = '';
    public $album = array();
    
    public static function themeModel($id=0, $where='', $values=array(), $single=true){
        $model = self::ucFirstModel();
        
        if($id){
            return $model::model($id);
        }
        
        if(!$where){
            return $model::models();
        }
        
        if($single){   
            $result = $model::modelWhere($where, $values);
        }else{
            $result = $model::modelsWhere($where, $values);
        }
        
        return $result;
    }
    
    public static function ucFirstModel(){
        return ucfirst(App::gi()->theme->control);
    }
    
    public static function allExistObjects(){        
        return static::modelsWhere('id ORDER BY id DESC');
    }
    
    public static function withoutCategory(){        
        return static::modelsWhere('id_category = ? ORDER BY id DESC', array(self::NO_CATEGORY));
    }
    
    public static function singleExistObject($id){
        return static::model((int)$id);
    }
    
    public static function alphabetSort(){        
        return static::modelsWhere('id ORDER BY BINARY(lower(title))');
    }
    
    public function categoryInfo(){
        $category = Category::model($this->id_category);
        if($category)
        {
            $this->category = $category->title;
        }
    }

    public function pictureInfo(){
        $this->picture = Picture::takePicture($this);
    }
    
    public function waterPicture(){
        $this->picture = Picture::takePicture($this);
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
    
    public function formInfo(){
        $this->form = Field::takeForm($this);
        foreach ($this->form as $field)
        {
            if($field->type === Field::FILE)
            {
                $this->formEnctype = 'enctype="multipart/form-data"';
                break;
            }
        }
    }
}