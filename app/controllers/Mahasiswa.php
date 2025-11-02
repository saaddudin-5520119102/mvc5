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
	public function tambah(){
		if($this->model("Mahasiswa_model")->tambahDataMahasiswa($_POST)>0){
			// $baseUrl = BASEURL;
			echo "<script>alert('Data berhasil ditambahkan!');document.location.href='".BASEURL."/mahasiswa/index';</script>";
			die;
		}else{
			echo "<script>alert('Data gagal ditambahkan!');</script>";
		}
	}
	public function ubah(){
		if($this->model("Mahasiswa_model")->ubahDataMahasiswa($_POST)>0){
			// $baseUrl = BASEURL;
			echo "<script>alert('Data berhasil diubah!');document.location.href='".BASEURL."/mahasiswa/index';</script>";
			die;
		}else{
			echo "<script>alert('Data gagal diubah!');</script>";
		}
	}

}
?>