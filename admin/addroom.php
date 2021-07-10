<?php
include("header.php");
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['admin']))
    header("location:login.php");
?>

<section id="add_room">
    <div class="my-5 pl-5">
        <a href="index.php"><button class="btn btn-warning rounded-pill text-dark px-5">Admin page</button></a>
    </div>
    <div class="row m-O pt-0">
        <div class="col-lg-4 offset-lg-2">
            <div class="text-center pb-2">
                <h1 class="login-title text-dark">New Room</h1>
            </div>
            <div class="d-flex justify-content-center">
                <form action="addroom_proc.php" method="post" id="reg-form" enctype="multipart/form-data">
                    <div class="form-row my-4">
                        <div class="col">
                            <input type="text" name="name" id="Name" class="form-control" placeholder="Room type" required="">
                        </div>
                    </div>
                    <div class="form-row my-4">
                        <div class="col">
                            <input type="text" name="roomNum" class="form-control" placeholder="Number of rooms" required="">
                        </div>
                    </div>
                    <div class="form-row my-4">
                        <div class="col">
                            <input type="text" name="desc" class="form-control" placeholder="Description" required="">
                        </div>
                    </div>
                    <div class="form-row my-4">
                        <div class="col">
                            <input type="text" name="roomPers" class="form-control" placeholder="Number of people" required="">
                        </div>
                    </div>
                    <div class="form-row my-4">
                        <div class="col">
                            <input type="text" name="price" class="form-control" placeholder="Price" required="">
                        </div>
                    </div>
                    <div class="form-row my-4">
                        <div class="col">
                            <input type="file" name="file" placeholder="Choose a file" required="">
                        </div>
                    </div>
                    <div class="submit-btn text-center my-5">
                        <button id="submit" name="addroom_proc" type="submit" class="btn btn-warning rounded-pill text-dark px-5">Add new room</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
include("../partials/footer.php");
if(isset($_POST['addroom_proc'])) {
    require('addroom_proc.php');
}
?>