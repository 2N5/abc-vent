<div class="col-md-10">
	<h2>Все справки</h2>
	<a href="<?=$this->printControllerUrl('create'); ?>" class="btn btn-primary">Добавить справку</a><br>
	<table class="table portfolio">
		<thead>
			<tr>
				<th>Название</th>
				<th>Категория</th>
				<th>Цена</th>
				<th>Картинка</th>
				<th>Редактировать</th>
				<th>Популярное</th>
				<th>Удалить</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($this->existObjects as $existObject){ ?>
			<td class="admin-name">
				<a href="<?=$this->printControllerUrl('edit'); ?>/<?=$existObject->id; ?>"><?=$existObject->title; ?></a>
			</td>
			<td class="admin-name">
				<?=$existObject->category; ?>
			</td>
			<td class="admin-name">
				<strong style="color: green; font-size: 120%;"><?=$existObject->price; ?></strong>
			</td>
			<td class="admin-name">
				<img src="<?=echoIMG($existObject->picture); ?>" style="width:75px;" >
			</td>
			<td class="admin-name">
				<a href="<?=$this->printControllerUrl('edit'); ?>/<?=$existObject->id; ?>">Редактриовать</a>
			</td>
			<td class="admin-name">
				<a href="<?=$this->printControllerUrl('popular'); ?>/<?=$existObject->id; ?>">
                                    <span style="color: <?=Popular::modelWhere('id_theme = ?', array($existObject->id)) ? 'red">Убрать' : 'green">Добавить'; ?></span>
                              </a>
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
