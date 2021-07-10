<?php

use PHPMailer\PHPMailer\PHPMailer;

$hostname = "localhost";
$dbname = "hotel";
$username = "root";
$password = "";

$db = new mysqli($hostname, $username, $password, $dbname);
if ($db->connect_error) {
    die("Connection failed" . $db->connect_error);
}

$subject = $_POST['emailSubject'];
$text = $_POST['emailText'];


$emails = "SELECT firstName, email FROM user;";
$result = $db->query($emails);
$num_results = $result->num_rows;

for ($i = 0; $i < $num_results; $i++) {
    $row = $result->fetch_assoc();
    $email = $row['email'];
    $name = $row['firstName'];
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
        $mail->Subject = $subject;
        $mail->Body = "Hello {$name}. We have news for you! <br><br>
        {$text}
    ";
        //$_SESSION['emailConfirm'] = 'true';
        $msg = "An account has been created. Please verify your email";
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

$db->close();
