<?php
class Comment extends ModelTable {
    
    const CONFIRMED = 1;
    const ON_REVIEW = 0;
    
    public static $table = 'comment';
    public $safe = array('id', 'name', 'text', 'city', 'cheked', 'email', 'id_controller', 'id_model', 'ip', 'time');

    
    public static function themePost($id_model){
        $control = Contr::theme();
        
        return self::modelsWhere('(cheked = ? OR ip = ?) AND id_controller = ? AND id_model = ?', array(Comment::CONFIRMED, $_SERVER['REMOTE_ADDR'], $control->id, $id_model));
    }
    
    public static function allExistObjects(){        
        return self::modelsWhere('id ORDER BY id DESC');
    }
    
    public static function singleExistObject($id){
        return self::model((int)$id);
    }
}
