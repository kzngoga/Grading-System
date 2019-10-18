<?php
include("../connection/connect.php");
include("session/session.php");

// Retrieve Users Data

$retr = "Select * From users where user_ID = '$session_Id'";
$run_retr = mysqli_query($con, $retr);
$row_retr = mysqli_fetch_array($run_retr);
$fname = $row_retr['user_Fname'];

$msg = "";
$error = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $fname;?> | Add Students</title>

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
          <a href="add_students.php" class="nav-link active">
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
            
    <main role="main" class="col-md-10 ml-sm-auto px-4">
      <div class="dash-output-section">
        <h2>Add Student</h2>
        <form method="post" action="add_students.php" id="myForm" novalidate>
        <div class="form-row">
            <div class="form-group col-md-4">
            <label for="lname">Student's Lastname</label>
            <input class="form-control" type="text" Placeholder="Enter Lastname" 
                name="lname" id="lname" onfocusout="validatelastName()">
                <span class="helper-text"></span>
            </div>    
            <div class="form-group col-md-4">
            <label for="fname">Student's Firstname</label>
            <input class="form-control" type="text" Placeholder="Enter Firstname" 
            name="fname" id="fname" onfocusout="validatefirstName()">
            <span class="helper-text"></span>
            </div>
            <div class="form-group col-md-4">
            <label for="email">Student's E-Mail</label>
            <input class="form-control" type="email" Placeholder="Enter E-Mail" 
                name="email" id="email" onfocusout="validateEmail()">
                <span class="helper-text"></span>
            </div>           
        </div>          
        <div class="form-row mt-3">
            <div class="form-group col-md-4">
            <label for="gender">Student's Gender</label>
            <select class="custom-select" name="gender" id="gender" 
            onfocusout="validateGender()">
                <option selected disabled value="0">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
            <span class="helper-text"></span>
            </div>                        
            <div class="form-group col-md-4">
            <label for="intake">Intake</label>
            <select class="custom-select" name="intake" id="intake" 
            onfocusout="validateIntake()">
                <option selected disabled value="0">Select Intake</option>
                <option value="September Intake">September Intake</option>
                <option value="March Intake">March Intake</option>
            </select>
            <span class="helper-text"></span>
            <!-- <?php
            $inDate = date("m");
            $inText = "";
            if($inDate>= '1' && $inDate < '6'){
                $inText = "March Intake";
            }

            else{
                $inText = "September Intake";                           
            }
            ?>
            <input type="text" name="intake" id="intake" 
            class="form-control" value="<?php echo $inText;?>" readonly> -->
            </div>
            <div class="form-group col-md-4">
            <label for="address">Student's Address</label>
              <select class="custom-select" id="address" 
              onfocusout="validateAddress()" name="address">
                  <option selected disabled value="0">-- Select District --</option>
                  <option value="Gasabo">Gasabo</option>
                  <option value="Nyarugenge">Nyarugenge</option>
                  <option value="Kicukiro">Kicukiro</option>
                  <option value="Kamonyi">Kamonyi</option>
                  <option value="Muhanga">Muhanga</option>
                  <option value="Ruhango">Ruhango</option>
                  <option value="Nyanza">Nyanza</option>
                  <option value="Huye">Huye</option>
                  <option value="Nyamagabe">Nyamagabe</option>
                  <option value="Nyaruguru">Nyaruguru</option>
                  <option value="Gisagara">Gisagara</option>
                  <option value="Gakenke">Gakenke</option>
                  <option value="Musanze">Musanze</option>
                  <option value="Rubavu">Rubavu</option>
                  <option value="Gicumbi">Gicumbi</option>
                  <option value="Burera">Burera</option>
                  <option value="Nyabihu">Nyabihu</option>
                  <option value="Rutsiro">Rutsiro</option>
                  <option value="Rubavu">Rubavu</option>
                  <option value="Nyamasheke">Nyamasheke</option>
                  <option value="Rusizi">Rusizi</option>
                  <option value="Ngororero">Ngororero</option>
                  <option value="Karongi">Karongi</option>
                  <option value="Bugesera">Bugesera</option>
                  <option value="Ngoma">Ngoma</option>
                  <option value="Gatsibo">Gatsibo</option>
                  <option value="Kirehe">Kirehe</option>
                  <option value="Nyagatare">Nyagatare</option>
                  <option value="Rwamagana">Rwamagana</option>
                  <option value="Kayonza">Kayonza</option>
              </select>                
              <span class="helper-text"></span>
            </div>       
        </div>          
        <div class="form-row mt-3">
            <div class="form-group col-md-4">
            <label for="department">Student's Department</label>
            <select class="custom-select" name="department" id="department" 
            onfocusout="validateDepartment()">
                <option selected disabled value="0">Select Department</option>
                <?php
                $select_box = "select * From department where status = 'On'";
                $run_select_box = mysqli_query($con, $select_box);
                while ($row_select_box = mysqli_fetch_array($run_select_box)){
                $depId = $row_select_box['dep_ID'];
                $depName = $row_select_box['dep_Name'];
                echo "<option value='$depId'>$depName</option>";
                }
                ?>
            </select>
            <span class="helper-text"></span>
            </div>
            <div class="form-group col-md-4">
            <label for="shift">Student's Shift</label>
            <select class="custom-select" name="shift" id="shift" onfocusout="validateShift()">
                <option selected disabled value="0">Select Shift</option>
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
            <span class="helper-text"></span>
            </div>        
            <div class="form-group col-md-4">
            <label for="phone">Mobile N0.</label>
            <input class="form-control" type="text" Placeholder="Enter Telephone N0." 
            name="phone" id="phone" onfocusout="validateMobile()">
            <span class="helper-text"></span>
            </div>                                 
        </div>
        <div class="form-row mt-1">
            <div class="form-group col-md-4">
                <label for="parphone">Parent's Mobile N0.</label>
                <input class="form-control" type="text" Placeholder="Enter Parent's Mobile N0." 
                name="parphone" id="parphone" onfocusout="validateParMobile()">
                <span class="helper-text"></span>
            </div>  
        </div>          
        <center>
        <div class="form-group">
            <button class="form-control btn btn-primary" id="addBtn" type="submit" name="addBtn"> <span>Add Student</span></button>
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
<script src="../js/script_add_student.js"></script>
<script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>

