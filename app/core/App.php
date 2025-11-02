<?php

class App{
	private $controller="Home", $method="index", $param = []; 

	public function __construct(){
		if(isset($_GET['url'])){
			$url = $this->getUrl();
			$urlInfo = $url;
			if(!file_exists("../app/controllers/{$url[0]}.php")){
				$this->redirectNotFound($urlInfo);
			}
			$this->controller =  $url[0];
			unset($url[0]);
		}
		require_once "../app/controllers/{$this->controller}.php";
		$this->controller = new $this->controller;
		// echo $url[1];
		if(isset($url[1])){
			if(method_exists($this->controller, $url[1])){
				$this->method = $url[1];
				unset($url[1]);
			}else{
				$this->redirectNotFound($urlInfo);
			}
		}
		// else{
		// 	$currentController = get_class($this->controller);
		// 	header("Location: ".BASEURL."/{$currentController}/index");
		// 	die;
		// }
		if(!empty($url[2])){
			$this->param = array_values($url);
		}
		call_user_func_array([$this->controller, $this->method], $this->param);
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