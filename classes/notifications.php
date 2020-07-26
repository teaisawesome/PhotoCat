<?php
	//require("db.php");

	class Notifications extends Connection
	{
		function __construct()
		{
			parent::__construct();
		}

		function getName($uid)
		{
			$sql = $this->con->prepare("SELECT name FROM profile WHERE UID = ?;");

			$sql->bindParam(1, $uid);

			$sql->execute();

			$result = $sql->fetch(PDO::FETCH_ASSOC);

			return $result["name"];
		}
		function getImgPath($pictureID)
		{
			$sql = $this->con->prepare("SELECT pic_path FROM pictures WHERE pictureID = ?;");

			$sql->bindParam(1, $pictureID);

			$sql->execute();

			$result = $sql->fetch(PDO::FETCH_ASSOC);

			return $result["pic_path"];
		}

		function getNotifications($fid)
		{
			$sql = $this->con->prepare("SELECT * FROM notifications WHERE fid = ?;");

			$sql->bindParam(1, $fid);

			$sql->execute();

			$result = $sql->fetch(PDO::FETCH_NUM);

			if($result > 0)
			{
				$sql2 = $this->con->prepare("SELECT * FROM notifications WHERE fid = ? ORDER BY time DESC;");

				$sql2->bindParam(1, $fid);

				$sql2->execute();

				$result2 = $sql2->fetchAll(PDO::FETCH_ASSOC);

				foreach ($result2 as $item)
				{
					if($item["type"] == "follow")
					{
						echo "<h5><a class='notilinks' href='account.php?uid=".$item['uid']."'>".$this->getName($item["uid"])."</a> követni kezdett téged.<h5>";
						echo "<hr>";
					}
					else if($item["type"] == "like")
					{
						echo "<h5><a class='notilinks' href='account.php?uid=".$item['uid']."'>".$this->getName($item["uid"])."</a> kedveli a képedet. <a href='check.php?id=".$item["fid"]."&pictureID=".$item["pictureID"]."'><img class='border' src='".$this->getImgPath($item["pictureID"])."' height='50' /></a></h5>";
						echo "<hr>";
					}
					else
					{
						echo "<h5><a class='notilinks' href='account.php?uid=".$item['uid']."'>".$this->getName($item["uid"])."</a> kommentet fűzött a képed alá. <a href='check.php?id=".$item["fid"]."&pictureID=".$item["pictureID"]."'><img src='".$this->getImgPath($item["pictureID"])."' height='50' /></a></h5>";
						echo "<hr>";
					}
				}
			}
			else
			{
				echo "<h5 class='pb-2'>Még nem érkezett értesítésed.</h5>";
			}
		}
	}
 ?>