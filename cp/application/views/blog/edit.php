<div class="col-md-10">
	<a href="<?= $this->printControllerUrl(); ?>" class="btn btn-primary">К списку статей</a>
	<h2>Заполните все поля формы</h2><br>
	<form method="POST" enctype="multipart/form-data">
		Название: <input type="text" name="form[title]" value="<?= $this->existSingleObject->title; ?>" />
		Url: <input type="text" name="form[url]" value="<?= $this->existSingleObject->url; ?>" />
		Время добавления: <input type="date" name="date" value="<?= date('Y-m-d', $this->existSingleObject->time); ?>" />
		Краткое описание : <textarea id="editor1" name="form[description]"><?= $this->existSingleObject->description; ?></textarea>
		Контент : <textarea id="editor" name="form[content]"><?= $this->existSingleObject->content; ?></textarea>
		meta_title: <input type="text" name="form[meta_title]" value="<?= $this->existSingleObject->meta_title; ?>" />
		meta_keywords: <input type="text" name="form[meta_keywords]" value="<?= $this->existSingleObject->meta_keywords; ?>" />
		meta_description: <input type="text" name="form[meta_description]" value="<?= $this->existSingleObject->meta_description; ?>" />

		<img src="<?= echoIMG($this->existSingleObject->picture); ?>" style="width:75px;" >
		<input class="btn" type="file" name="picture" value="Изменить изображение" />
		<input type="submit" value="Сохранить изменения" />
	</form>
</div>
