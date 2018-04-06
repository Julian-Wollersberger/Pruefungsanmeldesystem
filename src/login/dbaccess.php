<?php
		$link = mysqli_connect("localhost", "root", "", "user_access");

		if(!$link)
		{
		  exit("Verbindungsfehler: ".mysqli_connect_error());
		}
?>
