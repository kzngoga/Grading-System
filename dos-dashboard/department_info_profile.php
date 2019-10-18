<?php
include("../connection/connect.php");
include("session/session.php");

// // Retrieve Users Data

$retr = "Select * From users where user_ID = '$session_Id'";
$run_retr = mysqli_query($con, $retr);
$row_retr = mysqli_fetch_array($run_retr);
$fname = $row_retr['user_Fname'];

if(isset($_GET['class'])){
$departId = $_GET['class'];
$select = "Select * From Department where dep_ID = '$departId'";
$run_select = mysqli_query($con,$select);
$fetch_select = mysqli_fetch_array($run_select);
$departName = $fetch_select['dep_Name'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $fname;?> | Department Info.</title>

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
          <a href="index.php" class="nav-link">
          <i class="fa fa-home dash-icon"></i> Home</a></li>

          <li class="nav-item">
          <a href="add_department.php" class="nav-link">
          <i class="fas fa-user-edit dash-icon"></i> Add Department</a></li>
          <li class="nav-item">
          <a href="view_department.php" class="nav-link"><i class="fa fa-building dash-icon"></i>  Department 
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
          <a href="class_info.php" class="nav-link active">
          <i class="fas fa-school dash-icon"></i> Class Info.
          </a></li>
        </ul>
      </div>
    </nav>   
            
    <main role="main" class="col-md-10 ml-sm-auto px-4">
      <div class="dash-output-section">
        <h2><?php echo $departName;?> Department</h2>
        <ul class="nav sub-nav">
           <li class="nav-item">
            <p class="nav-link sub-nav-head"><i class="fas fa-info-circle"></i> Class Info.</p>
          </li>     
          <li class="nav-item">
            <a href="department_info_profile.php?class=<?php echo $departId;?>" class="nav-link active">
              Class Profile
            </a>
          </li>               
          <li class="nav-item">
            <a href="department_info_courses.php?class=<?php echo $departId;?>" class="nav-link">
              Courses Taught
            </a>
          </li>          
          <li class="nav-item dropdown">
            <a href="department_info_students.php?class=<?php echo $departId;?>" class="nav-link" data-toggle="dropdown">
              Active Students <i class="fas fa-caret-down"></i>
            </a>
            <div class="dropdown-menu sub-nav-dropdown">
              <a class="dropdown-item" 
              href="department_info_shift1.php?class=<?php echo $departId;?>"><i class="fas fa-sun sub-icon"></i> 8h - 10h</a>
              <a class="dropdown-item" 
              href="department_info_shift2.php?class=<?php echo $departId;?>"><i class="fas fa-sun sub-icon"></i> 11h - 13h</a>
              <a class="dropdown-item" 
              href="department_info_shift3.php?class=<?php echo $departId;?>"><i class="fas fa-cloud-sun sub-icon"></i> 15h - 17h</a>
              <a class="dropdown-item" 
              href="department_info_shift4.php?class=<?php echo $departId;?>"><i class="fas fa-cloud-moon sub-icon"></i> 18h - 20h</a>
              <a class="dropdown-item" 
              href="department_info_shift5.php?class=<?php echo $departId;?>"><i class="fab fa-weebly sub-icon"></i> Weekend</a>
            </div>
          </li>          
        </ul>
        <div class="info-display">
          <h3 class="">Class Teacher(s)</h3>  
          <div class="teachers">
          <?php
          $select_teacher = "Select teacher.teacher_ID,teacher.teacher_Fname,teacher.teacher_Lname,
          department.dep_Name FROM teacher INNER JOIN department 
          ON teacher.dep_ID = department.dep_ID WHERE department.dep_ID = '$departId'";
          $run_select_teacher = mysqli_query($con, $select_teacher);
          $num = 0;
          while($row_select_teacher = mysqli_fetch_array($run_select_teacher)){
          $tchrFname = $row_select_teacher['teacher_Fname'];
          $tchrLname = $row_select_teacher['teacher_Lname'];
          $tchrId = $row_select_teacher['teacher_ID'];
          $num++;   
          ?>    
            <p><i class="fas fa-chalkboard-teacher"></i> <?php echo $num . "." ." " . $tchrLname . " " . $tchrFname . "<br>" ;?></p>
          <?php }?>
            <!-- <p><i class="fas fa-chalkboard-teacher"></i> Mualimu Bombe</p> -->
          </div>

          <h3 class="">Other Information</h3>
          <div class="row">                           
            <div class="col-md-4">
              <div class=" display-div">
                <div class="row">
                  <div class="col-md-6">
                    <span class="display-icon">
                      <i class="fas fa-book-open"></i>
                    </span>
                  </div>            
                  <div class="col-md-6 text-right">
                    <h3><?php
                      $count = "Select count(*) as NberOfData from courses WHERE dep_ID ='$departId'";
                      $run_count = mysqli_query($con, $count);
                      $row_count = mysqli_fetch_array($run_count);
                      $count_data = $row_count['NberOfData'];
                      echo $count_data; 
                      ?>  </h3>
                    <span class="display-heading">
                      <?php
                      if($count_data == 1){
                        echo "Course";
                      }

                      else{
                        echo "Courses";
                      }
                      ?>
                      <i class="fas fa-check-circle"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>                   
            <div class="col-md-4">
              <div class=" display-div" style="border-top: 3px solid #1ca48c;">
                <div class="row">
                  <div class="col-md-6">
                    <span class="display-icon" style="background-color: #1ca48c;">
                      <i class="fas fa-chalkboard-teacher"></i>
                    </span>
                  </div>            
                  <div class="col-md-6 text-right">
                    <h3><?php
                      $count = "Select count(*) as NberOfData from teacher WHERE dep_ID ='$departId'";
                      $run_count = mysqli_query($con, $count);
                      $row_count = mysqli_fetch_array($run_count);
                      $count_data = $row_count['NberOfData'];
                      echo $count_data; 
                      ?> </h3>
                    <span class="display-heading" style="background-color: #1ca48c;">
                      <?php
                      if($count_data == 1){
                        echo "Teacher";
                      }

                      else{
                        echo "Teachers";
                      }
                      ?>
                      <i class="fas fa-check-circle"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>             

            <div class="col-md-4">
              <div class=" display-div" style="border-top: 3px solid #5d6a7d;">
                <div class="row">
                  <div class="col-md-6">
                    <span class="display-icon" style="background-color: #5d6a7d;">
                      <i class="fas fa-user-graduate"></i>
                    </span>
                  </div>            
                  <div class="col-md-6 text-right">
                    <h3><?php
                      $count = "Select count(*) as NberOfData from student WHERE dep_ID ='$departId' AND status = 'On'";
                      $run_count = mysqli_query($con, $count);
                      $row_count = mysqli_fetch_array($run_count);
                      $count_data = $row_count['NberOfData'];
                      echo $count_data; 
                      ?></h3>
                    <span class="display-heading" style="background-color: #5d6a7d;">
                      <?php
                      if($count_data == 1){
                        echo "Student";
                      }

                      else{
                        echo "Students";
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
      </div>
    </main> 
  </div>
</div>
<script>
new WOW().init();
</script>   
</body>
</html>
