<?php
session_start();
if(!isset($_SESSION["id"])){
    header("Location:login.php");
}

require("include/core/connection.php");
require("include/core/function.php");

if (isset($_POST['add'])) {
    $data = array(
        'title'=> $_POST['title'],            
        'image'=> $_POST['image'],
        'description'=> $_POST['description'],
        'owner' => $_SESSION["id"],
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    );
    $query = Insert('news', $data);
    header("Location:league_news.php");
}

$query = "SELECT * FROM news  WHERE owner = '".$_SESSION["id"]."' ORDER BY id DESC";
$result = mysqli_query($mysql, $query);
?>

<html lang="en">
    <head>
        <?php include("include/view/css.php"); ?>
        <title>Sports League - News</title>
        <!-- Custom styles for this page -->
        <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                <li class="nav-item active">
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
                            <h1 class="h3 mb-4 text-gray-800">News</h1>
                        </div>
                        <div class="row">
                            <div class="col-xl-4 col-lg-7">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Post News</h6>
                                    </div>
                                    <div class="card-body">
                                        <form class="user" method="post">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" id="title" name="title" placeholder="Enter Title" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Image</label>
                                                <div class="form-group">
                                                <input type="file" id="attachment" name="attachment" onchange="showImage()" hidden>
                                                <img id="avatar" name="avatar" class="img-fluid mt-3 mb-4 upload-image" src="img/upload-image.jpg" alt>
                                                <input type="text" id="image" name="image" placeholder="" required hidden>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea type="text" id="description" name="description" placeholder="Enter Description" class="form-control" required></textarea>
                                            </div>
                                            <br>
                                            <button type="submit" id="add" name="add" class="btn btn-primary btn-user btn-block">Post</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-7">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">News List</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th hidden>Id</th>
                                                        <th>Title</th>
                                                        <th>Image</th>
                                                        <th>Description</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th hidden>Id</th>
                                                        <th>Title</th>
                                                        <th>Image</th>
                                                        <th>Description</th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php $i = 0; while($news = mysqli_fetch_array($result)) { ?>
                                                        <tr>
                                                            <td class="align-middle" hidden><?php echo $news['id']; ?></td>
                                                            <td class="align-middle"><?php echo $news['title']; ?></td>
                                                            <td class="align-middle">
                                                                <img class="logo-image rounded-circle" src="<?php echo $news['image'];?>">
                                                            </td>
                                                            <td class="align-middle description"><?php echo $news['description']; ?></td>
                                                            <td class="align-middle text-center">
                                                                <a href="#" class="btn btn-info btn-circle btn-sm" data-toggle="modal"  data-target="#" data-value="<?php echo $news['id'];?>"><i class="fas fa-edit"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php $i++; } ?>
                                                </tbody>
                                            </table>
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
        <!-- Page level plugins -->
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>
        <!-- Custom scripts for this pages-->
        <script src="js/app/league_news.js"></script>
    </body>
</html>