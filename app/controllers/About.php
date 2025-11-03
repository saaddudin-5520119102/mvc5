<?php
session_start();
if(!isset($_SESSION["login"])){
	header("Location: ".BASEURL."/auth/login");
}
class About{
	public function index(){
		$this->view('template/header');
		$this->view('mahasiswa/index');
		$this->view('template/footer');
	}
}
?>