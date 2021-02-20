<?php
session_start();
if(!isset($_SESSION["id"])){
    header("Location:login.php");
}

require("include/core/connection.php");
require("include/core/function.php");

// Get Top Team
$query = "SELECT * FROM teams";
$top_team_result = mysqli_query($mysql, $query);
$top_team = mysqli_fetch_assoc($top_team_result);

// Get Top Player
$query = "SELECT * FROM users";
$top_player_result = mysqli_query($mysql, $query);
$top_player = mysqli_fetch_assoc($top_player_result);

// Get Top News
$query = "SELECT * FROM news";
$top_news_result = mysqli_query($mysql, $query);
$top_news = mysqli_fetch_assoc($top_news_result);

// Get League Count
$query = "SELECT COUNT(*) as count FROM leagues";
$league_count_result = mysqli_query($mysql, $query);
$league_count = mysqli_fetch_assoc($league_count_result);

// Get Monthly League
$query = "SELECT COUNT(*) as count FROM invites WHERE created_at >='2020-01-01 00:00:00' AND created_at <='2020-12-31 23:59:59'";
$monthly_invite_result = mysqli_query($mysql, $query);
$monthly_invite = mysqli_fetch_assoc($monthly_invite_result);

// Get ANNUAL League
$query = "SELECT COUNT(*) as count FROM invites WHERE created_at >='2020-10-01 00:00:00' AND created_at <='2020-10-31 23:59:59'";
$annual_invite_result = mysqli_query($mysql, $query);
$annual_invite = mysqli_fetch_assoc($annual_invite_result);

// Get News Count
$query = "SELECT COUNT(*) as count FROM news";
$news_count_result = mysqli_query($mysql, $query);
$news_count = mysqli_fetch_assoc($news_count_result);

?>

<html lang="en">
    <head>
        <?php include("include/view/css.php"); ?>
        <title>Sports League - League Dashboard</title>
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
                <li class="nav-item active">
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
                <li class="nav-item">
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
                            <h1 class="h3 mb-4 text-gray-800">League Dashboard</h1>
                        </div>
                        <!-- Content Row -->
                        <div class="row">
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Leagues</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $league_count['count']; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-list fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Invites (Monthly)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $monthly_invite['count']; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Invites (ANNUAL)</div>
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $annual_invite['count']; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Pending Requests Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">News</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $news_count['count']; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Content Row -->
                        <div class="row">
                            <!-- Area Chart -->
                            <div class="col-xl-4 col-lg-5">
                                <div class="card shadow mb-4">
                                    <!-- Card Header -->
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Top Team</h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label><?php echo $top_team['name'];?></label>
                                        </div>
                                        <div class="form-group">
                                            <img class="img-fluid mt-3 mb-4 upload-image rounded-circle" src="<?php echo $top_team['logo'];?>" alt>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo $top_team['description'];?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-5">
                                <div class="card shadow mb-4">
                                    <!-- Card Header -->
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Top Player</h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label><?php echo $top_player['name'];?></label>
                                        </div>
                                        <div class="form-group">
                                            <img class="img-fluid mt-3 mb-4 upload-image rounded-circle" src="<?php echo $top_player['avatar'];?>" alt>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo $top_player['title'];?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Pie Chart -->
                            <div class="col-xl-4 col-lg-5">
                                <div class="card shadow mb-4">
                                    <!-- Card Header -->
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Latest Information</h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label><?php echo $top_news['title'];?></label>
                                        </div>
                                        <div class="form-group">
                                            <img class="img-fluid mt-3 mb-4 upload-image rounded-circle" src="<?php echo $top_news['image'];?>" alt>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo $top_news['description'];?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    </body>
</html>