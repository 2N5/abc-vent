<?php

class CityController extends Controller
{
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
        'page' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        'delete' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        'picture' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        'pictureedit' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        'picturedelete' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        );
    
    public $existSingleObject = null;
    public $existObjects = array();
    
    public function actionIndex() {
        
        $this->takeBaseInfo();
        
        $this->render('index');
    }
    
    public function actionCreate() {
        if(isset($_POST['form'])){
            $city = new City();
            $city->__attributes = $_POST['form'];
//            $city->title = str_replace('"', '', str_replace ('\'', '', $city->title));
            if($city->url == '')
            {
                $city->url = translit($city->title);
            }
            if($city->h1 == '')
            {
                $city->h1 = $city->title;
            }
            $city->save();
        }
        
        $this->takeBaseInfo();
        
        Controller::$lastCrumb = 'Добавление города';
        
        $this->render('create');
    }
    
    public function actionEdit($id = 0) {
        if($id){
            $this->takeSingleExistObject($id);
        }
        
        if(isset($_POST['form'])){
            $this->existSingleObject->__attributes = $_POST['form'];
            $this->existSingleObject->save();
        }
        
        $this->takeBaseInfo();
        
        Controller::$lastCrumb = $this->existSingleObject->title;
        
        $this->render('edit');
    }
    
    public function actionPage() {
        
        $this->existSingleObject = Page::singleControlObject(Contr::CITY);
        if(!$this->existSingleObject){
            $this->redirect($this->printControllerUrl());
        }
        
        if(isset($_POST['form'])){
            $this->existSingleObject->__attributes = $_POST['form'];
            $this->existSingleObject->save();
        }
        
        Controller::$lastCrumb = $this->existSingleObject->title;
        
        $this->render('page');
    }
    
    public function actionDelete($id) {
        $this->mainTemplate = 'clear';
        City::delete($id);
        $this->redirect($this->printControllerUrl());
    }
    
    public function actionPictureDelete($id_cert, $id) {
        CityPicture::delete($id);
        $this->redirect($this->printControllerUrl('picture', array($id_cert)));
    }
    
    public function actionPicture($id, $id_pic=0) {
        $picture = null;
        
        if(!$this->existSingleObject){
            $this->takeSingleExistObject($id);
        }
        
        if($id_pic)
        {
            $picture = CityPicture::model($id_pic);
            $picture->path();
        }
        
        if(isset($_POST['form']))
        {
            $url = $this->printControllerUrl('picture', array($this->existSingleObject->id));
            if(isset($_FILES['picture']) and !empty($_FILES['picture']['name'])){
                if(!$picture)
                {
                    $picture = new CityPicture();
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
            
            $this->redirect($url);
        }
        
        $this->existSingleObject->pictureInfo();
        $this->existSingleObject->albumInfo();
        
        Controller::$lastCrumb = 'Редактирование изображений';
        
        $this->render('picture', array('picture'=>$picture));
    }
    
    public function actionPictureEdit($id_cert, $id_pic)
    {
        $picture = CityPicture::model($id_pic);
        if(!$picture)
        {
            $this->redirect('/error/404');
        }
        
        $main = CityPicture::modelWhere('id_city = ? AND is_main = ?', array($id_cert, CityPicture::MAIN));
        if($main)
        {
            $main->is_main = CityPicture::ALBUM;
            $main->save();
        }
        
        $picture->is_main = CityPicture::MAIN;
        $picture->save();
        
        $this->redirect($_SERVER['HTTP_REFERER']);
    }
    
    protected function takeExistObjects(){
        $this->existObjects = City::allExistObjects();
    }
    
    protected function takeSingleExistObject($id){
        $this->existSingleObject = City::singleExistObject($id);
        if(!$this->existSingleObject)
        {
            $this->redirect('/error/404');
        }
        $this->existSingleObject->pictureInfo();
        $this->existSingleObject->albumInfo();
    }
    
    protected function takeBaseInfo(){
        $this->takeExistObjects();
        foreach ($this->existObjects as $city)
        {
            $city->pictureInfo();
        }
    }
}
