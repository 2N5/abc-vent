<?php
class BreadCrumb
{
    private $uri = array();
    private $links = array();
    private $themeRus = array(
//--------------------------------------------Theme------------------------------------------------------------
        'certificate'=>'Удостоверения',
        'knowladge'=>'Знания',
        'security'=>'Охрана',
        'spravka'=>'Справки',
        'check'=>'Чеки',
    );
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
        'sitemap'=>'Карта сайта',
        'faq'=>'Вопросы ответы',
        'category'=>'Категории',
        'review'=>'Отзывы',
        'page'=>'Страницы',
        'order'=>'Заказы',
        'city'=>'Города',
        'blog'=>'Блог',
    );

    public static function links()
    {
        $uri = App::gi()->uri;

        if($uri->controller === 'index' or $uri->controller === 'error'){
            return;
        }

        $breadCrumb = new self();
        return $breadCrumb->getCrumbs($uri);
    }

    private function getCrumbs(Registry $uri){
        $this->links[] = '<nav class="breadcrumb-wrap" aria-label="breadcrumb"><div class="container"><ul itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb">';

        switch($uri->controller){
            case Contr::CATALOG:
                if($uri->action !== 'index'){
                    $category = Category::modelWhere('url = ?', array($uri->id[0]));
                    $this->getNonPageLinks($category);
                }else{
                    $this->getPageLinks($uri);
                }
                break;
            case 'theme':
                if($uri->action !== 'index'){
                    $object = Theme::themeModel(0, 'url = ?', array($uri->id[0]));
                    $this->getNonPageLinks($object);
                }
                break;
            default:
                $this->getPageLinks($uri);
        }

        return implode(' ', $this->links).'</ul></div></nav>';
    }

    private function getNonPageLinks(ModelTable $catOrObj){
        $links = array();

        if($catOrObj instanceof Theme){
            $category = Category::model($catOrObj->id_category);
            if($category){
                $links = $this->catLinks($category);
            }
            $links[] = array('url'=>$catOrObj->url, 'title'=>$catOrObj->title);
        }else{
            $links = $this->catLinks($catOrObj);
        }

        $this->implodeLinks($links);
    }

    private function catLinks($category){
        $links = array();
        $parent = Category::model($category->id_parent);
        if($parent)
        {
            $links[] = array('url'=>$parent->url, 'title'=>$parent->title);
        }
        $links[] = array('url'=>$category->url, 'title'=>$category->title);
        return $links;
    }

    private function implodeLinks(array $links=array()){
        $count = count($links);

        $this->links[] = '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="/" title="Главная" itemprop="item"><span itemprop="name" aria-label="Главная">Главная</span><meta itemprop="position" content="1"></a></li>';
        $this->links[] = '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="/'.Contr::printUrl(Contr::CATALOG).'" title="Каталог" itemprop="item"><span itemprop="name">Каталог</span><meta itemprop="position" content="2"></a></li>';

        $i = 1;
        foreach($links as $link)
        {
            if($i == $count)
            {
                $this->links[] = '<li class="breadcrumb-item active">'.$link['title'].'</li>';
                break;
            }else{
                $this->links[] = '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="/'.Contr::printUrl(Contr::CATALOG).'/'.$link['url'].'" title="'.$link['title'].'" itemprop="item"><span itemprop="name">'.$link['title'].'</span><meta itemprop="position" content="3"></a></li>';
            }
            $i++;
        }
    }

    private function getPageLinks($uri)
    {
        $controller = $uri->controller;

        if($controller === 'index')
        {
            return false;
        }

        $action = $uri->action;
        $contr = Contr::modelWhere('control = ?', array($action));
        if($controller === 'page')
        {
            if(array_key_exists($contr->control, $this->rusController))
            {
                $this->links[] = '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="/" title="Главная" itemprop="item"><span itemprop="name" aria-label="Главная"><span class="fal fa-home"></span></span><meta itemprop="position" content="1"></a></li>';
                $this->links[] = '<li class="breadcrumb-item active">'.$this->rusController[$contr->control].'</li>';
            }else{
                return false;
            }

        }else{
            if(array_key_exists($controller, $this->rusController))
            {
                $this->links[] = '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="/" title="Главная" itemprop="item"><span itemprop="name" aria-label="Главная">Главная</span><meta itemprop="position" content="1"></a></li>';
                if($action !== 'index')
                {
                    $this->links[] = '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="/'.Contr::printUrl($controller).'" title="'.$this->rusController[$controller].'" itemprop="item"><span itemprop="name">'.$this->rusController[$controller].'</span><meta itemprop="position" content="3"></a></li>';
                    $this->links[] = '<li class="breadcrumb-item active">'.Controller::$lastCrumb.'</li>';
                }else{
                    $this->links[] = '<li class="breadcrumb-item active">'.$this->rusController[$controller].'</li>';
                }
            }else{
                return false;
            }
        }
    }
}