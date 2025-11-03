<?php
class Auth_model extends Database{
	public function loginHandlerModel($data){
		// if(getCountTotalTable("SELECT * FROM users WHERE nama = :nama", $data["nama"])==1){

		// }
		$this->prepare("SELECT * FROM users WHERE nama = :nama");
		$this->bind('nama', $data["nama"]);
		$this->execute();
		$user = $this->getSelectedData();
		if(empty($user)){
			echo "<script>alert(Tidak ada username dengan nama: ".$data["nama)"]."!);</script>";
			return 0;
		}else{
			// echo "gondol";die;
			if(password_verify($data["password"], $user["password"])){
				return 1;
			}else{
				echo "Password salah!: ";
				return 0;
			}
		}
	}
	private function getCountTotalTable($query, $keyword=null){
		if($search){
			$this->prepare($query);	
			$this->bind('nama', "%$search%");
		}else{
			$this->prepare($query);
		}
		$this->execute();
		return $this->getAllData()[0]["total"];
	}
}
?>