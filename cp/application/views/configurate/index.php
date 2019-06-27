<div class="col-md-10">
	<h3>Тематика сайта <strong style="color: red">Важно: (Тематика выбирается один раз, изменить нельзя)</strong></h3>
	<table class="table portfolio">
		<thead>
			<th>Тема</th>
			<th>Контроллер</th>
			<th>Выбрать</th>
		</thead>
		<tbody>
			<?php foreach($themes as $controller){ ?>
			<td class="admin-name" >
				<?=$controller->title; ?>
			</td>
			<td class="admin-name" >
				<?=$controller->control; ?>
			</td>
			<td class="admin-name">
				<a href="<?=$this->printControllerUrl('index', array($controller->id));?>">Выбрать</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div>

