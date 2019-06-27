<div class="col-md-10">
    <table class="table portfolio">
        <h3>Добавочные конструкции</h3>
        $skidki;
        $osobue_usloviya;
        <br>
        <h4>
        Купить <strong>Удостоверение сварщика</strong> Как. Цена <strong>1900 руб.</strong> Телефон <strong> +7 960 645 32 43</strong> Доставка Оплата. Приватность.
        </h4>
        <!--<a class="btn btn-success" href="<?=$this->printControllerUrl('index', array(1)); ?>">Сгенерировать пример</a>-->
        <?php if(isset($additionals['example'])){ ?>
        <br>
        <h4>
            <?=$additionals['example']; ?>
        </h4>
        <?php } ?>
        <thead>
            <?php foreach (AdditionalHelper::$russian as $r){ ?>
                <th><?=$r; ?></th>
            <?php } ?>
        </thead>
        <tbody>
            <tr style="background-color: #bbbbbb;">
            <?php foreach(AdditionalHelper::$russian as $n=>$r){ ?>
                <form action="<?=$this->printControllerUrl('create', array($n)); ?>" method="POST" >
                    <td class="admin-name" >
                        <input type="text" name="form[title]" />
                        <input type="submit" value="Добавить" />
                    </td>
                </form>
            <?php } ?>
            </tr>
            <?php for($i=0; $i<$additionals['max']; $i++){ ?>
                <tr>
                <?php foreach(AdditionalHelper::$type as $n=>$t){ 
                    if(isset($additionals[$t][$i])){ ?>
                    <form action="<?=$this->printControllerUrl('edit', array($n, $additionals[$t][$i]->id)); ?>" method="POST" >
                        <td class="admin-name" >
                            <input type="text" name="form[title]" value="<?=$additionals[$t][$i]->title; ?>" />
                            <input type="submit" value="Сохранить" />
                        </td>
                    </form>
                    <?php } else { ?>
                        <td class="admin-name" >
                        </td>
                    <?php }
                    } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
