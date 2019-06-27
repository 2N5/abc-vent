<div class="col-md-10">
	<a href="<?=$this->printControllerUrl(); ?>" class="btn btn-primary">К списку удостоверений</a><br>
	<h2>Заполните все поля формы</h2>
	<form method="POST">
		Название: <input type="text" name="form[title]" />
		Цена: <input type="text" name="form[price]" />
		Описание : <textarea id="editor" name="form[description]"></textarea>
		meta_title: <input type="text" name="form[meta_title]" />
		meta_keywords: <input type="text" name="form[meta_keywords]" />
		meta_description: <input type="text" name="form[meta_description]" />
		<input type="submit" value="Добавить удостоверение" />
	</form>
</div>