<?php
include("../connection/connect.php");
include("session/session.php");

// // Retrieve Users Data

$retr = "Select teacher.teacher_ID,teacher.teacher_Fname,department.dep_Name,department.dep_ID 
FROM teacher INNER JOIN department ON teacher.dep_ID = department.dep_ID 
AND teacher.teacher_ID = '$session_Id'";
$run_retr = mysqli_query($con, $retr);
$row_retr = mysqli_fetch_array($run_retr);
$fname = $row_retr['teacher_Fname'];
$tchrId = $row_retr['teacher_ID'];
$depart = $row_retr['dep_Name'];
$departID = $row_retr['dep_ID'];

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
<script src="../js/wow.min.js"></script>
<style>
.invalid{
  animation: shake 0.82s cubic-bezier(.36,.07,.19,.97) both;
  transform: translate3d(0, 0, 0);
  backface-visibility: hidden;
  perspective: 1000px;
}

@keyframes shake {
  10%, 90% {
    transform: translate3d(-1px, 0, 0);
  }
  
  20%, 80% {
    transform: translate3d(2px, 0, 0);
  }

  30%, 50%, 70% {
    transform: translate3d(-4px, 0, 0);
  }

  40%, 60% {
    transform: translate3d(4px, 0, 0);
  }
}
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
          <a href="view_courses.php" class="nav-link">
          <i class="fa fa-book-open dash-icon"></i> My Courses 
          <span class="badge badge-primary">
              <?php
              $count = "Select count(*) as NberOfData from courses where dep_ID = '$departID' and status='on'";
              $run_count = mysqli_query($con, $count);
              $row_count = mysqli_fetch_array($run_count);
              $count_data = $row_count['NberOfData'];
              echo $count_data; 
              ?>
          </span>
          </a></li>

          <li class="nav-item">
          <a href="view_students_shift1.php" class="nav-link">
          <i class="fa fa-user-graduate dash-icon"></i> My Students 
          <span class="badge badge-primary active-badge">
              <?php
              $count = "Select count(*) as NberOfData from student where dep_ID = '$departID' AND status='on'";
              $run_count = mysqli_query($con, $count);
              $row_count = mysqli_fetch_array($run_count);
              $count_data = $row_count['NberOfData'];
              echo $count_data; 
              ?>
          </span>
          </a></li>

          <li class="nav-item">
          <a href="marks_page.php" class="nav-link">
          <i class="fa fa-file-alt dash-icon"></i> Students Marks</a></li>

          </ul>
      </div>
    </nav>

    <main role="main" class="col-md-10 ml-sm-auto px-4">
      <div class="dash-output-section"> 
        <h2>Reset My Password</h2>  
        <form action="reset_action.php" method="POST" 
        id="myForm">
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="password" class="">New Password</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" 
              onfocusout="validatePassword()" onfocus="removeOutline()">
              <span class="helper-text"></span>
            </div>
          </div>            
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="confPassword" class="">Confirm New Password</label>
              <input type="password" name="confPassword" id="confPassword" class="form-control" placeholder="Confirm Password" 
              onfocusout="validateConfirmPassword()" onfocus="removeOutline()">
              <span class="helper-text"></span>
            </div>
          </div>                    
          <div class="form-group">
           <input type="checkbox" id="check" onclick="showPass()" style="">
           <label for="check" style="display: inline !important; font-size: 15px !important;  height: 0px !important; vertical-align: bottom;">Show Password</label>
          </div>                  
          <div class="form-group">
            <button class="btn btn-primary form-control" style="" type="submit" name="pwd" id="pwd"><span>Reset Password</span></button>
         </div>
        </form>              
      </div>
    </main>    
  </div>
</div>
<script>
new WOW().init();
</script>
<script>
function showPass(){
  var pass = document.getElementById('check').checked;
  if(pass){
  password.setAttribute('type','text');
  confPassword.setAttribute('type','text');
  }

  else{
    password.setAttribute('type','password');
    confPassword.setAttribute('type','password');
  }
}
</script>

<script type="text/javascript" src="../js/script_res_pwd.js"></script>
</body>
</html>
