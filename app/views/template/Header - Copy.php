<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="stylesheet" type="text/css" href="../app/views/template/Header1.css"> -->
	<style type="text/css">
		body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #0b5ed7;
/*      padding: 15px 30px;*/
    }

    /* Left side */
    .left-nav a {
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      text-decoration: none;
      font-size: 1.2rem;
      font-weight: bold;
      transition: color 0.3s;
      height: 100%;
      width: 120px;
    }

    .left-nav{
      height: 50px;
    }

    .left-nav a:hover {
      color: #ffd43b;
    }

    /* Right side */
    .right-nav {
      display: flex;
      align-items: center;
      height: 50px;
    }

    .right-nav a {
      color: white;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
      border-radius: 4px;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100%;
      width: 120px;
    }

    .login-logout-nav {
      display: flex;
      gap: 20px;
      align-items: center;
      padding: 0 5px;
    }

     .login-logout-nav a {
      display: flex;
      gap: 20px;
      align-items: center;
      padding: 0 10px;
      width: 60px;
    }

    /* Normal hover for about/mahasiswa/contact */
    .right-nav a:hover {
      background-color: rgba(255, 255, 255, 0.2);
    }

    /* Special styling for login/register */
    .right-nav a.login,
    .right-nav a.register {
      background-color: white;
      color: #0b5ed7;
      font-weight: bold;
      padding: 6px 14px;
      border-radius: 20px;
      transition: all 0.3s ease;
    }

    .right-nav a.login:hover,
    .right-nav a.register:hover {
      background-color: #ffd43b;
      color: #000;
    }

    /* Responsive */
    @media (max-width: 600px) {
      header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }

      .right-nav {
        flex-wrap: wrap;
        gap: 10px;
      }
    }
	</style>
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
