<?php
	require("db.php");

	class Main extends Connection
	{
		function __construct()
		{
			parent::__construct();
		}

		function getAllPicture()
		{
			$sql = $this->con->prepare("SELECT pic_path FROM pictures;");

			$sql->execute();

			$result = $sql->fetchAll(PDO::FETCH_ASSOC);

			$T = array();
			$k = 0;
			foreach ($result as $item)
			{
				$T[$k] = $item["pic_path"];
				$k++;
			}
			echo "<div class='col-md-6'>";
				for ($i=0; $i < count($T); $i+=2)
				{ 
					echo "<div class='m-auto mb-3 kepdiv'>";
						echo "<img class='img-fluid mb-4' src='".$T[$i]."'/>";
					echo "</div>";
				}
			echo "</div>";
			echo "<div class='col-md-6'>";
				for ($i=1; $i < count($T); $i+=2)
				{ 
					echo "<div class='m-auto mb-3 kepdiv'>";
						echo "<img class='img-fluid mb-4' src='".$T[$i]."'/>";
					echo "</div>";
				}
			echo "</div>";
		}
	}
?>