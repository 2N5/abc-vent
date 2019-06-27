<?php

class FaqController extends Controller {

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
        'confirm' => array(
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
        );
    
    public $existSingleObject = null;
    public $confirmObjects = array();
    public $onReviewObjects = array();
    
    public function actionIndex() {
        
        $this->takeConfirmObjects();
        $this->takeOnReviewObjects();
        
        $this->render('index');
    }
    
    public function actionCreate() {
        if(isset($_POST['form'])){
            $qa = new Faq();
            $qa->__attributes = $_POST['form'];
            if($qa->url == '')
            {
                $qa->url = translit($qa->title);
            }
            $qa->time = time();
            $qa->save();
        }
        
        $this->takeExistObjects();
        
        Controller::$lastCrumb = 'Добавление поста вопрос ответ';
        
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
        }
        
        $this->takeExistObjects();
        
        Controller::$lastCrumb = 'Редактирование поста вопрос ответ';
        
        $this->render('edit');
    }
    
    public function actionConfirm($id) {
        $this->mainTemplate = 'clear';
        $faq = Faq::model($id);
        if($faq)
        {
            $faq->cheked = Faq::CONFIRMED;
            $faq->save();
        }
        $this->redirect($this->printControllerUrl());
    }

    public function actionPage() {
        
        $this->existSingleObject = Page::singleControlObject(Contr::FAQ);
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
        Faq::delete($id);
        $this->redirect($this->printControllerUrl());
    }

    protected function takeConfirmObjects(){
        $this->confirmObjects = Faq::allConfirmObjects();
    }
    
    protected function takeOnReviewObjects(){
        $this->onReviewObjects = Faq::allOnReviewObjects();
    }
    
    protected function takeExistObjects(){
        $this->existObjects = Faq::allExistObjects();
    }
    
    protected function takeSingleExistObject($id){
        $this->existSingleObject = Faq::singleExistObject($id);
        if(!$this->existSingleObject)
        {
            $this->redirect('/error/404');
        }
    }
}
