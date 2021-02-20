<?php
session_start();
if(!isset($_SESSION["id"])){
    header("Location:login.php");
}

require("include/core/connection.php");
require("include/core/function.php");

$index = $_GET['index'];
$update = $_GET['update'];

if (isset($_POST['update'])) {
    $data = array(
        'name'=> $_POST['name'],            
        'country'=> $_POST['country'],
        'logo'=> $_POST['image'],
        'league_description'=> $_POST['league_description'],
        'point_description'=> $_POST['point_description'],
        'rule'=> $_POST['rule'],
        'date' => $_POST['date'],
        'time' => $_POST['time'],
        'owner' => $_SESSION["id"],
        'updated_at' => date('Y-m-d H:i:s'),
    );
    $query = Update('leagues', $data, "WHERE id = '".$index."'");
    header("Location:league_list.php");
}

$query = "SELECT * FROM leagues WHERE id = '".$index."'";
$league_result = mysqli_query($mysql, $query);
$league = mysqli_fetch_assoc($league_result);
?>

<html lang="en">
    <head>
        <?php include("include/view/css.php"); ?>
        <?php if ($update == 'true') { ?>
            <title>Sports League - League Edit</title>
        <?php } else { ?>
            <title>Sports League - League Detail</title>
        <?php } ?>        
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
                <li class="nav-item active">
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
                <li class="nav-item">
                    <a class="nav-link" href="team_create.php">
                    <i class="fas fa-fw fa-campground"></i>
                    <span>Create Team</span></a>
                </li>
                <!-- Nav Item - Team Edit -->
                <li class="nav-item active">
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
                            <?php if ($update == 'true') { ?>
                                <h1 class="h3 mb-4 text-gray-800">League Edit (<?php echo $league['name'];?>)</h1>
                            <?php } else { ?>
                                <h1 class="h3 mb-4 text-gray-800">League Detail (<?php echo $league['name'];?>)</h1>
                            <?php } ?>
                            <a href="javascript:history.go(-1)" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Return</a>
                        </div>
                        <!-- Content Row -->
                        <form class="create_league" method="post">
                            <div class="row shadow">
                                <!-- Project Card Example -->
                                <div class="col-lg-6 mb-4">
                                    <div class="card-body">                                        
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" id="name" name="name" placeholder="Enter Name" class="form-control" required <?php if ($update == 'false') { echo "disabled"; } ?> value="<?php echo $league['name'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input type="text" id="country" name="country" placeholder="Enter Country Name" class="form-control" required <?php if ($update == 'false') { echo "disabled"; } ?> value="<?php echo $league['country'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label>League Description</label>
                                            <input type="text" id="league_description" name="league_description" placeholder="Enter League Description" class="form-control" required <?php if ($update == 'false') { echo "disabled"; } ?> value="<?php echo $league['league_description'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Point Description</label>
                                            <input type="text" id="point_description" name="point_description" placeholder="Enter Point Description" class="form-control" required <?php if ($update == 'false') { echo "disabled"; } ?> value="<?php echo $league['point_description'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Rule</label>
                                            <input type="text" id="rule" name="rule" placeholder="Enter Rule" class="form-control" required <?php if ($update == 'false') { echo "disabled"; } ?> value="<?php echo $league['rule'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="date" id="date" name="date" placeholder="2020-10-14" class="form-control" required <?php if ($update == 'false') { echo "disabled"; } ?> value="<?php echo $league['date'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Time</label>
                                            <input type="time" id="time" name="time" placeholder="22:00" class="form-control" required <?php if ($update == 'false') { echo "disabled"; } ?> value="<?php echo $league['time'];?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- Project Card Example -->
                                <div class="col-lg-6 mb-4">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Logo</label>
                                            <div class="form-group">                       
                                                <?php if ($update == 'false') { ?>
                                                    <img id="avatar" name="avatar" class="img-fluid mt-3 mb-4 upload-image" src="<?php echo $league['logo'];?>" alt>
                                                <?php } else { ?>
                                                    <input type="file" id="attachment" name="attachment" onchange="showLogo()" hidden>
                                                    <img id="avatar" name="avatar" class="img-fluid mt-3 mb-4 upload-image" src="<?php echo $league['logo'];?>" alt>
                                                    <input type="text" id="image" name="image" placeholder="" required hidden value="<?php echo $league['logo'];?>">
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" id="update" name="update" class="btn btn-primary btn-user btn-block" <?php if ($update == 'false') { echo "hidden"; } ?>>Update League</button>
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
        <script src="js/app/league_detail.js"></script>
    </body>
</html>