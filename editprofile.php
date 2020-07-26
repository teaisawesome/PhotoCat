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
	<title>Szerkesztés</title>
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
			background-image: url("img/editprofile_bg.jpeg");
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
		<main>
			<div class="container border mt-5 p-4 profileSettingsDiv bg-light">
				<form method="POST" action="" enctype="multipart/form-data">
					<div class="form-group">
						<img class="rounded-circle mt-3 img-thumbnail" src="
							<?php 
								require("classes/db.php");

								require("classes/profileinfos.php");

								$profileClass = new ProfileInfos();

								echo $profileClass->getProfilePicture($_SESSION["UID"]);

							?>" width="80" height="80" />
								<input class="btn btn-info profileImgDownloadBtn" type="file" name="file" />
							<?php 
								if(isset($_POST["save"]))
								{
									if(@$profileClass->setProfilePicture($_SESSION["UID"]) == 1)
									{
										@$profileClass->setName($_SESSION["UID"], $_POST["name"]);
									
										@$profileClass->setBio($_SESSION["UID"], $_POST["bio"]);

										header("Location: account.php?uid=".$_SESSION["UID"]."");
									}
									else
									{
										echo @$profileClass->setProfilePicture($_SESSION["UID"]);
									}
								}
							?>
					</div>
					<div class="form-group">
						<label>Név: </label>
						<input class="form-control" type="text" name="name" value="<?php echo $profileClass->getName($_SESSION["UID"]);?>"/>
					</div>
					<div class="form-group">
						<label>Bemutatkozás</label>
						<textarea class="form-control" name="bio"><?php echo $profileClass->getBio($_SESSION["UID"]);?></textarea>
					</div>
					<div class="form-group">
						<input class="btn btn-info" type="submit" name="save" value="Mentés"/>
					</div>
				</form>
			</div>
		</main>
</body>
</html>