<div class="col-md-10">
	<a href="<?=$this->printControllerUrl(); ?>" class="btn btn-primary">К списку статей</a><br>
	<h2>Заполните все поля формы</h2><br>
	<form method="POST" enctype="multipart/form-data">
		Название: <input type="text" name="form[title]" />
		URL: <input type="text" name="form[url]" />
		Время добавления: (Если не заполнять это поле то будет установлена сегодняшняя дата) <input type="date" name="date" />
		Краткое описание : <textarea id="editor1" name="form[description]"></textarea>
		Контент : <textarea id="editor" name="form[content]"></textarea>
		meta_title: <input type="text" name="form[meta_title]" />
		meta_keywords: <input type="text" name="form[meta_keywords]" />
		meta_description: <input type="text" name="form[meta_description]" />
		<input class="btn" type="file" name="picture" value="Добавить изображение" />
		<input type="submit" value="Добавить статью" />
	</form>

	Все статьи<br>
	<table class="table portfolio">
		<thead>
			<tr>
				<th>Название</th>
				<th>URL</th>
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
	</div>
