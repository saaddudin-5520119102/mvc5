<?php
session_start();
if(isset($_SESSION["login"])){
	header("Location: ".BASEURL."/mahasiswa/index");
}
class Auth extends Controller{
	public function login(){
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
			$_SESSION['login'] = true;
			header("Location: ".BASEURL."/mahasiswa/index");
		}else{
			echo "<script>alert('Login gagal!');document.location.href='".BASEURL."/auth/login';</script>";
		}
	}
}

?>