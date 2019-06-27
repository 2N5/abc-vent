<div class="col-md-10">
	<table class="table portfolio">
		<thead>
			<tr>
				<th>Название</th>
				<th>H1</th>
				<th>Редактировать</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($this->existObjects as $existObject) { ?>
			<tr class="counted-element sortitem">
				<td class="admin-name">
					<a href="<?= $this->printControllerUrl('edit'); ?>/<?= $existObject->id; ?>"><?= $existObject->title; ?></a>
				</td>
				<td class="admin-name">
					<?= $existObject->h1; ?>
				</td>
				<td class="admin-name">
					<a href="<?= $this->printControllerUrl('edit'); ?>/<?= $existObject->id; ?>">Редактриовать</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>