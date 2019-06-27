<div class="col-md-10">
	Редактирование полей формы удостоверения: <?=$certificate->title; ?>
	<h4>Поля "Имя" и "Телефон" являются обязательными, их невозможно отредактировать либо удалить</h4>
	<table class="table">
		<thead>
			<tr>
				<th>Тип</th>
				<th>Название</th>
				<th>Редактировать</th>
				<th>Удалить</th>
			</tr>
		</thead>
		<tbody>
			<form method="POST"> 
				<tr style="background-color: #3a4962;">
					<td>
						<select name="field[type]">
							<option selected value="0">Текстовое</option>
							<?php if(!Field::modelWhere('id_theme = ? AND type = ?', array($certificate->id, Field::FILE))){ ?>
								<option value="1">Файл</option>
								<?php } ?>
								<option value="2">Дата</option>
							</select>
						</td>
						<td>
							<input type="text" name="field[title]" />
						</td>
						<td>
							<input type="submit" value="Добавить поле" />
						</td>
					</tr> 
				</form>
				<tr>
					<td>
					</td>
					<td>
						<h3>Уже добавленные поля к форме данного удостоверения</h3>
					</td>
				</tr>
				<?php foreach ($fields as $field) { ?>
				<form method="POST" action="<?=$this->printControllerUrl('form', array($certificate->id, $field->id)); ?>"> 
					<tr>
						<td>
							<select name="field[type]">
								<?php switch($field->type){ 
									case Field::FILE : ?>
									<option value="0">Текстовое</option>
									<option selected value="1">Файл</option>
									<option value="2">Дата</option>
									<?php break; 
									case Field::DATE : ?>
									<option value="0">Текстовое</option>
									<option selected value="2">Дата</option>
									<?php break; 
									default : ?>
									<option selected value="0">Текстовое</option>
									<option value="2">Дата</option>
									<?php } ?>
								</select>
							</td>
							<td>
								<input type="text" name="field[title]" value="<?= $field->title; ?>"/>
							</td>
							<td>
								<input type="submit" value="Редактировать" />
							</td>
							<td>
								<a href="#" style="color: red;" onclick="event.preventDefault();
								if (confirm('Вы уверены, что хотите произвести удаление связи?')) {
									location.href ='<?= $this->printControllerUrl('deletefield', array($certificate->id, $field->id)); ?>';
								}"
								>Удалить</a>
							</td>
						</tr>
					</form>
					<?php } ?>
				</tbody>
			</table>
			<h3>Образец формы данного удостоверения</h3>
			<form action="#">
				Имя:
				<input type="text" name="form[name]" />
				Телефон:
				<input type="text" name="form[phone]" />
				<?php foreach ($fields as $fild){ ?>
				<?=$fild->title; ?>:
				<?php switch($fild->type)
				{
					case Field::FILE :
					$type = 'file';
					break;
					case Field::DATE :
					$type = 'date';
					break;
					default :
					$type = 'text';
				}
				?>
				<input type="<?=$type; ?>" name="form[<?=$fild->name; ?>]"/>
				<?php } ?>
				<input type="button" value="Кнопка"
			</form>
		</div>