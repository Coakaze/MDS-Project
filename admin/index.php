<?php
if (!isset($_SESSION)) {
    session_start();
}
if(!isset($_SESSION['admin'])) {
    header('location:login.php');
}
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  require('sendEmail.php');
}

include("header.php");
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid ml-5">
    <a class="navbar-brand" href="../index.php">Sunlight</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item mx-4">
          <a class="nav-link active" aria-current="page" href="rooms.php">Rooms</a>
        </li>
        <li class="nav-item mx-4">
          <a class="nav-link active" aria-current="page" href="allbookings.php">All bookings</a>
        </li>
        <li class="nav-item mx-4">
          <a class="nav-link active" aria-current="page" href="logout-process.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="sendEmail mx-auto">
<section id="sendEmail">
	<div class="my-5 pl-5">
		
	</div>
	<div class="cont row m-O pt-0  mx-auto">
		<div class="col-lg-4 ">
			<div class="text-center pb-5">
				<h2 class="login-title text-dark">Send an email with new offers!</h2>
			</div>
		<div class="d-flex justify-content-center" id="sendE">
		<form action="index.php" method="post" id="reg-form">
			<div class="form-row">
				<div class="col">
					<input type="text" name="emailSubject" id="emailSubject" class="form-control" placeholder="Subject" required="" value = "<?php if(isset($_POST['emailSubject'])) {echo htmlentities($_POST['emailSubject']);}?>">
				</div>
			</div>
			<div class="form-row my-4">
				<div class="col">
        <textarea id="emailText" name="emailText" rows="4" cols="50" placeholder="What's new?"></textarea>
				</div>
			</div>
			<div class="submit-btn text-center my-5">
				<button id="submit" type="submit" class="btn btn-warning rounded-pill text-dark px-5">Send email!</button>
			</div>
		</form>
		</div>
	</div>
	</div>
</section>

</div>


<?php
include("../partials/footer.php");
?>