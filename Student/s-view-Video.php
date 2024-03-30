<?php
session_start();
include('config.php');

if (strlen($_SESSION['alogin']) == "") {   
    header("Location: index.php"); 
    exit(); 
} else {
    $teacherId = null; // Initialize $teacherId variable
    $subjectId = null;
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $sql = "SELECT subjectid FROM student WHERE username = :username";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $subjectId = $result['subjectid'];
        
    } else {
        echo "Username not available.";
    }
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <title>View Video</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!--<link rel="stylesheet" href="css/admin_style.css">-->
    <link rel="stylesheet" href="../css/bootstrap.min.css" media="screen" >
    <link rel="stylesheet" href="../css/font-awesome.min.css" media="screen" >
    <link rel="stylesheet" href="../css/animate-css/animate.min.css" media="screen" >
    <link rel="stylesheet" href="../css/lobipanel/lobipanel.min.css" media="screen" >
    <link rel="stylesheet" href="../css/prism/prism.css" media="screen" >
    <link rel="stylesheet" href="../css/select2/select2.min.css" >
    <link rel="stylesheet" href="../css/main.css" media="screen" >
</head>
<body class="top-navbar-fixed">
    <div class="main-wrapper">
        <!-- ========== TOP NAVBAR ========== -->
        <?php include('s-topbar.php');?> 

        <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
        <div class="content-wrapper">
            <div class="content-container">
                <!-- ========== LEFT SIDEBAR ========== -->
                <?php include('s-leftbar.php');?>  

                <div class="main-page">
                    <div class="container-fluid">
                        <!-- Your container fluid content here -->
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <h3>View Video</h3>
                                        </div>


                                        <?php
                                            // Query to retrieve the subjects corresponding to the teacher's ID
                                            if ($subjectId) {
                                                $stmt = $dbh->prepare("SELECT SubjectName FROM tblsubjects WHERE id = ?");
                                                $stmt->execute([$subjectId]);
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
                                                    <h6 class="title"><?= $subject ?></h6>
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
                                                                        <img src="../uploaded_files/<?= $fetch_videos['thumbnail']; ?>" class="thumbnail" width=98% height=150px alt="">
                                                                        <h6 class="card-subtitle mb-2 "><?= $fetch_videos['Updationdate']; ?></h6>
                                                                        <p class="card-text"><?= $fetch_videos['description']; ?></p>
                                                                        <div class="w3-section">
                                                                            <form action="" method="post" class="flex-btn">
                                                                                <input type="hidden" name="video_id" value="<?= $video_id; ?>">
                                                                                
                                                                                <a href="s-view_content.php?get_id=<?= $video_id; ?>" class="w3-button w3-gray btn-custom">View Video</a>
                                                                                
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
                                                }}
                                            }
                                            ?>
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
    <script src="../js/jquery/jquery-2.2.4.min.js"></script>
    <script src="../js/bootstrap/bootstrap.min.js"></script>
    <script src="../js/pace/pace.min.js"></script>
    <script src="../js/lobipanel/lobipanel.min.js"></script>
    <script src="../js/iscroll/iscroll.js"></script>
    <script src="../js/prism/prism.js"></script>
    <script src="../js/select2/select2.min.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>