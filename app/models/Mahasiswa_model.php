<?php

class Mahasiswa_model extends Database
{
	public function getAllMahasiswa($page){
		$dataTotal = $this->getCountTotalTable("mahasiswa");
		// $halaman = $page;
		$jumlahPerHalaman = 5;
		$jumlahHalaman = ceil($dataTotal / $jumlahPerHalaman);
		$indexAwalData = ($page*$jumlahPerHalaman)-$jumlahPerHalaman;
		$this->prepare("SELECT * FROM mahasiswa ORDER BY id DESC LIMIT {$indexAwalData}, {$jumlahPerHalaman}");
		$this->execute();
		return ["mahasiswa"=>$this->getAllData(), "pageCount"=>$jumlahHalaman, "currentPage" => $page];
	}
	public function getAllDataFilter($filter){
		// echo $filter;die;
		$this->prepare("SELECT * FROM mahasiswa WHERE 
			nama LIKE :nama
			OR nrp LIKE :nrp
			OR jurusan LIKE :jurusan
			OR email LIKE :email");
		$this->bind('nama', "%$filter%");
		$this->bind('nrp', "%$filter%");
		$this->bind('email', "%$filter%");
		$this->bind('jurusan', "%$filter%");
		$this->execute();
		return $this->getAllData();
	}
	public function selectDataJSON($id){
		$this->prepare("SELECT * FROM mahasiswa WHERE id = :id");
		$this->bind('id', $id);
		$this->execute();
		return json_encode($this->getSelectedData());
	}
	public function selectAllDataJSON($query){
		$this->prepare($query);
		$this->execute();
		return json_encode($this->getAllData());
	}
	private function getCountTotalTable($table){
		$this->prepare("SELECT COUNT(*) AS total FROM ".$table);
		$this->execute();
		return $this->getAllData()[0]["total"];
	}
}

?>