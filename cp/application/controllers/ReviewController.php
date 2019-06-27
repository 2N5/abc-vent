<?php

class ReviewController extends Controller
{
    const SECOND_OF_JANUARY_1970 = 75600;

    static $rules = array(
        'index' => array(
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
    
    public function actionEdit($id = 0) {
        if($id){
            $this->takeSingleExistObject($id);
        }
        if(isset($_POST['form'])){
            $this->existSingleObject->__attributes = $_POST['form'];
            
            $time = (isset($_POST['date']) && !empty($_POST['date'])) ? strtotime($_POST['date']) : time();
            
            if((int)$time < 0)
            {
                $time = self::SECOND_OF_JANUARY_1970;
            }
            
            $this->existSingleObject->time = $time + 1;
            
            $this->existSingleObject->save();
        }
        
        Controller::$lastCrumb = 'Редактирование отзыва';
        
        $this->render('edit');
    }
    
    public function actionPage() {
        
        $this->existSingleObject = Page::singleControlObject(Contr::REVIEW);
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
        Review::delete($id);
        $this->redirect($this->printControllerUrl());
    }
    
    public function actionConfirm($id) {
        $this->mainTemplate = 'clear';
        $review = Review::model($id);
        if($review)
        {
            $review->cheked = Review::CONFIRMED;
            $review->save();
        }
        $this->redirect($this->printControllerUrl());
    }

    protected function takeConfirmObjects(){
        $this->confirmObjects = Review::allConfirmObjects();
    }
    
    protected function takeOnReviewObjects(){
        $this->onReviewObjects = Review::allOnReviewObjects();
    }
    
    protected function takeSingleExistObject($id){
        $this->existSingleObject = Review::singleExistObject($id);
        if(!$this->existSingleObject)
        {
            $this->redirect('/error/404');
        }
    }
}
