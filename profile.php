<?php

session_start();

if(!isset($_SESSION['user'])) {
	header("location:index.php");
}

$hostname = "localhost";
$dbname = "hotel";
$username = "root";
$password = "";
$connectedUser = $_SESSION['user'];

$db = new mysqli($hostname, $username, $password, $dbname);
if($db -> connect_error) {
	die("Connection failed" . $db -> connect_error);
}

$query = "SELECT ID, firstName, lastName, email, password, registerDate FROM user WHERE ID = '$connectedUser';";
$result = $db -> query($query);
$row = $result -> fetch_assoc();
include ('partials/header.php');

?>

<section id="main-site">
	<div class="container pt-5">
		<div class="row">
			<div class="col-6 shadow pt-2">
				<div class="user-info px-3">
					<ul class="navbar-nav h4">
						<li class="nav-link"><b>First Name:</b> <?php echo ucfirst($row['firstName']) ?></li>
						<li class="nav-link"><b>Last Name:</b> <?php echo ucfirst($row['lastName']) ?></li>
						<li class="nav-link"><b>Email:</b> <?php echo $row['email'] ?></li>
						<li class="nav-link"><b>Register date:</b> <?php echo $row['registerDate'] ?></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="my-5 pl-5">
			<a href="index.php"><button class="btn btn-warning rounded-pill text-dark px-5">Main page</button></a>
		</div>
	</div>
</section>

<?php

include ('partials/footer.php');

?>