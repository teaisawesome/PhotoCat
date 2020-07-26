<?php
	require("db.php");
	class CheckUsername extends Connection
	{
		protected $user;
		function __construct($user)
		{
			parent::__construct();
			$this->user = $user;
		}
		function checkUsername()
		{
			try
			{
				$sqlUser = $this->con->prepare("SELECT * FROM users WHERE username = ?;");
				$sqlUser->bindParam(1, $this->user);

				$sqlUser->execute();

				$result = $sqlUser->fetch(PDO::FETCH_NUM);

				if($result > 0)
				{
					//foglalt felhasználónév
					return false;
				}
				else
				{
					//szabad felhasználónév
					return true;
				}
			}
			catch(PDOException $e)
			{
				$e->getMessage();
			}
		}
	}
?>