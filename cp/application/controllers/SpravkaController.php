<?php

class SpravkaController extends Controller {

    static $rules = array(
        'index' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        'create' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        'edit' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        'popular' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        'delete' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        'deletefield' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        'picturedelete' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        'pictureedit' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        'picture' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        'form' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        );
    
    public $existSingleObject = null;
    public $existObjects = array();
    public $categories = array();
    
    public function actionIndex() {
        $this->takeBaseInfo();
        $this->render('index');
    }
    
    public function actionCreate() {
        if(isset($_POST['form'])){
            $spravka = new Spravka();
            $spravka->__attributes = $_POST['form'];
            $spravka->url = translit($spravka->title);
            $spravka->meta_description = AdditionalHelper::all(AdditionalHelper::GENERATE);
            if($spravka->save())
            {
               $this->redirect($this->printControllerUrl('edit', array($spravka->id))); 
            }
        }
        
        $this->takeBaseInfo();
        
        Controller::$lastCrumb = 'Добавление справки';
                
        $this->render('create');
    }
    
    public function actionEdit($id = 0) {
        if($id){
            $this->takeSingleExistObject($id);
        }
        
        if(isset($_POST['form'])){
            $this->existSingleObject->__attributes = $_POST['form'];
            if($this->existSingleObject->url == '')
            {
                $this->existSingleObject->url = translit($this->existSingleObject->title);
            }
            
            $this->existSingleObject->save();
            
            $this->takeSingleExistObject($id);
        }
        
        $this->takeBaseInfo();
        $this->takeCategories();
        
        Controller::$lastCrumb = $this->existSingleObject->title;
        
        $this->render('edit');
    }
     
    public function actionPopular($id) {
        $this->mainTemplate = 'clear';
        $model = Popular::modelWhere('id_theme = ?', array($id));
        
        if($model)
        {
            Popular::deleteWhere('id_theme = ?', array($id));
        }else{
            $popular = new Popular();
            $popular->id_theme = $id;
            $popular->save();
        }
        
        $this->redirect($this->printControllerUrl());
    }
    
    public function actionDelete($id) {
        $this->mainTemplate = 'clear';
        $model = Spravka::model($id);
        if($model)
        {
            Spravka::delete($id);
        }
        $this->redirect($this->printControllerUrl());
    }
    
    public function actionDeletefield($id_cert, $id) {
        $this->mainTemplate = 'clear';
        $model = Field::model($id);
        if($model)
        {
            Field::delete($id);
        }
        $this->redirect($this->printControllerUrl('form', array($id_cert)));
    }
    
    public function actionPictureDelete($id_cert, $id) {
        Picture::delete($id);
        $this->redirect($this->printControllerUrl('picture', array($id_cert)));
    }
    
    public function actionPicture($id, $id_pic=0) {
        $picture = null;
        
        if(!$this->existSingleObject){
            $this->takeSingleExistObject($id);
        }
        
        if($id_pic)
        {
            $picture = Picture::model($id_pic);
            $picture->path();
        }
        
        if(isset($_POST['form']))
        {
            $url = $this->printControllerUrl('picture', array($this->existSingleObject->id));
            if(isset($_FILES['picture']) and !empty($_FILES['picture']['name'])){
                if(!$picture)
                {
                    $picture = new Picture();
                }
                if(!$picture->savePicture($this->existSingleObject, $_FILES['picture'])){
                    $url = '/cp/error/imageloadfailed';                
                }
            }
            
            if($picture)
            {
                $picture->__attributes = $_POST['form'];
                $picture->save();
            }
            
            Controller::$lastCrumb = 'Редактирование изображений';
                    
            $this->redirect($url);
        }
        
        $this->existSingleObject->pictureInfo();
        $this->existSingleObject->albumInfo();
        
        Controller::$lastCrumb = 'Редактирование изображений';
                
        $this->render('picture', array('picture'=>$picture));
    }
    
    public function actionPictureEdit($id_cert, $id_pic)
    {
        $picture = Picture::model($id_pic);
        if(!$picture)
        {
            $this->redirect('/error/404');
        }
        
        $main = Picture::modelWhere('id_theme = ? AND is_main = ?', array($id_cert, Picture::MAIN));
        if($main)
        {
            $main->is_main = Picture::ALBUM;
            $main->save();
        }
        
        $picture->is_main = Picture::MAIN;
        $picture->save();
        
        $this->redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function actionForm($id_cert, $id_field=0)
    {
        $spravka = Spravka::model($id_cert);
        if(!$spravka)
        {
            $this->error404();
        }
        
        if(isset($_POST['field']))
        {
            $field = $id_field ? Field::model($id_field) : new Field();
            
            $field->__attributes = $_POST['field'];
            $field->name = translit($field->title);
            $field->id_theme = $spravka->id;
            $field->save();
            
            $this->redirect($this->printControllerUrl('form', array($spravka->id)));
        }
        
        $fields = Field::modelsWhere('id_theme = ?', array($id_cert));
                
        $this->render('form', array(
                                        'spravka'=>$spravka,
                                        'fields'=>$fields,
                                ));   
    }
    
    protected function takeExistObjects(){
        $this->existObjects = Spravka::allExistObjects();
    }
    
    protected function takeCategories(){
        $this->categories = Category::last();
    }
    
    protected function takeSingleExistObject($id){
        $this->existSingleObject = Spravka::singleExistObject($id);
        if(!$this->existSingleObject)
        {
            $this->redirect('/error/404');
        }
        $this->existSingleObject->categoryInfo();
        $this->existSingleObject->pictureInfo();
        $this->existSingleObject->albumInfo();
//        $this->existSingleObject->checkMainPicture();
    }
    
    protected function takeBaseInfo(){
        $this->takeExistObjects();
        foreach($this->existObjects as $object){
            $object->categoryInfo();
            $object->pictureInfo();
            $object->albumInfo();
//            $object->checkMainPicture();
        }
    }
}
