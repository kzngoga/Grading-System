<?php
session_start();
if(!isset($_SESSION['studentid'])){
header('location:../student-login.php');
}
$session_Id = $_SESSION['studentid'];
?>