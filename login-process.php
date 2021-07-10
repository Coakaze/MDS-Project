<?php 
if(!isset($_SESSION)) 
    { 
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

function validate_email($email) {
	if(!empty($email)) {
		$trimText = trim($email);
		$sanitizeText = filter_var($trimText, FILTER_SANITIZE_EMAIL);
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

$email = validate_email($_POST['email']);
$password = validate_text($_POST['password']);

$query = "SELECT ID, email, password, emailConfirmed, adresa, lastName, firstName FROM user WHERE email = '$email';";
$result = $db -> query($query);

$row = $result -> fetch_assoc();
if(!empty($row)) {
	if(password_verify($password, $row['password'])) {
		if($row['emailConfirmed'] == 0)
			$msg = "Please verify your email!";
		else
		{
			$_SESSION['user'] = $row['ID'];
			$_SESSION['name'] = $row['lastName'] . " " . $row['firstName'];
			$_SESSION['adress'] = $row['adresa'];
			header("location:index.php");
		}
	}
	else {
		$_SESSION['wrongPass'] = 'true';
	}
}
else {
	$_SESSION['notRegistered'] = 'true';
}
/*if($result) {
		echo $db -> affected_rows . "client inserted";
	}
	else {
		echo "An error has occured";
	}*/
$db -> close();

?>