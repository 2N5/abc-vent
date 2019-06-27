<?php

class Controller extends Singleton {

    public $navigationPages = 1;
    public $currentPage = 0;
    public $limitPerPage = 0;
    public $start = 0;
    public $countRow = 0;
    
    public $paginPage = false;
    public $canonical = '';
    public $next = '';
    public $prev = '';
    
    public $message = '';
    public $meta_title = '';
    public $meta_keywords = '';
    public $meta_description = '';
	
    public static $lastCrumb = '';
    public $layout = 'base';
    public $mainTemplate = 'main';
//-----------------------------------------------------------------------------------
    public $modelClassName = '';
	
    public function modelClassName(){
        $calledClass = strtolower(str_replace('Controller', '', get_called_class()));
        $control = Contr::modelWhere('control = ?', array($calledClass));
        
        if($control){
            $this->modelClassName = $control->url;
        }else{
            $this->modelClassName = $calledClass;
        }
    }
    
    public function takeModelClassName(){
        return $this->modelClassName;
    }
    
//-----------------------------------------------------------------------------------
    public $page = null;
    
    public function init($contr=''){
        $this->checkPost();
        if($contr){
            if(is_object($contr)){
                $this->setMeta($contr);
            }else{
                $this->page = Page::contrPage($contr);
                $this->setMeta($this->page);    
            }
        }
    }
//-----------------------------------------------------------------------------------
    
    public function langPrefix() {
        $appInstance = App::gi();
        
        return ($appInstance->default_lang !== $appInstance->uri->lang) ? '/'.$appInstance->uri->lang : '';
    }
    
    public function controllerUrl($action = '', array $args = array(), $theme = false, $langPrefix = false){
        $url = '';
        if($langPrefix){
            $url .= $this->langPrefix();
        }
        
        if($theme){
            $url .= '/'.Contr::theme()->url;
        }else{
            if($this->modelClassName != 'page'){
                $url .= '/'.$this->modelClassName;
            }
        }
        
        if($action){
            $url .= '/'.$action;
        }
        
        foreach($args as $arg)
        {
            $url .='/'.$arg;
        }
        
        return $url;
    }
//-------------------------------------------------------------------------------------
    static $rules = array(
        'index' => array(
            'users' => array('*')
        )
    );
    
    function __call($methodName, $args = array()) {
        if (method_exists($this, $methodName)){
            return call_user_func_array(array($this, $methodName), $args);
        }
        else {
            $this->redirect('/error/404');
            // throw new Except('In controller ' . get_called_class() . ' method ' . $methodName . ' not found!');
        }
    }

    public $tplPath = '';
    public $tplControllerPath = '';

    function __construct() {
        $this->meta_title = App::gi()->config->sitename;
        $this->layout = app::gi()->config->layout;
        $this->tplPath = APP . 'views/';
        $this->tplControllerPath = APP . 'views/' . strtolower(str_replace('Controller', '', get_called_class())) . '/';
    }

    //редирект
    function redirect($path = '/') {
        header('Location: ' . $path);
    }
    
    function refresh() {
        header('Location: ' . $_SERVER['REQUEST_URI']);
    }
    
    
   function link($path = '') {
        $link = '';
        if(App::gi()->default_lang !== App::gi()->uri->lang){
            $link = '/' . App::gi()->uri->lang;
        }
        return $link . $path;
   }

    private function _renderPartial($fullpath, $variables = array(), $output = true) {
        extract($variables);

        if (file_exists($fullpath)) {
            if (!$output)
                ob_start();
            include $fullpath;
            return !$output ? ob_get_clean() : true;
        } else
            throw new Except('File ' . $fullpath . ' not found');
    }

    /**
     * Рендер вида
     *
     * @params $filename - название темплейта в папке views / controller name / {}. php
     * @params $variables - массив занчений которые будут доступны из файла вида
     * @params $output - вывод на экран либо в переменную
     */
    public function renderPartial($filename, $variables = array(), $output = true) {
        $file = $this->tplControllerPath . str_replace('..', '', $filename) . '.php';
        return $this->_renderPartial($file, $variables, $output);
    }

    public function render($filename, $variables = array(), $output = true) {
        $this->renderPartial($filename, $variables, $output);
    }

