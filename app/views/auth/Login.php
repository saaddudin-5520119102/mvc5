	<?php
	if(isset($_POST['submit'])){

	}
	?>

	<div class="authForm1">
		<h3>Login</h3>
		<?php if(isset($error)):?>
			<h4>Login gagal!</h4>
		<?php endif;?>
		<form action="<?=BASEURL?>/auth/loginhandler" method="post">
			<label for="nama">Nama</label>
			<?php if(isset($_POST['login'])):?>
				<input type="text" name="nama" value="<?=$_POST['nama']?>">
			<?php else:?>
				<input type="text" name="nama">
			<?php endif;?>
			<label for="password">Password</label>
			<input type="password" name="password">
			<button name="login" class="btn1" type="submit">Login</button>
		</form>
		<p>Still not yet registered?, <a href="register.php">please register here!</a> </p>
	</div>