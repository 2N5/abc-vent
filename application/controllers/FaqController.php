<?php

class FaqController extends Controller {

    static $rules = array(
        'index' => array(
            'users' => array('*'),
            'redirect' => '/cp/authorize/login'
        ),
        'processing' => array(
            'users' => array('*'),
            'redirect' => '/cp/authorize/login'
        ),
        'watermark' => array(
            'users' => array('*'),
            'redirect' => '/cp/authorize/login'
        ),
        'resize' => array(
            'users' => array('*'),
            'redirect' => '/cp/authorize/login'
        ),
    );
    
    public $faqs = array();
    public $faq = null;
    
    public function actionIndex($page = 0, $param = '')
    {
        if ($param != '') {
            $this->error404();
        }
        
        $this->init(Contr::FAQ);
        
        $this->limitPerPage = 7;
        $this->countRow = Faq::countRowWhere('cheked = ? OR ip = ?', array(Faq::CONFIRMED, $_SERVER['REMOTE_ADDR']));
        $this->navigationPages = $this->countRow / $this->limitPerPage;
        
        $this->checkParametr($page);
        
        $where = 'cheked = ? OR ip = ? ORDER BY id DESC LIMIT ' . $this->start . ', ' . $this->limitPerPage;
        $this->faqs = Faq::modelsWhere($where, array(Faq::CONFIRMED, $_SERVER['REMOTE_ADDR']));
        
        $this->pagination($this->page->url);
        
        $this->render('index');
    }
    
    public function actionProcessing($page = 0, $param = '')
    {
        if ($param != '') {
            $this->error404();
        }
        
        $this->init(Contr::FAQ);
        
        $this->limitPerPage = 7;
        $this->countRow = Faq::countRowWhere('cheked = ? OR ip = ?', array(Faq::CONFIRMED, $_SERVER['REMOTE_ADDR']));
        $this->navigationPages = $this->countRow / $this->limitPerPage;

        $this->checkParametr($page);
        
        $where = 'cheked = ? OR ip = ? ORDER BY id DESC LIMIT ' . $this->start . ', ' . $this->limitPerPage;
        $this->faqs = Faq::modelsWhere($where, array(Faq::CONFIRMED, $_SERVER['REMOTE_ADDR']));

        $this->pagination($this->page->url);
        
        $this->render('index');
    }
    
    protected function takeObject($url) {
        $this->faq = Faq::modelWhere('url = ?', array($url));
        if (!$this->faq) {
            $this->error404();
        }
    }    
}
