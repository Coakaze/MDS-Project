<?php
if (!isset($_SESSION)) {
    session_start();
}
function validate_text($text) {
	if(!empty($text)) {
		$trimText = trim($text);
		$sanitizeText = filter_var($trimText, FILTER_SANITIZE_STRING);
		return $sanitizeText;
	}
	return "";
}

$hostname = "localhost";
$dbname = "hotel";
$username = "root";
$password = "";

/* $hostname = "eu-cdbr-west-03.cleardb.net";
$dbname = "heroku_34e98ba05778979";
$username = "ba1ca812e81380";
$password = "c91a7ad6"; */

$db = new mysqli($hostname, $username, $password, $dbname);
if($db -> connect_error) {
	die("Connection failed" . $db -> connect_error);
}

$username = validate_text($_POST['username']);
$password = validate_text($_POST['password']);

$query = "SELECT ID, username, password FROM admin WHERE username = '$username';";
$result = $db -> query($query);

$row = $result -> fetch_assoc();
if(!empty($row)) {
	if($password == $row['password']) {
		$_SESSION['admin'] = $row['ID'];
		header("location:index.php");
	}
	else {
		$_SESSION['wrongPass'] = 'true';
	}
}
else {
	$_SESSION['notRegistered'] = 'true';
}
$db -> close();
?>