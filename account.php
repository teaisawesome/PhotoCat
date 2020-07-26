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
	<title>Oldalam</title>
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
		<div class="container rounded border mt-3 bg-light" style="box-shadow: 0px 0px 15px lightgray;">
			<div class="row">
				<div class="col-md-5 text-center rounded"><img class="rounded-circle mt-3 img-thumbnail" src="
				<?php 
					require("classes/db.php");
					
					require("classes/profileinfos.php");

					$profileClass = new ProfileInfos();

					echo $profileClass->getProfilePicture($_GET["uid"]);
				?>" width="180" height="180" /></div>

				<div class="col-md-7 rounded profileInfosMainDiv">
					<h2 class="mt-3"><?php

					echo $profileClass->getName($_GET["uid"]);

					?></h2>
					<?php 
						if($_GET["uid"]==$_SESSION["UID"])
						{
							echo "<a href='editprofile.php'><button class='btn btn-info'>Profil szerkesztése</button></a>";
						}
						else
						{
							echo $profileClass->getFollowButton($_GET["uid"], $_SESSION["UID"]);
						}

					?>
					<div class="row">
						<div class="col-md-4 col-sm-4 mb-3 mt-3"><h5><?php

								echo $profileClass->getImageNumber($_GET["uid"]);
								
						?> kép</h5></div>
						<div class="col-md-4 col-sm-4 mb-3 mt-3"><h5><?php

								echo $profileClass->getFollowNumber($_GET["uid"]);
								
						?> követő</h5></div>
						<div class="col-md-4 col-sm-4 mb-3 mt-3"><h5><?php

								echo $profileClass->getLikesNumber($_GET["uid"]);

						?> like</h5></div>
					</div>
					<h5><?php echo $profileClass->getBio($_GET["uid"]);?></h5>
				</div>
			</div>
			<hr>
			<div class="text-center">
				<?php
					if($_GET["uid"]==$_SESSION["UID"])
					{
						echo "<a href='upload.php?uid=".$_GET["uid"]."'><button class='btn btn-info mb-3'>Kép felöltése</button></a>";
					}
				?>
			</div>
			<?php
				require("classes/images.php");

				$imageClass = new Images();
				$imageClass->getImages($_GET["uid"]);
			?>
		</div>
	</div>
	<script type="text/javascript">
		$(function()
		{
			var btn = $("#follow");
			var f = true;

			$("#follow").on('click', function()
			{
				if($("#follow").html() == "Követés")
				{
					var uid = <?php echo $_SESSION["UID"];?>;
					var fid = <?php echo $_GET["uid"];?>;
					$.ajax
					({
						url: 'classes/follow.php',
						type: 'post',
						data:
						{
							uid: uid,
							fid: fid,
							f: 1
						},
						success: function(e)
						{
							$("#follow").html("Követés visszavonása");
						}
					});
				}
				else
				{
					var uid = <?php echo $_SESSION["UID"];?>;
					var fid = <?php echo $_GET["uid"];?>;
					$.ajax
					({
						url: 'classes/follow.php',
						type: 'post',
						data:
						{
							uid: uid,
							fid: fid,
							f: 0
						},
						success: function(e)
						{
							$("#follow").html("Követés");
						}
					});

				}
			});
		});
	</script>
</body>
</html>