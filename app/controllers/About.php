<?php

class About{
	public function index(){
		$this->view('template/header');
		$this->view('mahasiswa/index');
		$this->view('template/footer');
	}
}
?>