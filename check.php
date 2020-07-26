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
	<title>Képnézegető</title>
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

		a > h1 {
		  color: white;
		  font-size: 5rem;
		  text-decoration: none;
		}
		.fa-heart
		{
			font-size: 1.8rem;
		}
	  	#likebtn
	  	{
	  		margin-right: 15px;
	  		margin-top: 15px;
	  		background: none;
			padding: 0px;
			border: none;
			 outline:none;
	  	}
	  	.fa-trash-alt
	  	{
	  		font-size: 1.8rem;
	  	}
	  	#deletebtn
	  	{
	  		margin-right: 15px;
	  		margin-top: 15px;
	  		background: none;
			padding: 0px;
			border: none;
			outline:none;
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
		<div class="container mt-3 bg-dark" style="background-image: url('img/bg01.jpeg');">
			<div class="row mb-5 mt-4">
				 <div class="col-md-12 my-5">
				 		<div class="m-auto border rounded imgDiv">
				 			<div class="py-3 text-center">
				 				<img class="rounded-circle img-thumbnail" src='
								<?php 
									require("classes/db.php");

									require("classes/view.php");

									$viewClass = new View();
									echo $viewClass->getProfilePicture($_GET["id"]);
								?>' width="80" height="80" />
				 			</div>
							<a class='dashboardnames' href='account.php?uid=<?php echo $_GET["id"];?>'><h2 class="py-2 text-center"><?php echo $viewClass->getName($_GET["id"]);?></h2></a>
							<?php 
								echo $viewClass->getPicture($_GET["pictureID"]);
							?>
							<?php 
								if(isset($_POST["deleteimg"]))
								{
									$viewClass->deleteImage($_GET["pictureID"]);

									header("Location: account.php?uid=".$_SESSION['UID']."");
								}
								
								if($_GET["id"] != $_SESSION["UID"])
								{
									echo "<div class='input-group'>";
											echo "<div style='width: 80%; word-break: break-all;'>".$viewClass->getAutograph($_GET['pictureID'])."</div>";
											echo "<div style='width: 20%;'>".$viewClass->getLikeButton($_GET['id'], $_SESSION['UID'], $_GET['pictureID'])."</div>";
									echo "</div>";
								}
								else
								{
									echo "<form method='POST' action=''>";
										echo "<div class='input-group'>";
												echo "<div style='width: 80%; word-break: break-all;'>".$viewClass->getAutograph($_GET['pictureID'])."</div>";
												echo "<div style='width: 20%;'><button type='submit' name='deleteimg' id='deletebtn' class='ml-4'><i id='l' class='fas fa-trash-alt'></i></button></div>";
										echo "</div>";
									echo "</form>";
								}
							?>
							<hr>
							<?php
								require("classes/comment.php");

								$commentClass = new Comment();

								if(isset($_POST["comment"]))
					 			{
					 				$commentClass->setComment($_GET["pictureID"], $_SESSION["UID"], $_GET["id"], $_POST["comment"]);
					 			}

								$commentClass->getComments($_GET["pictureID"]);

							?>
							<form method="POST" action="">
								<div class="input-group pb-3 px-4">
									<input type="text" placeholder="hozzászólás..." class="form-control comment" name="comment"/>
						 		</div>
					 		</form>
	  					</div>
				 </div>
			</div>
		</div>
		<script type="text/javascript">
		$(function()
		{
			var btn = $("#likebtn");

			btn.on('click', function()
			{
				if(btn.attr("name") == "1")
				{
					$("#l").animate({fontSize: '2.5em'}, "fast");
					$("#l").animate({fontSize: '1.8rem'}, "fast");

					
					var uid = <?php echo $_SESSION["UID"];?>;
					var fid = <?php echo $_GET["id"];?>;
					var pictureID = <?php echo $_GET["pictureID"];?>;
					$.ajax
					({
						url: 'classes/like.php',
						type: 'post',
						data:
						{
							uid: uid,
							fid: fid,
							pictureID: pictureID,
							f: 1
						},
						success: function(e)
						{
							$("#l").attr("style","color: red;");
							btn.attr("name","0");
						}
					});
				}
				else
				{
					$("#l").animate({fontSize: '2.5em'}, "fast");
					$("#l").animate({fontSize: '1.8rem'}, "fast");

					var uid = <?php echo $_SESSION["UID"];?>;
					var fid = <?php echo $_GET["id"];?>;
					var pictureID = <?php echo $_GET["pictureID"];?>;
					$.ajax
					({
						url: 'classes/like.php',
						type: 'post',
						data:
						{
							uid: uid,
							fid: fid,
							pictureID: pictureID,
							f: 0
						},
						success: function(e)
						{
							$("#l").attr("style","color: black;");
							btn.attr("name","1");
						}
					});
				}
			});
		});
	</script>
</body>
</html>