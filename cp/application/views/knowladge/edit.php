<div class="col-md-10">
	<a href="<?= $this->printControllerUrl(); ?>" class="btn btn-primary">К списку дипломов</a>     
	<h2>Редактирование: <?= $this->existSingleObject->title; ?></h2><br>

	<div class="img-holder">
        <img src="<?=echoIMG($this->existSingleObject->picture); ?>" style="height:100px;" >
        <!--<br>-->
        <a style="margin: 0 20px;" href="<?= $this->printControllerUrl('picture'); ?>/<?= $this->existSingleObject->id; ?>" class="btn btn-primary">Редактировать картинку</a>
        <a style="margin: 0 20px;" href="<?= $this->printControllerUrl('form'); ?>/<?= $this->existSingleObject->id; ?>" class="btn btn-primary">Поля формы</a>
        <br>
    </div>

	<form method="POST">
		Категория удостоверения
		<select name="form[id_category]">
			<option value="" disabled selected>Выберите категорию</option>
			<?php foreach($this->categories as $category){ ?>
			<option <?=($this->existSingleObject->id_category === $category->id) ? 'selected' : ''; ?> 
				value="<?=$category->id; ?>"><?=$category->title; ?></option>
				<?php } ?>
			</select>
			meta_title: <input type="text" name="form[meta_title]" value="<?= $this->existSingleObject->meta_title; ?>" />
			meta_keywords: <input type="text" name="form[meta_keywords]" value="<?= $this->existSingleObject->meta_keywords; ?>" />
			meta_description: <input type="text" name="form[meta_description]" value="<?= $this->existSingleObject->meta_description; ?>" />
			Название: <input type="text" name="form[title]" value="<?= $this->existSingleObject->title; ?>" />
			URL: <input type="text" name="form[url]" value="<?= $this->existSingleObject->url; ?>" />
			Цена: <input type="text" name="form[price]" value="<?= $this->existSingleObject->price; ?>" />
			Контент : <textarea id="editor" name="form[content]"><?= $this->existSingleObject->content; ?></textarea>
			Описание: <textarea id="editor1" name="form[description]"><?= $this->existSingleObject->description; ?></textarea>
			<input type="submit" value="Сохранить изменения" />
		</form>
	</div>