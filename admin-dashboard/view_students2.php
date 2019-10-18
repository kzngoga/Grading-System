<?php
include("../connection/connect.php");
include("session/session.php");

// Retrieve Users Data

$retr = "Select * From users where user_ID = '$session_Id'";
$run_retr = mysqli_query($con, $retr);
$row_retr = mysqli_fetch_array($run_retr);
$fname = $row_retr['user_Fname'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $fname;?> | View Students</title>

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
          <a href="add_users.php" class="nav-link">
          <i class="fa fa-user-edit dash-icon"></i> Add User</a></li>

          <li class="nav-item">
          <a href="view_users.php" class="nav-link"><i class="fa fa-user-lock dash-icon"></i> System Users
          <span class="badge badge-primary">
              <?php
              $count = "Select count(*) as NberOfData from users";
              $run_count = mysqli_query($con, $count);
              $row_count = mysqli_fetch_array($run_count);
              $count_data = $row_count['NberOfData'];
              echo $count_data; 
              ?>
          </span>
          </a></li>               

          <li class="nav-item">
          <a href="add_teachers.php" class="nav-link">
          <i class="fa fa-user-edit dash-icon"></i> Add Teacher</a></li>
          <li class="nav-item">
          <a href="view_teachers.php" class="nav-link"><i class="fa fa-chalkboard-teacher dash-icon"></i> View Teachers 
          <span class="badge badge-primary">
              <?php
              $count = "Select count(*) as NberOfData from teacher";
              $run_count = mysqli_query($con, $count);
              $row_count = mysqli_fetch_array($run_count);
              $count_data = $row_count['NberOfData'];
              echo $count_data; 
              ?>
          </span>
          </a></li> 

          <li class="nav-item">
          <a href="add_students.php" class="nav-link">
          <i class="fa fa-user-edit dash-icon"></i> Add Student</a></li>

          <li class="nav-item">
          <a href="view_students.php" class="nav-link active">
          <i class="fa fa-user-graduate dash-icon"></i> View Students 
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
        </ul>
      </div>
    </nav>  
    <main role="main" class="col-md-10 ml-sm-auto px-3">
      <div class="dash-output-section">
        <h2>Students Information</h2>        
        <a class="btn btn-primary back-btn mt-3" 
        href="index.php"><span>Back To Home</span></a>        
        <a class="btn btn-primary back-btn mt-3" 
        href="update_list.php"><span>Update List</span></a>
        <form action="search.php" method = "POST" class="form-inline justify-content-end">
        <input type="text" name="sBox" id="sBox" placeholder="Search Students" class="form-control">
        <button type="submit" name="search" id="search" class="btn btn-dark">
        <i class="fas fa-search"></i>
        </button>
        </form> 
        <div class="table-responsive">
          <table class="table table-striped">
           <thead>
            <th>N0.</th>
            <th>Reg N0.</th>
            <th>Lastname</th>
            <th>Firstname</th>
            <th>Gender</th>
            <th>Department</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Parent Tel.</th>
            <th>Address</th>
            <th>Intake</th>
            <th>Shift</th>
            <th>Status</th>
            <th>Edit</th>
           </thead>
             <?php
              $select = "Select student.student_ID,student.student_Fname,student.student_Lname,
                        student.student_Mail,student.student_Gender,
                        student.student_Address,
                        student.student_Phone,student.parent_Phone,student.Reg_Num,
                        student.student_Intake,student.student_Shift,student.status, 
                        department.dep_Name FROM student INNER JOIN department 
                        ON student.dep_ID = department.dep_ID ORDER BY student.student_Lname ";
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

              $select = "Select student.student_ID,student.student_Fname,student.student_Lname,
                        student.student_Mail,student.student_Gender,
                        student.student_Address,
                        student.student_Phone,student.parent_Phone,student.Reg_Num,
                        student.student_Intake,student.student_Shift,student.status, 
                        department.dep_Name FROM student INNER JOIN department 
                        ON student.dep_ID = department.dep_ID ORDER BY student.student_Lname 
              LIMIT " . $this_page_first_result . ',' . $results_per_page;
              
              $run_select = mysqli_query($con, $select);
              $num = $this_page_first_result;
              while($row_select = mysqli_fetch_array($run_select)){
               $stdId = $row_select['student_ID'];
               $fname = $row_select['student_Fname'];
               $lname = $row_select['student_Lname'];
               $email = $row_select['student_Mail'];
               $gender = $row_select['student_Gender'];
               $address = $row_select['student_Address'];
               $phone = $row_select['student_Phone'];
               $parphone = $row_select['parent_Phone'];
               $depName = $row_select['dep_Name'];
               $regNum = $row_select['Reg_Num'];
               $intake = $row_select['student_Intake'];
               $shift = $row_select['student_Shift'];
               $status = $row_select['status'];
               $num++;
              ?>
              <tr>
              <td><?php echo $num; ?></td>
              <td><?php echo $regNum; ?></td>
              <td><?php echo $lname; ?></td>
              <td><?php echo $fname; ?></td>
              <td><?php echo $gender; ?></td>
              <td><?php echo $depName; ?></td>
              <td><?php echo $email; ?></td>
              <td><?php echo $phone; ?></td>
              <td><?php echo $parphone; ?></td>
              <td><?php echo $address; ?></td>
              <td><?php echo $intake; ?></td>
              <td><?php echo $shift; ?></td>
              <td><?php echo $status; ?></td>
              <td><a href="updates/update_student.php?editStd=<?php echo $stdId;?>"><button type="button" 
              class="btn btn-success" title="Update">
              <span class="fa fa-pen"></span></button></a></td>
              </tr>
              <?php }?>
          </table> 
          <ul class="pagination justify-content-end">
          <li class="page-item">
          <a class="page-link" 
          href="view_students.php?page=<?php echo --$page;?>" 
          id="prev">Previous</a></li>

          <?php
              if($page == 0){
              echo '<script>document.getElementById("prev").style.color = "gray"</script>';
              echo '<script>document.getElementById("prev").style.cursor = "not-allowed"</script>';
              echo '<script>document.getElementById("prev").href = "#"</script>';
              }  
          ?>
          
          <!-- display Pages -->
          <?php
          //display the links to the pages
          for($page=1; $page<=$nber_of_Pages; $page++){
              echo '<li class="page-item"><a
              class="page-link" 
              href="view_students.php?page='. $page .'"> '. $page .' </a></li>';
          }
          ?>
          <li class="page-item"><a class="page-link" 
          href="view_students.php?page=<?php echo $page++;?>">Next</a></li>
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