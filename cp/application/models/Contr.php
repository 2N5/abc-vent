<?php
class Contr extends ModelTable {
	
    const CALLBACK = 'callback';
    const DELIVERY = 'delivery';
    const CATALOG = 'category';
    const CONTACT = 'contact';
    const PRIVACY = 'privacy';
    const REVIEW = 'review';
    const MAP = 'sitemap';
    const ORDER = 'order';
    const PRICE = 'price';
    const ABOUT = 'about';
    const BLOG = 'blog';
    const CITY = 'city';
    const PAGE = 'page';
    const FAQ = 'faq';
    const MAIN = 'main';
    
    const ACTIVEMODE = 1;
    const ONFRONTMODE = 2;
    
    const ALL = 'all';
    const ALLOW = 'allow';
    const DISALLOW = 'disallow';
    
    const INACTIVE = 0;
    const ACTIVE = 1;
    
    const STATICAL = 1;
    const NONSTATICAL = 0;
    
    const COMMON = 0;
    const CHECK = 1;
    const MEDICAL = 2;
    const CERTIFICATE = 3;
    const SECURITY = 4;
    const KNOWLADGE = 5;
    
    const ALLMODE = 1;
    const STATMODE = 2;
    const NONSTATMODE = 3;
    
    const DISHEAD = 1;
    const DISFOOTER = 2;
    const DISBOTH = 3;
    
    public static $table = 'controller';
    public $safe = array('id', 'title', 'control', 'url', 'active', 'type', 'time', 'static', 'display_mode', 'on_front');
    //add allow methods
    static function disallowed($disallowed = true, $mode = self::ALLMODE){
        
        $where = 'active = ?';
        if($disallowed){
            $values = array(self::INACTIVE);
        }else{
            $values = array(self::ACTIVE);
        }
        
        if($mode !== self::ALLMODE){
            $where .= ' AND static = ?';
            $values[] =  ($mode === self::STATMODE) ? self::STATICAL : self::NONSTATICAL;
        }
        
        return self::modelsWhere($where, $values);
    }
    
    static function theme(){
        return self::modelWhere('active = ? AND type <> ?', array(self::ACTIVE, self::COMMON));
    }
    
    static function map(){
        return self::modelsWhere('active = ? AND type = ?', array(self::ACTIVE, self::COMMON));
    }
    
    static function front(){
        return self::modelsWhere('active = ? AND type = ? AND on_front = ?', array(self::ACTIVE, self::COMMON, self::ACTIVE));
    }
    
    static function statical(){
        return self::modelsWhere('static = ? AND active = ?', array(self::STATICAL, self::ACTIVE));
    }
    
    static function nonStatical($theme = true){
        $where = 'static = ? AND active = ?';
        $values = array(self::NONSTATICAL, self::ACTIVE);
        
        if(!$theme){
            $where .= ' AND type = ?';
            $values[] = self::COMMON;
        }
        
        return self::modelsWhere($where, $values);
    }
    
    static function themes($id=0){
        $where = 'type <> ?';
        $values = array(self::COMMON);
        if($id > 0){
            $where .= ' AND id <> ?';
            $values[] = $id;
        }
        return self::modelsWhere($where, $values);
    }
    
    static function commons(){
        return self::modelsWhere('type = ?', array(self::COMMON));
    }
    
    static function pageContr(){
        return self::modelWhere('control = ?', array(self::PAGE));
    }
    
    static function disallowStatical(){
        foreach (self::statical() as $static){
            $static->active = self::INACTIVE;
            $static->save();
        }
    }
    
}
