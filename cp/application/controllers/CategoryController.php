<?php
class CategoryController extends Controller
{
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
        'delete' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        'page' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        );
    
    public $existSingleObject = null;
    public $existObjects = array();
    public $categories = array();
    
    public function actionIndex() {
        
        $this->takeExistObjects();
        
        $this->render('index');
    }
    
    public function actionCreate() {
        if(isset($_POST['form'])){
            $category = new Category();
            $category->__attributes = $_POST['form'];
            if($category->url == '')
            {
                $category->url = translit($category->title);
            }
            $category->id_controller = App::gi()->theme->id;
            $category->save();
        }
        
        $this->takeExistObjects();
        
        Controller::$lastCrumb = 'Добавление категории';
        
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
            $category = Category::model($this->existSingleObject->id_parent);
            if($category){
                if($this->existSingleObject->id != $category->id_parent){
                    $this->existSingleObject->save();
                }
            }else{
                $this->existSingleObject->save();
            }
            $this->takeSingleExistObject($id);
        }
        
        $this->categories = $this->existSingleObject->otherCategories();
        
        Controller::$lastCrumb = $this->existSingleObject->title;
        
        $this->render('edit');
    }
    
    public function actionDelete($id) {
        $this->mainTemplate = 'clear';
        $model = Category::model($id);
        if($model)
        {
            $model->removeall($id);
        }
        $this->redirect($this->printControllerUrl());
    }

    public function actionPage() {
        
        $this->existSingleObject = Page::singleControlObject(Contr::CATALOG);
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
    
    protected function takeExistObjects(){
        $this->existObjects = Category::allExistObjects();
        foreach($this->existObjects as $cat)
        {
            $cat->getParent();
        }
    }
    
    protected function takeSingleExistObject($id){
        $this->existSingleObject = Category::singleExistObject($id);
        if(!$this->existSingleObject)
        {
            $this->redirect('/error/404');
        }
    }
}