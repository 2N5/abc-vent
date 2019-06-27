<div class="col-md-10">
	<a href="<?=$this->printControllerUrl('create'); ?>" class="btn btn-primary">Добавить статью</a>
	<a href="<?=$this->printControllerUrl('page'); ?>" class="btn btn-primary">Страница блога</a><br>
	<h3>Все статьи</h3>
	<table class="table portfolio">
		<thead>
			<tr>
				<th>Название</th>
				<th>URL</th>
				<th>Изображение</th>
				<th>Редактировать</th>
				<th>Удалить</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($this->existObjects as $existObject){ ?>
			<tr class="counted-element sortitem sortcat-<?=$existObject->id_portfolio_category; ?>">
				<td class="admin-name">
					<?=$existObject->title; ?>
				</td>
				<td class="admin-name">
					<?=$existObject->url; ?>
				</td>
				<td class="admin-name">
					<img src="<?= echoIMG($existObject->picture); ?>" style="width:75px;" >
				</td>
				<td class="admin-name">
					<a href="<?=$this->printControllerUrl('edit'); ?>/<?=$existObject->id; ?>">Редактриовать</a>
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
		<?php // }else{ echo 'Пока что не добавленно ни одной категории для порфолио'; } ?>
	</div>