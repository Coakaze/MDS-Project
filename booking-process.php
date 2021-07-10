<?php
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

$db = new mysqli($hostname, $username, $password, $dbname);
if ($db->connect_error) {
    die("Connection failed" . $db->connect_error);
}

/*$dateFrom = $_POST['dateFrom'];
$dateTo = $_POST['dateTo'];*/
//$numberPerson = $_POST['numberPerson'];
if (isset($_POST['dateFrom'])) {
    $dateFrom = $_POST['dateFrom'];
    $_SESSION['dateFrom'] = $dateFrom;
    //echo $SESSION['dateFrom'];
}

if (isset($_POST['dateTo'])) {
    $dateTo = $_POST['dateTo'];
    $_SESSION['dateTo'] = $dateTo;
}

if (isset($_POST['numberPerson'])) {
    $numberPerson = $_POST['numberPerson'];
    $_SESSION['numberPerson'] = $numberPerson;
}
$userId = $_SESSION['user'];

if (isset($_POST['dateFrom']) && isset($_POST['dateTo']) && isset($_POST['numberPerson'])) {
    //$query_occRooms = "SELECT dateFrom, dateTo, roomId FROM booking WHERE dateFrom <= '$dateFrom' AND dateTo >= '$dateFrom' OR dateFrom >= '$dateFrom' AND dateFrom <= '$dateTo';";
    $query_occRooms = "SELECT booking.roomId, booking.dateFrom, booking.dateTo, room_type.roomNum, room_type.numberPerson FROM booking INNER JOIN room_type ON booking.roomId = room_type.roomID WHERE room_type.numberPerson = $numberPerson AND dateFrom <= '$dateFrom' AND dateTo >= '$dateFrom' OR room_type.numberPerson = $numberPerson AND dateFrom >= '$dateFrom' AND dateFrom <= '$dateTo';";
    $occRooms = $db->query($query_occRooms);
    $num_occRooms = $occRooms->num_rows;
    $fr_vector = array();
    for ($i = 0; $i < $num_occRooms; $i++) {
        $row = $occRooms->fetch_assoc();
        $fr_vector[$row['roomId']] = 0;
    }
    $occRooms = $db->query($query_occRooms);
    for ($i = 0; $i < $num_occRooms; $i++) {
        $row = $occRooms->fetch_assoc();
        $fr_vector[$row['roomId']]++;
    }
    echo '<br>';
    $query = "SELECT roomID, roomNum, roomDesc, roomName, roomImage, price FROM room_type WHERE numberPerson = '$numberPerson';";
    $result = $db->query($query);
    $num_results = $result->num_rows;
    for ($i = 0; $i < $num_results; $i++) {
        $row = $result->fetch_assoc();
        $index = $row['roomID'];
        if(!isset($fr_vector[$index]))
            $fr_vector[$index] = 0;
        if ($fr_vector[$index] < $row['roomNum']) {
            $rooms[$row['roomDesc']] = array();
            $rooms[$row['roomDesc']][0] = $row['roomImage'];
            $rooms[$row['roomDesc']][1] = $row['roomName'];
            $rooms[$row['roomDesc']][2] = $row['price'];
            $rooms[$row['roomDesc']][3] = $row['roomID'];
        }
    }
}
