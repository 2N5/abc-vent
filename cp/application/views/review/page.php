<div class="col-md-10">
	<a href="<?= $this->printControllerUrl(); ?>" class="btn btn-primary">К списку отзывов</a>     
	<h2>Заполните все поля формы</h2><br>
	<form method="POST">
            Название: <input type="text" name="form[title]" value="<?= $this->existSingleObject->title; ?>" />
            H1: <input type="text" name="form[h1]" value="<?= $this->existSingleObject->h1; ?>" />
            
            meta_title: <input type="text" name="form[meta_title]" value="<?= $this->existSingleObject->meta_title; ?>" />
            meta_keywords: <input type="text" name="form[meta_keywords]" value="<?= $this->existSingleObject->meta_keywords; ?>" />
            meta_description: <input type="text" name="form[meta_description]" value="<?= $this->existSingleObject->meta_description; ?>" />

            СЕО текст : <textarea id="editor" name="form[seo_text]"><?= $this->existSingleObject->seo_text; ?></textarea>
            Контент : <textarea id="editor1" name="form[content]"><?= $this->existSingleObject->content; ?></textarea>

            <input type="submit" value="Сохранить изменения" />
	</form>
</div>