<?php
class SiteMap
{
    private static $siteName = '';
    //--------------------URLs--------------------
//    private static $themeLocation = '';
//    private static $articleLocation = '';
//    private static $categoryLocation = '';
//    private static $cityLocation = '';
//    private static $reviewLocation = '';
//    private static $qaLocation = '';
    //--------------------HTML--------------------
    private static $openUl = '<ul>';
    private static $openLi = '<li>';
    private static $closeLi = '</li>';
    private static $closeUl = '</ul>';
    //---------------------XML--------------------
    private static $openURL = "<url>\r\n";
    private static $openLOC = "<loc>";
    private static $closeURL = "</url>\r\n";
    private static $closeLOC = "</loc>\r\n";
    
    public static function generateXML()
    {
        self::$siteName = $_SERVER['SERVER_NAME'];
//        $staticPages = Page::pages();
//        $themeObjects = Theme::themeModel();
//        $articles = Article::models();
//        $categories = Category::models();
//        $cities = City::models();
        
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\r\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\r\n";
        
        $xml .= self::$openURL.self::$openLOC.'http://'.self::$siteName.'/'.self::$closeLOC.self::$closeURL;
        
        foreach (Contr::disallowed(false, Contr::ONFRONTMODE) as $control)
        {
            if($control->control == Contr::MAP){ continue; }
            
            $xml .= self::$openURL.self::$openLOC.'http://'.self::$siteName.'/'.$control->url.self::$closeLOC.self::$closeURL;
            
            if($control->control == Contr::FAQ or $control->control == Contr::REVIEW){
                continue;
            }
            
            if($control->static == Contr::STATICAL){
                $model = ucfirst(Contr::PAGE);   
                $objects = $model::modelWhere('url = ?', array($control->url));
                continue;
            }else{
                $model = ucfirst($control->control);
                if($control->control == Contr::CATALOG){
                    foreach($model::themeCats() as $category){
                        $xml .= self::$openURL.self::$openLOC.'http://'.self::$siteName.'/'.$control->url.'/'.$category->url.self::$closeLOC.self::$closeURL;
                        foreach ($category->childs as $child){
                            $xml .= self::$openURL.self::$openLOC.'http://'.self::$siteName.'/'.$control->url.'/'.$child->url.self::$closeLOC.self::$closeURL;
                        }
                    }
                    continue;
                }else{
                    $objects = $model::models();
                }
            }
            
            foreach($objects as $object){
                $xml .= self::$openURL.self::$openLOC.'http://'.self::$siteName.'/'.$control->url.'/'.$object->url.self::$closeLOC.self::$closeURL;
            }
        }
        
        foreach(Theme::themeModel() as $doc){
            $xml .= self::$openURL.self::$openLOC.'http://'.self::$siteName.Controller::gi()->controllerUrl('view', array($doc->url), true).self::$closeLOC.self::$closeURL;
        }
        $xml .= '</urlset>';
        return $xml;
    }
    
    public static function generateHTML()
    {
        $map = '<div class="container sitemap">'.self::$openUl . self::$openLi . '<a href="'.absoluteLink().'">Главная страница</a>' . self::$closeLi;
        
        foreach (Contr::disallowed(false, Contr::ONFRONTMODE) as $control)
        {
            if($control->control == Contr::MAP){ continue; }
            
            $map .= self::$openUl . self::$openLi . '<h3><a href="'.absoluteLink($control->url).'">'.$control->title.'</a></h3>' . self::$closeLi;
            
            if($control->control == Contr::FAQ or $control->control == Contr::REVIEW){
                $map .=  self::$closeUl;
                continue;
            }
            
            if($control->static == Contr::STATICAL){
                $model = ucfirst(Contr::PAGE);   
                $objects = $model::modelWhere('url = ?', array($control->url));
                $map .=  self::$closeUl;
                continue;
            }else{
                $model = ucfirst($control->control);
                if($control->control == Contr::CATALOG){
                    foreach($model::themeCats() as $category){
                        $map .= self::$openUl . self::$openLi . '<a href="'.absoluteLink($control->url).'/'.$category->url.'">'.$category->title.'</a>' . self::$closeLi;
                        if(count($category->childs)){
                            $map .=  self::$openUl;
                            foreach ($category->childs as $child){
                                $map .= self::$openLi . '<a href="'.absoluteLink($control->url).'/'.$child->url.'">'.$child->title.'</a>' . self::$closeLi;
                                $child->getCerts();
                                $map .=  self::$openUl;
                                foreach($child->docs as $doc){
                                    $map .= self::$openLi . '<a href="'.absoluteLink(Controller::gi()->controllerUrl('view', array($doc->url), true)).'">'.$doc->title.'</a>' . self::$closeLi;
                                }
                                $map .=  self::$closeUl;
                            }
                            $map .=  self::$closeUl;
                        }else{
                            $category->getCerts();
                            $map .=  self::$openUl;
                            foreach($category->docs as $doc){
                                $map .= self::$openLi . '<a href="'.absoluteLink(Controller::gi()->controllerUrl('view', array($doc->url), true)).'">'.$doc->title.'</a>' . self::$closeLi;
                            }
                            $map .=  self::$closeUl;
                        }
                        $map .=  self::$closeUl;
                    }
                    $theme = App::gi()->themeName;
                    $theme = $theme::withoutCategory();
                    if(count($theme)){
                        $map .=  self::$openUl;
                        foreach($theme as $otherDoc){
                            $map .= self::$openLi . '<a href="'.absoluteLink(Controller::gi()->controllerUrl('view', array($otherDoc->url), true)).'">'.$otherDoc->title.'</a>' . self::$closeLi;
                        }
                        $map .=  self::$closeUl;
                    }
                    $map .=  self::$closeUl;
                    continue;
                }else{
                    $objects = $model::models();
                }
            }
            $map .=  self::$openUl;
            foreach($objects as $object){
                $map .=  self::$openLi . '<a href="'.absoluteLink($control->url).'/'.$object->url.'">'.$object->title.'</a>' . self::$closeLi;
            }
            $map .= self::$closeUl . self::$closeUl;
        }
        
        $map .= self::$closeUl;

        return $map.'</div>';
    }
}