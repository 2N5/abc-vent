<?php

class DisplayController extends Controller {

    static $rules = array(
        'index' => array(
            'users' => array('*'),
            'redirect' => '/cp/index'
            ),
        'switch' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        'displaymode' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
    );
    
    function actionIndex() {
        $pages = Contr::front();
        $this->render('index', array('pages'=>$pages));
    }
    
    function actionSwitch($id_controller) {
        $controller = Contr::model($id_controller);
        
        $controller->display_mode = $controller->display_mode ? Contr::INACTIVE : Contr::ACTIVE;
        $controller->save();
        
        $this->redirect($this->printControllerUrl());
    }
    
    function actionDisplaymode($contr_id) {
        $controller = Contr::model($contr_id);
        if($controller and isset($_POST['mode'])){
            $controller->display_mode = (int)$_POST['mode'];
            $controller->save();
        }
        $this->redirect($this->printControllerUrl());
    }
}
