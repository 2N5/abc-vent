<?php

class ErrorController extends Controller {

    static $rules = array(
        '404' => array(
            'users' => array('*')
			),
    );
    function action404() {
        header("HTTP/1.x 404 Not Found");
        $this->render('404'); 
    }
}
