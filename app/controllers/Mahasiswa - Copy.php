<?php
session_start();
$ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
$ip = getUserIP();
$pass ="saad5680".$ua.$ip;
echo "pass :".$pass;
echo "<br>";
echo "sessionlogin :".$_SESSION['login'];
echo "<br>";
echo $_COOKIE['user_id'];
echo "<br>";
echo password_hash($ua.$ip, PASSWORD_DEFAULT);
echo "<br>";
var_dump(password_verify($pass, $userId));
$userId = $_COOKIE['user_id'] ?? null;
if (!isset($_SESSION["login"])) {
		header("Location: ".BASEURL."/auth/login");
		setcookie('user_id', "logout", [
                'expires' => time() - 259200, //3days active time
                'path' => '/',
                // 'domain' => COOKIE_DOMAIN ?: null,
                'domain' => 'localhost',
                'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
                'httponly' => true,
                'samesite' => 'Lax'
            ]);
		die;
	}else{
		if(!($ua.$ip == $_SESSION["login"]) && !(password_verify($pass, $userId))){
			$_SESSION = [];
			session_unset();
			session_destroy();
			// setcookie('user_id', '', time() - 3600, '/');
			
			setcookie('user_id', "logout", [
	                'expires' => time() - 259200, //3days active time
	                'path' => '/',
	                // 'domain' => COOKIE_DOMAIN ?: null,
	                'domain' => 'localhost',
	                'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
	                'httponly' => true,
	                'samesite' => 'Lax'
	            ]);
		header("Location: ".BASEURL."/auth/login");
		exit();	
	}
	
}

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