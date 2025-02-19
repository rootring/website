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
			$username = $_SESSION["username"] ?? null;
			$password = $_SESSION["password"] ?? null;
			
			include "add_to_db.php";
			if (check_user($username, $password)) {
				echo "welcome back, $username";
			} else {
				echo "failed to login to user: $username";
			}
		?>

		<?php include "footer.html";?>
	</body>
</html>
