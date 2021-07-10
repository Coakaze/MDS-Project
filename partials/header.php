<!DOCTYPE html>
<html>

<head>
	<title>Sunlight</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<link rel="stylesheet" href="css/menu.css">
	<link rel="stylesheet" href="css/app.css">
</head>

<body>
	<div class="header">
		<nav class="sticky2">
			<div class="logo">Sunlight</div>
			<ul class="links">
				<li><a href="index.php">Acasa</a></li>
				<?php
				if (isset($_SESSION['user'])) {
					echo "<li><a href='booking.php'>Book</a></li>";
				}
				?>
				<?php
				if (!isset($_SESSION['user'])) {
					echo "<li><a href='register.php'>Register</a></li>";
				}
				?>
				<?php
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

	<main id="main-area">