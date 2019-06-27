<?php
class BlogController extends Controller {
    static $rules = array(
        'index' => array(
            'users' => array('*'),
            'redirect' => '/error/younotloggin'
        ),
        'processing' => array(
            'users' => array('*'),
            'redirect' => '/error/younotloggin'
        )
    );
    
    public $articles = array();
    public $otherArticles = array();
    public $article = null;
    
    public function actionIndex($page = 0) {
        
        $this->init(Contr::BLOG);
        
        $this->limitPerPage = 10;
        $this->countRow = Article::countRow();
        $this->navigationPages = $this->countRow / $this->limitPerPage;
        
        $this->checkParametr($page);
        
        $where = 'id ORDER BY time DESC LIMIT ' . $this->start . ', '.$this->limitPerPage;
        $this->articles = Article::modelsWhere($where);
        
        $this->pagination($this->page->url);
        
        // if(!count($this->articles)){
        //     $this->redirect('/error/404');
        // }
        
//        foreach($this->articles as $article){
//            $article->pictureInfo();
//        }
        
        setlocale(LC_TIME, 'ru_RU.UTF-8');
        $this->render('index');
    }
    
    public function actionProcessing($url, $param='') {
        
        if($param != '')
        {
            $this->error404();
        }
        $this->checkPost();
        
//        $this->otherArticles = Article::modelsWhere('url <> ?', array($url));
//        foreach($this->otherArticles as $other){
//            $other->pictureInfo();
//        }
        
        $this->article = Article::modelWhere('url = ?', array($url));
        $this->article->takePicture();
        
        // if(!$this->article){
        //     $this->redirect('/error/404');
        // }
        
        $this->setMeta($this->article);
        Controller::$lastCrumb = $this->article->title;
//        $this->article->siblings();
        
        setlocale(LC_TIME, 'ru_RU.UTF-8');
        $this->render('article');
    }
    
    protected function meta($article) {
        $this->meta_title = ($article->meta_title != '') ? $article->meta_title : $article->title;
        $this->meta_keywords = ($article->meta_keywords != '') ? $article->meta_keywords : $article->title;
        $this->meta_description = ($article->meta_description != '') ? $article->meta_description : $article->title;
    }
}


