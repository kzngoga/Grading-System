<?php
include("../connection/connect.php");
include("session/session.php");

// // Retrieve Users Data

$retr = "Select * From users where user_ID = '$session_Id'";
$run_retr = mysqli_query($con, $retr);
$row_retr = mysqli_fetch_array($run_retr);
$fname = $row_retr['user_Fname'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $fname;?> | Classes Info.</title>

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
        <h2>Class Information</h2>
        <?php 
            $select = "Select * From department where status = 'On'
            GROUP BY dep_ID";

            $run_select = mysqli_query($con, $select);
            $i= 1;
        ?>
        <?php while($row = mysqli_fetch_array($run_select)){ ?>
        <?php if ($i % 2 !== 0){ ?>
        <div class="row mt-4">
            <div class="col-md-6">
            <div class="course-section">
                <h3><?php echo $row["dep_Name"];?> Class</h3>
                <div class="row">
                <div class="col-md-6">
                    <a href="department_info_profile.php?class=<?php echo $row["dep_ID"];?>" 
                    class="btn btn-primary"><i class="fas fa-school"></i> 
                    View Class Info</a>
                </div>                  
                </div>
            </div>
            </div> 
            <?php } 
            else { ?>
              <div class="col-md-6">
              <div class="course-section" style="border-left: 5px solid #5d6a7d;">
                  <h3><?php echo $row["dep_Name"];?> Class</h3>
                  <div class="row">
                  <div class="col-md-6">
                      <a href="department_info_profile.php?class=<?php echo $row["dep_ID"];?>" 
                      class="btn btn-dark"><i class="fas fa-school"></i>
                      View Class Info</a>
                  </div>                  
                  </div>
              </div>
              </div>
        </div>
        <?php } ?>

        <?php $i++; } ?>                                     
      </div>
    </main> 
  </div>
</div> 
<script>
new WOW().init();
</script> 
</body>
</html>
