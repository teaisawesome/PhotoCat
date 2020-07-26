<?php
	//require("db.php");
	class ProfileInfos extends Connection
	{
		function __construct()
		{
			parent::__construct();
		}

		function getProfilePicture($UID)
		{
			$sql = $this->con->prepare("SELECT profile_pic_path FROM profile WHERE UID = ?");
			$sql->bindParam(1, $UID);

			$sql->execute();

			$result =  $sql->fetch(PDO::FETCH_ASSOC);

			if($result > 0)
			{
				return $result["profile_pic_path"];
			}
			else
			{
				return "profile_pictures/default.jpeg";
			}
		}
		function getFollowButton($fid, $uid)
		{
			$sql = $this->con->prepare("SELECT * FROM follows WHERE FID = ? AND UID = ?;");
			$sql->bindParam(1, $fid);
			$sql->bindParam(2, $uid);

			$sql->execute();

			$result = $sql->fetch(PDO::FETCH_NUM);

			if($result > 0)
			{
				return "<button class='btn btn-info' id='follow'>Követés visszavonása</button>";
			}
			else
			{
				return "<button class='btn btn-info' id='follow'>Követés</button>";
			}
		}
		function setProfilePicture($UID)
		{
			$target_dir="profile_pictures/";
			$target_file=$target_dir.$_FILES["file"]["name"];
			$file_type=pathinfo($target_file,PATHINFO_EXTENSION);

			if($_FILES["file"]["name"]!="")
			{
					if($file_type!="jpg" && $file_type!="png" && $file_type!="jpeg")
					{
						return "<p class='text-danger ml-2 mt-2'><i class='fas fa-exclamation-circle'></i>  Csak jpg-png-jpeg fájlformátumú képet tölthetsz fel!</p>";
					}
					else
					{
							if($file_type == "jpg" || $file_type == "jpeg")
							{
								move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

								$img = imagecreatefromjpeg($target_file);

								$cropped = "";
							
								if(imagesx($img) < imagesy($img))
								{
									$cropped = imagecrop($img, ['x' => 0, 'y' => 0, 'width' => imagesx($img), 'height' => imagesx($img)]);
								}
								elseif (imagesx($img) > imagesy($img))
								{
									$startOn = (imagesx($img) - imagesy($img)) / 2;
									$cropped = imagecrop($img, ['x' => $startOn, 'y' => 0, 'width' => imagesy($img), 'height' => imagesy($img)]);
								}
								else
								{
									$cropped = imagecrop($img, ['x' => 0, 'y' => 0, 'width' => imagesy($img), 'height' => imagesy($img)]);
								}

								if ($cropped != false)
								{
									$imgName = "profile_pictures/".uniqid().".jpeg";
								    imagejpeg($cropped, $imgName);
								    $delimg = explode("/", $target_file);
								    unlink("profile_pictures/".end($delimg));

								    $sql = $this->con->prepare("SELECT profile_pic_path FROM profile WHERE UID = ?");
									$sql->bindParam(1, $UID);

									$sql->execute();

									$result = $sql->fetch(PDO::FETCH_ASSOC);

									if($result > 0)
									{
										if($result["profile_pic_path"] != "profile_pictures/default.png")
										{
											unlink($result["profile_pic_path"]);
										}
										$sql2 = $this->con->prepare("UPDATE profile SET profile_pic_path = ? WHERE UID = ?");
										$sql2->bindParam(1, $imgName);
										$sql2->bindParam(2, $UID);

										$sql2->execute();
									}

									return true;
								}
							}
							else if($file_type == "png")
							{
								move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

								$img = imagecreatefrompng($target_file);

								$cropped = "";

								if(imagesx($img) < imagesy($img))
								{
									$cropped = imagecrop($img, ['x' => 0, 'y' => 0, 'width' => imagesx($img), 'height' => imagesx($img)]);
								}
								elseif (imagesx($img) > imagesy($img))
								{
									$startOn = (imagesx($img) - imagesy($img)) / 2;
									$cropped = imagecrop($img, ['x' => $startOn, 'y' => 0, 'width' => imagesy($img), 'height' => imagesy($img)]);
								}
								else
								{
									$cropped = imagecrop($img, ['x' => 0, 'y' => 0, 'width' => imagesy($img), 'height' => imagesy($img)]);
								}

								if ($cropped != false)
								{

									$imgName = "profile_pictures/".uniqid().".png";
								    imagepng($cropped, $imgName);
								   	$delimg = explode("/", $target_file);
								    unlink("profile_pictures/".end($delimg));

								    $sql = $this->con->prepare("SELECT profile_pic_path FROM profile WHERE UID = ?");
									$sql->bindParam(1, $UID);

									$sql->execute();

									$result = $sql->fetch(PDO::FETCH_ASSOC);

									if($result > 0)
									{
										if($result["profile_pic_path"] != "profile_pictures/default.png")
										{
											unlink($result["profile_pic_path"]);
										}
										$sql2 = $this->con->prepare("UPDATE profile SET profile_pic_path = ? WHERE UID = ?");
										$sql2->bindParam(1, $imgName);
										$sql2->bindParam(2, $UID);

										$sql2->execute();
									}

									return true;
								}
							}
					}
			}
			else
			{
				return true;
			}
		} 
		function getName($UID)
		{
			$sql = $this->con->prepare("SELECT name FROM profile WHERE UID = ?");
			$sql->bindParam(1, $UID);

			$sql->execute();

			$result =  $sql->fetch(PDO::FETCH_ASSOC);

			if($result > 0)
			{
				return $result["name"];
			}
		}
		function setName($UID, $name)
		{
			$sql = $this->con->prepare("UPDATE profile SET name = ? WHERE UID = ?");
			$sql->bindParam(1, $name);
			$sql->bindParam(2, $UID);

			$sql->execute();
		}
		function getBio($UID)
		{
			$sql = $this->con->prepare("SELECT bio FROM profile WHERE UID = ?");
			$sql->bindParam(1, $UID);

			$sql->execute();

			$result =  $sql->fetch(PDO::FETCH_ASSOC);

			if($result > 0)
			{
				return $result["bio"];
			}
			else
			{
				return "";
			}
		}
		function setBio($UID, $bio)
		{
			$sql = $this->con->prepare("UPDATE profile SET bio = ? WHERE UID = ?");
			$sql->bindParam(1, $bio);
			$sql->bindParam(2, $UID);

			$sql->execute();
		}
		function getLikesNumber($fid)
		{
			$sql = $this->con->prepare("SELECT COUNT(FID) FROM likes WHERE FID = ?;");
			$sql->bindParam(1, $fid);

			$sql->execute();

			$result =  $sql->fetch(PDO::FETCH_ASSOC);

			if($result > 0)
			{
				return $result["COUNT(FID)"];
			}
			else
			{
				return "0";
			}
		}
		function getFollowNumber($fid)
		{
			$sql = $this->con->prepare("SELECT COUNT(FID) FROM follows WHERE FID = ?;");
			$sql->bindParam(1, $fid);

			$sql->execute();

			$result =  $sql->fetch(PDO::FETCH_ASSOC);

			if($result > 0)
			{
				return $result["COUNT(FID)"];
			}
			else
			{
				return "0";
			}
		}
		function getImageNumber($fid)
		{
			$sql = $this->con->prepare("SELECT COUNT(UID) FROM pictures WHERE UID = ?;");
			$sql->bindParam(1, $fid);

			$sql->execute();

			$result =  $sql->fetch(PDO::FETCH_ASSOC);

			if($result > 0)
			{
				return $result["COUNT(UID)"];
			}
			else
			{
				return "0";
			}
		}
		function getCategoriesIntoSelect()
		{
			$sql = $this->con->prepare("SELECT category_id, category FROM categories;");

			$sql->execute();

			$result = $sql->fetchAll(PDO::FETCH_ASSOC);


			foreach ($result as $item)
			{
				echo "<option value='".$item['category_id']."'>".$item["category"]."</option>";
			}
		}
	}
?>