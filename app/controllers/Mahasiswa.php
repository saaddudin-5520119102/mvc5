<?php

class Mahasiswa extends Controller{
	public function index($search = '', $page = ''){
		$data["mahasiswa"] = $this->model("Mahasiswa_model")->getALLData();
		$this->view('template/header');
		$this->view('mahasiswa/index', $data);
		$this->view('template/footer');
	}
	public function getDataMahasiswa(){
		echo $this->model("Mahasiswa_model")->selectDataJSON($_POST['id']);
	}

}
?>