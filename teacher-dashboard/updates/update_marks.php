<?php
include("../../connection/connect.php");
include("../session/session.php");

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
if(isset($_GET['marks'])){
    $marksId = $_GET['marks'];
    $select = "Select student.student_Fname,student.student_Lname,student.student_ID,student.student_Shift, 
    marks.marks_Test,marks.marks_Exam,marks.marks_ID, marks.total,marks.verdict,
    department.dep_Name,courses.course_Name, courses.total_Marks, courses.course_ID 
    FROM student LEFT JOIN marks ON student.student_ID = marks.student_ID 
    INNER JOIN department ON department.dep_ID = student.dep_ID LEFT JOIN courses 
    ON courses.course_ID = marks.course_ID WHERE department.dep_ID = '$departID' 
    AND student.status = 'On' AND marks.marks_ID ='$marksId'";    
    $run_select = mysqli_query($con,$select);
    $fetch_select = mysqli_fetch_array($run_select);
    $cName = $fetch_select['course_Name'];
    $overall = $fetch_select['total_Marks'];
    $fName = $fetch_select['student_Fname'];
    $lName = $fetch_select['student_Lname'];
    $depName = $fetch_select['dep_Name'];
    $Tmarks = $fetch_select['marks_Test'];
    $Emarks = $fetch_select['marks_Exam'];
    $markId = $fetch_select['marks_ID'];
    $studentId = $fetch_select['student_ID'];
    $courseId = $fetch_select['course_ID'];
    $Totmarks = $fetch_select['total'];
    $stdShift = $fetch_select['student_Shift'];
    // $verd = $fetch_select['verdict'];
    // AND courses.course_ID = '7' 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $fname;?> | Update Student's Marks</title>

<!-- META TAGS, Website SEO, Author, Keywords, Responsiveness -->

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- LINKS OF THE WEBSITE, STYLING FILES, AND THE WEBSITE HEADER ICON-->

<link rel="icon" href="../../img/logo.png">
<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link rel="stylesheet" href="../../css/all.min.css">
<link rel="stylesheet" href="../../css/main.css">
<link rel="stylesheet" href="../../css/animate.css">
<link rel="stylesheet" href="../../node_modules/sweetalert2/dist/sweetalert2.css">


<script src="../../js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/all.min.js"></script>
<script src="../../js/main-script.js"></script>
<script src="../../js/wow.min.js"></script>
<style>

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
        <a class="navbar-brand" href="../index.php"><i class="fas fa-book logo-icon"></i> Grading <span class="fat">System</span></a>

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
        <a class="nav-link" href="../logout.php">
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
          <a href="../index.php" class="nav-link">
          <i class="fa fa-home dash-icon"></i> Home</a></li>    

          <li class="nav-item">
          <a href="../view_courses.php" class="nav-link">
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
          <a href="../view_students_shift1.php" class="nav-link">
          <i class="fa fa-user-graduate dash-icon"></i> My Students 
          <span class="badge badge-primary active-badge">
              <?php
              $count = "Select count(*) as NberOfData from student where dep_ID = '$departID' and status='on'";
              $run_count = mysqli_query($con, $count);
              $row_count = mysqli_fetch_array($run_count);
              $count_data = $row_count['NberOfData'];
              echo $count_data; 
              ?>
          </span>
          </a></li>

          <li class="nav-item">
          <a href="../marks_page.php" class="nav-link active">
          <i class="fa fa-file-alt dash-icon"></i> Students Marks</a></li>

          </ul>
      </div>
    </nav>   
            
    <main role="main" class="col-md-10 ml-sm-auto px-4">
      <div class="dash-output-section">
        <h2>Edit Students Marks In <?php echo $cName;?></h2>
        <a class="btn btn-primary back-btn mt-3" 
            href="<?php
            if($stdShift=='8h-10h'){
              echo'../view_marks_shift1.php?course='.$courseId;
            }
            
            elseif($stdShift=='11h-13h'){
              echo'../view_marks_shift2.php?course='.$courseId;
            }

            elseif($stdShift=='15h-17h'){
              echo'../view_marks_shift3.php?course='.$courseId;
            }

            elseif($stdShift=='18h-20h'){
              echo'../view_marks_shift4.php?course='.$courseId;
            }

            else{
                echo'../view_marks_shift5.php?course='.$courseId;
            }
            ?>
            "><span>Back To Students List</span></a>
        <form method="post" action="" class="mt-4">
        <div class="form-row">
            <div class="form-group col-md-4">
            <label for="lname">Student's Lastname</label>
            <input class="form-control" type="text"
                name="lname" id="lname" value="<?php echo $lName;?>" readonly>
            </div>      
            <div class="form-group col-md-4">
            <label for="fname">Student's Firstname</label>
            <input class="form-control" type="text"
            name="fname" id="fname" value="<?php echo $fName;?>" readonly>
            </div>
            <div class="form-group col-md-4">
            <label for="cname">Course Name</label>
            <input class="form-control" type="text"
                name="cname" id="cname" value="<?php echo $cName;?>" readonly>
            </div>           
        </div>          
        <div class="form-row mt-3">
            <div class="form-group col-md-4">
            <label for="ovMarks">Overall Marks / Period</label>
            <input class="form-control" type="text" 
                name="ovMarks" id="ovMarks" value="<?php echo $overall;?>" readonly>
            </div>                        
            <div class="form-group col-md-4">
            <label for="tests">Marks In Test / C.A.T</label>
            <input class="form-control" type="text" Placeholder="Enter Marks In Test" 
                name="tests" id="tests" value="<?php echo $Tmarks;?>">
            </div>
            <div class="form-group col-md-4">
            <label for="exams">Marks In Exams</label>
            <input class="form-control" type="text" Placeholder="Enter Marks In Exams" 
                name="exams" id="exams" value="<?php echo $Emarks;?>">
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
            <button class="form-control btn btn-primary" id="update" type="submit" name="update"> <span>Add Marks</span></button>
            <span class="text-danger"><h5 id="error"> </h5></span>
        </div>
        </center>
        </form>
      </div>
    </main> 
  </div>
</div> 
<script>
new WOW().init();
</script>
<script src="../../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>

<?php
//ADDING MARKS
if(isset($_POST['update'])){
$studentid = $studentId;
$courseid = $courseId;
$markid = $markId;
// $sFname = $stdFname;
// $sLname = $stdLname;
$coName = $cName;
$tests = $_POST['tests'];
$exams = $_POST['exams'];
$total = $_POST['total'];
$ovMarks = $_POST['ovMarks'];
$totMarks = ($ovMarks)*2;


if(($tests > $ovMarks) || ($exams > $ovMarks)){
    echo "
    <script>
    Swal.fire({
      showConfirmButton: false,
      width: 550,
      background: '#f2f2f2',
      padding: '20px',
      allowOutsideClick:false,
      html:
      '<h1 class=alert-title>Error</h1>' + '<p class=alert-text>Marks must Not Be Greater Than $ovMarks(Overall Marks)</p>, ' + '<a href=update_marks.php?marks=$markid class= alert-error-btn>Continue!</a>',
      type: 'error',
      animation: true,
      customClass: {
        popup: 'animated swing'
      }
    });
    </script>";
}

else{
if(($tests == "") && ($exams == "")){
$finalTot = "";  
}

else if(($tests !== "") && ($exams == "")){
$finalTot = "";  
}

else{
$finalTot = $tests + $exams;
}


// $finalVerd = "";
if(($finalTot !== '') && ($finalTot < $ovMarks)){
    $finalVerd = "Fail";
    // $finalVerd = $finalTot;
}
    
elseif(($finalTot !== '') && ($finalTot >= $ovMarks)){
$finalVerd = "Pass";
// $finalVerd = $finalTot + 1;  
}

else{
$finalVerd = "";
// $finalVerd = $finalTot + 1;    
}

if(($tests == "") && ($exams !== "")){
    echo "
    <script>
    Swal.fire({
      showConfirmButton: false,
      width: 550,
      background: '#f2f2f2',
      padding: '20px',
      allowOutsideClick:false,
      html:
      '<h1 class=alert-title>Error</h1>' + '<p class=alert-text>Please Record Marks Scored In tests first!</p>, ' + '<a href=update_marks.php?marks=$markid class= alert-error-btn>Continue!</a>',
      type: 'error',
      animation: true,
      customClass: {
        popup: 'animated swing'
      }
    });
    </script>";
}

else{
$studentid = $studentId;
$courseid = $courseId;
$markid = $markId;
// $sFname = $stdFname;
// $sLname = $stdLname;
$coName = $cName;
$tests = $_POST['tests'];
$exams = $_POST['exams'];
$total = $_POST['total'];
$ovMarks = $_POST['ovMarks'];
$totMarks = ($ovMarks)*2;

$update = "Update marks set student_ID ='$studentid' ,course_ID = '$courseid',
marks_Test = '$tests' ,marks_Exam = '$exams' ,total = '$finalTot',verdict = '$finalVerd'
WHERE marks_ID = '$markid'";

$run_update = mysqli_query($con, $update);

if($run_update){
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
      '<h1 class=alert-title>Success</h1>' + '<p class=alert-text>Marks for `$lName $fName` Successfully Updated</p>, ' + '<a href=../view_marks_shift1.php?course=$courseId class= alert-btn>Continue!</a>',
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
      '<h1 class=alert-title>Success</h1>' + '<p class=alert-text>Marks for `$lName $fName` Successfully Updated</p>, ' + '<a href=../view_marks_shift2.php?course=$courseId class= alert-btn>Continue!</a>',
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
      '<h1 class=alert-title>Success</h1>' + '<p class=alert-text>Marks for `$lName $fName` Successfully Updated</p>, ' + '<a href=../view_marks_shift3.php?course=$courseId class= alert-btn>Continue!</a>',
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
      '<h1 class=alert-title>Success</h1>' + '<p class=alert-text>Marks for `$lName $fName` Successfully Updated</p>, ' + '<a href=../view_marks_shift4.php?course=$courseId class= alert-btn>Continue!</a>',
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
      '<h1 class=alert-title>Success</h1>' + '<p class=alert-text>Marks for `$lName $fName` Successfully Updated</p>, ' + '<a href=../view_marks_shift5.php?course=$courseId class= alert-btn>Continue!</a>',
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

}
?>
</body>
</html>
