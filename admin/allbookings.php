<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['admin'])) {
    header('location:login.php');
}
include("header.php");
?>

<section class="cart mt-4">
    <div class="my-5 pl-5">
        <a href="index.php"><button class="btn btn-warning rounded-pill text-dark px-5">Admin page</button></a>
    </div>
    <h1 class="text-center my-5">All bookings</h1>
    <div class="d-flex flex-row justify-content-between">
        <div class="container">
            <div class="row mt-5 mb-3 border border-5 rounded">
                <div class="col-md">
                    ID user
                </div>
                <div class="col-md">
                    Check In
                </div>
                <div class="col-md">
                    Check Out
                </div>
                <div class="col-md">
                    ID room
                </div>
                <div class="col-md">
                    Price
                </div>
                <div class="col-md">
                    Booking ID
                </div>
                <div class="col-md">
                    Action
                </div>
            </div>
        </div>
</section>
<?php
$hostname = "localhost";
$dbname = "hotel";
$username = "root";
$password = "";

$db = new mysqli($hostname, $username, $password, $dbname);
if ($db->connect_error) {
    die("Connection failed" . $db->connect_error);
}
$userId = $_SESSION['admin'];
$query = "SELECT ID, userID, dateFrom, dateTo, roomId, price, bookingStatusId FROM booking;";
$result = $db->query($query);
$num_results = $result->num_rows;
for ($i = 0; $i < $num_results; $i++) {
    $row = $result->fetch_assoc();
    echo '<div class="container">';
    echo '<div class="row border-bottom">';
    echo '<div class="col-md mt-2">';
    echo $row['userID'];
    echo '</div>';
    echo '<div class="col-md mt-2">';
    echo $row['dateFrom'];
    echo '</div>';
    echo '<div class="col-md mt-2">';
    echo $row['dateTo'];
    echo '</div>';
    echo '<div class="col-md mt-2">';
    echo $row['roomId'];
    echo '</div>';
    echo '<div class="col-md mt-2">';
    echo $row['price'];
    echo '</div>';
    echo '<div class="col-md mt-2">';
    echo $row['bookingStatusId'];
    echo '</div>';
    if ($row['bookingStatusId'] == 'pending') {
        echo '<div class="col-md">';
        echo '<form action="allbookings.php" method="post" id="reg-form">';
        echo '<button name="accept_booking" value="' . $row['ID'] . '" type="submit" class="btn btn-success rounded-pill text-white deletebtn">Accept</button>'; ///button cu nume
        echo '</form>';
        echo '</div>';
    }
    else {
        echo '<div class="col-md mt-2">';
        echo 'Accepted';
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
}
include("../partials/footer.php");
if(isset($_POST['accept_booking'])) {
    $ID = $_POST['accept_booking'];
    $query = "UPDATE booking SET bookingStatusId = 'accepted' WHERE ID = '$ID';";
    $result = $db -> query($query);
    if($result)
        header('location:allbookings.php');
}
?>