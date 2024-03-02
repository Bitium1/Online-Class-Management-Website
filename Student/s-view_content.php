<?php
session_start();

include('config.php');

$teacher_id = null; // Initialize $teacher_id variable



// Redirect to view_Video.php if get_id is not set
if(!isset($_GET['get_id'])){
    header('location:s-view-Video.php');
    exit(); // Ensure script stops execution after redirection
} else {
    $get_id = $_GET['get_id'];
}



if(isset($_POST['add_comment'])){

    if($student_id != ''){
 
       $id = unique_id();
       $comment_box = $_POST['comment_box'];
       $comment_box = filter_var($comment_box, FILTER_SANITIZE_STRING);
       $video_id = $_POST['video_id'];
       $video_id = filter_var($video_id, FILTER_SANITIZE_STRING);
 
       $select_content = $dbh->prepare("SELECT * FROM `video` WHERE id = ? LIMIT 1");
       $select_content->execute([$video_id]);
       $fetch_videos = $select_content->fetch(PDO::FETCH_ASSOC);
 
       $teacher_id = $fetch_videos['teacher_id'];
 
       if($select_content->rowCount() > 0){
 
          $select_comment = $dbh->prepare("SELECT * FROM `comments` WHERE video_id = ? AND student_id = ? AND teacher_id = ? AND comment = ?");
          $select_comment->execute([$video_id, $student_id, $teacher_id, $comment_box]);
 
          if($select_comment->rowCount() > 0){
             $message[] = 'comment already added!';
          }else{
             $insert_comment = $dbh->prepare("INSERT INTO `comments`(id, video_id, student_id, teacher_id, comment) VALUES(?,?,?,?,?)");
             $insert_comment->execute([$id, $video_id, $student_id, $teacher_id, $comment_box]);
             $message[] = 'new comment added!';
          }
 
       }else{
          $message[] = 'something went wrong!';
       }
 
    }else{
       $message[] = 'please login first!';
    }
 
 }

 
 if(isset($_POST['update_now'])){
 
    $update_id = $_POST['update_id'];
    $update_id = filter_var($update_id, FILTER_SANITIZE_STRING);
    $update_box = $_POST['update_box'];
    $update_box = filter_var($update_box, FILTER_SANITIZE_STRING);
 
    $verify_comment = $dbh->prepare("SELECT * FROM `comments` WHERE id = ? AND comment = ?");
    $verify_comment->execute([$update_id, $update_box]);
 
    if($verify_comment->rowCount() > 0){
       $message[] = 'comment already added!';
    }else{
       $update_comment = $dbh->prepare("UPDATE `comments` SET comment = ? WHERE id = ?");
       $update_comment->execute([$update_box, $update_id]);
       $message[] = 'comment edited successfully!';
    }
 
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
                                        
                                        <div class="panel-body">
                                            
<section class="content">
    <div class="row">
    <?php
    
    $select_videos = $dbh->prepare("SELECT * FROM `video` WHERE id = ?");
$select_videos->execute([$get_id]);
    
    if($select_videos->rowCount() > 0) {
        while($fetch_videos = $select_videos->fetch(PDO::FETCH_ASSOC)) { 
            $video_id = $fetch_videos['id'];
            $select_likes = $dbh->prepare("SELECT * FROM `likes` WHERE video_id = ?");
            $select_likes->execute([$video_id]);
            $total_likes = $select_likes->rowCount();  

            $student_id = $_SESSION['student_id'];
            $verify_likes = $dbh->prepare("SELECT * FROM `likes` WHERE student_id = ? AND video_id = ?");
            $verify_likes->execute([$student_id, $video_id]);
            $select_tutor = $dbh->prepare("SELECT * FROM `teacher` WHERE id = ? LIMIT 1");
            $select_tutor->execute([$fetch_videos['teacher_id']]);
            $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);?>
   
   <div class="container">
   <video src="../uploaded_files/<?= $fetch_videos['video']; ?>" autoplay controls width="840" height="460" poster="../uploaded_files/<?= $fetch_videos['thumb']; ?>" class="video" ></video>


      <div class="date"><i class="fas fa-calendar"></i><span><?= $fetch_videos['Updationdate']; ?></span></div>
      <h2 class="title"><?= $fetch_videos['title']; ?></h2>
      
      <div class="description"><?= $fetch_videos['description']; ?></div>
      
   <form action="" method="post" class="flex">
        
         <?php
            if($verify_likes->rowCount() > 0){
         ?>
         <button type="submit" name="like_content"><i class="fas fa-heart"></i><span>liked</span></button>
         <?php
         }else{
         ?>
         <button type="submit" name="like_content"><i class="far fa-heart"></i><span>like</span></button>
         <?php
            }
         ?>
      </form>
      
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no videos added yet!</p>';
      }
   ?>

</section>

<!-- watch video section ends -->

<!-- comments section starts  -->

<section class="comments">

   <h1 class="heading">add a comment</h1>

   <form action="" method="post" class="add-comment">
      <input type="hidden" name="video_id" value="<?= $get_id; ?>">
      <textarea name="comment_box" required placeholder="write your comment..." maxlength="1000" cols="30" rows="10"></textarea>
      <input type="submit" value="add comment" name="add_comment" class="inline-btn">
   </form>

   <h1 class="heading">user comments</h1>

   
   <div class="show-comments">
      <?php
         $select_comments = $dbh->prepare("SELECT * FROM `comments` WHERE video_id = ?");
         $select_comments->execute([$get_id]);
         if($select_comments->rowCount() > 0){
            while($fetch_comment = $select_comments->fetch(PDO::FETCH_ASSOC)){   
               $select_commentor = $dbh->prepare("SELECT * FROM `student` WHERE id = ?");
               $select_commentor->execute([$fetch_comment['student_id']]);
               $fetch_commentor = $select_commentor->fetch(PDO::FETCH_ASSOC);
      ?>
      <div class="box" style="<?php if($fetch_comment['student_id'] == $student_id){echo 'order:-1;';} ?>">
         <div class="user">
            <img src="../uploaded_files/<?= $fetch_commentor['image']; ?>" alt="">
            <div>
               <h3><?= $fetch_commentor['name']; ?></h3>
               <span><?= $fetch_comment['date']; ?></span>
            </div>
         </div>
         <p class="text"><?= $fetch_comment['comment']; ?></p>
         <?php
            if($fetch_comment['student_id'] == $student_id){ 
         ?>
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="comment_id" value="<?= $fetch_comment['id']; ?>">
            <button type="submit" name="edit_comment" class="inline-option-btn">edit comment</button>
            <button type="submit" name="delete_comment" class="inline-delete-btn" onclick="return confirm('delete this comment?');">delete comment</button>
         </form>
         <?php
         }
         ?>
      </div>
      <?php
       }
      }else{
         echo '<p class="empty">no comments added yet!</p>';
      }
      ?>
      </div>
   
</section>

<!-- comments section ends -->



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
       <?php //}}?>