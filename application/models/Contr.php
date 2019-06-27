<?php
class Contr extends ModelTable {
	
    const CALLBACK = 'callback';
    const DELIVERY = 'delivery';
    const CATALOG = 'category';
    const CONTACT = 'contact';
    const PRIVACY = 'privacy';
    const REVIEW = 'review';
    const ORDER = 'order';
    const PRICE = 'price';
    const ABOUT = 'about';
    const MAP = 'sitemap';
    const BLOG = 'blog';
    const CITY = 'city';
    const PAGE = 'page';
    const FAQ = 'faq';
    const MAIN = 'main';
    
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
    const ONFRONTMODE = 4;
    
    const DISHEAD = 1;
    const DISFOOTER = 2;
    const DISBOTH = 3;
    
    public static $table = 'controller';
    public $safe = array('id', 'title', 'control', 'url', 'active', 'type', 'time',
                        'static', 'inmap', 'on_front', 'display_mode');
    
    static function disallowed($disallowed = true, $mode = self::ALLMODE){
        
        $where = 'active = ?';
        if($disallowed){
            $values = array(self::INACTIVE);
        }else{
            $values = array(self::ACTIVE);
        }
        
        switch($mode){
            case self::STATMODE :
                $where .= ' AND static = ?';
                $values[] =  self::STATICAL;
                break;
            case self::NONSTATMODE :
                $where .= ' AND static = ?';
                $values[] =  self::NONSTATICAL;
                break;
            case self::ONFRONTMODE :
                $where .= ' AND on_front = ?';
                $values[] =  self::ACTIVE;
                break;
//            default :
        }
        
        return self::modelsWhere($where, $values);
    }
    
    public static function sections(){
        $pages = array();
        $models = self::disallowed(false, self::ONFRONTMODE);
        
        foreach($models as $model){
            switch($model->display_mode){
                case self::DISHEAD :
                        $pages['head'][] = $model;
                    break;
                case self::DISFOOTER :
                        $pages['footer'][] = $model;
                    break;
                default:
                        $pages['head'][] = $model;
                        $pages['footer'][] = $model;
                    break;
            }
        }
        
        return $pages;
    }
    
    static function printUrl($control){
        $model = self::modelWhere('control = ?', array($control));
        if($model){
            return $model->url;
        }else{
            return '/error/404';
        }
    }
    
    static function theme(){
        return self::modelWhere('active = ? AND type <> ?', array(self::ACTIVE, self::COMMON));
    }
    
    static function map(){
        return self::modelsWhere('active = ? AND type = ?', array(self::ACTIVE, self::COMMON));
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
    
    static function navigateLinks($currentPage, $navPages, $contr='r'){
        $links = '';

        switch($contr){
            case 'f' :
                $contr = self::FAQ;
                break;
            case 'b' :
                $contr = self::BLOG;
                break;
            default:
                $contr = self::REVIEW;
        }

        for ($i = 0; $i < $navPages; $i++) {
            $class = $currentPage == $i ? 'dslc-active' : 'dslc-inactive';
            $value = $i + 1;
            $href = ($i == 0) ? '/'.self::printUrl($contr) : '/'.self::printUrl($contr).'/' . $value;
            
            if($class == 'dslc-active'){
                $links .= '<li class="'.$class.'"><a>'.$value.'</a></li>';
            }else{
                $links .= '<li class="'.$class.'"><a href="'.$href.'">'.$value.'</a></li>';
            }
        } 
        
        echo $links;
    }
}
