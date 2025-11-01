<?php

class Mahasiswa extends Controller{
	public function index($page = 1, $search = ''){
		$mahasiswa = $this->model("Mahasiswa_model")->getAllMahasiswa($page);
		if(!is_numeric($page)) {
		  header("Location: ".BASEURL."/page_with_string_format");
		  die;
		}
		if(empty($search)){
			$data["mahasiswa"] = $mahasiswa['mahasiswa'];
			$data["pageCount"] = $mahasiswa['pageCount'];
			$data["currentPage"] = $mahasiswa['currentPage'];
		}else{
			// echo "booo";die;
			$data["mahasiswa"] = $this->model("Mahasiswa_model")->getAllDataFilter($search);
		} 
		$this->view('template/header');
		$this->view('mahasiswa/index', $data);
		$this->view('template/footer');
	}
	public function getDataMahasiswa(){
		echo $this->model("Mahasiswa_model")->selectDataJSON($_POST['id']);
	}

}
?>