<div class="authForm1">
		<h3>Register</h3>
		<?php if(isset($error)):?>
			<h4>Data user gagal ditambahkan!</h4>
		<?php endif;?>
		<form action="" method="post">
			<label for="nama">Nama</label>
			<input type="text" name="nama">
			<label for="password">Password</label>
			<input type="password" name="password">
			<label for="passwordConf">Confirmasi Password</label>
			<input type="password" name="passwordConf">
			<button name="register" class="btn1" type="submit">Register!</button>
		</form>
	</div>