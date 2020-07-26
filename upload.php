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
	<title>Feltöltés</title>
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
			background-image: url("img/bg01.jpeg");
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
		<div class="container border mt-5 p-4 profileSettingsDiv bg-light">
				<div class="col-md-12 col-sm-12 text-center"> 
					<h3>Kép feltöltése</h3>
						<form method="POST" action="" enctype="multipart/form-data">
								<div class="input-group mb-3 mt-5">
									<input class="btn btn-info imageuploadbtn" type="file" name="file">
								</div>
										<div class="input-group mb-3">
											<select class="form-control" name="category">
												<option value="default">Válassz kategóriát...</option>
						 						<?php
						 							require("classes/db.php");

						 							require("classes/profileinfos.php");

													$profileClass = new ProfileInfos();

						 							$profileClass->getCategoriesIntoSelect();
						 						?>
				 							</select>
			 							</div>
									<div class="form-group">
										<textarea name="autograph" class="form-control" placeholder="Képaláírás..."></textarea>
									</div>
									<input type="submit" name="upload" class="btn btn-info mt-3 loginBtn" value="Feltölt"/>
									<?php
											require("classes/images.php");

											$imageClass = new Images();

											if(isset($_POST["upload"]))
											{

												echo $imageClass->uploadImg($_GET["uid"], $_POST["category"], $_POST["autograph"]);
											}
									?>
						</form>
					</div>
			</div>
</body>
</html>