    /**
     * render - рендер страницы
     */
    public function renderPage($content) {
        $html = $this->_renderPartial($this->tplPath . $this->mainTemplate . '.php', array('content' => $content), false);
        $output = array('head' => '', 'body' => '');
        foreach ($this->assets as $item) {
            if ($item['asset'] == 'script') {
                if ($item['type'] == 'inline') {
                    $output[$item['where']].='<script type="text/javascript">' . $item['data'] . '</script>' . "\n";
                } else {
                    $output[$item['where']].='<script type="text/javascript" src="' . $item['data'] . '"></script>' . "\n";
                }
            } else {
                if ($item['type'] == 'inline') {
                    $output[$item['where']].='<style>' . $item['data'] . '</style>' . "\n";
                } else {
                    $output[$item['where']].='<link rel="stylesheet" href="' . $item['data'] . '" type="text/css" />' . "\n";
                }
            }
        }
        if ($output['head']) {
            $html = preg_replace('#(<\/head>)#iu', $output['head'] . '$1', $html);
        }
        if ($output['body']) {
            $html = preg_replace('#(<\/body>)#iu', $output['body'] . '$1', $html);
        }

        echo $html;
    }

    //подключение скриптов и стилей
    private $assets = array();

    private function addAsset($link, $where = 'head', $asset = 'script', $type = 'url') {
        $hash = md5('addScript' . $link . $where . $asset . $type);
        $where = $where == 'head' ? 'head' : 'body';
        $asset = $asset == 'script' ? 'script' : 'style';
        if (!isset($this->assets[$hash])) {
            $this->assets[$hash] = array('where' => $where, 'asset' => $asset, 'type' => $type, 'data' => $link);
        }
    }

    public function addScript($link, $where = 'head') {
        $this->addAsset($link, $where);
    }

    public function addStyleSheet($link, $where = 'head') {
        $this->addAsset($link, $where, 'style');
    }

    public function addScriptDeclaration($data, $where = 'head') {
        $this->addAsset($data, $where, 'script', 'inline');
    }

    public function addStyleSheetDeclaration($data, $where = 'head') {
        $this->addAsset($data, $where, 'style', 'inline');
    }

    public function error404()
    {
        ob_get_clean();
        ob_start();
        
        $controller = ErrorController::gi();
        $controller->__call('action404');
        $content = ob_get_clean();
        
        $app = App::gI();
        $app->uri->controller = 'error';
        $app->uri->action = '404';
        
        $controller->renderPage($content);
        exit();
    }
            
    public function checkPost() {
        if (!count($_POST)) {
            return;
        }
        
        $form = new Form($_POST);
        $form->process();
        $this->message = $form->getMessage(); 
    }
    
    public function pagination($url)
    {
        if($this->navigationPages > 1){
            $canon = 'http://'.$_SERVER['SERVER_NAME'].'/'.$url;
            $this->paginPage = true;
            $this->canonical = $canon;

            $next = '';
            $prev = '';

            switch($this->currentPage)
            {
                case 0:
                    $next = $canon.'/'.($this->currentPage+2);
                    break;
                default:
                    if($this->currentPage+1 < $this->navigationPages)
                    {
                        $next = $canon.'/'.($this->currentPage+2);
                    }
                    
                    if($this->currentPage == 1)
                    {
                        $prev = $canon;
                    }else{
                        $prev = $canon.'/'.$this->currentPage;
                    }
                    
                    $this->meta_title .= ' Страница '.($this->currentPage+1);
            }

            $this->next = $next;
            $this->prev = $prev;
        }
    }

    public function checkParametr($page) {
        if ($page === 0) {
            return;
        }

        if ((int) $page == 0) {
            $this->error404();
        }

        if ((int) $page == 1) {
            $this->error404();
        }

        if (preg_match("/^[0-9]+[^0-9]+/", $page)) {
            $this->error404();
        }

        $startPage = $page - 1;
        $objects = $this->navigationPages - $startPage;

        if ($objects < 0 or $objects == 0) {
            $this->error404();
        }

        $this->start = $startPage * $this->limitPerPage;
        $this->currentPage = $startPage;
    }
    
    public function setMeta($page){
        $page->preShorts();
        
        if($page instanceof Theme){
            $this->meta_title = str_replace('[price]', $page->price.'руб.', $page->meta_title);
            $this->meta_keywords = str_replace('[price]', $page->price.'руб.', $page->meta_keywords);
            $this->meta_description = str_replace('[title]', $page->title, str_replace('[price]', $page->price.' руб.', $page->meta_description));
        }else{
            $this->meta_title = $page->meta_title;
            $this->meta_keywords = $page->meta_keywords;
            $this->meta_description = $page->meta_description;
        }
    }
    
//    public function doShorts($page=null){
//        
//        $obj = is_object($page) ? $page : $this;        
//        $shortcuts = Shortcut::converting();
//        ? $page : $this;        
//        foreach ($shortcuts as $shortcut){
//            $this->meta_title = str_replace($shortcut->title, $shortcut->value, $obj->meta_title);
//            $this->meta_keywords = str_replace($shortcut->title, $shortcut->value, $obj->meta_keywords);
//            $this->meta_description = str_replace($shortcut->title, $shortcut->value, $obj->meta_description);
//        }
//    }
}
