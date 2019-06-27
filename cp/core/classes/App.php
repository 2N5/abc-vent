<?php

class App extends Singleton {

    public $config = null;
    public $uri = null;
    public $user = null;
    public $user_role = 'guest';
    public $convertApiKey = '8b8f5ad90d4b9184fd2e3225f2a26c96';
    public $translate = array();
    
    public $theme = null;
    public $statical = array();
    public $nonStatical = array();
    
//    private static $crumbs = array();
    
    public function __construct() {
        $this->initSystemHandlers();
        $default_config = include CORE . 'config.php';
        $custom_config = include APP . 'config.php';
        $this->config = new Registry(array_merge($default_config, $custom_config));

        include CORE . 'classes/adapter/db.php';
    }

    function start() {
        
        $this->theme = Contr::theme();
        $this->statical = Contr::statical();
        $this->nonStatical = Contr::nonStatical(false);
        
        $this->uri = new Registry(Router::gi()->parse($_SERVER['REQUEST_URI']));
        $this->loadTranslate();
		
        if (class_exists($this->uri->controller . 'Controller')) {
            $this->loadUser();
            if (method_exists($this->uri->controller . 'Controller', 'action' . $this->uri->action)) {
                if ($this->isAllowed($this->uri->controller . 'Controller', $this->uri->action)) {
                    $controller = app::gi($this->uri->controller . 'Controller');
                }
            } else {
                Controller::gi()->redirect(App::gi()->config->path_error_controller . '/404');
            }
        } else {
            Controller::gi()->redirect(App::gi()->config->path_error_controller . '/404');
        }
        
        ob_start();
        $controller->modelClassName();
        $controller->__call('action' . $this->uri->action, $this->uri->id);
        $content = ob_get_clean();
        if ($this->config->scripts and is_array($this->config->scripts)) {
            foreach ($this->config->scripts as $script) {
                $controller->addScript($script);
            }
        }
        if ($this->config->styles and is_array($this->config->styles)) {
            foreach ($this->config->styles as $style) {
                $controller->addStyleSheet($style);
            }
        }
        $controller->renderPage($content);
    }

    protected function initSystemHandlers() {
        set_exception_handler(array($this, 'handleException'));
        set_error_handler(array($this, 'handleError'), error_reporting());
    }

    public function handleError($code, $message, $file, $line) {
        if ($code & error_reporting()) {
            restore_error_handler();
            restore_exception_handler();
            try {
                $this->displayError($code, $message, $file, $line);
            } catch (Exception $e) {
                $this->displayException($e);
            }
        }
    }

    public function handleException($exception) {
        restore_error_handler();

        restore_exception_handler();
        $this->displayException($exception);
    }

    public function displayError($code, $message, $file, $line) {
        echo "<h1>PHP Error [$code]</h1>\n";
        echo "<p>$message ($file:$line)</p>\n";
        echo '<pre>';

        $trace = debug_backtrace();

        if (count($trace) > 3)
            $trace = array_slice($trace, 3);

        foreach ($trace as $i => $t) {
            if (!isset($t['file']))
                $t['file'] = 'unknown';
            if (!isset($t['line']))
                $t['line'] = 0;
            if (!isset($t['function']))
                $t['function'] = 'unknown';
            echo "#$i {$t['file']}({$t['line']}): ";
            if (isset($t['object']) && is_object($t['object']))
                echo get_class($t['object']) . '->';
            echo "{$t['function']}()\n";
        }

        echo '</pre>';
        exit();
    }

    public function displayException($exception) {
        echo '<h1>' . get_class($exception) . "</h1>\n";
        echo '<p>' . $exception->getMessage() . ' (' . $exception->getFile() . ':' . $exception->getLine() . ')</p>';
        echo '<pre>' . $exception->getTraceAsString() . '</pre>';
    }

    public function isAuthorize() {
        return ($this->user instanceof Admin) ? true : false;
    }

    function isAllowed($controller, $action) {
        
        $rules = $controller::$rules;

        if (array_key_exists($action, $rules)) {

            if (in_array($this->user_role, $rules[$action]['users'])) {
                return true;
            } else if (in_array('*', $rules[$action]['users'])) {
                return true;
            } else {
                Controller::gi()->redirect($rules[$action]['redirect']);
            }
        } else {
            throw new Except('In controller: <strong>' . ucfirst($controller) . '</strong> was not set rule for action: <strong> ' . $action . '</strong>');
        }

        $redirect_path = empty($action) ? $rules['*']['redirect'] : $rules[$action]['redirect'];
        Controller::gi()->redirect($redirect_path);
    }
    
    public function loadUser() {
        if (Auth::issetCookie('auth_token')) {
            $user = Admin::modelWhere('auth_token = ?', array($_COOKIE['auth_token']));
            if ($user) {
                $this->user = $user;
                $this->user_role = $user->role()->title;
            }
        }
    }
    
