<?php

class Auth extends Controller{
	public function login(){
		session_start();
		if(isset($_SESSION["login"])){
			header("Location: ".BASEURL."/mahasiswa/index");
		}
		$this->view('template/header');
		$this->view('auth/login');
		$this->view('template/footer');
	}
	public function register(){
		$this->view('template/header');
		$this->view('auth/register');
		$this->view('template/footer');
	}
	public function loginHandler(){
		if($this->model("Auth_model")->loginHandlerModel($_POST)>0){
			session_start();
			$ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
			$ip = getUserIP();
			$_SESSION["login"] = password_hash($ua.$ip, PASSWORD_DEFAULT);
			// $_SESSION["login"] = $ua.$ip;
			setcookie('user_id', password_hash("saad108".$ua.$ip, PASSWORD_DEFAULT), [
                'expires' => time() + 259200, //3days active time
                'path' => '/',
                // 'domain' => COOKIE_DOMAIN ?: null,
                'domain' => 'localhost',
                'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
                'httponly' => true,
                'samesite' => 'Lax'
            ]);
			header("Location: ".BASEURL."/mahasiswa/index");
		}else{
			echo "<script>alert('Login gagal!');document.location.href='".BASEURL."/auth/login';</script>";
		}
	}

	public function logout(){
		session_start();
		$_SESSION=[];
		session_unset();
		session_destroy();
		// unset($_COOKIE['device_id']); 
		setcookie('user_id', "logout", [
                'expires' => time() - 259200, //3days active time
                'path' => '/',
                // 'domain' => COOKIE_DOMAIN ?: null,
                'domain' => 'localhost',
                'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
                'httponly' => true,
                'samesite' => 'Lax'
            ]);
		header("Location: ".BASEURL."/home");
	}
}

?>