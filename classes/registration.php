<?php
	require("checkUsername.php");
	require("checkPasswordLength.php");

	class Registration extends Connection
	{
		protected $user;
		protected $pwd;
		function __construct($user, $pwd)
		{
			parent::__construct();
			$this->user = $user;
			$this->pwd = $pwd;

		}
		//feladata az új felhasználó beregisztrálása
		function registToUsers()
		{
				$checkUserClass = new CheckUsername($this->user);
				$checkPwdClass = new CheckPassword($this->pwd);

				if($checkUserClass->checkUsername() === true && $checkPwdClass->checkLength() === true)
				{
					try
					{
						//regisztráció a users táblába
						$sql = $this->con->prepare("INSERT INTO users(username, password) VALUES (?, ?);");
							
						$sql->bindParam(1, $this->user);
						$sql->bindParam(2, $this->pwd);

						$sql->execute();

						//regisztráció a profiles táblába
						$this->RegistToProfiles($this->user, $this->pwd);

						header("Location: index.php");
					}
					catch(PDOException $e)
					{
						$e->getMessage();
					}
				}
				else
				{
					echo "<h3 class='text-danger text-center'>Sikertelen regisztráció!<br/>Foglalt felhasználónév!</h3>";
				}
		}
		function RegistToProfiles($user, $pwd)
		{
			try
			{
					//regisztráció a users táblába
					$sql = $this->con->prepare("SELECT * FROM users WHERE HEX(username) = HEX(?) AND HEX(password) = HEX(?);");
							
					$sql->bindParam(1, $this->user);
					$sql->bindParam(2, $this->pwd);

					$sql->execute();

					$result = $sql->fetch(PDO::FETCH_ASSOC);

					if($result > 0)
					{	
						$sql2 = $this->con->prepare("INSERT INTO profile(UID, name, profile_pic_path) VALUES (?, ?, ?);");
							
						$sql2->bindParam(1, $result["UID"]);
						$sql2->bindParam(2, $result["username"]);

						$defaultImg = "profile_pictures/default.png";
						$sql2->bindParam(3, $defaultImg);

						$sql2->execute();
					}
			}
			catch(PDOException $e)
			{
				$e->getMessage();
			}
		}
	}
?>