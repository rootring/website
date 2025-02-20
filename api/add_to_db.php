<?php

function register_user($username, $email, $password) {
	$host = getenv("POSTGRES_HOST");
	$db_user = getenv("POSTGRES_USER");
	$db_pass = getenv("POSTGRES_PASSWORD");
	$db_name = getenv("POSTGRES_DATABASE");
	$registration_status = false;

	$conn = new mysqli($host, $db_user, $db_pass, $db_name);

	if ($conn->connect_error) {
		die("Connection Failed: " . $conn->connect_error);;
	}

	$conn->close();
	$conn = new mysqli($host, $db_user, $db_pass, $db_name);

	$stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = ? OR email = ?");
	$stmt->bind_param("ss", $username, $email);
	$stmt->execute();
	$stmt->bind_result($count);
	$stmt->fetch();
	$stmt->close();
	if ($count > 0) {
		return "EXISTS";
	}

	$hashed_pw = hash("sha1", $password);
	$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
	$stmt->bind_param("sss", $username, $email, $hashed_pw);

	if ($stmt->execute()) {
		echo "New user was created";
		$registration_status = true;
	} else {
		echo "error creating new user: " . $stmt->error;
	}



	$conn->close();
	return $registration_status;
}

function check_user($username, $password) {
	$host = getenv("POSTGRES_HOST");
	$db_user = getenv("POSTGRES_USER");
	$db_pass = getenv("POSTGRES_PASSWORD");
	$db_name = getenv("POSTGRES_DATABASE");
	$registration_status = false;

	$conn = new mysqli($host, $db_user, $db_pass, $db_name);

	if ($conn->connect_error) {
		die("Connection Failed: " . $conn->connect_error);;
	}

	$conn->close();
	$conn = new mysqli($host, $db_user, $db_pass, $db_name);


	$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$stmt->bind_result($retrieved_pw);
	if ($stmt->fetch()) {
		$hashed = hash("sha1", $password);
		if ($hashed == $retrieved_pw) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
	$stmt->close();


	$conn->close();
	return $registration_status;
}

?>
