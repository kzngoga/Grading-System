<?php
session_start();
if(!isset($_SESSION['teacherid'])){
header('location:../teacher-login.php');
}
$session_Id = $_SESSION['teacherid'];
?>