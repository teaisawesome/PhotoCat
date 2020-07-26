<?php 
	//require("view.php");

	class Category extends Connection
	{
		function __construct()
		{
			parent::__construct();
		}
		function getPicture($pictureID)
		{
			$sql = $this->con->prepare("SELECT pic_path FROM pictures WHERE pictureID = ?;");
			$sql->bindParam(1, $pictureID);
			$sql->execute();

			$result = $sql->fetch(PDO::FETCH_ASSOC);

			return "<img class='img-fluid d-block m-auto' src='".$result["pic_path"]."'/>"; 
		}
		function getPicturesByCategory($category_id)
		{
			$sql = $this->con->prepare("SELECT * FROM `categories` INNER JOIN pictures ON pictures.category_id = categories.category_id WHERE categories.category_id = ?");

			$sql->bindParam(1, $category_id);

			$sql->execute();

			$result = $sql->fetch(PDO::FETCH_NUM);


			if($result > 0)
			{
				$sql2 = $this->con->prepare("SELECT * FROM `categories` INNER JOIN pictures ON pictures.category_id = categories.category_id WHERE categories.category_id = ?");

				$sql2->bindParam(1, $category_id);

				$sql2->execute();

				$viewClass = new View();

				$categories = $sql2->fetchAll(PDO::FETCH_ASSOC);

				foreach ($categories as $item)
				{
					echo "<div class='col-md-12 my-5 nocategory'>";
						 		echo "<div class='m-auto border rounded imgDiv'>";
								echo "<div class='py-3 text-center'>";
					 				echo "<img class='rounded-circle img-thumbnail' src='".$viewClass->getProfilePicture($item["UID"])."' width='80' height='80' />";
					 			echo "</div>";
					 			echo "<a class='dashboardnames' href='account.php?uid=".$item["UID"]."'><h2 class='py-2 text-center'>".$viewClass->getName($item["UID"])."</h2>";
								
								echo "<a href='check.php?id=".$item["UID"]."&pictureID=".$item["pictureID"]."'>".$this->getPicture($item["pictureID"])."</a>";
								echo "</div>";
					echo "</div>";
				}
			}
			else
			{
				echo "<div class='col-md-12'><h1 class='text-center py-3 text-white'>Upsz.. Ebben a kategóriában még nincs kép!</h1></div>";
			}
		}
		function defineAllCategories()
		{
			$sql = $this->con->prepare("SELECT * FROM `categories`;");

			$sql->execute();

			$result = $sql->fetchAll(PDO::FETCH_ASSOC);

			foreach ($result as $item)
			{
				echo "<div class='col-md-3 text-center'>";
						echo "<a href='result.php?category_id=".$item["category_id"]."'><img class='img-fluid mb-3 border' src='".$item["category_img"]."'></a>";
						echo "<h3>".$item["category"]."</h3>";
				echo "</div>";
			}
		}
		function addNewCategory($categoryName)
		{
			$target_dir="category_pictures/";
			$target_file=$target_dir.$_FILES["file"]["name"];
			$file_type=pathinfo($target_file,PATHINFO_EXTENSION);

			if($_FILES["file"]["name"]!="")
			{
					if(!getimagesize($_FILES["file"]["tmp_name"]))
					{
						return "<span class='text-danger ml-2'><i class='fas fa-exclamation-circle'></i> Nem képet jelöltél ki!</span>";
					}
					elseif($file_type!="jpg" && $file_type!="png" && $file_type!="jpeg")
					{
						return "<span class='text-danger ml-2'><i class='fas fa-exclamation-circle'></i> Csak jpg-png-jpeg-gif fájformátumú képeket tölthetsz fel!</span>";
					}
					else
					{
							if($file_type == "jpg" || $file_type == "jpeg")
							{
								move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

								$im = imagecreatefromjpeg($target_file);

								$im2 = "";
							
								if(imagesx($im) < imagesy($im))
								{
									$im2 = imagecrop($im, ['x' => 0, 'y' => 0, 'width' => imagesx($im), 'height' => imagesx($im)]);
								}
								elseif (imagesx($im) > imagesy($im))
								{
									$startOn = (imagesx($im) - imagesy($im)) / 2;
									$im2 = imagecrop($im, ['x' => $startOn, 'y' => 0, 'width' => imagesy($im), 'height' => imagesy($im)]);
								}
								if ($im2 !== FALSE)
								{
									$imgName = "category_pictures/".uniqid().".jpeg";
								    imagejpeg($im2, $imgName);
								    $delimg = explode("/", $target_file);
								    unlink("category_pictures/".end($delimg));

								    //move_uploaded_file($_FILES["file"]["tmp_name"], 'img/'.$_FILES["file"]["name"]);
									$orgfile = $imgName;
									list($width, $height) = getimagesize($orgfile);
									$newfile = imagecreatefromjpeg($orgfile);
									$newwidth = 355;
									$newheight = 355;

									$thumb = 'category_pictures/'.uniqid().".jpeg";
									$truecolor = imagecreatetruecolor($newwidth, $newheight);
									imagecopyresampled($truecolor, $newfile, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
									imagejpeg($truecolor, $thumb, 100);
									unlink($orgfile);

									$sql = $this->con->prepare("INSERT INTO categories (category, category_img) VALUES(?,?);");
									$sql->bindParam(1, $categoryName);
									$sql->bindParam(2, $thumb);

									$sql->execute();
								}
							}
							else if($file_type == "png")
							{
								move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

								$im = imagecreatefrompng($target_file);
								
								$im2 = "";
								
								if(imagesx($im) < imagesy($im))
								{
									$im2 = imagecrop($im, ['x' => 0, 'y' => 0, 'width' => imagesx($im), 'height' => imagesx($im)]);
								}
								elseif (imagesx($im) > imagesy($im))
								{
									$startOn = (imagesx($im) - imagesy($im)) / 2;
									$im2 = imagecrop($im, ['x' => $startOn, 'y' => 0, 'width' => imagesy($im), 'height' => imagesy($im)]);
								}
								if ($im2 !== FALSE)
								{
									$imgName = "category_pictures/".uniqid().".png";
								    imagepng($im2, $imgName);
								    $delimg = explode("/", $target_file);
								    unlink("category_pictures/".end($delimg));

								    //move_uploaded_file($_FILES["file"]["tmp_name"], 'img/'.$_FILES["file"]["name"]);
									$orgfile = $imgName;
									list($width, $height) = getimagesize($orgfile);
									$newfile = imagecreatefrompng($orgfile);
									$newwidth = 355;
									$newheight = 355;

									$thumb = 'category_pictures/'.uniqid().".png";
									$truecolor = imagecreatetruecolor($newwidth, $newheight);
									imagecopyresampled($truecolor, $newfile, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
									imagepng($truecolor, $thumb, 100);
									unlink($orgfile);

									$sql = $this->con->prepare("INSERT INTO categories (category, category_img) VALUES(?,?);");
									$sql->bindParam(1, $categoryName);
									$sql->bindParam(2, $thumb);

									$sql->execute();
								}
							}
					}
			}
			else
			{
				return "<span class='text-danger ml-2'><i class='fas fa-exclamation-circle'></i> Kép megadása kötelező!</span>";
			}
		}
	}

?>