<?php
$msg = "";
include("header.php");
include("../session.php");
if (isset($_SESSION['admin']))
    header("location:index.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('login-process.php');
}

?>
<head>
<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<div class="spaceTop"></div>
<section id="login-form">
    <div class="my-5 pl-5">
        <a href="../index.php"><button class="btn btn-warning rounded-pill text-dark px-5">Main page</button></a>
    </div>
    <div class="row m-O pt-2">
        <div class="col-md">
            <div class="text-center pb-5">
                <h1 class="login-title text-dark">Login</h1>
                <h4 class="p-1 m-O font-ubuntu text-black-50">Admin Panel</h4>
                <?php
                if ($msg != "")
                    echo "<p class='text-danger pb-0 pt-2'>$msg</p>";
                ?>
            </div>
            <div class="d-flex justify-content-center">
                <form action="login.php" method="post" id="log-form">
                    <div class="form-row my-4">
                        <div class="col">
                            <input type="text" name="username" id="text" class="form-control" placeholder="Username" required="" value="<?php if (isset($_POST['username'])) {
                                                                                                                                        echo htmlentities($_POST['username']);
                                                                                                                                    } ?>">
                        </div>
                    </div>
                    <div class="form-row my-4">
                        <div class="col">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="">
                            <?php if (isset($_SESSION['wrongPass'])) {
                                echo "<p class='text-danger pb-0 pt-2'>Wrong password</p>";
                                $_SESSION['wrongPass'] = null;
                            } else if (isset($_SESSION['notRegistered'])) {
                                echo "<p class='text-danger pb-0 pt-2'>You don't have an account</p>";
                                $_SESSION['notRegistered'] = null;
                            }
                            ?>
                        </div>
                    </div>
                    <div class="submit-btn text-center my-5">
                        <button id="submit" type="submit" class="btn btn-warning rounded-pill text-dark px-5">Continue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
include("../partials/footer.php");
?>
