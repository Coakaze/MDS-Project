<?php
include("session.php");

?>
<!DOCTYPE html>
<html>

<head>
	<title>Sunlight</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/app.css">
	<link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,300;0,400;0,500;1,300;1,400&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/menu.css">
</head>

<body class="mainPage">
	<div class="header">
		<nav class="">
			<div class="logo">Sunlight</div>
			<ul class="links">
				<li><a href="index.php">Acasa</a></li>
			
				if (isset($_SESSION['user'])) {
					echo "<li><a href='logout-process.php'>Logout</a></li>";
					echo "<li><a href='profile.php'>Profile</a></li>";
				} else {
					echo "<li><a href='login.php'>Login</a></li>";
					echo "<li><a href='admin/login.php'>Login as admin</a></li>";
				}
				?>
				
			</ul>
			<label for="nav-toggle" class="icon-burger">
				<div class="line"></div>
				<div class="line"></div>
				<div class="line"></div>
			</label>
		</nav>
	</div>
	<div class="mainheader container-fluid">
		<section class="header-text">
			<h1 class="main text-center text-white display-3 main-text">Hotel Sunlight</h1>
			<section class="button-area text-center">
				<?php
				if (!isset($_SESSION['user'])) {
					echo "<a href='register.php'><button type='button' class='btn btn-light btn-lg m-2'>Register</button></a>";
				}
				?>
				<?php
				if (isset($_SESSION['user'])) {
					echo "<a href='logout-process.php'><button type='button' class='btn btn-light btn-lg m-2'>Logout</button></a>";
					echo "<a href='profile.php'><button type='button' class='btn btn-light btn-lg m-2'>Profile</button></a>";
				} else {
					echo "<a href='login.php'><button type='button' class='btn btn-light btn-lg m-2'>Login</button></a>";
					echo "<a href='admin/index.php'><button type='button' class='btn btn-light btn-lg m-2'>Login as admin</button></a>";
				}
				?>
				<?php
				if (isset($_SESSION['user'])) {
					echo "<a href='booking.php'><button type='button' class='btn btn-light btn-lg m-2'>Book a room</button></a>";
				}
				?>
			</section>
		</section>
	</div>

<section class="descriere" id="descriere">
        <h1>Sunlight</h1>
        <hr class="style-one">
        <h2>Your perfect place</h2>
        <p>Elegance and comfort...you will enjoy them fully if you visit the Sunlight Hotel in Mamaia, already a name with tradition , counting over a decade of excellence and experience in the field. Ideally located, just a few minutes away from the admirable tourist and sea attractions, famous restaurants and chirky shops, offering an incredible panorama over the whole city, Sunlight Hotel is the style brand dedicated to the modern and sophisticated tourist. Our guests will discover the pleasant atmosphere, the elegance and refinement of accommodation spaces, the professionalism of some flawless services aimed at satisfying the highest demands of the modern tourist, all in a special location, an expression of absolute comfort.</p>
    </section>

<!-- Carousel wrapper -->
<div
  id="carouselBasicExample"
  class="carousel slide carousel-fade"
  data-mdb-ride="carousel"
>
  <!-- Indicators -->
  <div class="carousel-indicators">
    <button
      type="button"
      data-mdb-target="#carouselBasicExample"
      data-mdb-slide-to="0"
      class="active"
      aria-current="true"
      aria-label="Slide 1"
    ></button>
    <button
      type="button"
      data-mdb-target="#carouselBasicExample"
      data-mdb-slide-to="1"
      aria-label="Slide 2"
    ></button>
    <button
      type="button"
      data-mdb-target="#carouselBasicExample"
      data-mdb-slide-to="2"
      aria-label="Slide 3"
    ></button>
  </div>

  <!-- Inner -->
  <div class="carousel-inner">
    <!-- Single item -->
    <div class="carousel-item active">
      <img
        src="https://mdbootstrap.com/img/Photos/Slides/img%20(15).jpg"
        class="d-block w-100"
        alt="..."
      />
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>
          Nulla vitae elit libero, a pharetra augue mollis interdum.
        </p>
      </div>
    </div>

    <!-- Single item -->
    <div class="carousel-item">
      <img
        src="https://mdbootstrap.com/img/Photos/Slides/img%20(22).jpg"
        class="d-block w-100"
        alt="..."
      />
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        </p>
      </div>
    </div>

    <!-- Single item -->
    <div class="carousel-item">
      <img
        src="https://mdbootstrap.com/img/Photos/Slides/img%20(23).jpg"
        class="d-block w-100"
        alt="..."
      />
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>
          Praesent commodo cursus magna, vel scelerisque nisl consectetur.
        </p>
      </div>
    </div>
  </div>
  <!-- Inner -->

  <!-- Controls -->
  <button
    class="carousel-control-prev"
    type="button"
    data-mdb-target="#carouselBasicExample"
    data-mdb-slide="prev"
  >
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button
    class="carousel-control-next"
    type="button"
    data-mdb-target="#carouselBasicExample"
    data-mdb-slide="next"
  >
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<section class="descriere" id="descriere2">
    <h1>Our offers</h1>
    <hr class="style-one">
    <h2>You need to be logged in to make a reservation.</h2>
</section>
<?php

$hostname = "localhost";
$dbname = "hotel";
$username = "root";
$password = "";

$rooms = array();

$db = new mysqli($hostname, $username, $password, $dbname);
						if ($db->connect_error) {
							die("Connection failed" . $db->connect_error);
						}
$query = "SELECT roomID, roomNum, roomDesc, roomName, roomImage, price FROM room_type;";
$result = $db->query($query);
$num_results = $result->num_rows;

for ($i = 0; $i < $num_results; $i++) {
	$row = $result->fetch_assoc();
	$index = $row['roomID'];
	$rooms[$row['roomDesc']] = array();
	$rooms[$row['roomDesc']][0] = $row['roomImage'];
	$rooms[$row['roomDesc']][1] = $row['roomName'];
	$rooms[$row['roomDesc']][2] = $row['price'];
	$rooms[$row['roomDesc']][3] = $row['roomID'];
}

$rooms_number = count($rooms);

echo '<div class="container" id="offerts">';
echo '<div class="row gy-5 my-3">';
foreach ($rooms as $key => $values) {
	
    echo '<div class="col-4">';
        echo '<div class="card" id="cardDim" style="width: 18rem;">';
            echo '<img src="imagini/' . $values[0] . ' "class="card-img-top" alt="...">';
                echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $values[1] . '</h5>';
                    echo '<p class="card-text">' . $key . '</p>';
                    echo '<form action="booking.php" method="post" id="reg-form">';
                        echo '<div class="row">';
							echo '<div class="col-12">';
							    echo '<p class="card-text text-secondary mt-2 fs-1">Only ' . $values[2] . '$' . '/nigh</p>';
                            echo '</div>';
                        echo '</div>';
                    echo '</form>';
                echo '</div>';
        echo '</div>';
    echo '</div>';
	
}
echo '</div>';
echo '</div>';	

?>

<div class="tourist">
	<h1>Tourist attractions near our hotel!</h1>
</div>
<div class="mapouter">
		<div class="gmap_canvas"><iframe width="800" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q=mamaia%20atractii%20turistice&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://123movies-to.org/%22%3E</a><br><style>.mapouter{position:relative;text-align:right;height:500px;width:1080px;}</style><a href=" https://www.embedgooglemap.net/%22%3Eadding google map to wordpress</a>
				<style>
					.gmap_canvas {
						overflow: hidden;
						background: none !important;
						height: 500px;
						width: 800px;
					}
				</style>
		</div>
	</div>
<?php
	include("partials/footer.php");
?>