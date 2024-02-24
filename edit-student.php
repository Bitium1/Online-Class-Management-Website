<?php
session_start();

include('includes/config.php');

if(strlen($_SESSION['alogin']) == "") {   
    header("Location: index.php"); 
} else {
    if(isset($_POST['Update'])) {
        
            // Get form data
            $studentId = intval($_GET['studentId']);
            $firstName = isset($_POST['firstName']) ? $_POST['firstName'] : "";
            $lastName = isset($_POST['lastName']) ? $_POST['lastName'] : "";
            $birthdayDate = isset($_POST['birthdayDate']) ? $_POST['birthdayDate'] : "";
            $gender = isset($_POST['gender']) ? $_POST['gender'] : "";
            $emailAddress = isset($_POST['emailAddress']) ? $_POST['emailAddress'] : "";
            $phoneNumber = isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : "";
            $subject = isset($_POST['subject']) ? $_POST['subject'] : "";
            $roleId = isset($_POST['roleId']) ? $_POST['roleId'] : "";

            // Update student information query
            $sql = "UPDATE student 
                    SET first_name = :firstName, 
                        last_name = :lastName, 
                        birthday = :birthdayDate, 
                        gender = :gender, 
                        email = :emailAddress, 
                        phone_number = :phoneNumber, 
                        subject = :subject, 
                        role_id = :roleId 
                    WHERE id = :studentId";

            // Prepare and execute the SQL statement
            $query = $dbh->prepare($sql);
            $query->bindParam(':studentId', $studentId, PDO::PARAM_INT);
            $query->bindParam(':firstName', $firstName, PDO::PARAM_STR);
            $query->bindParam(':lastName', $lastName, PDO::PARAM_STR);
            $query->bindParam(':birthdayDate', $birthdayDate, PDO::PARAM_STR);
            $query->bindParam(':gender', $gender, PDO::PARAM_STR);
            $query->bindParam(':emailAddress', $emailAddress, PDO::PARAM_STR);
            $query->bindParam(':phoneNumber', $phoneNumber, PDO::PARAM_STR);
            $query->bindParam(':subject', $subject, PDO::PARAM_STR);
            $query->bindParam(':roleId', $roleId, PDO::PARAM_INT);
            $query->execute();

            $msg="Subject Info updated successfully";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SRMS Admin | Edit Student</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
    <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
    <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
    <link rel="stylesheet" href="css/prism/prism.css" media="screen">
    <link rel="stylesheet" href="css/select2/select2.min.css">
    <link rel="stylesheet" href="css/main.css" media="screen">
    <script src="js/modernizr/modernizr.min.js"></script>
</head>
<body class="top-navbar-fixed">
    <div class="main-wrapper">
        <!-- ========== TOP NAVBAR ========== -->
        <?php include('includes/topbar.php'); ?>
        <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
        <div class="content-wrapper">
            <div class="content-container">
                <!-- ========== LEFT SIDEBAR ========== -->
                <?php include('includes/leftbar.php'); ?>
                <!-- /.left-sidebar -->
                <div class="main-page">
                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">Edit Student</h2>
                            </div>
                        </div>
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li>Update Student</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <h5>Update Student Information</h5>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                    <?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Well done!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
                                        <form class="form-horizontal" method="post">
                                        <?php
                                        $studentId=intval($_GET['studentId']);
                                        $sql = "SELECT * from student where id=:studentId";
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':studentId',$studentId,PDO::PARAM_STR);
                                        $query->execute();
                                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt=1;
                                        if($query->rowCount() > 0)
                                        {
                                            foreach($results as $result)
                                            {   
                                        ?>              
                                            <div class="form-group">
                                                <label for="firstName" class="col-sm-2 control-label">First Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" value="<?php echo htmlentities($result->first_name);?>" id="firstName" name="firstName" placeholder="Enter First Name" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="lastName" class="col-sm-2 control-label">Last Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" value="<?php echo htmlentities($result->last_name);?>" id="lastName" name="lastName" placeholder="Enter Last Name" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="roleId" class="col-sm-2 control-label">Role ID</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" value="<?php echo htmlentities($result->role_id);?>" id="roleId" name="roleId" placeholder="Enter Role ID" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="birthdayDate" class="col-sm-2 control-label">Birthdate</label>
                                                <div class="col-sm-10">
                                                    <input type="date" class="form-control" value="<?php echo htmlentities($result->birthday);?>" id="birthdayDate" name="birthdayDate" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="gender" class="col-sm-2 control-label">Gender</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" id="gender" name="gender" required>
                                                        <option value="">Select Gender</option>
                                                        <option value="Male" <?php if($result->gender=="Male") echo "selected"; ?>>Male</option>
                                                        <option value="Female" <?php if($result->gender=="Female") echo "selected"; ?>>Female</option>
                                                        <option value="Other" <?php if($result->gender=="Other") echo "selected"; ?>>Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="emailAddress" class="col-sm-2 control-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" value="<?php echo htmlentities($result->email);?>" id="emailAddress" name="emailAddress" placeholder="Enter Email" required>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="phoneNumber" class="col-sm-2 control-label">Phone Number</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" value="<?php echo htmlentities($result->phone_number);?>" id="phoneNumber" name="phoneNumber" placeholder="Phone Number" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="subject" class="col-sm-2 control-label">Subject</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" value="<?php echo htmlentities($result->subject);?>" id="subject" name="subject" placeholder="Enter Subject" required>
                                                </div>
                                            </div>
                                        <?php }} ?>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" name="Update" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/pace/pace.min.js"></script>
    <script src="js/lobipanel/lobipanel.min.js"></script>
    <script src="js/iscroll/iscroll.js"></script>
    <script src="js/prism/prism.js"></script>
    <script src="js/select2/select2.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        $(function($) {
            $(".js-states").select2();
            $(".js-states-limit").select2({
                maximumSelectionLength: 2
            });
            $(".js-states-hide").select2({
                minimumResultsForSearch: Infinity
            });
        });
    </script>
</body>
</html>

<?PHP } ?>