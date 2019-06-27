<div class="col-md-10">
    <?php $theme = App::gi()->theme; if((time() - $theme->time) < 300){ ?>
        <p>Вы недавно настроили тематику сайта "<?=$theme->title; ?>"</p>
        <p>По умолчанию все опции включены, отключите те которые не нужны на сайте</p>
        <p>Позже можно будет изменить в пункте меню "Настройки"</p>
    <?php } ?>
        <h3>Страницы и разделы сайта.</h3>
        <h3>Если страница активна, то она будет отображена в карте сайта.</h3>
    <table class="table portfolio">
        <thead>
            <th>Контроллер</th>
            <th>URL</th>
            <th>Общий статус</th>
            <th>На фронте</th>
        </thead>
        <tbody>
            <tr>
                <td class="admin-name" >
                    <?=$theme->title; ?>
                </td>
                <td class="admin-name" >
                    <form action="<?=$this->printControllerUrl('url', array($theme->id)); ?>" method="POST" >
                        <input type="text" name="form[url]" value="<?=$theme->url; ?>" />
                        <input type="submit" value="Изменить" />
                    </form>
                </td>
                
                <td class="admin-name">
                </td>
                
                <td class="admin-name">
                    <a href="<?=$this->printControllerUrl('switch', array(Contr::ONFRONTMODE, $theme->id));?>">
                        <span style="color: <?=$theme->on_front ? 'green">Включен' : 'red">Выключен'; ?></span>
                    </a>
                </td>
            </tr>
            <?php foreach($commons as $controller){ ?>
            <tr>
                <td class="admin-name" >
                    <?=$controller->title; ?>
                </td>
                <td class="admin-name" >
                    <form action="<?=$this->printControllerUrl('url', array($controller->id)); ?>" method="POST" >
                        <input type="text" name="form[url]" value="<?=$controller->url; ?>" />
                        <input type="submit" value="Изменить" />
                    </form>
                </td>
                <td class="admin-name">
                    <a href="<?=$this->printControllerUrl('switch', array(Contr::ACTIVEMODE, $controller->id));?>">
                        <span style="color: <?=$controller->active ? 'green">Включен' : 'red">Выключен'; ?></span>
                    </a>
                </td>
                <td class="admin-name">
                    <a href="<?=$this->printControllerUrl('switch', array(Contr::ONFRONTMODE, $controller->id));?>">
                        <span style="color: <?=$controller->on_front ? 'green">Включен' : 'red">Выключен'; ?></span>
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
