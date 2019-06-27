<?php

class CommentController extends Controller
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
        
        Controller::$lastCrumb = $this->existSingleObject->title;
        
        $this->render('edit');
    }
    
    public function actionDelete($id) {
        $this->mainTemplate = 'clear';
        Comment::delete($id);
        $this->redirect($this->printControllerUrl());
    }
    
    public function actionConfirm($id) {
        $this->mainTemplate = 'clear';
        $review = Comment::model($id);
        if($review)
        {
            $review->cheked = Comment::CONFIRMED;
            $review->save();
        }
        $this->redirect($this->printControllerUrl());
    }

    protected function takeConfirmObjects(){
        $this->confirmObjects = Comment::allConfirmObjects();
    }
    
    protected function takeOnReviewObjects(){
        $this->onReviewObjects = Comment::allOnReviewObjects();
    }
    
    protected function takeSingleExistObject($id){
        $this->existSingleObject = Comment::singleExistObject($id);
        if(!$this->existSingleObject)
        {
            $this->redirect('/error/404');
        }
    }
}
