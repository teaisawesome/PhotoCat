<?php 
	require("checkUsername.php");
	
	$checkClass = new CheckUsername($_POST["uname"]);
	
	if($checkClass->checkUsername())
	{
		echo "<span style='color: green;'><i class='far fa-smile'></i> Szabad felhasználónév!</span>";
	}
	else
	{
		echo "<span><i class='far fa-frown'></i> Foglalt felhasználónév!</span>";
	}
?>