<div class="col-md-10">
	<a href="<?=$this->printControllerUrl(); ?>" class="btn btn-primary">На первую страницу</a><br>
	<h2>Заполните все поля формы</h2><br>
	<form method="POST">
		Вопрос: <input type="text" name="form[question]" />
		Ответ: <input type="text" name="form[answer]" />
		<input type="submit" value="Отправить запрос" />
	</form>

	Все посты вопрос-ответ<br>
	<table class="table portfolio">
		<thead>
			<tr>
				<th>Вопрос</th>
				<th>Ответ</th>
				<th>Редактировать</th>
				<th>Удалить</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($this->existObjects as $existObject){ ?>
			<td class="admin-name">
				<?=$existObject->question; ?>
			</td>
			<td class="admin-name">
				<?=$existObject->answer; ?>
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