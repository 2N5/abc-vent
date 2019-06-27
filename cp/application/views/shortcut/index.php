<div class="col-md-10">
        <h3>Тут отображены все шорткаты которые могут применяться на сайте. Для шортката [site] нельзя изменить значение.</h3>
        <h3>Если вы отключите преобразование шортката то он будет выводится в изначальном виде например: [site] не будет приобразовано в <?=$_SERVER['SERVER_NAME']; ?>.</h3>
    <table class="table portfolio">
        <thead>
            <th>Метка шортката</th>
            <th>Подставляемое значение</th>
            <th>Сохранить изменения</th>
            <th>Отключить преобразование</th>
        </thead>
        <tbody>
            <tr style="background-color: #bbbbbb;">
				<form action="<?=$this->printControllerUrl('create'); ?>" method="POST" >
					<td class="admin-name" >
						<input type="text" name="form[title]" />
					</td>
					<td class="admin-name" >
						<input type="text" name="form[value]" />
					</td>
					<td class="admin-name">
						<input type="submit" value="Добавить шорткат" />
					</td>
				</form>
                <td class="admin-name">
                </td>
            </tr>
            <?php foreach($shortcuts as $shortcut){ ?>
            <tr>
				<form action="<?=$this->printControllerUrl('edit', array($shortcut->id)); ?>" method="POST" >
					<td class="admin-name" >
						<input type="text" name="form[title]" value="<?=$shortcut->title; ?>" />
					</td>
					<td class="admin-name" >
						<input type="text" name="form[value]" value="<?=$shortcut->value; ?>" />
					</td>
					<td class="admin-name">
						<input type="submit" value="Сохранить" />
					</td>
				</form>
                <td class="admin-name">
                    <a href="<?=$this->printControllerUrl('switch', array($shortcut->id));?>">
                        <span style="color: <?=$shortcut->converting ? 'green">Включено' : 'red">Выключено'; ?></span>
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
