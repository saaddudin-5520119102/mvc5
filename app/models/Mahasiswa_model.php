<?php

class Mahasiswa_model extends Database
{
	public function getAllMahasiswa($page, $search){
		if(empty($search)){
			// echo "empty"; die;
			$dataTotal = $this->getCountTotalTable("SELECT COUNT(*) AS total FROM mahasiswa");
			$dataTotal = 8;
			$jumlahPerHalaman = 5;
			$jumlahHalaman = ceil($dataTotal / $jumlahPerHalaman);
			$indexAwalData = ($page*$jumlahPerHalaman)-$jumlahPerHalaman;
			$this->prepare("SELECT * FROM mahasiswa ORDER BY id DESC LIMIT {$indexAwalData}, {$jumlahPerHalaman}");
		}else{
			$dataTotal = $this->getCountTotalTable("SELECT COUNT(*) AS total FROM mahasiswa WHERE 
			nama LIKE :nama
			OR nrp LIKE :nrp
			OR jurusan LIKE :jurusan
			OR email LIKE :email", $search);
			$jumlahPerHalaman = 5;
			$jumlahHalaman = ceil($dataTotal / $jumlahPerHalaman);
			$indexAwalData = ($page*$jumlahPerHalaman)-$jumlahPerHalaman;
			$this->prepare("SELECT * FROM mahasiswa WHERE 
			nama LIKE :nama
			OR nrp LIKE :nrp
			OR jurusan LIKE :jurusan
			OR email LIKE :email ORDER BY id DESC LIMIT {$indexAwalData}, {$jumlahPerHalaman}");
			$this->bind('nama', "%$search%");
			$this->bind('nrp', "%$search%");
			$this->bind('email', "%$search%");
			$this->bind('jurusan', "%$search%");
		}
		$this->execute();
		return ["mahasiswa"=>$this->getAllData(), "pageCount"=>$jumlahHalaman, "currentPage" => $page, "filter" => $search];
	}
	// 
	private function getCountTotalTable($query, $search=null){
		if($search){
			$this->prepare($query);	
			$this->bind('nama', "%$search%");
			$this->bind('nrp', "%$search%");
			$this->bind('email', "%$search%");
			$this->bind('jurusan', "%$search%");
		}else{
			$this->prepare($query);
		}
		$this->execute();
		return $this->getAllData()[0]["total"];
	}
	
}

?>