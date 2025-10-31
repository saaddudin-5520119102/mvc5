<?php

class Mahasiswa_model extends Database
{
	public function getAllData(){
		$this->prepare("SELECT * FROM mahasiswa");
		$this->execute();
		return parent::getAllData();
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
		return json_encode(parent::getAllData());
	}
}

?>