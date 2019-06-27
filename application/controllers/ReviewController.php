<?php

class ReviewController extends Controller {

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
    
    public $reviews = array();
    public $review = null;
    
    public function actionIndex($page = 0, $param = '')
    {
        if($param != '')
        {
            $this->error404();
        }
        
        $this->init(Contr::REVIEW);
        
        $this->limitPerPage = 7;
        $this->countRow = Review::countRowWhere('(cheked = ? OR ip = ?) AND (id_theme = ? AND id_city = ?)', array(Review::CONFIRMED, $_SERVER['REMOTE_ADDR'], Review::NO_CERT, Review::NO_CITY));
        $this->navigationPages = $this->countRow / $this->limitPerPage;
        
        $this->checkParametr($page);
        
        $where = '(cheked = ? OR ip = ?) AND (id_theme = ? AND id_city = ?) ORDER BY id DESC LIMIT ' . $this->start . ', ' . $this->limitPerPage;
        $this->reviews = Review::modelsWhere($where, array(Review::CONFIRMED, $_SERVER['REMOTE_ADDR'], Review::NO_CERT, Review::NO_CITY));
        
        $this->pagination($this->page->url);
        $summ = 0;
        $amount = 0;
        $rating = 0;

        $citys = City::models();

        foreach ($this->reviews as $review)
        {
            $amount++;
            $summ += $review->mark;
        }
        if($amount > 0)
        {
            $rating = round($summ/$amount, 2);
        }
        
        setlocale(LC_ALL, 'ru_RU.UTF-8');
        $this->render('index', array('rating'=>$rating, 'amount'=>$amount, 'citys'=>$citys));
    }
    
    public function actionProcessing($page = 0, $param = '')
    {
        if ($param != '') {
            $this->error404();
        }
        
        $this->init(Contr::REVIEW);
        
        $this->limitPerPage = 7;
        $this->countRow = Review::countRowWhere('(cheked = ? OR ip = ?) AND (id_theme = ? AND id_city = ?)', array(Review::CONFIRMED, $_SERVER['REMOTE_ADDR'], Review::NO_CERT, Review::NO_CITY));
        $this->navigationPages = $this->countRow / $this->limitPerPage;

        $this->checkParametr($page);
        
        $where = '(cheked = ? OR ip = ?) AND (id_theme = ? AND id_city = ?) ORDER BY id DESC LIMIT ' . $this->start . ', ' . $this->limitPerPage;
        $this->reviews = Review::modelsWhere($where, array(Review::CONFIRMED, $_SERVER['REMOTE_ADDR'], Review::NO_CERT, Review::NO_CITY));

        $this->pagination($this->page->url);
        $summ = 0;
        $amount = 0;
        $rating = 0;
        foreach ($this->reviews as $review)
        {
            $amount++;
            $summ += $review->mark;
        }
        if($amount > 0)
        {
            $rating = round($summ/$amount, 2);
        }
        
        setlocale(LC_ALL, 'ru_RU.UTF-8');
        $this->render('index', array('rating'=>$rating, 'amount'=>$amount));
    }
    
    protected function takeObject($url) {
        $this->review = Review::modelWhere('url = ?', array($url));
        if (!$this->review) {
            $this->error404();
        }
    }    
}
