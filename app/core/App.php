<?php

class App{
	private $Controller="Home", $method="index", $param = []; 

	public function __construct(){
		if(isset($_GET['url'])){
			$url = $this->getUrl();
			$urlInfo = $url;
			if(!file_exists("../app/controllers/{$url[0]}.php")){
				$this->redirectNotFound($urlInfo);
			}
			$this->Controller =  $url[0];
			unset($url[0]);
		}
		require_once "../app/controllers/{$this->Controller}.php";
		$this->Controller = new $this->Controller;
		// echo $url[1];
		if(isset($url[1])){
			if(method_exists($this->Controller, $url[1])){
				$this->method = $url[1];
				unset($url[1]);
			}else{
				$this->redirectNotFound($urlInfo);
			}
		}
		if(!empty($url[2])){
			$this->param = array_values($url);
		}
		call_user_func_array([$this->Controller, $this->method], $this->param);
	}

	private function getUrl(){
		$url = $_GET['url'];
		$url = rtrim($url);
		$url = filter_var($url, FILTER_SANITIZE_URL);
		$url = explode("/", $url);
		return $url;
	}

	private function redirectNotFound($url){
		require_once "../app/controllers/Home.php";
		$home = new Home;
		$this->param[]=implode('/', $url);
		call_user_func_array([$home, "notfound"], $this->param);
		die;
	}
}

?>