<?php
include("connection/connect.php");

session_start();

$msg = "";

if(isset($_POST['login'])){
$uname = $_POST['uname'];
$password = $_POST['password'];
$pass = MD5($password);

// echo $pass;
$select = "Select * from teacher where teacher_Fname = '$uname' And password = '$pass'";
$run_select  = mysqli_query($con,$select);
$row_select = mysqli_fetch_array($run_select);
$status = $row_select['status'];
// Create and generate session Id

session_regenerate_id();
$_SESSION['teacherid'] = $row_select['teacher_ID'];
session_write_close();

// Get User's role from database
$check_data = mysqli_num_rows($run_select);

if($check_data == 1 && $status !=='Off'){
  echo "<script>window.open('teacher-dashboard/index.php','_self')</script>";
}

elseif($check_data == 1 && $status =='Off'){
  $msg = "<span id='error' style='background-color: #ff4d4d'> <i class='fas fa-exclamation-circle'></i> ** Access Denied, You are not Allowed To Use This System! </span>";
}

else{
  $msg = "<span id='error' style='background-color: #ff4d4d'> <i class='fas fa-times'></i> ** Invalid Login Details </span>";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Teacher Login | Student Grading System</title>

<!-- META TAGS, Website SEO, Author, Keywords, Responsiveness -->

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- LINKS OF THE WEBSITE, STYLING FILES, AND THE WEBSITE HEADER ICON-->

<link rel="icon" href="img/logo.png">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/all.min.css">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/animate.css">


<script src="js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/all.min.js"></script>
<script src="js/main-script.js"></script>
<script src="js/wow.min.js"></script>
<style>
body{
	background: linear-gradient(90deg,#60d1c1 50%, #2f3d51 50%) !important;
}
</style>
</head>

<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark main-nav">
	<div class="container">
        <a class="navbar-brand" href="index.php"><i class="fas fa-book logo-icon"></i> Grading <span class="fat">System</span></a>

	    <ul class="nav navbar-nav ml-auto lang-switcher">
			<li class="nav-item">
				<a class="nav-link" href="index.php" style="width: 180px;">
				<i class="fas fa-user-lock"></i> Admin / D.O.S</a>
            </li>			
            
            <li class="nav-item">
				<a class="nav-link" href="student-login.php">
				<i class="fas fa-user-graduate"></i> Student</a>
			</li>
	    </ul>
    </div>
</nav>

<div class="login-section">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="salute">
          	<div class="salute-caption wow bounceInLeft" data-wow-duration="2s">
              <?php
              $time = date("H");
        			if(($time >="0") && ($time <"12")){
        				echo"<h2><i class='fas fa-sun'></i> Good Morning!</h2>";
        		    echo "<p>Welcome To Grading System. <br> Please Login To Start
        Using The System</p>";
        			}

        			else if(($time >="12") && ($time <"18")){
        				echo"<h2><i class='fas fa-cloud-sun'></i > Good Afternoon!</h2>";
        		    echo "<p>Welcome To Grading System. <br> Please Login To Start
        Using The System</p>";
        			}

        			else if(($time >="18") && ($time <"22")){
        				echo"<h2><i class='fas fa-cloud-moon'></i> Good Evening!</h2>";
        		    echo "<p>Welcome To Grading System. <br> Please Login To Start
        Using The System</p>";
        			}

        			else{
        				echo"<h2><i class='fas fa-moon'></i> Good Night!</h2>";
        		    echo "<p>Welcome To Grading System. <br> Please Login To Start
        Using The System</p>";
        			}
        			?>
            </div>
          </div>
        </div>

      <div class="col-md-6">
        <div class="user-login">
            <center>
              <form  method="post" action="teacher-login.php">
              <img class="form-pic" src="img/avat1.png" width="50">
                <h6><i class="fas fa-user-lock"></i> &nbsp;Teacher Login</h6>
                <div class="form-underline"></div>
                <div class="form-group">
                 <label for="uname">Username</label>
                 <input class="form-control" type="text" 
                 name="uname" id="uname" placeholder="Enter Your Firstname as Username" 
                 value="" required>
                </div>        
                <div class="form-group">
                 <label for="password">Password</label>
                 <input class="form-control" type="password" name="password" id="password" 
                 placeholder="Enter Password" required>
                 <input type="checkbox" id="check" onclick="showPass()" style="">
                 <label for="check" style="display: inline !important; font-size: 14px !important;  height: 0px !important; vertical-align: bottom;">Show Password</label>
                </div>
                <div class="form-group">
                  <button class="btn btn-outline-light form-control" style="" type="submit"name="login"><span>Login </span></button>
               </div>
               <span id="error"> 
                 <?php echo "" . " " . $msg;?></span>
              </form>
            </center>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- footer -->
<footer>
 <div class="container-fluid">
   <div class="other-links">
     <div class="row">
      <div class="col-md-6">
      </div>      
      <div class="col-md-6">
      <div class="foot-divider"></div>
       <p><span class="contacts">Contact Us: +250 782 815 204  or info.gsystem1@gmail.com</span>
       <span class="follow">
         <a href="" title="Facebook" class="icon-link fb"><i class="fab fa-facebook foot-icon"></i></a>
         <a href="" title="Instagram" class="icon-link ig"><i class="fab fa-instagram foot-icon"></i></a>
         <a href="" title="Twitter" class="icon-link tw"><i class="fab fa-twitter foot-icon"></i></a>
       </span></p>
       <div class="copyright">
     <div class="row">
      <div class="col-12">
		    <p class=""><i class="fas fa-copyright"></i>
		      Grading System <?php echo date("Y")?> - All Rights Reserved. <span class="develop">Developed By <a href="">The WebClass</a></span></p>
      </div>
     </div>
   </div>
      </div>
     </div>
   </div>
 </div>
</footer>
<script>
(function () {

  var clockElement = document.getElementById( "clock" );

  function updateClock ( clock ) {
    clock.innerHTML = new Date().toLocaleTimeString();
  }

  setInterval(function () {
      updateClock( clockElement );
  }, 1000);

}());
</script>
<script>
function showPass(){
  var pass = document.getElementById('check').checked;
  if(pass){
          password.setAttribute('type','text');
  }

  else{
    password.setAttribute('type','password');
  }
}
</script>

<script>
new WOW().init();
</script>
</body>
</html>
