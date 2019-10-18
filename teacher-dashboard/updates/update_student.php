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

//Getting the selected User's ID
if(isset($_GET['editShift'])){
    $stdId = $_GET['editShift'];
    $select = "Select student.student_ID,student.student_Fname,student.student_Lname,
    student.student_Mail,student.student_Gender,student.student_Address,
    student.student_Phone,student.parent_Phone,student.Reg_Num,
    student.student_Intake,student.student_Shift,student.status, 
    department.dep_Name,department.dep_ID FROM student INNER JOIN department 
    ON student.dep_ID = department.dep_ID 
    where student_ID = '$stdId'";  
    $run_select = mysqli_query($con,$select);
    $fetch_select = mysqli_fetch_array($run_select);
    $stdId = $fetch_select['student_ID'];
    $stdFname = $fetch_select['student_Fname'];
    $stdLname = $fetch_select['student_Lname'];
    $email = $fetch_select['student_Mail'];
    $gender = $fetch_select['student_Gender'];
    $address = $fetch_select['student_Address'];
    $phone = $fetch_select['student_Phone'];
    $parphone = $fetch_select['parent_Phone'];
    $deptName = $fetch_select['dep_Name'];
    $deptId = $fetch_select['dep_ID'];
    $regNum = $fetch_select['Reg_Num'];
    $intake = $fetch_select['student_Intake'];
    $shift = $fetch_select['student_Shift'];
    $status = $fetch_select['status'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $fname;?> | Change Shift</title>

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
              $count = "Select count(*) as NberOfData from courses where dep_ID = '$departID' AND status='on'";
              $run_count = mysqli_query($con, $count);
              $row_count = mysqli_fetch_array($run_count);
              $count_data = $row_count['NberOfData'];
              echo $count_data; 
              ?>
          </span>
          </a></li>

          <li class="nav-item">
          <a href="../view_students_shift1.php" class="nav-link active">
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
          <a href="../marks_page.php" class="nav-link">
          <i class="fa fa-file-alt dash-icon"></i> Students Marks</a></li>

          </ul>
      </div>
    </nav>
            
    <main role="main" class="col-md-10 ml-sm-auto px-4">
      <div class="dash-output-section">
        <h2>Change Student's Shift</h2>
        <form method="post" action="">
          <div class="form-row">
            <div class="form-group col-md-4">
            <label for="lname">Student's Lastname</label>
            <input class="form-control" type="text" Placeholder="Enter Lastname" 
                name="lname" id="lname" value="<?php echo $stdLname;?>"readonly>
            </div>    
            <div class="form-group col-md-4">
            <label for="fname">Student's Firstname</label>
            <input class="form-control" type="text" Placeholder="Enter Firstname" 
            name="fname" id="fname" value="<?php echo $stdFname;?>"readonly>
            </div>
            <div class="form-group col-md-4">
            <label for="email">Student's E-Mail</label>
            <input class="form-control" type="text"
                name="email" id="email" value="<?php echo $email;?>" readonly>
            </div>           
          </div>         
          <div class="form-row mt-3">
            <div class="form-group col-md-4">
            <label for="gender">Student's Gender</label>
            <input class="form-control" type="text"
                name="gender" id="gender" value="<?php echo $gender;?>" readonly>
            </div>
            <div class="form-group col-md-4">
            <label for="intake">Intake</label>
            <input class="form-control" type="text"
                name="intake" id="intake" value="<?php echo $intake;?>" readonly>
            </div>  
            <div class="form-group col-md-4">
            <label for="phone">Mobile N0.</label>
            <input class="form-control" type="text" Placeholder="Enter Telephone N0." 
            name="phone" id="phone" value="<?php echo $phone;?>" readonly>
            </div>                  
          </div>          
          <div class="form-row mt-3">
            <div class="form-group col-md-4">
            <label for="shift">Student's Shift</label>
            <select class="custom-select" name="shift" id="shift">
                <optgroup label="Selected Shift">
                    <option selected readonly value="<?php echo $shift;?>">
                    <?php echo $shift;?></option>
                </optgroup>
                <optgroup label="Day Shifts">
                    <option value="8h-10h">8h-10h</option>
                    <option value="11h-13h">11h-13h</option>
                </optgroup>
                <optgroup label="Evening">
                    <option value="15h-17h">15h-17h</option>
                    <option value="18h-20h">18h-20h</option>
                </optgroup>                            
                <optgroup label="Weekend">
                <option value="Weekend">Weekend</option>
                </optgroup>
            </select>
            </div>                       
          </div>            
        <center>
        <div class="form-group">
            <button class="form-control btn btn-primary" id="addBtn" type="submit" name="update"> <span>Change Shift</span></button>
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
if(isset($_POST['update'])){
$sID = $stdId;
$Lname = $_POST['lname'];
$Fname = $_POST['fname'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$Shift = $_POST['shift'];
$intake = $_POST['intake'];
$stat = $status;

if($shift == $Shift){
  if($shift == "8h-10h"){
  echo "<script>window.open('../view_students_shift1.php','_self')</script>";
  }    

  elseif($shift == "11h-13h"){
  echo "<script>window.open('../view_students_shift2.php','_self')</script>";
  }    

  elseif($shift == "15h-17h"){
  echo "<script>window.open('../view_students_shift3.php','_self')</script>";
  }    

  elseif($shift == "18h-20h"){
  echo "<script>window.open('../view_students_shift4.php','_self')</script>";
  }    

  else{
  echo "<script>window.open('../view_students_shift5.php','_self')</script>";
  }   
}

else{
$update = "Update student
set student_Fname = '$Fname', student_Lname = '$Lname',student_Mail ='$email',student_Address ='$address',
student_Gender = '$gender',student_Phone ='$phone',student_Shift ='$Shift',
student_Intake ='$intake' WHERE student_ID = '$sID'";

$run_update = mysqli_query($con, $update);

$selShift = "Select student_Shift from student WHERE student_ID = '$sID'";
$run_sel = mysqli_query($con, $selShift);
$row_sel = mysqli_fetch_array($run_sel);
$shift2 = $row_sel['student_Shift'];

if($run_update){
    if($shift2 == "8h-10h"){
    echo "
    <script>
    Swal.fire({
      showConfirmButton: false,
      width: 550,
      background: '#f2f2f2',
      padding: '20px',
      allowOutsideClick:false,
      html:
      '<h1 class=alert-title>Success</h1>' + '<p class=alert-text>`$Lname $Fname` Shift Was Changed to $shift2!</p>, ' + '<a href=../view_students_shift1.php class= alert-btn>Continue!</a>',
      type: 'success',
      animation: true,
      customClass: {
        popup: 'animated swing'
      }
    });
    </script>";
    }    

    elseif($shift2 == "11h-13h"){
    echo "
    <script>
    Swal.fire({
      showConfirmButton: false,
      width: 550,
      background: '#f2f2f2',
      padding: '20px',
      allowOutsideClick:false,
      html:
      '<h1 class=alert-title>Success</h1>' + '<p class=alert-text>`$Lname $Fname` Shift Was Changed to $shift2!</p>, ' + '<a href=../view_students_shift2.php class= alert-btn>Continue!</a>',
      type: 'success',
      animation: true,
      customClass: {
        popup: 'animated swing'
      }
    });
    </script>";
    }    

    elseif($shift2 == "15h-17h"){
    echo "
    <script>
    Swal.fire({
      showConfirmButton: false,
      width: 550,
      background: '#f2f2f2',
      padding: '20px',
      allowOutsideClick:false,
      html:
      '<h1 class=alert-title>Success</h1>' + '<p class=alert-text>`$Lname $Fname` Shift Was Changed to $shift2!</p>, ' + '<a href=../view_students_shift3.php class= alert-btn>Continue!</a>',
      type: 'success',
      animation: true,
      customClass: {
        popup: 'animated swing'
      }
    });
    </script>";
    }    

    elseif($shift2 == "18h-20h"){
    echo "
    <script>
    Swal.fire({
      showConfirmButton: false,
      width: 550,
      background: '#f2f2f2',
      padding: '20px',
      allowOutsideClick:false,
      html:
      '<h1 class=alert-title>Success</h1>' + '<p class=alert-text>`$Lname $Fname` Shift Was Changed to $shift2!</p>, ' + '<a href=../view_students_shift4.php class= alert-btn>Continue!</a>',
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
      '<h1 class=alert-title>Success</h1>' + '<p class=alert-text>`$Lname $Fname` Shift Was Changed to $shift2!</p>, ' + '<a href=../view_students_shift5.php class= alert-btn>Continue!</a>',
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
    document.getElementById('error').innerHTML = 'Record Wasn't  Updated'</script>";
}
}
}
?>
</body>
</html>
