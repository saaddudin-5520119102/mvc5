<?php

class Mahasiswa extends Controller{
	public function index($page = 1, $search = ''){
		$mahasiswa = $this->model("Mahasiswa_model")->getAllMahasiswa($page, $search);
		// $data["mahasiswa"] = $this->model("Mahasiswa_model")->getAllDataFilter($page, $search);
		$data["mahasiswa"] = $mahasiswa['mahasiswa'];
		$data["pageCount"] = $mahasiswa['pageCount'];
		$data["currentPage"] = $mahasiswa['currentPage'];
		$data["filter"] = $mahasiswa['filter'];
		$this->view('template/header');
		$this->view('mahasiswa/index', $data);
		$this->view('template/footer');
	}
	public function getDataMahasiswa(){
		echo $this->model("Mahasiswa_model")->selectDataJSON($_POST['id']);
	}
	

}
?>