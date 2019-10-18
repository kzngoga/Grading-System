<?php
include("../connection/connect.php");
include("session/session.php");

// // Retrieve Users Data

$retr = "Select student.student_ID,student.student_Fname,department.dep_Name,department.dep_ID 
FROM student INNER JOIN department ON student.dep_ID = department.dep_ID 
AND student.student_ID = '$session_Id'";
$run_retr = mysqli_query($con, $retr);
$row_retr = mysqli_fetch_array($run_retr);
$fname = $row_retr['student_Fname'];
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
        <a href="view_courses.php" class="nav-link">
        <i class="fa fa-book-open dash-icon"></i> My Courses 
        <span class="badge badge-primary active-badge">
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
        <a href="view_marks.php" class="nav-link">
        <i class="fa fa-user-graduate dash-icon"></i> My Marks 
        </a></li>

        <li class="nav-item">
        <a href="student_transcript.php" class="nav-link" target="_blank">
        <i class="fa fa-file-alt dash-icon"></i> View Transcript</a></li>

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
                      <i class="fas fa-book-open"></i>
                    </span>
                  </div>            
                  <div class="col-md-6 text-right">
                    <h3>
                      <?php
                      $count = "Select count(*) as NberOfData from courses where dep_ID = '$departID'and status='on'";
                      $run_count = mysqli_query($con, $count);
                      $row_count = mysqli_fetch_array($run_count);
                      $count_data = $row_count['NberOfData'];
                      echo $count_data; 
                      ?>      
                    </h3>
                    <span class="activity-heading">
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
          </div>
        </div>
        <a class="btn btn-primary back-btn mt-3" 
        href="updates/edit_profile_student.php">
        <span>Edit Profile <i class="fas fa-user-edit"></i></span></a>         
      </div>
    </main>    
  </div>
</div>
<script>
new WOW().init();
</script>
</body>
</html>
