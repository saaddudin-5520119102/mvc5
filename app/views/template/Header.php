<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/template.css">
	<title>Halaman <?=$data["title"]?></title>
</head>
<body>
	<header>
    <div class="left-nav">
      <a href="<?=BASEURL?>">Home</a>
    </div>
    <div class="right-nav">
      <a href="#about">About</a>
      <a href="<?=BASEURL.'/mahasiswa';?>">Mahasiswa</a>
      <a href="#contact">Contact</a>
      <div class="login-logout-nav">
	      <a href="#login" class="login">Login</a>
	      <a href="#register" class="register">Register</a>
	  </div>
    </div>
  </header>
