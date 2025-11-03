<?php
// session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="http://localhost/belajar_php/mvc5/public/css/template.css">
	<title>Halaman <?=$data["title"]?></title>
</head>
<body>
	<?php if(isset($_SESSION["login"])):?>
		<header>
	    <div class="left-nav">
	      <a href="<?=BASEURL?>">Home</a>
	    </div>
	    <div class="right-nav">
	      <a href="#about">About</a>
	      <a href="<?=BASEURL.'/mahasiswa/index';?>">Mahasiswa</a>
	      <a href="#contact">Contact</a>
	      <div class="profNav">
	      	<div class="garis"></div>
		      <h1 class="nameNav">Sutono Bariso Songkolo Molo</h1>
		      <div class="imageProfil"><img src=""></div>
		  	</div>
	    </div>
	  </header>
	<?php else:?>
		<header>
	    <div class="left-nav">
	      <a href="<?=BASEURL?>">Home</a>
	    </div>
	    <div class="right-nav">
	      <a href="#about">About</a>
	      <a href="#contact">Contact</a>
	      <div class="login-logout-nav">
		      <a href="<?=BASEURL.'/auth/login';?>" class="login">Login</a>
		      <a href="<?=BASEURL.'/auth/register';?>" class="register">Register</a>
		  </div>
	    </div>
	  </header>
	<?php endif;?>
