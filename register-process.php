<?php
use PHPMailer\PHPMailer\PHPMailer;

/* if(!isset($_SESSION)) 
    { 
        session_start(); 
	}  */

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


$db = new mysqli($hostname, $username, $password, $dbname);
if($db -> connect_error) {
	die("Connection failed" . $db -> connect_error);
}

$firstName = validate_text($_POST['firstName']);
$lastName = validate_text($_POST['lastName']);
$email = validate_email($_POST['email']);
$password = validate_text($_POST['password']);
$type = validate_text('student');
$adress = validate_text($_POST['adress']);

$select = "SELECT email FROM user WHERE email = '$email';";
$emaildb = $db -> query($select);
if($emaildb -> num_rows > 0) {
	$msg2 = "Email already used";
}
else {

	$token = 'qwertyuiopasdfghjklzxcvbnm0123456789!$/*';
	$token = str_shuffle($token);
	$token = substr($token, 0, 10);

	$hashed_pass = password_hash($password, PASSWORD_DEFAULT); 

	$query = "INSERT INTO user (ID, firstName, lastName, email, password, registerDate, token, type, adresa) VALUES ('', '$firstName', '$lastName', '$email', '$hashed_pass', NOW(), '$token', 'user', '$adress');";
	$result = $db -> query($query);

	//include_once "PHPMailer\PHPMailer\PHPMailer";

    $name = $_POST['firstName'];
    $email = $_POST['email'];

    require_once "PHPMailer/Exception.php";
    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'rotarumariancatalin1@gmail.com';
        $mail->Password   = '1973852852852cV@';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('rotarumariancatalin1@gmail.com', 'Rotaru');
        $mail->addAddress("$email");

        // Content
        $mail->isHTML(true);                                
        $mail->Subject = 'Validation email';
		$mail->Body = "Hello {$name}. Please click on the link below:<br><br>
			<a href='http://localhost/Hotel/confirm.php?email=$email&token=$token'>Confirm here!</a>
		";
		//$_SESSION['emailConfirm'] = 'true';
		$msg = "An account has been created. Please verify your email";
		$mail->send();
		/*if($mail->send())
		{
			$_SESSION['emailConfirm'] = 'true';
		}
		else 
		{
			echo "something wrong happened";
			exit();
		}*/
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

	/*if($result) {
		//echo $db -> affected_rows . "client inserted";
		header('location:register.php');
	}
	else {
		echo "An error has occured";
	}*/
	$db -> close();
}
?>