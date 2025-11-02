<?php

class Mahasiswa_model extends Database
{
	public function getAllMahasiswa($page, $search){
		if(empty($search)){
			// echo "empty"; die;
			$dataTotal = $this->getCountTotalTable("SELECT COUNT(*) AS total FROM mahasiswa");
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
	public function tambahDataMahasiswa($data){
		$this->prepare("INSERT INTO mahasiswa VALUES ('', :nama, :nrp, :email, :jurusan, '')");
		$this->bind('nama', $data["nama"]);
		$this->bind('nrp', $data["nrp"]);
		$this->bind('email', $data["email"]);
		$this->bind('jurusan', $data["jurusan"]);
		$this->execute();
		return $this->rowCount();
	}
	public function selectDataJSON($id){
		$this->prepare("SELECT * FROM mahasiswa WHERE id = $id");
		$this->execute();
		return json_encode($this->getSelectedData()) ;
	}
	public function ubahDataMahasiswa($data){
		$this->prepare("UPDATE mahasiswa SET nama = :nama, nrp = :nrp, email = :email, jurusan = :jurusan WHERE id = :id");
		$this->bind('id', $data["id"]);
		$this->bind('nama', $data["nama"]);
		$this->bind('nrp', $data["nrp"]);
		$this->bind('email', $data["email"]);
		$this->bind('jurusan', $data["jurusan"]);
		$this->execute();
		return $this->rowCount();
	}
}

?>