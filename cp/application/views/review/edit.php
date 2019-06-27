<div class="col-md-10">
	<a href="<?= $this->printControllerUrl(); ?>" class="btn btn-primary">К списку отзывов</a>

	<h2>Заполните все поля формы</h2><br>
	<form method="POST">
		Имя: <input type="text" name="form[name]" value="<?= $this->existSingleObject->name; ?>"/>
		Время добавления: <input type="date" name="date" value="<?=date('Y-m-d', $this->existSingleObject->time); ?>" />
		Текст: <input type="text" name="form[text]" value="<?= $this->existSingleObject->text; ?>"/>
		<input type="submit" value="Сохранить изменения" />
	</form>
</div>