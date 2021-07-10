<?php
	$msg = "";
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
				require('login-process.php');
			}
		}
	}

?>
<head>
<link rel="stylesheet" type="text/css" href="css/app.css">
</head>
<div class="spaceTop"></div>

<section id="login-form">
	<div class="cont row m-O pt-2">
		<div class="col-lg-4 ">
			<div class="text-center pb-5">
				<h1 class="login-title text-dark">Login</h1>
				<p class="p-1 m-O font-ubuntu text-black-50">Login and enjoy</p>
				<span>Create a new account <a href="register.php">Register</a></span>
				<?php
						if($msg != "")
							echo "<p class='text-danger pb-0 pt-2'>$msg</p>";
				?>
			</div>
		<div class="d-flex justify-content-center">
		<form action="login.php" method="post" id="log-form">
			<div class="form-row my-4">
				<div class="col">
					<input type="email" name="email" id="email" class="form-control" placeholder="Email" required="" value = "<?php if(isset($_POST['email'])) {echo htmlentities($_POST['email']);}?>">
				</div>
			</div>
			<div class="form-row my-4">
				<div class="col">
					<input type="password" name="password" id="password" class="form-control" placeholder="Password" required="">
					<?php if(isset($_SESSION['wrongPass'])) {
							echo "<p class='text-danger pb-0 pt-2'>Wrong password</p>";
							$_SESSION['wrongPass'] = null;
						}
						  else if(isset($_SESSION['notRegistered'])) {
							echo "<p class='text-danger pb-0 pt-2'>You don't have an account</p>";
							$_SESSION['notRegistered'] = null;
						}
					?>
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
