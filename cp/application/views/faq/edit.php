<div class="col-md-10">
	<a href="<?= $this->printControllerUrl(); ?>" class="btn btn-primary">К списку вопросов ответов</a>

	<h2>Заполните все поля формы</h2><br>
	<form method="POST">
		Вопрос: <input type="text" name="form[question]" value="<?= $this->existSingleObject->question; ?>"/>
		Ответ: <input type="text" name="form[answer]" value="<?= $this->existSingleObject->answer; ?>"/>
		<input type="submit" value="Сохранить изменения" />
	</form>
</div>