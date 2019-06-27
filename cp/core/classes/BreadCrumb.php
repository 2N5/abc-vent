<?php
class BreadCrumb
{
    private $links = array();
    private $rusController = array(
//--------------------------------------------Theme------------------------------------------------------------        
                                    'certificate'=>'Удостоверения',
                                    'knowladge'=>'Знания',
                                    'security'=>'Охрана',
                                    'spravka'=>'Справки',
                                    'check'=>'Чеки',
//--------------------------------------------Pages------------------------------------------------------------        
                                    'privacy'=>'Политика конфиденциальности',
                                    'callback'=>'Обратная связь',
                                    'delivery'=>'Доставка',
                                    'contact'=>'Контакты',
                                    'about'=>'О нас',
                                    'price'=>'Цены',
//--------------------------------------------Controlls------------------------------------------------------------        
                                    'comment'=>'Комментарии',
                                    'sitemap'=>'Карта сайта',
                                    'faq'=>'Вопросы ответы',
                                    'category'=>'Категории',
                                    'review'=>'Отзывы',
                                    'page'=>'Страницы',
                                    'order'=>'Заказы',
                                    'city'=>'Города',
                                    'blog'=>'Блог',
    );
    
    private function getLinks()
    {
        $uri = App::gi()->uri;
        
        $controller = $uri->controller;
        
        if($controller === 'index')
        {
            return false;
        }
        
        if(array_key_exists($controller, $this->rusController))
        {
            $this->links[] = '<span typeof="v:Breadcrumb"><a href="/cp/" rel="v:url" property="v:title">Главная</a></span>';
            $this->links[] = '->';
            if($uri->action !== 'index')
            {
                $this->links[] = '<span typeof="v:Breadcrumb"><a href="/cp/'.$controller.'" rel="v:url" property="v:title">'.$this->rusController[$controller].'</a></span>';
                $this->links[] = '->';
                if($uri->action === 'picture' or $uri->action === 'form'){
                    $model = ucfirst($controller);
                    $obj = $model::model($uri->id[0]);
                    $this->links[] = '<span typeof="v:Breadcrumb"><a href="/cp/'.$controller.'/edit/'.$uri->id[0].'" rel="v:url" property="v:title">Редактирование '.$obj->title.'</a></span>';
                    $this->links[] = '->';
                }
                $this->links[] = '<span>'.Controller::$lastCrumb.'</span>';
            }else{
                $this->links[] = '<span>'.$this->rusController[$controller].'</span>';                
            }
        }else{
            return false;
        }
        return implode(' ', $this->links);
    }
    
    public static function links()
    {
        $breadCrumb = new self();
        return $breadCrumb->getLinks();
    }
}