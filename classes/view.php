<?php 
	//require("db.php");

	class View extends Connection
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
				return "img/default.jpg";
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
		function getPicture($pictureID)
		{
			$sql = $this->con->prepare("SELECT pic_path FROM pictures WHERE pictureID = ?;");
			$sql->bindParam(1, $pictureID);
			$sql->execute();

			$result = $sql->fetch(PDO::FETCH_ASSOC);

			return "<a href='".$result["pic_path"]."' data-lightbox='mygallery'><img class='img-fluid d-block m-auto' src='".$result["pic_path"]."'/></a>"; 
		}
		function getLikeButton($fid, $uid, $pictureID)
		{
			$sql = $this->con->prepare("SELECT * FROM likes WHERE FID = ? AND UID = ? AND pictureID = ?;");
			$sql->bindParam(1, $fid);
			$sql->bindParam(2, $uid);
			$sql->bindParam(3, $pictureID);

			$sql->execute();

			$result = $sql->fetch(PDO::FETCH_NUM);

			if($result > 0)
			{
				return "<button id='likebtn' class='ml-4' name='0'><i id='l' class='fas fa-heart' style='color: red;'></i></button>";
			}
			else
			{
				return "<button id='likebtn' class='ml-4' name='1'><i id='l' class='fas fa-heart' style='color: black;'></i></button>";
			}
		}
		function deleteImage($pictureID)
		{
			$sql = $this->con->prepare("DELETE FROM pictures WHERE pictureID = ?;");
			$sql->bindParam(1, $pictureID);

			$sql->execute();
		}
		function getAutograph($pictureID)
		{
			$sql = $this->con->prepare("SELECT autograph FROM pictures WHERE pictureID = ?;");

			$sql->bindParam(1, $pictureID);

			$sql->execute();

			$result = $sql->fetch(PDO::FETCH_ASSOC);

			return "<p class='m-3'>".$result["autograph"]."</p>";
		}
	}
?>