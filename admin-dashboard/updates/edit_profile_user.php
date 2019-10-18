<?php
include("../../connection/connect.php");
include("../session/session.php");
    $msg="";
// Retrieve Users Data

$retr = "Select * From users where user_ID = '$session_Id'";
$run_retr = mysqli_query($con, $retr);
$row_retr = mysqli_fetch_array($run_retr);
$fname = $row_retr['user_Fname'];
$lname = $row_retr['user_Lname'];
$userId = $row_retr['user_ID'];
$email = $row_retr['user_Mail'];
$gender = $row_retr['user_Gen'];
$address = $row_retr['user_Address'];
$role = $row_retr['user_Role'];
$phone = $row_retr['user_Phone'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $fname;?> | Edit Profile</title>

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
<script src="../../js/wow.min.js"></script>
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
          <a href="../index.php" class="nav-link active">
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
        <h2>Edit My Profile</h2>
        <form method="post" action="" id="myForm" novalidate>
          <div class="form-row">
            <div class="form-group col-md-4">
            <label for="lname">User's Lastname</label>
            <input class="form-control" type="text"
                name="lname" id="lname" value="<?php echo $lname;?>" readonly>
            </div>    
            <div class="form-group col-md-4">
            <label for="fname">User's Firstname</label>
            <input class="form-control" type="text"
            name="fname" id="fname" value="<?php echo $fname;?>" readonly>
            </div>
            <div class="form-group col-md-4">
            <label for="email">User's E-Mail</label>
            <input class="form-control" type="text" Placeholder="Enter Email" 
                name="email" id="email" value="<?php echo $email;?>"
                onfocusout="validateEmail()">
                <span class="helper-text"></span>
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
              <select class="custom-select" id="address" 
              onfocusout="validateAddress()" name="address">
                  <option selected value="<?php echo $address;?>">
                    <?php echo $address;?></option>
                  <option disabled value="0">-- Select District --</option>
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
            <div class="form-group col-md-4">
            <label for="role">User's Role</label>
            <input class="form-control" type="text"
                name="role" id="role" value="<?php echo $role;?>" readonly>
            </div>                       
          </div>          
          <div class="form-row mt-1">   
            <div class="form-group col-md-4">
            <label for="phone">Mobile N0.</label>
            <input class="form-control" type="text" Placeholder="Enter Telephone N0." 
            name="phone" id="phone" value="<?php echo $phone;?>" 
            onfocusout="validateMobile()">
            <span class="helper-text"></span>
            </div>        
          </div>             
        <center>
        <div class="form-group">
            <button class="form-control btn btn-primary" id="addBtn" type="submit" name="update" onclick="sweetalertclick()"> <span>Update Profile</span></button>
            <span class="text-danger"><h5 id="error"> </h5></span>
        </div>
        <!-- <?php echo $msg;?> -->
        </center>
        </form>
      </div>
    </main>
  </div>
</div> 
<script>
new WOW().init();
</script>
<script src="../../js/script_profile.js"></script>
<script src="../../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script>
  function sweetalertclick(){
      // Swal.fire('Hello world!');
      // Swal.fire('Success', 'Profile Updated', 'success');
  }
</script>


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

$update = "Update users
set user_Fname = '$fname', user_Lname = '$lname',user_Mail ='$email',user_Address ='$address',
user_Gen = '$gender',user_Phone ='$phone',user_Role ='$role'
where user_ID = '$uID'";

$run_update = mysqli_query($con, $update);

if($run_update){
    // echo "<script>alert('Profile Updated')</script>";
    // USE SETTIMEOUT FUNCTION TO USE SWEETALERT
    echo "

    <script>
    Swal.fire({
      showConfirmButton: false,
      width: 550,
      background: '#f2f2f2',
      padding: '20px',
      allowOutsideClick:false,
      html:
      '<h1 class=alert-title>Success</h1>' + '<p class=alert-text>Profile Updated!</p>, ' + '<a href=../index.php class= alert-btn>Continue!</a>',
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
