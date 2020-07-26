<?php

	require("db.php");
	class Follow extends Connection
	{
		function __construct()
		{
			parent::__construct();
		}

		function follow($uid, $fid)
		{
			$sql = $this->con->prepare("INSERT INTO follows (FID, UID) VALUES(?,?);");
			$sql->bindParam(1, $fid);
			$sql->bindParam(2, $uid);

			$sql->execute();
		}
		function unFollow($uid, $fid)
		{
			$sql = $this->con->prepare("DELETE FROM follows WHERE UID = ? AND FID = ?;");
			$sql->bindParam(1, $uid);
			$sql->bindParam(2, $fid);

			$sql->execute();
		}
		function setNotification($uid, $fid)
		{
			$sql = $this->con->prepare("INSERT INTO `notifications` (`uid`, `fid`, `type`, `time`) VALUES (?, ?, 'follow', CURRENT_TIMESTAMP);");
			$sql->bindParam(1, $uid);
			$sql->bindParam(2, $fid);

			$sql->execute();
		}
		function unsetNotification($uid, $fid)
		{
			$sql = $this->con->prepare("DELETE FROM `notifications` WHERE uid = ? AND fid = ? AND type = 'follow';");
			$sql->bindParam(1, $uid);
			$sql->bindParam(2, $fid);

			$sql->execute();
		}
	}
	$followClass = new Follow();

	if($_POST["f"] == 1)
	{
		$followClass->follow($_POST["uid"], $_POST["fid"]);
		$followClass->setNotification($_POST["uid"], $_POST["fid"]);
	}
	else
	{
		$followClass->unFollow($_POST["uid"], $_POST["fid"]);
		$followClass->unsetNotification($_POST["uid"], $_POST["fid"]);
	}
?>