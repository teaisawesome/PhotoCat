<?php 
	//require("view.php");

	class Dashboard extends Connection
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
		function getAllImages()
		{
			$sql = $this->con->prepare("SELECT * FROM pictures;");
			$sql->execute();

			$result = $sql->fetchAll(PDO::FETCH_ASSOC);

			$viewClass = new View();
			foreach ($result as $item)
			{
				echo "<div class='col-md-12 my-5'>";
					 		echo "<div class='m-auto border rounded imgDiv'>";
							echo "<div class='py-3 text-center'>";
				 				echo "<img class='rounded-circle img-thumbnail' src='".$viewClass->getProfilePicture($item["UID"])."' width='80' height='80' />";
				 			echo "</div>";
				 			echo "<a class='dashboardnames' href='account.php?uid=".$item["UID"]."'><h3 class='py-2 text-center'>".$viewClass->getName($item["UID"])."</h3></a>";
							
							echo "<a href='check.php?id=".$item["UID"]."&pictureID=".$item["pictureID"]."'>".$this->getPicture($item["pictureID"])."</a>";
							echo "</div>";
				echo "</div>";
			}
		}
	}

?>