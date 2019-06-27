<?php
class SiteMap
{
    const URL = 'sitemap';
    
    private static $siteName = '';
    private static $certLocation = 'certificate/view/';
    private static $articleLocation = 'page/article/';
    private static $openURL = "<url>\r\n";
    private static $openLOC = "<loc>";
    private static $closeURL = "</url>\r\n";
    private static $closeLOC = "</loc>\r\n";
    
    public static function generateXML()
    {
        self::$siteName = $_SERVER['SERVER_NAME'].'/';
        $staticPages = Page::pages();
        $certificates = Certificate::models();
        $articles = Article::models();
        
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\r\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\r\n";
        
        $xml .= self::$openURL.self::$openLOC.'http://'.self::$siteName.self::$closeLOC.self::$closeURL;
        
        foreach ($staticPages as $page)
        {
            $xml .= self::$openURL.self::$openLOC.'http://'.self::$siteName.$page->url.'/'.self::$closeLOC.self::$closeURL;
        }
        
        foreach ($certificates as $cert)
        {
            $xml .= self::$openURL.self::$openLOC.'http://'.self::$siteName.self::$certLocation.$cert->url.'/'.self::$closeLOC.self::$closeURL;
        }
        
        foreach ($articles as $article)
        {
            $xml .= self::$openURL.self::$openLOC.'http://'.self::$siteName.self::$articleLocation.$article->url.'/'.self::$closeLOC.self::$closeURL;
        }
        
        $xml .= '</urlset>';
        return $xml;
    }
}