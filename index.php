<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>PhotoCat</title>
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
		<header>
			 <nav class="navbar navbar-expand-md bg-light navbar-light">
			  <!-- Brand -->
			  <a class="navbar-brand" href="index.php"><i class="fas fa-camera-retro"></i><span>PhotoCat</span></a>

			  <!-- Toggler/collapsibe Button -->
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			    <span class="navbar-toggler-icon"></span>
			  </button>
			  <!-- Navbar links -->
			  <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
			    <ul class="navbar-nav">
			      <li class="nav-item">
			        <a class="nav-link" href="index.php">Kezdőlap</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="loginpage.php">Belépés</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="registrationpage.php">Regisztráció</a>
			      </li> 
			    </ul>
			  </div>
			 </nav>
		</header>
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
		        <ol class="carousel-indicators">
		          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		          <li data-target="#myCarousel" data-slide-to="1"></li>
		          <li data-target="#myCarousel" data-slide-to="2"></li>
		        </ol>
	        	<div class="carousel-inner">
		          <div class="carousel-item active">
		            <div class="firstSlide"></div>
		            <div class="container">
		              <div class="carousel-caption caption1">
		                <h1>Éld meg a pillanatot.</h1>
		              </div>
		            </div>
		          </div>
		          <div class="carousel-item">
		            <div class="secoundSlide"></div>
		            <div class="container">
		              <div class="carousel-caption caption2">
		                <h1>Örökítsd meg.</h1>
		              </div>
		            </div>
		          </div>
		          <div class="carousel-item">
		            <div class="thirdSlide"></div>
		            <div class="container">
		              <div class="carousel-caption caption3">
		                <h1>Oszd meg.</h1>
		              </div>
		            </div>
		          </div>
		        </div>
		        <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
		          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		        </a>
		        <a class="carousel-control-next" href="#myCarousel" data-slide="next">
		          <span class="carousel-control-next-icon" aria-hidden="true"></span>
		        </a>
	      	</div>
	      	<div class="row">
	          <div class="col-md-4 text-center boxes">
	            <img class="rounded-circle border boxesImg" src="img/like.png" width="140" height="140">
	            <h2>Kedvencek</h2>
	            <p>Kedveld be minden olyan képet, ami megtetszik neked.</p>
	          </div>
	          <div class="col-md-4 text-center boxes">
	            <img class="rounded-circle border boxesImg" src="img/puppy.png" width="140" height="140">
	           	<h2>Kategóriák</h2>
	            <p>Rendezd kategórákba kedvenc képeidet! A kategória funkció segítségével egyszerűbben és hatékonyabban tudsz a képek között böngészni.</p>
	          </div>
	          <div class="col-md-4 text-center boxes">
	            <img class="rounded-circle border boxesImg" src="img/friends.jpg" alt="Generic placeholder image" width="140" height="140">
	            <h2>Ismerősök</h2>
	            <p>Oszd meg barátaiddal a legszebb képeidet. A követési funkció segítségével, a neked legjobban tetsző profilokak bekövetheted. </p>
	          </div>
	    	</div>
		<script type="text/javascript" src="js/isEmpty.js"></script>
</body>
</html>