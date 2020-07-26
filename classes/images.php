<?php
	
	class Images extends Connection
	{
		function __construct()
		{
			parent::__construct();
		}
		function uploadImg($UID, $category_id, $autograph)
		{
			$target_dir="pictures/";
			$target_file=$target_dir.$_FILES["file"]["name"];
			$file_type=pathinfo($target_file,PATHINFO_EXTENSION);

			if($_FILES["file"]["name"]!="")
			{
					if(!getimagesize($_FILES["file"]["tmp_name"]))
					{
						return "<span class='text-danger pt-4'><i class='fas fa-exclamation-circle'></i> Nem képet jelöltél ki!</span>";
					}
					elseif($file_type!="jpg" && $file_type!="png" && $file_type!="jpeg" && $file_type!="gif")
					{
						return "<span class='text-danger pt-4'><i class='fas fa-exclamation-circle'></i> Csak jpg-png-jpeg-gif képet tölthetsz fel!</span>";
					}
					else
					{
							if($file_type == "jpg" || $file_type == "jpeg" || $file_type == "png" || $file_type == "gif")
							{
								$imgName = "pictures/".uniqid().".".$file_type;

								move_uploaded_file($_FILES["file"]["tmp_name"],$imgName);

								$sql = $this->con->prepare("INSERT INTO pictures (UID, pic_path, category_id, autograph) VALUES (?, ?, ?, ?);");
								$sql->bindParam(1, $UID);
								$sql->bindParam(2, $imgName);
								$sql->bindParam(3, $category_id);
								$sql->bindParam(4, $autograph);

								$sql->execute();

								header("Location: account.php?uid=".$UID."");
							}
					}
			}
			else
			{
				return "<span class='text-danger pt-4'><i class='fas fa-exclamation-circle'></i> Kép megadása kötelező!</span>";
			}
		}
		function getImages($UID)
		{
			$sql = $this->con->prepare("SELECT pictureID ,pic_path, autograph FROM pictures WHERE UID = ?;");
			$sql->bindParam(1, $UID);
			$sql->execute();

			$result = $sql->fetchAll(PDO::FETCH_ASSOC);

			foreach ($result as $item)
			{
				echo "<div class='row mb-5 mt-4'>";
					 echo "<div class='col-md-12 text-center mt-5'>";
					 		echo "<div class='m-auto imgDiv bg-light'>";
					 			echo "<a href='check.php?id=".$UID."&pictureID=".$item["pictureID"]."'><img class='img-fluid images' src='".$item["pic_path"]."'/></a>";
					 			if($item["autograph"] != "")
					 			{
					 				echo "<p class='text-left m-3' style='word-break: break-all;'>".$item["autograph"]."</p>";
					 			}
		  					echo "</div>";
					 echo "</div>";
				echo "</div>";
			}
		}
	}
?>