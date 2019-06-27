<?php

class ErrorController extends Controller {

    static $rules = array(
        '404' => array(
            'users' => array('*')
        ),
        'notenoughdata' => array(
            'users' => array('*')
        ),
    );
    function action404() {
        header("HTTP/1.x 404 Not Found");
        echo 'Страница не найдена';
    }
    
    function actionNotEnoughData() {
        echo 'Вы передали не достаточно данных для выполнения этого действия';
    }
}
