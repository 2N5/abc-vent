<?php
class Review extends ModelTable {
    
    const CONFIRMED = 1;
    const ON_REVIEW = 0;
    
    const NO_CERT = 0;
    const NO_CITY = 0;
    
    public static $table = 'review';
    public $safe = array('id', 'name', 'text', 'time', 'cheked', 'picture', 'position', 'city',
                         'id_city', 'id_theme', 'mark', 'ip');
    public $translate = array('name'=>'Имя', 'text'=>'Текст отзыва', 'time'=>'Время отправки', 
                            'position'=>'Должность', 'city'=>'Город', 'mark'=>'Рейтинг');
    
//    public $picture = '';
    
    public static function allExistObjects($limit){        
        return self::modelsWhere('cheked = ? ORDER BY id DESC '.$limit, array(self::CONFIRMED));
    }
    
    public static function singleExistObject($id){
        return self::model((int)$id);
    }
    
    public function beforeSave()
    {
        if(parent::beforeSave())
        {
            if(preg_match('/[a-z]+/i', $this->text, $matches))
            {
                return false;
            }else{
                return true;
            }
        }
        return false;
    }
}
