<div class="col-md-10">
	<a href="<?=$this->printControllerUrl(); ?>" class="btn btn-primary">К списку категорий</a><br>
	<h2>Введите название категории</h2><br>
	<form method="POST">
		Название: <input type="text" name="form[title]" required />
		URL: <input type="text" name="form[url]" />
		H1: <input type="text" name="form[h1]" />
		meta_title: <input type="text" name="form[meta_title]" />
		meta_keywords: <input type="text" name="form[meta_keywords]" />
		meta_description: <input type="text" name="form[meta_description]" />
		СЕО текст : <textarea id="editor" name="form[seo_text]"></textarea>
		<input type="submit" value="Добавить категорию" />
	</form>
</div>