    private function loadTranslate() {
        if (file_exists(ROOT . 'lang/' . $this->uri->lang . '.php')) {
            require_once ROOT . 'lang/' . $this->uri->lang . '.php';
            $this->translate = $text;
        }
    }
    
//    public static function setLinks(array $crumbs)
//    {
//        $breadCrumbs = array();
//        foreach ($crumbs as $link=>$crumb)
//        {
//            if(is_int($link))
//            {
//                $breadCrumbs[] = $crumb;
//                continue;
//            }
//            
//            $breadCrumbs[] = '<a href="'.$link.'">'.$crumb.'</a>';
//        }
//        debug($crumbs);
//        debug($breadCrumbs);
//        self::$crumbs = $breadCrumbs;
//    }
//    
//    public static function getLinks()
//    {
//        return implode(' ', self::$crumbs);
//    }
    
    //----------------Config file options--------------------
    public static function configWrite($theme_id = 0) {
        $configphp = <<<'CONF'
<?php
return array(
    'sitename' => $_SERVER['SERVER_NAME'],
    'db' => include 'config.db.php',
    'layout' => 'base',
    'path_error_controller' => '/error',
    'router' => array(
        'sitemap.xml' => 'page/xml',
CONF;
        
            $configphp .= App::heredocRules($theme_id)."\n";
            
            $configphp .= <<<'CONF'
        '([a-z0-9+_\-]+)/([a-z0-9+_\-]+)/([a-z0-9+/_\-]+)' => '$controller/$action/$id',
        '([a-z0-9+_\-]+)/([a-z0-9+_\-]+)' => '$controller/$action',
        '([a-z0-9+_\-]+)' => '$controller',
    ),
);
CONF;
        file_put_contents('../application/config.php', $configphp);
//        echo 'File owerwrited<hr>New file is:';
//        $new = file_get_contents('../application/config.php');
//        debug($new, true);
    //--------------------------------------------------------- 
    }
    
    public static function heredocRules($theme_id) {
        $static = true;
        $heredocRules = <<<RULES
RULES;
        
        //set rules for disallowed non static and check if page is disallowed
        foreach(Contr::disallowed(true, Contr::NONSTATMODE) as $nonstat){
            if($nonstat->control == Contr::PAGE){
                $static = false;
            }
            
            $heredocRules .= <<<RULES
                    \n\t'$nonstat->control(.*)' => 'error/404',
RULES;
        }
        //If page is active set rules for static pages
        if($static){
            foreach(Contr::disallowed(true, Contr::STATMODE) as $stat){
                $heredocRules .= <<<RULES
                    \n\t'page/$stat->control(.*)' => 'error/404',
RULES;
            }
        }
        
        $action = '$action';
        $id = '$id';
        
        $allowedPag = array(
                        Contr::REVIEW,
                        Contr::FAQ,
                        Contr::BLOG
                        );
        
        $heredocPage = <<<PAGE
PAGE;
        $heredocTheme = <<<THEME
THEME;
        if(!$theme_id){
            $theme_id = self::gi()->theme->id;
        }
        //Set allow rules for chenged urls and theme
        foreach(Contr::disallowed(false) as $allowed){
            if($allowed->url === $allowed->control){
                continue;
            }
            
            if($allowed->static == Contr::STATICAL){
                if($allowed->control == Contr::MAIN){ continue; }
                $heredocPage .= <<<PAGE
                    \n\t'$allowed->url(.+)' => 'error/404',
                    '^/?$allowed->url$' => 'page/$allowed->control',
PAGE;
            }else{
                if($theme_id == $allowed->id){ 
                    $heredocTheme .= <<<THEME
                    \n\t\t'$allowed->url/([a-z0-9+_\-]+)/([a-z0-9+/_\-]+)' => 'theme/$action/$id',
                '$allowed->url/([a-z0-9+_\-]+)' => 'theme/$action',
                '$allowed->url' => 'theme',      
THEME;
                    continue;
                }
                if(in_array($allowed->control, $allowedPag)){
                    $heredocRules .= <<<RULES
                        \n\t\t'$allowed->url/([0-9]+)' => '$allowed->control/index/$id',
                        '$allowed->url/([a-z0-9+/_\-]+)' => '$allowed->control/processing/$id',
                    '^/?$allowed->url$' => '$allowed->control',
RULES;
                }else{
                    $heredocRules .= <<<RULES
                        \n\t\t'$allowed->url/([a-z0-9+/_\-]+)' => '$allowed->control/processing/$id',
                    '^/?$allowed->url$' => '$allowed->control',
RULES;
                }
            }
            
        }
        
        return $heredocRules.$heredocPage.$heredocTheme;
    }
}