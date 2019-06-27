<div class="col-md-10">
    <h3>Настройка отображения страниц в меню, можно выбрать один из трех вариантов:<br> 1)Только шапка; 2)Только футер; 3)Шапка и футер</h3>
	<table class="table portfolio">
		<thead>
			<th>Тема</th>
			<th>Контроллер</th>
			<th>Отображение</th>
		</thead>
		<tbody>
			<?php foreach($pages as $controller){ ?>
				<td class="admin-name" >
					<?=$controller->title; ?>
				</td>
				<td class="admin-name" >
					<?=$controller->control; ?>
				</td>
				<td class="admin-name">
                                    <form action="<?=$this->printControllerUrl('displaymode', array($controller->id)); ?>" method="POST" >
                                        <select name="mode">
                                            <option value="<?=Contr::DISHEAD; ?>" <?=$controller->display_mode == Contr::DISHEAD ? 'selected' : ''; ?> >Только в шапке</option>
                                            <option value="<?=Contr::DISFOOTER; ?>" <?=$controller->display_mode == Contr::DISFOOTER ? 'selected' : ''; ?> >Только в футере</option>
                                            <option value="<?=Contr::DISBOTH; ?>" <?=$controller->display_mode == Contr::DISBOTH ? 'selected' : ''; ?> >И шапка и футер</option>
                                        </select>
                                        <input type="submit" value="Изменить" />
                                    </form>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>