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
<title><?php echo $fname;?> | Department Courses</title>

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
            <a href="department_info_profile.php?class=<?php echo $departId;?>" class="nav-link">
              Class Profile
            </a>
          </li>               
          <li class="nav-item">
            <a href="department_info_courses.php?class=<?php echo $departId;?>" class="nav-link active">
              Courses Taught
            </a>
          </li>          
          <li class="nav-item dropdown">
            <a href="#" class="nav-link" data-toggle="dropdown">
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
          <h3 class="">Courses In <?php echo $departName;?></h3>  
          <form action="" class="form-inline justify-content-end">
          <input type="text" name="sBox" id="sBox" placeholder="Search Course" class="form-control">
          <button type="submit" name="search" id="search" class="btn btn-dark">
          <i class="fas fa-search"></i>
          </button>
          </form> 
          <div class="table-responsive">
            <table class="table table-striped">
             <thead>
              <th>N0.</th>
              <th>Course Name</th>
              <th>Total Marks</th>
              <th>Status</th>
              <th>Edit</th>
              <th>Remove</th>
             </thead>
               <?php
                $select = "Select courses.course_ID,courses.course_Name,
                          courses.total_Marks,department.dep_Name FROM courses INNER JOIN department 
                          ON courses.dep_ID = department.dep_ID AND department.dep_ID = '$departId'";
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

                $select = "Select courses.course_ID,courses.course_Name,courses.status,
                          courses.total_Marks,department.dep_Name FROM courses INNER JOIN department 
                          ON courses.dep_ID = department.dep_ID WHERE department.dep_ID = '$departId' AND courses.status = 'On'
                LIMIT " . $this_page_first_result . ',' . $results_per_page;
                
                $run_select = mysqli_query($con, $select);
                $num = $this_page_first_result;
                while($row_select = mysqli_fetch_array($run_select)){
                 $cId = $row_select['course_ID'];
                 $cName = $row_select['course_Name'];
                 $depName = $row_select['dep_Name'];
                 $marks = $row_select['total_Marks'];
                 $status = $row_select['status'];
                 $num++;

                 if(is_null($cName)){
                  $cName = "Null";
                 }
                ?>
                <tr>
                <td><?php echo $num; ?></td>
                <td><?php echo $cName; ?></td>
                <td><?php echo $marks; ?></td>
                <td>
                <?php 
                  if($status=== "Off"){
                    echo "<span class='off'>$status</span>";
                  }                  
                  elseif($status=== "On"){
                    echo "<span class='on'>$status</span>";
                  }                  
                  else{
                    echo $status;
                  }
                // echo $verdict;
                ?></td>
                <td><a href="updates/update_courses.php?editCrs=<?php echo $cId;?>">
                <button type="button" class="btn btn-success" 
                title="Update"><span class="fa fa-pen"></span></button></a></td>
                <td>
                <button type="button" class="btn btn-danger" 
                title="Remove" data-toggle="modal" data-target="#remove<?php echo $cId;?>">
                <span class="fa fa-trash"></span></button></td>
                </tr>
                <div class="modal" id="remove<?php echo $cId;?>">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title"> Remove Course</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>

                      <!-- Modal body -->
                      <div class="modal-body">
                      Are You Sure you want to remove "<?php echo $cName;?>" from 
                      "<?php echo $depName;?>" Courses?
                      </div>

                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <a href="removed/remove_courses.php?removeCrs=<?php echo $cId;?>" 
                        class="btn btn-primary"><i class="fas fa-check-circle"></i> Remove</a>
                        <button type="button" class="btn btn-danger" 
                        data-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>
                      </div>

                    </div>
                  </div>
                </div> 
                <?php }?>
            </table> 

            <ul class="pagination justify-content-end">
            <li class="page-item">
            <a class="page-link" 
            href="view_courses.php?page=<?php echo --$page;?>" 
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
            for($page=1; $page<=$nber_of_Pages; $page+=1){
                echo '<li class="page-item"><a
                class="page-link" 
                href="view_courses.php?page='. $page .'"> '. $page .' </a></li>';
            }
            ?>
            <li class="page-item"><a class="page-link" 
            href="view_courses.php?page=<?php echo $page++;?>">Next</a></li>
            </ul>            
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
