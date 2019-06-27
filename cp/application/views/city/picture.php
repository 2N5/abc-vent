<div class="col-md-10">
	<h3>Операции с картинками для ( <?= $this->existSingleObject->title; ?> )</h3>
	<form action="" method="POST" enctype="multipart/form-data">
		<?php if ($picture) {
			?>
			<a href="/#" class="btn alert-danger" style="position: absolute;top: 10px;right: 15px;"
			onclick="event.preventDefault(); if (confirm('Вы уверены, что хотите произвести удаление?')) {
				location.href = '<?= $this->printControllerUrl('picturedelete', array($this->existSingleObject->id, $picture->id)); ?>';
			}">Удалить</a>
			ALT: <input type="text" name="form[alt]" value="<?= $picture->alt; ?>" />
			TITLE: <input type="text" name="form[title]" value="<?= $picture->title; ?>" />
			<img src="<?= echoIMG($picture); ?>" style="width:75px;" >
			<input class="btn" type="file" name="picture" value="Изменить изображение" />
			<input type="submit" value="Сохранить изменения" />
			<?php } else { ?>
			ALT: <input type="text" name="form[alt]" value="" />
			TITLE: <input type="text" name="form[title]" value="" />
			<img src="<?= Picture::UPLOAD_DIR . Picture::NO_IMG; ?>" style="width:75px;" >
			<input class="btn" type="file" name="picture" value="Добавить изображение" />
			<input type="submit" value="Добавить изображение" />
			<?php } ?>
		</form>
		<hr>
		<h4>Главное изображение</h4>
		<?php if ($this->existSingleObject->picture) { ?>
		<div style="width: 300px;overflow: hidden;">
			<img src="<?= echoIMG($this->existSingleObject->picture); ?>" style="width: 150px;margin-bottom: 10px;display: block;">
			<a href="<?= $this->printControllerUrl('picture', array($this->existSingleObject->id, $this->existSingleObject->picture->id)); ?>" class="btn alert-success" style="float: left;margin: 0 5px 5px 0; width: auto;">Редактировать</a>
			<a href="/#" class="btn alert-danger" style="float: left; width: auto;margin: 0 5px 5px 0;"
			onclick="event.preventDefault(); if (confirm('Вы уверены, что хотите произвести удаление?')) {
				location.href = '<?= $this->printControllerUrl('picturedelete', array($this->existSingleObject->id, $this->existSingleObject->picture->id)); ?>';
			}">Удалить</a>
		</div>
		<?php }else{ ?>
		<h4>Нет главного изображения</h4>
		<?php } ?>
		<hr>
		<h4>Альбом изображений</h4>
		<?php if (count($this->existSingleObject->album)) {
			foreach ($this->existSingleObject->album as $photo) {
				?>
				<div style="width: 300px;overflow: hidden;">
					<img src="<?= echoIMG($photo); ?>" style="width: 150px;margin-bottom:10px;display: block;">
					<a href="<?= $this->printControllerUrl('picture', array($this->existSingleObject->id, $photo->id)); ?>" class="btn alert-success" style="float: left;margin: 0 5px 5px 0;width: auto;">Редактировать</a>
					<?php if ($this->existSingleObject->picture) {
						if($photo->id != $this->existSingleObject->picture->id){ ?>
						<a href="<?= $this->printControllerUrl('pictureedit', array($this->existSingleObject->id, $photo->id)); ?>" class="btn alert-warning" style="width: auto;float: left;margin: 0 5px 5px 0;">Сделать главной</a>
						<?php } 
					}else{ ?>
					<a href="<?= $this->printControllerUrl('pictureedit', array($this->existSingleObject->id, $photo->id)); ?>" class="btn alert-warning" style="width: auto;float: left;margin: 0 5px 5px 0;">Сделать главной</a>
					<?php } ?> 
					<a href="/#" class="btn alert-danger" style="float: left;margin: 0 5px 5px 0;width: auto;"
					onclick="event.preventDefault(); if (confirm('Вы уверены, что хотите произвести удаление?')) {
						location.href = '<?= $this->printControllerUrl('picturedelete', array($this->existSingleObject->id, $photo->id)); ?>';
					}">Удалить</a>
				</div>
				<?php
			}
		} else {
			echo "<h4>Нет изображений</h4>";
		}?>
	</div>