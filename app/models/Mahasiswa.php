<?php

class ClassName extends Database
{
	public function getAllData(){
		$this->prepare("SELECT * FROM mahasiswa");
		$this->execute();
		parent::getAllData();
	}
}

?>