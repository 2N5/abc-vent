<?php

class BlogController extends Controller
{

    const SECOND_OF_JANUARY_1970 = 75600;
    
    static $rules = array(
        'index' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        'create' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        'edit' => array(
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
    public $existObjects = array();
    
    public function actionIndex() {
        
        $this->takeExistObjects();
        
        $this->render('index');
    }
    
    public function actionCreate() {
        if(isset($_POST['form'])){
            $article = new Article();
            $article->__attributes = $_POST['form'];
            if($article->url == '')
            {
                $article->url = translit($article->title);
            }
//            $article->time = time();
            
            $time = (isset($_POST['date']) && !empty($_POST['date'])) ? strtotime($_POST['date']) : time();
            
            if((int)$time < 0)
            {
                $time = self::SECOND_OF_JANUARY_1970;
            }
            
            $article->time = $time + 1;
            
            if(isset($_FILES['picture']) and !empty($_FILES['picture']['name']))
            {
                if(!$article->savePicture($_FILES['picture'])){
                    $url = '/cp/error/imageloadfailed';                
                }
            }
            
            $article->save();
//            if($article->save())
//            {
//                updateSiteMap();
//            }
        }
        
        $this->takeExistObjects();
        
        Controller::$lastCrumb = 'Добавление статьи';
        
        $this->render('create');
    }
    
    public function actionEdit($id = 0) {
        if($id){
            $this->takeSingleExistObject($id);
        }
        
        if(isset($_POST['form'])){
            $this->existSingleObject->__attributes = $_POST['form'];
            if($this->existSingleObject->url == '')
            {
                $this->existSingleObject->url = translit($this->existSingleObject->title);
            }
            
            $time = (isset($_POST['date']) && !empty($_POST['date'])) ? strtotime($_POST['date']) : time();
            
            if((int)$time < 0)
            {
                $time = self::SECOND_OF_JANUARY_1970;
            }
            
            $this->existSingleObject->time = $time + 1;
            
            $url = $this->printControllerUrl('edit', array($this->existSingleObject->id));
            if(isset($_FILES['picture']) and !empty($_FILES['picture']['name']))
            {
                if(!$this->existSingleObject->savePicture($_FILES['picture'])){
                    $url = '/cp/error/imageloadfailed';                
                }
            }
            
            $this->existSingleObject->save();
            $this->redirect($url);
        }
        
        Controller::$lastCrumb = $this->existSingleObject->title;
        
        $this->render('edit');
    }
    
    public function actionPage() {
        
        $this->existSingleObject = Page::singleControlObject(Contr::BLOG);
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
        $model = Article::model($id);
        if($model)
        {
            Article::delete($id);
//            updateSiteMap();
        }
        $this->redirect($this->printControllerUrl());
    }

    protected function takeExistObjects(){
        $this->existObjects = Article::allExistObjects();
        foreach ($this->existObjects as $article)
        {
            $article->takePicture();
        }
    }
    
    protected function takeSingleExistObject($id){
        $this->existSingleObject = Article::singleExistObject($id);
        if(!$this->existSingleObject)
        {
            $this->redirect('/error/404');
        }
        $this->existSingleObject->takePicture();
    }
}
