<?php

class ShortcutController extends Controller {

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
    
    function actionIndex() {
        $shortcuts = Shortcut::allExistObjects();
        $this->render('index', array('shortcuts'=>$shortcuts));
    }
    
    function actionCreate() {
        $shortcut = new Shortcut();
        $shortcut->__attributes = $_POST['form'];
        
        if($shortcut->title === '[site]'){
            $shortcut->value = $_SERVER['SERVER_NAME'];
        }
        
        $shortcut->save();
        
        $this->redirect($this->printControllerUrl());
    }
    
    function actionEdit($id_shortcut) {
        $shortcut = Shortcut::model($id_shortcut);
        
        if($shortcut){
            if($shortcut->title === '[site]'){
                $shortcut->value = $_SERVER['SERVER_NAME'];
            }else{
                $shortcut->__attributes = $_POST['form'];
            }
            
            $shortcut->save();
        }
        
        $this->redirect($this->printControllerUrl());
    }
    
    function actionSwitch($id_shortcut) {
        $shortcut = Shortcut::model($id_shortcut);
        if($shortcut){
            $shortcut->converting = $shortcut->converting ? Shortcut::SKIP : Shortcut::CONVERTING;
            $shortcut->save();
        }
        $this->redirect($this->printControllerUrl());
    }
}
