<?php
session_start();
if(!isset($_SESSION["id"])){
    header("Location:login.php");
}

require("include/core/connection.php");
require("include/core/function.php");

$query = "SELECT * FROM users WHERE id = '".$_SESSION["id"]."'";
$profile_result = mysqli_query($mysql, $query);
$profile = mysqli_fetch_assoc($profile_result);

$query = "SELECT name FROM teams WHERE id = '".$profile["team_id"]."'";
$current_team_result = mysqli_query($mysql, $query);
$currentTeam = mysqli_fetch_assoc($current_team_result);

$query = "SELECT * FROM teams";
$team_result = mysqli_query($mysql, $query);

if (isset($_POST['update'])) {
    if ($_POST['password'] == $_POST['repeatPassword']) {
        $query = "SELECT id FROM teams WHERE name = '".$_POST['team']."'";
        $select_team_result = mysqli_query($mysql, $query);
        $selectTeam = mysqli_fetch_assoc($select_team_result);
        
        $data = array(
            'name'=> $_POST['name'],
            'email'=> $_POST['email'],
            'contact'=> $_POST['contact'],
            'position'=> $_POST['position'],
            'avatar'=> $_POST['image'],
            'title'=> $_POST['title'],
            'joined_at' => $_POST['joined_at'],
            'password'=> $_POST['password'],
            'level'=> $_POST['level'],
            'team_id' => (int)$selectTeam['id'],
            'updated_at' => date('Y-m-d H:i:s'),
        );

        $query = Update('users', $data, "WHERE id = '".$_SESSION["id"]."'");
        header("Location:profile.php");
    }
}
?>

<html lang="en">
    <head>
        <?php include("include/view/css.php"); ?>
        <title>Sports League - Profile</title>
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
                <li class="nav-item active">
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
                            <h1 class="h3 mb-4 text-gray-800">Profile</h1>
                        </div>
                        <!-- Content Row -->
                        <form class="create_league" method="post">
                            <div class="row shadow">
                                <!-- Project Card Example -->
                                <div class="col-lg-6 mb-4">
                                    <div class="card-body">                                        
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" id="name" name="name" placeholder="Enter Name" class="form-control" value="<?php echo $profile['name'];?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" id="email" name="email" placeholder="Enter Email Address" class="form-control" value="<?php echo $profile['email'];?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <input type="text" id="contact" name="contact" placeholder="Enter Contact Number" class="form-control" value="<?php echo $profile['contact'];?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Position</label>
                                            <input type="text" id="position" name="position" placeholder="Enter Position" class="form-control" value="<?php echo $profile['position'];?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" id="title" name="title" placeholder="Enter Title" class="form-control" value="<?php echo $profile['title'];?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" id="password" name="password" placeholder="Enter Password" class="form-control" value="<?php echo $profile['password'];?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password" id="repeatPassword" name="repeatPassword" placeholder="Enter Confirm Password" class="form-control" value="<?php echo $profile['password'];?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Level</label>
                                            <select id="level" name="level" class="form-control" required>
                                                <option><?php echo $profile['level'];?></option>
                                                <option>Administrator</option>
                                                <option>Leader</option>
                                                <option>Player</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- Project Card Example -->
                                <div class="col-lg-6 mb-4">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Avatar</label>
                                            <div class="form-group">
                                                <input type="file" id="attachment" name="attachment" onchange="showLogo()" hidden>
                                                <?php if ($profile['avatar'] == null) { ?>
                                                <img id="avatar" name="avatar" class="img-fluid mt-3 mb-4 upload-image" src="img/profile-image.png" alt>
                                                <input type="text" id="image" name="image" placeholder="" required hidden>
                                                <?php } else { ?>
                                                <img id="avatar" name="avatar" class="img-fluid mt-3 mb-4 upload-image" src="<?php echo $profile['avatar'];?>" alt>
                                                <input type="text" id="image" name="image" placeholder="" value="<?php echo $profile['avatar'];?>" required hidden>
                                                <?php } ?>
                                                
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="form-group">
                                            <label>Team</label>
                                            <select id="team" name="team" class="form-control" required>
                                                <option><?php echo $currentTeam['name'];?></option>
                                                <?php $i = 0; while($team = mysqli_fetch_array($team_result)) { ?>
                                                <option><?php echo $team['name'];?></option>
                                                <?php $i++; } ?>
                                            </select>
                                        </div>                                        
                                        <div class="form-group">
                                            <label>Join</label>
                                            <input type="date" id="joined_at" name="joined_at" placeholder="" class="form-control" value="<?php echo $profile['joined_at']; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" id="update" name="update" class="btn btn-primary btn-user btn-block">Update Profile</button>
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
        <script src="js/app/profile.js"></script>
    </body>
</html>