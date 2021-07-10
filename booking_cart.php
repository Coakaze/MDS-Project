<?php
include("partials/header.php");
//echo $_SERVER['PHP_SELF'];
if (!isset($_SESSION)) {
    session_start();
}
?>
<style media="screen">
@media screen and (max-width: 520px){
.title{
  font-size: 33px;
}

.d-flex{
  flex-direction: column !important;
  justify-content: center;
  align-items: center;
}

.add{
  padding-left: 0 !important;
}

.my-5{
  margin: 20px 0 !important;
}

h4{
  font-size: 22px;
}
}

@media screen and (max-width: 290px){
  .title{
    font-size: 28px;
  }
}
.spaceTop2 {
    margin-top: 100px;
}
</style>
<div class="spaceTop2"></div>
<section class="cart mt-4">
<div class=" d-flex flex-row justify-content-between">
		<div class="add my-5 pl-5">
			<a href="index.php"><button class="btn btn-warning rounded-pill text-dark px-5">Main page</button></a>
		</div>
		<div class="add my-5 pl-5 mr-5">
			<a href="booking.php"><button class="btn btn-warning rounded-pill float-end text-dark px-5">Book now!</button></a>
		</div>
	</div>
    <h1 class="title text-center my-5">Your booking cart</h1>
    <div class="container">
        <div class="row mt-5 mb-3 border border-5 rounded">
            <div class="col-md">
                Room
            </div>
            <div class="col-md">
                Check In
            </div>
            <div class="col-md">
                Check Out
            </div>
            <div class="col-md">
                Price
            </div>
            <div class="col-md">
                Nights
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
$userId = $_SESSION['user'];
$query = "SELECT bookingCartId, roomID, dateFrom, dateTo, price, nights FROM bookingcart WHERE userID = '$userId';";
$result = $db->query($query);
$num_results = $result->num_rows;
$totalPrice = 0;
if ($num_results > 0) {
    for ($i = 0; $i < $num_results; $i++) {
        $row = $result->fetch_assoc();
        $nPers = $row['roomID'];
        $query2 = "SELECT numberPerson FROM room_type WHERE roomID = '$nPers';";
        $numberPerson = $db->query($query2);
        $numberPerson2 = $numberPerson->fetch_assoc();
        $totalPrice = $totalPrice + $row['price'];
        echo '<div class="container">';
        echo '<div class="row my-3">';
        echo '<div class="col-md mt-2">';
        echo 'Room for ' . $numberPerson2['numberPerson'];
        echo '</div>';
        echo '<div class="col-md mt-2">';
        echo $row['dateFrom'];
        echo '</div>';
        echo '<div class="col-md mt-2">';
        echo $row['dateTo'];
        echo '</div>';
        echo '<div class="col-md mt-2">';
        echo $row['price'] . '$';
        echo '</div>';
        echo '<div class="col-md mt-2">';
        echo $row['nights'];
        echo '</div>';
        echo '<div class="col-md">';
        echo '<form action="booking_cart.php" method="post" id="reg-form">';
        echo '<button name="delete" id="submit_room" value="' . $row['bookingCartId'] . '" type="submit" class="btn btn-danger rounded-pill text-white deletebtn">Delete</button>'; ///button cu nume
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p class="text-center">Your cart is empty!</p';
}


if (isset($_POST['delete'])) {
    $deleteId = $_POST['delete'];
    $query_delete = "DELETE FROM bookingcart WHERE bookingCartId = '$deleteId';";
    $db->query($query_delete);
    header("location:booking_cart.php");
}

?>
<div class="container">
    <div class="container mt-5">
        <h4 class="float-right fw-normal">Total: <?php echo $totalPrice ?> $</h4>
    </div>
    <form action="booking_cart.php" method="post" id="reg-form">
        <div class="container mt-5">
            <button name="book_now" id="book" value="booked" type="submit" class="btn btn-warning rounded-pill text-dark px-3">Book now!</button>
        </div>
    </form>
</div>


<?php
if (isset($_POST['book_now'])) {
    include("model.php");
    echo $_POST['book_now'];
    $query = "SELECT bookingCartId, roomID, dateFrom, dateTo, price, nights FROM bookingcart WHERE userID = '$userId';";
    $result = $db->query($query);
    $num_results = $result->num_rows;
    $totalPrice = 0;
    for ($i = 0; $i < $num_results; $i++) {
        $row = $result->fetch_assoc();
        $dateFrom = $row['dateFrom'];
        $dateTo = $row['dateTo'];
        $roomId = $row['roomID'];
        $price = $row['price'];
        $query_insert = "INSERT INTO booking (ID, userID, dateFrom, dateTo, roomId, price, bookingStatusId) VALUES ('', '$userId', '$dateFrom', '$dateTo', '$roomId', '$price', 'pending');";
        $db->query($query_insert);

        $query_delete = "DELETE FROM bookingcart WHERE userID = '$userId';";
        $db->query($query_delete);
        header("location:booking_cart.php");
    }
}
require("makepdf.php");
include("partials/footer.php");
?>
