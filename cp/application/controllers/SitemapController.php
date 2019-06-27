<?php

class SitemapController extends Controller {

    static $rules = array(
        'index' => array(
            'users' => array('*'),
            'redirect' => '/cp/index'
            ),
        'switch' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
    );
    
    function actionIndex() {
        $map = Contr::map();
        $this->render('index', array('map'=>$map));
    }
    
//    function actionSwitch($id_controller) {
//        $controller = Contr::model($id_controller);
//        
//        $controller->on_front = $controller->on_front ? Contr::INACTIVE : Contr::ACTIVE;
//        $controller->save();
//        
//        $this->redirect($this->printControllerUrl());
//    }
}
