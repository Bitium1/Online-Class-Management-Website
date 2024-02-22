<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['alogin'])=="") {   
    header("Location: index.php"); 
} else {
    if(isset($_POST['Update'])) {
        $vid = intval($_GET['videoid']);
        $title = $_POST['title'];
        $description = $_POST['description']; 
        // Add code to handle file uploads for thumbnail and video
        $thumbnail = ""; // Placeholder for thumbnail file path
        $video = ""; // Placeholder for video file path
        
        // Update video information in the database
        $sql = "UPDATE video SET title = :title, description = :description, thumbnail = :thumbnail, video = :video WHERE id = :vid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':thumbnail', $thumbnail, PDO::PARAM_STR);
        $query->bindParam(':video', $video, PDO::PARAM_STR);
        $query->bindParam(':vid', $vid, PDO::PARAM_INT);
        $query->execute();
        $msg = "Video info updated successfully";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMS Admin Update Video</title>
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
        <?php include('includes/topbar.php');?> 
        <div class="content-wrapper">
            <div class="content-container">
                <?php include('includes/leftbar.php');?>  
                <div class="main-page">
                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">Update Video</h2>
                            </div>
                        </div>
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li>Videos</li>
                                    <li class="active">Update Video</li>
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
                                            <h5>Update Video</h5>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <?php if($msg) { ?>
                                            <div class="alert alert-success left-icon-alert" role="alert">
                                                <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
                                            </div>
                                        <?php } ?>
                                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                            <?php
                                                $vid = intval($_GET['videoid']);
                                                $sql = "SELECT * FROM video WHERE id = :vid";
                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':vid', $vid, PDO::PARAM_INT);
                                                $query->execute();
                                                $result = $query->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                            <div class="form-group">
                                                <label for="title" class="col-sm-2 control-label">Title</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="title" class="form-control" id="title" value="<?php echo htmlentities($result['title']); ?>" placeholder="Video Title" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="description" class="col-sm-2 control-label">Description</label>
                                                <div class="col-sm-10">
                                                    <textarea name="description" class="form-control" id="description" placeholder="Video Description" required="required"><?php echo htmlentities($result['description']); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="thumbnail" class="col-sm-2 control-label">Thumbnail</label>
                                                <div class="col-sm-10">
                                                    <input type="file" name="thumbnail" accept="image/*" required class="box">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="video" class="col-sm-2 control-label">Select Video</label>
                                                <div class="col-sm-10">
                                                    <input type="file" name="video" accept="video/*" required class="box">
                                                </div>
                                            </div>
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
