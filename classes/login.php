<?php

	session_start();

	require("db.php");

	class Login extends Connection
	{
		protected $user;
		protected $pwd;

		function __construct($user, $pwd)
		{
			parent::__construct();
			$this->user = $user;
			$this->pwd = $pwd;
		}
		function login()
		{
			try
			{
				$sql = $this->con->prepare("SELECT * FROM users WHERE HEX(username) = HEX(?) AND HEX(password) = HEX(?);");

				$sql->bindParam(1, $this->user);
				$sql->bindParam(2, $this->pwd);

				$sql->execute();

				$result = $sql->fetch(PDO::FETCH_ASSOC);

				if($result > 0)
				{	
					$_SESSION["logged"] = true;
					$_SESSION["UID"] = $result["UID"];
					header("Location: dashboard.php");
				}
				else
				{
					echo "<h3 class='text-danger text-center'>Sikertelen belépés!</h3>";
				}
			}
			catch(PDOException $e)
			{
				$e->getMessage();
			}
		}
	}
?>