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
	<title>Új kategória</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bs/bootstrap.min.css">
	<script src="bs/jquery.min.js"></script>
	<script src="bs/popper.min.js"></script>
	<script src="bs/bootstrap.min.js"></script>
	<script type="text/javascript" src="fontawesome/fontawesome-all.min.js"></script>
	  
	<link rel="shortcut icon" href="icon/favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<style type="text/css">
	  	body
	  	{
	  		background-image: url("img/newcategory_bg.jpeg");
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
			<div class="container mt-5 profileSettingsDiv border p-3 rounded bg-light">
				<form method="POST" action="" enctype="multipart/form-data">
					<div class="text-center">
						<h2>Új kategória</h2>
					</div>
					<div class="form-group mt-4">
						<label>Kategória név: *</label>
						<input class="form-control" type="text" name="cat_name" id="categoryName"/>
						<span class="text-danger" id="categoryNameError"></span>
					</div>
					<label>Kategória kép: *</label>
					<div class="form-group">
						<input class="btn btn-info" type="file" name="file" value="Kép feltöltés"/>
						<?php
						require("classes/db.php");

						if(isset($_POST["save"]))
						{
							require("classes/category.php");

							$categoryClass = new Category();
							
							echo $categoryClass->addNewCategory($_POST["cat_name"]);

							header("Location: categories.php");
						}
					?>
						<p class="text-info mt-2"><i class="fas fa-exclamation-circle"></i> A kategória képe megvágásra kerül a jobb megjeleníthetőség érdekében!</p>
					</div>
					<div class="form-group">
						<input class="btn btn-info" type="submit" name="save" id="save" value="Mentés"/>
					</div>
				</form>
			</div>
		<script type="text/javascript" src="js/category_empty.js"></script>
</body>
</html>