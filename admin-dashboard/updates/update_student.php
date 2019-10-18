<?php
include("../../connection/connect.php");
include("../session/session.php");

// Retrieve Users Data

$retr = "Select * From users where user_ID = '$session_Id'";
$run_retr = mysqli_query($con, $retr);
$row_retr = mysqli_fetch_array($run_retr);
$fname = $row_retr['user_Fname'];

//Getting the selected User's ID
if(isset($_GET['editStd'])){
    $stdId = $_GET['editStd'];
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
    $Intake = $fetch_select['student_Intake'];
    $shift = $fetch_select['student_Shift'];
    $status = $fetch_select['status'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $fname;?> | Update Student</title>

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
  text-decoration: none;
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
          <a href="../add_users.php" class="nav-link">
          <i class="fa fa-user-edit dash-icon"></i> Add User</a></li>

          <li class="nav-item">
          <a href="../view_users.php" class="nav-link"><i class="fa fa-user-lock dash-icon"></i> System Users
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
          <a href="../add_teachers.php" class="nav-link">
          <i class="fa fa-user-edit dash-icon"></i> Add Teacher</a></li>
          <li class="nav-item">
          <a href="../view_teachers.php" class="nav-link"><i class="fa fa-chalkboard-teacher dash-icon"></i> View Teachers 
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
          <a href="../add_students.php" class="nav-link">
          <i class="fa fa-user-edit dash-icon"></i> Add Student</a></li>

          <li class="nav-item">
          <a href="../view_students.php" class="nav-link">
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
            
    <main role="main" class="col-md-10 ml-sm-auto px-4">
      <div class="dash-output-section">
        <h2>Update Student's Information</h2>
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
            <input class="form-control" type="text" Placeholder="Enter Email" 
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
            <select class="custom-select" name="intake" id="intake" 
            onfocusout="validateIntake()">
                <option selected value="<?php echo $Intake;?>">
                  <?php echo $Intake;?></option>
                <option disabled value="0">Select Intake</option>
                <option value="September Intake">September Intake</option>
                <option value="March Intake">March Intake</option>
            </select>            
            </div>  
            <div class="form-group col-md-4">
            <label for="address">Student's Address</label>
            <input class="form-control" type="text" Placeholder="Enter Address" 
                name="address" id="address" value="<?php echo $address;?>" readonly>
            </div>                   
          </div>          
          <div class="form-row mt-3">
            <div class="form-group col-md-4">
            <label for="department">Student's Department</label>
            <input class="form-control" type="text"
                name="department" id="department" value="<?php echo $deptName;?>" readonly>
            </div>
            <div class="form-group col-md-4">
            <label for="shift">Student's Shift</label>
            <input class="form-control" type="text"
                name="shift" id="shift" value="<?php echo $shift;?>" readonly>
            </div>                 
            <div class="form-group col-md-4">
            <label for="phone">Mobile N0.</label>
            <input class="form-control" type="text" Placeholder="Enter Telephone N0." 
            name="phone" id="phone" value="<?php echo $phone;?>" readonly>
            </div>        
          </div>
        <div class="form-row mt-1">
            <div class="form-group col-md-4">
                <label for="parphone">Parent's Mobile N0.</label>
                <input class="form-control" type="text" Placeholder="Enter Parent's Mobile N0." 
                name="parphone" id="parphone"  value="<?php echo $parphone;?>" readonly>
            </div>  
        </div>              
        <center>
        <div class="form-group">
            <button class="form-control btn btn-primary" id="addBtn" type="submit" name="update"> <span>Update Student</span></button>
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
$dID = $deptId;
$Lname = $_POST['lname'];
$Fname = $_POST['fname'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$parphone = $_POST['parphone'];
$depart = $_POST['department'];
$shift = $_POST['shift'];
$intake = $_POST['intake'];
$stat = $status;

if($stat=="Off"){
$year = date("Y");
$int = $intake ."/" . $year;

$start_date = "";
if($intake == 'March Intake'){
$start_date = '3';
}

else{
$start_date = '9'; 
}

$update = "Update student set student_Intake = '$int',start_Date = '$start_date',
status = 'On' WHERE student_ID = '$sID'";

$run_update = mysqli_query($con, $update);

if($run_update){
  echo "
  <script>
  Swal.fire({
    showConfirmButton: false,
    width: 550,
    background: '#f2f2f2',
    padding: '20px',
    allowOutsideClick:false,
    html:
    '<h1 class=alert-title>Success</h1>' + '<p class=alert-text>Student `$Lname $Fname` was Successfully re-added to the system!</p>, ' + '<a href=../view_students.php class= alert-btn>Continue!</a>',
    type: 'success',
    animation: true,
    customClass: {
      popup: 'animated swing'
    }
  });
  </script>";
}

else{
    echo "<script>
    document.getElementById('error').innerHTML = 'Record Wasn't  Updated'</script>";
}
}

else{
  $intake = $Intake;
  echo "<script>window.open('../view_students.php','_self')</script>"; 
}
}
?>
</body>
</html>
