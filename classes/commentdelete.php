<?php 

	require("db.php");
	class CommentDelete extends Connection
	{
		function __construct($CID)
		{
			parent::__construct();
			$sql = $this->con->prepare("DELETE FROM comments WHERE CID = ?;");
			$sql->bindParam(1, $CID);

			$sql->execute();
		}
	}

	$cclass = new CommentDelete($_GET["CID"]);
?>