<?php
 
class IndexController extends Controller {
    static $rules = array(
        'index' => array(
            'users' => array('*'),
            'redirect' => '/error/younotloggin'
        )
    );
    
    protected $themeObjects =  array();
    protected $privacyPage = null;
    
    //Главная страница сайта
    public function actionIndex($param='') {
        if($param != '')
        {
            $this->error404();
        }
        
        $this->init(Contr::MAIN);
        
        $this->takeBaseInfo();
        $this->privacyPage = Page::contrPage(Contr::PRIVACY);

        $this->render('index');
    }
    
    protected function takeBaseInfo(){
        $this->takeExistObjects();
        foreach($this->themeObjects as $object){
//            $object->categoryInfo();
            $object->pictureInfo();
        }
//        $this->takeExistCategories();
    }
     
    protected function takeExistObjects(){
        $this->themeObjects = Theme::themeModel();
    }
}
