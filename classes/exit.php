<?php
	session_start();

	class Kilepes
	{
		function __construct()
		{
			$_SESSION["logged"] = false;

			header("Location: index.php");
		}
	}
?>