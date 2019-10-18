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
<title><?php echo $fname;?> | Search Results</title>

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
          <a href="view_teachers.php" class="nav-link active"><i class="fa fa-chalkboard-teacher dash-icon"></i> View Teachers 
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
          <a href="view_students.php" class="nav-link">
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
        <h2>Search Results</h2>        
        <a class="btn btn-primary back-btn mt-3" 
        href="view_teachers.php"><span>Back To Full List</span></a>        
        <div class="table-responsive mt-4">
          <table class="table table-striped">
           <thead>
            <th>N0.</th>
            <th>Lastname</th>
            <th>Firstname</th>
            <th>E-Mail</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Department</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Remove</th>
           </thead>
             <?php
                if(isset($_POST['search'])){
                  //We use mysqli_real_escape_string() to avoid sql injections

                  $searchBox = mysqli_real_escape_string($con, $_POST['sBox']);
                  $sql = "Select teacher.teacher_ID,teacher.teacher_Fname,teacher.teacher_Lname,
                        teacher.teacher_Mail,teacher.teacher_Gen,teacher.teacher_Address,
                        teacher.teacher_Phone,department.dep_Name,teacher.status  
                        FROM teacher LEFT JOIN department 
                        ON teacher.dep_ID = department.dep_ID WHERE 
                  teacher_Fname LIKE '%$searchBox%' 
                  OR teacher_Lname LIKE '%$searchBox%' ORDER BY teacher.teacher_Lname";

                  $result = mysqli_query($con, $sql);
                  $number_of_results = mysqli_num_rows($result);
                  $results_per_page = 5;
                  $nber_of_Pages = ceil($number_of_results / $results_per_page);
                  if(!isset($_GET['page'])){
                      $page = 1;
                    }
                    else{
                      $page = $_GET['page'];
                    }

                  $this_page_first_result = ($page - 1) * $results_per_page;

                  $sql = "Select teacher.teacher_ID,teacher.teacher_Fname,teacher.teacher_Lname,
                        teacher.teacher_Mail,teacher.teacher_Gen,teacher.teacher_Address,
                        teacher.teacher_Phone,department.dep_Name,teacher.status  
                        FROM teacher LEFT JOIN department 
                        ON teacher.dep_ID = department.dep_ID WHERE 
                  teacher_Fname LIKE '%$searchBox%' 
                  OR teacher_Lname LIKE '%$searchBox%' ORDER BY teacher.teacher_Lname
                  LIMIT" . $this_page_first_result . ',' . $results_per_page;

                  $num = $this_page_first_result;
                  if($number_of_results > 0){
                    while($row_select = mysqli_fetch_assoc($result)){
                     $tchrID = $row_select['teacher_ID'];
                     $fname = $row_select['teacher_Fname'];
                     $lname = $row_select['teacher_Lname'];
                     $dob = $row_select['teacher_Mail'];
                     $gender = $row_select['teacher_Gen'];
                     $address = $row_select['teacher_Address'];
                     $phone = $row_select['teacher_Phone'];
                     $depName = $row_select['dep_Name'];
                     $status = $row_select['status'];
                     $num++;                   
                      echo "<tr>
                      <td>$num</td>
                      <td>$lname</td>
                      <td>$fname</td>
                      <td>$dob</td>
                      <td>$gender</td>
                      <td>$address</td>
                      <td>$phone</td>
                      <td>$depName</td>
                      <td>$status</td>
                      <td><a href='updates/update_teacher.php?editTchr=$tchrID'><button type='button' 
                      class='btn btn-success' title='Update'>
                      <span class='fa fa-pen'></span></button></a></td>                      
                      <td><button type='button' 
                      class='btn btn-danger' title='Remove' data-toggle='modal' data-target='#remove$tchrID'>
                      <span class='fa fa-trash'></span></button></td>
                      </tr>";
                      ?>
                <div class="modal" id="remove<?php echo $tchrID;?>">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title"> Remove Teacher From Active Teachers</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                    Are You Sure you want to remove "<?php echo $lname . " " . $fname;?>" from Grading System
                    Active Teachers?
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <a href="removed/remove_user.php?removeUser=<?php echo $tchrID;?>" 
                      class="btn btn-primary"><i class="fas fa-check-circle"></i> Remove</a>
                      <button type="button" class="btn btn-danger" 
                      data-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>
                    </div>

                  </div>
                </div>
              </div>   <?php
                     }
                   }
                  else{
                  echo "<tr>
                  <td colspan='14' style='text-align: center; font-size: 28px;'>
                  <i class='fas fa-sad-tear'></i> Ooops There Are No result matching your search!</td>
                  </tr>";
                  }
                }
              ?>
          </table>       
      </div>
    </main> 
  </div>
</div>
<script>
new WOW().init();
</script>
</body>
</html>