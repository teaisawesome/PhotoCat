<!DOCTYPE html>
<html>
<head>
	<title>Belépés</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bs/bootstrap.min.css">
	<script src="bs/jquery.min.js"></script>
	<script src="bs/popper.min.js"></script>
	<script src="bs/bootstrap.min.js"></script>
	<script type="text/javascript" src="fontawesome/fontawesome-all.min.js"></script>
	  
	<link rel="shortcut icon" href="icon/favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class ="container-fluid loginMainDiv">
		<div class="container loginAltDiv">
			<form method="POST" action="">
						<h1 class="text-center mb-4"><i class="fas fa-camera-retro mb-3" style="font-size: 5rem;"></i><br/>Bejelentkezés</h1>
						<?php
							if(isset($_POST["loginBtn"]))
							{
								require("classes/login.php");

								$loginClass = new Login($_POST["user"], $_POST["pwd"]);
								$loginClass->login();
							}
						?>
			    		<div class="input-group mb-3">
			    			<div class="input-group-prepend">
							    <span class="input-group-text"><i class="fas fa-user"></i></span>
							 </div>
			    			<input class="form-control loginUser" type="text" name="user" placeholder="Felhasználónév" />
			    		</div>
			    		<p class="text-danger loginUserError"></p> 

			    		<div class="input-group mb-3">
			    			<div class="input-group-prepend">
							    <span class="input-group-text"><i class="fas fa-lock"></i></span>
							 </div>
			    			<input class="form-control loginPwd" type="password" name="pwd"  placeholder="Jelszó"/>
			    		</div>
			    		<p class="text-danger mb-3 loginPwdError"></p> 

			    		<button class="btn btn-success loginBtn" type="submit" name="loginBtn" id="logBtn">Belépés</button>
			</form>
			<a href="index.php"><button class="btn btn-info w-100 mt-3">Vissza</button></a>
		</div>
	</div>
	<script type="text/javascript" src="js/login_empty.js"></script>
</body>
</html>