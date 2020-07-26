<?php 
	require("checkPasswordLength.php");

	$checkPassClass = new CheckPassword($_POST["pword"]);

	if($checkPassClass->checkLength() === false)
	{
		echo "<span><i class='fas fa-exclamation-circle'></i> Minimum 5 karakter!</span>";
	}
?>