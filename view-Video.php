<?php
session_start();
include('includes/config.php');

if(strlen($_SESSION['alogin']) == "") {   
    header("Location: index.php"); 
    exit(); 
} else {
    $teacherId = null; // Initialize $teacherId variable

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $sql = "SELECT id FROM teacher WHERE username = :username";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $teacherId = $result['id'];
        
    } else {
        echo "Username not available.";
    }

    if(isset($_POST['delete_video'])){
        $delete_id = $_POST['video_id'];
        $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
        $verify_video = $dbh->prepare("SELECT * FROM `video` WHERE id = ? LIMIT 1");
        $verify_video->execute([$delete_id]);
        if($verify_video->rowCount() > 0){
            $fetch_thumb = $verify_video->fetch(PDO::FETCH_ASSOC);
            unlink('uploaded_files/'.$fetch_thumb['thumbnail']);
            unlink('uploaded_files/'.$fetch_thumb['video']);
            $delete_content = $dbh->prepare("DELETE FROM `video` WHERE id = ?");
            $delete_content->execute([$delete_id]);
            $message[] = 'Video deleted!';
        } else {
            $message[] = 'Video already deleted!';
        }
    }
}
?>
<?php
session_start();
include('includes/config.php');

if(strlen($_SESSION['alogin']) == "") {   
    header("Location: index.php"); 
    exit(); 
} else {
    $teacherId = null; // Initialize $teacherId variable

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $sql = "SELECT id FROM teacher WHERE username = :username";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $teacherId = $result['id'];
        
    } else {
        echo "Username not available.";
    }

    if(isset($_POST['delete_video'])){
        $delete_id = $_POST['video_id'];
        $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
        $verify_video = $dbh->prepare("SELECT * FROM `video` WHERE id = ? LIMIT 1");
        $verify_video->execute([$delete_id]);
        if($verify_video->rowCount() > 0){
            $fetch_thumb = $verify_video->fetch(PDO::FETCH_ASSOC);
            unlink('uploaded_files/'.$fetch_thumb['thumbnail']);
            unlink('uploaded_files/'.$fetch_thumb['video']);
            $delete_content = $dbh->prepare("DELETE FROM `video` WHERE id = ?");
            $delete_content->execute([$delete_id]);
            $message[] = 'Video deleted!';
        } else {
            $message[] = 'Video already deleted!';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SRMS Admin Add video</title>
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
        <?php include('includes/topbar.php');?> 
        <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
        <div class="content-wrapper">
            <div class="content-container">
                <!-- ========== LEFT SIDEBAR ========== -->
                <?php include('includes/leftbar.php');?>  
                <!-- /.left-sidebar -->
                <div class="main-page">
                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">Add video</h2>
                            </div>
                        </div>
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li>Videos</li>
                                    <li class="active">Add Video</li>
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
                                            <h3>View Video</h3>
                                        </div>
                                        <div class="panel-body">
                                            <?php
                                            // Query to retrieve the subjects corresponding to the teacher's ID
                                            if ($teacherId) {
                                                $stmt = $dbh->prepare("SELECT SubjectName FROM tblsubjects WHERE teacher_id = ?");
                                                $stmt->execute([$teacherId]);
                                                $subjects = $stmt->fetchAll(PDO::FETCH_COLUMN);
                                                if ($subjects) {
                                                    // Display the subjects
                                                    foreach ($subjects as $subject) {
                                                        
                                                    }
                                                }
                                            }
                                            ?>
                                            
                                            <?php
                                            foreach ($subjects as $subject) {
                                                $select_videos = $dbh->prepare("SELECT v.*, s.SubjectName 
                                                    FROM `video` v 
                                                    INNER JOIN `tblsubjects` s ON v.subjectId = s.id 
                                                    WHERE s.SubjectName = :subject 
                                                    ORDER BY v.Updationdate DESC");
                                                $select_videos->execute([':subject' => $subject]);
                                                if($select_videos->rowCount() > 0) {
                                                    ?>
                                                    <h3 class="title"><?= $subject ?></h3>
                                                    <div class="row">
                                                        <?php
                                                        $count = 0;
                                                        while($fetch_videos = $select_videos->fetch(PDO::FETCH_ASSOC)) {
                                                            $video_id = $fetch_videos['id'];
                                                            ?>
                                                            
                                                            <div class="col-md-3">
                                                            
                                                                <div class="w3-card-4 w3-dark-grey" style="margin-bottom: 20px;">
                                                                    <div class="w3-container w3-center">
                                                                    
                                                                        <h6 class="title"><?= $fetch_videos['title']; ?></h6>
                                                                        <img src="uploaded_files/<?= $fetch_videos['thumbnail']; ?>" class="thumbnail" width=98% height=150px alt="">
                                                                        <h6 class="card-subtitle mb-2 "><?= $fetch_videos['Updationdate']; ?></h6>
                                                                        <p class="card-text"><?= $fetch_videos['description']; ?></p>
                                                                        <div class="w3-section">
                                                                            <form action="" method="post" class="flex-btn">
    <input type="hidden" name="video_id" value="<?= $video_id; ?>">
    <div style="text-align: center;">
    <a href="view_content.php?get_id=<?= $video_id; ?>" class="w3-button w3-gray" style="width: 150px; height: 40px; margin-right: 10px;">View Video</a>
    <br> <!-- Line break added here -->
    <input type="submit" value="Delete" class="w3-button w3-gray" style="width: 150px; height: 40px;" onclick="return confirm('Delete this video?');" name="delete_video">
</div>
</form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            
                                                        }
                                                        ?>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            
                                            </div>
                                                
                                            </div>
                                                                    </div>
                                                                </div>
                                                            </div>                    </div>
                                                                </div>
                                                            </div>
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
