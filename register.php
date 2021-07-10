<?php
	$msg = "";
	$msg2 = "";
	include("partials/header.php");
	include("session.php");
	if(isset($_SESSION['user']))
		header("location:index.php");
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$secretKey = '6Lcz5P8ZAAAAAMq-q5t1nHMJxGNeU5FfL0VbMM4J';
   	 	$responseKey = $_POST['g-recaptcha-response'];
    	$userIP = $_SERVER['REMOTE_ADDR'];
    	$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
    	$response = file_get_contents($url);
		$response = json_decode($response);
		if($response -> success) {
			if($_SERVER['REQUEST_METHOD'] == 'POST') {
				require('register-process.php');
			}
		}
	}
?>
<head>
<link rel="stylesheet" type="text/css" href="css/app.css">
</head>

<div class="spaceTop"></div>
<section id="register">
	<div class="my-5 pl-5">
		
	</div>
	<div class="cont row m-O pt-0">
		<div class="col-lg-4 ">
			<div class="text-center pb-5">
				<h1 class="login-title text-dark">Register</h1>
				<p class="p-1 m-O font-ubuntu text-black-50">Register and enjoy aditional features</p>
				<span>I already have an account <a href="login.php">Login</a></span>
				<?php
						if($msg != "")
							echo "<p class='text-success pb-0 pt-2'>$msg</p>";
				?>
			</div>
		<div class="d-flex justify-content-center">
		<form action="register.php" method="post" id="reg-form">
			<div class="form-row">
				<div class="col">
					<input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name" required="" value = "<?php if(isset($_POST['firstName'])) {echo htmlentities($_POST['firstName']);}?>">
				</div>
				<div class="col">
					<input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name" required="" value = "<?php if(isset($_POST['lastName'])) {echo htmlentities($_POST['lastName']);}?>">
				</div>
			</div>
			<div class="form-row my-4">
				<div class="col">
					<input type="email" name="email" id="email" class="form-control" placeholder="Email" required="" value = "<?php if(isset($_POST['email'])) {echo htmlentities($_POST['email']);}?>">
				</div>
				<?php
					if($msg2 != "")
						echo "<p class='text-danger pb-0 pt-2'>$msg2</p>";
				?>
			</div>
			<div class="form-row my-4">
				<div class="col">
					<input type="password" name="password" id="password" class="form-control" placeholder="Password" required="" minlength="4">
				</div>
			</div>
			<div class="form-row my-4">
				<div class="col">
					<input type="password" name="conf_password" id="conf_password" class="form-control" placeholder="Confirm password" required="">
				</div>
			</div>
			<div class="form-row my-4">
				<div class="col">
					<input type="text" name="adress" id="adress" class="form-control" placeholder="Adress" required="" value = "<?php if(isset($_POST['adress'])) {echo htmlentities($_POST['adress']);}?>">
				</div>
			</div>
			<div class="warning text-danger">Password don't match</div>
			<div class="submit-btn text-center my-5">
				<button id="submit" type="submit" class="btn btn-warning rounded-pill text-dark px-5">Continue</button>
			</div>
			<div class="g-recaptcha" data-sitekey="6Lcz5P8ZAAAAAOD7bixWTMCvXPBBYC19NjySCStG"></div>
		</form>
		</div>
	</div>
	</div>
</section>

<?php
	include("partials/footer.php");
?>
