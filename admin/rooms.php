<?php
include("header.php");
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['admin'])) {
    header('location:login.php');
}
?>

<section class="cart mt-4">
    <div class="my-5 pl-5">
        <a href="index.php"><button class="btn btn-warning rounded-pill text-dark px-5">Admin page</button></a>
    </div>
    <h1 class="text-center my-5">All rooms</h1>
    <div class="d-flex flex-row justify-content-between">
        <div class="container">
            <div class="row mt-5 mb-3 border border-5 rounded">
                <div class="col-md">
                    Room
                </div>
                <div class="col-md">
                    Image
                </div>
                <div class="col-md">
                    Number of rooms
                </div>
                <div class="col-md">
                    RoomDesc
                </div>
                <div class="col-md">
                    numberPerson
                </div>
                <div class="col-md">
                    Price
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
$query = "SELECT roomID, roomNum, roomDesc, numberPerson, price, roomImage, roomName FROM room_type;";
$result = $db->query($query);
$num_results = $result->num_rows;
for ($i = 0; $i < $num_results; $i++) {
    $row = $result->fetch_assoc();
    echo '<div class="container">';
    echo '<div class="row border-bottom">';
    echo '<div class="col-md mt-2">';
    echo $row['roomName'];
    echo '</div>';
    echo '<div class="col-md mt-2">';
    echo '<img src="../imagini/' . $row['roomImage'] . '" class="img-rooms card-img-top" alt="...">';
    echo '</div>';
    echo '<div class="col-md mt-2">';
    echo $row['roomNum'];
    echo '</div>';
    echo '<div class="col-md mt-2">';
    echo $row['roomDesc'];
    echo '</div>';
    echo '<div class="col-md mt-2">';
    echo $row['numberPerson'];
    echo '</div>';
    echo '<div class="col-md mt-2">';
    echo $row['price'];
    echo '</div>';
    echo '<div class="col-md">';
    echo '<form action="rooms.php" method="post" id="reg-form">';
    echo '<button name="delete_room" id="delete_room" value="' . $row['roomID'] . '" type="submit" class="btn btn-danger rounded-pill text-white deletebtn">Delete</button>'; ///button cu nume
    echo '</form>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
include("../partials/footer.php");
?>
<div class="container mt-5">
    <a href="addroom.php"><button name="new_room" id="new_room" value="new_room" type="submit" class="btn btn-warning rounded-pill text-dark px-3">Add new room!</button></a>
</div>

<div class="myblock" style="height: 300px;"></div>

<?php
if (isset($_POST['delete_room'])) {
    $deleteId = $_POST['delete_room'];
    $query_delete = "DELETE FROM room_type WHERE roomID = '$deleteId';";
    $db->query($query_delete);
    //header('Refresh:0');
}
?>