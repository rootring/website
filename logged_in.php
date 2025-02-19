<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
		<?php include "header.html"; ?>
		<?php
			session_start();
			$username = $_SESSION["username"];
			echo "welcome back, $username";
		?>

		<?php include "footer.html";?>
	</body>
</html>
