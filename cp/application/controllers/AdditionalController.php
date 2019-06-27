<?php

class AdditionalController extends Controller {

    static $rules = array(
        'index' => array(
            'users' => array('*'),
            'redirect' => '/cp/index'
            ),
        'create' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        'edit' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        'switch' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
    );
    
    function actionIndex($example=0) {
        $additionals = AdditionalHelper::all($example);
        
        $this->render('index', array('additionals'=>$additionals, 'example'=>$example));
    }
    
    function actionCreate($type) {
        $model = AdditionalHelper::getModel($type);
        
        $additional = new $model();
        $additional->__attributes = $_POST['form'];
        $additional->save();
        
        $this->redirect($this->printControllerUrl());
    }
    
    function actionEdit($type, $id_additional) {
        $model = AdditionalHelper::getModel($type);
        
        $additional = $model::model($id_additional);
        
        if($additional){
            $additional->__attributes = $_POST['form'];
            
            $additional->save();
        }
        
        $this->redirect($this->printControllerUrl());
    }
}
