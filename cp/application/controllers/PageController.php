<?php

class PageController extends Controller {

    static $rules = array(
        'index' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        'edit' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        'url' => array(
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
        
    public function actionEdit($id) {
        if($id){
            $this->takeSingleAllowObject($id);
        }
        
        if(isset($_POST['form'])){
            $this->existSingleObject->__attributes = $_POST['form'];
            $this->existSingleObject->save();
        }
        
        Controller::$lastCrumb = $this->existSingleObject->title;
        
        $this->render('edit');
    }
     
    function actionUrl($id_page) {
        if(isset($_POST['form']['url']) and !empty($_POST['form']['url'])){
            $page = Contr::model($id_page);
            if($page){
                $page->url = trim(strip_tags($_POST['form']['url']));
                $page->save();
                App::configWrite();
            }
        }
        $this->redirect($this->printControllerUrl());
    }
    
    protected function takeAllowObjects(){
        $this->existObjects = Page::allAllowObjects();
    }
    
    protected function takeSingleAllowObject($id){
        $this->existSingleObject = Page::singleAllowObject($id);
    }
    
    protected function takeBaseInfo(){
        $this->takeAllowObjects();
    }
}
