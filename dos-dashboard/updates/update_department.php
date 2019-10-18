<?php
include("../../connection/connect.php");
include("../session/session.php");

// Retrieve Users Data

$retr = "Select * From users where user_ID = '$session_Id'";
$run_retr = mysqli_query($con, $retr);
$row_retr = mysqli_fetch_array($run_retr);
$fname = $row_retr['user_Fname'];

//Getting the selected User's ID
if(isset($_GET['editDept'])){
    $deptId = $_GET['editDept'];
    $select = "select * from department where dep_ID = '$deptId'";
    $run_select = mysqli_query($con,$select);
    $fetch_select = mysqli_fetch_array($run_select);
    $depName = $fetch_select['dep_Name'];
    $status = $fetch_select['status'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $fname;?> | Update Department</title>

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
          <a href="../index.php" class="nav-link">
          <i class="fa fa-home dash-icon"></i> Home</a></li>

          <li class="nav-item">
          <a href="../add_department.php" class="nav-link">
          <i class="fas fa-user-edit dash-icon"></i> Add Department</a></li>
          <li class="nav-item">
          <a href="../view_department.php" class="nav-link"><i class="fa fa-building dash-icon"></i>  Department 
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
          <a href="../view_students.php" class="nav-link">
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
          <a href="../class_info.php" class="nav-link">
          <i class="fas fa-school dash-icon"></i> Class Info.
          </a></li>
        </ul>
      </div>
    </nav>
            
    <main role="main" class="col-md-10 ml-sm-auto px-4">
      <div class="dash-output-section">
        <h2 class="text-center">Update Department</h2>
        <center>
        <form method="post" action="" style="width: 30% !important;">
        <div class="form-group">
            <label for="department" style="text-align: center !important;">Department Name</label>
            <input type="text" name="department" class="form-control" id="department" placeholder="Enter Department" value="<?php echo $depName;?>">
        </div>      
        <div class="form-group">
            <button class="form-control btn btn-primary" id="update" type="submit" name="update" style="width: 75% !important;"> <span>Update Department</span></button>
            <span class="text-danger"><h5 id="error"> </h5></span>
        </div>
        </form>
        </center>  
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
$dID = $deptId;
$dName = $depName;
$departName = $_POST['department'];
$Status = $status; 

$select = "select * from department where dep_Name = '$departName'";
$run_select = mysqli_query($con, $select);
$check_data = mysqli_num_rows($run_select);

if($Status == "Off") {
$update = "Update department
set dep_Name = '$depName',status = 'On' where dep_ID = '$dID'";

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
    '<h1 class=alert-title>Success</h1>' + '<p class=alert-text>Department `$departName` Was re-added!</p>, ' + '<a href=../view_department.php class= alert-btn>Continue!</a>',
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

elseif(($status=='On') && ($departName == $dName)){
  echo "<script>window.open('../view_department.php','_self')</script>";
}

elseif(($check_data > 0) && ($status=='On')){
    echo "
    <script>
    Swal.fire({
      showConfirmButton: false,
      width: 550,
      background: '#f2f2f2',
      padding: '20px',
      allowOutsideClick:false,
      html:
      '<h1 class=alert-title>Error</h1>' + '<p class=alert-text>Department `$departName` Already Added!</p>, ' + '<a href=../view_department.php class= alert-error-btn>Continue!</a>',
      type: 'error',
      animation: true,
      customClass: {
        popup: 'animated swing'
      }
    });
    </script>";
}

else{
$update = "Update department
set dep_Name = '$depName' where dep_ID = '$dID'";

$run_update = mysqli_query($con, $update);

if(($run_update) && ($status=='On')){
    echo "
    <script>
    Swal.fire({
      showConfirmButton: false,
      width: 550,
      background: '#f2f2f2',
      padding: '20px',
      allowOutsideClick:false,
      html:
      '<h1 class=alert-title>Success</h1>' + '<p class=alert-text>Department Successfully Updated</p>, ' + '<a href=../view_department.php class= alert-btn>Continue!</a>',
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
}
?>
</body>
</html>
