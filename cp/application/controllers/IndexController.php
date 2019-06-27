<?php
 
class IndexController extends Controller {
    static $rules = array(
        'index' => array(
            'users' => array('admin'),
            'redirect' => '/cp/configurate'
        ),
    );
    //Главная страница сайта
    public function actionIndex() {
        $this->isConfigurate();
        $this->themeRedirect();
    }
}
