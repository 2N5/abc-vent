<?php 
    $app = App::gi();
    $controller = $app->uri->controller;
?>
<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-5 pull-left">
                <!-- Logo -->
                <div class="logo">
                    <?php if($app->theme){ ?>
                        <h1><a href="/cp/<?=$app->theme->control; ?>" target="blank"><?=$app->theme->title; ?></a></h1>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-5 pull-right">
                <div class="navbar navbar-inverse" role="banner">
                    <nav class="navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                        <ul class="nav navbar-nav">
                            <?php if ($app->user){ ?>
                                <li><a href="/cp/authorize/logout">Logout</a></li>                            
                            <?php }else{ ?>
                                <li><a href="/cp/authorize/login">Login</a></li>                            
                            <?php } ?>
                                <li><a href="/cp/configurate/common">
                                    <i class="glyphicon glyphicon-cog"></i>
                                </a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-content <?=($controller == 'authorize') ? 'container' : ''; ?>">
    <div class="row">
        <?php if($app->theme){ 
            if($controller != 'authorize'){ ?>
        <div class="col-md-2">
            <div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <li class="<?=($controller == $app->theme->control) ? 'current' : ''; ?>"><a href="/cp/<?=$app->theme->control; ?>"><i class="glyphicon glyphicon-list"></i><?=$app->theme->title; ?></a></li>
                    <?php foreach($app->nonStatical as $page){ ?>
                        <li class="<?=($controller == $page->control) ? 'current' : ''; ?>"><a href="/cp/<?=$page->control; ?>"><i class="glyphicon glyphicon-list"></i><?=$page->title; ?></a></li>
                    <?php } ?>
					<li class="<?=($controller == 'shortcut') ? 'current' : ''; ?>"><a href="/cp/shortcut"><i class="glyphicon glyphicon-list"></i>Шорткаты</a></li>
                    <li class="<?=($controller == 'display') ? 'current' : ''; ?>"><a href="/cp/display"><i class="glyphicon glyphicon-list"></i>Отображение в меню</a></li>
                    <li class="<?=($controller == 'picture') ? 'current' : ''; ?>"><a href="/cp/picture"><i class="glyphicon glyphicon-list"></i>Картинки для контента</a></li>
                    <li class="<?=($controller == 'additional') ? 'current' : ''; ?>"><a href="/cp/additional"><i class="glyphicon glyphicon-list"></i>Для меты</a></li>
                </ul>
            </div>
        </div>
        <?php 
            }
        } ?>
        
    <?php 
        if($app->uri->controller !== 'index' and $app->uri->controller !== '/')
        {
            echo '<div class="col-md-10">';
                echo '<div xmlns:v="http://rdf.data-vocabulary.org/"  class="breadcrumb-container">';
                    echo BreadCrumb::links();
                echo '</div>';
            echo '</div>';
        }
        echo $content;
    ?>
    </div>
</div>
<?php if ($controller != 'authorize'){ ?>
<footer>
    <div class="container">
        <div class="copy text-center">
            Copyright <?=date('Y', time()); ?>
        </div>
    </div>
</footer>
<?php } ?>