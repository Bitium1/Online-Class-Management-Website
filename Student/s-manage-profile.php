<?php
session_start();
error_reporting(0);

include('../includes/config.php');

$id = intval($_SESSION['student_id']);
if (isset($_POST['register'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $roleId = $_POST['roleId'];
    $birthday = $_POST['birthdayDate'];
    $gender = $_POST['gender'];
    $email = $_POST['emailAddress'];
    $username = $_POST['username'];
    $phoneNumber = $_POST['phoneNumber'];
    $subject = $_POST['subjectid'];

    $sql = "UPDATE student SET first_name=:first_name, last_name=:last_name, role_id=:role_id, birthday=:birthday, gender=:gender, email=:email, username=:username, phone_number=:phone_number, subjectid=:sub WHERE id=:id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':first_name', $firstName, PDO::PARAM_STR);
    $query->bindParam(':last_name', $lastName, PDO::PARAM_STR);
    $query->bindParam(':role_id', $roleId, PDO::PARAM_STR);
    $query->bindParam(':birthday', $birthday, PDO::PARAM_STR);
    $query->bindParam(':gender', $gender, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':phone_number', $phoneNumber, PDO::PARAM_STR);
    $query->bindParam(':sub', $subject, PDO::PARAM_STR);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();

    $msg = "Student info updated successfully";
}


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
    exit; // Add exit to stop executing further
} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SRMS System | Manage Profile</title>
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
            <?php include('s-topbar.php'); ?>
            <div class="content-wrapper">
                <div class="content-container">

                    <?php include('s-leftbar.php'); ?>

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-sm-6">
                                    <h2 class="title">Manage Profile</h2>
                                </div>
                                <!-- /.col-sm-6 -->
                            </div>

                            <div class="row p-20">
                                <div class="bg-white p-40">
                                    <form class="form-horizontal" method="post" action="">

                                        <div class="form-group">
                                            <label for="firstName" class="col-sm-2 control-label text-left">First Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter First Name" value="<?php echo $result['first_name']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="lastName" class="col-sm-2 control-label text-left">Last Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter Last Name" value="<?php echo $result['last_name']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="roleId" class="col-sm-2 control-label text-left">Role ID</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="roleId" name="roleId" placeholder="Enter Role ID" value="<?php echo $result['role_id']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="birthdayDate" class="col-sm-2 control-label text-left">Birthday</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" id="birthdayDate" name="birthdayDate" value="<?php echo $result['birthday']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="gender" class="col-sm-2 control-label text-left">Gender</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" id="gender" name="gender" required>
                                                    <option value="">Select Gender</option>
                                                    <option value="Male" <?php if ($result['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                                                    <option value="Female" <?php if ($result['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                                                    <option value="Other" <?php if ($result['gender'] == 'Other') echo 'selected'; ?>>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress" class="col-sm-2 control-label text-left">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="emailAddress" name="emailAddress" placeholder="Enter Email" value="<?php echo $result['email']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="username" class="col-sm-2 control-label text-left">Username</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" value="<?php echo $result['username']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phoneNumber" class="col-sm-2 control-label text-left">Phone Number</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Phone Number" value="<?php echo $result['phone_number']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phoneNumber" class="col-sm-2 control-label text-left">Subject</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" id="subjectid" name="subjectid" required>
                                                    <option value="">Select Subject</option>

                                                    <?php
                                                    $sql2 = "SELECT id, SubjectName FROM tblsubjects";
                                                    $stmt = $dbh->prepare($sql2);
                                                    $stmt->execute();
                                                    $subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($subjects as $subject) {
                                                        echo "<option value=\"{$subject['id']}\">{$subject['SubjectName']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10 mt-10">
                                                <button type="submit" name="register" class="btn btn-warning">Update Profile<span class="btn-label btn-label-left"></span></button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.container-fluid -->
                    </div>
                    <!-- /.main-page -->
                </div>
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
        <script>
            document.getElementById("subjectid").addEventListener("change", function() {
                var selectedOption = this.options[this.selectedIndex].text;
                var selectedValue = this.value;
                console.log("Selected Subject: " + selectedOption);
                console.log("Selected Value: " + selectedValue);
            });
        </script>

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