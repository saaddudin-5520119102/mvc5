<?php

class Database{
	private $dbh, $stmt, $dsn;
	public function __construct(){
		$this->dsn = "mysql:host=".DBHOST.";dbname=".DBTABLE;
		$options = [
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		];
		try{
			$this->dbh = new PDO($this->dsn, DBUSERNAME, DBPASS, $options);
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function prepare($query){
		$this->stmt = $this->dbh->prepare($query);
	}

	public function bind($param, $value, $type = null){
		if(!$type){
			switch(true){
				case is_null($value):
				$type = PDO::PARAM_NULL;
				break;
				case is_int($value):
				$type = PDO::PARAM_INT;
				break;
				case is_bool($value):
				$type = PDO::PARAM_BOOL;
				break;
				default;
				$type = PDO::PARAM_STR;
				break;
			}
		}
		$this->stmt->bindValue($param, $value, $type);
	}

	public function execute(){
		$this->stmt->execute();
	}

	public function getAllData(){
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getSelectedData(){
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}
}

?>