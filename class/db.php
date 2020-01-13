<?php 

class Db {

	private $serverName;
	private $username;
	private $password;
	private $dbName;
	private $charset;

	protected function connect() {
		$this->servername = "DESKTOP-7EL2D8S\SQLEXPRESS";
		$this->username = "ronel";
		$this->password = "ronel";
		$this->dbName = "database";

		try {
			$dsn = "sqlsrv:Server=".$this->servername.";Database=".$this->dbName;
			$pdo = new PDO($dsn,$this->username,$this->password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $pdo;
		} catch (PDOException $e) {
			echo "Connection Failed: ".$e->getMessage();
		}
	}

}