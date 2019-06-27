<div class="col-md-10">
	<h3 style="color: green">Все заказы на сайте</h3>
	<table class="table portfolio">
		<thead>
			<tr>
				<th>Имя</th>
				<th>Телефон</th>
				<th>Комментарий</th>
				<th>Удалить</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($orders as $order) { ?>
			<td class="admin-name">
				<?= $order->name; ?>
			</td>
			<td class="admin-name">
				<?= $order->phone; ?>
			</td>
			<td class="admin-name">
				<?= $order->comment; ?>
			</td>
			<td class="admin-name">
				<a href="<?= $this->printControllerUrl('delete'); ?>/<?= $order->id; ?>"
					onclick="event.preventDefault();
					if (confirm('Вы уверены, что хотите произвести удаление?')) {
						location.href = '<?= $this->printControllerUrl('delete'); ?>/<?= $order->id; ?>';
					}">Удалить</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<h3 style="color: green">Все запросы на обратную связь</h3>
	<table class="table portfolio">
		<thead>
			<tr>
				<th>Имя</th>
				<th>Телефон</th>
				<th>Комментарий</th>
				<th>Удалить</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($callbacks as $callback) { ?>
			<td class="admin-name">
				<?= $callback->name; ?>
			</td>
			<td class="admin-name">
				<?= $callback->phone; ?>
			</td>
			<td class="admin-name">
				<?= $callback->comment; ?>
			</td>
			<td class="admin-name">
				<a href="<?= $this->printControllerUrl('delete'); ?>/<?= $callback->id; ?>"
					onclick="event.preventDefault();
					if (confirm('Вы уверены, что хотите произвести удаление?')) {
						location.href = '<?= $this->printControllerUrl('delete'); ?>/<?= $callback->id; ?>';
					}">Удалить</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>