<div class="col-md-10">
    <h3>Карта сайта.</h3>
    <h3>Можно отключить отображение не желательных опций в настройках <a href="/cp/configurate/common">отображения контроллеров</a></h3>
	<p>Обратите внимание, тематические страницы отключить нельзя</p>
	<table class="table portfolio">
		<thead>
			<th>Тема</th>
			<th>Контроллер</th>
			<th>Отображение</th>
		</thead>
		<tbody>
			<?php foreach($map as $controller){ if($controller->control == SiteMap::URL) continue; ?>
				<td class="admin-name" >
					<?=$controller->title; ?>
				</td>
				<td class="admin-name" >
					<?=$controller->control; ?>
				</td>
				<td class="admin-name">
                                    <span style="color: <?=$controller->on_front ? 'green">Включен' : 'red">Выключен'; ?></span>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>