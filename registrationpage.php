<!DOCTYPE html>
<html>
<head>
	<title>Regisztráció</title>
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
	<div class ="container-fluid registMainDiv">
		<div class="container registAltDiv">
			<form method="POST" action="">
						<h1 class="text-center mb-4"><i class="fas fa-camera-retro mb-3" style="font-size: 5rem;"></i><br/>Regisztráció</h1>
						<?php 

							require("classes/registration.php");

							if(isset($_POST["registBtn"]))
							{
								$registClass = new Registration($_POST["user"], $_POST["pwd"]);
								$registClass->registToUsers();
							}
						?>
			    		<div class="input-group mb-3">
			    			<div class="input-group-prepend">
							    <span class="input-group-text"><i class="fas fa-user"></i></span>
							 </div>
			    			<input class="form-control registUser" type="text" name="user" placeholder="Felhasználónév" />
			    		</div>
			    		<p class="text-danger registUserError"></p> 

			    		<div class="input-group mb-3">
			    			<div class="input-group-prepend">
							    <span class="input-group-text"><i class="fas fa-lock"></i></span>
							 </div>
			    			<input class="form-control registPwd" type="password" name="pwd"  placeholder="Jelszó"/>
			    		</div>
			    		<p class="text-danger mb-3 registPwdError"></p> 

			    		<div class="input-group mb-3">
			    			<div class="input-group-prepend">
							    <span class="input-group-text"><i class="fas fa-lock"></i></span>
							 </div>
			    			<input class="form-control registPwdAgain" type="password" name="pwdAgain"  placeholder="Jelszó ismét"/>
			    		</div>
			    		<p class="text-danger mb-3 registPwdAgainError"></p> 

			    		<button class="btn btn-warning registBtn" type="submit" name="registBtn" id="logBtn">Regisztráció</button>
			</form>
			<a href="index.php"><button class="btn btn-info w-100 mt-3">Vissza</button></a>
		</div>
	</div>
	<script type="text/javascript" src="js/regist_empty.js"></script>
	<script type="text/javascript" src="js/regist_ajax.js"></script>
</body>
</html>