<!-- ADD STUDENT PHP CODES -->
<?php
if(isset($_POST['addBtn'])){
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$parphone = $_POST['parphone'];
$intake = $_POST['intake'];
$department = $_POST['department'];
$shift = $_POST['shift'];

$intYear = date("Y");
$fullIntake = $intake . " /" . $intYear;

$start_date = "";
if($intake == 'March Intake'){
$start_date = '3';
}

else{
$start_date = '9'; 
}
// echo $intake;
$insert = "Insert INTO student 
(student_Fname, student_Lname, student_Mail, student_Gender, student_Address, student_Phone, parent_Phone, dep_ID, student_Intake,student_Shift,start_Date,status) 
VALUES ('$fname', '$lname', '$email', '$gender', '$address', '$phone', '$parphone', '$department', '$fullIntake', '$shift','$start_date','On')";

$run_insert = mysqli_query($con, $insert);

// Fetching student's ID

$fetch_Id = "Select * From student";
$run_fetch_Id = mysqli_query($con,$fetch_Id);
while($row_fetch_Id = mysqli_fetch_array($run_fetch_Id)){
$stdId = $row_fetch_Id['student_ID'];
}

//Adding Student In Current Student's Table

//Generate Students Registration N0. And add it to student.

//Create a function that changes a number Into roman numerals.
function romanNumerals($num) 
{
    $n = intval($num);
    $res = '';
 
    /*** roman_numerals array  ***/
    $roman_numerals = array(
                'M'  => 1000,
                'CM' => 900,
                'D'  => 500,
                'CD' => 400,
                'C'  => 100,
                'XC' => 90,
                'L'  => 50,
                'XL' => 40,
                'X'  => 10,
                'IX' => 9,
                'V'  => 5,
                'IV' => 4,
                'I'  => 1);
 
    foreach ($roman_numerals as $roman => $number) 
    {
        /*** divide to get  matches ***/
        $matches = intval($n / $number);
 
        /*** assign the roman char * $matches ***/
        $res .= str_repeat($roman, $matches);
 
        /*** substract from the number ***/
        $n = $n % $number;
    }
 
    /*** return the res ***/
    return $res;
}

// ASSIGNING VALUES THAT MAKE UP THE REGISTRATION NUMBER

$k = "KIAC";
$id = $stdId;
$mark = "000";

if($stdId > 8){
$mark = "00";
}

else if($stdId > 98){
$mark = "0";
}

else if($std > 998){
    $mark = "";
}

$month = date("m");
$year = date("Y");
$intake_Name = strtoupper(substr("$intake", 0 , 3));

$base_year = 2018; // Set a base when the intakes started

$intake = intval($year) - $base_year; // This will increase for every year

$increase_with = $intake++;

if($month>= '1'&& $month < '6'){
  $intake += $increase_with;
  $romIntake = romanNumerals($intake);
  $reg_num = $k . $mark . $id . $romIntake. "/". $intake_Name . $year;
}
else{
  $increase_with++;
  $intake += $increase_with;
  $romIntake = romanNumerals($intake);
  $reg_num = $k . $mark . $id . $romIntake. "/". $intake_Name . $year;
}

$update = "update student set reg_Num = '$reg_num' where student.student_ID = '$stdId'";
$run_update = mysqli_query($con,$update);

$fetch_email_data = "Select student.student_Fname,student.reg_Num,
student.student_Mail,department.dep_Name FROM student INNER JOIN department 
ON student.dep_ID = department.dep_ID WHERE department.dep_ID = '$department' 
AND student.student_ID = '$stdId'";

$run_email_data = mysqli_query($con, $fetch_email_data);
$row_email_data = mysqli_fetch_array($run_email_data);
$email = $row_email_data ['student_Mail'];
$uname = $row_email_data ['student_Fname'];
$dep = $row_email_data ['dep_Name'];
$reg = $row_email_data ['reg_Num'];

require 'PHPMailerAutoload.php';
require 'credential.php';

$name = $uname;
$pwd = $password;
$now_year = date('Y');
// $dep = $dep;
$header = "<b style='font-family: Oswald;
font-size: 20px; color: #2f3d51; display:block;'>Hello ". $_POST['lname'] . " " . $_POST['fname'] . " !" ."</b>";

$body = "<p style='margin-top: 30px;'>
Welcome To Grading System, you've been recently added to the system As a student in &nbsp;" .  " '$dep' Department" . ", <br> Your Login Details are:</p>";

$cred1 = "<b style='
font-size: 17px; margin-right: 15px;margin-top: 20px;'>Registration N0.:</b>" . $reg;

$info = "<p style='margin-top: 50px;'>-- Grading System <br> Kiac Web Class</p>";

$copyright = "<p style='color: #5d6a7d;
margin-top: 10px; font-size: 17px;font-style:italic;'>&copy; Grading System " . $now_year . 
" - All Rights Reserved ". "</p>";

$msg2 = "<div style='font-size:17px; color: #2f3d51;'>" .$header. $body . $cred1 . 
"<br>" . $info . $copyright ."</div>";

$mail = new PHPMailer;

$mail->SMTPDebug = 0;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = EMAIL;                 // SMTP username
$mail->Password = PASS;                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom(EMAIL, 'Grading System');
$mail->addAddress($_POST['email']);     // Add a recipient
$mail->addReplyTo(EMAIL);

// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = "Grading System Login Details";
// $mail->Body    = '<div style="border: 2px solid red;">
// Welcome To Grading System,Below Are Your Login Credentials<b></b></div>';
$mail->Body    = $msg2;
// $mail->AltBody = $_POST['msg'];

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} 
else {
    echo 'Message has been sent';
}

if($run_insert){
  echo "

  <script>
  Swal.fire({
    showConfirmButton: false,
    width: 550,
    background: '#f2f2f2',
    padding: '20px',
    allowOutsideClick:false,
    html:
    '<h1 class=alert-title>Success</h1>' + '<p class=alert-text>A new student was added successfully!</p>, ' + '<a href=view_students.php class= alert-btn>Continue!</a>',
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
    document.getElementById('error').innerHTML = 'Student Wasn't Added'</script>";
}
}
?>
</body>
</html>
