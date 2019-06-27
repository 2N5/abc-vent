<?php

class ConfigurateController extends Controller {

    static $rules = array(
        'index' => array(
            'users' => array('*'),
            'redirect' => '/cp/index'
            ),
        'common' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        'switch' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        'url' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
    );
    
    function actionIndex($id=0) {
        $this->themeRedirect();
        
        $controller = Contr::model($id);
        if($controller){
            $this->sitemapSetup($controller->id);
            
            $controller->active = Contr::ACTIVE;
            $controller->time = time();
            if($controller->save()){
                App::configWrite($controller->id);
            }
            $this->themeRedirect();
        }
        
        $themes = Contr::themes();
        $this->render('index', array('themes'=>$themes));
    }
    
    function actionCommon() {
        $commons = Contr::commons();
        $this->render('common', array('commons'=>$commons));
    }
    
    function actionSwitch($mode, $id_controller) {
        $theme = App::gi()->theme;
        if($theme->id == $id_controller){
            if($mode == Contr::ONFRONTMODE){
                $theme->on_front = $theme->on_front ? Contr::INACTIVE : Contr::ACTIVE;
                $theme->save();
            
                $this->redirect($this->printControllerUrl('common'));
                exit();
            }else{
                $this->redirect($this->printControllerUrl('common'));
                exit();
            }
        }
        
        $controller = Contr::model($id_controller);
        
        if($mode == Contr::ACTIVEMODE){
            $controller->active = $controller->active ? Contr::INACTIVE : Contr::ACTIVE;
            if($controller->active == Contr::INACTIVE){
                $controller->on_front = Contr::INACTIVE;
            }
            if($controller->save()){
                $this->pageValid($controller);
                App::configWrite();
            }
        }else{
            if($controller->active == Contr::ACTIVE){
                $controller->on_front = $controller->on_front ? Contr::INACTIVE : Contr::ACTIVE;
                $controller->save();
            }
        }
        
        $this->redirect($this->printControllerUrl('common'));
    }
           
    function actionUrl($id_controller) {
        if(isset($_POST['form']['url']) and !empty($_POST['form']['url'])){
            $controller = Contr::model($id_controller);
            if($controller){
                $page = Page::modelWhere('id_controller = ?', array($controller->id));
                $controller->url = trim(strip_tags($_POST['form']['url']));
                if($page){
                    $page->url = $controller->url;
                    $page->save();
                }
                $controller->save();
                App::configWrite();
            }
        }
        $this->redirect($this->printControllerUrl('common'));
    }
    //----------------Setup default options--------------------
    private function sitemapSetup($id) {
        $themes = Contr::themes($id);
        
        foreach($themes as $controller){
            $controller->inmap = Contr::INACTIVE;
            $controller->save();
        }
    }
    //--------------------------------------------------------- 
       
    //----------------Controller Page validation--------------------
    private function pageValid($changeController) {
        //If deactivate page then diactivate all static pages
        if($changeController->control == Contr::PAGE){
            if($changeController->active == Contr::INACTIVE){
                $this->disallowStatical();
            }
        }else{
            //if static then check amount of static active 
            if($changeController->static != Contr::STATICAL){
                return true;
            }
            
            $page = Contr::pageContr();
            //if amount = 0 then page = inactive else page = active
            if(count(Contr::statical()) == 0){
                $page->active = Contr::INACTIVE;
            }else{
                $page->active = Contr::ACTIVE;

            }
            $page->save();
        }
        
    }
    //--------------------------------------------------------- 
}
