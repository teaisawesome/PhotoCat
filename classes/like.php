<?php
	require("db.php");

	class Like extends Connection
	{
		function __construct()
		{
			parent::__construct();
		}
		function like($fid, $uid, $pictureID)
		{
			$sql = $this->con->prepare("INSERT INTO likes (FID, UID, pictureID) VALUES(?,?,?);");
			$sql->bindParam(1, $fid);
			$sql->bindParam(2, $uid);
			$sql->bindParam(3, $pictureID);

			$sql->execute();
		}
		function unLike($fid, $uid, $pictureID)
		{
			$sql = $this->con->prepare("DELETE FROM likes WHERE FID = ? AND UID = ? AND pictureID = ?;");
			$sql->bindParam(1, $fid);
			$sql->bindParam(2, $uid);
			$sql->bindParam(3, $pictureID);

			$sql->execute();
		}
		function setNotification($fid, $uid, $pictureID)
		{
			$sql = $this->con->prepare("INSERT INTO `notifications` (`uid`, `fid`, `type`, `pictureID`, `time`) VALUES (?, ?, 'like', ?, CURRENT_TIMESTAMP);");
			$sql->bindParam(1, $uid);
			$sql->bindParam(2, $fid);
			$sql->bindParam(3, $pictureID);

			$sql->execute();
		}
		function unsetNotification($fid, $uid, $pictureID)
		{
			$sql = $this->con->prepare("DELETE FROM `notifications` WHERE fid = ? AND uid = ? AND type = 'like' AND pictureID = ?;");
			$sql->bindParam(1, $fid);
			$sql->bindParam(2, $uid);
			$sql->bindParam(3, $pictureID);

			$sql->execute();
		}
	}
	$likeClass = new Like();

	if($_POST["f"] == 1)
	{
		$likeClass->like($_POST["fid"], $_POST["uid"], $_POST["pictureID"]);
		$likeClass->setNotification($_POST["fid"], $_POST["uid"], $_POST["pictureID"]);
	}
	else
	{
		$likeClass->unLike($_POST["fid"], $_POST["uid"], $_POST["pictureID"]);
		$likeClass->unsetNotification($_POST["fid"], $_POST["uid"], $_POST["pictureID"]);
	}
?>