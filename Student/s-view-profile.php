<?php
session_start();
error_reporting(0);
include('../includes/config.php');

$id = intval($_SESSION['student_id']);
$sql = "SELECT  
    student.id AS id,
    student.birthday,
    student.username,
    student.first_name AS first_name,
    student.last_name AS last_name,
    student.gender AS gender,
    student.email AS email,
    student.phone_number AS phone_number,
    student.role_id AS role_id,
    student.subjectid AS subjectid,
    tblsubjects.SubjectName AS SubjectName
    FROM 
    student
    inner JOIN 
    tblsubjects ON student.subjectid = tblsubjects.id
    WHERE 
    student.id = :id;
    ";

$query = $dbh->prepare($sql);
$query->bindParam(':id', $id, PDO::PARAM_STR);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);
if (strlen($_SESSION['alogin']) == "") {
    header("Location:../index.php");
} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SRMS System | View Profile</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" href="../css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" href="../css/animate-css/animate.min.css" media="screen">
        <link rel="stylesheet" href="../css/lobipanel/lobipanel.min.css" media="screen">
        <link rel="stylesheet" href="../css/toastr/toastr.min.css" media="screen">
        <link rel="stylesheet" href="../css/icheck/skins/line/blue.css">
        <link rel="stylesheet" href="../css/icheck/skins/line/red.css">
        <link rel="stylesheet" href="../css/icheck/skins/line/green.css">
        <link rel="stylesheet" href="../css/main.css" media="screen">
        <script src="../js/modernizr/modernizr.min.js"></script>
    </head>

    <body class="top-navbar-fixed">
        <div class="main-wrapper">
            <!-- Top Navbar -->
            <?php include('s-topbar.php'); ?>
            <!-- /.Top Navbar -->

            <div class="content-wrapper">
                <div class="content-container">
                    <!-- Left Sidebar -->
                    <?php include('s-leftbar.php'); ?>
                    <!-- /.Left Sidebar -->

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-sm-6">
                                    <h2 class="title">View Profile</h2>
                                </div>
                                <!-- /.col-sm-6 -->
                            </div>
                            <!-- /.row -->

                            <!-- Profile Icon -->
                            <div class="row mt-50 mb-30">
                                <div class="col-md-12 text-center">
                                    <!-- Add your profile icon here -->
                                    <i class="fa fa-user profile-icon" style="font-size: 48px;"></i>
                                </div>
                            </div>
                            <!-- /.row -->

                            <!-- Information Paragraphs -->
                            <div class="row justify-content-center mt-4">
                                <div class="col-md-12 col-sm-10 text-center">
                                    <div class="row mb-30">
                                        <div class="col-md-6 col-sm-6 text-right">
                                            <strong>First Name</strong>
                                        </div>
                                        <div class="col-md-6 col-sm-6 text-left">
                                            <?= $result['first_name'] ?>
                                        </div>
                                    </div>
                                    <div class="row mb-30">
                                        <div class="col-md-6 col-sm-6 text-right">
                                            <strong>Last Name</strong>
                                        </div>
                                        <div class="col-md-6 col-sm-6 text-left">
                                            <?= $result['last_name'] ?>
                                        </div>
                                    </div>
                                    <div class="row mb-30">
                                        <div class="col-md-6 col-sm-6 text-right">
                                            <strong>Role Id</strong>
                                        </div>
                                        <div class="col-md-6 col-sm-6 text-left">
                                            <?= $result['role_id'] ?>
                                        </div>
                                    </div>
                                    <div class="row mb-30">
                                        <div class="col-md-6 col-sm-6 text-right">
                                            <strong>BirthDay</strong>
                                        </div>
                                        <div class="col-md-6 col-sm-6 text-left">
                                            <?= $result['birthday'] ?>
                                        </div>
                                    </div>
                                    <div class="row mb-30">
                                        <div class="col-md-6 col-sm-6 text-right">
                                            <strong>Gender</strong>
                                        </div>
                                        <div class="col-md-6 col-sm-6 text-left">
                                            <?= $result['gender'] ?>
                                        </div>
                                    </div>
                                    <div class="row mb-30">
                                        <div class="col-md-6 col-sm-6 text-right">
                                            <strong>E-Mail</strong>
                                        </div>
                                        <div class="col-md-6 col-sm-6 text-left">
                                            <?= $result['email'] ?>
                                        </div>
                                    </div>
                                    <div class="row mb-30">
                                        <div class="col-md-6 col-sm-6 text-right">
                                            <strong>Username</strong>
                                        </div>
                                        <div class="col-md-6 col-sm-6 text-left">
                                            <?= $result['username'] ?>
                                        </div>
                                    </div>
                                    <div class="row mb-30">
                                        <div class="col-md-6 col-sm-6 text-right">
                                            <strong>Phone Number</strong>
                                        </div>
                                        <div class="col-md-6 col-sm-6 text-left">
                                            <?= $result['phone_number'] ?>
                                        </div>
                                    </div>
                                    <div class="row mb-30">
                                        <div class="col-md-6 col-sm-6 text-right">
                                            <strong>Subject</strong>
                                        </div>
                                        <div class="col-md-6 col-sm-6 text-left">
                                            <?= $result['SubjectName'] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- /.row -->

                        </div>
                        <!-- /.container-fluid -->
                    </div>
                    <!-- /.main-page -->
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- /.main-wrapper -->

        <!-- ========== COMMON JS FILES ========== -->
        <script src="../js/jquery/jquery-2.2.4.min.js"></script>
        <script src="../js/jquery-ui/jquery-ui.min.js"></script>
        <script src="../js/bootstrap/bootstrap.min.js"></script>
        <script src="../js/pace/pace.min.js"></script>
        <script src="../js/lobipanel/lobipanel.min.js"></script>
        <script src="../js/iscroll/iscroll.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="../js/main.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="../js/prism/prism.js"></script>
        <script src="../js/waypoint/waypoints.min.js"></script>
        <script src="../js/counterUp/jquery.counterup.min.js"></script>
        <script src="../js/amcharts/amcharts.js"></script>
        <script src="../js/amcharts/serial.js"></script>
        <script src="../js/amcharts/plugins/export/export.min.js"></script>
        <link rel="stylesheet" href="../js/amcharts/plugins/export/export.css" type="text/css" media="all" />
        <script src="../js/amcharts/themes/light.js"></script>
        <script src="../js/toastr/toastr.min.js"></script>
        <script src="../js/icheck/icheck.min.js"></script>

    </body>

    <div class="foot">
        <footer>

        </footer>
    </div>

    <style>
        .foot {
            text-align: center;
        }
    </style>

    </html>
<?php } ?>