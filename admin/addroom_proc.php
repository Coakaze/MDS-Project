<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['admin']))
    header("location:login.php");
else {

    function validate_text($text)
    {
        if (!empty($text)) {
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
    if ($db->connect_error) {
        die("Connection failed" . $db->connect_error);
    }

    $name = validate_text($_POST['name']);
    $roomNum = validate_text($_POST['roomNum']);
    $roomDesc = validate_text($_POST['desc']);
    $roomPers = validate_text($_POST['roomPers']);
    $price = validate_text($_POST['price']);
    $file = $_FILES['file'];

    $roomNum = intval($roomNum);
    $roomPers = intval($roomPers);
    $price = intval($price);

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');
    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = '../imagini/rooms/' . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                //header("Location:index.php?$fileName");
            } else {
                echo "Your file is too big!";
            }
        } else {
            echo "There was an error uploading your file!";
        }
    } else {
        header("location:index.php");
    }
    $fileNameNew = 'rooms/' . $fileNameNew;
    $query = "INSERT INTO room_type (roomID, roomNum, roomDesc, numberPerson, Price, roomImage, roomName) VALUES ('', '$roomNum', '$roomDesc', '$roomPers', '$price', '$fileNameNew', '$name');";
    //$query_ins = "INSERT INTO room_type (roomID, roomNum, roomDesc, numberPerson, Price, roomImage, roomName) VALUES ('', '', '', '', '', '', '');";
    $result = $db->query($query);
    if ($result) {
        header('location:rooms.php');
    }
}
