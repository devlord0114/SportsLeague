<?php
session_start();
if(!isset($_SESSION["id"])){
    header("Location:login.php");
}

require("include/core/connection.php");
require("include/core/function.php");

if (isset($_POST['create'])) {
    $data = array(
        'name'=> $_POST['name'],
        'country'=> $_POST['country'],
        'logo'=> $_POST['image'],
        'description'=> $_POST['description'],
        'website'=> $_POST['website'],
        'facebook'=> $_POST['facebook'],
        'twitter'=> $_POST['twitter'],
        'owner' => $_SESSION["id"],
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    );
    $query = Insert('teams', $data);
    header("Location:team_list.php");
}
?>

<html lang="en">
    <head>
        <?php include("include/view/css.php"); ?>
        <title>Sports League - Create Team</title>
    </head>
    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">Sports League</div>
                </a>
                <!-- Divider -->
                <hr class="sidebar-divider my-0">
                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider">
                <!-- Heading -->
                <div class="sidebar-heading">
                    League
                </div>
                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="league_dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
                </li>
                <!-- Nav Item - Create League -->
                <li class="nav-item">
                    <a class="nav-link" href="league_create.php">
                    <i class="fas fa-fw fa-crown"></i>
                    <span>Create League</span></a>
                </li>
                <!-- Nav Item - League List -->
                <li class="nav-item">
                    <a class="nav-link" href="league_list.php">
                    <i class="fas fa-fw fa-wind"></i>
                    <span>League List</span></a>
                </li>
                <!-- Nav Item - Invite Team -->
                <li class="nav-item">
                    <a class="nav-link" href="league_invite.php">
                    <i class="fas fa-fw fa-dice-d20"></i>
                    <span>Invite Team</span></a>
                </li>
                <!-- Nav Item - Game Info -->
                <li class="nav-item">
                    <a class="nav-link" href="league_game_info.php">
                    <i class="fas fa-fw fa-star"></i>
                    <span>Game Info</span></a>
                </li>
                <!-- Nav Item - News -->
                <li class="nav-item">
                    <a class="nav-link" href="league_news.php">
                    <i class="fas fa-fw fa-scroll"></i>
                    <span>News</span></a>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider">
                <!-- Heading -->
                <div class="sidebar-heading">
                    Team
                </div>
                <!-- Nav Item - Create team -->
                <li class="nav-item active">
                    <a class="nav-link" href="team_create.php">
                    <i class="fas fa-fw fa-campground"></i>
                    <span>Create Team</span></a>
                </li>
                <!-- Nav Item - Team Edit -->
                <li class="nav-item">
                    <a class="nav-link" href="team_edit.php">
                    <i class="fas fa-fw fa-pen-fancy"></i>
                    <span>Team Edit</span></a>
                </li>
                <!-- Nav Item - Team List -->
                <li class="nav-item">
                    <a class="nav-link" href="team_list.php">
                    <i class="fas fa-fw fa-wind"></i>
                    <span>Team List</span></a>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider">
                <!-- Heading -->
                <div class="sidebar-heading">
                    Profile
                </div>                
                <!-- Nav Item - Profile -->
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">
                    <i class="fas fa-fw fa-smile"></i>
                    <span>Profile</span></a>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">
                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>
            </ul>
            <!-- End of Sidebar -->
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                        <!-- Sidebar Toggle (Topbar) -->
                        <?php include("include/view/topbar.php"); ?>
                    </nav>
                    <!-- End of Topbar -->
                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-4 text-gray-800">Create Team</h1>
                        </div>
                        <!-- Content Row -->
                        <form class="create_league" method="post">
                            <div class="row shadow">
                                <!-- Project Card Example -->
                                <div class="col-lg-6 mb-4">
                                    <div class="card-body">                                        
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" id="name" name="name" placeholder="Enter Name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input type="text" id="country" name="country" placeholder="Enter Country Name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <input type="text" id="description" name="description" placeholder="Enter Description" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Website Address</label>
                                            <input type="text" id="website" name="website" placeholder="Enter Website Address" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Facebook Address</label>
                                            <input type="text" id="facebook" name="facebook" placeholder="Enter Facebook Address" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Twitter Address</label>
                                            <input type="text" id="twitter" name="twitter" placeholder="Enter Twitter Address" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- Project Card Example -->
                                <div class="col-lg-6 mb-4">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Logo</label>
                                            <div class="form-group">
                                                <input type="file" id="attachment" name="attachment" onchange="showLogo()" hidden>
                                                <img id="avatar" name="avatar" class="img-fluid mt-3 mb-4 upload-image" src="img/upload-image.jpg" alt>
                                                <input type="text" id="image" name="image" placeholder="" required hidden>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" id="create" name="create" class="btn btn-primary btn-user btn-block">Create Team</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->
                <!-- Footer -->
                <?php include("include/view/footer.php"); ?>
                <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
        </a>
        <!-- Logout Modal-->
        <?php include("include/modal/logout_modal.php"); ?>
        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>
        <!-- Custom scripts for this pages-->
        <script src="js/app/team_create.js"></script>
    </body>
</html>