<?php

class OrderController extends Controller {

    static $rules = array(
        'index' => array(
            'users' => array('admin'),
            'redirect' => '/cp/index'
            ),
        'delete' => array(
            'users' => array('admin'),
            'redirect' => '/cp/index'
            ),
    );
    
    public $existSingleObject = null;
    
    public $existOrdes = array();
//    public $existComments = array();
//    public $existReviews = array();
    
    public function actionIndex() {
        
        $orders = Order::allOrders();
        $callbacks = Order::allCallbacks();
        
        $this->render('index', array('orders'=>$orders, 'callbacks'=>$callbacks));
    }
     
    public function actionDelete($id) {
        $this->mainTemplate = 'clear';
        Order::delete($id);
        $this->redirect($this->printControllerUrl());
    }
    
    protected function takeExistOrders(){
        $this->existOrders = Order::allExistObjects();
    }
    
//    protected function takeExistComments(){
//        $this->existComments = Comment::allExistObjects();
//    }
//    
//    protected function takeExistReviews(){
//        $this->existReviews = Review::allExistObjects();
//    }
        
    protected function takeSingleExistObject($id){
        $this->existSingleObject = Order::singleExistObject($id);
        if(!$this->existSingleObject)
        {
            $this->redirect('/error/404');
        }
    }  
    
    private function takeBaseInfo(){
        $this->takeExistOrders();
//        $this->takeExistComments();
//        $this->takeExistReviews();
    }
}
