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
<title><?php echo $departName;?> | Department Students(11h-13h)</title>

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
            <a href="department_info_courses.php?class=<?php echo $departId;?>" class="nav-link">
              Courses Taught
            </a>
          </li>          
          <li class="nav-item dropdown">
            <a href="#" class="nav-link active" data-toggle="dropdown">
              Active Students <i class="fas fa-caret-down"></i>
            </a>
            <div class="dropdown-menu sub-nav-dropdown">
              <a class="dropdown-item" 
              href="department_info_shift1.php?class=<?php echo $departId;?>"><i class="fas fa-sun sub-icon"></i> 8h - 10h</a>
              <a class="dropdown-item active" 
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
          <h3 class="">Students Information 
          (Shift 11h - 13h)</h3>  
          <div class="table-responsive mt-4">
            <table class="table table-striped">
             <thead>
                <th>N0.</th>
                <th>Reg N0.</th>
                <th>Lastname</th>
                <th>Firstname</th>
                <th>Intake</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Marks</th>
                <th>Change Department</th>
                <th>Remove</th>
              </thead>
               <?php
                $select = "Select student.student_Fname,student.student_Lname,
                        student.student_Mail,student.student_Gender,student.student_Address,
                        student.student_Phone,student.Reg_Num,student.student_Intake, 
                        department.dep_Name FROM student INNER JOIN department 
                        ON student.dep_ID = department.dep_ID 
                        WHERE department.dep_ID = '$departId'  AND student.status = 'On' AND student.student_Shift = '11h-13h' ORDER BY student.student_Lname";
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
                        student.student_Mail,student.student_Gender,student.student_Address,
                        student.student_Phone,student.Reg_Num,student.student_Intake, 
                        department.dep_Name FROM student INNER JOIN department 
                        ON student.dep_ID = department.dep_ID 
                        WHERE department.dep_ID = '$departId'  AND student.status = 'On' AND student.student_Shift = '11h-13h' ORDER BY student.student_Lname
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
                 $depName = $row_select['dep_Name'];
                 $regNum = $row_select['Reg_Num'];
                 $intake = $row_select['student_Intake'];
                 $num++;

                ?>
                <tr>
                <td><?php echo $num; ?></td>
                <td><?php echo $regNum; ?></td>
                <td><?php echo $lname; ?></td>
                <td><?php echo $fname; ?></td>
                <td><?php echo $intake; ?></td>
                <td><?php echo $email; ?></td>
                <td><?php echo $phone; ?></td>
                <td><a href="view_marks_shift2.php?marksFor=<?php echo $stdId;?>">
                <button type="button" class="btn btn-primary" 
                title="Update"><span class="fa fa-file-alt"></span></button></a></td>
                <td><a href="updates/update_student.php?editDpt=<?php echo $stdId;?>">
                <button type="button" class="btn btn-success" 
                title="Update"><span class="fa fa-pen"></span></button></a></td>
                <td>
                <button type="button" class="btn btn-danger" 
                title="Remove" data-toggle="modal" data-target="#remove<?php echo $stdId;?>">
                <span class="fa fa-trash"></span></button></td>
                </tr>
              <div class="modal" id="remove<?php echo $stdId;?>">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title"> Remove Student From Active Students</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                    Are You Sure you want to remove "<?php echo $lname . " " . $fname;?>" from "<?php echo $depName;?>" Active 
                    Students?
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <a href="removed/remove_student.php?removeStd=<?php echo $stdId;?>" 
                      class="btn btn-primary"><i class="fas fa-check-circle"></i> Remove</a>
                      <button type="button" class="btn btn-danger" 
                      data-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>
                    </div>

                  </div>
                </div>
              </div> 
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
            if($page>1){
              echo '<li class="page-item"><a
              class="page-link" 
              href="department_info_shift2.php?class='.$departId.'&page='. ($page-1) .'" style="background: #1ca48c; color: #f2f2f2;"> <i class="fas fa-caret-left"></i> Prev</a></li>';
            }            
            //display the links to the pages
            for($i=1; $i<=$nber_of_Pages; $i++){
                echo '<li class="page-item"><a
                class="page-link" 
                href="department_info_shift2.php?class='.$departId.'&page='. $i .'"> 
                '. $i .' </a></li>';
            }

            if($i-1>$page){
            echo '<li class="page-item"><a
            class="page-link" 
            href="department_info_shift2.php?class='.$departId.'&page='. ($page+1) .'" style="background: #1ca48c; color: #f2f2f2;"> Next <i class="fas fa-caret-right"></i></a></li>';
            }            
            ?>
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
