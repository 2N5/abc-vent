<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

define('ROOT', dirname(__FILE__) . '/');
define('CORE', dirname(__FILE__) . '/core/'); //������� ����
define('APP', dirname(__FILE__) . '/application/'); //������� ����������� �����

define('UPLOAD', dirname('../main.php') . '/uploads/');

require_once CORE . 'autoload.php';
require_once CORE . 'functions.php';

App::gi()->start();
