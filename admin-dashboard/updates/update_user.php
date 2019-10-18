<?php
include("../../connection/connect.php");
include("../session/session.php");

// Retrieve Users Data

$retr = "Select * From users where user_ID = '$session_Id'";
$run_retr = mysqli_query($con, $retr);
$row_retr = mysqli_fetch_array($run_retr);
$fname = $row_retr['user_Fname'];

//Getting the selected User's ID
if(isset($_GET['editUser'])){
    $userId = $_GET['editUser'];
    $select = "select * from users where user_ID = '$userId'";
    $run_select = mysqli_query($con,$select);
    $fetch_select = mysqli_fetch_array($run_select);
    $userFname = $fetch_select['user_Fname'];
    $userLname = $fetch_select['user_Lname'];
    $email = $fetch_select['user_Mail'];
    $gender = $fetch_select['user_Gen'];
    $address = $fetch_select['user_Address'];
    $phone = $fetch_select['user_Phone'];
    $role = $fetch_select['user_Role'];
    $status = $fetch_select['status'];
    $password = $fetch_select['password'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $fname;?> | Update User</title>

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
        <h2>Update User's Information</h2>
        <form method="post" action="">
          <div class="form-row">
            <div class="form-group col-md-4">
            <label for="lname">User's Lastname</label>
            <input class="form-control" type="text"
                name="lname" id="lname" value="<?php echo $userLname;?>" readonly>
            </div>    
            <div class="form-group col-md-4">
            <label for="fname">User's Firstname</label>
            <input class="form-control" type="text"
            name="fname" id="fname" value="<?php echo $userFname;?>" readonly>
            </div>
            <div class="form-group col-md-4">
            <label for="email">User's E-Mail</label>
            <input class="form-control" type="text" Placeholder="Enter Email" 
                name="email" id="email" value="<?php echo $email;?>" readonly>
            </div>           
          </div>         
          <div class="form-row mt-3">
            <div class="form-group col-md-4">
            <label for="gender">User's Gender</label>
            <input class="form-control" type="text"
                name="gender" id="gender" value="<?php echo $gender;?>" readonly>
            </div>
            <div class="form-group col-md-4">
            <label for="address">User's Address</label>
            <input class="form-control" type="text" Placeholder="Enter Address" 
                name="address" id="address" value="<?php echo $address;?>" readonly>
            </div>
            <div class="form-group col-md-4">
            <label for="role">User's Role</label>
            <select class="custom-select" name="role" id="role" required>
                <optgroup label="Selected Role">
                    <option selected readonly value="<?php echo $role;?>">
                    <?php echo $role;?></option>
                </optgroup>                            
                <optgroup label="Change Role">
                    <option value="Administrator">Administrator</option>
                    <option value="Dos">Dos</option>
                </optgroup>
            </select>
            </div>                       
          </div>          
          <div class="form-row mt-1">   
            <div class="form-group col-md-4">
            <label for="phone">Mobile N0.</label>
            <input class="form-control" type="text" Placeholder="Enter Telephone N0." 
            name="phone" id="phone" value="<?php echo $phone;?>" readonly>
            </div>        
          </div>             
        <center>
        <div class="form-group">
            <button class="form-control btn btn-primary" id="addBtn" type="submit" name="update"> <span>Update User</span></button>
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
$uID = $userId;
$lname = $_POST['lname'];
$fname = $_POST['fname'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$role = $_POST['role'];
$stat = "";

if($status == 'Off' && $role == 'Administrator'){
$stat = "On";

//Generate Teachers Password
$code_feed = "0123456789";
$code_length = 6;  // Set this to be your desired code length
$final_code = "";
$k = "kiac-A";
$feed_length = strlen($code_feed);

for($i = 0; $i < $code_length; $i++) {
  $feed_selector = rand(0,$feed_length-1);
  $final_code .= substr($code_feed,$feed_selector,1);
}

$pass = $k . $final_code;
$hashPass = MD5($pass);

//Send Email

$fetch_email_data = "Select * from users";
$run_email_data = mysqli_query($con, $fetch_email_data);
$row_email_data = mysqli_fetch_array($run_email_data);
$email = $row_email_data ['user_Mail'];
$uname = $row_email_data ['user_Fname'];
$Role = $row_email_data ['user_Role'];

require 'PHPMailerAutoload.php';
require 'credential.php';

$name = $uname;
$pwd = $pass;
$now_year = date('Y');
$role = $Role;
$header = "<b style='font-family: Oswald;
font-size: 20px; color: #2f3d51; display:block;'>Hello ". $_POST['lname'] . " " . $_POST['fname'] . " !" ."</b>";

$body = "<p style='margin-top: 30px;'>
Welcome To Grading System you've been recently added to the system As &nbsp;Administrator" . ", <br> Your Login Details are:</p>";

$cred1 = "<b style='
font-size: 17px; margin-right: 15px;margin-top: 20px;'>Username:</b>" . $_POST['fname'];

$cred2 = "<b style='
font-size: 17px; margin-right: 15px;margin-top: 20px;'>Password:</b>" . $pwd . "<br>";

$info2 = "You Can Change This Password later when you login to your account!";

$info = "<p style='margin-top: 50px;'>-- Grading System <br> Kiac Web Class</p>";

$copyright = "<p style='color: #5d6a7d;
margin-top: 10px; font-size: 17px;font-style:italic;'>&copy; Grading System " . $now_year . 
" - All Rights Reserved ". "</p>";

$msg2 = "<div style='font-size:17px; color: #2f3d51;'>" .$header. $body . $cred1 . 
"<br>" .$cred2  . $info2 . $info . $copyright ."</div>";

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
}

else if($status == 'Off' && $role == 'Dos'){
$stat = "On";

//Generate Users Password
$code_feed = "0123456789";
$code_length = 6;  // Set this to be your desired code length
$final_code = "";
$k = "kiac-D";
$feed_length = strlen($code_feed);

for($i = 0; $i < $code_length; $i++) {
  $feed_selector = rand(0,$feed_length-1);
  $final_code .= substr($code_feed,$feed_selector,1);
}

$pass = $k . $final_code;
$hashPass = MD5($pass);

// SEND EMAIL

$fetch_email_data = "Select * from users";
$run_email_data = mysqli_query($con, $fetch_email_data);
$row_email_data = mysqli_fetch_array($run_email_data);
$email = $row_email_data ['user_Mail'];
$uname = $row_email_data ['user_Fname'];
$Role = $row_email_data ['user_Role'];

require 'PHPMailerAutoload.php';
require 'credential.php';

$name = $uname;
$pwd = $pass;
$now_year = date('Y');
$role = $Role;
$header = "<b style='font-family: Oswald;
font-size: 20px; color: #2f3d51; display:block;'>Hello ". $_POST['fname'] . " !" ."</b>";

$body = "<p style='margin-top: 30px;'>
Welcome To Grading System, you've been recently added to the system As &nbsp; Dos" . ", <br> Your Login Details are:</p>";

$cred1 = "<b style='
font-size: 17px; margin-right: 15px;margin-top: 20px;'>Username:</b>" . $_POST['fname'];

$cred2 = "<b style='
font-size: 17px; margin-right: 15px;margin-top: 20px;'>Password:</b>" . $pwd . "<br>";

$info2 = "You Can Change This Password later when you login to your account!";

$info = "<p style='margin-top: 50px;'>-- Grading System <br> Kiac Web Class</p>";

$copyright = "<p style='color: #5d6a7d;
margin-top: 10px; font-size: 17px;font-style:italic;'>&copy; Grading System " . $now_year . 
" - All Rights Reserved ". "</p>";

$msg2 = "<div style='font-size:17px; color: #2f3d51;'>" .$header. $body . $cred1 . 
"<br>" .$cred2  . $info2 . $info . $copyright ."</div>";

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
}

else{
$hashPass = $password;
$stat = $status;
}

$update = "Update users
set user_Fname = '$fname', user_Lname = '$lname',user_Mail ='$email',user_Address ='$address',
user_Gen = '$gender',user_Phone ='$phone',user_Role ='$role',status = '$stat', password = '$hashPass' 
where user_ID = '$uID'";

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
    '<h1 class=alert-title>Success</h1>' + '<p class=alert-text>Teacher `$lname $fname` was Successfully re-added to the system!</p>, ' + '<a href=../view_users.php class= alert-btn>Continue!</a>',
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
?>
</body>
</html>
