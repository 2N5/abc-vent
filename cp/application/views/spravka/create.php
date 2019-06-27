<div class="col-md-10">
	<a href="<?=$this->printControllerUrl(); ?>" class="btn btn-primary">К списку справок</a><br>
	<h2>Заполните все поля формы</h2><br>
	<form method="POST">
		Название: <input type="text" name="form[title]" />
		Цена: <input type="text" name="form[price]" />
		H1 : <input type="text" name="form[h1]"></input>
		Саб_тайтл : <input type="text" name="form[sub_title]"></input>
		Контент : <textarea id="editor" name="form[content]"></textarea>
		Описание : <textarea id="editor1" name="form[description]"></textarea>
		meta_title: <input type="text" name="form[meta_title]" />
		meta_keywords: <input type="text" name="form[meta_keywords]" />
		meta_description: <input type="text" name="form[meta_description]" />
		<input type="submit" value="Добавить справку" />
	</form>
</div>