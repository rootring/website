<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST["login_button"])) {
		$_SESSION["username"] = $_POST["username"];
		$_SESSION["password"] = $_POST["password"];
		header("Location:login.php");
		exit();
	} else if (isset($_POST["register_button"])) {
		header("Location:register.php");
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
		<form action="index.php" method="post">
			username: <input type="text" name="username"> <br>
			password: <input type="password" name="password"> <br>
			login: <input type="submit" name="login_button" value="login">
			register: <input type="submit" name="register_button" value="register">
		</form>

		<?php include "footer.html";?>
	</body>
</html>
