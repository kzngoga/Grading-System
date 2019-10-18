<?php
include("../connection/connect.php");
include("session/session.php");

// Retrieve Users Data

$retr = "Select * From users where user_ID = '$session_Id'";
$run_retr = mysqli_query($con, $retr);
$row_retr = mysqli_fetch_array($run_retr);
$fname = $row_retr['user_Fname'];
$userId = $row_retr['user_ID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $fname;?> | Student Grading System</title>

<!-- META TAGS, Website SEO, Author, Keywords, Responsiveness -->

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- LINKS OF THE WEBSITE, STYLING FILES, AND THE WEBSITE HEADER ICON-->

<link rel="icon" href="../img/logo.png">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/all.min.css">
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/animate.css">


<script src="../js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/all.min.js"></script>
<script src="../js/main-script.js"></script>
<script src="../js/wow.min.js"></script>
<style>

</style>
</head>

<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top main-nav">
  <div class="container">
        <a class="navbar-brand" href="index.php"><i class="fas fa-book logo-icon"></i> Grading <span class="fat">System</span></a>

      <ul class="nav navbar-nav ml-auto lang-switcher">
      <li class="nav-item">
      <span class="user-img">
        <span class="user-icon">
          <i class="fas fa-user-lock"></i>
        </span>
        <span class="status online"></span>
      </span> <span class="hello-user">Hey, <?php echo $fname;?>!</span>
      </li>       

      <li class="nav-item">
        <a class="nav-link" href="logout.php">
        <i class="fas fa-sign-out-alt"></i> Logout</a>
      </li>
      </ul>
    </div>
</nav>
<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block sidebar">
      <div class="sidebar-sticky">
        <div class="dash-salute wow bounceInLeft" data-wow-duration="2s">
            <?php
            $time = date("H");
            if(($time >="0") && ($time <"12")){
                echo"<h4><i class='fas fa-sun'></i> Good Morning!</h4>";
            }

            else if(($time >="12") && ($time <"18")){
                echo"<h4><i class='fas fa-cloud-sun'></i > Good Afternoon!</h4>";
            }

            else if(($time >="18") && ($time <"22")){
                echo"<h4><i class='fas fa-cloud-moon'></i> Good Evening!</h4>";
            }

            else{
                echo"<h4><i class='fas fa-moon'></i> Good Night!</h4>";
            }
            ?>
        </div>
        <ul class="nav flex-column dash-nav">
          <li class="nav-item">
          <a href="index.php" class="nav-link active">
          <i class="fa fa-home dash-icon"></i> Home</a></li>

          <li class="nav-item">
          <a href="add_department.php" class="nav-link">
          <i class="fas fa-user-edit dash-icon"></i> Add Department</a></li>
          <li class="nav-item">
          <a href="view_department.php" class="nav-link">
            <i class="fa fa-building dash-icon"></i>  Department 
          <span class="badge badge-primary">
              <?php
              $count = "Select count(*) as NberOfData from department";
              $run_count = mysqli_query($con, $count);
              $row_count = mysqli_fetch_array($run_count);
              $count_data = $row_count['NberOfData'];
              echo $count_data; 
              ?>
          </span>
          </a></li>  

          <li class="nav-item">
          <a href="view_students.php" class="nav-link">
          <i class="fas fa-user-graduate dash-icon"></i> View Students 
          <span class="badge badge-primary">
              <?php
              $count = "Select count(*) as NberOfData from student";
              $run_count = mysqli_query($con, $count);
              $row_count = mysqli_fetch_array($run_count);
              $count_data = $row_count['NberOfData'];
              echo $count_data; 
              ?>
          </span>
          </a></li>                
          
          <li class="nav-item">
          <a href="class_info.php" class="nav-link">
          <i class="fas fa-school dash-icon"></i> Class Info.
          </a></li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-10 ml-sm-auto px-4">
      <div class="dash-output-section">
        <div class="welcome">
          <h1 class=""><i class="fas fa-user-lock"></i> Welcome <?php echo $fname;?> </h1>
          <p class="text-center">Your Login was succesfull and Now you are able to use "STUDENT GRADING SYSTEM"</p>
        </div>    
        <div class="activities">
          <!-- <h1 class="text-center">Main Activities</h1> -->
          <div class="row">                           
            <div class="col-md-4">
              <div class=" activity-div">
                <div class="row">
                  <div class="col-md-6">
                    <span class="activity-icon">
                      <i class="fas fa-user-graduate"></i>
                    </span>
                  </div>            
                  <div class="col-md-6 text-right">
                    <h3>
                      <?php
                      $count = "Select count(*) as NberOfData from student";
                      $run_count = mysqli_query($con, $count);
                      $row_count = mysqli_fetch_array($run_count);
                      $count_data = $row_count['NberOfData'];
                      echo $count_data; 
                      ?>      
                    </h3>
                    <span class="activity-heading">
                      <?php
                      if($count_data == 1){
                        echo "All";
                      }

                      else{
                        echo "All";
                      }
                      ?> 
                      <i class="fas fa-check-circle"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>                   

            <div class="col-md-4">
              <div class=" activity-div" style="border-top: 3px solid #1ca48c;">
                <div class="row">
                  <div class="col-md-6">
                    <span class="activity-icon" style="background-color: #1ca48c;">
                      <i class="fas fa-chalkboard-teacher"></i>
                    </span>
                  </div>            
                  <div class="col-md-6 text-right">
                    <h3>
                      <?php
                      $count = "Select count(*) as NberOfData from department";
                      $run_count = mysqli_query($con, $count);
                      $row_count = mysqli_fetch_array($run_count);
                      $count_data = $row_count['NberOfData'];
                      echo $count_data; 
                      ?> 
                    </h3>
                    <span class="activity-heading" style="background-color: #1ca48c;">
                      <?php
                      if($count_data == 1){
                        echo "Class";
                      }

                      else{
                        echo "Classes";
                      }
                      ?> 
                      <i class="fas fa-check-circle"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>                   

            <div class="col-md-4">
              <div class=" activity-div" style="border-top: 3px solid #5d6a7d;">
                <div class="row">
                  <div class="col-md-6">
                    <span class="activity-icon" style="background-color: #5d6a7d;">
                      <i class="fas fa-user-graduate"></i>
                    </span>
                  </div>            
                  <div class="col-md-6 text-right">
                    <h3>
                      <?php
                      $count = "Select count(*) as NberOfData from student WHERE status = 'On'";
                      $run_count = mysqli_query($con, $count);
                      $row_count = mysqli_fetch_array($run_count);
                      $count_data = $row_count['NberOfData'];
                      echo $count_data; 
                      ?> 
                    </h3>
                    <span class="activity-heading" style="background-color: #5d6a7d;">
                      <?php
                      if($count_data == 1){
                        echo "Active Student";
                      }

                      else{
                        echo "Active";
                      }
                      ?> 
                      <i class="fas fa-check-circle"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>              
          </div>
        </div>
        <a class="btn btn-primary back-btn mt-3" 
        href="" data-target="#reset" data-toggle="modal">
        <span>Reset Password <i class="fas fa-lock"></i></span></a>        
        <a class="btn btn-primary back-btn mt-3" 
        href="updates/edit_profile_user.php">
        <span>Edit Profile <i class="fas fa-user-edit"></i></span></a>
        <div class="modal" id="reset">
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title"> Reseting Password</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
              <!-- PHP CODE FOR CHECKING OLD PASSWORD -->
              <?php
                $msg = "";
                if(isset($_POST['check'])){
                  $password = $_POST['password'];
                  $pass = MD5($password);
                  $select_old_pwd = "Select * from users WHERE password = '$pass'
                  AND user_ID = '$userId'";
                  $run_select_old_pwd  = mysqli_query($con,$select_old_pwd);
                  $row_select_old_pwd = mysqli_fetch_array($run_select_old_pwd);
                  $check_pwd = mysqli_num_rows($run_select_old_pwd);
                  if($check_pwd > 0){
                    echo "<script>window.open('reset_password.php','_self')</script>";
                  }

                  else{
                    $msg = "<span id='error' style='background-color: #ff4d4d; color: #f2f2f2; padding: 8px; border-radius: 10px;'> <i class='fas fa-times'></i> ** Incorrect Password! </span>";
                  }
                }
              ?>
              <!-- Modal body -->
              <div class="modal-body">
                Please Enter Your Old Password to be able to renew your password!
                <form action="index.php" method="post">
                  <div class="form-group">
                    <label for="password" class="mt-3">Old Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" required>
                  </div>                    
                  <div class="form-group">
                   <input type="checkbox" id="check" onclick="showPass()" style="">
                   <label for="check" style="display: inline !important; font-size: 14px !important;  height: 0px !important; vertical-align: bottom;">Show Password</label>
                  </div>                  
                  <div class="form-group">
                    <button class="btn btn-outline-light form-control" style="" type="submit" name="check" id="check"class="form-control"><span>Check </span></button>
                 </div>
                 <span id="error"> 
                   <?php echo "" . " " . $msg;?></span>
                </form>
              </div>

            </div>
          </div>
        </div>           
      </div>
    </main>    
  </div>
</div>
<script>
new WOW().init();
</script>

<script>
// function validate(){
//   const uname = document.getElementById('uname').value;
//   const password = document.getElementById('password').value;

// }

function showPass(){
  var pass = document.getElementById('check').checked;
  if(pass){
          password.setAttribute('type','text');
  }

  else{
    password.setAttribute('type','password');
  }
}
</script>
</body>
</html>
