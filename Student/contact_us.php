<?php
session_start();
error_reporting(0);
include('../includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: ../index.php"); 
    }
    else{
if(isset($_POST['submit']))
    {
        $name = $_POST['name']; 
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $email = $_POST['email']; 
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $class = $_POST['class']; 
        $class = filter_var($class, FILTER_SANITIZE_STRING);
        $msg = $_POST['msg']; 
        $msg = filter_var($msg, FILTER_SANITIZE_STRING);
     
        $select_contact = $conn->prepare("SELECT * FROM `contact` WHERE name = ? AND email = ? AND class = ? AND message = ?");
        $select_contact->execute([$name, $email, $class, $msg]);
     
        if($select_contact->rowCount() > 0){
           $message[] = 'message sent already!';
        }else{
           $insert_message = $conn->prepare("INSERT INTO `contact`(name, email, class, message) VALUES(?,?,?,?)");
           $insert_message->execute([$name, $email, $class, $msg]);
           $message[] = 'message sent successfully!';
        }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Contact Us</title>
        <link rel="stylesheet" href="../css/bootstrap.css" media="screen" >
        <link rel="stylesheet" href="../css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="../css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="../css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="../css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" href="../css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
        <script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>
         <style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">
            <?php include('s-topbar.php');?>   
            <div class="content-wrapper">
                <div class="content-container">
<?php include('s-leftbar.php');?>                   
 <!-- /.left-sidebar -->

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Contact Us</h2>
                                </div>
                                
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="s-dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            						
            							<li class="active">Contact Us</li>
            						</ul>
                                </div>
                               
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">

                             

                              

                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Contact Us</h5>
                                                </div>
                                            </div>
           <?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Message sent!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
  
  <div class="panel-body">

      <form  name="contact" method="post" \ onSubmit="return valid();">
          <div class="form-group has-success">
          <label for="rollid">Enter your Roll Id</label>
          <input type="text" class="form-control" id="rollid" placeholder="Enter Your Roll Id" autocomplete="off" name="rollid">
          <label for="name">Enter your name</label>
          <input type="text" class="form-control" id="name" placeholder="Enter Your name" autocomplete="off" name="name">
          <label for="email">Enter your Email</label>
          <input type="text" class="form-control" id="email" placeholder="Enter Your Email" autocomplete="off" name="email">
          <label for="class">Enter your Class</label>
         

          <select name="class" class="form-control" id="default" required="required">
<option value="">Select Class</option>
<?php $sql = "SELECT * from tblclasses";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>
<option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->ClassName); ?>&nbsp; Section-<?php echo htmlentities($result->Section); ?></option>
<?php }} ?>
 </select>
          <label for="subject">Enter your subject</label>
          
          <select name="subject" class="form-control" id="default" required="required">
<option value="">Select subject</option>
<?php $sql = "SELECT * from tblsubjects";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>
<option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->SubjectName); ?>&nbsp; Section-<?php echo htmlentities($result->Section); ?></option>
<?php }} ?>
 </select>          
         
             
             
<label for="message">Enter your message</label>         
<textarea name="msg" class="box" placeholder="enter your message here" required cols="100" rows="10" maxlength="1000"></textarea>
              
<button type="submit" class="btn btn-success btn-labeled pull-right">send<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
              
         



          
 </form>

    
  </div>

<div class="box-container">

   <div class="box">
      <i class="fas fa-phone"></i>
      <h3>phone number</h3>
      <a href="tel:1234567890">123-456-7890</a>
      <a href="tel:1112223333">111-222-3333</a>
   </div>

   <div class="box">
      <i class="fas fa-envelope"></i>
      <h3>email address</h3>
      <a href="mailto:vishahigheredu@gmail.com">vishahigheredu@gmail.com</a>
      <a href="mailto:adminwishwa@gmail.com">adminwishwa@gmail.com</a>
   </div>

   <div class="box">
      <i class="fas fa-map-marker-alt"></i>
      <h3>office address</h3>
      <a href="#">no 11/3 oruthota road gampaha</a>
   </div>


</div>

</section>
                             
  
                                          

        <!-- ========== COMMON JS FILES ========== -->
        <script src="../js/jquery/jquery-2.2.4.min.js"></script>
        <script src="../js/jquery-ui/jquery-ui.min.js"></script>
        <script src="../js/bootstrap/bootstrap.min.js"></script>
        <script src="../js/pace/pace.min.js"></script>
        <script src="../js/lobipanel/lobipanel.min.js"></script>
        <script src="../js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="../js/prism/prism.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="../js/main.js"></script>



        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
</html>
<?php  } ?>

