<div class="col-md-10">
	<h3>Все города</h3><br>
	<a href="<?=$this->printControllerUrl('create'); ?>" class="btn btn-primary">Добавить город</a>
	<a href="<?=$this->printControllerUrl('page'); ?>" class="btn btn-primary">Страница город</a><br>
	<table class="table portfolio">
		<thead>
			<tr>
				<th>Название</th>
				<th>H1</th>
				<th>URL</th>
				<th>Изображение</th>
				<th>Редактировать</th>
				<th>Удалить</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($this->existObjects as $existObject) { ?>
			<tr class="counted-element sortitem sortcat-<?= $existObject->id_portfolio_category; ?>">
				<td class="admin-name">
					<a href="<?= $this->printControllerUrl('edit'); ?>/<?= $existObject->id; ?>"><?= $existObject->title; ?></a>
				</td>
				<td class="admin-name">
					<?= $existObject->h1; ?>
				</td>
				<td class="admin-name">
					<?= $existObject->url; ?>
				</td>
				<td class="admin-name">
					<img src="<?=echoIMG($existObject->picture); ?>" style="width:75px;" >
				</td>
				<td class="admin-name">
					<a href="<?= $this->printControllerUrl('edit'); ?>/<?= $existObject->id; ?>">Редактриовать</a>
				</td>
				<td class="admin-name">
					<a href="<?=$this->printControllerUrl('delete'); ?>/<?=$existObject->id; ?>"
						onclick="event.preventDefault(); if (confirm('Вы уверены, что хотите произвести удаление?')){ 
							location.href = '<?=$this->printControllerUrl('delete'); ?>/<?=$existObject->id; ?>';
						}">Удалить</a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>