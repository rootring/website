<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST["register_button"])) {
			if (strlen($_POST["username"]) == 0) {
				echo "empty username";
			} elseif (strlen($_POST["email"]) == 0) {
				echo "empty email";
			} elseif (strlen($_POST["password"]) == 0) {
				echo "empty password";
			} else {
				include "add_to_db.php";
				$ret = register_user($_POST["username"], $_POST["email"], $_POST["password"]);
				if ($ret) {
					$username = $_POST["username"];
					echo "<br>";
					echo "$username registered successfully";
				} elseif ($ret == "EXISTS") {
					$username = $_POST["username"];
					echo "user $username already exists";
				} else {
					$username = $_POST["username"];
					echo "registration failed for $username";
				}
			}
		} elseif (isset($_POST["go_back"])) {
			header("Location:index.php");
			exit();
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
		<?php include "header.html"; ?>
		<form action="register.php" method="post">
			username: <input type="text" name="username"> <br>
			email: <input type="text" name="email"> <br>
			password: <input type="password" name="password"> <br>
			<input type="submit" name="register_button" value="register">
			<input type="submit" name="go back" value="go back">
		</form>

		<?php include "footer.html";?>
	</body>
</html>
