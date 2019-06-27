<div class="col-md-10">
	<a href="<?= $this->printControllerUrl(); ?>" class="btn btn-primary">К списку городов</a><br>
	<h2>Добавление нового города</h2><br>
	<form method="POST">
		Название: <input type="text" name="form[title]" />
		H1: <input type="text" name="form[h1]" />
		URL: <input type="text" name="form[url]" />
		Контент : <textarea id="editor" name="form[content]"></textarea>
		Сео_текст : <textarea id="editor1" name="form[seo_text]"></textarea>
		meta_title: <input type="text" name="form[meta_title]" />
		meta_keywords: <input type="text" name="form[meta_keywords]" />
		meta_description: <input type="text" name="form[meta_description]" />
		<input type="submit" value="Добавить город" />
	</form>
</div>