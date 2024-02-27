<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SRMS Admin| Student Comments< </title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="css/select2/select2.min.css" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
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

<style>
 .row .image{
   flex: 1 1 40rem;
}

.row .image img{
   width: 100%;
   height: 50rem;
}

 .row .content{
   flex: 1 1 40rem;
   text-align: center;
}

 .row .content h3{
   font-size: 2.5rem;
   color: var(--black);
}

.row .content p{
   line-height: 2;
   font-size: 1.8rem;
   color: var(--light-color);
   padding: 1rem 0;
}

.box-container{
   margin-top: 3rem;
   display: flex;
   gap: 1.5rem;
   flex-wrap: wrap;
}

 .box-container .box{
   flex: 1 1 25rem;
   display: flex;
   background-color: var(--white);
   border-radius: .5rem;
   padding: 2rem;
   align-items: center;
   gap: 2rem;
}

 .box-container .box i{
   font-size: 3rem;
   color: var(--black);
}

.box-container .box h3{
   color: var(--main-color);
   font-size: 2.5rem;
   margin-bottom: .2rem;
}

 .box-container .box span{
   font-size: 1.6rem;
   color: var(--light-color);
}


 .user{
   display: flex;
   align-items: center;
   gap: 1.5rem;
   margin-top: 1.5rem;
}

 .user img{
   height: 5rem;
   width: 5rem;
   border-radius: 50%;
   object-fit: cover;
}

 h3{
   font-size: 2rem;
   color: var(--black);
   margin-bottom: .2rem;
}

.stars i{
   color: var(--main-color);
   font-size: 1.5rem;
}



</style>

                    <div class="main-page">

                     <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Student Comments</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                
                                        <li class="active">Student Comments</li>
                                    </ul>
                                </div>
                             
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="container-fluid">
                           
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Student Coments</h5>
                                                </div>
                                            </div>
                                           <div class="panel-body">

                                         
   
<div class = "box-container">
   <div class="box">
      <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo fugiat, quaerat voluptate odio consectetur assumenda fugit maxime unde at ex?</p>
      <div class="user">
         <img src="images/pic-2.jpg" alt="">
         <div>
            <h3>john deo</h3>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
         </div>
      </div>
   </div>

   <div class="box">
      <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo fugiat, quaerat voluptate odio consectetur assumenda fugit maxime unde at ex?</p>
      <div class="user">
         <img src="images/pic-3.jpg" alt="">
         <div>
            <h3>john deo</h3>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
         </div>
      </div>
   </div>

   <div class="box">
      <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo fugiat, quaerat voluptate odio consectetur assumenda fugit maxime unde at ex?</p>
      <div class="user">
         <img src="images/pic-4.jpg" alt="">
         <div>
            <h3>john deo</h3>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
         </div>
      </div>
   </div>

   <div class="box">
      <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo fugiat, quaerat voluptate odio consectetur assumenda fugit maxime unde at ex?</p>
      <div class="user">
         <img src="images/pic-5.jpg" alt="">
         <div>
            <h3>john deo</h3>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
         </div>
      </div>
   </div>

   <div class="box">
      <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo fugiat, quaerat voluptate odio consectetur assumenda fugit maxime unde at ex?</p>
      <div class="user">
         <img src="images/pic-6.jpg" alt="">
         <div>
            <h3>john deo</h3>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
         </div>
      </div>
   </div>

   <div class="box">
      <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo fugiat, quaerat voluptate odio consectetur assumenda fugit maxime unde at ex?</p>
      <div class="user">
         <img src="images/pic-7.jpg" alt="">
         <div>
            <h3>john deo</h3>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
         </div>
      </div>
   </div>

</div>

<section>
<div class="box-container">

<div class="box">
   <i class="fas fa-graduation-cap"></i>
   <div>
      <h3>+1k</h3>
      <span>online courses</span>
   </div>
</div>

<div class="box">
   <i class="fas fa-user-graduate"></i>
   <div>
      <h3>+25k</h3>
      <span>brilliants students</span>
   </div>
</div>

<div class="box">
   <i class="fas fa-chalkboard-user"></i>
   <div>
      <h3>+5k</h3>
      <span>expert teachers</span>
   </div>
</div>
</section>

</section>

<!-- reviews section ends -->

 <!-- /.main-wrapper -->
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
        


