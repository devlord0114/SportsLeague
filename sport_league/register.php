<?php
require("include/core/connection.php");
require("include/core/function.php");

if (isset($_POST['register'])) {
    if ($_POST['password'] == $_POST['repeatPassword']) {
        $data = array(
            'name'=> $_POST['name'],
            'level' => $_POST['level'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );

        $query = Insert('users', $data);
        header("Location:login.php");
        exit();
    } else {
        header("Location:register.php");
        exit();
    }
}
?>

<html lang="en">
    <head>
        <?php include("include/view/css.php"); ?>
        <title>Sports League - Register</title>
    </head>
    <body class="bg-gradient-primary">
        <div class="container">
            <div class="card o-hidden border-0 shadow-lg my-6">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                </div>
                                <form class="user" method="post">
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Name" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <select class="form-control form-control-user" id="level" name="level">
                                                <option>Leader</option>
                                                <option>Player</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" required>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control form-control-user" id="repeatPassword" name="repeatPassword" placeholder="Repeat Password" required>
                                        </div>
                                    </div>
                                    <div>
                                        <br>
                                    </div>
                                    <button type="submit" id="register" name="register" class="btn btn-primary btn-user btn-block">Register Account</button>
                                    <hr>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="forgot-password.php">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="login.php">Already have an account? Login!</a>
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