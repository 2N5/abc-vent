<div class="col-md-10">
	<a href="<?= $this->printControllerUrl(); ?>" class="btn btn-primary">К списку городов</a>     
	<h2>Редактирование города: <?= $this->existSingleObject->title; ?></h2><br>
	<div class="img-holder">
		<img src="<?=echoIMG($this->existSingleObject->picture); ?>" style="height:100px;" >
		<!--<br>-->
		<a style="margin: 15px;" href="<?= $this->printControllerUrl('picture'); ?>/<?= $this->existSingleObject->id; ?>" class="btn btn-primary">Редактировать картинку</a>
		<br>
	</div>

	<form method="POST">
		Название: <input type="text" name="form[title]" value="<?= $this->existSingleObject->title; ?>" />
		H1: <input type="text" name="form[h1]" value="<?= $this->existSingleObject->h1; ?>" />
		Url: <input type="text" name="form[url]" value="<?= $this->existSingleObject->url; ?>" />
		Контент : <textarea id="editor" name="form[content]"><?= $this->existSingleObject->content; ?></textarea>
		Сео_текст : <textarea id="editor1" name="form[seo_text]"><?= $this->existSingleObject->seo_text; ?></textarea>
		meta_title: <input type="text" name="form[meta_title]" value="<?= $this->existSingleObject->meta_title; ?>" />
		meta_keywords: <input type="text" name="form[meta_keywords]" value="<?= $this->existSingleObject->meta_keywords; ?>" />
		meta_description: <input type="text" name="form[meta_description]" value="<?= $this->existSingleObject->meta_description; ?>" />
		<input type="submit" value="Сохранить изменения" />
	</form>
</div>