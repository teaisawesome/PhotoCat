<?php

	class Comment extends Connection
	{
		protected $commentCount = array();

		function __construct()
		{
			parent::__construct();
		}
		function setNotification($uid, $fid, $pictureID)
		{
			$sql = $this->con->prepare("INSERT INTO `notifications` (`uid`, `fid`, `type`, `pictureID`, `time`) VALUES (?, ?, 'comment', ?, CURRENT_TIMESTAMP);");
			$sql->bindParam(1, $uid);
			$sql->bindParam(2, $fid);
			$sql->bindParam(3, $pictureID);

			$sql->execute();
		}
		function setComment($pictureID, $UID, $fid, $comment)
		{

			$sql = $this->con->prepare("INSERT INTO comments (pictureID, UID, comment) VALUES (?, ?, ?);");

			$sql->bindParam(1, $pictureID);

			$sql->bindParam(2, $UID);
			
			$sql->bindParam(3, $comment);

			$sql->execute();

			$this->setNotification($UID, $fid, $pictureID);
		}
		function getComments($pictureID)
		{
			$sql = $this->con->prepare("SELECT * FROM comments WHERE pictureID = ?;");

			$sql->bindParam(1, $pictureID);

			$sql->execute();

			$result = $sql->fetchAll(PDO::FETCH_ASSOC);

			$view = new View();

			$i = 0;
			foreach ($result as $item)
			{
							echo "<div class='bg-light' style='word-break: break-all'>";
					 			echo "<p class='ml-4'><b>".$view->getName($item["UID"])."</b>: ".$item["comment"]."</p>";
							echo "</div>";
							echo "<hr>";
			}
		}
	}
?>