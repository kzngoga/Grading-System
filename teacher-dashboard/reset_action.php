<html>
<head>
<link rel="stylesheet" href="../../node_modules/sweetalert2/dist/sweetalert2.css">
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
<script type="text/javascript" src="../js/script_res_pwd.js"></script>
<script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
</body>
<?php
include("../connection/connect.php");
include("reset_password.php");

// // Retrieve Users Data

$retr = "Select teacher.teacher_ID,teacher.teacher_Fname,department.dep_Name,department.dep_ID 
FROM teacher INNER JOIN department ON teacher.dep_ID = department.dep_ID 
AND teacher.teacher_ID = '$session_Id'";
$run_retr = mysqli_query($con, $retr);
$row_retr = mysqli_fetch_array($run_retr);
$fname = $row_retr['teacher_Fname'];
$tchrId = $row_retr['teacher_ID'];
$depart = $row_retr['dep_Name'];
$departID = $row_retr['dep_ID'];

?>

<?php
if(isset($_POST['pwd'])){
$password = $_POST['password'];
$confPassword = $_POST['confPassword'];
$conf = MD5($confPassword);

$update_pwd = "Update teacher set password = '$conf' WHERE teacher_ID = '$tchrId'";
$run_update_pwd = mysqli_query($con, $update_pwd);

if($run_update_pwd){
  echo "

  <script>
  Swal.fire({
    showConfirmButton: false,
    width: 550,
    background: '#f2f2f2',
    padding: '20px',
    allowOutsideClick:false,
    html:
    '<h1 class=alert-title>Success</h1>' + '<p class=alert-text>Password Was Successfully Reset!</p>, ' + '<a href=index.php class= alert-btn>Continue!</a>',
    type: 'success',
    animation: true,
    customClass: {
      popup: 'animated swing'
    }
  });
  </script>";
}
else{
  echo "<script>alert('Password Was not reset!')</script>";
}
}

?>
</html>