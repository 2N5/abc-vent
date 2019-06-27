<?php

class CategoryController extends Controller {
    static $rules = array(
        'index' => array(
            'users' => array('*'),
            'redirect' => '/error/younotloggin'
        ),
        'processing' => array(
            'users' => array('*'),
            'redirect' => '/error/younotloggin'
        ),
    );

    protected $themeObjects = array();
    protected $otherObjects = array();
    
    public function actionIndex() {
        $this->init(Contr::CATALOG);
        $this->seoText = $this->page->content;
        $this->takeCategoriesWithCerts();
        
        $theme = App::gi()->themeName;
        $this->otherObjects = $theme::withoutCategory();
        
        $this->render('index');
    }
    
    public function actionProcessing($url = '', $param='') {
        if($param != '')
        {
            $this->error404();
        }
        
        $this->init(Contr::CATALOG);
        
        if(!$url)
        {
            $this->seoText = $this->page->content;
            $this->takeCategoriesWithCerts();
            
            $model = App::gi()->themeName;
            $this->otherObjects = $model::withoutCategory();
            $this->certsInfo($this->otherObjects);
            
        }else{
            $this->showCatalog = false;
            $this->catalogFilter($url);
        }
        
        $this->render('processing');
    }
    
    protected function takeCategoriesWithCerts()
    {
        $this->themeObjects = Category::themeParent();
        foreach($this->themeObjects as $parent)
        {
            $parent->getChilds();
            if(!count($parent->childs))
            {
                $parent->getCerts();
                $this->certsInfo($parent->docs);
                continue;
            }
            
            foreach($parent->childs as $child)
            {
                $child->getCerts();
                $this->certsInfo($child->docs);
            }
        }
    }
    
    protected function certsInfo(array $certs)
    {
        foreach($certs as $cert)
        {
            $cert->pictureInfo();
        }
    }
    
    protected function catalogFilter($url)
    {
        $category = Category::modelWhere('url = ?', array($url));
        if($category)
        {
            $this->setMeta($category);
            $this->seoText = $category->seo_text;
            $category->getChilds();
            if(!count($category->childs))
            {
                $category->getCerts();
                $this->certsInfo($category->docs);
            }else{
                foreach($category->childs as $child)
                {
                    $child->getCerts();
                    $this->certsInfo($child->docs);
                }
            }            
        }else{
            $this->error404();
        }
        $this->themeObjects[] = $category;
    }
        
    protected function takeExistObjects(){
        $this->themeObjects = Theme::themeModel();
    }
}
