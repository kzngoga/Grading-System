<?php
include("../connection/connect.php");
include("session/session.php");

// Retrieve Users Data
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
<title><?php echo $fname;?> | View Courses</title>

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
        <a href="view_courses.php" class="nav-link active">
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

    <main role="main" class="col-md-10 ml-sm-auto px-3">
      <div class="dash-output-section">
        <h2><?php echo $depart;?> Courses </h2>       
        <div class="table-responsive">
          <table class="table table-striped">
           <thead>
            <th>N0.</th>
            <th>Course Name</th>
            <th>Total Test Marks</th>
            <th>Total Exam Marks</th>
            <th>Overall Marks</th>
           </thead>
             <?php
              $select = "Select courses.course_ID,courses.course_Name,
                        courses.total_Marks,department.dep_Name FROM courses INNER JOIN department 
                        ON courses.dep_ID = department.dep_ID WHERE department.dep_ID = '$departID' AND courses.status = 'On'";
              $run_select = mysqli_query($con, $select);
              $number_of_results = mysqli_num_rows($run_select);
              $results_per_page = 5;
              $nber_of_Pages = ceil($number_of_results / $results_per_page);

              if(!isset($_GET['page'])){
                  $page = 1;
                }
                else{
                  $page = $_GET['page'];
                }

              $this_page_first_result = ($page - 1) * $results_per_page;

              $select = "Select courses.course_ID,courses.course_Name,
                        courses.total_Marks,department.dep_Name FROM courses INNER JOIN department 
                        ON courses.dep_ID = department.dep_ID WHERE department.dep_ID = '$departID' AND courses.status = 'On'
              LIMIT " . $this_page_first_result . ',' . $results_per_page;
              
              $run_select = mysqli_query($con, $select);
              $num = $this_page_first_result;
              while($row_select = mysqli_fetch_array($run_select)){
               $cId = $row_select['course_ID'];
               $cName = $row_select['course_Name'];
               $depName = $row_select['dep_Name'];
               $marks = $row_select['total_Marks'];
               $num++;

               if(is_null($cName)){
                $cName = "Null";
               }
              ?>
              <tr>
              <td><?php echo $num; ?></td>
              <td><?php echo $cName; ?></td>
              <td><?php echo $marks; ?></td>
              <td><?php echo $marks; ?></td>
              <td><?php echo $marks*2; ?></td>
              </tr>
              <?php }?>
                <?php
                 if ($number_of_results == 0) {
                  echo "<tr>
                  <td colspan='14' style='text-align: center; font-size: 28px;'>
                  <i class='fas fa-sad-tear'></i> There Are No records in this table!</td>
                  </tr>";
                 }
                ?>   
          </table> 

          <ul class="pagination justify-content-end">
          <!-- display Pages -->
          <?php
          //display the links to the pages
            if($page>1){
              echo '<li class="page-item"><a
              class="page-link" 
              href="view_courses.php?page='. ($page-1) .'" style="background: #1ca48c; color: #f2f2f2;"> <i class="fas fa-caret-left"></i> Prev</a></li>';
          }
          for($i=1; $i<=$nber_of_Pages; $i+=1){
              echo '<li class="page-item"><a
              class="page-link" 
              href="view_courses.php?page='. $i .'"> '. $i .' </a></li>';
          }
          if($i-1>$page){
          echo '<li class="page-item"><a
          class="page-link" 
          href="view_courses.php?page='. ($page+1) .'" style="background: #1ca48c; color: #f2f2f2;"> Next <i class="fas fa-caret-right"></i></a></li>';
          }          
          ?>
          </ul>
      </div>
    </main> 
  </div>
</div>
<script>
new WOW().init();
</script>
</body>
</html>
