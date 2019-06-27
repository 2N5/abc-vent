<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

define('PHONE', '+7(999)999-99-99');
define('TEL', '+79999999999');
define('EMAIL', 'example@mail.com'); 
define('ADDRESS', 'Москва, ул. Петровского, 27'); 

define('ROOT', dirname(__FILE__) . '/');
define('CORE', dirname(__FILE__) . '/core/'); //каталог ядра
define('APP', dirname(__FILE__) . '/application/'); //каталог фронтальной части

require_once CORE . 'autoload.php';
require_once CORE . 'functions.php';

App::gi()->start();