<?php
require("include/core/connection.php");
require("include/core/function.php");

session_start();
if (isset($_POST['login'])) {
    $id = login($_POST['email'], $_POST['password']);
    if ($id) {
        $_SESSION["id"] = $id;
        header("Location:index.php");
        exit();    
    } else {
        header("Location:login.php");
        exit();
    }
}
?>

<html lang="en">
    <head>
        <?php include("include/view/css.php"); ?>
        <title>Sports League - Login</title>
    </head>
    <body class="bg-gradient-primary">
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-6">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Welcome!</h1>
                                        </div>
                                        <form class="user" method="post">
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-user" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email Address" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" required>
                                            </div>
                                            <div>
                                                <br><br><br><br>
                                            </div>
                                            <button type="submit" id="login" name="login" class="btn btn-primary btn-user btn-block">Login</button>
                                            <hr>
                                        </form>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="forgot-password.php">Forgot Password?</a>
                                        </div>
                                        <div class="text-center">
                                            <a class="small" href="register.php">Create an Account!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>
    </body>
</html>