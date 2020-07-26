<?php
	session_start();

	if($_SESSION["logged"] == false)
	{
		header("Location: index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Értesítések</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bs/bootstrap.min.css">
	<script src="bs/jquery.min.js"></script>
	<script src="bs/popper.min.js"></script>
	<script src="bs/bootstrap.min.js"></script>
	<script type="text/javascript" src="fontawesome/fontawesome-all.min.js"></script>
	  
	<link rel="shortcut icon" href="icon/favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	 <script type="text/javascript" src="js/lightbox-plus-jquery.min.js"></script>
	 <link rel="stylesheet" type="text/css" href="css/lightbox.min.css">
	 <style type="text/css">
	  	.notilinks
	  	{
		  		color: black;
			text-decoration: none;
	  	}
	  	.notilinks:hover
	  	{
		  	color: black;
			text-decoration: none;
	  	}
	  	body
	  	{
	  		background-image: url("img/notes_bg.jpeg");
	  		background-position: center;
			background-size: cover;
			background-repeat: no-repeat;
			background-attachment: fixed;
	  	}
	</style>
</head>
<body>
	<header>
			 <nav class="navbar navbar-expand-md bg-light navbar-light">
			  <!-- Brand -->
			  <a class="navbar-brand" href="#"><i class="fas fa-camera-retro"></i><span>PhotoCat</span></a>
			  <!-- Toggler/collapsibe Button -->
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			    <span class="navbar-toggler-icon"></span>
			  </button>
			  <!-- Navbar links -->
			  <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
			    <ul class="navbar-nav">
					      <li class="nav-item">
					        <a class="nav-link" href="dashboard.php"><i class="fas fa-home"></i> Kezdőlap</a>
					      </li>
					      <li class="nav-item dropdown">
					        <a class="nav-link" href="categories.php"><i class="fas fa-volleyball-ball"></i> Kategóriák</a>
					      </li>
					      <li class="nav-item">
					        <a class="nav-link" href="account.php?uid=<?php echo $_SESSION["UID"]?>"><i class="fas fa-user"></i> Oldalam</a>
					      </li>
					      <li class="nav-item">
					        <a class="nav-link" href="notifications.php?uid=<?php echo $_SESSION["UID"]?>"><i class="fas fa-bell"></i> Értesítések</a>
					      </li>
						<form method="POST" action="">
						      <li class="nav-item">
						        <button class="nav-link" type="submit" name="exit" style="background: none; border:none;"><i class="fas fa-power-off"></i> Kilépés</button>
						      </li>  
				  		</form>
				  		<?php 
							if(isset($_POST["exit"]))
							{
								require("classes/exit.php");
								$class = new Kilepes();
							}	
						?>
			    </ul>
			  </div>
			 </nav>
		</header>
		<div class="container-fluid">
			<div class="row">
				 <div class="col-md-12">
				 	<br/>
				 		<div class="m-auto border rounded text-center mt-5 pt-3 bg-light notes">
				 			<?php
				 				require("classes/db.php");

				 				require("classes/notifications.php");

				 				$notClass = new Notifications();

				 				$notClass->getNotifications($_SESSION["UID"]);
				 			?>
				 		</div>
				 </div>
			</div>
		</div>
</body>
</html>