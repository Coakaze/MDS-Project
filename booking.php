<?php
$msg = "";
$numbers = array();
include("session.php");
include("partials/header.php");
if (!isset($_SESSION['user'])) {
	header("location:index.php");
}
?>

<section id="booking">
	<div class="d-flex flex-row justify-content-between spaceTop">
		<div class="my-5 pl-5 mr-5">
			<a href="booking_cart.php"><button class="btn btn-warning rounded-pill float-end text-dark px-5">Your cart</button></a>
		</div>
	</div>

	<?php
	if ($msg != "")
		echo "<p class='text-success pb-0 pt-2'>$msg</p>";
	?>
	<div class="d-flex justify-content-center">
		<form action="booking.php" method="post" id="reg-form">
			<div class="container">
				<h1 class="text-center my-5">Book a room now!</h1>
				<?php
				if (isset($_POST['book']))
					echo "<p class='text-success pb-0 pt-2 text-center fs-6'>You cart has been updated!</p>";
				?>
				<p class="text-danger warning_date">Please enter a valid date!</p>
				<div class="row gy-5 my-5">
					<div class="col-3">
						<label for="dateFrom">Check In</label>
						<input type="date" onkeydown="return false" name="dateFrom" id="dateFrom" class="form-control inline" required="" value="<?php if (isset($_POST['dateFrom'])) {
																																						echo htmlentities($_POST['dateFrom']);
																																					} ?>">
					</div>
					<div class="col-3">
						<label for="dateFrom">Check out</label>
						<input type="date" onkeydown="return false" name="dateTo" id="dateTo" class="form-control inline dateR" required="" value="<?php if (isset($_POST['dateTo'])) {
																																						echo htmlentities($_POST['dateTo']);
																																					} ?>">
					</div>
					<div class="col-3">
						<?php
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
						$query = "SELECT numberPerson FROM room_type GROUP BY numberPerson;";
						$result = $db->query($query);
						$numbers = array();
						for ($i = 0; $i < $result->num_rows; $i++) {
							$row = $result->fetch_assoc();
							$numbers[$i] = $row['numberPerson'];
						}
						?>
						<label for="numberPerson">Number of people</label>
						<select name="numberPerson" id="numberPerson" class="form-control inline" required value="<?php if (isset($_POST['numberPerson'])) {
																														echo htmlentities($_POST['numberPerson']);
																													} ?>">
							<option value="" disabled selected>Number</option>
							<?php
							foreach ($numbers as $value) {
								echo '<option value="' . $value . '">' . $value . '</option>';
							}
							?>

						</select>
					</div>
					<div class="col-3 mt-4 pt-2 text-center">
						<button id="submit_booking" name="submit_booking" type="submit" class="btn btn-warning rounded-pill text-dark px-5">Show rooms</button>
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST['submit_booking'])) {
			require('generate_cards.php');
		}
		/*if($_SERVER['PHP_SELF'] == '/Hotel/booking.php') {
		require('generate_cards.php');*/ else {
			$hostname = "localhost";
			$dbname = "hotel";
			$username = "root";
			$password = "";

			$db = new mysqli($hostname, $username, $password, $dbname);
			if ($db->connect_error) {
				die("Connection failed" . $db->connect_error);
			}
			$roomId = $_POST['book'];
			$query1 = "SELECT price FROM room_type where roomID = '$roomId'";
			$result1 = $db->query($query1);
			$rowPrice = $result1->fetch_assoc();
			$price = $rowPrice['price'];

			$dateFrom = $_SESSION['dateFrom'];
			$dateTo = $_SESSION['dateTo'];
			$dateDiff = strtotime($dateTo) - strtotime($dateFrom);
			$numberDays = $dateDiff / (60 * 60 * 24);

			$price = $price * $numberDays;
			$userId = $_SESSION['user'];
			$query = "INSERT INTO bookingcart (bookingCartId, userID, roomID, dateFrom, dateTo, price, nights) VALUES ('', '$userId', '$roomId', '$dateFrom', '$dateTo', '$price', '$numberDays');";
			$result = $db->query($query);
		}
	}
	?>
</section>

<?php
include("partials/footer.php");
?>