<?php
session_start();

class Home extends Controller{
	public function index($nama="admin", $jabatan="jabatan"){
		$this->view("template/header", ["title"=>"Index"]);
		$this->view("home/index", ["nama"=>"soraya"]);
		$this->view("template/footer");
		// echo "hai ".$nama." dengan jabatan ".$jabatan." ini adalah home index";
	}
	public function about($nama="admin", $jabatan="jabatan"){
		// echo "hai ".$nama." dengan jabatan ".$jabatan." ini adalah home about";
		$this->view("template/header", ["title"=>"Index"]);
		$this->view("home/about", ["nama"=>"soraya"]);
		$this->view("template/footer");
	}
	public function notfound($url="/"){
		$this->view("template/header", ["title"=>"NotFound"]);
		$this->view("home/notfound", $url);
		$this->view("template/footer");
	}
}
?>