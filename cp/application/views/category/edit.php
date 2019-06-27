<div class="col-md-10">
	<a href="<?= $this->printControllerUrl(); ?>" class="btn btn-primary">К списку категорий</a>     
	<h2>Редактирование: <?= $this->existSingleObject->title; ?></h2><br>

	<form method="POST">
		Родительская категория
		<select name="form[id_parent]">
			<option disabled selected value="">Выберите родительскую категорию</option>
			<?php foreach($this->categories as $category){ ?>
			<option <?=($category->id === $this->existSingleObject->id_parent) ? 'selected' : '';?>
				value="<?=$category->id; ?>"><?=$category->title; ?></option>
				<?php } ?>
			</select>
			Название: <input type="text" name="form[title]" value="<?= $this->existSingleObject->title; ?>" required />
			URL: <input type="text" name="form[url]" value="<?= $this->existSingleObject->url; ?>" />
			H1: <input type="text" name="form[h1]" value="<?= $this->existSingleObject->h1; ?>" />
			meta_title: <input type="text" name="form[meta_title]" value="<?= $this->existSingleObject->meta_title; ?>" />
			meta_keywords: <input type="text" name="form[meta_keywords]" value="<?= $this->existSingleObject->meta_keywords; ?>" />
			meta_description: <input type="text" name="form[meta_description]" value="<?= $this->existSingleObject->meta_description; ?>" />
			СЕО текст : <textarea id="editor" name="form[seo_text]"><?= $this->existSingleObject->seo_text; ?></textarea>
			<input type="submit" value="Сохранить изменения" />
		</form>
	</div>
	