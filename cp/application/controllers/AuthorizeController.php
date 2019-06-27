<?php

class AuthorizeController extends Controller {

    const PATH ='/cp';
    
    static $rules = array(
        'index' => array(
            'users' => array('guest'),
            'redirect' => '/cp/index'
            ),
        'login' => array(
            'users' => array('guest'),
            'redirect' => '/cp/index'
            ),
        'logout' => array(
            'users' => array('admin'),
            'redirect' => '/cp/index'
            ),
    );
    
    protected $errors = array();

    function actionIndex() {
        
    }
    
    function actionLogin() {
        $this->isConfigurate();
        
        $this->layout = 'base';
        if (isset($_POST['form'])) {
            $login = strip_tags(trim($_POST['form']['login']));
            $password = strip_tags($_POST['form']['password']);

            $user = Admin::modelWhere('fio = ? AND password = ? AND active = ?', array($login, $password, Admin::ACTIVE));

            if ($user) {
                $token = Auth::generateToken();
                $user->auth_token = $token;

                if ($user->save()) {
                    setcookie('auth_token', $token, time() + app::gi()->config->cookietime, self::PATH);
                    usleep(500);
                    $this->isNew();
                }else{
                    $this->errors[] = 'Произошла внутренняя ошибка при регистрации вашего аккаунта в системе';
                }
            } else {
                $this->errors[] = 'Указанная пара логин \ пароль не найдена, либо данный аккаунт заблокирован';
            }
        }
        $this->render('login');
    }
    
    function actionLogout() {
        setcookie('auth_token', '', time() - 1, self::PATH);
        $this->redirect('/cp/index');
    }

}
