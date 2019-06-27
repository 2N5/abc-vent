<div class="col-md-10">
	<a href="<?=$this->printControllerUrl('create'); ?>" class="btn btn-primary">Добавить категорию</a>
	<a href="<?=$this->printControllerUrl('page'); ?>" class="btn btn-primary">Страница категорий</a><br>
	<h2>Все категории (отображаются только категории относящиеся к тематике сайта)</h2>
	<table class="table portfolio">
		<thead>
			<tr>
				<th>Название</th>
				<th>Родительская категория</th>
				<th>Редактировать</th>
				<th>Удалить</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($this->existObjects as $existObject){ ?>
			<td class="admin-name">
				<a href="<?=$this->printControllerUrl('edit'); ?>/<?=$existObject->id; ?>"><?=$existObject->title; ?></a>
			</td>
			<td class="admin-name">
				<?php if($existObject->parent){ ?>
				<a href="<?=$this->printControllerUrl('edit'); ?>/<?=$existObject->id_parent; ?>"><?=$existObject->parent; ?></a>
				<?php } ?>
			</td>
			<td class="admin-name">
				<a href="<?=$this->printControllerUrl('edit'); ?>/<?=$existObject->id; ?>">Редактриовать</a>
			</td>
                <td class="admin-name">
                    <a style="color: red" href="<?=$this->printControllerUrl('delete'); ?>/<?=$existObject->id; ?>"
                       onclick="event.preventDefault(); if (confirm('Вы уверены, что хотите произвести удаление? При удалении родительской категории все дочерние так же будут удалены!')){ 
                           location.href = '<?=$this->printControllerUrl('delete'); ?>/<?=$existObject->id; ?>';
                       }">Удалить</a>
                   </td>
               </tr>
               <?php } ?>
           </tbody>
       </table>
   </div>