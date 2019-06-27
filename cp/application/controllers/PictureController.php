<?php

class PictureController extends Controller
{

    static $rules = array(
        'index' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        'add' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
            ),
        );
    
    private $directory = '../uploads/artimg';
    private $correctPic = array('jpg', 'jpeg', 'gif', 'png');
    
    public function actionIndex()
    {
        $directory = $this->directory;
        
        if(!is_dir($directory))
        {
            $files = array('Нет такой директории - '.$directory.'. После добавления изображения она создастся автоматически.');
        }else{
            $files = array();
            foreach (scandir($directory) as $file) {
                $files[$file] = filemtime($directory.'/'.$file);
            }
            asort($files);
            $files = array_reverse(array_keys($files));
        }
        
        $this->render('index', array('files'=>$files));
    }
        
    public function actionAdd()
    {
        $files = $_FILES['picture'];
        
        if (empty($files['name']))
        {
            return false;
        }
        
        $finfo = finfo_open();
        $type = explode(' ', finfo_file($finfo, $files['tmp_name']))[0];
        
        $fileName = uniqid().'.'.strtolower($type);
        
        $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/artimg/';
        if (!file_exists($upload_dir)) {
            if (!mkdir($upload_dir, 0777, true)) {
                die('Не удалось создать: ' . $upload_dir);
            }
        }
        
        move_uploaded_file($files['tmp_name'], $upload_dir . $fileName);
        
        $this->redirect($this->printControllerUrl());
    }
    
}