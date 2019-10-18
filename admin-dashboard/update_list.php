<?php
include("../connection/connect.php");
include("session/session.php");
// Retrieve Users Data
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.css">
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
  text-decoration: none;
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
<!-- <button onclick="sweetAlerter()">Click Me!</button> -->
<script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script> 

<?php
$retr = "Select * From users where user_ID = '$session_Id'";
$run_retr = mysqli_query($con, $retr);
$row_retr = mysqli_fetch_array($run_retr);
$fname = $row_retr['user_Fname'];

$now_Date = date('m');


if($now_Date == '9'){
    $update_status = "update student set status = 'Off' where 
    student.start_date = '3'";
    $run_update_status = mysqli_query($con,$update_status);
    
    if($run_update_status){
        echo "<script>    Swal.fire({
            showConfirmButton: false,
            width: 550,
            background: '#f2f2f2',
            padding: '20px',
            allowOutsideClick:false,
            html:
            '<h1 class=alert-title style=''>Success</h1>' + '<p class=alert-text>Student list was Updated successfully!</p>, ' + '<a href=view_students.php class= alert-btn>Continue!</a>',
            type: 'success',
            animation: true,
            customClass: {
              popup: 'animated swing'
            }
          });</script>"; 
    }
    
    else{
    echo "<script>alert('List Not Updated')</script>";
    }
    }

if($now_Date == '3'){
$update_status = "update student set status = 'Off' where 
student.start_date = '9'";
$run_update_status = mysqli_query($con,$update_status);

if($run_update_status){
    echo "<script>    Swal.fire({
        showConfirmButton: false,
        width: 550,
        background: '#f2f2f2',
        padding: '20px',
        allowOutsideClick:false,
        html:
        '<h1 class=alert-title>Success</h1>' + '<p class=alert-text>Student list was Updated successfully!</p>, ' + '<a href=view_students.php class= alert-btn>Continue!</a>',
        type: 'success',
        animation: true,
        customClass: {
          popup: 'animated swing'
        }
      });</script>"; 
}

else{
echo "<script>alert('List Not Updated')</script>";
}
}

else{
    echo "<script>    Swal.fire({
        showConfirmButton: false,
        width: 550,
        background: '#f2f2f2',
        padding: '20px',
        allowOutsideClick:false,
        html:
        '<h1 class=alert-title>Success</h1>' + '<p class=alert-text>No changes Made to the list!</p>, ' + '<a href=view_students.php class= alert-btn>Continue!</a>',
        type: 'success',
        animation: true,
        customClass: {
          popup: 'animated swing'
        }
      });</script>"; 
}
?>
</body>
</html>