<div class="col-md-10">
	<a href="<?=$this->printControllerUrl('page'); ?>" class="btn btn-primary">Страница вопрос-ответ</a><br>
	<?php if(count($this->onReviewObjects)){ ?>
	<h3 style="color: red">Все не подтвержденные вопросы</h3>
	<table class="table portfolio">
		<thead>
			<tr>
				<th>Имя</th>
				<th>Вопрос</th>
				<th>Ответ</th>
				<th>Подтверждение</th>
				<th>Редактировать</th>
				<th>Удалить</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($this->onReviewObjects as $faqObject){ ?>
			<td class="admin-name">
				<?=$faqObject->name; ?>
			</td>
			<td class="admin-name">
				<?=$faqObject->question; ?>
			</td>
			<td class="admin-name">
				<?=$faqObject->answer; ?>
			</td>
			<td class="admin-name">
				<a href="<?=$this->printControllerUrl('confirm'); ?>/<?=$faqObject->id; ?>">Утвердить</a>
			</td>
			<td class="admin-name">
				<a href="<?=$this->printControllerUrl('edit'); ?>/<?=$faqObject->id; ?>">Редактриовать</a>
			</td>
			<td class="admin-name">
				<a href="<?=$this->printControllerUrl('delete'); ?>/<?=$faqObject->id; ?>"
					onclick="event.preventDefault(); if (confirm('Вы уверены, что хотите произвести удаление?')){ 
						location.href = '<?=$this->printControllerUrl('delete'); ?>/<?=$faqObject->id; ?>';
					}">Удалить</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<?php } ?>
	<hr>
	<?php if(count($this->confirmObjects)){ ?>
	<h3 style="color: green">Все подтвержденные вопросы</h3>
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
			<?php foreach($this->confirmObjects as $confirmObject){ ?>
			<td class="admin-name">
				<?=$confirmObject->question; ?>
			</td>
			<td class="admin-name">
				<?=$confirmObject->answer; ?>
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