<?php
	class Connection
	{
		protected $host;
		protected $dbname;
		protected $user;
		protected $pwd;
		//ez a változó leírja az adatbázis kapcsolatot
		protected $con;

		function __construct()
		{
			$this->host = "localhost";
			$this->dbname = "photocat_db";
			$this->user = "root";
			$this->pwd = "";

			$this->con = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->user,$this->pwd);

			$sql = $this->con->prepare("SET NAMES utf8");

			$sql->execute();
		}
	}
?>