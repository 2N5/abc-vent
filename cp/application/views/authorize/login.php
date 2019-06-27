<div class="col-md-4 col-md-offset-4">
	<div class="login-wrapper">
		<div class="box">
			<div class="content-wrap">
				<?php if(count($this->errors)){ 
					foreach ($this->errors as $error) {?>
					<label>Ошибка: <?=$error; ?></label>
					<?php }
				} ?>
				<h6>Sign In</h6>
				<form action="/cp/authorize/login" method="post">
					<label>Логин<input type="text" name="form[login]" value=""></label>
					<label>Пароль<input type="password" name="form[password]" value=""></label>
					<br>
					<input type="submit" class="btn btn-primary signup" value="Вход">
				</form>               
			</div>
		</div>
	</div>
</div>


