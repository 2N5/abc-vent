<div class="col-md-10">
	<a href="<?=$this->printControllerUrl('page'); ?>" class="btn btn-primary">Страница отзывов</a><br>
	<?php if(count($this->onReviewObjects)){ ?>
	<h3 style="color: red">Все не подтвержденные отзывы</h3>
	<table class="table portfolio">
		<thead>
			<tr>
				<th>Имя</th>
				<th>Текст</th>
				<th>Подтверждение</th>
				<th>Редактировать</th>
				<th>Удалить</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($this->onReviewObjects as $reviewObject){ ?>
			<td class="admin-name">
				<?=$reviewObject->name; ?>
			</td>
			<td class="admin-name">
				<?=$reviewObject->text; ?>
			</td>
			<td class="admin-name">
				<a href="<?=$this->printControllerUrl('confirm'); ?>/<?=$reviewObject->id; ?>">Утвердить</a>
			</td>
			<td class="admin-name">
				<a href="<?=$this->printControllerUrl('edit'); ?>/<?=$reviewObject->id; ?>">Редактриовать</a>
			</td>
			<td class="admin-name">
				<a href="<?=$this->printControllerUrl('delete'); ?>/<?=$reviewObject->id; ?>"
					onclick="event.preventDefault(); if (confirm('Вы уверены, что хотите произвести удаление?')){ 
						location.href = '<?=$this->printControllerUrl('delete'); ?>/<?=$reviewObject->id; ?>';
					}">Удалить</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<?php } ?>
	<hr>
	<?php if(count($this->confirmObjects)){ ?>
	<h3 style="color: green">Все подтвержденные отзывы</h3>
	<table class="table portfolio">
		<thead>
			<tr>
				<th>Имя</th>
				<th>Текст</th>
				<th>Редактировать</th>
				<th>Удалить</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($this->confirmObjects as $confirmObject){ ?>
			<td class="admin-name">
				<?=$confirmObject->name; ?>
			</td>
			<td class="admin-name">
				<?=$confirmObject->text; ?>
			</td>
			<td class="admin-name">
				<a href="<?=$this->printControllerUrl('edit'); ?>/<?=$confirmObject->id; ?>">Редактриовать</a>
			</td>
			<td class="admin-name">
				<a href="<?=$this->printControllerUrl('delete'); ?>/<?=$confirmObject->id; ?>"
					onclick="event.preventDefault(); if (confirm('Вы уверены, что хотите произвести удаление?')){ 
						location.href = '<?=$this->printControllerUrl('delete'); ?>/<?=$confirmObject->id; ?>';
					}">Удалить</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<?php } ?>
</div>