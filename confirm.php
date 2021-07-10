<?php
function redirect() {
    header('location:login.php');
    exit();
}

if(!isset($_GET['email']) || !isset($_GET['token'])) {
    redirect();
}   
else {
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

    $email = $db -> real_escape_string($_GET['email']);
    $token = $db -> real_escape_string($_GET['token']);

    $sql = $db -> query("SELECT ID FROM user WHERE email='$email' AND token='$token' AND emailConfirmed=0");
    if($sql->num_rows > 0){
        $db -> query("UPDATE user SET emailConfirmed=1, token='' WHERE email='$email'");
        redirect();
    } 
    else 
        redirect();
}

?>