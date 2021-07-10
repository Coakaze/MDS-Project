<?php
$rooms = array();
if (!isset($_SESSION)) {
    session_start();
}
require('booking-process.php');
include("partials/header.php");
$rooms_number = count($rooms);
echo '<div class="container">';
    echo '<div class="row gy-5 my-3">';
foreach ($rooms as $key => $values) {
    echo '<div class="col-' . 12 / $rooms_number . '">';
        echo '<div class="card" style="width: 18rem;">';
            echo '<img src="imagini/' . $values[0] . ' "class="card-img-top" alt="...">';
                echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $values[1] . '</h5>';
                    echo '<p class="card-text">' . $key . '</p>';
                    echo '<form action="booking.php" method="post" id="reg-form">';
                        echo '<div class="row">';
							echo '<div class="col-8">';
							    echo '<button name="book" id="submit_room" value="' . $values[3] . '" type="submit" class="btn btn-warning rounded-pill text-dark">Book now!</button>';
                            echo '</div>';
							echo '<div class="col-6">';
							    echo '<p class="card-text text-secondary mt-2 fs-1">Only ' . $values[2] . '/night</p>';
                            echo '</div>';
                        echo '</div>';
                    echo '</form>';
                echo '</div>';
        echo '</div>';
    echo '</div>';
}
    echo '</div>';
echo '</div>';
/*if (isset($_POST['book'])) {
    echo $_SERVER['PHP_SELF'];
    $roomId = $_POST['book'];
    $query1 = "SELECT price FROM room_type where roomID = '$roomId'";
    $result1 = $db -> query($query1);
    $rowPrice = $result1 -> fetch_assoc();
    $price = $rowPrice['price'];

    $dateFrom = $_SESSION['dateFrom'];
    $dateTo = $_SESSION['dateTo'];
    $dateDiff = $dateTo - $dateFrom;
    $numberDays = $dateDiff / (60 * 60 * 24);
    echo round($dateDiff / (60 * 60 * 24));

    $numberPerson = $_SESSION['numberPerson'];
    $query = "INSERT INTO bookingcart (bookingCartId, userID, roomID, dateFrom, dateTo, price, nights) VALUES ('', '$userId', '$roomId', '$dateFrom', '$dateTo', '$price', '$numberDays');";
    $result = $db -> query($query);
}*/

?>