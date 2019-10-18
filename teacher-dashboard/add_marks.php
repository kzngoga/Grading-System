<?php
include("../connection/connect.php");
include("session/session.php");

// Retrieve Users Data
$retr = "Select teacher.teacher_ID,teacher.teacher_Fname,department.dep_Name,department.dep_ID 
FROM teacher INNER JOIN department ON teacher.dep_ID = department.dep_ID 
AND teacher.teacher_ID = '$session_Id'";
$run_retr = mysqli_query($con, $retr);
$row_retr = mysqli_fetch_array($run_retr);
$fname = $row_retr['teacher_Fname'];
$depart = $row_retr['dep_Name'];
$departID = $row_retr['dep_ID'];

//Getting the selected Course's ID
if(isset($_GET['course'])){
    $courseID = $_GET['course'];
    $select = "Select * FROM courses where course_ID = '$courseID'";    
    // $select = "Select student.student_Fname 
    // FROM student where student_ID = '$studentID'";
    $run_select = mysqli_query($con,$select);
    $fetch_select = mysqli_fetch_array($run_select);
    $cname = $fetch_select['course_Name'];
    $overallMarks = $fetch_select['total_Marks'];
}

//Getting the selected Student's ID
if(isset($_GET['student'])){
    $studentID = $_GET['student'];
    $select = "Select * FROM student where student_ID = '$studentID'";    
    // $select = "Select student.student_Fname 
    // FROM student where student_ID = '$studentID'";
    $run_select = mysqli_query($con,$select);
    $fetch_select = mysqli_fetch_array($run_select);
    $stdFname = $fetch_select['student_Fname'];
    $stdLname = $fetch_select['student_Lname'];
    $stdShift = $fetch_select['student_Shift'];
    // $cname = $fetch_select['course_Name'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $fname;?> | Add Marks</title>

<!-- META TAGS, Website SEO, Author, Keywords, Responsiveness -->

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- LINKS OF THE WEBSITE, STYLING FILES, AND THE WEBSITE HEADER ICON-->

<link rel="icon" href="../img/logo.png">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/all.min.css">
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/animate.css">
<link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.css">


<script src="../js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/all.min.js"></script>
<script src="../js/main-script.js"></script>
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

.alert-title{
  color: #2f3d51;
}

.alert-text{
  color: #5d6a7d;
  font-size: 18px;
  /* background: #ff0; */
  margin-bottom: 0px;
}

.alert-btn{
  background-color: #1ca48c;
  /* background: linear-gradient(#5fd1c1,#1ca48c); */
  padding: 10px 15px 10px 15px;
  margin: 0px  auto 0px auto;
  border-radius: 20px;
  width: 45%;
  color: #f2f2f2;
  outline: none;
  display: block;
  box-shadow: 0 5px 5px rgba(128,128,128,.8);
}

.alert-btn:hover{
  box-shadow: 0 5px 5px rgba(128,128,128,.8);
  color: #f2f2f2;
  text-decoration: none;
  background-color: #2f3d51;
}

.alert-error-btn{
  background-color: #e4797d;
  /* background: linear-gradient(#5fd1c1,#1ca48c); */
  padding: 10px 15px 10px 15px;
  margin: 0px  auto 0px auto;
  border-radius: 20px;
  width: 45%;
  color: #f2f2f2;
  outline: none;
  display: block;
  box-shadow: 0 5px 5px rgba(128,128,128,.8);
}

.alert-error-btn:hover{
  box-shadow: 0 5px 5px rgba(128,128,128,.8);
  color: #f2f2f2;
  text-decoration: none;
  background-color: #2f3d51;
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
          <a href="index.php" class="nav-link">
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
          <a href="marks_page.php" class="nav-link active">
          <i class="fa fa-file-alt dash-icon"></i> Students Marks</a></li>

          </ul>
      </div>
    </nav> 
            
    <main role="main" class="col-md-10 ml-sm-auto px-4">
      <div class="dash-output-section">
        <h2>Record Students Marks (<?php echo $cname;?> Course)</h2>
        <a class="btn btn-primary back-btn mt-3" 
            href="<?php
            if($stdShift=='8h-10h'){
              echo'student_add_marks1.php?course='.$courseID;
            }
            
            elseif($stdShift=='11h-13h'){
              echo'student_add_marks2.php?course='.$courseID;
            }

            elseif($stdShift=='15h-17h'){
              echo'student_add_marks3.php?course='.$courseID;
            }

            elseif($stdShift=='18h-20h'){
              echo'student_add_marks4.php?course='.$courseID;
            }

            else{
                echo'student_add_marks5.php?course='.$courseID;
            }
            ?>"><span>Back To Students List</span></a>
        <form method="post" action="add_marks.php?student=<?php echo $studentID;?>&course=<?php echo $courseID;?>" class="mt-4" id="myForm" novalidate>
        <div class="form-row">
            <div class="form-group col-md-4">
            <label for="lname">Student's Lastname</label>
            <input class="form-control" type="text"
                name="lname" id="lname" value="<?php echo $stdLname;?>" readonly>
            </div>      
            <div class="form-group col-md-4">
            <label for="fname">Student's Firstname</label>
            <input class="form-control" type="text"
            name="fname" id="fname" value="<?php echo $stdFname;?>" readonly>
            </div>
            <div class="form-group col-md-4">
            <label for="cname">Course Name</label>
            <input class="form-control" type="text"
                name="cname" id="cname" value="<?php echo $cname;?>" readonly>
            </div>           
        </div>          
        <div class="form-row mt-3">
            <div class="form-group col-md-4">
            <label for="ovMarks">Overall Marks / Period</label>
            <input class="form-control" type="text" 
                name="ovMarks" id="ovMarks" value="<?php echo $overallMarks;?>" readonly>
            </div>                        
            <div class="form-group col-md-4">
            <label for="tests">Marks In Test / C.A.T</label>
            <input class="form-control" type="text" Placeholder="Enter Marks In Test" 
                name="tests" id="tests" onfocusout="validateTestMarks()">
                <span class="helper-text"></span>
            </div>
            <div class="form-group col-md-4">
            <label for="exams">Marks In Exams</label>
            <input class="form-control" type="text" Placeholder="Enter Marks In Exams" 
                name="exams" id="exams" readonly>
            </div>       
        </div>          
            <center>
                <div class="form-group">
                <label for="total" style="display: inline-block !important;">
                Total Marks</label>
                <input class="form-control" type="text" Placeholder="" 
                    name="total" id="total" style="width: 40%;" readonly>
                </div>  
            </center>            
        <center>
        <div class="form-group">
            <button class="form-control btn btn-primary" id="addBtn" type="submit" name="addBtn"> <span>Add Marks</span></button>
            <span class="text-danger"><h5 id="error"> </h5></span>
        </div>
        </center>
        </form>
      </div>
    </main> 
  </div>
</div>
<script src="../js/script_Tmarks.js"></script>
<script>
new WOW().init();
</script> 
<script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>

<?php
//ADDING MARKS
if(isset($_POST['addBtn'])){
$studentid = $studentID;
$courseid = $courseID;
$sFname = $stdFname;
$sLname = $stdLname;
$coName = $cname;
$tests = $_POST['tests'];
$exams = $_POST['exams'];
$total = $_POST['total'];
$ovMarks = $_POST['ovMarks'];


$selection = "Select * FROM marks 
WHERE student_ID = '$studentid' AND course_ID = '$courseid'";

$run_selection = mysqli_query($con, $selection);
$check_data = mysqli_num_rows($run_selection);

if($check_data > 0){
    if($stdShift == "8h-10h"){
    echo "
    <script>
    Swal.fire({
      showConfirmButton: false,
      width: 550,
      background: '#f2f2f2',
      padding: '20px',
      allowOutsideClick:false,
      html:
      '<h1 class=alert-title>Error</h1>' + '<p class=alert-text>Marks For `$sLname $sFname` In $coName Already Added!</p>, ' + '<a href=view_marks_shift1.php?course=$courseID class= alert-error-btn>Continue!</a>',
      type: 'error',
      animation: true,
      customClass: {
        popup: 'animated swing'
      }
    });
    </script>";  
    }    

    elseif($stdShift == "11h-13h"){
    echo "
    <script>
    Swal.fire({
      showConfirmButton: false,
      width: 550,
      background: '#f2f2f2',
      padding: '20px',
      allowOutsideClick:false,
      html:
      '<h1 class=alert-title>Error</h1>' + '<p class=alert-text>Marks For `$sLname $sFname` In $coName Already Added!</p>, ' + '<a href=view_marks_shift2.php?course=$courseID class= alert-error-btn>Continue!</a>',
      type: 'error',
      animation: true,
      customClass: {
        popup: 'animated swing'
      }
    });
    </script>";  
    }    

    elseif($stdShift == "15h-17h"){
    echo "
    <script>
    Swal.fire({
      showConfirmButton: false,
      width: 550,
      background: '#f2f2f2',
      padding: '20px',
      allowOutsideClick:false,
      html:
      '<h1 class=alert-title>Error</h1>' + '<p class=alert-text>Marks For `$sLname $sFname` In $coName Already Added!</p>, ' + '<a href=view_marks_shift3.php?course=$courseID class= alert-error-btn>Continue!</a>',
      type: 'error',
      animation: true,
      customClass: {
        popup: 'animated swing'
      }
    });
    </script>";  
    }    

    elseif($stdShift == "18h-20h"){
    echo "
    <script>
    Swal.fire({
      showConfirmButton: false,
      width: 550,
      background: '#f2f2f2',
      padding: '20px',
      allowOutsideClick:false,
      html:
      '<h1 class=alert-title>Error</h1>' + '<p class=alert-text>Marks For `$sLname $sFname` In $coName Already Added!</p>, ' + '<a href=view_marks_shift4.php?course=$courseID class= alert-error-btn>Continue!</a>',
      type: 'error',
      animation: true,
      customClass: {
        popup: 'animated swing'
      }
    });
    </script>";  
    }    

    else{
    echo "
    <script>
    Swal.fire({
      showConfirmButton: false,
      width: 550,
      background: '#f2f2f2',
      padding: '20px',
      allowOutsideClick:false,
      html:
      '<h1 class=alert-title>Error</h1>' + '<p class=alert-text>Marks For `$sLname $sFname` In $coName Already Added!</p>, ' + '<a href=view_marks_shift5.php?course=$courseID class= alert-error-btn>Continue!</a>',
      type: 'error',
      animation: true,
      customClass: {
        popup: 'animated swing'
      }
    });
    </script>";  
    }  
}

elseif($tests > $ovMarks){
    // echo "<script>
    // alert('Marks must Not Be Greater Than $ovMarks(Overall Marks)')</script>";
    echo "
    <script>
    Swal.fire({
      showConfirmButton: false,
      width: 550,
      background: '#f2f2f2',
      padding: '20px',
      allowOutsideClick:false,
      html:
      '<h1 class=alert-title>Error</h1>' + '<p class=alert-text>Marks must Not Be Greater Than $ovMarks(Overall Marks)</p>, ' + '<a href=add_marks.php?student=$studentID&course=$courseID class= alert-error-btn>Continue!</a>',
      type: 'error',
      animation: true,
      customClass: {
        popup: 'animated swing'
      }
    });
    </script>";  
}

else{
$insert = "Insert into marks (student_ID,course_ID,marks_Test,marks_Exam,total,verdict) 
Values ('$studentid','$courseid','$tests','','','')";

$run_insert = mysqli_query($con, $insert);

if($run_insert){
    // echo "<script>alert('Marks Successfully Recorded')</script>";
    if($stdShift == "8h-10h"){
    // echo "<script>window.open('view_marks_shift1.php?course=$courseID','_self')</script>";
    echo "
    <script>
    Swal.fire({
      showConfirmButton: false,
      width: 550,
      background: '#f2f2f2',
      padding: '20px',
      allowOutsideClick:false,
      html:
      '<h1 class=alert-title>Success</h1>' + '<p class=alert-text>Marks for `$sLname $sFname` Successfully Recorded</p>, ' + '<a href=view_marks_shift1.php?course=$courseID class= alert-btn>Continue!</a>',
      type: 'success',
      animation: true,
      customClass: {
        popup: 'animated swing'
      }
    });
    </script>"; 
    }    

    elseif($stdShift == "11h-13h"){
      echo "
      <script>
      Swal.fire({
        showConfirmButton: false,
        width: 550,
        background: '#f2f2f2',
        padding: '20px',
        allowOutsideClick:false,
        html:
        '<h1 class=alert-title>Success</h1>' + '<p class=alert-text>Marks for `$sLname $sFname` Successfully Recorded</p>, ' + '<a href=view_marks_shift2.php?course=$courseID class= alert-btn>Continue!</a>',
        type: 'success',
        animation: true,
        customClass: {
          popup: 'animated swing'
        }
      });
      </script>"; 
    }    

    elseif($stdShift == "15h-17h"){
      echo "
      <script>
      Swal.fire({
        showConfirmButton: false,
        width: 550,
        background: '#f2f2f2',
        padding: '20px',
        allowOutsideClick:false,
        html:
        '<h1 class=alert-title>Success</h1>' + '<p class=alert-text>Marks for `$sLname $sFname` Successfully Recorded</p>, ' + '<a href=view_marks_shift3.php?course=$courseID class= alert-btn>Continue!</a>',
        type: 'success',
        animation: true,
        customClass: {
          popup: 'animated swing'
        }
      });
      </script>"; 
    }    

    elseif($stdShift == "18h-20h"){
    echo "
    <script>
    Swal.fire({
      showConfirmButton: false,
      width: 550,
      background: '#f2f2f2',
      padding: '20px',
      allowOutsideClick:false,
      html:
      '<h1 class=alert-title>Success</h1>' + '<p class=alert-text>Marks for `$sLname $sFname` Successfully Recorded</p>, ' + '<a href=view_marks_shift4.php?course=$courseID class= alert-btn>Continue!</a>',
      type: 'success',
      animation: true,
      customClass: {
        popup: 'animated swing'
      }
    });
    </script>"; 
    }    

    else{
    echo "
    <script>
    Swal.fire({
      showConfirmButton: false,
      width: 550,
      background: '#f2f2f2',
      padding: '20px',
      allowOutsideClick:false,
      html:
      '<h1 class=alert-title>Success</h1>' + '<p class=alert-text>Marks for `$sLname $sFname` Successfully Recorded</p>, ' + '<a href=view_marks_shift5.php?course=$courseID class= alert-btn>Continue!</a>',
      type: 'success',
      animation: true,
      customClass: {
        popup: 'animated swing'
      }
    });
    </script>"; 
    }
}
    
else{
    echo "<script>
    document.getElementById('error').innerHTML = 'Marks Not Recorded'</script>";
}
}

}
?>
</body>
</html>
